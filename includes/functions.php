<?php

require_once("db.php");

function fetchOne($table_name)
{
    global $conn;
    $sql = "SELECT id, firstname, lastname FROM" . $table_name;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            // TODO: display rows in table form here
            echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        }
    } else {
        echo "No results found for this query.";
    }
}

function insertIntoTable($table_name, $value_column1, $value_column2, $value_column3)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO" . $table_name . "(firstname, lastname, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $value_column1, $value_column2, $value_column3);

    // set parameters and execute
    $value_column1 = "John";
    $value_column2 = "Doe";
    $value_column3 = "john@example.com";
    $stmt->execute();

    echo "New rows created successfully.";
}