<?php
/** 
 * This is a common-module PHP file for connecting to a MySQL database using mysqli
 */

// These global constants define the connection information needed for the database 
define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'root' );
define ( 'DB_PASSWORD', '' );
define ( 'DB_NAME', 'php_lap_test' );

/** 
 * This creates a new connection to the MySQL database with the constants defined above. 
 * The conn variable can then be used globally, provided that you include the db.php file
**/
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// If the connection cannot be established, then this error will be displayed on the page
if ($conn->connect_errno) {
    die("ERROR: Unable to connect to database. " . $mysqli->connect_error);
}

?>