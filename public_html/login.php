<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

/*
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    exit;
}
*/

$username = '';

if (isset($_COOKIE['autenticiran'])) {
    $username = $_COOKIE['autenticiran'];
}

$autenticiran;

if (isset($_GET['submit'])) {
    $greska = "";
    $poruka = "";
    foreach ($_GET as $k => $v) {
        if (empty($v)) {
            $greska .= "Nije popunjeno: " . $k . "<br>";
        }
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();

        $korime = $_GET['username'];
        $lozinka = $_GET['password'];

        $upit = "SELECT *FROM `korisnik` WHERE "
            . "`korisnicko_ime`='{$korime}'";

        $rezultat = $veza->selectDB($upit);

        $autenticiran = false;
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $aktivan = $red["aktivan"];
                if ($aktivan == 0) {
                    $autenticiran = false;
                } else {
                    $id = $red["korisnik_id"];
                    $tip = $red["uloga_id"];
                    $email = $red["email"];
                    $salt = $red["salt"];
                    $sha256 = $red["lozinka_sha256"];
                    $kriptirano = hash("sha256", $salt . "--" . $lozinka);
                    if ($kriptirano === $sha256) {
                        $autenticiran = true;
                    }
                }
            }
        }

        if ($autenticiran) {
            $poruka = 'Uspješna prijava!';

            $upit = "UPDATE `korisnik` SET "
                . "`broj_neuspjesnih_prijava` = 0"
                . " WHERE `korisnicko_ime` = '{$korime}';";

            $rezultat = $veza->updateDB($upit);

            if (isset($_GET['remember'])) {
                setcookie("autenticiran", $korime, false, '/', false);
            }

            Sesija::kreirajKorisnika($korime, $tip);

            header("Location: ./index.html");

        } else {
            $upit = "UPDATE `korisnik` SET "
                . "`broj_neuspjesnih_prijava` = (broj_neuspjesnih_prijava + 1)"
                . " WHERE `korisnicko_ime` = '{$korime}';";

            if ($aktivan == 1) {
                $rezultat = $veza->updateDB($upit);
            }

            $upit = "SELECT *FROM `korisnik` WHERE "
                . "`korisnicko_ime`='{$korime}'";

            $rezultat = $veza->selectDB($upit);

            while ($red = mysqli_fetch_array($rezultat)) {
                if ($red) {
                    $neuspjesne_prijave = $red["broj_neuspjesnih_prijava"];
                }
            }

            if ($neuspjesne_prijave == 3) {
                $upit = "UPDATE `korisnik` SET "
                    . "`aktivan` = 0"
                    . " WHERE `korisnicko_ime` = '{$korime}';";

                $rezultat = $veza->updateDB($upit);

                $poruka = 'Tri uzastopne neuspješne prijave, račun je zaključan!';
            } else {
                $poruka = 'Neuspješna prijava, pokušajte ponovo!';
            }
        }

        $veza->zatvoriDB();
    }
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
        <form novalidate id="prijava" class="form centered" method="get" action="">
            <div id="greska" style="color:red">
                <?php
                if (isset($autenticiran)) {
                    if ($autenticiran == false) {
                        echo "<p>$poruka</p>";
                    }
                }
                ?>
            </div>
            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" id="username" value="<?php echo $username ?>" />

            <label for="password">Lozinka:</label>
            <input type="password" name="password" id="password" />

            <a class="link--default m-b-sm" href="./restore_password.php">Zaboravljena lozinka?</a>

            <div>
                <input type="checkbox" id="remember" name="remember" value="Remember" class="remember">
                <label for="remember"> Zapamti me</label>
            </div>

            <button type="submit" name="submit" class="button button--primary m-t-md" value="Prijavi se">
                Prijavi se
            </button>
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