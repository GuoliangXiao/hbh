<?php
$name="爱我中华";
$font=0;
$size=1;//
$line=2;//
$kind=0;
$style=0;
if(isset($_GET['name'])){
    $name=$_GET['name'];
}
if(isset($_GET['font'])){
    $font=$_GET['font'];
}
if(isset($_GET['size'])){
    $size=$_GET['size'];
}
if(isset($_GET['line'])){
    $line=$_GET['line'];
}
if(isset($_GET['kind'])){
    $kind=$_GET['kind'];
}
if(isset($_GET['style'])){
    $style=$_GET['style'];
}
header('Content-Type:image/png');
require_once 'image.php';
//$img=new SealImage(1,"肖国梁很",0, 1 ,2,0);
$img=new SealImage($kind,$name,$font,$size,$line,$style);
imagepng($img->get_result_diy());
?>
