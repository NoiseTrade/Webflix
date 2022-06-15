<?php

# Open database connection.
require ('connect_db.php');

include( 'includes/admin_header2.html' );

#if user_id is not set, will redirect to the main page
if ( !isset( $_GET['user_id'] ) ) {
    header( 'Location: admin_index.php' );
}

# query database depending on user_id
$query = "SELECT * FROM users WHERE user_id = " . $_GET['user_id'];
$result = mysqli_query( $link, $query );


# retrieve the user information from database based on user_id
$row = mysqli_fetch_array($result);


# SQL query to update the user information after submitting form
if ( isset( $_POST['submit'] ) ) {
    $query = "UPDATE users SET first_name = '" . $_POST['first_name'] . "', last_name = '" . $_POST['last_name'] . "', date_of_birth = '" . $_POST['date_of_birth'] . "', country = '" . $_POST['country'] . "', email = '" . $_POST['email'] . "', account_type = '" . $_POST['account_type'] . "' WHERE user_id = " . $_GET['user_id'];

    #if query is successful, will redirect to the main page
    if ( mysqli_query( $link, $query ) ) {
        header( 'Location: admin_index.php' );

    }

    #if query is not successful, will display error message
    else {
        echo '<p>Error updating user</p>';
    }
}


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

<!--display editable table with user information and submit button to update-->
    <div class="edit_user">

<form action="edit_user.php?user_id=<?php echo $_GET['user_id']; ?>" method="post">
    <table>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" data-cy="first_name"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" data-cy="last_name"></td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td><input type="text" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>" data-cy="dob"></td>
        </tr>
        <tr>
            <td>Country</td>
            <td><input type="text" name="country" value="<?php echo $row['country']; ?>" data-cy="country"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $row['email']; ?>" data-cy="email"></td>
        </tr>
        <tr>
            <td>Account Type</td>
            <td><input type="text" name="account_type" value="<?php echo $row['account_type']; ?>" data-cy="account_type"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Update" data-cy="update"></td>
        </tr>
    </table>
</form>
    </div>
</body>
</html>
