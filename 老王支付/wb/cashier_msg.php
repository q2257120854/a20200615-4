<?php 
$msg=$_GET['msg'];


?>








<script>
</script>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>温馨提示</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <style>
      body{
      
      }
      div{
        background-color: rgba(222,222,222,0.3);
        border-radius: 5px;
        margin: 50px 30px 0;
        padding: 20px;
      }
      .text-center{
        text-align: center;
      }
      h3{
        color: red;
      }
    </style>
  </head>
<body class="text-center">
<div>
  <h3 ><?php echo $msg;?></h3>
</div>
</body>
</html>
