<?php
    session_start();
    require_once('../includes/DbConnection.php');

    if(isset($_SESSION['type'])&&$_SESSION['type']===2){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_POST)&& !empty($_POST)){
        if(isset($_POST['add'])){
            $itemid=stripslashes(mysql_real_escape_string(trim($_POST['itemid'])));
            $orderid=stripslashes(mysql_real_escape_string(trim($_POST['orderid'])));
            $qty=stripslashes(mysql_real_escape_string(trim($_POST['qty'])));
            $remarks=stripslashes(mysql_real_escape_string(trim($_POST['remarks'])));
            $sql="INSERT INTO `order_fooditems`(`order_id`, `fooditems_id`, `quantity`, `remarks`) VALUES ({$orderid},{$itemid},{$qty},'{$remarks}')";
            if(mysql_query($sql)){
                header("Location: editorder.php?orderid={$orderid}");
            }
            die(mysql_error());
        }
        if(isset($_POST['update'])){
            $itemid=stripslashes(mysql_real_escape_string(trim($_POST['itemid'])));
            $orderid=stripslashes(mysql_real_escape_string(trim($_POST['orderid'])));
            $qty=stripslashes(mysql_real_escape_string(trim($_POST['qty'])));
            $remarks=stripslashes(mysql_real_escape_string(trim($_POST['remarks'])));
            $sql="UPDATE `order_fooditems` set `quantity`={$qty}, `remarks`= '{$remarks}' where `order_id`={$orderid} and `fooditems_id`={$itemid}";
            if(mysql_query($sql)){
                header("Location: revieworder.php?orderid={$orderid}");
            }
            die(mysql_error());
        }
		 if(isset($_POST['remove'])){
            $itemid=stripslashes(mysql_real_escape_string(trim($_POST['itemid'])));
            $orderid=stripslashes(mysql_real_escape_string(trim($_POST['orderid'])));
            $qty=stripslashes(mysql_real_escape_string(trim($_POST['qty'])));
            $remarks=stripslashes(mysql_real_escape_string(trim($_POST['remarks'])));
            $sql="DELETE FROM `order_fooditems` where `order_id`={$orderid} and `fooditems_id`={$itemid}";
            if(mysql_query($sql)){
                header("Location: revieworder.php?orderid={$orderid}");
            }
            die(mysql_error());
        }
    }
?>