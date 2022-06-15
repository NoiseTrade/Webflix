<?php

require ('connect_db.php');

include( 'includes/admin_header2.html' );


#if movie_id is not set, will redirect to the main page
if ( !isset( $_GET['tv_series_id'] ) ) {
    header( 'Location: add_movie.php' );
}

# query database depending on tv_series_id
$query = "SELECT * FROM tv_series WHERE tv_series_id = " . $_GET['tv_series_id'];
$result = mysqli_query( $link, $query );

#retrieve the data from the database
$row = mysqli_fetch_array( $result );

#sql query to update the tv_series information after submitting the form based on the tv_series_id
if ( isset( $_POST['submit'] ) ) {
    $query = "UPDATE tv_series SET tv_series_title = '" . $_POST['tv_series_title'] . "', cover_image = '" . $_POST['cover_image'] . "', category = '" . $_POST['category'] . "', description = '" . $_POST['description'] . "', release_year = '" . $_POST['release_year'] . "', language = '" . $_POST['language'] . "', number_of_seasons = '" . $_POST['number_of_seasons'] . "', number_of_episodes = '" . $_POST['number_of_episodes'] . "', trailer = '" . $_POST['trailer'] . "'  WHERE tv_series_id = " . $_GET['tv_series_id'];


    #if the query is successful, will redirect to the main page
    if ( mysqli_query( $link, $query ) ) {
        header( 'Location: add_tv_series.php' );

    }

    #if the query is not successful, will display an error message
    else {
        echo '<p>Could not update Tv Series. Please try again.</p>';
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

</head>
<body>

<!-- display editable table with tv_series information and submit button to update -->
<form action="edit_tv_series.php?tv_series_id=<?php echo $_GET['tv_series_id']; ?>" method="post">
    <table>
        <tr>
            <th>Tv Series Title</th>
            <td><input type="text" name="tv_series_title" value="<?php echo $row['tv_series_title']; ?>"></td>
        </tr>
        <tr>
            <th>Cover Image</th>
            <td><input type="text" name="cover_image" value="<?php echo $row['cover_image']; ?>"></td>
        </tr>
        <tr>
            <th>Category</th>
            <td><input type="text" name="category" value="<?php echo $row['category']; ?>"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><input type="text" name="description" value="<?php echo $row['description']; ?>"></td>
        </tr>
        <tr>
            <th>Release Year</th>
            <td><input type="text" name="release_year" value="<?php echo $row['release_year']; ?>"></td>
        </tr>
        <tr>
            <th>Language</th>
            <td><input type="text" name="language" value="<?php echo $row['language']; ?>"></td>
        </tr>
        <tr>
            <th>Number of Seasons</th>
            <td><input type="text" name="number_of_seasons" value="<?php echo $row['number_of_seasons']; ?>"></td>
        </tr>
        <tr>
            <th>Number of Episodes</th>
            <td><input type="text" name="number_of_episodes" value="<?php echo $row['number_of_episodes']; ?>"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Update"></td>
        </tr>
    </table>
</form>
</body>
</html>
