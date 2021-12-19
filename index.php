<!DOCTYPE html>
<html lang="en">
<?php require_once 'config/db.php'; ?>

<?php

if (!isset($_SESSION['email'])) {
    header('Location: login.php');

    exit;
}

$userID =  $_SESSION['id'];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/chat.css">


    <link rel="stylesheet" href="./assets/css/bootstrap_min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0-1/css/all.min.css" integrity="sha512-xEGx3E22YcUzfX525T3KV7SqNexb09E2CckB6lBB/dT930VlbSX9JnQlLiogtSLAl9yGAJGKDu7O1ZanrqljGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Project | Chat </title>
</head>

<style>
    * {
        padding: 0;
        margin: 0;
    }

    body {
        background: linear-gradient(to bottom right, #f093fb, #F0576C);
    }

    .linear {
        background: linear-gradient(to bottom right, #f093fb, #F0576C);
    }
</style>

<body class="linear">
    <div class="linear">

        <div class="container ">
            <div class="row clearfix ">
                <div class="col-lg-12">
                    <div class="card chat-app">
                        <div id="plist" class="people-list">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <ul class="list-unstyled chat-list mt-2 mb-0">
                                <?php
                                $sql = "SELECT * FROM tbl_users WHERE id != $userID ";
                                $result = $db->query($sql);



                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++;

                                        if ($i === 1) {
                                            // first user
                                ?>
                                            <a href="index.php?click=<?php echo $row['id'] ?>" id="firstuser">
                                                <li class="clearfix">
                                                    <!-- fix -->
                                                    <img src="assets/upload/<?php echo $row['image']; ?>" alt="avatar">
                                                    <div class="about">
                                                        <div class="name"><?php echo $row['username'] ?></div>
                                                        <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                                                    </div>
                                                </li>
                                            </a>
                                        <?php
                                        } else {
                                            // another user
                                        ?>
                                            <a href="index.php?click=<?php echo $row['id'] ?>">
                                                <li class="clearfix">
                                                    <!-- fix -->
                                                    <img src="assets/upload/<?php echo $row['image']; ?>" alt="avatar">
                                                    <div class="about">
                                                        <div class="name"><?php echo $row['username'] ?></div>
                                                        <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                                                    </div>
                                                </li>
                                            </a>
                                        <?php
                                        }
                                        ?>

                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                                <!--Copy-->


                                <!--Copy-->
                            </ul>
                        </div>
                        <div class="chat">
                            <div class="chat-header clearfix">
                                <div class="row">
                                    <?php
                                    // Fixed
                                    if (isset($_GET['click'])) {
                                        $sql = 'SELECT * FROM tbl_users WHERE id = ' . $_GET['click'];
                                        $row =  $db->query($sql);
                                        $result = $row->fetch_assoc();
                                    }

                                    ?>

                                    <div class="col-lg-6">
                                        <!-- fixed -->
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                            <?php
                                            if (isset($_GET['click'])) {
                                            ?>
                                                <img src="assets/upload/<?php echo $result['image']; ?>" alt="">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                            <?php
                                            }
                                            ?>

                                        </a>


                                        <div class="chat-about">

                                            <!-- fixed -->
                                            <h6 class="m-b-0"><?php if (isset($result) && isset($_GET['click'])) {
                                                                    echo $result['username'];
                                                                } else {
                                                                    echo 'This user does not exist';
                                                                }  ?></h6>




                                            <small>Last seen: 2 hours ago</small>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 hidden-sm text-right">
                                        <!-- Send user's ID here -->
                                        <?php
                                        require_once 'helper/adminHelper.php';

                                        if (isAdmin($db)) // Equivalent to isAdmin($db) != null
                                        {
                                        ?>

                                            <a href="admin/admin.php?adminlogin=1" class="btn btn-outline-secondary"><i class="fas fa-user-shield"></i></i></a>
                                        <?php

                                        } ?>
                                        <a href="profile.php?userid=<?php echo $userID ?>" class="btn btn-outline-secondary"><i class="fa fa-users-cog"></i></a>
                                        <a href="login.php?logout=1" class="btn btn-outline-secondary"><i class="fas fa-sign-out-alt"></i></a>

                                    </div>
                                </div>
                            </div>
                            <div class="chat-history">
                                <ul class="m-b-0">
                                    <?php
                                    // fixed

                                    $receiver_id = @$_GET['click'];
                                    $poster_id = $_SESSION['id'];

                                    /**
                                     $sql = "SELECT * FROM tbl_message WHERE 
                                     (receiver_id = ".$receiver_id." AND poster_id = ".$poster_id.")
                                      OR (receiver_id = ".$poster_id." AND poster_id = ".$receiver_id.") ";
                                     */


                                    $sql = "SELECT * FROM tbl_message WHERE 
                                        (receiver_id = '$receiver_id' AND poster_id = '$poster_id' ) 
                                     OR (receiver_id = '$poster_id'   AND poster_id = '$receiver_id' ) ";

                                    $result = $db->query($sql);

                                    while ($row = $result->fetch_assoc()) {

                                        if ($row['poster_id'] === $_SESSION['id']) {
                                            // Right 
                                    ?>
                                            <li class="clearfix">
                                                <div class="message-data text-right">
                                                    <span class="message-data-time"><?php echo $row['tid'] ?></span>
                                                    <img src="" alt="">
                                                </div>
                                                <div class="message other-message float-right"><?php echo $row['message'] ?></div>
                                            </li>
                                        <?php
                                        } else {
                                            // left
                                        ?>

                                            <li class="clearfix">
                                                <div class="message-data">
                                                    <span class="message-data-time"><?php echo $row['tid'] ?></span>
                                                </div>
                                                <div class="message my-message"><?php echo $row['message'] ?></div>
                                            </li>
                                    <?php
                                        }
                                    }







                                    // fixed and
                                    ?>




                                </ul>
                            </div>
                            <div class="chat-message clearfix">
                                <!-- Fix -->

                                <?php

                                if (isset($_POST['textarea'])) {
                                    $receiver_id = $_GET['click'];
                                    $poster_id = $_SESSION['id'];
                                    $message = $_POST['textarea'];


                                    $sql = "INSERT INTO tbl_message (receiver_id,poster_id,message) 
                                        VALUES ($receiver_id, $poster_id, '$message')";

                                    if ($db->query($sql) === true) {
                                        // Refresh the page if message contains content
                                        header("location:" . $_SERVER['HTTP_REFERER']);
                                    }
                                }



                                ?>

                                <form action="" method="POST" id="formChat">
                                    <style>
                                        .emojis {
                                            list-style: none;
                                            display: flex;
                                            display: none;

                                        }

                                        .showemoji {
                                            display: inline-block;
                                            list-style: none;
                                            display: flex;
                                            display: grid;
                                            margin-left: 5px;
                                            grid-template-columns: repeat(4, 1.5em);
                                            background-color: #36393f;
                                            width: 94px;

                                        }

                                        .emojis li {
                                            margin-left: 5px;
                                            cursor: pointer;
                                            transition: all 0.5s;

                                        }

                                        .emojis li:hover {
                                            transition: width 2s;

                                            font-size: 15px;

                                        }
                                    </style>
                                    <div>
                                        <!-- Emoji list -->
                                        <ul class="emojis" id="emoji">
                                            <li>&#128550;</li>
                                            <li>&#128513;</li>
                                            <li>&#128578;</li>
                                            <li>&#128580;</li>
                                            <li>&#128552;</li>
                                            <li>&#128564;</li>
                                            <li>&#128565;</li>
                                            <li>&#128566;</li>
                                        </ul>
                                    </div>
                                    <div class="input-group mb-0">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i style="cursor: pointer;" class="fas fa-file-upload"></i></span>
                                        </div>
                                        <input type="text" name="textarea" id="message_area" class="form-control" placeholder="Enter text here...">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i style="cursor: pointer;" class="far fa-paper-plane" onclick="sendForm('formChat')"></i> &nbsp&nbsp|&nbsp&nbsp <i style="cursor: pointer;" class="far fa-grin" id="emojiBtn"></i></span>
                                        </div>
                                    </div>
                                </form>
                                <!-- Fix end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
if (!isset($_GET['click'])) {
?>
    <script>
        document.getElementById('firstuser').click();
    </script>


<?php
}
?>
<script>
    // Hide - Show 
    document.getElementById('emojiBtn').addEventListener("click", function() {
        document.getElementById('emoji').classList.toggle('showemoji');
    });

    // get current emoji 

    document.getElementById('emoji').addEventListener('click', function(e) {

        if (e.target.tagName === "LI") {
            let clickedItem = e.target.innerHTML.trim();

            let oldText = document.getElementById('message_area').value;
            document.getElementById('message_area').value = oldText + " " + clickedItem;
        }


    })

    //

    function sendForm(formId) {
        document.getElementById(formId).submit();
    }
</script>

</html>