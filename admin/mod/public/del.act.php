<?php
/**
 * =================================================
 * @版权所有  网悦时代，并保留所有权利。
 * @网站地址: http://soft.wangyue.cc；
 * -------------------------------------------------
 * @这是一个商业软件！您只能在得到官方的授权才可对程序代码进行修改
 * @使用；不允许对程序代码以任何形式任何目的的再发布。
 * @del.act.php
 * =================================================
*/
if(!defined('PATH_ROOT')){
	exit('Access Denied');
}
$op=request('op');
$id=request('id');
$idstr=(!empty($id) && is_array($id))?implode(',',$id):'';
if(empty($idstr)){
	show_message('操作成功','数据删除成功',-1);
}
//返回跳转
$gomod=request('gomod');
$goac=request('goac');
$goop=request('goop');
switch ($op){
	case 'nav'://删除导航
		lib_database::delete('nav','id in ('.$idstr.')');
		//清除缓存
		del_cache('config','nav');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'page'://关键词管理
		lib_database::delete('seo','id in ('.$idstr.')');
		del_cache('config','seo');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'manager'://删除管理员
		if($user['apps']!=='admin'){
			show_message('操作失败','您没有权限',$gourl);
		}
		lib_database::delete('users','apps=\'admin\' and uid in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'user'://删除用户
		lib_database::delete('users','apps=\'home\' and uid in ('.$idstr.')');
		lib_database::delete('users_home_fields','uid in ('.$idstr.')');
		lib_database::delete('users_home_session','uid in ('.$idstr.')');
		lib_database::delete('users_addr','uid in ('.$idstr.')');
		lib_database::delete('users_changelog','uid in ('.$idstr.')');
		lib_database::delete('users_fav','uid in ('.$idstr.')');
		lib_database::delete('users_invitelog','tuid in ('.$idstr.')');//debug
		lib_database::delete('users_token','uid in ('.$idstr.')');
		lib_database::delete('comment','uid in ('.$idstr.')');
		lib_database::delete('applylog','uid in ('.$idstr.')');
		lib_database::delete('activating','uid in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'commit'://删除评论
		lib_database::delete('comment','cid in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'goods'://删除宝贝
		//删除图片
		lib_database::rquery('select pic from '.tname('goods').' where id in ('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
				@unlink(PATH_ROOT.$value['pic'].'_290x190.jpg');
			}
		}
		lib_database::query('delete a,b from '.tname('goods').' as a left join '.tname('urls').' as b on a.num_iid=b.iid where a.id in('.$idstr.')');
		//
		$gobid=request('gobid',0);
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop.'&bid='.$gobid;
		break;
	case 'type'://删除分类
		lib_database::delete('type','id in ('.$idstr.') OR pid in ('.$idstr.')');
		del_cache('help','cat');
		del_cache('goods','cat');
		del_cache('article','cat');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'try'://删除试用
		//删除图片
		lib_database::rquery('select pic from '.tname('try').' where id in('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
				@unlink(PATH_ROOT.$value['pic'].'_290x190.jpg');
			}
		}
		lib_database::query('delete a,b from '.tname('try').' as a left join '.tname('urls').' as b on a.num_iid=b.iid where a.id in('.$idstr.')');
		//lib_database::delete('try','id in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'exchange'://删除兑换
		//删除图片
		lib_database::rquery('select pic from '.tname('exchange').' where id in('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
				@unlink(PATH_ROOT.$value['pic'].'_290x190.jpg');
			}
		}
		lib_database::query('delete a,b from '.tname('exchange').' as a left join '.tname('urls').' as b on a.num_iid=b.iid where a.id in('.$idstr.')');
		//lib_database::delete('exchange','id in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'article'://删除文章
		lib_database::delete('article','id in ('.$idstr.')');
		del_cache('help','article');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'advertise'://广告删除
		//删除图片
		lib_database::rquery('select pic from '.tname('advertise').' where id in('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
			}
		}
		lib_database::delete('advertise','id in ('.$idstr.')');
		del_cache('advertise','ad');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'link'://删除友情链接
		//删除图片
		lib_database::rquery('select pic from '.tname('link').' where id in('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
			}
		}
		lib_database::delete('link','id in ('.$idstr.')');
		del_cache('advertise','link');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'black':
		lib_database::delete('blacklist','id in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'log'://删除记录
		$gomod=request('gomod');
		$goop=request('goop');
		lib_database::query('delete a,b from '.tname('applylog').' as a left join '.tname('comment').' as b on a.cid=b.cid where a.aid in('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'task'://删除采集规则
		lib_database::delete('task','tid in ('.$idstr.')');
		del_cache('task','task');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'report'://删除举报
		lib_database::delete('goods_report','rid in ('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
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
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	case 'brand'://删除品牌
		//删除图片
		lib_database::rquery('select logo,pic from '.tname('brand').' where bid in ('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['logo']) && check_img($value['logo'])){
				@unlink(PATH_ROOT.$value['logo']);
			}
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
			}
		}
		//lib_database::query('delete from '.tname('brand').' where bid in('.$idstr.')');
		//删除图片
		lib_database::rquery('select pic from '.tname('goods').' where channel='.brandNid().' and cat in('.$idstr.')');
		while ($value=lib_database::fetch_one()){
			if(!empty($value['pic']) && check_img($value['pic'])){
				@unlink(PATH_ROOT.$value['pic']);
				@unlink(PATH_ROOT.$value['pic'].'_290x190.jpg');
			}
		}
		lib_database::query('delete a,b,c from '.tname('brand').' as a left join '.tname('goods').' as b on a.bid=b.cat and b.channel='.brandNid().' left join '.tname('urls').' as c on b.num_iid=c.iid where a.bid in('.$idstr.')');
		//同时删除品牌下的商品
		//lib_database::query('delete from '.tname('goods').' where channel='.brandNid().' and cat in('.$idstr.')');
		$gourl='?mod='.$gomod.'&ac='.$goac.'&op='.$goop;
		break;
	default:
		$gourl=-1;
		break;
}
show_message('操作成功','数据删除成功',$gourl);
?>