<?php 
    session_start();
    require_once('./includes/DbConnection.php');
    $message1="";
    $message2="";
    if(isset($_POST)&& !empty($_POST)){
        $name=stripslashes(mysql_real_escape_string(trim($_POST['name'])));
        $email=stripslashes(mysql_real_escape_string(trim($_POST['email'])));
        $pass=stripslashes(mysql_real_escape_string(trim($_POST['pass'])));
        $conpass=stripslashes(mysql_real_escape_string(trim($_POST['conpass'])));
        if($pass==$conpass){
            $sql="INSERT INTO `user`(`name`,`email`,`password`, `type`)VALUES( \"$name\", \"$email\", \"$pass\", 2)";
            if(mysql_query($sql)){
                $message2="Account created successfully. Click login to login";    
            }
        }else{
            $message1="Passwords did not match. Please try again";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Welcome to foodorder</title>
	    <body background="includes/food1.jpg">
        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/signup.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
          <form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1 class="form-signin-heading" style="color:#212121">Welcome To FoodOrder</h1>
            <h4 class="form-signin-heading" style="color:#212121">Signup for the best food in town at your doorstep </h4>
            <input type="text" class="form-control" name="name" placeholder="Full Name" required autofocus><br/>
            <input type="email" class="form-control" name="email" placeholder="Email address" required ><br/>
            <input type="password" class="form-control" name="pass" placeholder="Password" required><br/>
            <input type="password" class="form-control" name="conpass" placeholder="Confirm Password" required>
            <span style="color:red"><?= $message1 ?></span>
            <span style="color:green"><?= $message2 ?></span>
            <div class="row">
                <div class="col-md-6"><button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:20px;">Sign UP</button></div>  
                <div class="col-md-6"><a class="btn btn-lg btn-info btn-block" href="index.php" style="margin-top:20px;">Log in</a></div>  
            </div>  
          </form>
        </div> <!-- /container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery-1.9.0.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>