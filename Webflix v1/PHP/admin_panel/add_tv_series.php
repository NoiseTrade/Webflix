<?php

# Open database connection.
require('connect_db.php');

include('includes/admin_header2.html');

#connection to database to retrieve movie information
$query = "SELECT * FROM tv_series";
$result = mysqli_query($link, $query);

# if submit button is clicked then add tv series to database
if (isset($_POST['submit'])) {
    $tv_series_title = $_POST['tv_series_title'];
    $cover_image = $_POST['cover_image'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $language = $_POST['language'];
    $number_of_seasons = $_POST['number_of_seasons'];
    $number_of_episodes = $_POST['number_of_episodes'];
    $trailer = $_POST['trailer'];

    #query to insert tv series information into database
    $query = "INSERT INTO tv_series (tv_series_title, cover_image, category, description, release_year, language, number_of_seasons, number_of_episodes, trailer) VALUES ('$tv_series_title', '$cover_image', '$category', '$description', '$release_year', '$language', '$number_of_seasons', '$number_of_episodes', '$trailer')";
    $result = mysqli_query($link, $query);

    if(!$result) {
        die("Failed to add tv series to database");
    }
    #redirect to add tv series page
    header("Location: add_tv_series.php");
    echo "Tv series added successfully";

    # delete tv series from database
    if (isset($_POST['delete'])) {
        $tv_series_id = $_POST['tv_series_id'];
        $query = "DELETE FROM tv_series WHERE tv_series_id = '$tv_series_id'";
        $result = mysqli_query($link, $query);
        if(!$result) {
            die("Failed to delete tv series from database");
        }

        #refresh page to show new tv series
        header("Location: add_tv_series.php");
        echo "Tv series deleted successfully";
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

<!--Display tv_series information within table-->
<div class="tv_series_table">
    <table border="12">
        <tr>
            <th>Tv Series Title</th>
            <th>Cover Image</th>
            <th>Category</th>
            <th>Description</th>
            <th>Release Year</th>
            <th>Language</th>
            <th>Number of Seasons</th>
            <th>Number of Episodes</th>
            <th>Trailer</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        #display tv series information within table
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['tv_series_title'] . "</td>";
            echo "<td>" . $row['cover_image'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['release_year'] . "</td>";
            echo "<td>" . $row['language'] . "</td>";
            echo "<td>" . $row['number_of_seasons'] . "</td>";
            echo "<td>" . $row['number_of_episodes'] . "</td>";
            echo "<td>" . $row['trailer'] . "</td>";
            echo "<td><a href='edit_tv_series.php?tv_series_id=" . $row['tv_series_id'] . "'>Edit</a></td>";
            echo "<td><form action='add_tv_series.php' method='post'>
                    <input type='hidden' name='tv_series_id' value='" . $row['tv_series_id'] . "'>
                    <input type='submit' name='delete' value='Delete'>
                  </form></td>";
            echo "</tr>";

        }
        ?>
    </table>
</div>

<!--Form to add a new tv series-->
<div class="add_tv_series">
    <form action="add_tv_series.php" method="post">
        <p>Tv Series Title: <input type="text" name="tv_series_title"></p>
        <p>Cover Image: <input type="text" name="cover_image"></p>
        <p>Category: <input type="text" name="category"></p>
        <p>Description: <input type="text" name="description"></p>
        <p>Release Year: <input type="text" name="release_year"></p>
        <p>Language: <input type="text" name="language"></p>
        <p>Number of Seasons: <input type="text" name="number_of_seasons"></p>
        <p>Number of Episodes: <input type="text" name="number_of_episodes"></p>
        <p>Trailer: <input type="text" name="trailer"></p>
        <p><input type="submit" name="submit" value="Add Tv Series"></p>
    </form>
</div>
</body>
</html>
