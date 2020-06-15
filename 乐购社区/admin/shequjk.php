<?php 
$title='社区监控';
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'shequjk';


 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#s_pic').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_pic').val(url);
				editor.hideDialog();
				}
			});
		});
	});
	 
});

 </script>	

    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
 <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-10">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        社区价格监控  - <a href="/api/PC.exe"  
                                    class="btn-xs btn-danger">监控下载</a>


                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form-config">
                          
                         <div class="alert alert-info"  style="color: red" >监控只支持亿乐/玖伍社区类型，可以实现自动修改商品价格。使用前请先设置好对接信息！（在线监控软件填写地址 可以从 本页获取监控地址）</div>
                         
                         <div class="alert alert-success" style="color:#06F" id="jkdz" >监控地址：<br><a style="color:#06F">http://<?=$_SERVER['HTTP_HOST']?>/ajax.php?act=pricejk&amp;key=<?=$site_jkms?></a></div>
                         
                         <div class="alert alert-warning" style="color:#06F" >监控说明：频率10到60分钟一次即可，只能在一个地方监控，千万不要多节点监控或在多处监控，否则会导致数据错乱。</div>
                         
                             <div class="form-group">
                               
                                                 
 
                                            
                                            
                                             <label class="col-lg-3 control-label">监控密钥</label>
                                <div class="col-lg-8">
                                
                                <div class="input-group"><input name="code" id="code" type="text" placeholder=""    value="<?=$site_jkms?>"  class="form-control"> <div class="input-group-btn"><button  onclick="hq();" type="button" data-id="lb_img_1" class="btn btn-success no-shadow upload_btn">生成
                                            </button></div></div>
                                            
                               
                                　　　　　 


</div>　 
                            </div>
                          
                          
                              <div class="form-group">
                           <label class="col-lg-3 control-label">选择要监控的商品分类</label>
                                <div class="col-lg-8">
  <select name="pricejk_cid[]" multiple="multiple" class="form-control" style="height:100px;">
  <?php
						 
									$sql = 'select * from '.flag.'shop_channel  where zid = '.$zhu_id.' order by corder desc , ID desc';
								$result = mysql_query($sql);
								$i=0;
							while($row= mysql_fetch_array($result)){
$i=$i+1;
 							?>
    <option value="<?=$row['ID']?>"<? if (in_array($row['ID'],$site_jkcid)) {echo "selected";}?>><?=$row['name']?></option>
      <? }?>
  </select>
	  <font color="green">按住Ctrl键可多选</font>


                                </div>
                            </div>

                          
                          
                          
                                                    </form>
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-info pull-right" @click="save('config','jiankong')">
                            <i class="iconfont"></i> 确定
                        </a>
                    </div>
                </div></div>
       
        
        
        
          
                </div>
            </div>
        </div>
        
    </div>
  <? include_once('footer.php');
?>
 <script>
      new Vue({
        el: '#vue',
        data: {},
        methods: {
          save: function (id,act) {
            var vm = this;
            this.$post("ajax.php?act="+act+"", $("#form-" + id).serialize())
              .then(function (data) {
                if (data.code === 0) {
                  vm.$message(data.message, 'success');
                } else {
                  vm.$message(data.message, 'error');
                }
              });
          }
        },
        mounted: function () {
        }
      });
	  
	  
	   function randomPassword(size)
{
  var seed = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z',
  'a','b','c','d','e','f','g','h','i','j','k','m','n','p','Q','r','s','t','u','v','w','x','y','z',
  '2','3','4','5','6','7','8','9'
  );//数组
  seedlength = seed.length;//数组长度
  var createPassword = '';
  for (i=0;i<size;i++) {
    j = Math.floor(Math.random()*seedlength);
    createPassword += seed[j];
  }
  return createPassword;
}



	  　　function hq(){
　　　　　　//声明一个随机数变量，默认为1
　　　　　　var GetRandomn = 1;
　　　　　　//js生成时间戳
　　　　　　var timestamp=new Date().getTime();
　　　　　　//获取随机范围内数值的函数
　　　　　　　　function GetRandom(n){
　　　　　　　　//由随机数+时间戳+1组成
　　　　　　　　GetRandomn=Math.floor(Math.random()*n+timestamp+1);
　　　　　　　　}
　　　　　　//开始调用，获得一个1-100的随机数
　　　　　　GetRandom("30");
　　　　　　//把随机数GetRandomn 赋给 input文本框.根据input的id
　　　　　　document.getElementById('code').value = randomPassword(32);
　　　　　　//调试输出查看
　　　　　　//alert(GetRandomn);
　　　　　　}

    </script>
</body>
</html>
