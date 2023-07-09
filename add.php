<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <!-- <input type="text" id="firstname" name="firstname"><br><br>
        <input type="text" id="lastname" name="lastname"><br><br>
        <input type="text" id="mail" name="mail"><br><br> -->

        <!-- <input type="radio" id="mcdonalds" name="food" value="mcdonalds">
         <label for="mcdonalds">mcdonalds</label><br>
         <input type="radio" id="burgerking" name="food" value="burgerking">
         <label for="burgerking">burgerking</label><br><br> -->
        <input type="submit" name="submit" value="Speichern" class="btn btn-primary">
    </form>

</div>
    <?php

    require_once("./includes/functions.php");

    if (isset($_POST["submit"])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $mail = $_POST['mail'];

        insert_into_table("users", $firstname, $lastname, $mail);

        header("Location: ./test-php/test.php");
        exit();
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>