<?php
require_once 'config/db.php';

?>

<style>
    form {
        margin-left: 27px;
    }

    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    body {
        font-family: 'Montserrat', sans-serif !important;

    }

    .password_hint_show {
        display: block !important;
    }

    .password_hint_hide {
        display: none !important;
    }
</style>

<?php

$passwordMessage_ = '';
$imageErrorMessage = '';
$passwordPoint = 0;

if (isset($_POST['submitbtn'])) {

    // <--------------- Cast POST values to variables --------------->

    $email =  strip_tags($_POST['email']);

    $username = strip_tags($_POST['username']);
    $username = ucwords(strtolower($username));
    $date = strip_tags($_POST['date']);
    if (empty($_POST['password'])) {
        $password = '';
    } else {
        $password = strip_tags($_POST['password']);
    }

    // <--------------- Success messages --------------->

    $successMessage = '';

    // <--------------- Error messages --------------->

    $errorArray = [];
    $emailError = '';
    $usernameError = '';
    $dateError = '';
    $passwordError = '';
    $emailExists = '';



    // <--------------- Empty() validation --------------->


    // 24529Array ( [file] => Array ( 
    //[name] => 77e9e77ae210c466e2c9d05604d8eb11.png 
    //[type] => image/png 
    //[tmp_name] => C:\PHP\tmp\php3DEA.tmp 
    //[error] => 0 
    //[size] => 24529 ) )



    if (!file_exists('assets/upload')) {
        mkdir('assets/upload');
    }

    $image = $_FILES['file'];
    $size = $_FILES['file']['size'];
    $tmp_name = $_FILES['file']['tmp_name'];


    if ($size === 0) {

        $fileError = 'Please choose a file';
        array_push($errorArray, 'Please choose a file');
        $imageErrorMessage = 'Please upload a file';
    } else {
        $target_dir = 'assets/upload/';

        $extension = explode('.', $image['name'])[1];
        if (
            $extension !== 'jpeg' &&
            $extension !== 'png' &&
            $extension !== 'jpg' &&
            $extension !== 'gif'
        ) {
            $fileError = 'Please enter a valid file extension';
            array_push($errorArray, 'Please enter a valid file extension');
        }


        if ($size > 5000000) {
            $fileError = 'File must at least be 5mb';
            array_push($errorArray, 'File must at least be 5mb');
        }

        $imageName = time() . rand(1, 66000) . '.' . $extension;
        $fileUpload = move_uploaded_file($tmp_name, $target_dir . $imageName);
        if (!$fileUpload) {
            $fileError = 'Unable to upload file, please try again';
            array_push($errorArray, 'Unable to upload file, please try agai');
        }
    }






    if (empty($username)) {
        array_push($errorArray, "Please fill this input ");
        $usernameError = 'Please fill this field';
    }

    if (empty($date)) {

        array_push($errorArray, 'Please fill this input');
        $dateError = 'Please fill this field';
    }

    if (empty($password)) {
        array_push($errorArray, 'Please fill this input');
    }



    // <--------------- Password points --------------->

    // Import the password meter file
    require_once 'helper/PasswordPoints.php';


    RegEx("/[A-Z]/", $password);
    RegEx("/[a-z]/", $password);
    RegEx("/[0-9]/", $password);
    RegEx("/(\!|\#|\%|\¤|\&|\\|\/|\(|\)|\=|\?)/", $password);
    RegEx("/\[|\@|\£|\$|\]|\}|\{/", $password);
    PasswordLength($password);

    if ($passwordPoint > 3) {
        // Select Email from database
        $emailCheckSql = "SELECT * FROM tbl_users WHERE email = '$email'";
        $emailCheck = $db->query($emailCheckSql);
        // Check if any errors exists
        if (count($errorArray) === 0) {

            if ($emailCheck->num_rows == 0) {

                $password = md5($password);

                // No error? INSERT INTO database
                $sql = "INSERT INTO tbl_users 
        (email, username, password, date, image) 
        VALUES ('$email', '$username', '$password', '$date', '$imageName')";

                if ($db->query($sql) === TRUE) {

                    $successMessage = 'Successfully registered!';
                    header("Refresh:3; url=login.php");
                    //  printf("Your password point is ->  %u", $passwordPoint);
                } else {
                    echo 'Failed to register';
                }
            } else {
                print("Email exists");
                // $emailExists = $email . ' exists by a different user!';      
            }
        }
    } else {
        $passwordMessage_ = 'Your password must contain at least 4 points: Press (?) for more info';
    }
}
// Test

?>







<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>Register</title>
</head>

<body>

    <!-- <form action="" method="POST">
        Email <br>
        <input type="email" name="email" class=""> <br>
        Username <br>
        <input type="text" name="username"> <br>
        Password <br>
        <input type="text" name="password"> <br>
        Date <br>
        <input type="date" name="date"> <br>
        <input type="submit" name="registerbtn" style="margin-top: 15px;">
    </form> -->


    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">




                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 " style="margin-left: 28px; position:relative">Registration Form </h3>
                                    <!-- <span class="alert alert-success">Lorem ipsum dolor sit</span> -->

                                    <div style=" position: absolute;
                                                    right: 66px;
                                                    top: 31px;
                                                    cursor:pointer;
                                                    ">
                                        <input type="file" id="image" style="display:none" name="file" class="form-control form-control-lg" />
                                        <img style="object-fit:contain" id="image-logo" src="https://www.pngall.com/wp-content/uploads/5/Profile-PNG-Images.png" alt="Avatar" class="md-avatar rounded-circle" height="70" width="70">
                                    </div>
                                </div>

                                <script>
                                    document.getElementById('image-logo').addEventListener('click', function() {
                                        document.getElementById('image').click();
                                    })

                                    // Pop the image 
                                    document.getElementById('image').addEventListener('change', function(e) {
                                        document.getElementById('image-logo').setAttribute('src', URL.createObjectURL(e.target.files[0]))

                                    });
                                </script>


                                <!-- Here -->
                                <!-- Here -->
                                <!-- Here -->

                                <div class="row">

                                    <div style="display:none" class="alert alert-primary" id="password_hint">
                                        Your password must contain 4 of the following <br>

                                        • 1 Uppercase letter <br>
                                        • 1 Lowercase letter <br>
                                        • 1 Number <br>
                                        • 1 Operator <br>
                                        • 1 Special character <br>
                                        • 8 letters


                                    </div>

                                    <?php
                                    if (!empty($passwordMessage_)) {
                                    ?>
                                        <div class="alert alert-danger"><?= $passwordMessage_ ?></div>

                                    <?php
                                    }

                                    ?>

                                    <?php
                                    if (!empty($imageErrorMessage)) {
                                    ?>
                                        <div class="alert alert-danger"><?= $imageErrorMessage ?></div>

                                    <?php
                                    }

                                    ?>



                                    <?php
                                    if (!empty($successMessage)) {
                                    ?>
                                        <div class="alert alert-success"><?= $successMessage ?></div>

                                    <?php
                                    }

                                    ?>

                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" name="username" class="form-control form-control-lg" />
                                            <label class="form-label" for="">Username</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="email" name="email" id="" class="form-control form-control-lg" />
                                            <label class="form-label" for="">Email</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="password" name="password" style="position:relative" class="form-control form-control-lg" />
                                            <label class="form-label">Password</label>
                                            <label for="" style="position:absolute;right:10px;top:10px" id="password_question_mark">?</label>

                                        </div>


                                    </div>

                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="date" name="date" class="form-control form-control-lg" id="" />

                                        </div>

                                    </div>

                                </div>





                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary btn-lg" type="submit" name="submitbtn" value="Submit" />
                                    <a href="login.php"> <input class="btn btn-primary btn-lg" type="" name="submitbtn" style="margin-left: 100px;" value="Login" /></a>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.js"></script>
    <script src="assets/js/main.js">

    </script>

    <script>
        document.getElementById('password_question_mark').addEventListener('click', function() {
            document.getElementById('password_hint').classList.toggle('password_hint_show');


        })
    </script>
</body>

</html>