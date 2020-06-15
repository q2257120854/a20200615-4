<?  include('../system/inc.php');?>{"code":0,"message":"success","list":
[<?php                                                                                
  						$result = mysql_query('select * from '.flag.'shop  where zid = '.$zhu_id.' and xid <> 0  order by ID asc  ');
						$a=0;
						while($row = mysql_fetch_array($result)){
						$a++;	
						if ($a==1){
 $result1 = mysql_query('select * from '.flag.'moban where id = '.$row['xid'].'');
$row1 = mysql_fetch_array($result1);
  if ($row1['key1']!='')
 {$key1='{"param":"'.$row1['key1'].'","name":'.json_encode($row1['keyname1']).'}';}
  if ($row1['key2']!='')
 {$key2=',{"param":"'.$row1['key2'].'","name":'.json_encode($row1['keyname2']).'}';}
  if ($row1['key3']!='')
 {$key3=',{"param":"'.$row1['key3'].'","name":'.json_encode($row1['keyname3']).'}';}
  if ($row1['key4']!='')
 {$key4=',{"param":"'.$row1['key4'].'","name":'.json_encode($row1['keyname4']).'}';}
  
 
 $pjcs=$key1.$key2.$key3.$key4;
 
  	
						?>
{"goodsid":<?=$row['ID']?>,"name":<?=json_encode($row['name'])?>,"modelid":<?=$row['xid']?>,"image_url":<?=json_encode($row['pic'])?>,"iscf":<?=$row['iscfxd']?>,"cfnum":1,"istd":<?=$row['tk']?>,"price":<?=$row['price']?>,"post":[<?=$pjcs?>]}
<? } }?>
   <?php                                                                                
  						$result = mysql_query('select * from '.flag.'shop  where zid = '.$zhu_id.'  order by ID asc  ');
						$a=0;
						while($row = mysql_fetch_array($result)){
						$a++;	
						if ($a>1){
							
					 $result1 = mysql_query('select * from '.flag.'moban where id = '.$row['xid'].'');
$row1 = mysql_fetch_array($result1);
 if ($row1['key1']!='')
 {$key1='{"param":"'.$row1['key1'].'","name":'.json_encode($row1['keyname1']).'}';}
  if ($row1['key2']!='')
 {$key2=',{"param":"'.$row1['key2'].'","name":'.json_encode($row1['keyname2']).'}';}
  if ($row1['key3']!='')
 {$key3=',{"param":"'.$row1['key3'].'","name":'.json_encode($row1['keyname3']).'}';}
  if ($row1['key4']!='')
 {$key4=',{"param":"'.$row1['key4'].'","name":'.json_encode($row1['keyname4']).'}';}
  
 
 $pjcs=$key1.$key2.$key3.$key4;
 
  	

		
						?>
,{"goodsid":<?=$row['ID']?>,"name":<?=json_encode($row['name'])?>,"modelid":<?=$row['xid']?>,"image_url":<?=json_encode($row['pic'])?>,"iscf":<?=$row['iscfxd']?>,"cfnum":1,"istd":<?=$row['tk']?>,"price":<?=$row['price']?>,"post":[<?=$pjcs?>]}
<? } }?>

]}