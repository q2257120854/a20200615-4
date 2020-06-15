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

<style type="text/css">
.text-hint.normal{color:#F00;}

</style>
<div style="width:96%;margin:auto;padding:auto;">

        <table width="100%" class="form">



                                    <tr>

                <td>代理分成比例:</td>

                <td>
                        

                        <span class="text-hint normal"><{$userinfo.fencheng}>%</span>
                </td>

            </tr>



           <tr>

                <td>

                    你的推广链接是:

                                    </td>

                <td>

                    <span class="text-hint normal"><{$domain}>?t=<{$userinfo.uid}></span></td>

            </tr>



                 <tr>

                <td>

                    推广二维码:

                                    </td>

                <td><img src="http://qr.liantu.com/api.php?bg=ffffff&gc=222222&el=l&w=150&m=10&text=<{$domain}>?t=<{$userinfo.uid}>" /></td>

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
