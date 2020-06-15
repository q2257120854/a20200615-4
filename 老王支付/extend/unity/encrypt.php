<?php
namespace xh\unity;
class encrypt{
    /**
     * 加密
     * @param unknown $data
     * @param unknown $token
     * @return string
     */
    public function Encode($data,$token){
        return str_replace("+", "@", base64_encode($this->RC4($token, $data)));
    }
    
    /**
     * 解密
     * @param unknown $data
     * @param unknown $token
     * @return string
     */
    public function Decode($data,$token){
        return iconv("UTF-8", "GB2312//IGNORE", $this->RC4($token, base64_decode(str_replace("@", "+", $data))));
    }
    
    /**
     * 加密主函数
     * @param unknown $pwd
     * @param unknown $data
     * @return string
     */
    private function RC4 ($pwd, $data)
    {
        $key[] ="";
        $box[] ="";
        
        $pwd_length = strlen($pwd);
        $data_length = strlen($data);
        
        for ($i = 0; $i < 256; $i++)
        {
            $key[$i] = ord($pwd[$i % $pwd_length]);
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
        
        return $cipher;
    }
}