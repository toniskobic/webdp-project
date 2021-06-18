<?php

if(!isset($_SESSION['uloga'])){
    echo "<nav class=\"box-fluid navigation\">
        <ul class=\"list--unstyled list--direction\">
            <li><a class=\"link\" href=\"./index.php\">Početna</a></li>
            <li><a class=\"link\" href=\"./login.php\">Prijava</a></li>
            <li><a class=\"link\" href=\"./registration.php\">Registracija</a></li>
            <li><a class=\"link\" href=\"./autor.html\">O autoru</a></li>
            <li><a class=\"link\" href=\"./dokumentacija.html\">Dokumentacija</a></li>
            <li><a class=\"link\" href=\"./privatno/korisnici.php\">Korisnici</a></li>";

}
if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 1) {
    echo "<nav class=\"box-fluid navigation\"><ul class=\"list--unstyled list--direction\">";
    echo "<li><a class=\"link\" href=\"./index.php\">Početna</a></li>";
    echo "<li><a class=\"link\" href=\"./logout.php\">Odjava</a></li>";
    echo "<li><a class=\"link\" href=\"./autor.html\">O autoru</a></li>";
    echo "<li><a class=\"link\" href=\"./dokumentacija.html\">Dokumentacija</a></li>";
    echo "<li><a class=\"link\" href=\"./reservations.php\">Rezervacije</a></li>";
    echo "<li><a class=\"link\" href=\"./privatno/korisnici.php\">Korisnici</a></li>";
}
if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 2) {
    echo "<li><a class=\"link\" href=\"./moderator.php\">Moderator</a></li>";
}
if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 3) {
    echo "<li><a class=\"link\" href=\"./users.php\">Status korisnika</a></li>";
}
echo "</ul></nav>";

?>
