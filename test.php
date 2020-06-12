<style>
table{
    border-collapse:collapse;
}
table td{
    border:1px solid black;
    padding:5px 10xp;
}


</style>


<?php

    $array=[
        'header'=>[
            ['網站標題','45%'],
            ['替代文字','23%'],
            ['顯示','7%'],
            ['刪除','7%'],
            ['操作','7%'],
            ],
        'rows'=>[
            ["<img src='img/01B01.jpg'","<input type='text' name='text' value='AAAAAA'>","<input type='radio' name='sh' value='1'>",'checkbox','button'],
            ["<img src='img/01B02.jpg'","<input type='text' name='text' value='AAAAAA'>","<input type='radio' name='sh' value='1'>",'checkbox','button'],
            ["<img src='img/01B03.jpg'","<input type='text' name='text' value='AAAAAA'>","<input type='radio' name='sh' value='1'>",'checkbox','button'],
            ["<img src='img/01B04.jpg'","<input type='text' name='text' value='AAAAAA'>","<input type='radio' name='sh' value='1'>",'checkbox','button'],
        ],
    
    ];

function makeTable($array){
    // 先把header的內容畫出來產生第一列
    echo "<table>";
    echo "<tr>";
    foreach($array['header'] as $header){
        echo "<td>$header</td>";
    }
    echo "</tr>";
    foreach($array['rows'] as $row){
        echo "<tr>";
        foreach($row as $col){
            echo "<td>$col</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
makeTable($array);


?>