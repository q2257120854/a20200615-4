$(function(){

    $('.form-ajax').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action'),
            type : 'POST',
            dataType : 'json',
            data: $(this).serialize(),
            beforeSend: function(){
                $('.prompt-error').text('');
                $('.woody-prompt').hide();
            },
            success : function(result){
                if(result.status=='0'){
                    $('.prompt-error').html('<span class="glyphicon glyphicon-info-sign"></span>&nbsp;'+result.msg);
                    $('.woody-prompt').show();
                }

                if(result.status=='1'){
                    alert(result.msg);
                    if(result.url){
                        window.location.href = result.url;
                    }
                }

                if(result.status=='0'){
                    $('[name=chkcode]').val('');
                    $('.imgcode').click();
                }
            }
        });
    });
	
$(window).scroll(function(){
    $('.top-notice').hide();
    if($(this).scrollTop()==0){
        $('.top-notice').fadeIn();
    }
});
});
