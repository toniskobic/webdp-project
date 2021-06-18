<?php

require "../baza.class.php";
require "../sesija.class.php";

Sesija::kreirajSesiju();

$connection = new Baza();
$connection->spojiDB();

$query = "SELECT korisnik_id, uloga_id, ime, prezime, korisnicko_ime, lozinka FROM korisnik";

$result = $connection->selectDB($query);

$text = "";

while ($row = mysqli_fetch_array($result)) {
    if ($row) {
        $userid = $row['korisnik_id'];
        $role = $row['uloga_id'];
        $name = $row['ime'];
        $surname = $row['prezime'];
        $username = $row['korisnicko_ime'];
        $password = $row['lozinka'];

        $text .= "<tr><td>$userid</td><td>$role</td><td>$name</td><td>$surname</td><td>$username</td><td>$password</td></tr>\n";

    }
}

$connection->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Korisnici</title>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Uloga</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Korisničko ime</th>
                <th>Lozinka</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $text;
            ?>
        </tbody>
    </table>

</body>

</html>