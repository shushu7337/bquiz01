<?php 
include_once "../base.php";

$db=new DB("menu"); //$_GET['table']

// 來做編輯或新增的判斷

// 如果有id的話表示這個資料需要編輯
if(!empty($_POST['id'])){
    foreach($_POST['id'] as $key=>$id){
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            $db->del($id);
        }else{
            // 找到該id
            $row=$db->find($id);
            // 讓找到的name值等於得到的name的key值
            $row['name']=$_POST['name'][$key];
            $row['href']=$_POST['href'][$key];
            $db->save($row);
        }
    }
}
$parent=$_POST['parent'];
// 新增
if(!empty($_POST['name2'])){
    foreach($_POST['name2'] as $key => $name){
        $new=[];
        $new['name']=$name;
        $new['href']=$_POST['href2'][$key]; 
        $new['sh']=1 ; 
        $new['parent']=$parent;
        $db->save($new);
    }
}

to("../admin.php?do=menu");


?>