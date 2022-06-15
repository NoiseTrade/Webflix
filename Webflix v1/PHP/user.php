<?php

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'User Profile' ;
include ('includes/main.html');


# Open database connection.
require ('connect_db.php');

//display the users account information
$q = "SELECT * FROM users WHERE user_id = '".$_SESSION['user_id']."'";
$r = mysqli_query ($link, $q);




?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<!--display the user account information-->
<div class="user_info">
    <h2>User Profile</h2>
    <p>
        <?php
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

            echo '<p>First Name: ' . $row['first_name'] . '</p>';
            echo '<p>Last Name: ' . $row['last_name'] . '</p>';
            echo '<p>Email: ' . $row['email'] . '</p>';
            echo '<p>Registration: ' . $row['reg_date'] . '</p>';
            echo '<p>Account Type: ' . $row['account_type'] . '</p>';

        }
        ?>
</div>

</body>
</html>



