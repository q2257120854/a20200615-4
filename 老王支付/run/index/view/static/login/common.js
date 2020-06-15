/*鍒ゆ柇鏄惁涓烘暟瀛�*/
function isNumber(str) {
    var Letters = "1234567890";
    for (var i = 0; i < str.length; i = i + 1) {
        var CheckChar = str.charAt(i);
        if (Letters.indexOf(CheckChar) == -1) {
            return false;
        }
    }
    return true;
}
//鍒ゆ柇杈撳叆鐨勬槸涓嶆槸鍚堟硶鐨勯噾棰�
function isRMB(str){
    var Letters = "1234567890.";
    if(str==null||str==''){
        return false;
    }
    var a = 0;
    for (var i = 0; i < str.length; i = i + 1) {
        var CheckChar = str.charAt(i);
        if (Letters.indexOf(CheckChar) == -1) {
            return false;
        }
        if(CheckChar == '.' ){
            if(i==0 || i == str.length-1){
                return false;
            }
            a = a+1;
        }


        if(a>1){
            return false;
        }

    }
    return true;
}
/*鍒ゆ柇鏄惁涓篍mail*/
function isEmail(str) {
    var myReg = /^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/;
    if (myReg.test(str)) {
        return true;
    }
    return false;
}
//鍒ゆ柇鏄惁涓哄瓧姣嶏紝鏁板瓧锛宊
function ABC123_test(str){

    var Letters = "_1234567890ABCDEFGHIJKLMNOPQRSTUVWYXZqwertyuiopasdfghjklzxcvbnm";
    for (var i = 0; i < str.length; i = i + 1) {
        var CheckChar = str.charAt(i);
        if (Letters.indexOf(CheckChar) == -1) {
            return false;
        }
    }
    return true;

}

//鍘荤┖鏍�
function myTrim(strval){
    if(strval==null) return null;

    return strval.replace(/(^\s*)|(\s*$)/g, "");
}
//鏄惁涓虹┖
function isEmpty(value) {
    if(value==null||value==''){
        return true;
    }
    return false;
}
