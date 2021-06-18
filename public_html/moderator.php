<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$birthdays = getTableBirthdayData();
$reservations = getTableReservationData();

if(isset($_GET['rejectReservation'])) {
    $connection = new Baza();
    $connection->spojiDB();

    $id = $_GET['rejectReservation'];

    $query = "UPDATE `rodjendan` SET `status_id`= 3 WHERE rodjendan_id = {$id}";

    $result = $connection->updateDB($query);

    $connection->zatvoriDB();

    echo "<meta http-equiv='refresh' content='0;URL=https://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/moderator.php'>";
}

function getTableBirthdayData()
{
    $connection = new Baza();
    $connection->spojiDB();

    $moderatorId = $_SESSION['ID'];

    $query = "SELECT DISTINCT rodjendan.rodjendan_id, rodjendan.naziv, rodjendan.opis, rodjendan.datum, "
            ."rodjendan.vrijeme, grupa.naziv AS grupa, rodjendan.broj_djece, status.naziv AS `status` FROM rodjendan, "
            ."korisnik, grupa, grupa_moderator, `status` WHERE rodjendan.grupa_id = grupa_moderator.grupa_id AND "
            ."rodjendan.grupa_id = grupa.grupa_id AND rodjendan.status_id = `status`.`status_id` AND rodjendan.status_id <> 1 AND grupa_moderator.korisnik_id = {$moderatorId}";

    $result = $connection->selectDB($query);
    $data = '';

    $a = 0;
    while ($row = mysqli_fetch_array($result)) {
        $birthdayId = $row['rodjendan_id'];
        $birthdayName = $row['naziv'];
        $birthdayDescr = $row['opis'];
        $date = $row['datum'];
        $time = $row['vrijeme'];
        $group = $row['grupa'];
        $invited = $row['broj_djece'];
        $status = $row['status'];

        $data .= "<tr><td>$birthdayName</td><td>$birthdayDescr</td><td>$date $time</td><td>$group</td><td>$invited</td><td>$status</td>"
                ."<td><form novalidate method=\"get\" action=\"./moderator_decline_birthday.php\"><button type=\"submit\" name=\"reject\" class=\"unstyled-button\" value=\"$birthdayId\">Odbij</button></form></td></tr>\n";
        $a++;
    }

    $connection->zatvoriDB();
    return $data;
}

function getTableReservationData()
{
    $connection = new Baza();
    $connection->spojiDB();

    $moderatorId = $_SESSION['ID'];

    $query = "SELECT DISTINCT rodjendan.rodjendan_id, rodjendan.naziv, rodjendan.opis, rodjendan.datum, "
            ."rodjendan.vrijeme, grupa.naziv AS grupa, rodjendan.broj_djece, status.naziv AS `status` FROM rodjendan, "
            ."korisnik, grupa, grupa_moderator, `status` WHERE rodjendan.grupa_id = grupa_moderator.grupa_id AND "
            ."rodjendan.grupa_id = grupa.grupa_id AND rodjendan.status_id = `status`.`status_id` AND rodjendan.status_id = 1 AND grupa_moderator.korisnik_id = {$moderatorId}";

    $result = $connection->selectDB($query);
    $data = '';

    $a = 0;
    while ($row = mysqli_fetch_array($result)) {
        $birthdayId = $row['rodjendan_id'];
        $birthdayName = $row['naziv'];
        $birthdayDescr = $row['opis'];
        $date = $row['datum'];
        $time = $row['vrijeme'];
        $group = $row['grupa'];
        $invited = $row['broj_djece'];
        $status = $row['status'];

        $data .= "<tr><td>$birthdayName</td><td>$birthdayDescr</td><td>$date $time</td><td>$group</td><td>$invited</td><td>$status</td>"
                ."<td><form novalidate method=\"get\" action=\"./moderator_confirm.php\"><button type=\"submit\" name=\"id\" class=\"unstyled-button\" value=\"$birthdayId\">Potvrdi</button></form></td>"
                ."<td><form novalidate method=\"get\" action=\"\"><button type=\"submit\" name=\"rejectReservation\" class=\"unstyled-button\" value=\"$birthdayId\">Odbij</button></form></td></tr>\n";
        $a++;
    }

    $connection->zatvoriDB();
    return $data;
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Moderator</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Moderator" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.06.2021. Moderator stranica, ključne riječi: Moderator, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Moderator</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content">

        <h1 class="centered center-content">Rođendani</h1>

        <section aria-label="statistics" class="box box-scrollable centered center-content m-b-md">
            <table class="table">
                <thead class="table__head table__head--dark">
                    <tr>
                        <th>Naziv</th>
                        <th>Opis</th>
                        <th>Datum i vrijeme</th>
                        <th>Grupa</th>
                        <th>Broj djece</th>
                        <th>Status</th>
                        <th>Odbij</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <?php
                    echo $birthdays;
                    ?>
                </tbody>
            </table>
        </section>

        <h1 class="centered center-content">Rezervacije</h1>

        <section aria-label="statistics" class="box box-scrollable centered center-content">
            <table class="table">
                <thead class="table__head table__head--dark">
                    <tr>
                        <th>Naziv</th>
                        <th>Opis</th>
                        <th>Datum i vrijeme</th>
                        <th>Grupa</th>
                        <th>Broj djece</th>
                        <th>Status</th>
                        <th>Potvrdi</th>
                        <th>Odbij</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <?php
                    echo $reservations;
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