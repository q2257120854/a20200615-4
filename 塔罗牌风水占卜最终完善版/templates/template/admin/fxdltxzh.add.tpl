<{include file='admin/header.tpl'}>
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
<div style="width:96%;margin:auto;padding:auto;">
    <form name="myform" jstype="vali" action="?ct=fxdltxzh&ac=add" method="POST"  enctype="multipart/form-data">

        <table width="100%" class="form">



                                    <tr>

                <td>所属收款平台:<font color="red">*</font></td>

                <td>





                        <select name="type" id="add_type"   errormsg='收款平台必须' vali='notempty'    >

                        <option value="">所属收款平台</option>



                    

                                                                        <option value="1" >支付宝</option>

                                                                                                <option value="2" >微信</option>

                                                

                    

                        </select>

                        <span class="text-hint normal">收款平台必须</span>





                </td>

            </tr>



                                                <tr>

                <td>

                    账号:<font color="red">*</font>

                                    </td>

                <td>

                    <input type='text' id="add_zhanghao" name='zhanghao' class="text error" errormsg='收款账号必须' vali='notempty' value=''  /> <span class="text-hint normal">收款账号必须</span></td>

            </tr>



                                                <tr>

                <td>

                    昵称:<font color="red">*</font>

                                    </td>

                <td>

                    <input type='text' id="add_name" name='name' class="text error" errormsg='收款昵称必须' vali='notempty' value=''  /> <span class="text-hint normal">收款昵称必须</span></td>

            </tr>



                                                <tr>

                <td>

                    提现金额:<font color="red">*</font>

                                    </td>

                <td>

                    <input type='text' disabled="disabled" id="add_money" class="text error" errormsg='提现金额必须（单位：元）' vali='notempty' value='<{$total}>'  /> <span class="text-hint normal">提现金额必须（单位：元）</span></td>
                    
                    <input type="hidden" name="money" value="<{$total}>" />

            </tr>



                        



            <tr>

                <td colspan='2' align='left' height='30' >

                    <input type='hidden' name='dosubmit' value='true'  />

                    <button type="submit" >提交</button> &nbsp;&nbsp;&nbsp;

                    <button type="reset">重设</button>

                </td>

            </tr>



        </table>

    </form>

</div>

</body>
</html>
