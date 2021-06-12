<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

$autenticiran;

if (isset($_POST['submit'])) {
    $greska = '';
    $poruka = '';
    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $greska .= 'Nije popunjeno: ' . $k . '<br>';
        }
    }
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $greska .= 'Lozinke se ne podudaraju! <br>';
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();

        $ime = $_POST['name'];
        $prezime = $_POST['surname'];
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

        $veza->zatvoriDB();

        $txt = "http://localhost:3000/public_html/activation.php?username=" . $korime . "&lozinka=" . $kriptirano . "&email=" . $email . "&time=" . time();

        /*
    
        $mail_to = $email;
        $mail_from = "From: noreplay@barka.foi.hr";
        $mail_subject = "Rođendani aktivacija - {$korime}";
        $mail_body = 'Poštovani, na ovu poveznicu aktivirajte korisnički račun: {$txt}';

        mail($mail_to, $mail_subject, $mail_body, $mail_from);
        */
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
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Registracija</a>
        <?php
        include './menu.php';
        ?>

        <section aria-label="social networks" class="social-icons">
            <img class="social-icon m-l-sm" src="./multimedia/images/rss.png" alt="rss" />
        </section>
    </header>
    <main id="content" class="box">
        <form novalidate class="form centered" method="post" action="">
            <label for="name">Ime:</label>
            <input type="text" name="name" id="name" class="name" />

            <label for="surname">Prezime:</label>
            <input type="text" name="surname" id="surname" class="surname" />

            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" id="username" class="username" />

            <label for="email">Elektronička pošta:</label>
            <input type="email" name="email" id="email" />

            <label for="password">Lozinka:</label>
            <input type="password" name="password" id="password" class="password" />

            <label for="confirm_password">Potvrda lozinke:</label>
            <input type="password" name="confirm password" id="confirm_password" class="confirm_password" />

            <button type="submit" name="submit" class="button button--primary m-t-md" value="Registriraj se">
                Registriraj se
            </button>
        </form>
    </main>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./author.php">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
    </footer>
    <!--<script src="../javascript/tskobic_jquery.js"></script>-->
</body>

</html>