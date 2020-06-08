<?php
include_once '../base.php';
$table=$_POST['table'];
$db=new DB($table);
foreach($_POST['id'] as $key=>$id){
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        $db->del($id);
    }else{ 
        $row=$db->find($id);
        if(!empty($_POST['text'])){
            $row['text']=$_POST['text'][$key];
        }
        if($table=='title'){
        $row['sh']=($_POST['sh']==$id)?1:0;
    }else{
        $row['sh']=(!empty($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        }
        $db->save($row);
    }
}
to("../admin.php?do=$table");


?>