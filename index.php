<?php include_once "base.php";?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>卓越科技大學校園資訊系統</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css">
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/js.js"></script>
</head>

<body>
    <div id="cover" style="display:none; ">
        <div id="coverr">
            <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;"
                onclick="cl(&#39;#cover&#39;)">X</a>
            <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
        </div>
    </div>
    <iframe style="display:none;" name="back" id="back"></iframe>
    <div id="main">
    <?php $title=new DB('title') ;
            $ti=$title->find(['sh'=>1]);
    ?>
        <a title="<?=$ti['text'];?>" href="index.php">
            <div class="ti" style="background:url(&#39;img/<?=$ti['img'];?>&#39;); background-size:cover;"></div>
            <!--標題-->
        </a>
        <div id="ms">
            <div id="lf" style="float:left;">
                <div id="menuput" class="dbor">
                    <!--主選單放此-->
                    <span class="t botli">主選單區</span>
                    <?php
                    // 呼叫主選單
                    $menu=new DB("menu");
                    $mains=$menu->all(['parent'=>0,'sh'=>1]);
                    foreach ($mains as $main){
                        echo "<div class='mainmu'>";
                        echo "<a href='".$main['href']."'>";
                        echo $main['name'];
                        echo "</a>";

                        // 先判斷有沒有次選單
                        // select count(*) from `menu` where parent=?
                        $chksub=$menu->count(['parent'=>$main['id']]);
                        if($chksub>0){
                            // 用迴圈拿回所有次選單
                            $subs=$menu->all(['parent'=>$main['id']]);
                            // 使用foreach印出
                            echo "<div class='mw'>";
                            foreach($subs as $sub){
                                echo "<div class='mainmu2'><a href='".$sub['href']."'>".$sub['name']."</a></div>";
                            }
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    ?>
                </div>
                <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                    <span class="t">進站總人數 :<?php
                        $total=new DB("total");
                        $tt=$total->find(1);
                        echo $tt['total'];?></span>
                </div>
			</div>
            <?php 
				$do=(!empty($_GET['do']))?$_GET['do']:'main';
				$file='front/'.$do.".php";
				// 判斷檔案是否存在
				if(file_exists($file)){
					include $file;
				}else{
					include 'front/main.php';
				}
				?>
            <div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                <!--右邊-->
                <?php
                // 如果session是空的 就顯示登入，如果else顯示返回管理
                    if(empty($_SESSION['login'])){
                ?>
                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
                    onclick="lo(&#39;?do=login&#39;)">管理登入</button>
                <?php
                    }else{
                ?>
                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
                    onclick="lo(&#39;admin.php?&#39;)">返回管理</button>
                <?php
                    }
                ?>

                <div style="width:89%; height:480px;" class="dbor">
                    <span class="t botli">校園映象區</span>
                    <div style="text-align:center;margin:5px" onclick="pp(1)"><img src="icon/up.jpg" alt=""></div>
                    <?php
                        $image=new DB("image");

                        $ims=$image->all(['sh'=>1]);
                        foreach($ims as $key=>$im){
                            echo "<div style='text-align:center;margin:3px' id='ssaa$key' class='im'>";
                            echo "<img src='img/".$im['img']."' style='width:150px;height:103px;border:3px solid orange'>";
                            echo "</div>";
                        }
                    ?>
                    <div style="text-align:center;margin:5px" onclick="pp(2)"><img src="icon/dn.jpg" alt=""></div>
                    <script>
                    var nowpage = 0,//現在的頁數
                        num = <?=$image->count(['sh'=>1]);?>;    //圖片的數量

                    function pp(x) {//
                        var s, t;
                        if (x == 1 && nowpage - 1 >= 0) {
                            nowpage--;
                        }
                        if (x == 2 && nowpage + 1 <= num - 3 ) {
                            nowpage++;
                        }
                        $(".im").hide()
                        for (s = 0; s <= 2; s++) {
                            // 往後加三
                            t = s * 1 + nowpage * 1;
                            // 顯示圖片
                            $("#ssaa" + t).show()
                        }
                    }
                    pp(1)
                    </script>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div
            style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
            <span class="t" style="line-height:123px;">
            <?php 
                $bottom=new DB('bottom');
                $bt=$bottom->find(1);
                echo $bt['bottom'];
            ?>
        </span>
        </div>
    </div>

</body>

</html>