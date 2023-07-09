<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <div class="col-6" style="margin-left: 4%; margin-top: 4%">
        <div>
            <form action="" method="POST">
                <input type="text" name="search" value="<?php if (isset($_POST['search'])) {
                                                            echo $_POST['search'];
                                                        } ?>">
                <button type="submit">Suche</button>
            </form>
        </div><br>
        <?php
        require_once("../includes/functions.php");



        if (isset($_POST['search'])) {
            $filterval = $_POST['search'];
            search_data_by_input("users", $filterval);
        } else {
            get_all_data_from_table("users");
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>