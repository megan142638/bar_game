<?php
//下次下單的數量初始值為-1,判定每個人的下單數量,若皆大於0則進行下一輪
//用for迴圈判斷四個角色,if(上游當期庫存>=下游三week前下單量){3week前下單量=下游庫存增加量}else{3week前下單量=上游庫存增加量}
//庫存:當期庫存量+三週前訂單得到的數量(第2行)-下游當期訂單=當期庫存量
//成本:if(當期庫存量>0){庫存*1}else(當期庫存小於0){庫存*(-2)}

//玩家輸入訂貨量存到order裡,第一期存到temp1,第二期存到temp2,第五期存到temp1
//每過一期count++
//每個角色的庫存初始值為15







//最終成本:第50期結束4個玩家成本加總
/*
庫存:
A:      上期剩餘庫存 + 2週前向上游要得訂單                                 - 3週前給下游的訂單(當前持有庫存VS訂單)
B、C:   上期剩餘庫存 + 3週前向上游要得訂單(當前上游持有庫存VS三週前訂單量) - 3週前給下游的訂單(當前持有庫存VS訂單)
D:      上期剩餘庫存 + 3週前向上游要得訂單(當前上游持有庫存VS三週前訂單量) - 消費者當週訂單(當前持有庫存VS這週消費者訂單)

2週前 -> 前兩週當作為0   3週前 -> 前三週當作為0*/
require_once("dbconfig.php");
function addOrder($uID) 
{
    global $db;
        $sql = "insert into order (role, temp1) values (?, ?);";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "", );
        mysqli_stmt_execute($stmt); //執行SQL
        return mysqli_stmt_insert_id($stmt );

    return NULL;
}



?>

