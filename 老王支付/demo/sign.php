<?php
/**
 * 签名算法
 * @param unknown $key_id S_KEY（商户KEY）
 * @param unknown $array 例子：$array = array('amount'=>'1.00','out_trade_no'=>'2018123645787452');
 * @return string
 */
function sign ($key_id, $array)
{
    $data = md5(sprintf("%.2f", $array['amount']) . $array['out_trade_no']);
    $key[] ="";
    $box[] ="";
    $pwd_length = strlen($key_id);
    $data_length = strlen($data);
    for ($i = 0; $i < 256; $i++)
    {
        $key[$i] = ord($key_id[$i % $pwd_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++)
    {
        $j = ($j + $box[$i] + $key[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $data_length; $i++)
    {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        
        $k = $box[(($box[$a] + $box[$j]) % 256)];
        $cipher .= chr(ord($data[$i]) ^ $k);
    }
    return md5($cipher);
}
?>