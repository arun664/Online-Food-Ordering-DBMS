<?php
    session_start();
    require_once('../includes/DbConnection.php');
    
    if(isset($_SESSION['type'])&&$_SESSION['type']===2){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_GET)&& !empty($_GET)){
        $orderid=$_GET['orderid'];
    }
    $sql="SELECT * FROM `order_fooditems` join fooditems on order_fooditems.fooditems_id = fooditems.id WHERE order_id = {$orderid} ";
    $order=mysql_query($sql);
    $query="Select * from address where user_id={$_SESSION['userid']}";
    $addresses=mysql_query($query);
    $query="Select * from discount where status=1";
    $discount=mysql_query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit order</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard2.css" rel="stylesheet">
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">FoodOrder.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
            <li><a href="../logout.php">Logout</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
          
        </div>
      </div>
    </nav>
	<script>
        <?= $msg ?>
	</script>
    <div class="container">
		<h1 style="color:#fff"><center>Welcome to FoodOrder</center></h1>
		<h3 style="color:#fff"><center>Pamper yourself with the most delicious food items</center></h3>
        <div class="row">
            <table class="table table-striped";style="color:#fff">
				<thead>
				<tr style="color:#fff">
					<th>Name</th>
                    <th>Price</th>
					<th>Quantity</th>
                    <th>Remarks</th>
					<th>Total</th>
				</tr>
				</thead>
                <tbody>
                <?php 
                    $total=0;
                    while($item=mysql_fetch_assoc($order)){
                ?>
                <tr>
                    <form action="waiter.php" method="post">
                    <input name="itemid" value="<?= $item['fooditems_id'] ?>" type=number readonly style="visibility:hidden;">
                    <input name="orderid" value="<?= $item['order_id'] ?>" type=numberreadonly style="visibility:hidden;">
                    <td><?= $item['itemname'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><input name="qty"  value="<?= $item['quantity'] ?>" type=number></td>
                    <td><input name="remarks"  value="<?= $item['remarks'] ?>" type=text></td>
                    <td><?= $item['price']*$item['quantity']  ?></td>
                    <td>
                        <button name="update" class="btn btn-success">Update</button>
                        <button name="remove" class="btn btn-danger">Delete</button>
                    </td>
                    </form>
                </tr>
				<tr>
				</tr>
                <?php 
                        $total+=$item['price']*$item['quantity'];
                    } 
                ?>
                <tr>
                    <th>TOTAL</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?=$total?></td>
                </tr>
				<tr>
				</tr>
                </tbody>
            </table>
        </div>
        
        <div class="row">
            
            
        </div>
        
		<div class=row>
			<center>
				<form action="placeorder.php" method="post">
                    <h4 style="color:#fff">Select your address or <a href="address.php" target="_blank">Add new address</a></h4>
                    <table class="table">
                        <?php
                            while($address=mysql_fetch_assoc($addresses)){
                        ?>
                        <tr style="color:#fff">
                            <td><input type="radio" name="addr" class="radio" value="<?=$address["id"] ?>" required></td>
                            <td>
                                <?=$address["name"] ?>
                                <br><?=$address["line1"] ?>
                                <br><?=$address["line2"] ?>
                                <br><?=$address["city"] ?>
                                <br>
                                <br>Ph: <?=$address["phone"] ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <h4 style="color:#fff">Select a Coupon</h4>
                    <table class="table" style="color:#fff">
                    <?php 
                        if($coupon=mysql_fetch_assoc($discount)){
                            do{
                                if($coupon['minprice']<=$total){
                                    echo "<tr>";
                                    echo "<td><input type=\"radio\" name=\"coupon\" class=\"radio\" value=".$coupon["id"]."></td>";
                                    echo "<td><span>".$coupon['code']."</span></td>";
                                    echo "</tr>";
                                }
                            }while($coupon=mysql_fetch_assoc($discount));
                        }else{
                            echo "No coupons available.";
                        }
                    ?>
                    </table>
					<input name=orderno value=<?= $orderid ?> style="visibility:hidden" readonly>
					<button type="submit" class="btn btn-lg btn-block btn-success">Place Order</button>
				</form>
			</center>
		</div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery-1.9.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/holder.min.js"></script>

</body></html>