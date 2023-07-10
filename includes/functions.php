<?php
/**
 * This PHP file is used for common functions in regards to the database.
 * You can find all sorts of needed functionalities for getting and manipulating data as well as displaying it. 
 */

// This imports the db.php file, which allows us to use the variables defined there, such as the connection to the database.
require_once("db.php");

/**
 * This function returns one singular row from the provided table with the id.
 * The function then renders the result and displays it in table form by calling the render_table() function.
 * 
 * @param string $table_name The name of the table you want to query.
 * @param int $row_id The id of the row you want to recieve. 
 * 
 * @see render_table()
 */
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


/**
 * This function returns every entry from the provided table.
 * The function then renders the result and displays it in table form by calling the render_table() function.
 * 
 * @param string $table_name The name of the table you want to query.
 * 
 * @see render_table()
 */
function get_all_data_from_table($table_name)
{
    global $conn;
    $sql = "SELECT * FROM {$table_name}";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}


/**
 * This function takes values and the name of a table, then inserts the values into said table.
 * Once created the function calls another one, which gets all the data again including the newly created row. 
 * 
 * @param string $table_name The name of the table you want to query.
 * @param string $value_column1 The first value inserted into the table.
 * @param string $value_column2 The second value inserted into the table.
 * @param string $value_column3 The third value inserted into the table.
 * 
 * @see get_all_data_from_table()
 */
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

    get_all_data_from_table($table_name);
}

/**
 * This function takes a filter value and filters the database with the provided information.
 * Once created the function calls another one, which renders all filtered data inside a table. 
 * 
 * @param string $table_name The name of the table you want to query.
 * @param string $filter The value with which to filter.
 * @param string $column_to_filter The column which should be filtered.
 * 
 * @see render_table()
 */
function filter_all_data($table_name, $filter, $column_to_filter)
{
    global $conn;
    $sql = "SELECT * FROM {$table_name} WHERE {$column_to_filter} = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $f);
    $f = $filter;
    $stmt->execute();

    $result = $stmt->get_result();

    render_table($result);
}

// TODO:
function update_data_by_id($table_name, $column_to_update, $new_value, $row_id)
{
    global $conn;
    $sql = "UPDATE {$table_name} SET {$column_to_update} = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $new_val);
    $stmt->bind_param("i", $id);

    $new_val = $new_value;
    $id = $row_id;

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully.";
        fetch_one_row($table_name, $row_id);
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// TODO:
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

// TODO:
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

// TODO:
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

// TODO:
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