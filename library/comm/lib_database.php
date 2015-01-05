<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @lib_database.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

/**
 * 数据库操作类 <<读写分离>>
 *
 * 读   - mysql master
 *    - mysql slave 1
 *    - mysql slave 2
 *    ......
 *
 * 写 - master
 *
 * @version $Id$
 */

class lib_database
{
    protected static $link_read = null;
    protected static $link_write = null;
    protected static $current_link = null;
    protected static $query_count = 1;
    protected static $log_slow_query = false;//是否显示慢查询
    protected static $log_slow_time = 0.05;
    
    //游标集
    public static $result = array();
    
    //是否对SQL语句进行安全检查并处理
    public static $safe_test = true;
    public static $rps = array('/*', '--', '#', 'union', 'sleep', 'benchmark', 'load_file', 'outfile');
    public static $rpt = array('/×', '——', '＃', 'ｕｎｉｏｎ', 'ｓｌｅｅｐ', 'ｂｅｎｃｈｍａｒｋ', 'ｌｏａｄ_ｆｉｌｅ', 'ｏｕｔｆｉｌｅ');
    
    /**
     * (读+写)连接数据库+选择数据库
     *
     * @return void
     */
    protected static function init_mysql ($is_read = true, $is_master = false)
    {
        /*
         +-----------------
         + 读写分离
         +-----------------
         */
        empty($GLOBALS['config']) && include PATH_CONFIG . '/inc_config.php';
        if ($is_read === true)
        {
            $link = 'link_read';
            if ($is_master === false)
            {
                $key = array_rand($GLOBALS['config']['db_host']['slave']);
                $host = $GLOBALS['config']['db_host']['slave'][$key];
            }
            else
            {
                $host = $GLOBALS['config']['db_host']['master'];
            }
        }
        else
        {
            $link = 'link_write';
            $host = $GLOBALS['config']['db_host']['master'];
        }
        if (empty(self::$$link))
        {
            try
            {
                self::$$link = @mysql_connect($host, $GLOBALS['config']['db_user'], $GLOBALS['config']['db_pass']);
                if (empty(self::$$link))
                {
                    throw new Exception(mysql_error());
                }
                else
                {
                    $charset = str_replace('-', '', strtolower($GLOBALS['config']['db_charset']));
                    mysql_query(" SET character_set_connection=" . $charset . ", character_set_results=" . $charset . ", character_set_client=binary, sql_mode='' ");
                    if (@mysql_select_db($GLOBALS['config']['db_name']) === false)
                    {
                        throw new Exception(mysql_error());
                    }
                }
            }
            catch (Exception $e)
            {
                //die($e->getMessage().$e->getTraceAsString());
                trigger_error("Connect Mysql false!");
                exit();
            }
        }
        return self::$$link;
    }
    /**
     * (读 + 写)
     *
     * @param  string $sql
     * @return bool
     */
    public static function query ($sql, $is_master = false, $rsid = '#')
    {
        $start_time = microtime(true);
        $sql = trim($sql);
        if( $rsid=='#' )
        {
            $rsid = self::$query_count;
        }
        //对SQL语句进行安全过滤
        if( self::$safe_test==true )
        {
            $sql = self::filter_sql($sql);
        }
        if (substr(strtolower($sql), 0, 1) === 's')
        {
            self::$current_link = self::init_mysql(true, $is_master);
        }
        else
        {
            self::$current_link = self::init_mysql(false, $is_master);
        }
        try
        {
            self::$result[$rsid] = @mysql_query($sql, self::$current_link);
            //记录慢查询
            if( self::$log_slow_query )
            {
                $querytime = microtime(true) - $start_time;
                if( $querytime > self::$log_slow_time )
                {
                    self::slow_query_log($sql, $querytime);
                }
            }
            if (self::$result[$rsid] === false)
            {
                throw new Exception(mysql_error());
                return false;
            }
            else
            {
                self::$query_count ++;
                return $rsid;
            }
        }
        catch (Exception $e)
        {
            trigger_error('<strong>Query: </strong> ' . $sql);
            exit();
        }
    }
    /**
     * 只读
     * @param  string $sql
     * @param  int $rsid
     * @return bool
     */
    public static function rquery ($sql, $rsid = '#')
    {
        return self::query ($sql, false, $rsid);
    }
    /**
     * 只写
     * @param  string $sql
     * @param  int $rsid
     * @return bool
     */
    public static function wquery ($sql, $rsid = '#')
    {
        return self::query ($sql, true, $rsid);
    }
    /**
     * 取得最后一次插入记录的ID值
     *
     * @return int
     */
    public static function insert_id ()
    {
        return mysql_insert_id(self::$current_link);
    }
    /**
     * 返回受影响数目
     * @return init
     */
    public static function affected_rows ()
    {
        return mysql_affected_rows(self::$current_link);
    }
    /**
     * 返回本次查询所得的总记录数...
     *
     * @return int
     */
    public static function num_rows ( $rsid = '#' )
    {
        if( $rsid=='#' )
        {
            $rsid = self::$query_count - 1;
        }
        return mysql_num_rows(self::$result[$rsid]);
    }
    /**
     * (读)返回单条记录数据
     *
     * @deprecated   MYSQL_ASSOC==1 MYSQL_NUM==2 MYSQL_BOTH==3
     * @param  int   $result_type
     * @return array
     */
    public static function fetch_one ($rsid = '#', $result_type = MYSQL_ASSOC)
    {
        if( $rsid=='#' )
        {
            $rsid = self::$query_count - 1;
        }
        $rsid = empty($rsid) ? self::$result[1] : self::$result[$rsid];
        $row = mysql_fetch_array($rsid, $result_type);
        return $row;
    }
    /**
     * (读)直接返回单条记录数据
     *
     * @deprecated   MYSQL_ASSOC==1 MYSQL_NUM==2 MYSQL_BOTH==3
     * @param  int   $result_type
     * @return array
     */
    public static function get_one ($sql, $result_type = MYSQL_ASSOC)
    {
        if( !preg_match("/limit/i", $sql) )
        {
            $sql = preg_replace("/[,;]$/i", '', trim($sql))." limit 1 ";
        }
        $rsid = self::query ($sql, false);
        self::$query_count--;
        $row = mysql_fetch_array(self::$result[$rsid], $result_type);
        return $row;
    }
    /**
     * (读)返回多条记录数据
     *
     * @deprecated    MYSQL_ASSOC==1 MYSQL_NUM==2 MYSQL_BOTH==3
     * @param   int   $result_type
     * @return  array
     */
    public static function fetch_all ($rsid = '#')
    {
        if( $rsid=='#' )
        {
            $rsid = self::$query_count - 1;
        }
        $row = $rows = array();
        while ($row = mysql_fetch_array(self::$result[$rsid], MYSQL_ASSOC))
        {
            $rows[] = $row;
        }
        if (empty($rows))
        {
            return false;
        }
        else
        {
            return $rows;
        }
    }
   /**
    * SQL语句过滤程序（检查到有不安全的语句仅作替换和记录攻击日志而不中断）
    * @parem string $sql 要过滤的SQL语句 
    */
    protected static function filter_sql($sql)
    {
        $clean = $error='';
        $old_pos = 0;
        $pos = -1;
        $logfile = PATH_DATA.'/log/sql_safe_alert.log';
        $userIP = get_client_ip();
        $getUrl = get_cururl();
        //完整的SQL检查
        while (true)
        {
            $pos = strpos($sql, '\'', $pos + 1);
            if ($pos === false)
            {
                break;
            }
            $clean .= substr($sql, $old_pos, $pos - $old_pos);
            while (true)
            {
                $pos1 = strpos($sql, '\'', $pos + 1);
                $pos2 = strpos($sql, '\\', $pos + 1);
                if ($pos1 === false)
                {
                    break;
                }
                elseif ($pos2 == false || $pos2 > $pos1)
                {
                    $pos = $pos1;
                    break;
                }
                $pos = $pos2 + 1;
            }
            $clean .= '$s$';
            $old_pos = $pos + 1;
        }
        $clean .= substr($sql, $old_pos);
        $clean = trim(strtolower(preg_replace(array('~\s+~s' ), array(' '), $clean)));
        $fail = false;
        //sql语句中出现注解
        if (strpos($clean, '/*') > 2 || strpos($clean, '--') !== false || strpos($clean, '#') !== false)
        {
            $fail = true;
            $error = 'commet detect';
        }
        //常用的程序里也不使用union，但是一些黑客使用它，所以检查它
        else if (strpos($clean, 'union') !== false && preg_match('~(^|[^a-z])union($|[^[a-z])~s', $clean) != 0)
        {
            $fail = true;
            $error = 'union detect';
        }
        //这些函数不会被使用，但是黑客会用它来操作文件，down掉数据库
        elseif (strpos($clean, 'sleep') !== false && preg_match('~(^|[^a-z])sleep($|[^[a-z])~s', $clean) != 0)
        {
            $fail = true;
            $error = 'slown down detect';
        }
        elseif (strpos($clean, 'benchmark') !== false && preg_match('~(^|[^a-z])benchmark($|[^[a-z])~s', $clean) != 0)
        {
            $fail = true;
            $error="slown down detect";
        }
        elseif (strpos($clean, 'load_file') !== false && preg_match('~(^|[^a-z])load_file($|[^[a-z])~s', $clean) != 0)
        {
            $fail = true;
            $error="file fun detect";
        }
        elseif (strpos($clean, 'into outfile') !== false && preg_match('~(^|[^a-z])into\s+outfile($|[^[a-z])~s', $clean) != 0)
        {
            $fail = true;
            $error="file fun detect";
        }
        //检测到有错误后记录日志并对非法关键字进行替换
        if ( $fail===true )
        {
        	$gurl = htmlspecialchars(get_cururl());
	        $msg  = "Time:".date('y-m-d H:i', time())." -- {$gurl}<br>".htmlspecialchars( $sql )."<hr size='1' />\n";
	        $fp   = fopen($logfile, 'a');
	        fwrite($fp, $msg);
	        fclose($fp);
	        //
            $sql = str_ireplace(self::$rps, self::$rpt, $sql);
            return $sql;
        }
        else
        {
            return $sql;
        }
    }
    
    /**
    * 修正被防注入程序修改了的字符串
    * 在读出取时有必要完全还原才使用此方法
    * @param string $fvalue
    */
    public static function revert($fvalue)
    {
        $fvalue = str_ireplace(self::$rpt, self::$rps, $fvalue);
        return $fvalue;
    }
    
    /**
     * 记录慢查询日志
     *
     * @param string $sql
     * @param float $qtime
     * @return bool
     */
    public static function slow_query_log($sql, $qtime)
    {
        $logfile = PATH_DATA.'/log/slow_query_log.log';
        $gurl = htmlspecialchars(get_cururl());
        $msg  = "Time: {$qtime} -- ".date('y-m-d H:i', time())." -- {$gurl}<br>".htmlspecialchars( $sql )."<hr size='1' />\n";
        $fp   = fopen($logfile, 'a');
        fwrite($fp, $msg);
        fclose($fp);
    }

    
    /**
     * (写)插入数据
     *
     * @param string $table
     * @param array $fields
     * @param array $data
     * @return boolean
     */
    public function insert($table, $fields, $data)
    {
        try
        {
            if (empty($table) || empty($fields) || empty($data)) {
                throw new Exception('插入数据的表名，字段、数据不能为空', 444);
            }

            if (!is_array($fields) || !is_array($data))
            {
                throw new Exception('插入数据的字段和数据必须是数组', 444);
            }

            // 格式化字段
            $_fields = '`' . implode('`, `', $fields) . '`';

            // 格式化需要插入的数据
            $_data = self::format_insert_data($data);

            if (empty($_fields) || empty($_data))
            {
                throw new Exception('插入数据的字段和数据必须是数组', 444);
            }

            $sql = "INSERT INTO `".tname($table)."` ({$_fields}) VALUES {$_data}";
            $result = self::wquery($sql, true);

            return self::affected_rows();
        }
        catch (Exception $e)
        {
            if (!defined('DEBUG_LEVEL') || !DEBUG_LEVEL) ;
            else
            {
            	trigger_error($e->getMessage().'<br/><pre>', $e->getTraceAsString(), '</pre><strong>Query: </strong>[insert] ' . $sql);
            }
            exit;
        }
    }
    
     /**
     * 格式化 insert 数据，将数组（二维数组）转换成向数据库插入记录时接受的字符串
     *
     * @param array $data
     * @return string
     */
    public static function format_insert_data($data)
    {
        if (!is_array($data) || empty($data))
        {
            throw new Exception('数据的类型不是数组', 445);
        }

        $output = '';
        foreach ($data as $value)
        {
            // 如果是二维数组
            if (is_array($value))
            {
                $tmp = '(\'' . implode("', '", $value) . '\')';
                $output .= !empty($output) ? ", {$tmp}" : $tmp;
                unset($tmp);
            }
            else
            {
                $output = '(\'' . implode("', '", $data) . '\')';
            }
        } //foreach

        return $output;
    }
    
    /**
     * (写)删除记录
     *
     * @param string $table
     * @param string $condition
     * @return num
     */
    public function delete($table, $condition)
    {
        try
        {
            if (empty($table) || empty($condition))
            {
                throw new Exception('表名和条件不能为空', 444);
            }

            $sql = "DELETE FROM `".tname($table)."` WHERE {$condition}";
            $result = self::wquery($sql, true);

            return self::affected_rows();
        }
        catch (Exception $e)
        {
            if (!defined('DEBUG_LEVEL') || !DEBUG_LEVEL) ;
            else
            {
            	trigger_error($e->getMessage().'<br/><pre>', $e->getTraceAsString(), '</pre><strong>Query: </strong>[insert] ' . $sql);
            }
            exit;
        }
    }
    
    
    /**
     * （读）查询数据库记录，以数组方式返回数据
     *
     * @param string $table
     * @param string $fields
     * @param string $condition
     * @return array
     */
    public static function select($table, $fields='*', $condition='1')
    {
        try
        {
            if (empty($table) || empty($fields) || empty($condition))
            {
                throw new Exception('查询数据的表名，字段，条件不能为空', 444);
            }
            $sql = "SELECT {$fields} FROM `".tname($table)."` WHERE {$condition}";
            $rsid = self::rquery($sql, false);
            return self::fetch_all($rsid);
        }
        catch (Exception $e)
        {
            if (!defined('DEBUG_LEVEL') || !DEBUG_LEVEL) ;
            else {
               trigger_error($e->getMessage().'<br/><pre>', $e->getTraceAsString(), '</pre><strong>Query: </strong>[insert] ' . $sql);
            }
            exit;
        }
    }
    
    /**
     * (写)更新数据库记录 UPDATE，返回更新的记录数量
     *
     * @param string $table
     * @param string $data
     * @param string $condition
     * @return int
     */
    public static function update($table, $data, $condition)
    {
        try
        {
            if (empty($table) || empty($data) || empty($condition))
                throw new Exception('更新数据的表名，数据，条件不能为空', 444);

            if(!is_array($data))
                throw new Exception('更新数据必须是数组', 444);

            $set = '';
            foreach ($data as $k => $v)
                $set .= empty($set) ? ("`{$k}` = '{$v}'") : (", `{$k}` = '{$v}'");

            if (empty($set)) throw new Exception('更新数据格式化失败', 444);

            $sql = "UPDATE `".tname($table)."` SET {$set} WHERE {$condition}";
            $result = self::wquery($sql, true);

            // 返回影响行数
            return self::affected_rows();
        }
        catch (Exception $e)
        {
            if (!defined('DEBUG_LEVEL') || !DEBUG_LEVEL) ;
            else {
            	trigger_error($e->getMessage().'<br/><pre>', $e->getTraceAsString(), '</pre><strong>Query: </strong>[insert] ' . $sql);
            }
            exit;
        }
    }
    
    /**
     * 查询记录数
     *
     * @param string $table
     * @param string $condition
     * @return int
     */
    public static function get_rows_num($table, $condition)
    {
        try
        {
            if (empty($table) || empty($condition))
                throw new Exception('查询记录数的表名，字段，条件不能为空', 444);

            $sql = "SELECT count(*) AS total FROM ".tname($table)." WHERE {$condition}";
            $result = self::rquery($sql);

            $tmp = self::fetch_one();
            return (empty($tmp)) ? false : $tmp['total'];
        }
        catch (Exception $e)
        {
            if (!defined('DEBUG_LEVEL') || !DEBUG_LEVEL) ;
            else
            {
            	trigger_error($e->getMessage().'<br/><pre>', $e->getTraceAsString(), '</pre><strong>Query: </strong>[insert] ' . $sql);
            }
            exit;
        }
    }
	
	public static function get_version($isformat = true) {
	    $query = self::rquery("SELECT VERSION();");
	    $row = self::fetch_one($query,MYSQL_NUM);
	    $mysql_version = $row[0];
	    if ($isformat) {
		    $mysql_versions = explode(".", trim($mysql_version));
		    $mysql_version = number_format($mysql_versions[0] . "." . $mysql_versions[1], 2);
	    }
	    return $mysql_version;
    }
}
?>