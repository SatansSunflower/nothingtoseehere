<?php

require_once("db.php");

function fetchOne($table_name, $row_id)
{
    global $conn;
    $sql = "SELECT id, firstname, lastname FROM {$table_name} WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $row_id);
    $stmt->execute();
    
    $result = $stmt->get_result();

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

function filterAllData($table_name, $filter, $column_to_filter)
{
    global $conn;
    $sql = "SELECT * FROM {$table_name} WHERE {$column_to_filter} = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // TODO: display the filtered data in table form
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        }
    } else {
        echo "No results found for this query.";
    }
}

function updateDataById($table_name, $column_to_update, $new_value, $row_id)
{
    global $conn;
    $sql = "UPDATE {$table_name} SET {$column_to_update} = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $new_value);
    $stmt->bind_param("i", $row_id);

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully.";
        // TODO: display this to the user in some way... 
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

function fetchCertainDataRows($table_name, $amount_of_rows, $start_row = 0)
{
    global $conn;

    $sql = "SELECT * FROM {$table_name} LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $amount_of_rows);
    $stmt->bind_param("i", $start_row);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // TODO: display the filtered data in table form
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
        }
    } else {
        echo "No results found for this query.";
    }
}

function deleteRowFromTable($table_name, $row_id)
{
    global $conn;
    $sql = "DELETE FROM {$table_name} WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $row_id);

    if ($stmt->execute() === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

function searchDataByInput($table_name, $search_input, $column_to_search) {
    global $conn; 

    $sql = "SELECT * FROM {$table_name} WHERE {$column_to_search} LIKE ? ORDER BY {$column_to_search} ASC";
    $search = "%{$search_input}%";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();

    $result = $stmt->get_result();

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