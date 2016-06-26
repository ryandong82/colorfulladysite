<?php
session_start();
getCode(4, 60, 20);
function getCode($num, $w, $h)
{
    $code = "";
    for ($i = 0; $i < $num; $i++) {
        $code .= rand(0, 9);
    }
    //4位验证码也可以用rand(1000,9999)直接生成
    //将生成的验证码写入session，备验证时用
    $_SESSION["VerifyCode"] = $code;
    //创建图片，定义颜色值
    header("Content-type: image/PNG");
    $im = imagecreate($w, $h);
    $black = imagecolorallocate($im, 0, 0, 0);
    $gray = imagecolorallocate($im, 200, 200, 200);
    $bgcolor = imagecolorallocate($im, 255, 255, 255);
    //填充背景
    imagefill($im, 0, 0, $gray);
    //画边框
    imagerectangle($im, 0, 0, $w - 1, $h - 1, $black);
    //随机绘制两条虚线，起干扰作用
    $style = array($black, $black, $black, $black, $black,
        $gray, $gray, $gray, $gray, $gray
    );
    imagesetstyle($im, $style);
    $y1 = rand(0, $h);
    $y2 = rand(0, $h);
    $y3 = rand(0, $h);
    $y4 = rand(0, $h);
    imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
    imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);
    //在画布上随机生成大量黑点，起干扰作用;
    for ($i = 0; $i < 80; $i++) {
        imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
    }
    //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
    $strx = rand(3, 8);
    for ($i = 0; $i < $num; $i++) {
        $strpos = rand(1, 6);
        imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
        $strx += rand(8, 12);
    }
    imagepng($im);//输出图片
    imagedestroy($im);//释放图片所占内存
}

//session_start();
//vCode(4, 15); //4个数字，显示大小为15

function vCode($num = 4, $size = 20, $width = 0, $height = 0)
{
    !$width && $width = $num * $size * 4 / 5 + 5;
    !$height && $height = $size + 10;
    // 去掉了 0 1 O l 等
    $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";
    $code = '';
    for ($i = 0; $i < $num; $i++) {
        $code .= $str[mt_rand(0, strlen($str) - 1)];
    }
    // 画图像
    $im = imagecreatetruecolor($width, $height);
    // 定义要用到的颜色
    $back_color = imagecolorallocate($im, 235, 236, 237);
    $boer_color = imagecolorallocate($im, 118, 151, 199);
    $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
    // 画背景
    imagefilledrectangle($im, 0, 0, $width, $height, $back_color);
    // 画边框
    imagerectangle($im, 0, 0, $width - 1, $height - 1, $boer_color);
    // 画干扰线
    for ($i = 0; $i < 5; $i++) {
        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagearc($im, mt_rand(-$width, $width), mt_rand(-$height, $height), mt_rand(30, $width * 2), mt_rand(20, $height * 2), mt_rand(0, 360), mt_rand(0, 360), $font_color);
    }
    // 画干扰点
    for ($i = 0; $i < 50; $i++) {
        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
    }
    // 画验证码
    imagettftext($im, $size, 0, 5, $size + 3, $text_color, '/usr/share/fonts/winfonts/simsun.ttc', $code);
    $_SESSION["VerifyCode"] = $code;
    header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
    header("Content-type: image/png;charset=utf-8");
    imagepng($im);
    imagedestroy($im);
    //echo $code;
}
