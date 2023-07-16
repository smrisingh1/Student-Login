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

<?php 

include 'dbcon.php';

if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($con, $_POST['name']);
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

    $pass= password_hash($password, PASSWORD_BCRYPT);
    $cpass= password_hash($cpassword, PASSWORD_BCRYPT);

    // $_SESSION['username']= $email_pass['username'];

    $usernamequrey = "select * from newuser where user_name='$username'";
    $queryuser = mysqli_query($con,$usernamequrey);
    $usernamecount = mysqli_num_rows($queryuser);

    if($usernamecount>0){
        ?>
                    <script>
                        alert("username already exists");
                    </script>    

                <?php
    }


    $emailquery= "select * from newuser where email_id='$email' ";
    $query = mysqli_query($con , $emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount>0){
        ?>
                    <script>
                        alert("email already exists");
                        location.replace("login1.php");
                    </script>    

                <?php
       

    }
    else{
        if($password === $cpassword){
            $insertquery = "insert into newuser (name, user_name, email_id, password, confirm_password) 
            values('$name','$username','$email','$pass','$cpass')";

            $iquery = mysqli_query($con, $insertquery);

            if($iquery){
                ?>
                    <script>
                        alert("Account created successfully");
                        location.replace("login1.php");
                    </script>    

                <?php
             }
                
            else{
                    
                    ?>
                    <script>
                        alert("Error while creating account");
                    </script>    

                    <?php   
            }
        }
        else{
            ?>
                    <script>
                        alert("Password not matching");
                    </script>    

                    <?php   
            
        }


    }
}


?>


<div class="container">
<form class="form form" id="createAccount"  method="post">
            <h1 class="form__title">Create Account</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" id="signupname" name="name" required class="form__input" autofocus placeholder="Full Name" autocomplete="off"  onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" id="signupUsername" name="username" required class="form__input" autofocus placeholder="Username" autocomplete="off" onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="email" required autofocus placeholder="Email Address" autocomplete="off" onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="password" required autofocus placeholder="Password" autocomplete="off" onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="password" class="form__input" name="cpassword" required autofocus placeholder="Confirm password" autocomplete="off" onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit" name="submit">Create Account</button>
            <p class="form__text">
                <a class="form__link" href="login1.php" name="linkLogin">Already have an account? Sign in</a>
            </p>
        </form>
    </div>
    <script src="main.js"></script>
</body>