<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$text = getTableData();

if(isset($_GET['delete'])) {
    $connection = new Baza();
    $connection->spojiDB();

    $id = $_GET['delete'];

    $query = "DELETE FROM `rodjendan` WHERE rodjendan_id = {$id}";

    $result = $connection->selectDB($query);

    $connection->zatvoriDB();

    echo "<meta http-equiv='refresh' content='0;URL=https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/reservations.php'>";
}

function getTableData()
{
    $connection = new Baza();
    $connection->spojiDB();

    $userId = $_SESSION['ID'];

    $query = "SELECT DISTINCT rodjendan.rodjendan_id, rodjendan.naziv, rodjendan.datum, rodjendan.vrijeme, "
        . "grupa.naziv AS grupa, rodjendan.broj_djece, status.naziv AS `status` FROM rodjendan, korisnik, grupa, `status` "
        . "WHERE rodjendan.korisnik_id = {$userId} AND rodjendan.grupa_id = grupa.grupa_id AND rodjendan.status_id = `status`.`status_id`";

    $result = $connection->selectDB($query);
    $data = '';

    $a = 0;
    while ($row = mysqli_fetch_array($result)) {
        $birthdayId = $row['rodjendan_id'];
        $birthdayName = $row['naziv'];
        $date = $row['datum'];
        $time = $row['vrijeme'];
        $group = $row['grupa'];
        $invited = $row['broj_djece'];
        $status = $row['status'];

        $data .= "<tr><td>$birthdayName</td><td>$date $time</td><td>$group</td><td>$invited</td><td>$status</td>"
                ."<td><form novalidate method=\"get\" action=\"./create_reservation.php\"><button type=\"submit\" name=\"id\" class=\"unstyled-button\" value=\"$birthdayId\">Ažuriraj</button></form></td>"
                ."<td><form novalidate method=\"get\" action=\"\"><button type=\"submit\" name=\"delete\" class=\"unstyled-button\" value=\"$birthdayId\">Obriši</button></form></td></tr>\n";
        $a++;
    }

    $connection->zatvoriDB();
    return $data;
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Rezervacije</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Početna stranica" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.06.2021. Rezervacije web stranice, ključne riječi: Rezervacije, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Rezervacije</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content">
        <a class="button button--primary m-t-md m-b-md link--button-type " href="./create_reservation.php"> Kreiraj rezervaciju</a>

        <section aria-label="statistics" class="box box-scrollable centered center-content">
            <table class="table">
                <thead class="table__head table__head--dark">
                    <tr>
                        <th>Naziv</th>
                        <th>Datum i vrijeme</th>
                        <th>Grupa</th>
                        <th>Broj djece</th>
                        <th>Status</th>
                        <th>Ažuriraj</th>
                        <th>Obriši</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <?php
                    echo $text;
                    ?>
                </tbody>
            </table>
        </section>
        <div class="box box-scrollable centered center-content m-t-md rowdata"></div>
    </main>
    <div class="accesibility">Pristupačnost</div>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./javascript/main_jquery.js"></script>
    <script src="./javascript/main.js"></script>
</body>

</html>