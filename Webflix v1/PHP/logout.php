<?php
#display complete logged out page

#access session

session_start();

#redirect if not logged in
if(!isset($_SESSION['user_id'])){require('login_tools.php'); load();}

# Set page title and display header section.
$page_title = 'Home' ;
include ( 'includes/login.html' ) ;

# Clear existing variables.
$_SESSION = array() ;

# Destroy the session.
session_destroy() ;

# Display body section.
echo '<h1>Goodbye!</h1>
<h2>You are now logged out.</h2>' ;


?>