<?

             mysql_select_db($w_db,$conn);
 
	
	
	  //分站版本
            $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."fname` (
                       `f_name` LONGTEXT NOT NULL,
                       `f_point` DOUBLE NOT NULL
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."fname` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
					  $sql1[]=" INSERT INTO `".flag."fname` (`f_name`,`f_point`,`ID`) VALUES ('普及版','999','1');";
					  $sql1[]=" INSERT INTO `".flag."fname` (`f_name`,`f_point`,`ID`) VALUES ('专业版','999','2');";
					  $sql1[]=" INSERT INTO `".flag."fname` (`f_name`,`f_point`,`ID`) VALUES ('股东版','999','3');";

		      
			    //分站列表
            $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."fenzhan` (
                       `f_id` int NOT NULL,
                       `f_name` LONGTEXT NOT NULL,
                       `f_url` LONGTEXT NOT NULL,
                       `f_domain` LONGTEXT NOT NULL,

                       `f_user` LONGTEXT NOT NULL,
                       `f_password` LONGTEXT NOT NULL,
                       `f_qq` LONGTEXT NOT NULL,
                       `f_point` DOUBLE NOT NULL,
                       `f_skin` LONGTEXT  NULL,
                       `f_logo` LONGTEXT  NULL,
                        `f_sname` LONGTEXT  NULL,
                       `f_tcgg` LONGTEXT  NULL,
                       `f_key` LONGTEXT  NULL,
                       `f_des` LONGTEXT  NULL,
                       `f_bq` LONGTEXT  NULL,
                       `f_db` LONGTEXT  NULL,
                       `f_skfs` LONGTEXT  NULL,
                       `f_skzh` LONGTEXT  NULL,
                       `f_skxm` LONGTEXT  NULL,
                       `f_sxf` int  NULL,
                       `f_topcolor` LONGTEXT  NULL,
                       `f_endcolor` LONGTEXT  NULL,
                       `f_bj` LONGTEXT  NULL,
					   
                       `f_mid` int  NULL,
                       `f_mpoint1` DOUBLE  NULL,
                       `f_mpoint2` DOUBLE  NULL,
                       `f_mpoint3` DOUBLE  NULL,
                       `f_mpoint4` DOUBLE  NULL,
                       `f_mpoint5` DOUBLE  NULL,
 
                        `f_date` datetime NOT NULL

                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."fenzhan` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
					 

 	    //分站资金记录
            $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."fenzhanxfjl` (
                       `xf_fid` int NOT NULL,
                       `xf_qpoint` DOUBLE NOT NULL,
                       `xf_point` LONGTEXT NOT NULL,
                       `xf_hpoint` LONGTEXT NOT NULL,
                       `xf_qk` LONGTEXT NOT NULL,
                       `xf_lx` int NOT NULL,
                        `xf_date` datetime NOT NULL

                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."fenzhanxfjl` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
			 	    //分站提现记录
            $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."fenzhantxjl` (
                       `tx_fid` int NOT NULL,
                       `tx_je` DOUBLE NOT NULL,
                       `tx_sxf` DOUBLE  NULL,
                       `tx_date` datetime NOT NULL,
                       `tx_cdate` datetime  NULL,
                       `tx_zt` int  NULL,
                       `tx_qk` LONGTEXT  NULL
 
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."fenzhantxjl` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
					 		 
 
					
 

   //升级记录
            $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."updatejl` (
                       `u_hid` int NOT NULL,
                       `u_ylevel` LONGTEXT NOT NULL,
                       `u_xlevel` LONGTEXT NOT NULL,
                       `u_point` DOUBLE  NULL,
                       `f_id` int  NULL,
                       `u_date` datetime NULL

                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."updatejl` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
 
 
   //一卡通
            $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."kami` (
                       `k_key` LONGTEXT NOT NULL,
                       `k_point` DOUOBLE NOT NULL,
                       `k_hid` int  NULL,
                       `k_cdate` datetime  NULL,
                        `k_zt`  int  NULL,
                       `k_date` datetime  NULL,
                         `f_id` int  NULL
 
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."kami` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
 

  					
					
					
			//系统设置		 
  					
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."system` (
                        `s_skin` text NULL,
                        `s_logo` varchar(255) NOT NULL,
                       `s_name` varchar(255) NOT NULL,
                       `s_sname` varchar(255) NOT NULL,
                       `s_key` varchar(255) NOT NULL,
                       `s_des` varchar(255) NOT NULL,
                        `s_content` LONGTEXT  NULL,
                        `s_content1` LONGTEXT  NULL,
                        `s_gg` LONGTEXT  NULL,
                         `s_mid` int  NULL,
                         `s_mpoint1` DOUBLE  NULL,
                         `s_mpoint2` DOUBLE  NULL,
                         `s_mpoint3` DOUBLE  NULL,
                         `s_mpoint4` DOUBLE  NULL,
                         `s_mpoint5` DOUBLE  NULL,
                         `s_topcolor` LONGTEXT  NULL,
                         `s_endcolor` LONGTEXT  NULL,
                         `s_bj` LONGTEXT  NULL,

                       `f_id` int  NULL
 
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."system` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
		 
		  $sql1[]=" INSERT INTO `".$w_db."`.`".flag."system` (`s_skin`,`s_logo`, `s_name`, `s_sname`, `s_key`, `s_des`, `s_content` ,`f_id`,`ID`) VALUES ('01','/images/logo.jpg', '超会系统', '超会社区系统', '超会社区系统', '超会社区系统', '版权所有 @超会',0, '1');";
				
				
							//模板管理		 
  					
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."template` (
                        `t_name` text NULL,
                        `t_path` LONGTEXT  NULL 
 
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."template` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
		 
		  $sql1[]=" INSERT INTO `".$w_db."`.`".flag."template` (`t_name`,`t_path`,`ID`) VALUES ('默认','01', '1');";
				
				
								
			//会员等级		 
  					
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."member_level` (
                        `l_name` LONGTEXT NULL,
                        `f_id` LONGTEXT NULL
   
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."member_level` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
		           $sql1[]=" INSERT INTO `".$w_db."`.`".flag."member_level` (`l_name` ,`f_id`,`ID`) VALUES ('普通会员',0,'1');";
		           $sql1[]=" INSERT INTO `".$w_db."`.`".flag."member_level` (`l_name` ,`f_id`,`ID`) VALUES ('中级会员',0,'2');";
		           $sql1[]=" INSERT INTO `".$w_db."`.`".flag."member_level` (`l_name` ,`f_id`,`ID`) VALUES ('高级会员',0,'3');";
		           $sql1[]=" INSERT INTO `".$w_db."`.`".flag."member_level` (`l_name` ,`f_id`,`ID`) VALUES ('钻石会员',0,'4');";
		           $sql1[]=" INSERT INTO `".$w_db."`.`".flag."member_level` (`l_name` ,`f_id`,`ID`) VALUES ('顶级会员',0,'5');";


			//会员管理		 
  					
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."member` (
                        `m_name` LONGTEXT NULL,
                        `m_password` LONGTEXT NULL,
                        `m_qq` LONGTEXT NULL,
                        `m_point` DOUBLE NULL,
                        `m_level` int NULL,
                        `m_fid` int NULL,
                         `m_date` datetime NULL
  
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."member` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
				 
 				
				
						//会员登录日志		 
  					
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."login_log` (
                        `hyname` LONGTEXT NULL,
                        `hyid` int NULL,
                        `l_ip` LONGTEXT NULL,
                        `l_date` datetime NULL,
                        `l_qk` LONGTEXT NULL
   
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."login_log` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
 				
				
					
								//价格模板		 
  					
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."price` (
                        `p_name` LONGTEXT NULL,
                        `p_level1` DOUBLE NULL,
                        `p_level2` DOUBLE NULL,
                        `p_level3` DOUBLE NULL,
                        `p_level4` DOUBLE NULL,
                        `p_level5` DOUBLE NULL,
                        `f_id` int  NULL,
                        `p_date` datetime NULL
  
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."price` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
				 //商品分类
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."shop_channel` (
                       `c_name` varchar(255)  NULL,
                       `c_order` int  NULL,
                       `c_zt` int  NULL,
                       `c_date` datetime  NULL
					   
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."shop_channel` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";			
					
					 //商品管理
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."shop` (
                       `s_pid` int  NULL,
                         `s_xid` int  NULL,
                        `s_cid` int  NULL,
                       `s_bd` int  NULL,
                       `s_tk` int  NULL,
                       `s_dnum` int  NULL,
                       `s_gnum` int  NULL,
                         `s_name` varchar(255)  NULL,
                        `s_unit` varchar(255)  NULL,
                         `s_content` LONGTEXT NULL,
                        `s_pic` varchar(255)  NULL,
                       `s_price` DOUBLE  NULL,
                       `s_fprice1` DOUBLE  NULL,
                       `s_fprice2` DOUBLE  NULL,
                       `s_fprice3` DOUBLE  NULL,
                        `s_order` int  NULL,
                       `s_zt` int  NULL,
                        `s_durl` LONGTEXT  NULL,
                        `s_dzt` int  NULL,
 
                       `s_did` int  NULL,
                       `s_dsid` int  NULL,
                       `s_dtype` int  NULL,
                        `s_dname` LONGTEXT  NULL,
                       `s_dpassword` LONGTEXT  NULL,
                       `s_dnumber` LONGTEXT  NULL,
                       `s_dwen_1` LONGTEXT  NULL,
                       `s_dwen_2` LONGTEXT  NULL,
                       `s_dwen_3` LONGTEXT  NULL,
                       `s_dmima_1` LONGTEXT  NULL,
                       `s_dmima_2` LONGTEXT  NULL,
                       `s_dmima_3` LONGTEXT  NULL,
                       `s_dbeizhu_1` LONGTEXT  NULL,
                       `s_dbeizhu_2` LONGTEXT  NULL,
                       `s_dbeizhu_3` LONGTEXT  NULL,
                       `s_dsqlx` int  NULL,
                       `s_dzt1` int  NULL,
 					   
                       `s_date` datetime  NULL
                       ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."shop` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";		
					
					 //分站商品定价
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."fshop` (
                       `f_sid` int  NULL,
                       `f_spid` int  NULL,
                       `f_id` int  NULL
                        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."fshop` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";				
         
  //模板风格
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."templet` (
                       `t_name` varchar(255)  NULL,
                       `t_url` varchar(255)  NULL,
                       `f_id` int  NULL,
                 
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."templet` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
         
      $sql1[]=" INSERT INTO `".$w_db."`.`".flag."templet` (`t_name`,`t_url`, `ID`) VALUES ('默认风格','01', '1');";



	 //充值记录
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."czjl` (
                       `f_id` int  NULL,
                       `hyid` int  NULL,
                       `hyname` LONGTEXT  NULL,
                       `cz_je` DOUBLE  NULL,
                       `cz_sxf` DOUBLE  NULL,
                        `cz_qk` LONGTEXT  NULL,
                        `cz_jyh` LONGTEXT  NULL,

                       `cz_zt` int  NULL,
                       `cz_date` datetime  NULL,
                       `cz_pdate` datetime  NULL
					   
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."czjl` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";			
		  
		  

		 		 //消费记录
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."xfjl` (
                       `f_id` int  NULL,
                       `hyid` int  NULL,
                       `hyname` LONGTEXT  NULL,
                       `xf_qje` DOUBLE  NULL,
                       `xf_je` DOUBLE  NULL,
                       `xf_hje` DOUBLE  NULL,
                       `xf_qk` LONGTEXT  NULL,
                       `xf_lx` int  NULL,
                         `xf_date` datetime  NULL
					   
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."xfjl` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";			
		  
		  
		  		 		 //订单记录
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."order` (
                        `o_id` LONGTEXT  NULL,
                       `o_sid` int  NULL,
                       `o_sname` LONGTEXT  NULL,
                       `o_hid` int  NULL,
                       `o_hyname` LONGTEXT  NULL,

					   `o_wen_name1` LONGTEXT  NULL,
					   `o_wen_1` LONGTEXT  NULL,
					   `o_wen_name2` LONGTEXT  NULL,
                       `o_wen_2` LONGTEXT  NULL,
					   `o_wen_name3` LONGTEXT  NULL,
                       `o_wen_3` LONGTEXT  NULL,

					   `o_mima_name1` LONGTEXT  NULL,
					   `o_mima_1` LONGTEXT  NULL,
					   `o_mima_name2` LONGTEXT  NULL,
                       `o_mima_2` LONGTEXT  NULL,
					   `o_mima_name3` LONGTEXT  NULL,
                       `o_mima_3` LONGTEXT  NULL,
 

					   `o_beizhu_name1` LONGTEXT  NULL,
					   `o_beizhu_1` LONGTEXT  NULL,
					   `o_beizhu_name2` LONGTEXT  NULL,
                       `o_beizhu_2` LONGTEXT  NULL,
					   `o_beizhu_name3` LONGTEXT  NULL,
                       `o_beizhu_3` LONGTEXT  NULL,
                       `o_xnum` int  NULL,
                       `o_price` DOUBLE  NULL,
                       `o_zt` int  NULL,
                       `o_memo` LONGTEXT  NULL,
                       `o_dzt` LONGTEXT  NULL,
                       `f_id` int  NULL,
                       `o_date` datetime  NULL 
                     
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."order` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";			
		  
		  
		 		 //客服管理
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."kefu` (
                        `k_name` LONGTEXT  NULL,
                        `k_qq` LONGTEXT  NULL,
                        `k_order` int  NULL,
                        `f_id` int  NULL,
                         `k_date` datetime  NULL
					   
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."kefu` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";			


		 		 //下单模板
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."xiadan` (
                        `x_name` LONGTEXT  NULL,
                        `wen_1` int  NULL,
                        `wen_2` int  NULL,
                        `wen_3` int  NULL,
                        `mima_1` int  NULL,
                        `mima_2` int  NULL,
                        `mima_3` int  NULL,
                        `beizhu_1` int  NULL,
                        `beizhu_2` int  NULL,
                        `beizhu_3` int  NULL,
                        `wen_name1` LONGTEXT  NULL,
                        `wen_name2` LONGTEXT  NULL,
                        `wen_name3` LONGTEXT  NULL,
                        `mima_name1` LONGTEXT  NULL,
                        `mima_name2` LONGTEXT  NULL,
                        `mima_name3` LONGTEXT  NULL,
                        `beizhu_name1` LONGTEXT  NULL,
                        `beizhu_name2` LONGTEXT  NULL,
                        `beizhu_name3` LONGTEXT  NULL 

 					   
                      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."xiadan` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";			
		  
          
  //后台登录日志
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."log` (
                        `l_name` varchar(255)  NULL,
                        `l_qk` LONGTEXT  NULL,
                        `l_ip` varchar(255)  NULL,
                        `f_id` int NOT  NULL,
                         `l_date` datetime  NULL
                
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."log` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
         
	 
		 //公告管理
 			
                    $sql1[]="CREATE TABLE IF NOT EXISTS `".flag."notice` (
                        `n_content` LONGTEXT  NULL,
                        `n_order` int  NULL,
                        `f_id` int  NULL,
                         `n_date` datetime  NULL
                
                     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
           $sql1[]=" ALTER TABLE  `".flag."notice` ADD  `ID` INT NOT NULL AUTO_INCREMENT ,
                    ADD PRIMARY KEY (  `ID` )    ;   ";
					
					
					      $sql1[]=" alter   table   `".flag."member`   auto_increment   =   10000;  ";
					      $sql1[]=" alter   table   `".flag."fenzhan`   auto_increment   =   1000;  ";
         
   					

            foreach ($sql1 as $value) {//由于mysql1_query不支持一次性执行多条语句，所以用for循环遍历
                mysql_query($value);
            }
			
			?>