

<h3 class="cent">編輯次選單</h3>
<hr>
<form action="api/add.php"  method="post" enctype="multipart/form-data">
<table style="width:70%;margin:auto">

    <tr>
        <td style="text-align:right">主選單名稱：</td>
        <td><input type="text" name="name"></td>
    </tr>
    <tr>
        <td style="text-align:right">選單連結網址：</td>
        <td><input type="text" name="href"></td>
    </tr>
</table>
<div style="width:100px;margin:auto">
    <input type="hidden" name="table" value="<?=$_GET['table'];?>">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>