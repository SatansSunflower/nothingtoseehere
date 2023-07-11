<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Daten einfügen</title>
</head>

<body>
    <div class="col-6" style="margin-left: 4%; margin-top: 4%">

        <h2>Daten einfügen</h2>

        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="firstname_id">Vorname</label>
                <input type="text" class="form-control" id="firstname_id" name="firstname" placeholder="Vorname">
            </div>
            <div class="form-group mb-3">
                <label for="lastname_id">Nachname</label>
                <input type="text" class="form-control" id="lastname_id" name="lastname" placeholder="Nachname">
            </div>
            <div class="form-group mb-3">
                <label for="mail_id">E-Mail</label>
                <input type="email" class="form-control" id="mail_id" name="mail" placeholder="E-Mail eingeben">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="check_id" name="check">
                <label class="form-check-label" for="check_id">Check me out</label>
            </div>
            <input type=" submit" name="submit" value="Speichern" class="btn btn-primary">
        </form>

    </div>
    <?php

    require_once("./includes/functions.php");

    /**
     * If the form is submitted, then the values will be extracted and assigned, then passed into an insert helper function.
     * The person will then be redirected to the main page, where all entries will be displayed. 
     */
    if (isset($_POST["submit"])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $mail = $_POST['mail'];

        insert_into_table("users", $firstname, $lastname, $mail);

        header("Location: ./test-php/test.php");
        exit();
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>