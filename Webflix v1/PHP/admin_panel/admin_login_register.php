<?php #Admin login and register page

# Open database connection.
require ('connect_db.php');

include( 'includes/admin_header.html' );


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

    # Check if email address already registered.
    if (empty($errors)) {
        $q = "SELECT admin_id FROM admin WHERE email='$e'";
        $r = @mysqli_query($link, $q);
        if (mysqli_num_rows($r) != 0) $errors[] = 'Email address already registered.';
    }


    # On success register user inserting into 'admin' database table.
    if (empty($errors)) {
        $q = "INSERT INTO admin (first_name, last_name, email, pass, reg_date) VALUES ('$fn', '$ln', '$e', SHA2('$p',256), NOW() )";
        $r = @mysqli_query($link, $q);
        if ($r) {

            # displays message to show registration successful.
            echo '<div class="alert alert-success" role="alert" data-cy="success">
                    <h4 class="alert-heading">Successfuly registered, please log in!</h4>  
                    </div>';

            exit();

        }

    } # report errors.
    else {
        echo '
			<h1>The following error(s) occurred:</h1>';
        foreach ($errors as $msg) {
            echo " - $msg<br>";
        }
        echo '<p>or please try again.</p></div>';
        # Close database connection.
        mysqli_close($link);
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>

<div class="float-container">
<div class="login">
    <h1>Admin Login</h1>
    <form action="login_action.php" method="post">
        <div class="txt_field">
            <input type="text" name="email" required="" placeholder="Email" data-cy="login_email">

        </div>
        <div class ="txt_field">
            <input type="password" name="pass" required="" placeholder="Password" data-cy="login_password">

        </div>
        <input type="submit" value="Login" data-cy="login_button">
    </form>
</div>

<div class="register">
    <h1>Register</h1>
    <form action="admin_login_register.php" class="was-validated" method="post">

        <div class="modal-body">
            <div class="txt_field">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="" required data-cy="first_name">
            </div>
            <div class="txt_field">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="" required data-cy="last_name">
            </div>
            <div class="txt_field">
                <input type="email" name="email" class="form-control" placeholder="Email" value="" required data-cy="register_email">
            </div>
            <div class="txt_field">
                <input type="password" name="pass1" class="form-control" placeholder="Create New Password" value="" required data-cy="register_pass1">
            </div>
            <div class="txt_field">
                <input type="password" name="pass2" class="form-control" placeholder="Confirm Password" value="" required data-cy="register_pass2">
            </div>

                <!-- Submit button -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary btn-lg btn-block" value="Submit" data-cy="register_button"></div>
            </div>
        </div>
</div>
</div>
</body>
</html>
