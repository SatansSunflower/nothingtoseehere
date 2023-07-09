<?php

define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'root' );
define ( 'DB_PASSWORD', '' );
define ( 'DB_NAME', 'lap_php_test' );


$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_errno) {
    die("ERROR: Unable to connect to database. " . $mysqli->connect_error);
}

?>