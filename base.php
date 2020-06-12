<?php
session_start();
class DB{
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

        //將傳入的資料表名稱指定給類別內的資料表變數table
        $this->table=$table;
        //建立pdo的連線資訊，並將pdo連線指定給類別內的變數pdo
        $this->pdo=new PDO($this->dsn,$this->root,$this->password);        
    }

// --取得全部資料--

    // 這裡就不用像之前base檔需要再打$table 名稱

        //判斷第一個參數是否存在同時是否為陣列
        //我們自行規範第一個參數必須為陣列才進行處理
        //如果第一個參數不是陣列,則跳過不處理
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

    public function save($arg){
        if(!empty($arg['id'])){
            // update
            // update $this->table set xxx=yyy where `id`='xxx'
            foreach($arg as $key => $value){
                // 直接這樣寫的話id也會直接被放進去可以新增判斷式避免id被更改
                if($key!='id'){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }
            }
            $sql="update $this->table set ".implode(",",$tmp)." where `id`='".$arg['id']."'";
        }else{
            // insert
            // insert into $this->table (``,``,``) values('','','')

            $sql="insert into $this->table (`".implode("`,`",array_keys($arg))."`) values('".implode("','",$arg)."')";
        }

        return $this->pdo->exec($sql);
    }

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
    // exec回傳被影響資料筆數
}

// --萬用語法--
function q($sql){
    return $this->pdo->query($sql)->fetchAll();
}

}

// --頁面導向--
function to($url){
    header("location:".$url);
}

// 判斷使用者是否到訪過
if(empty($_SESSION['visited'])){
    $total=new DB('total');
    $tt=$total->find(1);
    $tt['total']++;
    $total->save($tt);
    $_SESSION['visited']=$tt['total'];
}
?>