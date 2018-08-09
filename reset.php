<?php include('form.php') ?>
<html>
<title>Reset Password</title>
<body>
    <form action="reset.php" method="post">
        <p><input type="text" name="email" placeholder="Email"/></p>
        <p><input type="password" name="password" placeholder="New Password"/></p>
        <p><input type="password" name="conpassword" placeholder="Confirm Password"/></p>
        <p><input type="button" name="resetp" value="Reset Password"/></p>
    </form>
</body>
</html>
