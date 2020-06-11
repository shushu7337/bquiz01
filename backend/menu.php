<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">主選單管理</p>
    <!-- 因為這裡被include到 admin.php 所以是從admin.php的位置去找尋 -->
    <form method="post" action="api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="30%">主選單名稱</td>
                    <td width="30%">選單連結網址</td>
                    <td width="10%">次選單數</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td width="10%"></td>
                </tr>
                <?php
                
                    $table=$do;
                    $db=new DB($table);
                    // 給予只選擇主選單條件
                    $rows=$db->all(['parent'=>0]);
                    foreach($rows as $row){
                        $isCheck=($row['sh']==1?"checked":"");
                ?>
                <tr style="text-align: center;">
                    <td><input type="text" style="width:90%" name="name[]" value="<?=$row['name'];?>"></td>  
                    <td><input type="text" style="width:90%" name="href[]" value="<?=$row['href'];?>"></td>
                    <!-- 從db計算出parent欄位有幾個id -->
                    <td><?=$db->count(['parent'=>$row['id']]);?></td> 
                    <td> <input type="checkbox" name="sh[]" value="<?=$row['id'];?>"<?=$isCheck;?>></td>
                    <td> <input type="checkbox" name="del[]" value="<?=$row['id'];?>"></td>
                    <td><input type="button" value="編輯次選單" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/submenu.php?id=<?=$row['id'];?>&table=<?=$table;?>&#39;)" value="編輯次選單"></td>
                    <!-- 藏值 -->
                    <input type="hidden" name="table" value="<?=$table;?>">
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/menu.php?table=<?=$table;?>&#39;)" value="新增主選單">
                    </td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>