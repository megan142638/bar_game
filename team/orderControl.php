<?php
function getRole()
{
    global $db, $id;
    $sql = "select role from content where loginID = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['role'];
}
function getcontent()
{
    global $db, $role;
    $sql = "select * from ".$role;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function update($num)
{
    global $db, $role, $week;
    $sql = "UPDATE ".$role." set ord = ? where week = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $num, $week);
    mysqli_stmt_execute($stmt);
}
function getWeek()
{
    global $db, $role;
    $sql = "select * from period";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['week'];
}
function checknext()
{
    global $db, $week, $ready;
    //$week = getWeek();
    $arr = array("retailer","wholesaler","distributor","factory");
    for ($i = 0; $i < 4; $i++)
        if (getOrd($arr[$i],$week) !== null)
            $ready++;
    if ($ready == 4){
        $ready = 0;
        return 1;
    }
    else
        return 0;
}
function nextweek()
{
    global $db, $role, $week, $store, $debt, $cost;
    $ready = 0;
    $nweek = $week+1;
    $sql = "INSERT INTO ".$role."(week,store,debt,cost) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $nweek, $store, $debt, $cost);
    mysqli_stmt_execute($stmt);
    
    $arr = array("retailer","wholesaler","distributor","factory");
    for ($i = 0; $i < 4; $i++)
        if (checkinsert($arr[$i],$nweek) > 0)
            $ready++;
    if ($ready == 4){
        $sql = "UPDATE period set week = ".$nweek;
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($stmt);
    }
}
function checkinsert($role, $week)
{
    global $db;
    $sql = "select cost from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['cost'];
}
function getOrd($role, $week)
{
    global $db;
    $sql = "select ord from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['ord'];
}
function getStore()
{
    global $db, $role, $week;
    $sql = "select store from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['store'];
}
function getDebt()
{
    global $db, $role, $week;
    $sql = "select debt from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['debt'];
}
function getSend($role, $week)
{
    global $db;
    $sql = "select send from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['send'];
}
function getSysDem()
{
    global $db, $week;
    $sql = "select demand from admset where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['demand'];
}
function UpdateSend($s)
{
    global $db, $role, $week;
    $sql = "UPDATE ".$role." set send = ".$s." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
}
function getCost()
{
    global $db, $role, $week;
    $sql = "select cost from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['cost'];
}
function Counting()
{
    global $db, $role, $week, $count, $cost, $debt;
    global $store;//新庫存=舊庫存
    $arr = array("retailer","wholesaler","distributor","factory");
    if ($week >= 3 && $week <= 50){
        for ($i = 0; $i < 4; $i++){
            if ($role == $arr[0]){
                //更新本周出貨量
                if ($store > getSysDem())
                    UpdateSend(getSysDem());
                else
                    UpdateSend($store);
                //+到貨
                $store += getSend($arr[$i+1],$week-2);
                //-訂單
                $store -= getSysDem();
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost += $store + 2 * $debt;
                break;
            } else if ($role == $arr[$i] && $i != 3){
                //更新本周出貨量
                if ($store > getOrd($arr[$i-1],$week))
                    UpdateSend(getOrd($arr[$i-1],$week));
                else
                    UpdateSend($store);
                //+到貨
                $store += getSend($arr[$i+1],$week-2);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost += $store + 2 * $debt;
                break;
            } else if ($i == 3) {
                //+到貨
                $store += getOrd($role,$week-2);
                //更新本周出貨量
                if ($store > getOrd($arr[$i-1],$week))
                    UpdateSend(getOrd($arr[$i-1],$week));
                else
                    UpdateSend($store);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost += $store + 2 * $debt;
                break;
            }
        }
    } else if ($week < 3) {
        for ($i = 0; $i < 4; $i++){
            if ($role == $arr[0]){
                //+到貨=0
                //更新本周出貨量
                if ($store > getSysDem())
                    UpdateSend(getSysDem());
                else
                    UpdateSend($store);
                //-訂單
                $store -= getSysDem();
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost += $store + 2 * $debt;
                break;
            } else if ($role == $arr[$i]) {
                //+到貨=0
                //更新本周出貨量
                if ($store > getOrd($arr[$i-1],$week))
                    UpdateSend(getOrd($arr[$i-1],$week));
                else
                    UpdateSend($store);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost += $store + 2 * $debt;
                break;
            }
        }
    }
    /*for ($i = 0; $i < 4; $i++)
        if (getSend($arr[$i],$week) !== null)
            $count++;
    if ($count == 4){
        $count = 0;
        return 1;
    } else
        return 0;*/
}
?>