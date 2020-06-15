<!--#include file="asp_md5.asp"-->
<!--#include file="config.asp"-->
<%


require_once 'inc.php';
status			=trim(request("status"))
customerid		=trim(request("customerid"))
sdorderno		=trim(request("sdorderno"))
total_fee		=trim(request("total_fee"))
paytype			=trim(request("paytype"))
sdpayno			=trim(request("sdpayno"))
remark			=trim(request("remark"))
sign			=trim(request("sign"))

mysign=md5("customerid="&customerid&"&status="&status&"&sdpayno="&sdpayno&"&sdorderno="&sdorderno&"&total_fee="&total_fee&"&paytype="&paytype&"&"&userkey)

if sign = mysign then
    if status= '1' then
       response.wirte "success"
     else
       response.wirte "fail"
    end if
 else 
    response.wirte "signerr"

end if
%>