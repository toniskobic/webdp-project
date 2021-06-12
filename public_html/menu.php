<?php

if(!isset($_SESSION['uloga'])){
    echo "<nav class=\"box-fluid navigation\">
        <ul class=\"list--unstyled list--direction\">
            <li><a class=\"link\" href=\"$putanja/index.html\">Početna</a></li>
            <li><a class=\"link\" href=\"$putanja/login.php\">Prijava</a></li>
            <li><a class=\"link\" href=\"$putanja/registrate.php\">Registracija</a></li>
            <li><a class=\"link\" href=\"$putanja/author.php\">O autoru</a></li>";
}
if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 1) {
    echo "<nav class=\"box-fluid navigation\"><ul class=\"list--unstyled list--direction\">";
    echo "<li><a class=\"link\" href=\"$putanja/index.html\">Početna</a></li>";
    echo "<li><a class=\"link\" href=\"$putanja/logout.php\">Odjava</a></li>";
    echo "<li><a class=\"link\" href=\"$putanja/author.php\">O autoru</a></li>";
}
if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 2) {
    echo "<li><a class=\"link\" href=\"$putanja/index.php\">Početna</a></li>";
    echo "<li><a class=\"link\" href=\"$putanja/obrasci/obrazac.php\">Obrazac</a></li>";
}
if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 3) {
    echo "<li><a class=\"link\" href=\"$putanja/era.php\">ERA</a></li>";
    echo "<li><a class=\"link\" href=\"$putanja/navigacijski.php\">Navigacijski dijagram</a></li>";
}
echo "</ul></nav>";

?>
