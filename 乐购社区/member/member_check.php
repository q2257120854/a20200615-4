  <? require_once('../system/inc.php');
 	 require_once('../data/member.php') ; 
	 require_once('../data/shop.php') ;
 
 if ($member_name =='')
  { 	header('location: /login/'.$_GET['id']); }

?>