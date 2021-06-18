<?php

require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

if(isset($_GET['time'])) {
    if((time() - $_GET['time']) < 50400) {
        $connection = new Baza();
        $connection->spojiDB();

        $username = $_GET['username'];
        $password = $_GET['password'];

        $query = "SELECT * FROM korisnik WHERE korisnicko_ime = '{$username}' AND lozinka_sha256 = '{$password}'";
        
        $result = $connection->selectDB($query);
        
        if($row = mysqli_fetch_array($result)) {
            if($row) {
                $id = $row["korisnik_id"];
                $role = $row['uloga_id'];

                $query = "UPDATE korisnik SET aktivan = 1 WHERE korisnicko_ime = '{$username}'";
                $result = $connection->updateDB($query);
                
                Sesija::kreirajKorisnika($username, $role, $id);
            }
        }
    }
}

header("Location: ./index.php");

?>