<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>接口文档-<?=$site_name?>
    </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet">
         <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css">
         <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css">
         <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
         <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
		
		
    </style>
    
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

<div class="an-content-body" style="padding: 8px" id="pjax-container">
    <div id="vue">
        <div class="row">
            <div class="an-helper-block">
                <div class="an-small-doc-blcok  warning"><font color="red">
                            友情提示：本接口适用于所有彩虹代刷网对接。<br>1、自动提交到社区/卡盟(需要使用插件或者选择玖伍，便捷)<a href='https://www.lanzous.com/ialkrle'>点我下载</a>
    
                            <br>
                            2、使用 自定义访问URL/POST 进行对接(不需要使用插件)
                         </font>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">彩虹代刷网对接</div>
                    <div class="panel-body">
                        <div class="list-group-item list-group-item-warning">对接模式：
                            <select onchange="getduijie()" name="moshi" id="moshi">
                                <option value="0" data-port="">自动提交到社区/卡盟</option>
                                <option value="1">自定义访问URL/POST</option>
                            </select>
                        </div>
                        <div id="duijie1" style="display: block;">
                            <div class="list-group-item list-group-item-info">网站类型：
                                <select onchange="gettype()" name="type" id="type" style="height: 20px;">
								<option value="jiuwu"   data-port='80'>玖五系统/余额下单</option>
                      <option value="20">聚梦社区</option>
                         <option value="20">追梦社区</option>
                                </select>
                            </div>
                            <div class="list-group-item list-group-item-info">网站域名：<font id="domain"><?=$dq_url?>:80</font>  <a onclick="copyneirong('domain','网站域名')" class="btn-sm btn-success">一键复制</a>
                            </div>
                            <div class="list-group-item list-group-item-info">登录账号： <font id="tokenid"><?=$member_name?></font>  <a onclick="copyneirong('tokenid','登录账号')" class="btn-sm btn-success">一键复制</a>
                            </div>
                            <div class="list-group-item list-group-item-info">登录密码: <font id="tokenkey"><?=$member_password?></font>  <a onclick="copyneirong('tokenkey','登录密码')" class="btn-sm btn-success">一键复制</a>   </div>

                            </div>
                        </div>
                        <div id="duijie2" style="display: none;">
                            <div class="list-group-item list-group-item-info">URL：<font id="apiurl">http://<?=$dq_url?>/api.php</font>  <a onclick="copyneirong('apiurl','URL')" class="btn-sm btn-warning">一键复制</a>
                            </div>
                            <div class="list-group-item list-group-item-info"> <?php
if ($key1 != '') {
    $caihongcanshu1 = '&' . $key1 . '=[input]';
}
if ($key2 != '') {
    $caihongcanshu2 = '&' . $key2 . '=[input2]';
}
if ($key3 != '') {
    $caihongcanshu3 = '&' . $key3 . '=[input3]';
}
if ($key4 != '') {
    $caihongcanshu4 = '&' . $key4 . '=[input4]';
}
$caihongcanshu = $caihongcanshu1 . $caihongcanshu2 . $caihongcanshu3 . $caihongcanshu4;
?>
                        POST：<font id="post">api_user=<?=$member_name?>&api_pwd=<?=$member_password?>&sid=<?=$_GET['id']?>&num=[num]<?=$caihongcanshu?></font>  <a onclick="copyneirong('post','POST')" class="btn-sm btn-warning">一键复制</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div><!-- /main-container -->
 <script type="text/javascript">
       function getduijie(){
        var moshi =document.getElementById('moshi').value;
 
    if (moshi==0)
        {  document.getElementById('duijie1').style.display="block"; document.getElementById('duijie2').style.display="none";}
    
    if (moshi==1)
        {  document.getElementById('duijie1').style.display="none"; document.getElementById('duijie2').style.display="block";}
    
          }
		  

    </script>
<script>
      function copyArticle(event) {
        const range = document.createRange();
        range.selectNode(document.getElementById('post'));
 
        const selection = window.getSelection();
        if(selection.rangeCount > 0) selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand('copy');
        alert("POST参数复制成功！");
      }
 
      document.getElementById('q1').addEventListener('click', copyArticle, false);
    </script>
<script>
function gettype(){
        var type =document.getElementById('type').value;
 
    if (type=='jiuwu')
        {  document.getElementById('domain').innerHTML="<?=$_SERVER['SERVER_NAME']?>:80";}
    
    if (type=='20')
             {  document.getElementById('domain').innerHTML="<?=$_SERVER['SERVER_NAME']?>";}

          }
             function copyneirong($id,$title) {
            const range = document.createRange();
            range.selectNode(document.getElementById($id));
     
            const selection = window.getSelection();
            if(selection.rangeCount > 0) selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');
            alert($title+"复制成功！");
          }
     
        </script>
 <script>
      function copyArticle(event) {
        const range = document.createRange();
        range.selectNode(document.getElementById('apiurl'));
 
        const selection = window.getSelection();
        if(selection.rangeCount > 0) selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand('copy');
        alert("url复制成功！");
      }
 
      document.getElementById('w1').addEventListener('click', copyArticle, false);
    </script>

 <? require_once('m_footer.php');?>
 </body>
</html>
