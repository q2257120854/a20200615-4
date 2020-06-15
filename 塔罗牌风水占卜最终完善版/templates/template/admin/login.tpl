<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    *{margin:0;padding:0;color:#333;font-size:12px;}
    .ct2{ font-size:12px; }
    .ct2 a{ font-size:12px; }
 </style>
<base target='_self' />
<title> 后台管理 </title>
</head>
<body>
    <div style="background:#c3d9eb;padding:5px;width:500px;margin:50px auto;">
        <div>
     <h2 style="font-size:16px;height:32px; line-height:32px;border-bottom:1px #8ebce1 solid;padding:0 10px;background:#ebf3fa;">登录后台管理中心</h2>
     <div style="padding:20px 0; text-align:center;background:#fff;">
     <h4 style="font-size:14px;line-height:24px;margin-bottom:10px">
	  <form name="form1" method="post" action="?ct=index&ac=login">
	    <input type="hidden" name="gourl" value="<{$gourl}>" />
	    <table width="98%" border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td colspan="2" style="color:red;text-align:center"><{$errmsg}></td>
        </tr>
        <tr>
          <td width="30%" height="42">用户名：</td>
          <td width="70%" align="left"><input name="username" type="text" id="username" style="width:200px;height:18px;padding-top:2px"></td>
        </tr>
        <tr>
          <td height="42">密　码：</td>
          <td align="left"><input name="password" type="password" id="password" style="width:200px;height:18px;padding-top:2px"></td>
        </tr> 
        <tr>
          <td height="50">&nbsp;</td>
          <td align="left"><input type="submit" name="Submit" value="登录">
          　
          <input type="reset" name="Submit2" value="重置"></td>
        </tr>
      </table>
	  </form>
	  <div>&#25042;&#20154;&#28304;&#30721;&#119;&#119;&#119;&#46;&#108;&#97;&#110;&#114;&#101;&#110;&#122;&#104;&#105;&#106;&#105;&#97;&#46;&#99;&#111;&#109;&#32;&#20840;&#31449;&#36164;&#28304;&#50;&#48;&#22359;&#20219;&#24847;&#19979;&#36733;</div>
	      </h4>
            </div>
        </div>
    </div>
</body>
</html>