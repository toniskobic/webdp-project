<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$autenticiran;

if(isset($_POST['submit'])) {
    $connection = new Baza();
    $connection->spojiDB();

    $date = $_POST['date'];
    $time = $_POST['time'];

    if(isset($_GET['reject'])) {

        $id = $_GET['reject'];

        $query = "UPDATE `rodjendan` SET `datum`='{$date}',`vrijeme`='{$time}',"
                ." `status_id` = 1 WHERE rodjendan_id = {$id}";

        $result = $connection->updateDB($query);

     } //else {
        
    //     $query = "INSERT INTO `rodjendan`(`rodjendan_id`, `korisnik_id`, `status_id`, `grupa_id`, `broj_djece`, `datum`, `vrijeme`, `naziv`, `opis`) "
    //             ."VALUES (NULL, {$userId}, '1' , {$group},'{$participants}','{$date}','{$time}', NULL, NULL)";
    
    //     $result = $connection->updateDB($query);

    // }

    $connection->zatvoriDB();

    header("Location: ./moderator.php");
}


?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Otkaži rođendan</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Otkaži rođendan" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.6.2021. Stranica Otkaži rođendan, ključne riječi: otkaži, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Otkaži rođendan</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content" class="box">
        <form novalidate class="form centered" method="post" action="">

            <label for="date">Datum:</label>
            <input type="date" name="date" id="date" class="date" />

            <label for="time">Vrijeme:</label>
            <input type="time" name="time" id="time" class="time" />

            <button type="submit" name="submit" class="submit button button--primary m-t-md" value="Spremi">
                Spremi
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