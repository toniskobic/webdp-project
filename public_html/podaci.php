<?php
header("Content-Type: application/json");

require "./baza.class.php";
require "./sesija.class.php";

$connection = new Baza();
$connection->spojiDB();

$id = $_GET['submit'];

$query = "SELECT DISTINCT rodjendan.naziv, korisnik.ime, korisnik.prezime, rodjendan.broj_djece, rodjendan.datum, "
        ."rodjendan.vrijeme FROM rodjendan, grupa, korisnik WHERE rodjendan.grupa_id = {$id} AND rodjendan.korisnik_id = korisnik.korisnik_id'";

$result = $connection->selectDB($query);

$row = mysqli_fetch_all($result);

$json = json_encode($row);
if ($json === false) {
    $json = json_encode(["jsonError" => json_last_error_msg()]);
    if ($json === false) {
        $json = '{"jsonError":"unknown"}';
    }

    http_response_code(500);
}
echo $json;
?>