<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">網站標題管理</p>
    <!-- 因為這裡被include到 admin.php 所以是從admin.php的位置去找尋 -->
    <form method="post" action="api/edit.php">
        <?php
            $table=new Title;
            echo $table->table();
        ?>

        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                    onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$table->getTable();?>.php?table=<?=$table->getTable();;?>&#39;)"
                    value="新增網站標題圖片"></td>
                    <input type="hidden" name="table" value='<?=$table->getTable();?>'>
                    <td class='cent'><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>