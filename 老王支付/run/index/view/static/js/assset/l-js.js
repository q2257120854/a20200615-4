// $(function () {
//     $(".delault-box").mouseover(function () {
//         $(this).hide();
//         $(this).next().show().css("z-index","98");
//     });

//     $(".delault-box-two").mouseleave(function () {
//         $(this).hide();
//         $(this).prev().show();
//     })

// })

$('#app1').click(function(){

    var logding_index = layer.load(0, {shade: [0.2,'#fff']}); //0代表加载的风格，支持0-2
    var name=$('.name').val();
    var phone=$('.phone').val();
    var content=$('.content').val();
    $.post(submit_contact,{name:name,phone:phone,content:content},function(datalist){
        layer.close(logding_index);
        if(datalist.status==1){
            layer.msg(datalist.msg);
            //提交成功后清空表单
            $('.name').val('');
            $('.phone').val('');
            $('.content').val('');

        }else{
            layer.msg(datalist.msg);
        }

    },'json')

})