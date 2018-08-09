
<?php

    session_start();
    $_SESSION['message']='';
    $_SESSION['errors']='';
    $flag = true;
    $errors = array();
    $mysqli = new mysqli('localhost','root','','loc_reg');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $email = $_POST['email'];

        if (empty($_POST['username'])){
            array_push($errors,"Username is required!!");
        }
        if (empty($_POST['email'])){
            array_push($errors,"Email is required!!");
            //$_SESSION['message']="Email is required!";
        }
        //Validate email format
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors,"invalid email format!!");
            //$_SESSION['message'] = "Invalid email format";
            $flag = false;
        }
        else{
            $result = mysqli_query($mysqli,"SELECT * FROM users where email='".$email."'");
            $num_rows = mysqli_num_rows($result);
            if($num_rows >= 1){
                array_push($errors,"Email is already in use!!");
                //$_SESSION['message'] = "Email is already in use!";
                $flag = false;
            }
        }
        if (empty($_POST['password'])){
            array_push($errors,"Password is required!");
            //$_SESSION['message']= "Password is required!";
            $flag = false;
        }else
        if (empty($_POST['confirmPassword'])){
            array_push($errors,"Please confirm your password!");
            //$_SESSION['message'] = "Please confirm your password!";
            $flag = false;
        }

        //Two Passwords are matching
        if ($flag)
        {
            if ($_POST['password'] == $_POST['confirmPassword']){
                $username = mysqli_real_escape_string($mysqli,$_POST['username']);
                $email = mysqli_real_escape_string($mysqli,$_POST['email']);
                $password = md5($_POST['password']);
                $image_path = mysqli_real_escape_string($mysqli,'image/'.$_FILES['image']['name']);

                //copy the image to images folder
                if (preg_match("!image!", $_FILES['image']['type'])){
                    copy($_FILES['image']['tmp_name'],$image_path);
                }
                else{
                    array_push($errors,"File Upload Failed");
                    //$_SESSION['message']="File Upload Failed!";
                }


                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['image'] = $image_path;

                $sql = "INSERT INTO users (username, email, password, image)"
                    ."VALUES ('$username','$email','$password','$image_path')";

                //if query is successful, user will be redirected to profile page

                /* if (mysqli_query($mysqli,$sql)== true){
                     $_SESSION['message'] = "Registration successful!!";
                     header("location: profile.php");
                 }*/
                if (count($errors) ==0){
                    mysqli_query($mysqli,$sql) or die ("Failed" . mysqli_error($mysqli));
                    $_SESSION['message'] = "Registration Successful!!";
                }


                else{
                $_SESSION['message'] = "Registration failed!";
                }
            }
            else{
                array_push($errors,"Two passwords don't match!");
              /*  foreach ($error as $errors){
                    echo $error."<br>";
                }*/
                $_SESSION['message']="Two passwords don't match!";
            }
        }

        $_SESSION['errors'] = $errors;


    }






// LOGIN USER
    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);



            $password = md5($password);
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $results = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['image'] = $image_path;
                $_SESSION['success'] = "You are now logged in";
                header('location:  profile.php');
            }else {
                array_push($errors,"Wrong username/password combination");
            }

    }

    //Reset Password
    if (isset($_POST['resetp'])){
        $_SESSION['email'] = $_POST['email'];
        if ($_POST['password'] == $_POST['confirmPassword']){
            $password = md5($_POST['password']);
            $myquery = "UPDATE users
                      SET password = '$password'
                      WHERE email = '$email'";
            mysqli_query($mysqli,$myquery) or die ("Failed" . mysqli_error($mysqli));
            header('location: login.php');
        }
        // $_SESSION['login']=false;
       // header('location: login.php');
    }



    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['email']);
        // $_SESSION['login']=false;
        header('location: login.php');
    }


    ?>




