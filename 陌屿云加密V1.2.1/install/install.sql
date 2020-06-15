DROP TABLE IF EXISTS `auth_config`;</explode>
CREATE TABLE `auth_config` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>
INSERT INTO `auth_config` VALUES ('title', '5G云授权系统');</explode>
INSERT INTO `auth_config` VALUES ('keywords', '陌屿云加密,高端的加密系统。');</explode>
INSERT INTO `auth_config` VALUES ('description', '5G云授权系统支持,服务器,虚拟主机,在线搭建。');</explode>
INSERT INTO `auth_config` VALUES ('sizekb', '50');</explode>
INSERT INTO `auth_config` VALUES ('gg', '授权最低20</br>授权商最低50</br>发现低于限制禁封处理');</explode>
INSERT INTO `auth_config` VALUES ('switch', '1');</explode>
INSERT INTO `auth_config` VALUES ('ipauth', '1');</explode>
INSERT INTO `auth_config` VALUES ('update', '1');</explode>
INSERT INTO `auth_config` VALUES ('addblock', '1');</explode>
INSERT INTO `auth_config` VALUES ('repair', '1');</explode>
INSERT INTO `auth_config` VALUES ('authfile', '/includes/authcode.php');</explode>
INSERT INTO `auth_config` VALUES ('qq', '570602783');</explode>
INSERT INTO `auth_config` VALUES ('version', '1006');</explode>
INSERT INTO `auth_config` VALUES ('ver', 'V9.5');</explode>
INSERT INTO `auth_config` VALUES ('content', '您的网站未授权！购买正版请联系QQ：570602783');</explode>
INSERT INTO `auth_config` VALUES ('uplog', '
v9.7</p>
1.修复不能禁封用户</p>
2.修复后台分页bug</p>
3.更换了全站模板</p>
4.修复不能自定义支付</p>');</explode>

DROP TABLE IF EXISTS `auth_user`;</explode>
CREATE TABLE `auth_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `auth_user`(`user`, `pass`) VALUES
('admin', '123456');</explode>

DROP TABLE IF EXISTS `auth_daili`;</explode>
CREATE TABLE `auth_daili` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `last` datetime DEFAULT NULL,
  `dlip` varchar(15) DEFAULT NULL,
  `per_tj` int(1) NOT NULL DEFAULT '1',
  `active` int(1) DEFAULT NULL,
  `citylist` varchar(150) DEFAULT NULL,
  `boss` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `auth_site`;</explode>
CREATE TABLE `auth_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `authcode` varchar(100) DEFAULT NULL,
  `sign` varchar(20) DEFAULT NULL,
  `syskey` varchar(40) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `daili` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `auth_block`;</explode>
create table `auth_block` (
  `url` varchar(150) NOT NULL,
  `authcode` varchar(100) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `auth_log`;</explode>
CREATE TABLE `auth_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(150) DEFAULT NULL,
  `type` varchar(20) NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `auth_down`;</explode>
CREATE TABLE `auth_down` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NULL,
  `authcode` varchar(100) NULL,
  `sign` varchar(100) NULL,
  `ip` varchar(20) DEFAULT NULL,
  `date` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>