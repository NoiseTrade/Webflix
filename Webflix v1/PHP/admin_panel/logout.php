<?php
#display complete logged out page

#access session

session_start();

#redirect if not logged in
if(!isset($_SESSION['admin_id'])){require('login_tools.php'); load();}

# Set page title and display header section.
$page_title = 'Home' ;
include ( 'includes/admin_header.html' ) ;

# Clear existing variables.
$_SESSION = array() ;

# Destroy the session.
session_destroy() ;

# display message that user is logged out then redirect to login page
echo '<h1>Logged Out</h1>' ;
echo '<p>You are now logged out.</p>' ;
echo '<p>Click <a href="admin_login_register.php">here</a> to log in again.</p>' ;



?>