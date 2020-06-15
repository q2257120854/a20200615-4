<!--#include file="asp_md5.asp"-->
<!--#include file="config.asp"-->
<%

response.Charset="gb2312"
on error resume next'''HTTP异步传输函数


	Randomize 
	rnds = Int((900 * Rnd) + 100)
	orderid=year(now())&month(now())&day(now())&hour(now())&minute(now())&second(now())&rnds''''生成商户订单号,商户可自行定义

	version			=	"1.0"
	customerid		=	userid
	sdorderno		=	orderid
	total_fee		=	request("total_fee")
	paytype			=	request("paytype")
	bankcode		=	request("bankcode")
	notifyurl		=	request("notifyurl")
	returnurl		=	request("returnurl")
	$remark			=	'';
	$get_code		=	request("get_code")

	sign=asp_md5("version="&version&"&customerid="&customerid&"&total_fee="&total_fee&"&sdorderno="&sdorderno&"&notifyurl="&notifyurl&"&returnurl="&returnurl&"&"&userkey)

%>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>正在转到付款页</title>
</head>
<body onLoad="document.pay.submit()">
    <form name="pay" action="https://b.olzc.net/apisubmit" method="post">
        <input type="hidden" name="version" value="<%=version%>">
        <input type="hidden" name="customerid" value="<%=customerid%>">
        <input type="hidden" name="sdorderno" value="<%=sdorderno%>">
        <input type="hidden" name="total_fee" value="<%=total_fee%>">
        <input type="hidden" name="paytype" value="<%=paytype%>">
        <input type="hidden" name="notifyurl" value="<%=notifyurl%>">
        <input type="hidden" name="returnurl" value="<%=returnurl%>">
        <input type="hidden" name="remark" value="<%=remark%>">
        <input type="hidden" name="bankcode" value="<%=bankcode%>">
        <input type="hidden" name="sign" value="<%=sign%>">
        <input type="hidden" name="get_code" value="<%=get_code%>">
    </form>
</body>
</html>