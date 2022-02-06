# Chat-Master

**Chat-Master** is a web application that lets users connect with eachother in day to day life

```php
<?php
// Include session 
session_start();
ob_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'chat'; // Insert your DB here


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
```

The application lets users register their own unique account that can be modified at users discretion. 

Users have access to unique features like 


- **Account registration**
- **Profile pictures**
- **Ability to talk with other users in the database**
- **Use unique emojis** 

