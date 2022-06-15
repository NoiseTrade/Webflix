<?php # Display complete login page

include ( 'includes/login.html' ) ;

# Open database connection.
require ('connect_db.php');


# display any error messages if present
if(isset($errors) && !empty ($errors))
{
    echo '<p data-cy="error" id ="err_msg">Oops! There was a problem: Please try again<br>';
    foreach($errors as $msg) {echo " - $msg<br>";}

}



?>


<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Webflix</title>
</head>
<body>
<div class="login">
    <h1>Welcome to Webflix</h1>
    <form action="login_action.php" method="post">
        <div class="txt_field" id="email">
            <input type="text" name="email" required="" placeholder="Email" data-cy="email">

        </div>
        <div class ="txt_field" id="password">
            <input type="password" name="pass" required="" placeholder="Password"  data-cy="password">

        </div>
       <input type="submit" value="Login" id="Login-button" data-cy="submit">

    </form>
</div>
</body>
</html>

