<?php

$page_title = "Register";

#Login header
include ( 'includes/login.html' ) ;

#check form submitted
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

    #Connect to the database
    require('connect_db.php');

    # Initialize an error array.
    $errors = array();

    # Check for a first name.
    if (empty($_POST['first_name'])) {
        $errors[] = 'Enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
    }

    # Check for a last name.
    if (empty($_POST['last_name'])) {
        $errors[] = 'Enter your last name.';
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
    }


    # Check for a date of birth:
    if (empty($_POST['date_of_birth'])) {
        $errors[] = 'Enter your date of birth';
    } else {
        $dob = mysqli_real_escape_string($link, trim($_POST['date_of_birth']));
    }

    # Check for a country:
    if (empty($_POST['country'])) {
        $errors[] = 'Enter your country';
    } else {
        $co = mysqli_real_escape_string($link, trim($_POST['country']));
    }

    # Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'Enter your email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    # Check for a password and matching input passwords.
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Passwords do not match.';
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'Enter your password.';
    }

    # determine if user is has membership or free trial
    if (empty($_POST['account_type'])) {
        $errors[] = 'No account type selected.';
    } else {
        $at = mysqli_real_escape_string($link, trim($_POST['account_type']));
    }

    # Check if email address already registered.
    if (empty($errors)) {
        $q = "SELECT user_id FROM users WHERE email='$e'";
        $r = @mysqli_query($link, $q);
        if (mysqli_num_rows($r) != 0) $errors[] = '<a data-cy="error-msg">Email address already registered.</a>' . '<a class="alert-link" href="login.php" data-cy="login-alert">Sign In Now</a>';
    }


    # On success register user inserting into 'users' database table.
    if (empty($errors)) {
        $q = "INSERT INTO users (first_name, last_name, date_of_birth, country, email, pass, account_type, reg_date) VALUES ('$fn', '$ln','$dob', '$co', '$e', SHA2('$p',256), '$at', NOW() )";
        $r = @mysqli_query($link, $q);
        if ($r) {

            #send to success.php
            header('location: success.php');
            exit();

    }

        } # report errors.
        else {
            echo '
			<h1>The following error(s) occurred:</h1>';
            foreach ($errors as $msg) {
                echo " <br> $msg </br>";
            }
            echo '<br>or please try again.</br></div>';
            # Close database connection.
            mysqli_close($link);
        }

}
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
</head>
<body>
<div class="register">
    <h1>A World of Viewing Awaits</h1>
                    <form action="register.php" class="was-validated" method="post">

                        <div class="modal-body">
                        <div class="txt_field">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value=""  data-cy="first_name">
                        </div>
                        <div class="txt_field">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value=""  data-cy="last_name">
                        </div>
                        <div class="txt_field">
                            <input type="text" name="date_of_birth" class="form-control" placeholder="dd/mm/yyyy" value=""  data-cy="date_of_birth">
                        </div>
                        <div class="txt_field">
                            <input type="text" name="country" class="form-control" placeholder="Country" value=""  data-cy="country">
                        </div>
                        <div class="txt_field">
                            <input type="email" name="email" class="form-control" placeholder="Email" value=""  data-cy="email">
                        </div>
                        <div class="txt_field">
                            <input type="password" name="pass1" class="form-control" placeholder="Create New Password" value=""  data-cy="pass1">
                        </div>
                        <div class="txt_field">
                            <input type="password" name="pass2" class="form-control" placeholder="Confirm Password" value=""  data-cy="pass2">
                        </div>

                        <!-- form that determines if the account_type is Free or Subscriber-->
                        <div class="form-check">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="account_type" id="freeRadios" value="Free" checked data-cy="freeRadios">
                                <label class="form-check-label" for="freeRadios">
                                    Free
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="account_type" id="subscriberRadios" value="Subscriber" data-cy="subscriberRadios">
                                <label class="form-check-label" for="subscriberRadios">
                                    Subscriber Account - Yearly Payment of £99.99 (continue to paypal)
                                </label>
                            </div>
                        </div>

                            <div class="modal-footer">
                            <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Submit" data-cy="submit"></div>
                </div>

                        <div class="upgrade">
                            <h2>Upgrade to a Subscriber Account</h2>
                            <div id="paypal-payment-button" data-cy="paypal"></div>
                            <script src="https://www.paypal.com/sdk/js?client-id=ATR14ulrf90SrbPhsMt8xix29WBgdZPe4dtLHOarIgO3sMdcL7yPYlxIlcBBtPZgkTKJrAiOWezNTdbn&disable-funding=credit,card"></script>
                            <script src="paypal.js"></script>
                        </div>
        </div>
</body>
</html>
