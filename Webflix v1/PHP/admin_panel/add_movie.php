<?php

# Open database connection.
require ('connect_db.php');

include( 'includes/admin_header2.html' );

#connection to database to retrieve movie information
$query = "SELECT * FROM movies";
$result = mysqli_query($link, $query);

# when submit button is used then add movie to database
if (isset($_POST['submit'])) {
    $move_title = $_POST['movie_title'];
    $cover_image = $_POST['cover_image'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $language = $_POST['language'];
    $movie_duration = $_POST['movie_duration'];
    $trailer = $_POST['trailer'];

    $query = "INSERT INTO movies (movie_title, cover_image, category, description, language, movie_duration, trailer) VALUES ('$move_title', '$cover_image', '$category', '$description', '$language', '$movie_duration', '$trailer')";
    $result = mysqli_query($link, $query);
    if (!$result) {
        die("Database query failed.");
    }
    // refresh page to show new movie
    header("Location: add_movie.php");
    echo "Movie added successfully!";
}


# delete movie from database
if (isset($_POST['delete'])) {
    $movie_id = $_POST['movie_id'];
    $query = "DELETE FROM movies WHERE movie_id = '$movie_id'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        die("Failed to delete movie from database, please try again.");
    }
    // refresh page to show new movie
    header("Location: add_movie.php");
    echo "Movie deleted successfully!";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<!--displays movie information within a table-->
<div class="movie_table">
<table border="12">
    <h1>Movie Information</h1>
    <tr>
        <th>Movie ID</th>
        <th>Movie Title</th>
        <th>Cover Image</th>
        <th>Category</th>
        <th>Description</th>
        <th>Language</th>
        <th>Movie Duration</th>
        <th>Trailer</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['movie_id'] . "</td>";
        echo "<td>" . $row['movie_title'] . "</td>";
        echo "<td>" . $row['cover_image'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['language'] . "</td>";
        echo "<td>" . $row['movie_duration'] . "</td>";
        echo "<td>" . $row['trailer'] . "</td>";
        echo "<td><a href='edit_movie.php?movie_id=" . $row['movie_id'] . "'>Edit</a></td>";
        echo "<td><form action='add_movie.php' method='post'>";
        echo "<input type='hidden' name='movie_id' value='" . $row['movie_id'] . "'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form></td>";
        echo "</tr>";

    }
    ?>
</table>
</div>

<!-- Form to add a new movie-->
<div class="add_movie">
    <h1>Add Movie</h1>
    <form action="add_movie.php" method="post" >
        <p>Movie Title: <input type="text" name="movie_title" required/></p>
        <p>Cover Image: <input type="text" name="cover_image" required/></p>
        <p>Category: <input type="text" name="category" required/></p>
        <p>Description: <input type="text" name="description" required/></p>
        <p>Language: <input type="text" name="language" required/></p>
        <p>Movie Duration: <input type="text" name="movie_duration" required/></p>
        <p>Trailer: <input type="text" name="trailer" required/></p>
        <p><input type="submit" name="submit" value="Add Movie" required/></p>
    </form>
</div>
</body>
</html>