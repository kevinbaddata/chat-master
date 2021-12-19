<?php
// Include session 
session_start();
ob_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'chat';


// Create an object instance of the name $db
$db = new mysqli($servername, $username, $password, $dbname);


if ($db->connect_error) {
    echo 'Error -> ' . $db->connect_error;
} else {
    // Connection successful
}


$s_sql = "SELECT * FROM tbl_settings WHERE id = 1";
$s_result = $db->query($s_sql);
$s_row =  $s_result->fetch_assoc();
