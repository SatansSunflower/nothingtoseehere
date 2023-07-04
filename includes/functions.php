<?php

require_once("db.php");

function fetch_one_row($table_name, $row_id)
{
    global $conn;
    $sql = "SELECT id, firstname, lastname FROM {$table_name} WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $row_id);
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}

function insert_into_table($table_name, $value_column1, $value_column2, $value_column3)
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

function filter_all_data($table_name, $filter, $column_to_filter)
{
    global $conn;
    $sql = "SELECT * FROM {$table_name} WHERE {$column_to_filter} = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $filter);
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}

function update_data_by_id($table_name, $column_to_update, $new_value, $row_id)
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

function fetch_certain_data_rows($table_name, $amount_of_rows, $start_row = 0)
{
    global $conn;

    $sql = "SELECT * FROM {$table_name} LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $amount_of_rows);
    $stmt->bind_param("i", $start_row);
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}

function delete_row_from_table($table_name, $row_id)
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

function search_data_by_input($table_name, $search_input, $column_to_search)
{
    global $conn;

    $sql = "SELECT * FROM {$table_name} WHERE {$column_to_search} LIKE ? ORDER BY {$column_to_search} ASC";
    $search = "%{$search_input}%";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}

function render_table($result)
{
    if ($result->num_rows > 0) {
        echo '<table class="striped">
            <tr class="header">
                <td>Id</td>
                <td>Name</td>
                <td>Title</td>
            </tr>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Title"] . "</td>";
            echo "</tr>";
        }


        echo "</table>";
    } else {
        echo "No results found for this query.";
    }
}