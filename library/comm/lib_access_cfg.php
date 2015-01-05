<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @lib_access_cfg.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
/**
 * 解释权限配置文件类
 *
 * @version $Id$
 *
 */
class lib_access_cfg
{
    public static $config_file = 'inc_accesscontrol_groups.php';
    public static $cfg_groups  = '';
    public static $cfg_cache   = 'acc_cfg';
   
   /**
    * 获得配置数组
    */
    public static function get_config()
    {
        $filename = PATH_APP.'/config/'.self::$config_file;
        if( self::$cfg_groups != '' )
        {
            return self::$cfg_groups;
        }
        if( !is_file($filename) )
        {
            exit('Access config not found! ');
        }
        
        //从缓存获取数据（测试表明解释速度已经足够快，因此默认没启用缓存）
        /*
        self::$cfg_groups = get_cache(self::$cfg_cache, 'cfg');
        if( is_array(self::$cfg_groups) )
        {
            //print_r( self::$cfg_groups );
            return self::$cfg_groups;
        }*/
        
        $content  = file_get_contents( $filename );
        $content = preg_replace("/^(.*)[\r\n]\?>/sU", '', $content);
        preg_match_all("/<apps:([^>]*)>(.*)<\/apps:([^>]*)>/sU", $content, $arr);
        foreach( $arr[1] as $k => $attstr )
        {
            $atts = self::parse_atts($attstr);
            $appname = $arr[3][$k];
            $cfg_groups['apps'][$appname]['allowapp'] = self::get_trim_atts($atts, 'allowapp');
            $cfg_groups['apps'][$appname]['auttype']   = self::get_trim_atts($atts, 'auttype');
            $cfg_groups['apps'][$appname]['name']      = self::get_trim_atts($atts, 'name');
            $cfg_groups['apps'][$appname]['control']   = self::get_trim_atts($atts, 'login_control');
            $cfg_groups['apps'][$appname]['public']    = '';
            $cfg_groups['apps'][$appname]['protected'] = '';
            $cfg_groups['apps'][$appname]['private']   = array();
            preg_match_all("/<ctl:([^>]*)>(.*)<\/ctl:([^>]*)>/sU", $arr[2][$k], $ctls);
            foreach( $ctls[1] as $j => $ctlname )
            {
                if( $ctlname=='private' )
                {
                    preg_match_all("/<([\w]*)([^>]*)>(.*)<\/([\w]*)>/sU", $ctls[2][$j], $groups);
                    foreach($groups[4] as $l => $v )
                    {
                        $atts2     = self::parse_atts( $groups[2][$l] );
                        $groupname = self::get_trim_atts($atts2, 'name');
                        $cfg_groups['apps'][$appname]['private'][$v]['name']    = $groupname;
                        $cfg_groups['access_groups']["{$appname}_{$v}"] = $groupname;
                        $cfg_groups['apps'][$appname]['private'][$v]['allow']   = self::str_gps(self::get_trim_atts($groups[3], $l));
                    }
                } else {
                    $cfg_groups['apps'][$appname][ $ctlname ] = self::str_gps(self::get_trim_atts($ctls[2], $j));
                }
            }
        }
        self::$cfg_groups = $cfg_groups;
        //set_cache(self::$cfg_cache, 'cfg', self::$cfg_groups, 12 * 3600);
        return self::$cfg_groups;
    }

    /**
    * 解析属性
    * @parem $attstr
    * @return array
    */
    public static function str_gps($cfgstr)
    {
        $rearr = '';
        if( empty($cfgstr) )
        {
            return array();
        }
        if( $cfgstr=='*' )
        {
            return $cfgstr;
        }
        $cfgstrs = explode(',', $cfgstr);
        foreach($cfgstrs as $v)
        {
            if( $v=='*' ) continue;
            $vs = explode('-', $v);
            $rearr[$vs[0]][] = $vs[1];
        }
        return $rearr;
    }

   /**
    * 解析属性
    * @parem $attstr
    * @return array
    */
    public static function parse_atts($attstr)
    {
        $patts = '';
        preg_match_all("/([0-9a-z_-]*)[\t ]{0,}=[\t ]{0,}[\"']([^>\"']*)[\"']/isU", $attstr, $patts);
        if( !isset($patts[1]) )
        {
           return false;
        }
        $atts = array();
        foreach($patts[1] as $ak=>$attname)
        {
           $atts[trim($attname)] = trim($patts[2][$ak]);
        }
        return $atts;
    }

    /**
    * 把值里的空白字符去除
    * @parem $atts
    * @parem $key
    * @return string
    */
    public static function get_trim_atts(&$atts, $key)
    {
        if( !isset($atts[$key]) )
        {
            return '';
        } else {
            return preg_replace("/[ \t\r\n]/", '', $atts[$key]);
        }
    }
    
    /**
    * 把权限数组转为字符串
    */
    public static function gps_str(&$gps)
    {
        $gstr = '';
        if( is_array($gps))
        {
             foreach($gps as $kctl=>$kacs)
             {
                  if( is_array($kacs) )
                  {
                       foreach($kacs as $ac)
                          $gstr .= ($gstr=='' ? "{$kctl}-{$ac}" : ",{$kctl}-{$ac}");
                  }
             }
        }
        else
        {
                $gstr = $gps;
        }
        return $gstr;
    }
    
   /**
    * 获得用户的所有权限信息
    * @parem $uid        用户ID
    * @parem $appname   应用池
    * @parem $gp         应用池里的组
    * @return array | string
    */
    public static function get_acc_groups($uid, $appname, $gp)
    {
        $upurview = lib_database::get_one("Select * From `users_purview` where `uid`='{$uid}' ");
        $gstr = '';
        if( empty($upurview['purviews']) )
        {
            $gpall = explode(',', $gp);
            foreach($gpall as $gp)
            {
                list($p, $g) = explode('-', $gp);
                if( $p==$appname && isset(self::$cfg_groups['apps'][$appname]['private'][$g]['allow']) )
                {
                    $all = self::$cfg_groups['apps'][$appname]['private'][$g]['allow'];
                    if( empty($all) )
                    {
                        continue;
                    } else if($all=='*'){
                        $gstr = '*';
                        break;
                    } else {
                        $gstr .= ($gstr=='' ? '' : ',').self::gps_str($all);
                    }
                }
            }
        }
        else
        {
            $gstr = $upurview['purviews'];
        }
        $groups = self::str_gps($gstr);
        return $groups;
    }
    
   /**
    * 更新配置
    */
    public static function save_config($cfg_arr)
    {
        $configfile = PATH_DM_CONFIG.'/'.self::$config_file;
        $new_config = '';
        foreach($cfg_arr['apps'] as $k => $apps)
        {
            $new_config .= "<apps:{$k} name=\"{$apps['name']}\" allowapp=\"{$apps['allowapp']}\" auttype=\"{$apps['auttype']}\" login_control=\"{$apps['control']}\">\n\n";
            $public_ctl = self::gps_str($apps['public']);
            $protected_ctl = self::gps_str($apps['protected']);
            $new_config   .= "    <!-- //公开的控制器，不需登录就能访问 -->\n";
            $new_config   .= "    <ctl:public>{$public_ctl}</ctl:public>\n\n";
            $new_config   .= "    <!-- //保护的控制器，当前池会员登录后都能访问 -->\n";
            $new_config   .= "    <ctl:protected>{$protected_ctl}</ctl:protected>\n\n";
            $new_config   .= "    <!-- //私有控制器，只有特定组才能访问 -->\n";
            $new_config   .= "    <ctl:private>\n";
            foreach($apps['private'] as $gp => $gps)
            {
                $private_ctl = self::gps_str($gps['allow']);
                $new_config .= "        <{$gp} name=\"{$gps['name']}\">{$private_ctl}</{$gp}>\n";
            }
            $new_config .= "    </ctl:private>\n\n";
            $new_config .= "</apps:{$k}>\n\n";
        }
        return file_put_contents($configfile, $new_config);
    }

}
?>