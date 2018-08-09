<?php include('form.php') ?>
<?php include('errors.php')?>
<?php  if(!empty($_SESSION['email'])){
    header("location: profile.php");

}?>

<html>
<title> Login Page </title>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<div id="form">
    <form action="login.php" method="POST">
        <p>
            <label>Email</label>
            <input type="text" id="email" name="email">
        </p>
        <p>
            <label>Password</label>
            <input type="password" id="password" name="password">
        </p>
        <p>
            <input type="submit" id="login" name="login" value="Login">
        </p>
        <a>
           Forgot your password? <a href="reset.php"/> Reset it</a>
        </p>
        <p>
            Don't have an account? <a href="signup.php">Sign Up</a>
        </p>

    </form>
</div>
</body>
</html>