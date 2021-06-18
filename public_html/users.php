<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$text = getTableData();

if(isset($_POST['id'])) {
    $connection = new Baza();
    $connection->spojiDB();

    $id = $_POST['id'];
    $active = $_POST['status'];

    if($active == 0) {
        $set = 1;
        $logins = 0;
        $query = "UPDATE `korisnik` SET `aktivan` = '{$set}', `broj_neuspjesnih_prijava` = '{$logins}' WHERE `korisnik_id` = '{$id}'";
    } else {
        $set = 0;
        $query = "UPDATE `korisnik` SET `aktivan` = '{$set}' WHERE `korisnik_id` = '{$id}'";
    }

    $result = $connection->updateDB($query);

    $connection->zatvoriDB();

    echo "<meta http-equiv='refresh' content='0'>";
    
}

function getTableData()
{
    $connection = new Baza();
    $connection->spojiDB();

    $query = "SELECT korisnik.korisnik_id, korisnik.uloga_id, uloga.naziv, korisnik.ime, korisnik.prezime, korisnik.aktivan FROM korisnik, uloga WHERE korisnik.uloga_id = uloga.uloga_id";

    $result = $connection->selectDB($query);
    $data = '';

    $a = 0;
    while ($row = mysqli_fetch_array($result)) {
        $userId = $row['korisnik_id'];
        $roleId = $row['uloga_id'];
        $roleName = $row['naziv'];
        $firstName = $row['ime'];
        $lastName = $row['prezime'];
        $active = $row['aktivan'];

        if($active == '0') {
            $status = 'blokiran';
        } else {
            $status = 'aktivan';
        }

        $data .= "<tr><td>$userId</td><td>$roleName</td><td>$firstName</td><td>$lastName</td>"
                ."<td><form novalidate method=\"post\" action=\"./users.php\"><input type=\"hidden\" name=\"id\" value=\"$userId\"/>"
                ."<button type=\"submit\" name=\"status\" class=\"unstyled-button\" value=\"$active\">$status</button></form></td></tr>\n";

        $a++;
    }

    $connection->zatvoriDB();
    return $data;
}


?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Korisnici</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Početna stranica" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.06.2021. Korisnici, ključne riječi: korisnici, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Korisnici</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content">
        <section aria-label="statistics" class="box box-scrollable centered center-content">
            <table class="table">
                <thead class="table__head table__head--dark">
                    <tr>
                        <th>ID</th>
                        <th>Uloga</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Status</th>
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