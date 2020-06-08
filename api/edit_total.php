<?php
include_once '../base.php';
// 撈出total資料表
$total=new DB('total');
// 資料表total內只有一筆資料(id=1)
$row=$total->find(1);
$row['total']=$_POST['total'];
$total->save($row);

to("../admin.php?do=total");


?>