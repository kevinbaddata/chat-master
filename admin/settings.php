<!DOCTYPE html>
<html lang="en">
<?php require_once '../config/db.php' ?>
<?php require_once '../helper/adminHelper.php' ?>

<?php
adminCheck($db);
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Simple Sidebar - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="admin.css" rel="stylesheet" />
</head>
<style>

</style>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <!-- sidebar -->
            <?php require_once './components/sidebar.php' ?>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php require_once 'components/nav.php' ?>


            <style>

            </style>



            <!-- UPDATE INFO  -->



            <?php
            //updatebtn

            if (isset($_POST['updatebtn'])) {
                $title = $_POST['title'];
                $main_text_color = $_POST['color'];
                $main_background = $_POST['main_background'];

                $sql = "UPDATE tbl_settings SET 
                main_text_color = '$main_text_color', 
                title = '$title', 
                main_background_color = '$main_background' 
                WHERE id=1";

                if ($db->query($sql) === TRUE) {
                    header("location:" . $_SERVER['HTTP_REFERER']);
                }
            }

            ?>










            <div class="card" style="padding:50px">
                <h5 class="card-header">Settings</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" value="<?php echo $s_row['title'] ?>" name="title" id="title" placeholder="Enter title">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="color">Text Color</label>
                            <input type="color" value="<?php echo $s_row['main_text_color'] ?>" class="form-control" name="color" id="color">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="">Main-Background</label>
                            <input type="color" value="<?php echo $s_row['main_background_color'] ?>" name="main_background" class="form-control" id="" placeholder="">
                        </div>
                        <br>


                        <div class="d-flex justify-content-end">
                            <button type="submit" name="updatebtn" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>





        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>