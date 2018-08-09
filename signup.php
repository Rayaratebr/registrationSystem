<?php include('form.php') ?>
<?php include('errors.php')?>
<?php

/*Check this oneee*/

    if(isset($_SESSION['email'])){
    header("location: profile.php");

}?>
<div class="body-content">
    <div class="module">
        <h1>Create a new account</h1>
        <form class="form" action="signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?=$_SESSION['message']?></div>
            <p>
                <input type="text" name="username" placeholder="User name"/>
            </p>
            <p>
                <input type="text" name="email" placeholder="email"/>
            </p>
            <p>
                <input type="password" name="password" placeholder="Password"/>
            </p>
            <p>
                <input type="password" name="confirmPassword" placeholder="Confirm Password"/>
            </p>
            <div class="image">
                <label>Upload a profile picture</label>
                <input type="file" name="image" accept="image/">
                <input type="submit" value="Upload" name="upload"/>
            </div>
            <div>
                <input type="submit" value="Register" name="register"/>
            </div>
            <div>
                <label>Already a member?</label>
                <a href="login.php">Login</a>
            </div>




        </form>
    </div>
</div>