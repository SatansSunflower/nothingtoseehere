<?php
$servername = "localhost";
$username = "username";
$password = "password";



// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function getOnePerson() {
  echo "Hello world!";
}

function getAllPersons() {
  echo "Hello world!";
}

?>