<?php include('form.php');
if(!isset($_SESSION['email'])){
    header("location: login.php");
    die;
}
?>
<div class="body content">
    <div class="welcome">
        <div class="alert alert-success"><?= $_SESSION['message']?></div>
        Welcome <span class="user"> <?php echo $_SESSION['username'] . "<br> Email: " . $_SESSION['email'] ."<br>";?>
        <img src="<?= $_SESSION['image']?>" </span>
    </div>
    <p><a href = "profile.php?logout='1'"> Logout</a></p>
</div>
