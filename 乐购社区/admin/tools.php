<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'tools';
 
 if ($_GET['a']!=''&&$_GET['b']!=''&&$_GET['c']!='')
{
	
if ($_GET['b']=='1')
$jg=$_GET['a']+$_GET['c'];
if ($_GET['b']=='2')
$jg=$_GET['a']-$_GET['c'];
if ($_GET['b']=='3')
$jg=$_GET['a']*$_GET['c'];
if ($_GET['b']=='4')
$jg=$_GET['a']/$_GET['c'];
}
 
 

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>自动计算</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">
        <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css">
        <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css">
        <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
            <style>
        @media (min-width: 769px) {
            #order-row .col-md-4 .panel {
                min-height: 330px;
            }

            #order-row .col-md-6 .panel {
                min-height: 255px;
            }
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
  include('left.php');
?>
    <div class="main-container">
        <div class="padding-md" id="pjax-container">
            
<div id="vue-page">
    <div class="row">
      <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-gradient-vine">自动计算 </a>
               </ul>
               </div>
                    </a>              
                </div>
                <div class="smart-widget-inner">
                    <div class="smart-widget-body">
                        <form class="form-horizontal"  method="get" >                                                                   
                                <div class="col-lg-8">
                                    <input class="form-control" value="<?=$_GET['a']?>"  name="a">
 <select name="b" v-model="isktfz" class="form-control">
                                        <option  <? if ($_GET['cs'] =='1') {echo "selected";}?> value="1">+</option>
                                        <option  <? if ($_GET['cs'] =='2') {echo "selected";}?> value="2">-</option>
                                        <option  <? if ($_GET['cs'] =='3') {echo "selected";}?> value="3">*</option>
                                        <option  <? if ($_GET['cs'] =='4') {echo "selected";}?> value="4">/</option>

                                    </select>
                                                                         <input value="<?=$_GET['c']?>"  class="form-control" value="" name="c" >
                                  <input class="form-control" value="<?=$jg?>" disabled>
   
                                </div>
                            </div>
                            </div>
                           
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
                             <input name="提交"  type="submit" class="an-btn an-btn-success" id="提交" value="计算">
                        </div>
                    </div>
                         </form>
                </div>
            </div>
        </div>
    </div>

</div>     </div>

        </div>
 

 <? include('footer.php');
?>
 

<?  include('password.php');?>
 

 </body>
</html>
