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
function getrolecontent()
{
    global $db, $role;
    $sql = "select * from ".$role;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
function updateord($num)
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
    global $db, $role, $week, $store, $debt, $cost, $Allcost;
    $ready = 0;
    $nweek = $week+1;
    if ($week < 3) {
        $sql = "INSERT INTO ".$role."(week,store,debt,cost,Allcost) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "iiiii", $nweek, $store, $debt, $cost, $Allcost);
        mysqli_stmt_execute($stmt);
    } else {
        $sql = "UPDATE ".$role." set store = ?, debt = ?, cost = ?, Allcost = ? where week = ".$nweek;
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $store, $debt, $cost, $Allcost);
        mysqli_stmt_execute($stmt);
    }
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
    $sql = "select Allcost from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['Allcost'];
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
function InsertNextSend($s, $nweek)
{
    global $db, $role;
    $sql = "INSERT INTO ".$role."(week, send) VALUES (?,?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $nweek, $s);
    mysqli_stmt_execute($stmt);
}
function getAllCost($role)
{
    global $db, $week;
    $sql = "select Allcost from ".$role." where week = ".$week;
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    return $rs['Allcost'];
}
function Counting()
{
    global $db, $role, $week, $count, $cost, $Allcost, $debt;
    global $store;//新庫存=舊庫存
    $arr = array("retailer","wholesaler","distributor","factory");
    if ($week > 3 && $week < 4){
        for ($i = 0; $i < 4; $i++){
            if ($role == $arr[0]){
                //+到貨
                $store += getSend($arr[$i+1],$week-2);
                //更新下周到貨後出貨
                if ($store > getSysDem()+getDebt())
                    InsertNextSend(getSysDem()+getDebt(),$week+1);
                else
                    InsertNextSend($store,$week+1);
                //-訂單
                $store -= getSysDem();
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
                break;
            } else if ($role == $arr[$i] && $i != 3){
                //+到貨
                $store += getSend($arr[$i+1],$week-2);
                //更新下周到貨後出貨
                if ($store > getOrd($arr[$i-1],$week)+getDebt())
                    InsertNextSend(getOrd($arr[$i-1],$week)+getDebt(),$week+1);
                else
                    InsertNextSend($store,$week+1);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
                break;
            } else if ($i == 3) {
                //+到貨
                $store += getOrd($role,$week-2);
                //更新下周到貨後出貨
                if ($store > getOrd($arr[$i-1],$week)+getDebt())
                    InsertNextSend(getOrd($arr[$i-1],$week)+getDebt(),$week+1);
                else
                    InsertNextSend($store,$week+1);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
            }
        }
    } else if ($week == 3){
        for ($i = 0; $i < 4; $i++){
            if ($role == $arr[0]){
                //更新本周出貨量
                if ($store > getSysDem())
                    UpdateSend(getSysDem());
                else
                    UpdateSend($store);
                //+到貨
                $store += getSend($arr[$i+1],$week-2);
                //更新下周到貨後出貨
                if ($store > getSysDem()+getDebt())
                    InsertNextSend(getSysDem()+getDebt(),$week+1);
                else
                    InsertNextSend($store,$week+1);
                //-訂單
                $store -= getSysDem();
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
                break;
            } else if ($role == $arr[$i] && $i != 3){
                //更新本周出貨量
                if ($store > getOrd($arr[$i-1],$week))
                    UpdateSend(getOrd($arr[$i-1]));
                else
                    UpdateSend($store);
                //+到貨
                $store += getSend($arr[$i+1],$week-2);
                //更新下周到貨後出貨
                if ($store > getOrd($arr[$i-1],$week)+getDebt())
                    InsertNextSend(getSysDem()+getDebt(),$week+1);
                else
                    InsertNextSend($store,$week+1);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
                break;
            } else if ($i == 3) {
                //更新本周出貨量
                if ($store > getOrd($arr[$i-1],$week))
                    UpdateSend(getOrd($arr[$i-1]));
                else
                    UpdateSend($store);
                //+到貨
                $store += getOrd($role,$week-2);
                //更新下周到貨後出貨
                if ($store > getOrd($arr[$i-1],$week)+getDebt())
                    InsertNextSend(getOrd($arr[$i-1],$week)+getDebt(),$week+1);
                else
                    InsertNextSend($store,$week+1);
                //-訂單
                $store -= getOrd($arr[$i-1],$week);
                //-欠貨
                $store -= getDebt();
                if ($store < 0){
                    $debt = abs($store);
                    $store = 0;
                } else
                    $debt = 0;
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
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
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
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
                $cost = $store + 2 * $debt;
                $Allcost += $store + 2 * $debt;
                break;
            }
        }
    } else 
        Gameover();
}
function Gameover()
{
    require("roomControl.php");
    global $db, $RoomNo, $role, $Allcost, $score, $week;
    $RoomName = getRoomName();
    $leader = getLeader();
    $status = checkStatus();
    if ($status == 1){
        $arr = array("retailer","wholesaler","distributor","factory");
        for ($i = 0; $i < 4; $i++)
            $score += getAllCost($arr[$i]);
            
        $sql = "INSERT INTO rank(roomNo, name, leaderID, score) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "issi", $RoomNo, $RoomName, $leader, $score);
        mysqli_stmt_execute($stmt);
        
        $sql = "DELETE FROM content WHERE roomNo = ".$RoomNo." and role = ?";
        $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "s", $role);
        mysqli_stmt_execute($stmt);
        
        header("Location: Gameover.php?roomNo=$RoomNo");
        
        
        
        $sql = "select count(*) c from content where roomNo = ".$RoomNo;
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rs = mysqli_fetch_assoc($result);
        if ($rs['c'] == 0){
            for ($i = 0; $i < 4; $i++){
                $sql = "DELETE FROM ".$arr[$i]." where 1";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_execute($stmt);
            }
            
            
            $sql = "UPDATE list set status = 2 where roomNo = ".$RoomNo;
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_execute($stmt);
            
            $sql = "DELETE FROM period where 1";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_execute($stmt);
        }
    }
    
}
?>