<?php include_once "../base.php";
$db=new DB($_GET['table']);
//撈出主選單中次選單的內容
$subs=$db->all(["parent"=>$_GET['id']]);

?>

<h3 class="cent">編輯次選單</h3>
<hr>
<form action="api/edit_submenu.php"  method="post" enctype="multipart/form-data">
<table style="width:70%;margin:auto;text-align:center" id="sub">

    <tr>
        <td >次選單名稱</td>
        <td>次選單連結網址</td>
        <td>刪除</td>
    </tr>
    <?php
        foreach($subs as $sub){
    ?>
    <tr>
        <td><input type="text" name="name[]" value="<?=$sub['name'];?>"></td>
        <td><input type="text" name="href[]" value="<?=$sub['href'];?>"></td>
        <td><input type="checkbox" name="del[]" value="<?=$sub['id'];?>"></td>
        <input type="hidden" name="id[]" value="<?=$sub['id'];?>">
    </tr>
    <?php
      }
    ?>
</table>
<div style="width:50%;margin:auto;text-align:center">
    <input type="hidden" name="table" value="<?=$_GET['table'];?>">
    <input type="hidden" name="parent" value="<?=$_GET['id'];?>">
    <input type="submit" value="修改確認">
    <input type="reset" value="重置">
    <input type="button" value="更多次選單" onclick="more()">
</div>
</form>

<script>

function more(){
    let row=`
        <tr>
        <td><input type="text" name="name2[]"></td>
        <td><input type="text" name="href2[]"></td>
        <td></td>
        </tr>

    `
    $('#sub').append(row)
}


</script>