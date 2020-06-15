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

    $('h3 span').click(function(){
        $('h3 span').removeClass('current');
        $(this).addClass('current');
        $('.set').hide();
        $('.set'+$(this).index()).removeClass('hide').show();
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.selectAllCheckbox').click(function(){
        if($(this).prop('checked')){
            $('.checkbox').prop('checked',true);
        } else {
            $('.checkbox').prop('checked',false);
        }
    });

    $('.zclipCopy').zclip({
      path: '/static/common/ZeroClipboard.swf',
      copy: function(){
        return $(this).prop('data');
      },
      afterCopy: function(){
        alert('复制成功');
      }
    });

    $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd',
        minView: 'month',
        todayBtn: 1,
        autoclose: 1,
    });
});

function showContent(title,url){
    $('#waModal').modal('show');
    $('#waModal .modal-title').text(title);
    $.get(url,{t:new Date().getTime()},function(data){
        $('#waModal .modal-body').html(data);
    });
}

function del(id,url){
    if(confirm('是否要执行此操作？')){
        $.get(url,{id:id},function(ret){
            if(ret.status=='0'){
                alert('删除失败');
            } else {
                $('[data-id="'+id+'"]').fadeOut();
            }
        },'json');
    }
}

function freeze(id,url){
    if(confirm('是否要执行此操作？')){
        $.get(url,{id:id},function(ret){
            if(ret.status=='0'){
                alert(ret.msg);
            } else {
                $('.freeze'+id).prop('title',ret.title);
                $('.state'+id+' span').removeClass(ret.removeClass);
                $('.state'+id+' span').addClass(ret.addClass);
                $('.state'+id+' span').text(ret.stateName);
                $('.freeze'+id).text(ret.msg);
            }
        },'json');
    }
}


function op(id,userid){

    $.post('/admfor035/users/tongdao_edit',{id:id,userid:userid},function(ret){
        if(ret.status=='1'){
            if(ret.st=='0'){
                $('td.label'+id+' span.label').removeClass('label-danger').addClass('label-success');
                $('td.label'+id+' span.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                $('td.btn'+id+' a').text('关闭');
            }

            if(ret.st=='1'){
                $('td.label'+id+' span.label').removeClass('label-success').addClass('label-danger');
                $('td.label'+id+' span.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $('td.btn'+id+' a').text('打开');
                //$('td.btn'+id+' a').attr('onclick',"alert('联系客服开通！')");
            }
        } else {
            alert('设置失败');
        }
    },'json');

}


