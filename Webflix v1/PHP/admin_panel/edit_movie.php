<?php
# Open database connection.
require ('connect_db.php');

include( 'includes/admin_header2.html' );


#if movie_id is not set, will redirect to the main page
if ( !isset( $_GET['movie_id'] ) ) {
  header( 'Location: add_movie.php' );
}

# query database depending on the movie_id
$query = "SELECT * FROM movies WHERE movie_id = " . $_GET['movie_id'];
$result = mysqli_query( $link, $query );

#retrieve the movie information from the database based on the movie_id
$row = mysqli_fetch_array( $result );


#sql query to update the movie information after submitting the form based on the movie_id
if ( isset( $_POST['submit'] ) ) {
  $query = "UPDATE movies SET movie_title = '" . $_POST['movie_title'] . "', cover_image = '" . $_POST['cover_image'] . "', category = '" . $_POST['category'] . "', description = '" . $_POST['description'] . "', language = '" . $_POST['language'] . "', movie_duration = '" . $_POST['movie_duration'] . "', trailer = '" . $_POST['trailer'] . "' WHERE movie_id = " . $_GET['movie_id'];

  #if the query is successful, we will redirect to the main page
  if ( mysqli_query( $link, $query ) ) {
    header( 'Location: add_movie.php' );

  }
  #if the query is not successful, we will display an error message
  else {
    echo '<p>Could not update movie. Please try again.</p>';
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


<!-- display editable table with movie information and submit button to update -->
<div class="edit_movie">
<form action="edit_movie.php?movie_id=<?php echo $_GET['movie_id']; ?>" method="post">
    <table>
        <tr>
            <td>Movie Title</td>
            <td><input type="text" name="movie_title" value="<?php echo $row['movie_title']; ?>" required></td>
        </tr>
        <tr>
            <td>Cover Image</td>
            <td><input type="text" name="cover_image" value="<?php echo $row['cover_image']; ?>" required></td>
        </tr>
        <tr>
            <td>Category</td>
            <td><input type="text" name="category" value="<?php echo $row['category']; ?>" required></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input type="text" name="description" value="<?php echo $row['description']; ?>" required></td>
        </tr>
        <tr>
            <td>Language</td>
            <td><input type="text" name="language" value="<?php echo $row['language']; ?>" required></td>
        </tr>
        <tr>
            <td>Movie Duration</td>
            <td><input type="text" name="movie_duration" value="<?php echo $row['movie_duration']; ?>" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Update"></td>
        </tr>
    </table>
</form>
</div>
</body>
</html>
