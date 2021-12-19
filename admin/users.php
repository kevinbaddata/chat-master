<!DOCTYPE html>
<html lang="en">
<?php require_once '../config/db.php' ?>
<?php require_once '../helper/adminHelper.php' ?>

<?php
adminCheck($db);
?>
<?php


if (isset($_GET['delete'])) {

    $id = $_GET['delete'];
    // sql to delete a record
    $sql = "DELETE FROM tbl_users WHERE id= $id";

    if ($db->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }
}

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


            <?php

            $sql = "SELECT * FROM tbl_users";
            $result = $db->query($sql);


            ?>


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['type'] == 999) {
                    ?>
                                <a href="">
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['password'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php //echo $row['type'] 
                                            ?>Admin</td>

                                        <td>

                                    </tr>
                                <?php

                            } else {
                                ?>
                                    <tr>


                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['password'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php echo $row['type'] ?></td>
                                        <td>
                                            <a onclick="userDelete('users.php?delete=<?php echo $row['id'] ?>')" href="#"><button type="button" style="border-radius: 10px;" class="btn btn-danger">DELETE</button></a>

                                    </tr>
                                <?php
                            }

                                ?>


                        <?php
                        }
                    }

                        ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>

<script>
    function userDelete(url_) {
        let confrim_ = confirm('Are you sure you would like to delete this user(?)')
        if (confrim_) {
            location.href = url_
        }
    }
</script>