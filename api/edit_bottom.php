<?php
include_once '../base.php';
// 撈出total資料表
$bottom=new DB('bottom');
// 資料表bottom內只有一筆資料(id=1)
$row=$bottom->find(1);
$row['bottom']=$_POST['bottom'];
$bottom->save($row);

to("../admin.php?do=bottom");


?>