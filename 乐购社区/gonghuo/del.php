<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
 
 
header('Content-Type: text/html; charset=utf-8');
if($_POST['btnSave']){
 if(empty($_POST['id'])){
    echo"<script>alert('必须选择一个ID,才可以删除!');history.back(-1);</script>";
    exit;
  }else{
/*如果要获取全部数值则使用下面代码*/
   $id= implode(",",$_POST['id']);
   $str='DELETE FROM '.DATA_NAME.'.'.flag.'info where id in ($id)';
   mysql_query($str);
  echo "<script>alert('删除成功！');window.location.href='detail.php';</script>";
}
}
?>