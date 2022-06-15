<?php # PROCESS LOGIN ATTEMPT.

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
    # Open database connection.
    require ( 'connect_db.php' ) ;

    # Get connection, load, and validate functions.
    require ( 'login_tools.php' ) ;

    # Check login.
    list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;



    if ( $check)
    {
        # Access session.
        session_start();
        $_SESSION[ 'admin_id' ] = $data[ 'admin_id' ] ;
        $_SESSION[ 'first_name' ] = $data[ 'first_name' ] ;
        $_SESSION[ 'last_name' ] = $data[ 'last_name' ] ;
        load ( 'admin_index.php' ) ;
    } else
    {
        # On failure set errors.

        $errors = $data ;
    }

    # Close database connection.
    mysqli_close( $link ) ;
}

# Continue to display login page on failure.
include ( 'admin_login_register.php' ) ;

?>