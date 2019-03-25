<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===1){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_GET['order'])) $orderid=$_GET['order'];
    $sql="SELECT * FROM `order_fooditems` join fooditems on order_fooditems.fooditems_id = fooditems.id WHERE order_id = {$orderid} ";
    $order=mysql_query($sql);

    $sql="SELECT * from orders where id={$orderid}";
    $result=mysql_query($sql);
    $details=mysql_fetch_assoc($result);

    
        $sql="SELECT * from discount where id = {$details['discount_id']}";
        $coupon=mysql_query($sql);
        $discount=mysql_fetch_assoc($coupon);
        $disc=$discount['percent']/100;
        $sql="SELECT * from address where id = {$details['addressid']}";
        $addr=mysql_query($sql);
        $address=mysql_fetch_assoc($addr);
    
    
    
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
    <title>Check Order</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboardadmin.css" rel="stylesheet">
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
          <a class="navbar-brand" href="index.php" >FoodOrder.com</a>
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
    <div class="container" style="color:#fff">
		<h1><center>Welcome to FoodOrder</center></h1>
		<h3><center>Pamper yourself with the most delicious food items</center></h3>
        <div class="row">
            <table class="table table-striped">
				<thead>
				<tr>
					<th>Name</th>
                    <th>Price</th>
					<th>Quantity</th>
                    <th>Remarks</th>
					<th>Total</th>
				</tr>
				</thead>
                <tbody style="color:#212121">
                <?php 
                    $total=0;
                    while($item=mysql_fetch_assoc($order)){
                ?>
                <tr>
                    <td><?= $item['itemname'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['remarks'] ?></td>
                    <td><?= $item['price']*$item['quantity']  ?></td>
                    
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
                    <th><?=$total?></th>
                </tr>
				<tr>
				</tr>
                <?php
                    if(isset($disc)) {
                        $disc=$total*$disc;
                        $total=$total-$disc;
                ?>
                    <tr>
                        <th>Discount</th>
                        <td></td>
                        <td></td>
                        <td><?=$discount['percent']?>%</td>
                        <td>-<?=$disc?></td>
                    </tr>
					<tr>
					</tr>
                    <tr>
                        <th>AMOUNT</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?=$total?></td>
                    </tr>
                    <?php
                }
                    ?>
                </tbody>
            </table>
            
            <div class="row">
                <div class="col-md-4">
                    <h3>Shipping Address:</h3>
                    <?=$address["name"] ?>
                    <br><?=$address["line1"] ?>
                    <br><?=$address["line2"] ?>
                    <br><?=$address["city"] ?>
                    <br>Goa
                    <br>Ph: <?=$address["phone"] ?>
                </div>
                <div class="col-md-8">
                <?php
                        if($details['status']==0){
                    $sql="UPDATE `orders` SET `discount_id`={$discount['id']},`price`={$total},`addressid`={$address['id']},`status`=1 WHERE `id`={$orderid}";
                        if(mysql_query($sql)){
                        ?>
                        
                            <h1 style="color:GREEN"> ORDER PLACED</h1>
                            
                <?php
                        }
                    }
                        ?>
                        
                            <h3>Order Status: <?php
                                switch($details['status']){
                                    case 0: echo "NOT PROCESSED"; break;
                                    case 1: echo "PROCESSED"; break;
                                    case 2: echo "READY"; break;
                                    case 3: echo "IN TRANSIT"; break;
                                    case 4: echo "DELIVERED"; break;
                                }
                            ?></h3>
                        
                     
                
               </div> 
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