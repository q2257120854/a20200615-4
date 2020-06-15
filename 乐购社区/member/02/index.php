<?
  //普通登录用户
  $nav='pay';
   if ($s_xid==0 and $member_id!='')
  {//发卡
include('/member/01/kami.php');
}
   if ($s_xid!=0 and $member_id!='')
  {
	  include('/member/01/user.php');
	//普通商品 

}?> 