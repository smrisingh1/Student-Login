<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    echo "you are logout";
    header('location:login1.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="main.css">
</head>

<body>


    <?php

    include 'dbcon.php';


    if (isset($_POST['add'])) {
        $sub1 = mysqli_real_escape_string($con, $_POST['subj1']);
        $sub2 = mysqli_real_escape_string($con, $_POST['subj2']);
        $sub3 = mysqli_real_escape_string($con, $_POST['subj3']);
        $sub4 = mysqli_real_escape_string($con, $_POST['subj4']);
        $email_where = $_SESSION['user_name'];

        $add_update = "UPDATE `newuser` SET `subject1`='$sub1', `subject2`='$sub2', `subject3`='$sub3', `subject4`='$sub4'  WHERE `user_name` = '$email_where'";


        $uquery = mysqli_query($con, $add_update);

        if ($uquery) {
            ?>
            <script>
                alert("Inserted successfully");
            </script>

            <?php
        } else {

            ?>
            <script>
                alert("Error while inserting");
            </script>

            <?php
        }


    }



    ?>






    <div class="container">


        <br>


        <form class="form form" id="createAccount" method="post">
            <h1 class="form__title">Welcome
                <?php echo $_SESSION['user_name']; ?>
            </h1>

            <h1 class="form__title">Enter your Subjects</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" name="subj1" class="form__input" autofocus placeholder="Subject1" autocomplete="off"
                    onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" name="subj2" class="form__input" autofocus placeholder="Subject2" autocomplete="off"
                    onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="subj3" autofocus placeholder="Subject3" autocomplete="off"
                    onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <div class="form__input-group">
                <input type="text" class="form__input" name="subj4" autofocus placeholder="Subject4" autocomplete="off"
                    onfocus="this.value=''">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button1" type="submit" name="add">ADD / UPDATE</button>
            <!-- <button class="form__button1" type="submit" name="add">UPDATE</button> -->
            <button class="form__button1">
                <a href="logout.php" class="form__logout">LOGOUT</a></button>

        </form>
    </div>



    <script src="./src/main.js"></script>

</body>

</html>