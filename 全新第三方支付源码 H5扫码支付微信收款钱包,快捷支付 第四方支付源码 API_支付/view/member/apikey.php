<div class="alert alert-success" style="font-size:16px">
    <?php echo $this->
        userData['apikey'] ?>&nbsp;&nbsp;
        <a href="javascript:;" class="zclipCopy" data="<?php echo $this->userData['apikey'] ?>">
            复制
        </a>
</div>
<script>
    $('.zclipCopy').zclip({
        path: '/static/common/ZeroClipboard.swf',
        copy: function() {
            return $(this).attr('data');
        },
        afterCopy: function() {
            alert('复制成功');
        }
    });
</script>