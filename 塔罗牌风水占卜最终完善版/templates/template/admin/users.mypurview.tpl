<{include file="admin/header.tpl"}>
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
        你好：<font color='red'><{$users.user_name}>( <{frame_union do='groups' var=$users.groups}> )</font>
        欢迎登录管理后台
    </h3>
</dl>
<div style="padding-left:10px;padding-top:16px;">
<{foreach from=$config_apps key=k item=v}>
<div style='padding-left:10px;'>
    <div class='title' style='line-height:28px;border-bottom:1px dashed #ccc;font-weight:bold;'><{$v.app_name}></div>
    <div style='line-height:28px;width:90%;padding-top:10px;'>
       <{foreach from=$v key=kk item=vv name=foo}>
     <{if ($groups=='*' || (in_array($kk, $groups[$k]) )) && $kk != 'app_name' }>
       <{if $smarty.foreach.foo.index > 1 and $smarty.foreach.foo.index-1 mod 5 eq 0}><br /><{/if}>
       <span style="display:-moz-inline-box; display:inline-block; width:150px;">√<{$vv}></span>
     <{/if}>
       <{/foreach}>
    </div>
</div>
<br />
<{/foreach}>
</div>

</body>
</html>
