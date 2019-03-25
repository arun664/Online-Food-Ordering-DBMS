<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===0){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_GET)&& !empty($_GET)){
        if(isset($_GET['deactivate'])){
            $sql="Update discount set status=0 where id={$_GET['discountid']}";
            if(mysql_query($sql)){
                header("Location: managediscount.php");
            }else{
                echo mysql_error();
            }
            die();
        }
        if(isset($_GET['activate'])){
            $sql="Update discount set status=1 where id={$_GET['discountid']}";
            if(mysql_query($sql)){
                header("Location: managediscount.php");
            }else{
                echo mysql_error();
            }
            die();
        }
        if(isset($_GET['update'])){
            $sql="SELECT * FROM discount WHERE id ={$_GET['discountid']}";
            $result=mysql_query($sql);
            if($discount=mysql_fetch_assoc($result)){
            
            }else{
                //header("Location: manageitems.php");
                die(mysql_error());
            }
        }
    }
    if(isset($_POST)&& !empty($_POST)){
        $code=stripslashes(mysql_real_escape_string(trim($_POST['discountcode'])));
        $percent=stripslashes(mysql_real_escape_string(trim($_POST['percent'])));
        $minprice=stripslashes(mysql_real_escape_string(trim($_POST['minprice'])));
        $discountid=stripslashes(mysql_real_escape_string(trim($_POST['discountid'])));
        $sql="UPDATE discount set `code`='{$code}',`percent`={$percent},`minprice`={$minprice} WHERE id={$discountid}";
        if(mysql_query($sql)){
            $msg="alert('{$itemname} Updated successfully')";
            header("Location:managediscount.php");
        }else{
            $msg="alert('{$itemname} Update failed')";
        }
    }
    
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
    <title>edit Discount Code</title>
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
			<li class="active"><a href="managediscount.php">Manage Discount Coupons<span class="sr-only">(current)</span></a></li>
          </ul>
          
        </div>
         
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row" style="color:#fff">
                <h4>Add New discount coupon</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input name=discountid style="visibility:hidden" value="<?= $discount['id'] ?>" required readonly >

                    <div class="form-group">
                        <label for="discountcode">Enter Discount Code:</label>
                        <input class="form-control" name="discountcode" placeholder="Eg: MondayFeast200" value="<?= $discount['code'] ?>" required>
                    </div>
					<div class="form-group">
                        <label for="percent">Enter Discount Percentage:</label>
                        <input class="form-control" name="percent" placeholder="Enter Discount Percent" type="number" min=0 max=100 value="<?= $discount['percent'] ?>" required>
                    </div>
					<div class="form-group">
                        <label for="minprice">Enter Discount Min Price:</label>
                        <input class="form-control" name="minprice" placeholder="Enter min price" value="<?= $discount['minprice'] ?>" type="number" required>
                    </div></br>
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

</body></html>3