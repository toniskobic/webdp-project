<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$autenticiran;

if (isset($_POST['submit'])) {
    $greska = '';
    $poruka = '';
    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $greska .= 'Nije popunjeno: ' . $k . '<br>';
        } elseif ($k === 'Ime' || $k === 'Prezime') {
            if (strlen($v) < 3) {
                $greska .= $k . ' mora imati najmanje 3 znaka <br>';
            }
        } elseif ($k === 'username') {
            $re = '/^[a-zA-Z0-9]{3,}$/';
            $valid = preg_match($re, $v);
            if (!$valid) {
                $greska .= 'Korisničko ime mora sadržavati najmanje 3 znaka te može sadržavati slova ili brojeve <br>';
            }
        } elseif ($k === 'email') {
            $re = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
            $valid = preg_match($re, $v);
            if (!$valid) {
                $greska .= 'Format e-pošte: primjer@primjer.com <br>';
            }
        } elseif ($k === 'password') {
            $re = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/';
            $valid = preg_match($re, $v);
            if (!$valid) {
                $greska .= 'Lozinka mora sadržavati bar 8 znakova, 1 broj, 1 malo slovo, 1 veliko slovo, slova i brojeve';
            }
        }
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $greska .= 'Lozinke se ne podudaraju! <br>';
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();

        $ime = $_POST['Ime'];
        $prezime = $_POST['Prezime'];
        $korime = $_POST['username'];
        $email = $_POST['email'];
        $lozinka = $_POST['password'];
        $salt = sha1(time());
        $kriptirano = hash("sha256", $salt . "--" . $lozinka);

        $upit = "INSERT INTO korisnik "
            . "(korisnik_id, uloga_id, ime, prezime, korisnicko_ime, lozinka, lozinka_sha256, email, aktivan, broj_neuspjesnih_prijava, datum_registracije, salt) "
            . "VALUES "
            . "(NULL, '1', '{$ime}', '{$prezime}', '{$korime}', '{$lozinka}', '{$kriptirano}', '{$email}', 0, 0, NOW(), '{$salt}')";

        $rezultat = $veza->updateDB($upit);

        $query = "SELECT korisnik_id FROM korisnik WHERE korisnicko_ime = '{$korime}' AND lozinka_sha256 = '{$kriptirano}'";

        $rezultat = $veza->selectDB($query);

        while ($row = mysqli_fetch_array($rezultat)) {
            if ($row) {
                $id = $row["korisnik_id"];
            }
        }

        $datetime = date('Y-m-d H:i:s');

        $query = "INSERT INTO `dnevnik`(`dnevnik_id`, `tip_id`, `korisnik_id`, `radnja`, `upit`, `datum_vrijeme`) "
                . "VALUES (NULL , 2, {$id}, 'Uspješna registracija' , 'INSERT', '{$datetime}')";

        $result = $veza->updateDB($query);

        $veza->zatvoriDB();

        $txt = "http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/activation.php?username=" . $korime . "&password=" . $kriptirano . "&email=" . $email . "&time=" . time();



        $mail_to = $email;
        $mail_from = "From: noreplay@barka.foi.hr";
        $mail_subject = "Rodjendani aktivacija - {$korime}";
        $mail_body = "Postovani, na ovu poveznicu aktivirajte korisnicki racun: {$txt}";

        mail($mail_to, $mail_subject, $mail_body, $mail_from);

        header("Location: ./login.php");
    }
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Registracija</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Registracija" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.6.2021. Stranica registracije, ključne riječi: registracija, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Registracija</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content" class="box">
        <form novalidate class="form centered registrate tutorial" method="post" action="" onsubmit="return checkReCaptcha();">
            <div id="greska" style="color:red">
                <?php
                if (isset($greska)) {
                    echo "<p>$greska</p>";
                }
                ?>
            </div>
            <div class="flex input-section">
                <label for="name">Ime:</label>
                <input type="text" name="Ime" id="name" class="name" />
                <div class="tooltip">
                    <span class="help"> Pomoć </span>
                    <div class="help-message hidden">
                        Ovdje se unosi ime
                        <span class="next-button"> Dalje </span>
                    </div>
                </div>
            </div>

            <div class="flex input-section">
                <label for="surname">Prezime:</label>
                <input type="text" name="Prezime" id="surname" class="surname" />
                <div class="tooltip hidden">
                    <span class="help"> Pomoć </span>
                    <div class="help-message hidden">
                        Ovdje se unosi prezime
                        <span class="next-button"> Dalje </span>
                    </div>
                </div>
            </div>

            <div class="flex input-section">
                <label for="username">Korisničko ime:</label>
                <input type="text" name="username" id="username" class="username" />
                <div class="tooltip hidden">
                    <span class="help"> Pomoć </span>
                    <div class="help-message hidden">
                        Ovdje se unosi korisničko ime
                        <span class="next-button"> Dalje </span>
                    </div>
                </div>
            </div>

            <label for="email">Elektronička pošta:</label>
            <input type="email" name="email" id="email" class="email" />

            <label for="password">Lozinka:</label>
            <input type="password" name="password" id="password" class="password" />

            <label for="confirm_password">Potvrda lozinke:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="confirm_password" />

            <div class="g-recaptcha" data-sitekey="6LcgKTkbAAAAAIQKdfklkhH1cRAANQlBLTxZG8ro"></div>
            <br />
            <script type="text/javascript">
                function checkReCaptcha() {
                    if (grecaptcha.getResponse() == "") {
                        alert("Neuspješna validacija!");
                        return false;
                    } else {
                        return true;
                    }
                }
            </script>
            <button type="submit" name="submit" class="submit button button--primary m-t-md" value="Registriraj se">
                Registriraj se
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./javascript/main_jquery.js"></script>
    <script src="./javascript/main.js"></script>

</body>

</html>