<?php

$page_title = "Success!";

#add this in later for header etc
include ( 'includes/login.html' ) ;

#database connection
require('connect_db.php');
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Success!</title>

    <!--    style directly as this is the only webpage to use it-->

    <style>
        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
<h1>Successfully Registered!</h1>
<h2>You can now Log in</h2>
</body>
</html>
