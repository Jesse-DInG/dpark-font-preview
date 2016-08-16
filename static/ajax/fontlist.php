<?php
header ( 'Content-type: application/json;charset=utf-8' );
$dirname='fonts'; //要遍历的目录名字
$dir_handle=opendir($dirname);
echo '{"code":0,"fonts":[';
$fontstr='';
while($file=readdir($dir_handle))
   {
     if($file!="."&&$file!="..")
     {
        $fontstr=$fontstr. '"' .$file. '",';
     }
   }
   echo substr($fontstr,0,-1);
   echo ']}';
?>