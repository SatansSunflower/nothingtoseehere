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

function get_all_data_from_table($table_name) {
    global $conn;
    $sql = "SELECT * FROM {$table_name}";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}

function insert_into_table($table_name, $value_column1, $value_column2, $value_column3)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO " . $table_name . " (firstname, lastname, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $v1, $v2, $v3);

    // set parameters and execute
    $v1 = $value_column1;
	$v2 = $value_column2;
	$v3 = $value_column3;
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

function search_data_by_input($table_name, $search_input)
{
    global $conn;

    $sql = "SELECT * FROM {$table_name} WHERE CONCAT(firstname,lastname,email) LIKE ?";
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
        echo '<table class="table">
		<thead class="table-success">
            <tr class="header">
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
            </tr>
			</thead><tbody class="table-group-divider">';

        while ($row = $result->fetch_assoc()) {
            echo '<tr scope="row">';
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "</tr>";
        }


        echo "</tbody></table>";
    } else {
        echo "No results found for this query.";
    }
}