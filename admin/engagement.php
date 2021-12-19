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
                .col {
                    display: flex;
                    justify-content: start;
                }

                .messages {
                    background-color: lightslategray;
                    width: 300px;
                    border-radius: 25px;
                    color: white;
                    padding: 50px;
                    text-align: center;
                    width: 275px;
                    font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
                    margin-left: 5%;
                    margin-top: 20px;
                }

                .messages:hover {
                    opacity: 0.9;
                    cursor: pointer;

                }
            </style>

            <?php
            $sql = "SELECT message FROM tbl_message";

            $result = $db->query($sql);
            $totalMessages = 0;

            if ($result->num_rows > 0) {
                while ($result->fetch_assoc()) {
                    $totalMessages++;
                }
            }
            ?>
            <div class="col">

                <div class="messages">
                    <p>TOTAL MESSAGES SENT
                    </p>
                    <span><?php echo $totalMessages ?></span>
                </div>

            </div>
            <?php



            ?>



        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>