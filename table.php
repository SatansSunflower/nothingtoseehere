<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <div class="col-6" style="margin-left: 4%; margin-top: 4%">
        <div>
            <form action="" method="POST">
                <div style="display: flex">
                    <input class="form-control" style="margin-right: 2%" type="text" name="search" value="<?php if (isset($_POST['search'])) {
                                                            echo $_POST['search'];
                                                        } ?>">
                    <button type="submit" class="btn btn-primary">Suche</button>
                </div>
            </form>
        </div><br>

        <div>
            <form action="" method="POST">
                <div style="display: flex;">
                    <input type="number" name="filter" class="form-control" style="margin-right: 2%">
                    <button type="submit" class="btn btn-primary">filtern</button>
                </div>
            </form>
        </div><br>

        <?php
        require_once("../includes/functions.php");

/**
 * This code determines if either one of the submit buttons have been used. 
 * The first one will search the table using a helper function and return all results, which include the provided string.
 * The second submit button (filter) will filter the database with the provided id, the result will then also be displayed.
 * If neither of the buttons are clicked (default page view) the helper function will display all data.
 * 
 * @see search_data_by_input()
 * @see filter_all_data()
 * @see get_all_data_from_table()
 */
        if (isset($_POST['search'])) {
            $filterval = $_POST['search'];
            search_data_by_input("users", $filterval);
        } 
        elseif (isset($_POST['filter'])) {
            $filterval = $_POST['filter'];
            filter_all_data("users", $filterval, "id");
        }
        else {
            get_all_data_from_table("users");
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>