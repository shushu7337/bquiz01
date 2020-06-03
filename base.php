<?php

class db{
// 設定屬性:用來建立PDO，與常用變數
    private $dsn="mysql:host=localhost;charset=utf8;dbname=db05";
    // 登入資料庫的帳號與密碼
    private $root="root";
    private $password="";
    // 資料庫名稱
    private $table;
    // 先做預設
    private $pdo;

// --設定建構式--

    // __construct(這裡一定要宣告起來是哪個資料庫)
    public function __construct($table){
        // 把db內的table設定成外部顯示的名稱，拿到名稱後可以使用
        // 如果用全域變數設立的話就變成只能include_once
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->root,$this->password);        
    }

// --取得全部資料--

    // 這裡就不用像之前base檔需要再打$table 名稱
    public function all(...$arg){
        // 如果all()沒帶任何參數就撈出全部資料
        $sql="select * from $this->table ";
        // 判斷是否為陣列,  aa如果第一個帶進來的不是變數($arg[0]的部分)
        if(!empty($arg[0]) && is_array($arg[0])){
            foreach($arg[0] as $key => $value){
                // $tmp[]="`$key`='value'";
                // 或者
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
            // 行末+分號，文字連接+空白
            $sql=$sql. " where ".implode(" && ",$tmp);
        }

        if(!empty($arg[1])){
            $sql=$sql.$arg[1];
        }

        // echo $sql;
        // 使用pdo叫出query-sql
        return $this->pdo->query($sql)->fetchAll();
    }




// --取得單筆資料--
public function find($arg){
    $sql="select * from $this->table ";
    // find一定要帶值，故直接判定是否為陣列
    if( is_array($arg)){
        foreach($arg as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql. " where ".implode(" && ",$tmp);
    }else{
        // 這裡直接寫死
        $sql=$sql. " where `id`='$arg'";
    }

    // echo $sql;
    // 告訴pdo不要有索引值，只要有欄位名稱即可
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

// --計算資料筆數--

// PHP內有個全域函式 count 只有在{類別}裡面可以用自訂count函式
public function count(...$arg){
    $sql="select count(*) from $this->table ";
    if(!empty($arg[0]) && is_array($arg[0])){
        foreach($arg[0] as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql. " where ".implode(" && ",$tmp);
    }


    if(!empty($arg[1])){
        $sql=$sql.$arg[1];
    }

    // echo $sql;
    // 只要欄位結果 (fetchColumn(這裡帶值得話就是第幾個欄位，如果如下方沒寫就是預設0))
    return $this->pdo->query($sql)->fetchColumn();

}



// --新增/更新資料--


// --刪除資料--

public function del($arg){
    $sql="delete from $this->table ";
    // +參數
    if( is_array($arg)){
        foreach($arg as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql. " where ".implode(" && ",$tmp);
    }else{
        // 這裡直接寫死
        $sql=$sql. " where `id`='$arg'";
    }

    // echo $sql;
    // 告訴pdo不要有索引值，只要有欄位名稱即可
    return $this->pdo->query($sql);
    // query回傳
    // return $this->pdo->exec($sql);
    // exec回傳被影響資料比數
}


// 萬用語法
function q($sql){
    return $this->pdo->query($sql)->fetchAll();
}

}



function to($url){
    header("location:".$url);
}

?>