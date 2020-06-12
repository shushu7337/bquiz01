<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">最新消息資料管理</p>
    <!-- 因為這裡被include到 admin.php 所以是從admin.php的位置去找尋 -->
    <form method="post" action="api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="80%">最新消息資料</td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                </tr>
                <?php
                    $table=$do;
                    $db=new DB($table);
                    $total=$db->count();
                    $num=4;
                    $pages=ceil($total/$num);
                    $now=(!empty($_GET['p']))?$_GET['p']:1;
                    $start=($now-1)*$num;
                    $rows=$db->all([],"limit $start,$num");
                    foreach($rows as $row){
                        $isChk=($row['sh']==1)?'checked':'';
                ?>
                <tr style="text-align: center;">
                
                    <td width="80%"><textarea name="text[]"  style='width:90%;height:60px'><?=$row['text'];?></textarea></td>
                    <td width="10%">
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$isChk;?>>
                    </td>
                    <td width="10%">
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
                    </td>
                    <!-- 藏值 -->
                    <input type="hidden" name="table" value="<?=$table;?>">
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <div style="text-align:center;">
                    <?php
                    //如果now大於零顯示上一頁符號
                    if(($now-1)>0){
                    ?>
                        <a class="bl" style="font-size:30px;" href="?do=<?=$table;?>&p=<?=($now-1);?>">&lt;&nbsp;</a>
                    <?php
                        }
                    ?>
                    <?php
                        for($i=1;$i<=$pages;$i++){
                            $fontsize=($i==$now)?'30px':'24px'
                    ?>
                        <a class="bl" style="font-size:<?=($fontsize);?>;" href="?do=<?=$table;?>&p=<?=$i;?>"><?=$i;?></a>
                    <?php
                        }
                    ?>
                    <?php
                    if(($now+1)<=$pages){
                    ?>
                        <a class="bl" style="font-size:30px;" href="?do=<?=$table;?>&p=<?=($now+1);?>">&nbsp;&gt;</a>
                    <?php
                    }
                    ?>
                </div>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px"><input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/news.php?table=<?=$table;?>&#39;)" value="新增最新消息資料">
                    </td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>