<?php
include_once '../base.php';

// 撈出title資料表

$title=new DB('title');

// 如果在外面時請檢查$_POST會不會被帶入奇怪的資料
foreach($_POST['id'] as $key=>$id){
    // 沒有被刪除的資料才是要更新的資料，所以先判斷del陣列有沒有正在處理的id，如果沒有的話這筆資料就是要做更新，並update回資料庫。
    // 先判斷del有沒有存在(del是空的話直接跳過，並檢查相符的陣列有的話就直接刪除)
    // ex 原先共有四筆資料sh=1,sh=2,sh=3,sh=4    del=[2,4] sh=1  即sh=2 , sh=4的資料都會被刪除，另外兩筆資料則會被更新
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
       
        $title->del($id);

    }else{ 

        // 先把原本資料拿出來
        $row=$title->find($id);
        // 把這份資料指定[text],並對應相對的位置([$key])來做更新
        $row['text']=$_POST['text'][$key];
        // 指定[sh]做更新,在這裡要做判斷,如果是的話sh=1 如果不是的話 sh=0
        // sh只有一筆為1其他為0
        // 但這個寫法有破綻，如果資料庫沒有一筆資料預設sh為1的話就會有錯
        $row['sh']=($_POST['sh']==$id)?1:0;
        // 回存
        $title->save($row);
    }

}
to("../admin.php?do=title");


?>