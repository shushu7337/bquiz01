<?php
include_once "../base.php";
$table=$_POST['table'];
$db=new DB($table);

// 先給予一個data的空陣列讓他做暫存;
$data=[];
if(!empty($_FILES['img']['tmp_name'])){
    $filename=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$filename);
    // 如果檔案上傳成功的話,就放到data陣列裡面
    $data['img']=$filename;
}
// 改存入data陣列的['text']欄位
$data['text']=$_POST['text'];
if($table=='title'){
    $data['sh']=0;
}else{
    $data['sh']=1;
}
// 直接做儲存$data
$db->save($data);
// 從哪個table來回到哪個table
to("../admin.php?do=$table");

?>