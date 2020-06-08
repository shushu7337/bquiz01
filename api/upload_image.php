<?php
include_once "../base.php";

$image=new DB('image');
$row=$image->find($_POST['id']);
if(!empty($_FILES['img']['tmp_name'])){
    $filename=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$filename);
    $row['img']=$filename;
    $image->save($row);
}
to("../admin.php?do=image");
?>