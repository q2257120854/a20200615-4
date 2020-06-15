-- MySQL dump 10.13  Distrib 5.1.73, for unknown-linux-gnu (x86_64)
--
-- Host: localhost    Database: zpay1
-- ------------------------------------------------------
-- Server version	5.1.73-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `panel_log`
--

DROP TABLE IF EXISTS `panel_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panel_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_log`
--

LOCK TABLES `panel_log` WRITE;
/*!40000 ALTER TABLE `panel_log` DISABLE KEYS */;
INSERT INTO `panel_log` VALUES (1,1,'登录晓超云支付管理系统','2018-08-10 20:13:09','江西九江','IP:182.97.117.41'),(2,1000,'登录用户中心','2018-08-10 20:16:18','江西九江','182.97.117.41'),(3,1000,'登录用户中心','2018-08-10 20:20:12','江西九江','182.97.117.41'),(4,1000,'登录用户中心','2018-08-10 20:29:18','江西九江','182.97.117.41'),(5,1000,'登录用户中心','2018-08-10 20:54:35','江西九江','182.97.117.41');
/*!40000 ALTER TABLE `panel_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_user`
--

DROP TABLE IF EXISTS `panel_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `regtime` datetime DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_user`
--

LOCK TABLES `panel_user` WRITE;
/*!40000 ALTER TABLE `panel_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `panel_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_batch`
--

DROP TABLE IF EXISTS `pay_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_batch` (
  `batch` varchar(20) NOT NULL,
  `allmoney` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`batch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_batch`
--

LOCK TABLES `pay_batch` WRITE;
/*!40000 ALTER TABLE `pay_batch` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_batch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_order`
--

DROP TABLE IF EXISTS `pay_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_order` (
  `trade_no` varchar(64) NOT NULL,
  `out_trade_no` varchar(64) NOT NULL,
  `notify_url` varchar(64) DEFAULT NULL,
  `return_url` varchar(64) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `buyer` varchar(30) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `money` varchar(32) NOT NULL,
  `domain` varchar(32) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_order`
--

LOCK TABLES `pay_order` WRITE;
/*!40000 ALTER TABLE `pay_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_regcode`
--

DROP TABLE IF EXISTS `pay_regcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_regcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `trade_no` varchar(32) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_regcode`
--

LOCK TABLES `pay_regcode` WRITE;
/*!40000 ALTER TABLE `pay_regcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_regcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_settle`
--

DROP TABLE IF EXISTS `pay_settle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_settle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `username` varchar(10) NOT NULL,
  `account` varchar(32) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `transfer_status` int(1) NOT NULL DEFAULT '0',
  `transfer_result` varchar(64) DEFAULT NULL,
  `transfer_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_settle`
--

LOCK TABLES `pay_settle` WRITE;
/*!40000 ALTER TABLE `pay_settle` DISABLE KEYS */;
INSERT INTO `pay_settle` VALUES (1,1000,'20180810503',1,'晓超云','319773591@qq.com','8.96','1.00','2018-08-10 21:09:13',1,0,NULL,NULL);
/*!40000 ALTER TABLE `pay_settle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_user`
--

DROP TABLE IF EXISTS `pay_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `tid` int(11) DEFAULT '1000' COMMENT '推广者ID',
  `user` int(20) NOT NULL,
  `pass` varchar(266) NOT NULL,
  `zpass` varchar(255) NOT NULL COMMENT '支付密码',
  `key` varchar(32) NOT NULL,
  `rate` varchar(8) DEFAULT NULL,
  `alirate` int(10) NOT NULL,
  `qqrate` int(10) NOT NULL,
  `wxrate` int(10) NOT NULL,
  `account` varchar(32) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `alipay_uid` varchar(32) DEFAULT NULL,
  `qq_uid` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL,
  `alipay` int(3) NOT NULL DEFAULT '1',
  `wxpay` int(3) NOT NULL DEFAULT '1',
  `qqpay` int(3) NOT NULL DEFAULT '1',
  `settle_id` int(1) NOT NULL DEFAULT '1',
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `apply` int(1) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '推广佣金记录',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_user`
--

LOCK TABLES `pay_user` WRITE;
/*!40000 ALTER TABLE `pay_user` DISABLE KEYS */;
INSERT INTO `pay_user` VALUES (1000,NULL,NULL,123456,'e10adc3949ba59abbe56e057f20f883e','3a8da5ecb8a83037b164726fc4efda95','66YDZ4z6y62yLLh22ELgME9E696KgyvY','99',99,99,99,'zhuolini@qq.com','卓林','2088131203771991','E031B0AE828398F68B1586907DF3BAB7','0.00',1,1,1,1,'319773591@qq.com',NULL,'319773591','tx47.cn','2018-07-03 21:01:52',0,1,1,'0.00',1);
/*!40000 ALTER TABLE `pay_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zz_pay_config`
--

DROP TABLE IF EXISTS `zz_pay_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zz_pay_config` (
  `k` varchar(200) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zz_pay_config`
--

LOCK TABLES `zz_pay_config` WRITE;
/*!40000 ALTER TABLE `zz_pay_config` DISABLE KEYS */;
INSERT INTO `zz_pay_config` VALUES ('admin_pwd','70898114b252396ee336e9bcf74d9221'),('admin_user','admin'),('alipay_api','2'),('alipay_appid','2018051160121372'),('alirate','95'),('ali_api_key',''),('ali_api_partner',''),('ali_api_seller_email',''),('ali_close_info','暂时维护'),('ali_codepay_api_id',''),('ali_codepay_api_key',''),('ali_epay_api_id',''),('ali_epay_api_key',''),('ali_epay_api_url',''),('CAPTCHA_ID','d74296d795a6a0a04913e819e4a1176f'),('gg','欢迎使用卓林云支付'),('goods_lj','腾讯、QQ、刷钻、黑号、AV、会员、VIP、vip、svip、SVIP、小号、钻、会、刷、、超、云盘、cdk、CDK、CdK、测试商品、理论、名片赞、赞、名片、黄、赌、毒，Q币，话费充值，直播盒子，百度云盘，王者荣耀CDK，黄片、片、yunpan、博彩、私彩、苍井空、波多野结衣、马云、马化腾、雷军、钻、VPN、外挂、QVIP、SVIP、 轰、券、盘、靓号、烟、代刷、刷、svip、qvip、、会、超、HQ、砖、以及各种抽奖、一元夺宝、金融福利'),('goods_ljtis','您好！<div>您交易的商品是本平台的违禁词，<div>请联系网站管理员告知！<div>谢谢，祝您交易成功，生活圆满，财源滚滚来！</div><div>晓超云支付</div>'),('is_payreg','1'),('is_reg','1'),('local_domain','tx47.cn'),('mail_apikey',''),('mail_apiuser',''),('mail_cloud','0'),('mail_name','pay@izhuolin.cn'),('mail_port','465'),('mail_pwd','pay.izhuolin.cn'),('mail_smtp','smtp.exmail.qq.com'),('money_rate','97'),('payer_show_name','晓超云支付'),('PRIVATE_KEY','5e3dac8e02cc7e3f21db63bc759238f2'),('qqpay_api','1'),('qqrate','95'),('qq_api_mchid',''),('qq_api_mchkey',''),('qq_close_info','QQ钱包暂时维护'),('qq_codepay_api_id',''),('qq_codepay_api_key',''),('qq_epay_api_id',''),('qq_epay_api_key',''),('qq_epay_api_url',''),('quicklogin','2'),('reg_pid','1000'),('reg_price','50'),('settle_fee_max','50'),('settle_fee_min','1'),('settle_money','5'),('settle_open','1'),('settle_rate','0.05'),('sms_appkey',''),('stype_1','1'),('stype_2','0'),('stype_3','1'),('stype_4','1'),('submit','保存修改'),('verifytype','0'),('web_name','晓超云支付'),('web_qq','1874694903'),('wxpay_api','2'),('wxrate','95'),('wxtransfer_desc','晓超云支付平台自动结算'),('wx_api_appid',''),('wx_api_appsecret',''),('wx_api_key',''),('wx_api_mchid',''),('wx_close_info','微信支付暂时维护'),('wx_codepay_api_id','27891'),('wx_codepay_api_key','eX5f916itno60QYJiH592Y2v1vHC9'),('wx_epay_api_id',''),('wx_epay_api_key',''),('wx_epay_api_url','');
/*!40000 ALTER TABLE `zz_pay_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-10 22:08:27
