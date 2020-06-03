<?php
include_once "../base.php";
// 先準備好資料表
$title=new DB('title');

// 判斷圖片有沒有上傳成功
if(!empty($_FILES['img']['tmp_name'])){
    // 得到檔名
    $filename=$_FILES['img']['name'];
    // 這裡如果用一樣檔名而內容不同時會被直接覆蓋
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$filename);
}
$text=$_POST['text'];
$sh=0;

$title->save(['text'=>$text,'img'=>$filename,'sh'=>$sh]);

// 先回到上個頁面的admin.php再載入到title
to("../admin.php?do=title");


// 總流程: wiew.php->ajax->load->admin.php(submit)->api/insert_title.php(save)->admin.php

?>