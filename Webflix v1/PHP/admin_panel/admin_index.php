<?php

# Open database connection.
require ('connect_db.php');

include( 'includes/admin_header2.html' );


#connect to the database to retrieve user data
$query = "SELECT * FROM users";
$result = mysqli_query($link, $query);


#Delete user record from database
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE user_id = $id";
    $result = mysqli_query($link, $query);
    if ($result) {
//        redirect to the admin_index page
        header("Location: admin_index.php");
        echo '<p>The user has been deleted.</p>';
    } else {
        echo '<p style="color: red;">The user could not be deleted due to a system error.</p>';
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
<!--table with  user data and ability to edit and delete data-->
<table>
    <h1>User List</h1>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Country</th>
        <th>Email</th>
        <th>Account Type</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php
    # fetch data from database and display to admin
       while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>' . $row['user_id'] . '</td>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . $row['date_of_birth'] . '</td>';
            echo '<td>' . $row['country'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['account_type'] . '</td>';
           echo "<td><a href='edit_user.php?user_id=" . $row['user_id'] . "'>Edit</a></td>";
           echo "<td><form action='add_movie.php' method='post'>";
           echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
           echo "<td><form action='admin_index.php' method='post'>";
           echo "<input type='hidden' name='id' value='" . $row['user_id'] . "'>";
           echo "<input type='submit' name='delete' value='Delete'>";
           echo "</form></td>";
           echo "</tr>";
        }

      ?>

</table>
</body>
</html>
