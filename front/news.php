<div class="di"
    style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    <?php include "maquree.php";?>
    <div style="height:32px; display:block;"></div>
<h3 class="float:right;">更多最新消息顯示區</h3>
<hr>
    <!--正中央-->
    <?php
        $table=$do;
        $news=new DB("news");
        // 撈出有total筆資料
        $total=$news->count(['sh'=>1]);
        // 一頁五筆資料
        $num=5;
        // 給予分頁(取天花板 - 無條件進位)
        $pages=ceil($total/$num);
        // 現在是?頁
        $now=(!empty($_GET['p']))?$_GET['p']:1;
        // 資料要從哪一筆開始索取
        $start=($now-1)*$num;
        $ns=$news->all(['sh'=>1],"limit $start,$num");
    ?>
    <ol class="ssaa" start="<?=$start+1;?>">
        <?php
        	foreach($ns as $n){
        ?>
        <li class="sswww"><?=mb_substr($n['text'],0,20,'utf8');?>...
        	<div class='all' style="display:none"><?=$n['text'];?></div>
        </li>
        <?php
        	}
        ?>
    </ol>
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
</div>
<div id="alt"
    style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
</div>
<script>
$(".sswww").hover(
    function() {
        $("#alt").html("<pre>" + $(this).children(".all").html() + "</pre>").css({
            "top": $(this).offset().top - 50
        })
        $("#alt").show()
    }
)
$(".sswww").mouseout(
    function() {
        $("#alt").hide()
    }
)
</script>
            