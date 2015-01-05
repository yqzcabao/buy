-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_activating;
CREATE TABLE pre_activating (
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `uid` int(10) NOT NULL,
  `code` char(6) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  `type` enum('bind','forget','register') CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `email` (`email`,`uid`),
  KEY `uid` (`uid`),
  KEY `code` (`code`),
  KEY `addtime` (`addtime`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_advertise;
CREATE TABLE pre_advertise (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `height` varchar(5) NOT NULL,
  `width` varchar(5) NOT NULL,
  `top` smallint(3) NOT NULL DEFAULT '0',
  `bottom` smallint(3) NOT NULL DEFAULT '0',
  `left` smallint(3) NOT NULL DEFAULT '0',
  `right` smallint(3) NOT NULL DEFAULT '0',
  `content` text,
  `addtime` int(11) NOT NULL DEFAULT '0',
  `start` int(10) NOT NULL DEFAULT '0',
  `end` int(10) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_applylog;
CREATE TABLE pre_applylog (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `id` mediumint(8) NOT NULL,
  `idtype` enum('try','exchange','lottery') CHARACTER SET utf8 NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `uid` int(10) NOT NULL,
  `user_name` char(20) CHARACTER SET utf8 NOT NULL,
  `integration` mediumint(8) unsigned NOT NULL,
  `addtime` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `order` char(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `cid` (`cid`),
  KEY `id` (`id`),
  KEY `idtype` (`idtype`),
  KEY `uid` (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_article;
CREATE TABLE pre_article (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  `cid` mediumint(8) unsigned NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_blacklist;
CREATE TABLE pre_blacklist (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nick` char(80) CHARACTER SET utf8 NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_brand;
CREATE TABLE pre_brand (
  `bid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) CHARACTER SET utf8 NOT NULL,
  `preferential` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nick` varchar(20) CHARACTER SET utf8 NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `start` int(10) NOT NULL,
  `end` int(10) NOT NULL,
  `addtime` int(10) NOT NULL,
  `sort` smallint(3) NOT NULL,
  `sbid` mediumint(8) NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `addtime` (`addtime`),
  KEY `end` (`end`),
  KEY `start` (`start`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_comment;
CREATE TABLE pre_comment (
  `cid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(20) NOT NULL,
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` enum('goods','try','exchange','sun') NOT NULL DEFAULT 'goods',
  `authorid` mediumint(8) unsigned DEFAULT '0',
  `author` varchar(15) DEFAULT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `uid` (`uid`),
  KEY `id` (`id`),
  KEY `idtype` (`idtype`),
  KEY `authorid` (`authorid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_exchange;
CREATE TABLE pre_exchange (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `num` mediumint(6) unsigned NOT NULL,
  `needintegral` int(8) unsigned NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `apply` mediumint(6) unsigned NOT NULL,
  `sort` mediumint(6) unsigned NOT NULL,
  `nick` varchar(80) CHARACTER SET utf8 NOT NULL,
  `num_iid` bigint(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promotion_price` decimal(10,2) NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `site` enum('taobao','tmall') CHARACTER SET utf8 NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0',
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `pay_type` tinyint(1) NOT NULL DEFAULT '0',
  `pay_id` smallint(3) DEFAULT '0',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_serialno` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `start` (`start`),
  KEY `end` (`end`),
  KEY `sort` (`sort`),
  KEY `num_iid` (`num_iid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_goods;
CREATE TABLE pre_goods (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `channel` smallint(3) NOT NULL,
  `cat` smallint(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promotion_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `volume` int(10) NOT NULL,
  `nick` varchar(20) CHARACTER SET utf8 NOT NULL,
  `seller_id` int(10) NOT NULL,
  `site` enum('taobao','tmall') CHARACTER SET utf8 NOT NULL,
  `num_iid` bigint(11) unsigned NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `taopic` varchar(255) DEFAULT NULL,
  `taopicl` varchar(255) NOT NULL,
  `sort` mediumint(8) unsigned NOT NULL,
  `ispost` enum('1','-1') NOT NULL DEFAULT '-1',
  `isvip` enum('1','-1') NOT NULL DEFAULT '-1',
  `isrec` enum('1','-1') NOT NULL DEFAULT '-1',
  `issite` enum('-1','1') NOT NULL DEFAULT '-1',
  `uid` int(10) NOT NULL DEFAULT '0',
  `ispaigai` enum('1','-1') NOT NULL DEFAULT '-1',
  `issteal` enum('1','-1') NOT NULL DEFAULT '-1',
  `addtime` int(10) NOT NULL,
  `start` int(10) NOT NULL,
  `end` int(10) NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fav` mediumint(8) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `pay_type` tinyint(1) NOT NULL DEFAULT '0',
  `pay_id` smallint(3) DEFAULT '0',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_serialno` varchar(16) DEFAULT NULL,
  `aid` smallint(3) DEFAULT '0',
  `gid` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `num_iid` (`num_iid`),
  KEY `start` (`start`),
  KEY `end` (`end`),
  KEY `status` (`status`),
  KEY `volume` (`volume`),
  KEY `discount` (`discount`),
  KEY `promotion_price` (`promotion_price`),
  KEY `issite` (`issite`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_goods_apply;
CREATE TABLE pre_goods_apply (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `refusal` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` enum('goods','try','exchange') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_goods_report;
CREATE TABLE pre_goods_report (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) unsigned NOT NULL,
  `good` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nick` varchar(20) CHARACTER SET utf8 NOT NULL,
  `report` varchar(255) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `gid` (`gid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_link;
CREATE TABLE pre_link (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sort` smallint(3) NOT NULL,
  `isindex` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `isindex` (`isindex`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_nav;
CREATE TABLE pre_nav (
  `id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `url` text,
  `sort` int(5) NOT NULL DEFAULT '0',
  `hide` tinyint(1) NOT NULL DEFAULT '0',
  `target` tinyint(1) NOT NULL DEFAULT '0',
  `mod` varchar(20) DEFAULT NULL,
  `ac` varchar(20) DEFAULT NULL,
  `tag` varchar(20) DEFAULT NULL,
  `addtime` int(10) NOT NULL DEFAULT '0',
  `sys` tinyint(1) NOT NULL DEFAULT '0',
  `plugin` tinyint(1) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `hide` (`hide`),
  KEY `tag` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_plugin;
CREATE TABLE pre_plugin (
  `pluginid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `adminid` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `identifier` varchar(40) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  `modules` text NOT NULL,
  `version` varchar(20) NOT NULL DEFAULT '',
  `help` varchar(255) NOT NULL,
  PRIMARY KEY (`pluginid`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_plugin_uzsite_gpush;
CREATE TABLE pre_plugin_uzsite_gpush (
  `num_iid` bigint(11) NOT NULL,
  `addtime` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`num_iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_refuse;
CREATE TABLE pre_refuse (
  `rid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `id` mediumint(8) NOT NULL,
  `idtype` enum('goods','try','exchange') CHARACTER SET utf8 NOT NULL,
  `refuse` varchar(255) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`rid`),
  UNIQUE KEY `id` (`id`,`idtype`),
  KEY `idtype` (`idtype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_seo;
CREATE TABLE pre_seo (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `mod` varchar(10) NOT NULL,
  `ac` varchar(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `tag` text,
  `sys` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mod` (`mod`,`ac`),
  KEY `ac` (`ac`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_task;
CREATE TABLE pre_task (
  `tid` smallint(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nav` smallint(3) NOT NULL,
  `rule` text NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `nav` (`nav`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_try;
CREATE TABLE pre_try (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `num` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `needintegral` int(8) unsigned NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `apply` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `payment` mediumint(8) NOT NULL DEFAULT '0',
  `sort` mediumint(8) unsigned NOT NULL,
  `nick` varchar(80) CHARACTER SET utf8 NOT NULL,
  `num_iid` bigint(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promotion_price` decimal(10,2) NOT NULL,
  `site` enum('taobao','tmall') CHARACTER SET utf8 NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `pay_type` tinyint(1) NOT NULL DEFAULT '0',
  `pay_id` smallint(3) DEFAULT '0',
  `pay_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pay_serialno` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `num_iid` (`num_iid`),
  KEY `sort` (`sort`),
  KEY `uid` (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_type;
CREATE TABLE pre_type (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `pid` mediumint(6) DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `type` enum('article','goods') NOT NULL,
  `addtime` int(10) NOT NULL DEFAULT '0',
  `sys` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_type_gather;
CREATE TABLE pre_type_gather (
  `cid` mediumint(6) NOT NULL,
  `boutiquecat` text NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_urls;
CREATE TABLE pre_urls (
  `iid` bigint(18) NOT NULL AUTO_INCREMENT,
  `urls` text NOT NULL,
  PRIMARY KEY (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users;
CREATE TABLE pre_users (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `userpwd` char(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` char(11) NOT NULL,
  `apps` char(10) NOT NULL DEFAULT 'index',
  `groups` varchar(100) NOT NULL,
  `sta` tinyint(1) NOT NULL DEFAULT '0',
  `regtime` int(11) NOT NULL,
  `regip` varchar(15) NOT NULL,
  `logintime` int(10) unsigned NOT NULL,
  `loginip` varchar(15) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`apps`),
  KEY `user_name` (`user_name`),
  KEY `userpwd` (`userpwd`),
  KEY `email` (`email`),
  KEY `apps` (`apps`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_addr;
CREATE TABLE pre_users_addr (
  `uid` int(10) unsigned NOT NULL,
  `truename` varchar(20) CHARACTER SET utf8 NOT NULL,
  `province` varchar(50) CHARACTER SET utf8 NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `county` varchar(50) CHARACTER SET utf8 NOT NULL,
  `addr` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mobile` char(12) CHARACTER SET utf8 NOT NULL,
  `postcode` mediumint(6) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_changelog;
CREATE TABLE pre_users_changelog (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `integ` smallint(3) NOT NULL,
  `type` enum('sign','comment','sun','try','exchange','lottery','reward','other','admin') CHARACTER SET utf8 NOT NULL,
  `exp` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `uid` (`uid`),
  KEY `type` (`type`),
  KEY `integ` (`integ`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_fav;
CREATE TABLE pre_users_fav (
  `flog` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`flog`),
  UNIQUE KEY `uid` (`uid`,`gid`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_home_fields;
CREATE TABLE pre_users_home_fields (
  `uid` int(10) unsigned NOT NULL,
  `sign` mediumint(6) NOT NULL DEFAULT '0',
  `integral` mediumint(6) NOT NULL DEFAULT '0',
  `lastsign` int(10) NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` smallint(2) NOT NULL DEFAULT '0',
  `day` smallint(2) NOT NULL DEFAULT '0',
  `qq` char(11) DEFAULT NULL,
  `alipay` varchar(30) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `county` varchar(50) DEFAULT NULL,
  `tag` varchar(10) DEFAULT NULL,
  `perfect` tinyint(1) NOT NULL DEFAULT '0',
  `quick` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_home_session;
CREATE TABLE pre_users_home_session (
  `uid` int(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` char(11) NOT NULL,
  `apps` char(10) NOT NULL,
  `groups` varchar(100) NOT NULL,
  `sta` tinyint(1) NOT NULL,
  `regtime` int(10) NOT NULL,
  `regip` varchar(15) NOT NULL,
  `logintime` int(10) NOT NULL,
  `loginip` varchar(15) NOT NULL,
  `sign` mediumint(6) NOT NULL,
  `integral` mediumint(6) NOT NULL,
  `lastsign` int(10) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `year` smallint(4) NOT NULL,
  `month` smallint(2) NOT NULL,
  `day` smallint(2) NOT NULL,
  `qq` char(11) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `lastactivity` int(10) NOT NULL,
  `perfect` tinyint(1) NOT NULL DEFAULT '0',
  `quick` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_invitelog;
CREATE TABLE pre_users_invitelog (
  `ilog` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `usertag` varchar(10) CHARACTER SET utf8 NOT NULL,
  `tuid` int(10) unsigned NOT NULL,
  `tuser_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `addtime` int(10) NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 NOT NULL,
  `reward` mediumint(6) NOT NULL,
  PRIMARY KEY (`ilog`),
  KEY `usertag` (`usertag`),
  KEY `tuid` (`tuid`),
  KEY `tuser_name` (`tuser_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_purview;
CREATE TABLE pre_users_purview (
  `uid` int(11) NOT NULL,
  `purviews` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_qzone_fields;
CREATE TABLE pre_users_qzone_fields (
  `uid` int(10) unsigned NOT NULL,
  `sign` mediumint(6) NOT NULL DEFAULT '0',
  `integral` mediumint(6) NOT NULL DEFAULT '0',
  `lastsign` int(10) NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `figureurl` varchar(255) NOT NULL,
  `is_yellow_vip` tinyint(1) NOT NULL DEFAULT '0',
  `is_yellow_year_vip` tinyint(1) NOT NULL DEFAULT '0',
  `yellow_vip_level` tinyint(1) NOT NULL DEFAULT '0',
  `is_yellow_high_vip` tinyint(1) NOT NULL DEFAULT '0',
  `openid` char(32) NOT NULL,
  `addwidget` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_qzone_session;
CREATE TABLE pre_users_qzone_session (
  `uid` int(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` char(11) NOT NULL,
  `apps` char(10) NOT NULL,
  `groups` varchar(100) NOT NULL,
  `sta` tinyint(1) NOT NULL,
  `regtime` int(10) NOT NULL,
  `regip` varchar(15) NOT NULL,
  `logintime` int(10) NOT NULL,
  `loginip` varchar(15) NOT NULL,
  `sign` mediumint(6) NOT NULL,
  `integral` mediumint(6) NOT NULL,
  `lastsign` int(10) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `figureurl` varchar(255) NOT NULL,
  `is_yellow_vip` tinyint(1) NOT NULL DEFAULT '0',
  `is_yellow_year_vip` tinyint(1) NOT NULL DEFAULT '0',
  `yellow_vip_level` tinyint(1) NOT NULL DEFAULT '0',
  `is_yellow_high_vip` tinyint(1) NOT NULL DEFAULT '0',
  `openid` char(32) NOT NULL,
  `lastactivity` int(10) NOT NULL,
  `addwidget` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_users_token;
CREATE TABLE pre_users_token (
  `uid` int(10) NOT NULL,
  `apps` char(10) CHARACTER SET utf8 NOT NULL DEFAULT 'home',
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `token` tinytext CHARACTER SET utf8 NOT NULL,
  `api` enum('taobao','qq','sina') CHARACTER SET utf8 NOT NULL,
  `apiuid` varchar(32) CHARACTER SET utf8 NOT NULL,
  `hash` varchar(32) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `uid` (`uid`,`apps`,`api`),
  KEY `hash` (`hash`),
  KEY `api` (`api`),
  KEY `apiuid` (`apiuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
DROP TABLE IF EXISTS pre_webset;
CREATE TABLE pre_webset (
  `key` varchar(50) CHARACTER SET utf8 NOT NULL,
  `val` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;