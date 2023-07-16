<?php
session_start();
?> 
<!DOCTYPE html>
<head>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Login / Sign Up Form</title>
    
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="main.css">
</head>
<body>

</html>

<?php

include 'dbcon.php';

if(isset($_POST['login'])){
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $email_search = " select * from newuser where email_id='$email_login'";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass= $email_pass['password'];

        $_SESSION['user_name']= $email_pass['user_name'];

        $pass_decode = password_verify($password_login, $db_pass);

        if($pass_decode){
            echo 'login successful';
            ?>
            <script>
                location.replace("home.php");
                </script>
            <?php
        }
        else{
            echo 'password incorrect';
        }
    }
    else {
        echo 'invaild email';
    }
}


?>

<div class="container">
        <form class="form" id="login" method="post"  >
            <h1 class="form__title">Login</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="email" autofocus placeholder="Email" onfocus="this.value=''" autocomplete="off">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="password" autofocus placeholder="Password" onfocus="this.value=''" autocomplete="off">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit" name="login">Login</button>
            <!-- <p class="form__text">
                <a href="forgot_password.php" class="form__link">Forgot your password?</a>
            </p> -->
            <p class="form__text">
                <a class="form__link" href="signup1.php" name="linkCreateAccount">Don't have an account? Create account</a>
            </p>
        </form>
</div>
    <script src="main.js"></script>
</body>