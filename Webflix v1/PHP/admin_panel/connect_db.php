<?php

#connection to webflix SQL database
$link = mysqli_connect('localhost','root','Marceline','webflix_database');

if(!$link){
    die('Could not conect to database:' .mysqli_error());
}


?>
