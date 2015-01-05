<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @lib_debug.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}

/***************************************
 * 这个文件用于接管系统中PHP语法出现的错误
 * debug_error_handler 测试模式
 * log_error_handler   生产模式(只记录错误日志)
 ***************************************/

//错误类型数组
//实际上错误句柄函数并不能处理 E_ERROR、E_PARSE、E_CORE_ERROR、E_CORE_WARNING、E_COMPILE_ERROR、 E_COMPILE_WARNING
//下面会列出上面几种只是用作参考
$debug_errortype = array (
                E_WARNING         => "<font color='#CDA93A'>警告</font>",
                E_NOTICE          => "<font color='#CDA93A'>普通警告</font>",
                E_USER_ERROR      => "<font color='#D63107'>用户错误</font>",
                E_USER_WARNING    => "<font color='#CDA93A'>用户警告</font>",
                E_USER_NOTICE     => "<font color='#CDA93A'>用户提示</font>",
                E_STRICT          => "<font color='#D63107'>运行时错误</font>",
                E_ERROR           => "致命错误",
                E_PARSE           => "解析错误",
                E_CORE_ERROR      => "核心致命错误",
                E_CORE_WARNING    => "核心警告",
                E_COMPILE_ERROR   => "编译致命错误",
                E_COMPILE_WARNING => "编译警告"
);

$GLOBALS['_debug_error_msg'] = '';
$GLOBALS['_debug_mt_time'] = '';
$GLOBALS['_debug_mt_info'] = '';

//xhprof 调试
if(PHP_SAPI !== 'cli' && function_exists('xhprof_enable') && (DEBUG_LEVEL === true || $debug_safe===true))
{
    xhprof_enable();
}

function debug_hanlde_xhprof()
{
    if(PHP_SAPI !== 'cli' && function_exists('xhprof_enable') && (DEBUG_LEVEL === true || $debug_safe===true))
    {
        $xhprof_data = xhprof_disable();
        include PATH_LIBRARY. "/xhprof_lib/utils/xhprof_lib.php";
        include PATH_LIBRARY. "/xhprof_lib/utils/xhprof_runs.php";
        $xhprof_runs = new XHProfRuns_Default();
        $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
        echo "<center><a href='/library/xhprof_html/index.php?run=$run_id&source=xhprof_foo'>xhprof性能日志</a></center>";
    }
}

/**
 * 性能测试函数
 * @parem $optmsg
 * return void
 */
function test_debug_mt( $optmsg )
{
    global $_debug_mt_time, $_debug_mt_info, $debug_safe;
    if (DEBUG_LEVEL === true || $debug_safe===true)
    {
        if( empty($_debug_mt_time) )
        {
            $_debug_mt_time = microtime(true);
            $m = sprintf('%0.2f', memory_get_usage()/1024/1024);
            $_debug_mt_info = "{$optmsg}: 当前内存 {$m} MB<br />\n";
        }
        else
        {
            $cutime = microtime(true);
            $etime = sprintf('%0.4f', $cutime - $_debug_mt_time);
            $m = sprintf('%0.2f', memory_get_usage()/1024/1024);
            $_debug_mt_info .= "{$optmsg}: 当前内存 {$m} MB 用时：{$etime} 秒<br />\n";
            $_debug_mt_time = $cutime;
        }
    }
}

//错误接管函数
function debug_error_handler($errno, $errmsg, $filename, $linenum, $vars)
{
    $err = debug_get_error_msg('debug', $errno, $errmsg, $filename, $linenum, $vars);
    if( $err!='@' )
    {
        $GLOBALS['_debug_error_msg'] .= $err;
    }
}
//exception接管函数
function debug_exception_handler($e)
{
    $errno     = $e->getCode();
    $errmsg    = $e->getMessage();
    $linenum   = $e->getLine();
    $filename  = $e->getFile();
    $backtrace = $e->getTrace();
    debug_error_handler($errno, $errmsg, $filename, $linenum, $backtrace);
}

//格式化错误信息
function debug_get_error_msg($log_type='debug', $errno, $errmsg, $filename, $linenum, $vars)
{
    global $debug_errortype, $debug_safe;
    $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
    
    //处理从 catch 过来的错误
    if (in_array($errno, $user_errors))
    {
        foreach($vars as $k=>$e)
        {
            if( is_object($e) && method_exists($e, 'getMessage') ) 
            {
                $errno     = $e->getCode();
                $errmsg    = $errmsg.' '.$e->getMessage();
                $linenum   = $e->getLine();
                $filename  = $e->getFile();
                $backtrace = $e->getTrace();
            }
        }
    }
    
    $not_save_error = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE, E_NOTICE, E_USER_WARNING, E_WARNING);
    
    //生产环境不理会普通的警告错误
    if( DEBUG_LEVEL !== true && $debug_safe !==true && !in_array($errno, $not_save_error) )
    {
        return '@';
    }
    
    //读取源码指定行
    if( !is_file($filename) )
    {
        return '@';
    }
    $fp = fopen($filename, 'r');
    $n = 0;
    $error_line = '';
    while( !feof($fp) )
    {
        $line = fgets($fp, 1024);
        $n++;
        if( $n==$linenum )
        {
            $error_line = trim($line);
            break;
        }
    }
    fclose($fp);
    
    //如果错误行用 @ 进行屏蔽，不显示错误
    if( $error_line[0]=='@' || preg_match("/[\(\t ]@/", $error_line) )
    {
        return '@';
    }
    
    $err = '';
    if( $log_type=='debug' )
    {
        $err = "<div style='font-size:14px;line-height:160%;border-bottom:1px dashed #ccc;margin-top:8px;'>\n";
    }
    else
    {
        if( !empty($_SERVER['REQUEST_URI']) )
        {
            $scriptName = $_SERVER['REQUEST_URI'];
            $nowurl = $scriptName;
        } else {
            $scriptName = $_SERVER['PHP_SELF'];
            $nowurl = empty($_SERVER['QUERY_STRING']) ? $scriptName : $scriptName.'?'.$_SERVER['QUERY_STRING'];
        }
        
        //替换不安全字符
        $f_arr_s = array('<', '*', '#', '"', "'", "\\", '(');
        $f_arr_r = array('〈', '×', '＃', '“', "‘", "＼", '（');
        $nowurl = str_replace($f_arr_s, $f_arr_r, $nowurl);
        
        $nowtime = date('Y-m-d H:i:s');
        $err = "Time: ".$nowtime.' @URL: '.$nowurl."\n";
    }
    
    if( empty($debug_errortype[$errno]) )
    {
        $debug_errortype[$errno] = "<font color='#466820'>手动抛出</font>";
    }
    
    $error_line = htmlspecialchars($error_line);
    
    //$err .= "<strong>框架应用错误跟踪：</strong><br />\n";
    $err .= "错误类型：" . $debug_errortype[$errno] . "<br />\n";
    $err .= "出错原因：<font color='#3F7640'>" . $errmsg . "</font><br />\n";
    $err .= "提示位置：" . $filename . " 第 {$linenum} 行<br />\n";
    $err .= "断点源码：<font color='#747267'>{$error_line}</font><br />\n";
    $err .= "详细跟踪：<br />\n";
    
    $backtrace = debug_backtrace();
    array_shift($backtrace);
    $narr = array('class', 'type', 'function', 'file', 'line');
    foreach($backtrace as $i => $l)
    {
         foreach($narr as $k)
         {
            if( !isset($l[$k]) ) $l[$k] = '';
         }
         $err .= "<font color='#747267'>[$i] in function {$l['class']}{$l['type']}{$l['function']} ";
         if($l['file']) $err .= " in {$l['file']} ";
         if($l['line']) $err .= " on line {$l['line']} ";
         $err .= "</font><br />\n";
    }
    
    $err .= $log_type=='debug' ? "</div>\n" : "------------------------------------------\n";
    
    return $err;
}

//显示调试信息（程序结束时执行）
function debug_error_show()
{
    global $debug_safe, $_debug_mt_info, $_debug_error_msg;
    if( $_debug_error_msg != '' || $_debug_mt_info !='')
    {
        if (DEBUG_LEVEL === true || $debug_safe===true)
        {
            $js  = '<script language=\'javascript\'>';
            $js .= 'function debug_close_all() {';
            $js .= '    document.getElementById(\'debug_ctl\').style.display=\'none\';';
            $js .= '    document.getElementById(\'debug_errdiv\').style.display=\'none\';';
            $js .= '}</script>';
            echo $js;
            echo '<div id="debug_ctl" style="width:100px;line-height:24px;top:5px;left:5px;border:1px solid #ccc; background: #FBFDE3; padding:2px;text-align:center">'."\n";
            echo '<a href="#" onclick="javascript:document.getElementById(\'debug_errdiv\').style.display=\'block\';" style="font-size:12px;">[打开调试信息]</a>'."\n";
            echo '</div>'."\n";
            echo '<div id="debug_errdiv" style="width:80%;position:absolute;top:10px;left:8px;border:2px solid #ccc; background: #fff; padding:8px;display:none">';
            echo '<div style="line-height:24px; background: #FBFEEF;;"><div style="float:left"><strong>框架应用错误/警告信息追踪：</strong></div><div style="float:right"><a href="#" onclick="javascript:debug_close_all();">[关闭全部]</a></div>';
            echo '<br style="clear:both"/></div>';
            echo $GLOBALS['_debug_error_msg'];
            echo "<hr /><div>";
            echo "<strong>性能追踪：</strong><br />".$_debug_mt_info."</div>";
            echo '<br style="clear:both"/></div>';
        }
        elseif(DEBUG_LOG===true)
        {
            $logmsg = preg_replace("/<font([^>]*)>|<\/font>|<\/div>|<\/strong>|<strong>|<br \/>/iU", '', $GLOBALS['_debug_error_msg']);
            $logmsg = preg_replace("/<div style='font-size:14px([^>]*)>/iU", "-----------------------------------------------\n错误跟踪：", $logmsg);
            $error_log = PATH_DATA . '/log/php_error.log';
            $fp = fopen($error_log, 'a');
            fwrite($fp, $logmsg);
            fclose($fp);
        }
    }
}

?>