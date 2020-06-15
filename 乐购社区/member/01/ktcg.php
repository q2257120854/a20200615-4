<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>开通成功-<?=$site_name?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap core CSS -->
    <link href="http://assets.19sky.cn/member/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="http://assets.19sky.cn/member/css/font-awesome.min.css" rel="stylesheet">

    <!-- ionicons -->
    <link href="http://assets.19sky.cn/member/css/ionicons.min.css" rel="stylesheet">

    <!-- Morris -->
    <link href="http://assets.19sky.cn/member/css/morris.css" rel="stylesheet"/>

    <!-- Datepicker -->
    <link href="http://assets.19sky.cn/member/css/datepicker.css" rel="stylesheet"/>

    <!-- Animate -->
    <link href="http://assets.19sky.cn/member/css/animate.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link href="http://assets.19sky.cn/member/css/owl.carousel.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Simplify -->
    <link href="http://assets.19sky.cn/member/css/simplify.min.css" rel="stylesheet">
    <link href="http://assets.19sky.cn/member/css/bootstrap-switch.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="http://assets.19sky.cn/member/css/toastr.min.css">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
    <!-- Jquery -->
    <script>
 function subForm()
 {
form1.action="";
 form1.submit();
 //form1为form的id
 }
 </script>
    <script src="http://assets.19sky.cn/member/js/jquery-1.11.1.min.js"></script>
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

    <? require_once('m_left.php');?>

  
           
 
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
                    <div class="list-group-item list-group-item-info">站点名称：<?=$_GET['name']?></div>
                    <div class="list-group-item list-group-item-warning">站点域名：<?=$_GET['url']?></div>
                    <div class="list-group-item list-group-item-warning">管理后台地址：http://<?=$_GET['url']?>/member/</div>
                    <div class="list-group-item list-group-item-warning">管理员账号：<?=$_GET['loginname']?></div>
                    <div class="list-group-item list-group-item-warning">管理员密码：<?=$_GET['loginpassword']?></div>
                </div>
                <div class="modal-footer text-center">
                    <a    href="/index/home/ktfz/id/<?=$_GET['id']?>.html" class="btn btn-success">返回</a>

                    <a    href="http://<?=$_GET['url']?>/member/"  target="_blank" class="btn btn-success">现在进入你的分站后台</a>
                </div>
            </div>
        </div>
    </div>
</div>

     
 <? require_once('m_footer.php');?>

 
  </body>
</html>
