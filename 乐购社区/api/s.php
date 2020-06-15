<? require_once('../system/inc.php');
header("Content-type:text/html;charset=utf-8");//字符编码设置  
$servername = DATA_HOST;  
$username = DATA_USERNAME;  
$password = DATA_PASSWORD;  
$dbname = DATA_NAME;  
// 创建连接  
$con =mysqli_connect($servername, $username, $password, $dbname); 
mysqli_set_charset($con, "utf8");
// 检测连接  
$sql = "SELECT ID ,name ,minnum ,maxnum ,xid FROM ".flag."shop  where zid = ".$zhu_id."";  
$result = mysqli_query($con,$sql);  
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$jarr = array();
while ($rows=mysqli_fetch_array($result,MYSQL_ASSOC)){
    $count=count($rows);
    for($i=0;$i<$count;$i++){  
        unset($rows[$i]); 
    }
    array_push($jarr,$rows);
}
$arr=json_decode($str);
						  ?>
                        
{"status":1,"goods_rows":<? echo $str=json_encode($jarr);?>}