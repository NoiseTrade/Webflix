<?php

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# includes the main.html document that displays the navbar and nav links to the user
include ('includes/main.html');

# Open database connection.
require ('connect_db.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>

<div class="about-container">

<!--text for about section-->
<h1>Welcome to Webflix</h1>
<p>Webflix is a web application that allows you to watch movies and TV shows online anywhere you want!</p>
    <p>We are an Edinburgh based company with the goal of bringing the best content to your screens!</p>


</div>

</body>
</html>
