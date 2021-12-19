<?php

function isAdmin($db)
{
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM tbl_users WHERE type = 999 AND id = $user_id";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        // Snap out of the program with return 
        return $result;
    }

    return false;
};

function adminCheck($db)
{
    $result =  $db->query("SELECT * FROM tbl_users WHERE id = " . $_SESSION['id'] . " ");
    $user_check = $result->fetch_assoc();
    if ($user_check['type'] != 999) {
        header("location: ../index.php");
        exit;
    }
}
