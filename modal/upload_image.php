

<h3 class="cent">更新校園映像圖片</h3>
<hr>
<form action="api/upload_image.php" method="post" enctype="multipart/form-data">
<table style="width:70%;margin:auto">
    <tr>
        <td style="text-align:right">校園映像圖片：</td>
        <td><input type="file" name="img"></td>
    </tr>
</table>
<div style="width:100px;margin:auto">
    <input type="hidden" name="id" value="<?=$_GET['id'];?>">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>