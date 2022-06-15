<?php

#connection to webflix SQL database
$link = mysqli_connect('localhost','root','Marceline','webflix_database');

#if no connection, then error message is displayed
if(!$link){
    die('Could not connect to database:' .mysqli_error());
}

?>
