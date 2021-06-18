<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$autenticiran;

if(isset($_POST['submit'])) {
    $connection = new Baza();
    $connection->spojiDB();

    $name = $_POST['name'];
    $description = $_POST['description'];

    if(isset($_GET['id'])) {

        $birthdayId = $_GET['id'];

        $query = "UPDATE `rodjendan` SET `naziv`= '{$name}', `opis`= '{$description}',"
                ." `status_id` = 2 WHERE `rodjendan_id` = {$birthdayId}";

        $result = $connection->updateDB($query);

    }

    $connection->zatvoriDB();

    header("Location: ./moderator.php");
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Potvrdi rezervaciju</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Potvrdi rezervaciju" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.6.2021. Stranica Potvrdi rezervaciju, ključne riječi: potvrdi, rezervacija" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Potvrdi rezervaciju</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content" class="box">
        <form novalidate class="form centered" method="post" action="">

            <label for="name">Naziv:</label>
            <input type="text" name="name" id="name" class="name" />

            <label for="description">Opis:</label>
            <input type="text" name="description" id="description" class="description" />

            <button type="submit" name="submit" class="submit button button--primary m-t-md" value="Potvrdi">
                Potvrdi
            </button>
        </form>

    </main>
    <div class="accesibility">Pristupačnost</div>

    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
    </footer>

    <script src="./javascript/main.js"></script>

</body>

</html>