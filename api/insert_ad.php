<?php
include_once "../base.php";
$ad=new DB('ad');
$text=$_POST['text'];
// 除了title欄位是預設0其他都是預設1
$sh=1;
$ad->save(['text'=>$text,'sh'=>$sh]);
to("../admin.php?do=ad");

?>