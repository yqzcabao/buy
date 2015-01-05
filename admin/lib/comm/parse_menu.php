<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @parse_menu.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
/**
 * 管理菜单读取
 *
 * @version $Id$
 */
class parse_menu
{
	public static $menu_file = './config/inc_admin_menu.php';

	public static $main_menu = array();

	public static $sub_menu = array();

	/**
     * 解析主菜单
     *
     */
	public static function main_menu(){
		$menu_config = file_get_contents(self::$menu_file);
		preg_match_all("#<menu([^>]*)>(.*)</menu>#sU", $menu_config, $arr);
		$j = 0;
		foreach($arr[1] as $k=>$v){
			$mi = ++$j;
			$atts = self::parse_atts($v);
			$menu_name = self::get_att($atts, 'name');
			$menu_id=self::get_att($atts, 'id');
			$menu_cover=self::get_att($atts, 'cover');
			if( trim($arr[2][$k]) == '') continue;
			if($menu_cover!='false'){
				unset(self::$sub_menu[$menu_id]);
			}
			//一级
			self::$main_menu[$menu_id]['id']=$menu_id;
			self::$main_menu[$menu_id]['name']=$menu_name;
			//解析二级
			preg_match_all("#<node([^>]*)>(.*)</node>#sU", $arr[2][$k], $nodes);
			foreach ($nodes[1] as $n_k=>$n_atts){
				$n_atts = self::parse_atts($n_atts);
				$n_id	 = self::get_att($n_atts, 'id');
				$n_name  = self::get_att($n_atts, 'name');
				$n_url   = self::get_att($n_atts, 'url');
				$n_cover = self::get_att($n_atts, 'cover');
				if(empty($n_id)){
					if(isset(self::$sub_menu[$menu_id])){
						//计算出最大的n_id
						end(self::$sub_menu[$menu_id]);
						$menu = each(self::$sub_menu[$menu_id]);
						$n_id=$menu['key']+1;
					}else{
						$n_id=1;
					}
				}else{
					if($n_cover!='false'){
						unset(self::$sub_menu[$menu_id][$n_id]);
					}
				}
				self::$sub_menu[$menu_id][$n_id]['name']=$n_name;
				//处理三级
				preg_match_all("#<item([^>]*)/>#sU", $nodes[2][$n_k], $items);
				foreach ($items[1] as $i_k=>$i_atts){
					$i_atts = self::parse_atts($i_atts);
					$i_id = self::get_att($i_atts, 'id');
					$i_name = self::get_att($i_atts, 'name');
					$i_cover = self::get_att($i_atts, 'cover');
					$i_mod = self::get_att($i_atts, 'mod');
					$i_ac = self::get_att($i_atts, 'ac');
					//权限检测
					//if( !self::has_purview($i_mod, $i_ac) ){continue;}
					$i_url  = self::get_att($i_atts, 'url');
					if(empty($i_id)){
						self::$sub_menu[$menu_id][$n_id]['item'][]=array('url'=>$i_url,'name'=>$i_name);
					}else{
						self::$sub_menu[$menu_id][$n_id]['item'][$i_id]=array('url'=>$i_url,'name'=>$i_name);
					}
				}
			}
		}
	}
	/**
    * 检测用户是否有指定权限
    * @parem string $mod
    * @parem string $ac
    * @return bool
    */
	protected static function has_purview($mod, $ac)
	{
		$acc_modl = lib_access::get_instance();
		//***此选项仅针对915
		if( !isset($GLOBALS['_is_edit']) )
		{
			if( preg_match('/admin_(edit|admin)/', $acc_modl->fields['groups']) )
			{
				$GLOBALS['_is_edit'] = true;
			} else {
				$GLOBALS['_is_edit'] = false;
			}
		}
		if( $mod=='cms' && $ac=='cms' )
		{
			return $GLOBALS['_is_edit'];
		}
		//***
		$rs = $acc_modl->test_purview($mod, $ac, 2);
		if( $rs==1 )
		{
			return true;
		} else {
			return false;
		}
	}

	/**
    * 分析属性
    * @parem string $attstr
    * @return array
    */
	protected static function parse_atts($attstr)
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
    * 从属性数组中读取一个元素
    * @parem $atts
    * @parem $key
    * @parem $df = ''
    * @return string
    */
	protected function get_att(&$atts, $key, $df='')
	{
		return isset($atts[$key]) ? trim($atts[$key]) : $df;
	}
}
?>