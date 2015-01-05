<?php if(!defined('PATH_ROOT')){exit('Access Denied');}
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @package		E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\del.act.php
 * @author		bank
 * @link		http://www.wangyue.cc
 * @del.act.php
 * =================================================
*/
//删除操作
$op=request('op');
$id=request('id');
$idstr=(!empty($id) && is_array($id))?implode(',',$id):'';
if(empty($idstr)){
	show_message('操作成功','数据删除成功',-1);
}
//返回跳转
$gomod=request('gomod');
$goop=request('goop');
switch ($op){
	case 'activity'://删除活动
		lib_database::delete('seller_activity','aid in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'help':
		lib_database::delete('seller_guide','gid in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'user':
		lib_database::delete('users','uid in ('.$idstr.') and apps=\'seller\'');
		lib_database::delete('users_seller_fields','uid in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'log':
		$gos=request('s','');
		lib_database::delete('seller_changelog','lid in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop.'&s='.$gos;
		break;
	case 'goods':
		lib_database::delete('goods','id in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'album':
		lib_database::delete('goods','id in ('.$idstr.') and aid>0');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'special':
		lib_database::delete('goods','id in ('.$idstr.') and aid<0');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'try':
		lib_database::delete('try','id in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'exchange':
		lib_database::delete('exchange','id in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'report':
		lib_database::delete('goods_report','rid in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
	case 'reportgoods'://删除举报同时删除产品
		//删除图片
		lib_database::rquery('select pic from '.tname('goods').' where id in('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
				@unlink(PATH_ROOT.$value['pic'].'_290x190.jpg');
			}
		}
		lib_database::query('delete a,b from '.tname('goods_report').' as a left join '.tname('goods').' as b on a.gid=b.id where a.rid in('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
	case 'black'://删除黑名单
		lib_database::delete('blacklist','id in ('.$idstr.')');
		$gourl='&pmod='.$gomod.'&op='.$goop;
		break;
}
show_message('操作成功','数据删除成功',$_extend_url.$gourl);
/* End of file del.act.php */
/* Location: E:\wwwroot\taobaoke\xuanyu\extend\seller\admin\mod\del.act.php */