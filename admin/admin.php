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
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="admin.css" rel="stylesheet" />
</head>
<style>
    .col {
        display: flex;
        justify-content: start;
    }

    .users,
    .admins {
        background-color: lightskyblue;
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

    .users:hover {
        opacity: 0.9;
        cursor: pointer;

    }

    .admins:hover {
        opacity: 0.9;
        cursor: pointer;
    }
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



            <?php

            // Select total users including admins
            $sql = "SELECT * FROM tbl_users";
            $result = $db->query($sql);
            $totalUsers = 0;

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    if ($row['type'] != 999) {
                        $totalUsers++;
                    }
                }
            }

            $sql = "SELECT * FROM tbl_users WHERE type = 999";
            $result = $db->query($sql);
            $totalAdmins = 0;

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $totalAdmins++;
                }
            }

            ?>



            <!-- PHP Content Here -->
            <div class="col">

                <div class="users">
                    <p>TOTAL USERS: <?= $totalUsers ?></p>
                </div>

                <div class="admins" style="background-color: lightpink;">
                    <p>TOTAL ADMIN'S: <?= $totalAdmins ?></p>
                </div>
            </div>

        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>