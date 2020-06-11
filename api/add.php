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

// 改成switch做判斷因應admin沒有相對應欄位
switch($table){

    case "title":
        $data['text']=$_POST['text'];
        $data['sh']=0;
    break;

    case "admin":
        $data["acc"]=$_POST['acc'];
        $data["pw"]=$_POST['pw'];
    break;
    case "menu":
        $data["name"]=$_POST['name'];
        $data["href"]=$_POST['href'];
    break;

    default:
    $data['text']=$_POST['text'];
    $data['sh']=1;

}



// 直接做儲存$data
$db->save($data);
// 從哪個table來回到哪個table
to("../admin.php?do=$table");

?>