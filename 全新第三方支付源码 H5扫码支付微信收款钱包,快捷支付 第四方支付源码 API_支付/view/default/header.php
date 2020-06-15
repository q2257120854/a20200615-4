<?php if(!defined( 'WY_ROOT'))exit; ?>
    <!doctype html>
    <html>
        
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo isset($title) ? $title. ' - ' : '' ?><?php echo $this->config['sitename']?><?php echo $this->config['siteinfo'] ? ' - '.$this->config['siteinfo'] : ''?>            </title>
            <meta name="description" content="<?php echo $this->config['description']?>">
            <meta name="keywords" content="<?php echo $this->config['keyword']?>">
<link rel="stylesheet" href="/static/default/bootstrap.min.css" />
<link rel="stylesheet" href="/static/default/swiper.min.css" />
<link rel="stylesheet" href="/static/default/animate.min.css" />
<link rel="stylesheet" href="/static/default/fontawesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="/static/default/style.css" />
</head>
<body class="m2body">
    
    <div id="hm_m0"></div>

        <div class="overlay"></div>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="offcanvas">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo">
                    <a href="/">
                        <img src="/static/default/images/logo.png" /></a>
                </div>
                <div class="serBox">
                  
              <!----          <?php if($this->session->get('login_username')):?>

                                    <li>
											<a rel="nofollow" href="/member" id="qc-btn">
                              
                                            进入商户中心
                                        </a>
                                    </li>
									
                                    <?php elseif($this->
                                        session->get('login_agentname')):?>
                                        <li>
											<a rel="nofollow" href="/agent" id="qc-btn">
                                             进入代理中心
                                            </a>
                                        </li>
                                        <?php else:?>
                                           
                                            <li>
                                                <a href="/login">
                                                    登录
                                                </a>
                                            </li>
											 <li>
											<a rel="nofollow" href="/register" id="qc-btn">
                                      
                                                    注册
                                                </a>
                                            </li>
											
                                            <?php endif;?>
											
											---->
                    </ul>
				  </div>
            </div>
            <div id="navbar" class="collapse navbar-collapse sidebar-offcanvas">
                <ul class="nav navbar-nav">
                    <li><a class="nav_a " target="_self" href="/">首页</a></li>
<li><a class="nav_a " target="_self" href="/a/solution/">解决方案</a>
					
					 <dl class="navLayer">
                           








                           <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/21/">互联网支付</a></dd>
						   
                           <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/22/">跨境支付</a></dd>
						   
                           <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/23/">预付卡业务</a></dd>

						   
						 </dl> 
                              
                    </li><li><a class="nav_a " target="_self" href="/a/prolist/">产品中心</a>
									
					 <dl class="navLayer">
           <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/21/">跨境电商</a></dd>
						   
                           <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/22/">生活服务</a></dd>
						   
                           <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/23/">传统外贸</a></dd>

						      <dd class="ellipsis"><a class="cor_bs" target="_self" href="/a/services/23/">游戏娱乐</a></dd>
						 </dl> 
                               
                    </li><li><a class="nav_a " target="_self" href="/a/services/">服务支持</a>
                                 
                    </li>
                    <li><a class="nav_a " target="_self" href="/a/about/">关于我们</a>
                            
                     </li>
                        
                </ul>
            </div>
        </div>
    </nav>
