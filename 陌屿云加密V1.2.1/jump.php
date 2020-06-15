<?php
$url=isset($_GET['url'])?$_GET['url']:'/';
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
请稍等，正在跳转...
<script language='javascript'>window.location.href='".$url."';</script>";
