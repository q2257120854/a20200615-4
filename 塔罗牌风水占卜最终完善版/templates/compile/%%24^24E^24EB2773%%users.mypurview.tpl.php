<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:14
         compiled from admin/users.mypurview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'frame_union', 'admin/users.mypurview.tpl', 23, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
    .bh {
        line-height:24px;
    }
    dl.m_dl {
        margin-left:20px;
        margin-top:10px;
    }
    dl.m_dl dt {
        line-height:48px;
        border-bottom:1px dashed #eee;
        font-size:14px;
    }
    dl.m_dl dd {
        padding-left:20px;
        line-height:36px;
        border-bottom:1px dashed #eee;
    }
</style>
<dl class="search-class" style="border-bottom:1px solid #eee">
    <h3 class='bh'>
        你好：<font color='red'><?php echo $this->_tpl_vars['users']['user_name']; ?>
( <?php echo smarty_function_frame_union(array('do' => 'groups','var' => $this->_tpl_vars['users']['groups']), $this);?>
 )</font>
        欢迎登录管理后台
    </h3>
</dl>
<div style="padding-left:10px;padding-top:16px;">
<?php $_from = $this->_tpl_vars['config_apps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<div style='padding-left:10px;'>
    <div class='title' style='line-height:28px;border-bottom:1px dashed #ccc;font-weight:bold;'><?php echo $this->_tpl_vars['v']['app_name']; ?>
</div>
    <div style='line-height:28px;width:90%;padding-top:10px;'>
       <?php $_from = $this->_tpl_vars['v']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['kk'] => $this->_tpl_vars['vv']):
        $this->_foreach['foo']['iteration']++;
?>
     <?php if (( $this->_tpl_vars['groups'] == '*' || ( in_array ( $this->_tpl_vars['kk'] , $this->_tpl_vars['groups'][$this->_tpl_vars['k']] ) ) ) && $this->_tpl_vars['kk'] != 'app_name'): ?>
       <?php if (($this->_foreach['foo']['iteration']-1) > 1 && ($this->_foreach['foo']['iteration']-1)-1 % 5 == 0): ?><br /><?php endif; ?>
       <span style="display:-moz-inline-box; display:inline-block; width:150px;">√<?php echo $this->_tpl_vars['vv']; ?>
</span>
     <?php endif; ?>
       <?php endforeach; endif; unset($_from); ?>
    </div>
</div>
<br />
<?php endforeach; endif; unset($_from); ?>
</div>

</body>
</html>