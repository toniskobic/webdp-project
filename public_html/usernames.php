<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

if(isset($_GET["username"])) {
    
    $connection = new Baza();
    $connection->spojiDB();

    $username = $_GET["username"];
    
    $query = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = '{$username}'";
    
    $result = $connection->selectDB($query);
    
    $dbdata = array();
    
    while($row = mysqli_fetch_assoc($result)) {
        if($row) {
            $dbdata = $row;
        }
    }

    $connection->zatvoriDB();
    
    echo json_encode($dbdata);

}

?>