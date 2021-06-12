<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

if(isset($_GET['reset'])) {
    $veza = new Baza();
    $veza->spojiDB();

    $mail = $_GET['email'];

    $upit = "SELECT *FROM `korisnik` WHERE "
            . "`email`='{$mail}'";

    $rezultat = $veza->selectDB($upit);

    $autenticiran = false;

    while ($red = mysqli_fetch_array($rezultat)) {
        if ($red) {
            $id = $red["korisnik_id"];
            $autenticiran = true;
        }
    }

    if($autenticiran) {
        $lozinka = randomPassword();
        $salt = sha1(time());
        $kriptirano = hash("sha256", $salt . "--" . $lozinka);

        $upit = "UPDATE `korisnik` SET "
                . "`lozinka` = '{$lozinka}', `lozinka_sha256` = '{$kriptirano}', `salt` = '{$salt}'"
                . " WHERE `korisnik_id` = '{$id}';";

        $rezultat = $veza->updateDB($upit);
    }

    /*
    $polje = explode("@", $mail);
    $username = $polje[0];
    
    $mail_to = $mail;
    $mail_from = "From: noreplay@barka.foi.hr";
    $mail_subject = "SK - {$username}";
    $mail_body = 'Lozinka resetirana, vaša nova lozinka je: {$lozinka}';

    mail($mail_to, $mail_subject, $mail_body, $mail_from);
    */
    
    header("Location: ./login.php");
}

function randomPassword() {
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
    <title>Prijava</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Prijava" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.6.2021. Stranica Prijava na web stranicu, ključne riječi: prijava, rođendan, novosti" />
    <link rel="stylesheet" href="./css/main.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Prijava</a>
        <?php
        include './menu.php';
        ?>

        <section aria-label="social networks" class="social-icons">
            <img class="social-icon m-l-sm" src="./multimedia/images/rss.png" alt="rss" />
        </section>
    </header>
    <main id="content">

        <form novalidate class="form centered m-t-md" method="get" action="">
            <label for="e-mail">Elektronička pošta:</label>
            <input type="email" name="email" id="email" />

            <button type="submit" name="reset" class="button button--primary" value="Reset">Resetiraj lozinku</button>
        </form>

    </main>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./author.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
    </footer>
</body>

</html>