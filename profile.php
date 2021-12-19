<?php
require_once 'config/db.php';
?>


<?php
if (!isset($_SESSION['email'])) {
    header('Location: login.php');

    exit;
}


$UserID = $_GET['userid'];
if ($_SESSION['id'] !== $UserID) {
    die("Error");
}

$sql = "SELECT * FROM tbl_users where id = '$UserID'";
$result = $db->query($sql);
$row = $result->fetch_assoc();



// echo $row['email'] . '<br>';
// echo $row['username'] . '<br>';
// echo $row['password'] . '<br>';
// echo $row['date'] . '<br>';
// echo $row['image'] . '<br>';


?>


<?php

if (isset($_POST['deletebtn'])) {

?>

<?php
    $sql = "DELETE FROM tbl_users WHERE id = '$UserID'";


    if ($db->query($sql) === TRUE) {
        echo 'Successfully deleted';
        header("Refresh:3; url=login.php");
    } else {
        echo "Error deleting record: " . $db->error;
    }
}




if (isset($_POST['updatebtn'])) {

    if ($_FILES['file']['size'] > 0) {

        $target_dir = 'assets/upload/';
        $image = $_FILES['file'];

        $extension = explode('.', $image['name'])[1];

        if ($extension !== 'jpeg' && $extension !== 'png' && $extension !== 'jpg' && $extension !== 'gif') {
            $fileError = 'Please enter a valid file extension';
        }

        if ($image['size'] > 5000000) {
            $fileError = 'File must at least be 5mb';
        }

        //delete old image
        if (file_exists('assets/upload/' . $row['image'])) {
            unlink('assets/upload/' . $row['image']);
        }

        // add new file
        $imageName = time() . rand(1, 66000) . '.' . $extension;
        $fileUpload = move_uploaded_file($image['tmp_name'], $target_dir . $imageName);
        if (!$fileUpload) {
            $fileError = 'Unable to upload file, please try again';
        }
    } else {
        // Upload old avatar
        $imageName = $row['image'];
    }


    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = $_POST['date'];

    $sql = "UPDATE tbl_users SET
    username='$username',
    image = '$imageName',
    email = '$email',
    password = '$password',
    date = '$date'
    WHERE id= $UserID";


    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('location:' . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Error updating record: " . $db->error;
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css" />

</head>

<style>
    body {
        background-color: #f9f9fa
    }

    .padding {
        padding: 3rem !important
    }

    .user-card-full {
        overflow: hidden
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px
    }

    .m-r-0 {
        margin-right: 0px
    }

    .m-l-0 {
        margin-left: 0px
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px
    }

    .bg-c-lite-green {
        background: linear-gradient(to bottom right,
                rgba(240, 147, 251, 1),
                rgba(245, 87, 108, 1));
    }

    .user-profile {
        padding: 20px 0
    }

    .card-block {
        padding: 1.25rem
    }

    .m-b-25 {
        margin-bottom: 25px
    }

    .img-radius {
        border-radius: 5px
    }

    h6 {
        font-size: 14px
    }

    .card .card-block p {
        line-height: 25px
    }

    @media only screen and (min-width: 1400px) {
        p {
            font-size: 14px
        }
    }

    .card-block {
        padding: 1.25rem
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .card .card-block p {
        line-height: 25px
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .text-muted {
        color: #919aa3 !important
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .f-w-600 {
        font-weight: 600
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .user-card-full .social-link li {
        display: inline-block
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out
    }

    .cardHeight {
        height: 363px;
    }

    @media only screen and (max-width: 600px) {
        .cardHeight {
            height: auto;
        }
    }
</style>

<body>
    <div class="page-content page-container" id="page-content">

        <div class="padding">
            <div class="row container d-flex justify-content-center align-items-center " style="margin: 0 auto;height: 100vh !important;">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0 cardHeight">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white d-flex align-items-center justify-content-center" style="height:100%">
                                    <div>
                                        <!-- fixed --->
                                        <div class="m-b-25"> <img id="image-logo" width="100" height="100" src="assets/upload/<?php echo $row['image'] ?>" style="border-radius: 50%!important;cursor:pointer; object-fit:cover" class="img-radius" alt="User-Profile-Image"> </div>
                                        <h6 class="f-w-600"><?= $row['username'] ?></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8  d-flex align-items-center justify-content-center">
                                <div class="card-block " style="width:100%">

                                    <p class="m-b-20 p-b-5 b-b-default f-w-600">Information</p>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="file" id="image" style="display:none" name="file" class="form-control form-control-lg" />
                                                <p class="m-b-10 f-w-600">Username</p>
                                                <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>
">
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Password</p>
                                                <input type="password" class="form-control" name="password" value="<?php echo $row['password'] ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Date</p>
                                                <input type="date" class="form-control" name="date" value="<?php echo $row['date'] ?>">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-5">

                                            <button class="btn btn-success btn-sm" name="updatebtn">Update</button>
                                            <button class="btn btn-danger btn-sm ml-1" name="deletebtn" onclick="" type="submit">Delete</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.getElementById('image-logo').addEventListener('click', function() {
        document.getElementById('image').click();
    });

    // Pop the image 
    document.getElementById('image').addEventListener('change', function(e) {
        document.getElementById('image-logo').setAttribute('src', URL.createObjectURL(e.target.files[0]))

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>