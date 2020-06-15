<aside class="sidebar-menu fixed">
    <div class="sidebar-inner scrollable-sidebar">
        <div class="main-menu">
            <ul class="accordion">
                <li class="menu-header">
                    Main Menu
                </li>
                <li class="bg-palette1">
                    <a href="/">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
										<span class="text m-left-sm">平台首页</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-user fa-lg"></i>
									</span>
                    </a>
                </li>
                <li class="bg-palette2 <? if ($nav=='pay'){echo "active";}  ?>">
                    <a href="/index/home/order/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-share-alt fa-lg"></i></span>
										<span class="text m-left-sm">在线下单</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-share-alt fa-lg"></i>
									</span>
                    </a>
                </li>
                
				<li class="bg-palette3 <? if ($nav=='cz'){echo "active";}  ?>">
                    <a href="/index/home/pay/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-shopping-bag fa-lg"></i></span>
										<span class="text m-left-sm">余额充值</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-share-alt fa-lg"></i>
									</span>
					</a>
				</li>
                
                <? if ($site_isktfz==1) {?>
                                <li class="bg-palette4 <? if ($nav=='ktfz'){echo "active";}  ?>">
                    <a href="/index/home/ktfz/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-share-alt fa-lg"></i></span>
										<span class="text m-left-sm">搭建分站</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-share-alt fa-lg"></i>
									</span>
                    </a>
                </li>
                <? }?>
                                <li class="bg-palette2 <? if ($nav=='rmbjl'){echo "active";}  ?>">
                    <a href="/index/home/rmb_record/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-rmb fa-lg"></i></span>
										<span class="text m-left-sm">余额明细</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-rmb fa-lg"></i>
									</span>
                    </a>
                </li>
              
               
                  <li class="bg-palette3 <? if ($nav=='log'){echo "active";}  ?>">
                    <a href="/index/home/login_record/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-tasks fa-lg"></i></span>
										<span class="text m-left-sm">登录记录</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-tasks fa-lg"></i>
									</span>
                    </a>
                </li>
                 <? if (strpos($site_qx,'平台短信') !==false) { ?> 
                     <li class="bg-palette2 <? if ($nav=='message'){echo "active";}  ?>">
                    <a href="/index/home/message/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-rmb fa-lg"></i></span>
										<span class="text m-left-sm">平台短信</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-rmb fa-lg"></i>
									</span>
                    </a>
                </li>
     <? }?>  
                 <li class="bg-palette2 <? if ($nav=='dj'){echo "active";}  ?>">
                    <a href="/index/home/dj/id/<?=$_GET['id']?>.html">
									<span class="menu-content block">
										<span class="menu-icon"><i class="block fa fa-share-alt fa-lg"></i></span>
										<span class="text m-left-sm">代刷对接</span>
									</span>
									<span class="menu-content-hover block">
										<i class="block fa fa-share-alt fa-lg"></i>
									</span>
                    </a>
                </li>
                            
                                <marquee style="width: 238px; height: 135px;" scrollamount="2" direction="up" id="price_list"
                         behaviour="alternate"></marquee>
            </ul>
        </div>
    </div><!-- sidebar-inner -->
</aside>