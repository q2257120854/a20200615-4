

  <? 
require_once('member_check.php');
//include($site_moban2.'/index.php');
	   $nav='pay';
   if ($s_xid==0 and $member_id!='')
  {//发卡
include($site_moban2.'/kami.php');
}
   if ($s_xid!=0 and $member_id!='')
  {
	  include($site_moban2.'/user.php');
	//普通商品 

}
	 ?>
 

