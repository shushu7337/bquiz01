<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">動態文字廣告區</p>
    <!-- 因為這裡被include到 admin.php 所以是從admin.php的位置去找尋 -->
    <form method="post" action="api/edit_ad.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%">動態文字廣告</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                </tr>
                <?php
                    $ad=new DB('ad');
                    // 撈出所有資料
                    $all=$ad->all();
                    // 用迴圈撈各筆
                    foreach($all as $row){
                        // 如果sh==1就會顯示checked
                        $isChk=($row['sh']==1)?'checked':'';
                ?>
                <tr style="text-align: center;">
                    <td width="80%">
                        <input type="text" style="width:90%" name="text[]" value="<?=$row['text'];?>"></td>
                    <td width="10%">
                        <!-- name="sh"要改成陣列顯示=>>name="sh[]" -->
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$isChk;?>>
                    </td>
                    <td width="10%">
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
                    </td>
                    <!-- 藏值 -->
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
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/ad.php&#39;)" value="新增動態文字廣告">
                    </td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>