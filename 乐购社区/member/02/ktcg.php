<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>开通成功-<?=$site_name?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">    <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css"> <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
  <script>
 function subForm()
 {
form1.action="";
 form1.submit();
 //form1为form的id
 }
 </script>
    <script src="http://assets.19sky.cn/assets/js/jquery-1.11.1.min.js"></script>
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>


  
           
 
    <div class="modal     bg-success"    style="display:block" >
        <div class="modal-dialog">
            <div class="modal-content animated flipInX">
                <div class="modal-header">
                    <h4 class="modal-title">
                        分站开通成功
                    </h4>
                </div>

                <div class="modal-body">
                    <div class="list-group-item list-group-item-success">恭喜你，你的专属分站已搭建完毕</div>
                    <div class="list-group-item list-group-item-info">平台名称：<?=$_GET['name']?></div>
                    <div class="list-group-item list-group-item-warning">分站域名：<?=$_GET['url']?></div>
                    <div class="list-group-item list-group-item-warning">管理后台地址：http://<?=$_GET['url']?>/user/</div>
                    <div class="list-group-item list-group-item-warning">管理员账号：你的用户账号<?=$_GET['loginname']?></div>
                    <div class="list-group-item list-group-item-warning">管理员密码：你的用户密码<?=$_GET['loginpassword']?></div>
                </div>
                <div class="modal-footer text-center">
                    <a    href="/index/home/ktfz/id/<?=$_GET['id']?>.html" class="btn btn-success">返回页面</a>

                    <a    href="http://<?=$_GET['url']?>/user/"  target="_blank" class="btn btn-success">进入后台</a>
                </div>
            </div>
        </div>
    </div>
</div>

     
 <? require_once('m_footer.php');?>

 
  </body>
</html>
