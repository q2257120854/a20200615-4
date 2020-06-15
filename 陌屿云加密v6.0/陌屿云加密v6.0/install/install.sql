SET FOREIGN_KEY_CHECKS=0;</explode>
DROP TABLE IF EXISTS `moyu_config`;</explode>
CREATE TABLE `moyu_config` (
  `k` varchar(255) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>
INSERT INTO `moyu_config` VALUES ('admin_user', 'admin');</explode>
INSERT INTO `moyu_config` VALUES ('admin_pwd', '123456');</explode>
INSERT INTO `moyu_config` VALUES ('title', '陌屿云加密');</explode>
INSERT INTO `moyu_config` VALUES ('zzqq', '2763994904');</explode>
INSERT INTO `moyu_config` VALUES ('modal', '欢迎使用陌屿PHP加密系统<p>有问题加入我们的官方群：777824195');</explode>
INSERT INTO `moyu_config` VALUES ('keywords', '陌屿云加密系统,代码安全保护,在线加密完美系统');</explode>
INSERT INTO `moyu_config` VALUES ('description', '陌屿云加密系统,可以虚拟主机搭建,服务器安全运行！');</explode>
INSERT INTO `moyu_config` VALUES ('smtpmail', '2763994904@qq.com');</explode>
INSERT INTO `moyu_config` VALUES ('smtpfwq', 'smtp.qq.com');</explode>
INSERT INTO `moyu_config` VALUES ('smtpdk', '465');</explode>
INSERT INTO `moyu_config` VALUES ('smtpuser', '2763994904');</explode>
INSERT INTO `moyu_config` VALUES ('smtppass', 'mraigyubhbdefd');</explode>
INSERT INTO `moyu_config` VALUES ('smtpname', '陌屿云加密');</explode>
INSERT INTO `moyu_config` VALUES ('submit', '修改');</explode>

DROP TABLE IF EXISTS `moyu_dl`;</explode>
CREATE TABLE `moyu_dl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dl_user` varchar(30) DEFAULT NULL,
  `dl_pwd` varchar(30) DEFAULT NULL,
  `dl_qq` varchar(30) DEFAULT NULL,
  `dl_money` float DEFAULT NULL,
  `dl_sta` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `moyu_notice`;</explode>
CREATE TABLE `moyu_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `center` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>