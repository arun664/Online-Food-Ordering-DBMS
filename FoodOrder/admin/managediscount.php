<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===0){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    $query="SELECT * from discount order by status DESC";
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
    <title>Manage Discount</title>
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
			<li ><a href="manageitems.php">Manage Food Items</a></li>
			<li class="active"><a href="#">Manage Discount Coupons<span class="sr-only">(current)</span></a></li>
          </ul>
          
        </div>
         
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row" >
                <table class="table table-striped table-hover">
        		<tbody>
                	<tr>
						<th><center>Discount Code</center></th>
                        <th><center>Percent</center></th>
                        <th><center>Minimum Price</center></th>
                        <th><center>Status</center></th>
                        <th><center>#</center></th>
                    </tr>
                    
                    
                        
                        	<?php
							while($row=mysql_fetch_assoc($result)){
								$id=$row['id'];
								$code=$row['code'];
								$percent=$row['percent'];
								$minprice=$row['minprice'];
								$status=($row['status']==1 ? "Active" : "Inactive");
								echo '<tr><tr>';
                    			echo '<form action="editdiscount.php" method="get">	';
								echo "<input name=\"discountid\" value=\"{$id}\" style=\"visibility:hidden;\">";
								echo "<td><center>{$code}</center></td>";
								echo "<td><center>{$percent}</center></td>";
								echo "<td><center>{$minprice}</center></td>";
								echo "<td><center>{$status}</center></td>";
								if($row['status']==0) echo '<td><center><button name="activate" class="btn btn-success" type="submit">Activate</button> ';
                                else echo '<td><center><button name="deactivate" class="btn btn-danger" type="submit">Deactivate</button> ';
								echo ' <button name="update" class="btn btn-primary"  type="submit">Update</button></center> </td>';					
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