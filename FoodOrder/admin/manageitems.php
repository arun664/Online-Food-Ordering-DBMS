<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===0){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    $query="SELECT fooditems.id as id, itemname, price, categ FROM `fooditems` join categories on `category_id`=categories.id order by category_id";
    $result=mysql_query($query);
							
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
    <title>Manage Food Items</title>
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

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h3>Select Catagory</h3>
          <ul class="nav nav-sidebar">
            <li ><a href="index.php">New Food Item</a></li>
            <li ><a href="discount.php">New Discount Coupon</a></li>
			<li class="active"><a href="#">Manage Food Items<span class="sr-only">(current)</span></a></li>
			<li ><a href="managediscount.php">Manage Discount Coupons</a></li>
          </ul>
          
        </div>
         
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row" >
        	<table class="table table-striped table-hover">
        		<tbody>
                	<tr>
						<th><center>Food Item</center></th>
                        <th><center>Category</center></th>
                        <th><center>Price</center></th>
                        <th><center>#</center></th>
                    </tr>
                    
                    
                        
                        	<?php
							while($row=mysql_fetch_assoc($result)){
								$itemid=$row['id'];
								$fooditem=$row['itemname'];
								$categ=$row['categ'];
								$price=$row['price'];
								echo '<tr><tr>';
                    			echo '<form action="edititems.php" method="get">	';
								echo "<input name=\"itemid\" value=\"{$itemid}\" style=\"visibility:hidden;\">";
								echo "<td><center>{$fooditem}</center></td>";
								echo "<td><center>{$categ}</center></td>";
								echo "<td><center>{$price}</center></td>";
								echo '<td><center>	<button name="update" id="update" class="btn btn-primary" type="submit">Update</button> ';
								echo ' <button name="delete" id="delete" class="btn btn-danger"  type="submit">Delete</button></center> </td>';					
								echo '</form></tr></tr>';
								
								}
							?>
                    
                </tbody>
        	</table>
            </div>
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

</body></html>3