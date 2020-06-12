<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
   <?php
   $ad=new DB("ad");
   $ads=$ad->all(['sh'=>1]);
   foreach($ads as $ad){
       echo $ad['text'];
       echo "&nbsp;&nbsp;&nbsp;&nbsp;";
   }

?>

</marquee>