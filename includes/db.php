<?php

define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'insert_username_here' );
define ( 'DB_PASSWORD', 'insert_secret_password_here' );
define ( 'DB_NAME', 'insert_database_name_here' );


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_errno) {
    die("ERROR: Unable to connect to database. " . $mysqli->connect_error);
}

?>