<?php
namespace xh\still;
/**
 * 验证码类
 */
class secoder {
    public static $seKey = 'code';
    public static $expire = 3000;  // 验证码过期时间（s）
    public static $codeSet = '346789ABCDEFGHJKLMNPQRTUVWXY';
    public static $fontSize = 18;  // 验证码字体大小(px)
    public static $useCurve = true; // 是否画混淆曲线
    public static $useNoise = true; // 是否添加杂点
    public static $imageH = 0;  // 验证码图片宽
    public static $imageL = 0;  // 验证码图片长
    public static $length = 4;  // 验证码位数
    public static $bg = array(243, 251, 254); // 背景
    protected static $_image = null;  // 验证码图片实例
    protected static $_color = null;  // 验证码字体颜色
    public static function entry($key) {
        self::$seKey = $key;
        // 图片宽(px)
        self::$imageL || self::$imageL = self::$length * self::$fontSize * 1.5 + self::$fontSize*1.5;
        // 图片高(px)
        self::$imageH || self::$imageH = self::$fontSize * 2;
        // 建立一幅 self::$imageL x self::$imageH 的图像
        self::$_image = imagecreate(self::$imageL, self::$imageH);
        // 设置背景
        imagecolorallocate(self::$_image, self::$bg[0], self::$bg[1], self::$bg[2]);
        // 验证码字体随机颜色
        self::$_color = imagecolorallocate(self::$_image, mt_rand(1,120), mt_rand(1,120), mt_rand(1,120));
        // 验证码使用随机字体
        //$ttf = dirname(__FILE__) . '/ttfs/' . mt_rand(1, 20) . '.ttf'; 4
        $ttf =  PATH_STATIC . '/font/Bungee-Regular.otf';
        if (self::$useNoise) {
            // 绘杂点
            self::_writeNoise();
        }
        if (self::$useCurve) {
            // 绘干扰线
            self::_writeCurve();
        }
        
        // 绘验证码
        $code = array(); // 验证码
        $codeNX = 0; // 验证码第N个字符的左边距
        for ($i = 0; $i<self::$length; $i++) {
            $code[$i] = self::$codeSet[mt_rand(0, 27)];
            $codeNX += mt_rand(self::$fontSize*1.2, self::$fontSize*1.6);
            // 写一个验证码字符
            imagettftext(self::$_image, self::$fontSize, mt_rand(-40, 70), $codeNX, self::$fontSize*1.5, self::$_color, $ttf, $code[$i]);
        }
        // 保存验证码
        isset($_SESSION) || session_start();
        $_SESSION[self::$seKey]['code'] = join('', $code); // 把校验码保存到session
        $_SESSION[self::$seKey]['time'] = time(); // 验证码创建时间
        header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header("content-type: image/png");
        // 输出图像
        imagepng(self::$_image);
        imagedestroy(self::$_image);
    }
    
    protected static function _writeCurve() {
        $A = mt_rand(1, self::$imageH/2);     // 振幅
        $b = mt_rand(-self::$imageH/4, self::$imageH/4); // Y轴方向偏移量
        $f = mt_rand(-self::$imageH/4, self::$imageH/4); // X轴方向偏移量
        $T = mt_rand(self::$imageH*1.5, self::$imageL*2); // 周期
        $w = (2* M_PI)/$T;
        
        $px1 = 0; // 曲线横坐标起始位置
        $px2 = mt_rand(self::$imageL/2, self::$imageL * 0.667); // 曲线横坐标结束位置
        for ($px=$px1; $px<=$px2; $px=$px+ 0.9) {
            if ($w!=0) {
                $py = $A * sin($w*$px + $f)+ $b + self::$imageH/2; // y = Asin(ωx+φ) + b
                $i = (int) ((self::$fontSize - 6)/4);
                while ($i > 0) {
                    imagesetpixel(self::$_image, $px + $i, $py + $i, self::$_color); // 这里画像素点比imagettftext和imagestring性能要好很多
                    $i--;
                }
            }
        }
        
        $A = mt_rand(1, self::$imageH/2);     // 振幅
        $f = mt_rand(-self::$imageH/4, self::$imageH/4); // X轴方向偏移量
        $T = mt_rand(self::$imageH*1.5, self::$imageL*2); // 周期
        $w = (2* M_PI)/$T;
        $b = $py - $A * sin($w*$px + $f) - self::$imageH/2;
        $px1 = $px2;
        $px2 = self::$imageL;
        for ($px=$px1; $px<=$px2; $px=$px+ 0.9) {
            if ($w!=0) {
                $py = $A * sin($w*$px + $f)+ $b + self::$imageH/2; // y = Asin(ωx+φ) + b
                $i = (int) ((self::$fontSize - 8)/4);
                while ($i > 0) {
                    imagesetpixel(self::$_image, $px + $i, $py + $i, self::$_color); // 这里(while)循环画像素点比imagettftext和imagestring用字体大小一次画出（不用这while循环）性能要好很多
                    $i--;
                }
            }
        }
    }
    
    
    protected static function _writeNoise() {
        for($i = 0; $i < 10; $i++){
            //杂点颜色
            $noiseColor = imagecolorallocate(
                self::$_image,
                mt_rand(150,225),
                mt_rand(150,225),
                mt_rand(150,225)
                );
            for($j = 0; $j < 5; $j++) {
                // 绘杂点
                imagestring(
                    self::$_image,
                    5,
                    mt_rand(-10, self::$imageL),
                    mt_rand(-10, self::$imageH),
                    self::$codeSet[mt_rand(0, 27)], // 杂点文本为随机的字母或数字
                    $noiseColor
                    );
            }
        }
    }
    
    public static function check($code,$key) {
        self::$seKey = $key;
        isset($_SESSION) || session_start();
        // 验证码不能为空
        if(empty($code) || empty($_SESSION[self::$seKey])) {
            //echo $_SESSION[self::$seKey]['code'].'1';
            return false;
        }
        // session 过期
        if(time() - $_SESSION[self::$seKey]['time'] > self::$expire) {
            unset($_SESSION[self::$seKey]);
            //echo $_SESSION[self::$seKey]['code'].'2';
            return false;
            //return 0;
        }
        // if($code == $_SESSION[self::$seKey]['code']) {
        if(strtoupper($code) == $_SESSION[self::$seKey]['code']) { //不区分大小写比较
            //echo $_SESSION[self::$seKey]['code'].'3';
            return true;
        }
        //echo $_SESSION[self::$seKey]['code'].'4';
        return false;
        
    }
}