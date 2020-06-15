<?php /* Smarty version 2.6.25, created on 2019-12-12 21:17:49
         compiled from admin/fxdl.links.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
    function ajaxSelectChange(id,tag,url){
        if(id<1)return false;
        $.post(
                url,
                {id:id},
                function(data){
                    if(data.str=='success'){
                        //$('.'+tag).append(data.data);
                        $('.'+tag).html(data.data);
                    }else{
                        alert(data.str);
                    }
                },
                'json'
        );
    }
</script>

<style type="text/css">
.text-hint.normal{color:#F00;}

</style>
<div style="width:96%;margin:auto;padding:auto;">

        <table width="100%" class="form">



                                    <tr>

                <td>代理分成比例:</td>

                <td>
                        

                        <span class="text-hint normal"><?php echo $this->_tpl_vars['userinfo']['fencheng']; ?>
%</span>
                </td>

            </tr>



           <tr>

                <td>

                    你的推广链接是:

                                    </td>

                <td>

                    <span class="text-hint normal"><?php echo $this->_tpl_vars['domain']; ?>
?t=<?php echo $this->_tpl_vars['userinfo']['uid']; ?>
</span></td>

            </tr>



                 <tr>

                <td>

                    推广二维码:

                                    </td>

                <td><img src="http://qr.liantu.com/api.php?bg=ffffff&gc=222222&el=l&w=150&m=10&text=<?php echo $this->_tpl_vars['domain']; ?>
?t=<?php echo $this->_tpl_vars['userinfo']['uid']; ?>
" /></td>

            </tr>



                        



            <tr>

                <td colspan='2' align='left' height='30' >

                    <button type="reset">确定</button>

                </td>

            </tr>



        </table>

</div>

</body>
</html>