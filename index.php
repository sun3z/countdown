<?php 

/**
 * 时间不会等你
 * 
 * @author zhaowei
 */

// 基础配置
set_time_limit(0);
date_default_timezone_set('PRC');

// 定义常量
define('RES', __DIR__ . '/public/');


// 开始和结束时间戳
$start = strtotime('2016-1-1 6:00:00');
$end = strtotime('2016-12-31 6:00:00');


for($date = $start; $date<=$end; $date+=(60*60*24)) {
    
    // 读取图片
    $img = imagecreatefromjpeg(RES . '/image.jpg');
    $imgW = imagesx($img);
    $imgH = imagesy($img);

    // 定义字体和颜色
    $font = RES . 'reference.ttf';
    $black = imagecolorallocate($img, 0, 0, 0);
    
    // 添加日期
    $dateSize = 25;
    $dateBox = imagettfbbox($dateSize, 0, $font, date('Y-m-d', $date));
    $dateW = $dateBox[4] - $dateBox[6];
    $dateH = $dateBox[3] - $dateBox[5];

    imagettftext($img, $dateSize, 0, ($imgW-$dateW)/2, ($imgH-$dateH)-15, $black, $font, date('Y-m-d', $date));

    // page day  宽应该在 306~444之间居中
    $day = date('z', $date) + 1;
    $daySize = 48;
    $dayBox = imagettfbbox($daySize, 0, $font, $day);
    $dayW = $dayBox[4] - $dayBox[6];
    $dayH = $dayBox[3] - $dayBox[5];

    imagettftext($img, $daySize, 0, (444-306-$dayW)/2+306, 248, $black, $font, $day); 

    // of day
    $amount = 365 + date('L', $date);
    imagettftext($img, 48, 0, 516, 248, $black, $font, $amount);

    // chapter year
    imagettftext($img, 48, 0, 447, 330, $black, $font, date('Y', $date));

    imagejpeg($img, __DIR__ . '/img/' . date('Y-m-d', $date) .'.jpg');
}