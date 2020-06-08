

<h3 class="cent">新增動態文字廣告</h3>
<hr>
<form action="api/add.php"  method="post" enctype="multipart/form-data">
<table style="width:70%;margin:auto">

    <tr>
        <td style="text-align:right">動態文字廣告：</td>
        <td><input type="text" name="text"></td>
    </tr>
</table>
<div style="width:100px;margin:auto">
    <input type="hidden" name="table" value="ad">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
</div>
</form>