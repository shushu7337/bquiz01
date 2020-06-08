<?php
include_once "../base.php";

// 先判斷檔案有沒有上傳成功，再來進行下一步驟
$title=new DB('title');
$row=$title->find($_POST['id']);
if(!empty($_FILES['img']['tmp_name'])){
    $filename=$_FILES['img']['name'];
    // 將上傳檔案移動到檔案目錄下 (移動到上一層的img內)
    move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$filename);
    // 更新資料 (檔名一樣的話會直接覆蓋，檔名不同的話要先撈出來再回存)
    // 如果有更新的話
    $row['img']=$filename;
    // 如果沒上傳就不做任何事情，上傳的話及存取
    $title->save($row);
}
to("../admin.php?do=title");
?>