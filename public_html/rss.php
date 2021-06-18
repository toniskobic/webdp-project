<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();


if(isset($_GET['id'])) {

    $connection = new Baza();
    $connection->spojiDB();

    $id = $_GET['id'];
    
    header('Content-type: application/xml'); 
    
    echo "<rss version='2.0' xmlns:atom='http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/'>\n";
    echo "<channel>\n";
    
    echo "<title>RSS kanal</title>\n";
    echo "<link>http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/</link>\n";
    echo "<description>RSS opis</description>\n";
    
    
     
    $query = "SELECT DISTINCT rodjendan.naziv, korisnik.ime, korisnik.prezime, rodjendan.broj_djece, rodjendan.datum," 
            ." rodjendan.vrijeme FROM rodjendan, grupa, korisnik WHERE rodjendan.grupa_id = {$id}" 
            ." AND rodjendan.korisnik_id = korisnik.korisnik_id ORDER BY rodjendan.rodjendan_id DESC LIMIT 10;";
    
    $result = $connection->selectDB($query);
    
    
    while($row = mysqli_fetch_array($result)) {
        $birthdayName = $row['naziv'];
        $firstname = $row['ime'];
        $lastname = $row['prezime'];
        $invited = $row['broj_djece'];
        $date = $row['datum'];
        $time = $row['vrijeme'];
    
        
         echo "<item>";
            echo "<title>$birthdayName</title>\n";
             echo "<title>$firstname $lastname</title>\n";
             echo "<description>$invited</description>\n";
             echo "<pubDate>$date $time GMT</pubDate>\n";
             echo "<link>http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/</link>\n";
             echo "<atom:link href='http://barka.foi.hr/WebDiP/2020_projekti/WebDiP2020x119/' rel='self' type='application/rss+xml'/>\n";
         echo "</item>\n";
    
    }
    
    echo "</channel>\n";
    echo "</rss>\n";

}

?>