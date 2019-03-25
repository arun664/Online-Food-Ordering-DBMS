<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===1){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_POST)&& !empty($_POST)){
        if(isset($_POST['update'])){
            $orderid=$_POST['orderid'];
            $sql="Update orders set status= status + 1 where id = {$orderid}";
            mysql_query($sql);
        }
    }
    $query="SELECT * from orders where status=4 order by id DESC";
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
    <title>Manager Past Orders</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboardmanager.css" rel="stylesheet">
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
            <li ><a href="index.php">Active Orders<span class="sr-only">(current)</span></a></li>
              <li class="active"><a href="#">Other Orders</a></li>
          </ul>
          
        </div>
         
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row" >
                <table class="table table-striped table-hover">
        		<tbody>
                	<tr>
						<th><center>Order Number</center></th>
                        <th><center>Price</center></th>
						<th><center>Status</center></th>
                        <th>Order</th>
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
								echo '<tr>';
                    			echo '<tr><form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
                                echo "<input name=\"orderid\" value=\"{$id}\" style=\"visibility:hidden;\">";
								echo "<td><center>{$id}</center></td>";
								echo "<td><center>{$price}</center></td>";
								echo "<td><center>{$status}</center></td>";
                                echo "<td><a href=\"checkorder.php?order={$id}\">View Order</td>";
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

</body></html>