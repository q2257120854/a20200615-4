<?php exit();//<item name='软件应用' url='?ct=version3&ac=application'/>

?>
<root>


  <menu name='订单频道'>
    <node name='信息管理'>
      <item name='订单管理' url='?ct=ffsm_order&ac=index' ct='ffsm_order' ac='index'/>
      <item name='订单导出' url='?ct=ffsm_order_ex&ac=index' ct='ffsm_order_ex' ac='index'/>
      <item name='提现记录' url='?ct=tixian&ac=index' ct='tixian' ac='index'/>
      <item name='系统基本配置' url='?ct=system&amp;ac=index' />
      <item name='分销账户管理' url='?ct=users&amp;ac=index' ct='users' ac='index' />
    </node>
  </menu>

  <menu name='分销管理'>
    <node name='分销管理'>
      <item name='订单管理' url='?ct=fxdl&ac=index' ct='fxdl' ac='index'/>
      <item name='我的推广链接' url='?ct=fxdl&amp;ac=links' ct='fxdl' ac='links'/>
      <item name='提现明细' url='?ct=fxdltxzh&amp;ac=index' ct='fxdltxzh' ac='index'/>
      <item name='金额提现' url='?ct=fxdltxzh&amp;ac=add' ct='fxdltxzh' ac='add'/>
    </node>
  </menu>


<menu name='系统'> 
  <node name='帐号管理'>
    <item name='系统帐号管理' url='?ct=users&amp;ac=index' ct='users' ac='index' />
    <item name='组权限管理' url='?ct=users&amp;ac=edit_purview_groups' ct='users' ac='edit_purview_groups' />
    <item name='组权限XML配置' url='?ct=users&amp;ac=edit_purview_xml' ct='users' ac='edit_purview_xml' />
    <item name='登录IP限制' url='?ct=users&amp;ac=iplimit' ct='users' ac='iplimit' />
    <item name='我的权限' url='?ct=users&amp;ac=mypurview' default='1' ct='users' ac='mypurview' />
      <item name='修改密码' url='?ct=users&amp;ac=editpwd' ct='users' ac='editpwd' />
  </node>
  <node name='系统其它'>
    <item name='操作日志' url='?ct=users&amp;ac=log' ct='users' ac='log' />
    <item name='登录日志' url='?ct=users&amp;ac=login_log' ct='users' ac='login_log' /> 
  </node>
</menu>

</root> 
