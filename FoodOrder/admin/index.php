<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===0){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_POST)&& !empty($_POST)){
        $itemname=stripslashes(mysql_real_escape_string(trim($_POST['itemname'])));
        $category=stripslashes(mysql_real_escape_string(trim($_POST['category'])));
        $price=stripslashes(mysql_real_escape_string(trim($_POST['price'])));
        $sql="INSERT INTO `fooditems`(`itemname`,`category_id`,`price`)VALUES( \"$itemname\", \"$category\", \"$price\")";
        if(mysql_query($sql)){
            $msg="alert('{$itemname} added successfully')";
        }else{
            $msg="alert('{$itemname} FAILED. Please try again')";
        }
        
    }
    $sql="SELECT * FROM `categories` WHERE 1";
    $categories=mysql_query($sql);
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
    <title>New Fooditem</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboardadmin.css" rel="stylesheet">
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
    <script>
        <?= $msg ?>
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

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h3>Select Catagory</h3>
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">New Food Item<span class="sr-only">(current)</span></a></li>
            <li ><a href="discount.php">New Discount Coupon</a></li>
			<li ><a href="manageitems.php">Manage Food Items</a></li>
			<li ><a href="managediscount.php">Manage Discount Coupons</a></li>
          </ul>
          
        </div>
         
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row">
                <h4 style="color:#fff">Add New Food-Item</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group" style="color:#fff">
                        <label for="itemname">Enter Food-Item Name:</label>
                        <input class="form-control" name="itemname" placeholder="Butter Chicken" required>
                    </div>
					<div class="form-group" style="color:#fff">
                        <label for="category">Enter Food-Item Catagory:</label>
                        <select class="form-control" name="category"  required>
							<option value=""> Select </option>
							<?php
                                while($cat=mysql_fetch_assoc($categories)){
                            ?>
                            <option value="<?=$cat['id'] ?>"> <?=$cat['categ'] ?> </option>
                            <?php
                                }
                            ?>
						</select>
                    </div>
					<div class="form-group" style="color:#fff">
                        <label for="price">Enter Food-Item Price:</label>
                        <input class="form-control" name="price" placeholder="Enter price" type="number" required>
                    </div>
					</br>
					<div class="form-submit">
						<button type="submit" class="btn btn-large btn-block btn-success">Submit</button>
					</div>
                </form>
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

</body>
</html>