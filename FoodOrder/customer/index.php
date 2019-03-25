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
        $sql="INSERT INTO `orders`(`user_id`) VALUES ({$_SESSION['userid']})";
        if(mysql_query($sql)){
                $msg="alert('New Order Created. Click update to complete the order')";    
            }
    }
    $query="SELECT * from orders where user_id={$_SESSION['userid']} order by id DESC";
    $result=mysql_query($query);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <body background="includes/food2.jpg">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome <?= $_SESSION['name']?></title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
    <script>
        <?= $msg  ?>
    </script>
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
          <a class="navbar-brand" href="#">FoodOrder.com</a>
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

    <div class="container">
		<h1 style="color:#fff"><center>Welcome to FoodOrder</center></h1>
		<h3 style="color:#fff"><center>Pamper yourself with the most delicious food items</center></h3>
		<div class="row">
			<center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" ><button type="submit" name="new" class="btn btn-lg btn-success">Create New Order</button></form></center> 
		</div>
		<div class="row" style="margin-top:20px;">
			<table class="table table-striped table-hover">
        		<tbody>
                	<tr>
						<th><center>Order Number</center></th>
                        <th><center>Price</center></th>
						<th><center>Status</center></th>
                        <th><center>#</center></th>
                    </tr>
                    
                        	<?php
							while($row=mysql_fetch_assoc($result)){
								$id= $row['id'];
								$price= (($row['price']==0 or is_null($row['price']))? "Order not completed" : $row['price']);
                                switch($row['status']){
                                    case 1: $status="New";break;
                                    case 2: $status="Ready";break;
                                    case 3: $status="In Transit";break;
                                    case 4: $status="Delivered";break;
                                    case 0: $status="Not completed";
                                }
								echo '<tr><tr>';
                    			echo '<form action="editorder.php" method="get">';
                                echo "<input name=\"orderid\" value=\"{$id}\" style=\"visibility:hidden;\">";
								echo "<td><center>{$id}</center></td>";
								echo "<td><center>{$price}</center></td>";
								echo "<td><center>{$status}</center></td>";
                                if($row['status']==0){
								echo '<td><center>	<button name="update" id="update" class="btn btn-primary" type="submit">Update</button> ';
								echo ' <button name="delete" id="delete" class="btn btn-danger"  type="submit">Delete</button></center> </td>';					                    }else{
                                    echo "<td><center><a href=\"placeorder.php?order={$id}\">Review Order</a></center></td>";
                                }
								echo '</form></tr></tr>';
								
								}
							?>
                    
                </tbody>
        	</table>
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