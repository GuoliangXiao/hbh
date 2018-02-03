<?php
header('Content-Type:image/png');
$font=0;
$kind=-1;
$name="我爱中国";
$name_simple="我爱中国";
$name_complex="我愛中國";
if(isset($_GET['font'])){
    $font=$_GET['font'];
}
if(isset($_GET['kind'])){
    $kind=$_GET['kind'];
}
if(isset($_GET['name'])){
    $name_simple=$_GET['name'];
}
require_once 'image.php';
if($font<24){
    $name=$name_simple;
}else{
    $name=$name_simple;
}
$img=new SealImage($kind,$name,$font);
imagepng($img->get_result());
?>
