<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$connection = new Baza();
$connection->spojiDB();

$userId = $_SESSION['ID'];
$datetime = date('Y-m-d H:i:s');

$query = "INSERT INTO `dnevnik`(`dnevnik_id`, `tip_id`, `korisnik_id`, `radnja`, `upit`, `datum_vrijeme`) "
                    ."VALUES (NULL , 3, {$userId}, 'Uspješna odjava' , 'PRAZNO', '{$datetime}')";

$result = $connection->selectDB($query);

$connection->zatvoriDB();

Sesija::obrisiSesiju();

header("Location: ./index.php");

?>