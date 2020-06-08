<?php
include_once "../base.php";
$news=new DB('news');
$text=$_POST['text'];
// 除了title欄位是預設0其他都是預設1
$sh=1;
$news->save(['text'=>$text,'sh'=>$sh]);
to("../admin.php?do=news");

?>