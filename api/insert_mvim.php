<?php
include_once "../base.php";
$mvim=new DB('mvim');
if(!empty($_FILES['img']['tmp_name'])){
    $filename=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$filename);
}
// 沒有text欄位但還是要給一個空值要不然會有問題，要不然就是把save欄位的'text'拿掉
// $text="";
$sh=1;
$mvim->save(['img'=>$filename,'sh'=>$sh]);
to("../admin.php?do=mvim");

?>