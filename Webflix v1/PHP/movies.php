<?php

#Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# includes the main.html document that displays the navbar and nav links to the user
include ('includes/main.html');


# Open database connection.
require ('connect_db.php');

#movies.php?id= is the id of the movie that is being viewed and displayed to user.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

#display the movie information based on the movie id
$query = "SELECT * FROM movies WHERE movie_id = $id";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

#variables for the movie information
$cover = $row['cover_image'];
$title = $row['movie_title'];
$category = $row['category'];
$description = $row['description'];
$language = $row['language'];
$duration = $row['movie_duration'];
$trailer = $row['trailer'];

#get user account_type from database
$account_type_query = "SELECT account_type FROM users WHERE user_id = '$_SESSION[user_id]'";

#variables to store the account_type so that it can be used to display different content to the user
$account_type_fetch = mysqli_query($link, $account_type_query);
$account_type_result = mysqli_fetch_array($account_type_fetch);



?>

<!
<html>
<head>

</head>
<body>
<div class="movie-container">
    <div class="movie-info">
        <div class="movie-trailer-container">
            <p data-cy="trailer"><?php echo $trailer; ?></p>
        </div>

        <div class="movie-details">
            <h1><?php echo $title; ?></h1>
            <h2>Category:<?php echo " " . $category; ?></h2>
            <h2>Description: <?php echo " " . $description; ?></h2>
            <p>Language: <?php echo $language; ?></p>
            <p>Duration: <?php echo $duration; ?></p>
        </div>

        <div class="movie-buttons">
            <!--if $account_type_result = 'Free' display upgrade now button-->
            <?php if ($account_type_result['account_type'] == 'Free') { ?>
                <form action="user.php" method="post">
                    <input type="submit" value="Upgrade now!" class="upgrade-button">
                </form>
            <?php } ?>


            <!-- if $account_type_result = 'Subscriber' display 'Watch Now' button-->
            <?php if ($account_type_result['account_type'] == 'Subscriber') { ?>
                <form action="" method="post">
                    <input type="submit" value="Watch Now!" class="watch-button">
                </form>
            <?php } ?>
                </div>
        </div>
    </div>
</div>
</body>




