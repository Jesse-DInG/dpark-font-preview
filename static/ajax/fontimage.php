<?php
header ( 'Content-type: image/png' );
header ( 'Cache-control: max-age=86400' );
header ( 'Pragma: Pragma' );

$font_size = 40;
$text =  $_GET["text"];
$font = './fonts/' . $_GET["font"];
//$font  =   iconv("UTF-8","gb2312",$font);
// Get image Width and Height

// Get Bounding Box Size
$text_box = imagettfbbox($font_size,0,$font,$text);
// var_dump($text_box);
// Get your Text Width and Height
$text_width = $text_box[2]-$text_box[0];
$text_height = $text_box[1] - $text_box[7];

// var_dump("text_width".$text_width);
// var_dump("text_height".$text_height);
// Calculate coordinates of the text
// $x = ($image_width/2) - ($text_width/2);
// $y = ($image_height/2) - ($text_height/2);

// $text_width = $fontarea[2]-$fontarea[0]+($font_size/3); 
// //$text_width = 400;
// $text_height = $fontarea[1]-$fontarea[7]+($font_size/3);
//$text_height = 400;
$y = (100-$text_height)/2+$text_height;
$im = imagecreate( $text_width+20 , 100 );
imageantialias($im, true);
$bg = imagecolorallocatealpha($im,0,0,0,0 );
$color = imagecolorallocate ( $im , 0 , 0 , 0);
imagettftext ( $im , $font_size , 0 , 0, $y , $color , $font , $text );
//imagettftext ( $im , $font_size , 0 , -1, $text_height-1 , $color , $font , $text );
imagecolortransparent($im,$bg);
imagepng ( $im );
imagedestroy ($im);
?>
