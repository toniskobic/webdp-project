<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

if (isset($_GET['reset'])) {
    $veza = new Baza();
    $veza->spojiDB();

    $username = $_GET['username'];
    $mail = $_GET['email'];

    $upit = "SELECT *FROM `korisnik` WHERE "
        . "`email`='{$mail}' AND `korisnicko_ime` = '{$username}'";

    $rezultat = $veza->selectDB($upit);

    $autenticiran = false;

    while ($red = mysqli_fetch_array($rezultat)) {
        if ($red) {
            $id = $red["korisnik_id"];
            $autenticiran = true;
        }
    }

    if ($autenticiran) {
        $lozinka = randomPassword();
        $salt = sha1(time());
        $kriptirano = hash("sha256", $salt . "--" . $lozinka);

        $upit = "UPDATE `korisnik` SET "
            . "`lozinka` = '{$lozinka}', `lozinka_sha256` = '{$kriptirano}', `salt` = '{$salt}'"
            . " WHERE `korisnik_id` = '{$id}';";

        $rezultat = $veza->updateDB($upit);
    }

    
    $polje = explode("@", $mail);
    $username = $polje[0];
    
    $mail_to = $mail;
    $mail_from = "From: noreplay@barka.foi.hr";
    $mail_subject = "Zaboravljena lozinka - {$username}";
    $mail_body = "Lozinka resetirana, vasa nova lozinka je: {$lozinka}";

    mail($mail_to, $mail_subject, $mail_body, $mail_from);
    

    header("Location: ./login.php");
}

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Zaboravljena lozinka</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Prijava" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.6.2021. Stranica Zaboravljena lozinka, ključne riječi: prijava, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Prijava</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content">

        <form novalidate class="form centered m-t-md tutorial" method="get" action="">

                <label for="username">Korisničko ime:</label>
                <input type="text" name="username" id="username">

            <div class="flex input-section">
                <label for="e-mail">Elektronička pošta:</label>
                <input type="email" name="email" id="email" />
                <div class="tooltip">
                    <span class="help"> Pomoć </span>
                    <div class="help-message hidden">
                        Ovdje se unosi email
                        <span class="next-button"> Dalje </span>
                    </div>
                </div>
            </div>

            <div class="flex input-section">
                <button type="submit" name="reset" class="button button--primary centered" value="Reset">Resetiraj lozinku</button>
                <div class="tooltip hidden">
                    <span class="help"> Pomoć </span>
                    <div class="help-message hidden">
                        Tipka za resetiranje lozinke
                        <span class="next-button"> Dalje </span>
                    </div>
                </div>
            </div>
        </form>

    </main>
    <div class="accesibility">Pristupačnost</div>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./author.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
    </footer>
    <script src="./javascript/main.js"></script>
</body>

</html>