<?php 

/**
 * @author zhaowei
 */

// 基础配置
set_time_limit(0);
date_default_timezone_set('PRC');

// 定义常量
define('RES', __DIR__ . '/public/');

// 读取图片
$img = imagecreatefromjpeg(RES . '/image.jpg');

$imgWidth = imagesx($img);
$imgHeight = imagesy($img);

// 定义字体和颜色
$font = RES . 'reference.ttf';
$black = imagecolorallocate($img, 0, 0, 0);

// 添加日期
$dateSize = 25;
$dateBox = imagettfbbox($dateSize, 0, $font, date('Y-m-d'));
$dateWidth = $dateBox[4] - $dateBox[6];
$dateHeight = $dateBox[3] - $dateBox[5];

imagettftext($img, $dateSize, 0, ($imgWidth-$dateWidth)/2, ($imgHeight-$dateHeight)-15, $black, $font, date('Y-m-d'));

// page day  宽应该在 306~444之间居中
$day = date('z');
$daySize = 48;
$dayBox = imagettfbbox($daySize, 0, $font, $day);
$dayWidth = $dayBox[4] - $dayBox[6];
$dayHeight = $dayBox[3] - $dayBox[5];

imagettftext($img, $daySize, 0, (444-306-$dayWidth)/2+306, 248, $black, $font, $day); 

// of day
$amount = 365 + date('L');
imagettftext($img, 48, 0, 516, 248, $black, $font, $amount);

// chapter year
imagettftext($img, 48, 0, 447, 330, $black, $font, date('Y'));


imagejpeg($img, __DIR__ . '/img/' . date('Y-m-d') .'.jpg');
