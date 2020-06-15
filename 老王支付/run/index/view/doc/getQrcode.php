<?php
use xh\library\url;
?>
	<?php include_once (PATH_VIEW . 'common/header.php');?>
    <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">接口文档</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">文档</a></li>
                    <li class="active">发起支付请求</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">
          
 <p class="caption">扫码支付API文档</p>
 
        <!--Striped Table-->
            <div class="divider"></div>
            <p><b style="font-size:16px;">接口URL：</b><span style="color:green;"><?php echo URL_ROOT; ?>/gateway/index/checkpoint.do</span> </p>

            <div id="striped-table">
              
              <div class="row">
             
                <div class="col s12 m12 l12">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th>参数(POST)</th>
                        <th>说明</th>
                        <th>示例</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>account_id</td>
                        <td>商户ID、在平台首页可以获取</td>
                        <td>10000</td>
                      </tr>
                      <tr>
                        <td>content_type</td>
                        <td>请求过程中返回的网页类型，<b style="color:red;">text</b></td>
                        <td>json</td>
                      </tr>
                      <tr>
                        <td>thoroughfare</td>
                          <td>目前通道：wechat_auto（微信固码）、wechatdy_auto（微信固码店员模式）、wechatsj_auto（微信商户码模式）、wechatbank_auto（微信转银行卡）、alipay_auto（支付宝转账）、alipaygm_auto（支付宝固码）、alipayhongbao_auto（支付宝转红包）、lakala_auto（拉卡拉）、yunshanfu_auto（云闪付）、bank_auto（银行转账）、pdd_auto（拼多多商家固码）、nxyswx_auto（农信易扫 支付宝和微信）、nxysyl_auto（农信易扫 银联支付）、shouqianba_auto（收钱吧  type传10 支付宝 type传11 微信）、service_auto（服务版  type 传1微信固码 2支付宝转账模式和转红包（2选1） 3 支付宝转卡 4拉卡拉 5 云闪付 6 农信支付宝和微信 8 农信银联 9 微信店员 10微信商户 11微信转卡 12拼多多固码 13支付宝固码）</td>
                        <td>wechat_auto</td>
                      </tr>
                      <tr>
                        <td>type</td>
                        <td>支付类型，该参数在服务版（service_auto）和 其他几个支付模式下传参使用  （看 thoroughfare）</td>
                        <td>1</td>
                      </tr>
                      <tr>
                        <td>out_trade_no</td>
                        <td>订单信息，在发起订单时附加的信息，如用户名，充值订单号等字段参数</td>
                        <td>2018062668945</td>
                      </tr>
                      
                      <tr>
                        <td>robin</td>
                        <td>轮训，2：开启轮训   默认为2</td>
                        <td>2</td>
                      </tr>
                      
                      <tr>
                        <td>use_city</td>
                        <td>按地区收款 use_city 传1 时开通按地区收款，2为关闭</td>
                        <td>785D239777C4DE7739</td>
                      </tr>
                      
                      <tr>
                        <td>amount</td>
                        <td>支付金额，在发起时用户填写的支付金额</td>
                        <td>1.00</td>
                      </tr>
                      
                      
                      <tr>
                        <td>callback_url</td>
                          <td>异步通知地址，在支付完成时，本平台服务器系统会自动向该地址发起一条支付成功的回调请求, 对接方接收到回调后，<b>必须返回 <span style="color:red">success</span> ,否则默认为回调失败</b></td>
                        <td><?php echo URL_ROOT; ?>/index/index/callback.do</td>
                      </tr>
                      
                      
                      <tr>
                        <td>success_url</td>
                        <td>支付成功后网页自动跳转地址</td>
                        <td><?php echo URL_ROOT; ?>/index/doc/getQrcode.do</td>
                      </tr>
                      
                      
                      <tr>
                        <td>error_url</td>
                        <td>支付失败时，或支付超时后网页自动跳转地址</td>
                        <td><?php echo URL_ROOT; ?>/index/doc/getQrcode.do</td>
                      </tr>
                      
                      <tr>
                        <td>sign</td>
                        <td>签名算法，在支付时进行签名算法，详见<a href="<?php echo url::s("index/doc/sign");?>">《<?php echo WEB_NAME; ?>签名算法》</a></td>
                        <td>d92eff67b3be05f5e61502e96278d01b</td>
                      </tr>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!--Hoverable Table-->

 

          </div>


        </div>
        <!--end container-->
        
      </section>
      <!-- END CONTENT -->
      
      
      
</div></div>
            <div class="divider"></div>

            <!--Prefilling Text Inputs-->
      <script type="text/javascript">

      function reissue(id){
    	  swal({   title: "订单通知",   
              text: "手动补发也是需要扣除手续费,您是否要继续?",   
              type: "info",   showCancelButton: true,   
              closeOnConfirm: false,   
              showLoaderOnConfirm: true,
              confirmButtonText: "是的,我愿意承担手续费!"
               }, 
              function(){
              //开始请求微信登录
            	   $.get("<?php echo url::s('index/wechat/automaticReissue',"id=");?>" + id, function(result){
                  	 if(result.code == '200'){
                   			swal("微信提示", result.msg, "success");
    	              		setTimeout(function(){location.href = '';},1000);
        	              }else{
        	            	swal("订单通知", result.msg, "error");
        	             }
              		});
                  
         });
      }

      function trade_no(obj){
          location.href = "<?php echo url::s('index/wechat/automaticOrder',"sorting=trade_no&code=");?>" + $(obj).val();
          }

      function wechat(){
          var wechat = $('#wechat').val();
          console.log(wechat);
          location.href = "<?php echo url::s('index/wechat/automaticOrder',"sorting=wechat&code=");?>" + wechat;
          
          }

     
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   