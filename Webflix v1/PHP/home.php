<?php

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; } 

# Set page title and display header section.
$page_title = 'What\’s On' ;
include ('includes/main.html');

# Open database connection.
require ('connect_db.php');

# Retrieve movies from 'movies' database table.
$query = "SELECT * FROM movies" ;
$result = mysqli_query( $link, $query ) ;

# if no movies then display message.
if ( mysqli_num_rows( $result ) == 0 ) {
  echo '<p>There are no movies to show.</p>' ;
}


# retrieve tv_series from 'tv_series' database table.
$query2 = "SELECT * FROM tv_series" ;
$result2 = mysqli_query( $link, $query2 ) ;

# if no tv_series then display message.
if ( mysqli_num_rows( $result2 ) == 0 ) {
  echo '<p>There are no tv_series to show.</p>' ;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>What's On</title>

<!--styling specific to this page-->
    <style>
        h1{
            text-align: center;
            padding-bottom: 10px;
            text-decoration: underline white 2px;
        }
    </style>

</head>
<body>
<h1>Movies</h1>
<table>
<!--    table that connects to the database and uses loop to display movies in a table aligned in a row-->
    <?php
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if($i % 10 == 0){
            echo '<tr>';
        }
        #display cover_image from database
        echo '<td><a href="movies.php?id='. $row['movie_id'] .'"><img src="' . $row['cover_image'] . '" alt="' . $row['movie_title'] . '" id="' . $row['movie_title'] . '" width="200" height="300" data-cy="' . $row['movie_title'] . '" </a></td>';
        if($i % 10 == 9){
            echo '</td>';
        }
        $i++;
    }
    ?>
</table>

<h1>TV-Series</h1>
<table>
<!--    table that connects to the database and uses loop to display tv-series in a table aligned in a row-->
    <?php
    $i = 0;
    while ($row = mysqli_fetch_assoc($result2)) {
        if($i % 10 == 0){
            echo '<tr>';
        }
        //display cover_image from database
        echo '<td><a href="tv_series.php?id='. $row['tv_series_id'] .'"><img src="' . $row['cover_image'] . '" alt="' . $row['tv_series_title'] . '" id="' . $row['tv_series_title'] . '" width="200" height="300" </></td>';
        if($i % 10 == 9){
            echo '</td>';
        }
        $i++;
    }
    ?>
</table>
</body>
<html>


