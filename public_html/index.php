<?php
require "./baza.class.php";
require "./sesija.class.php";

Sesija::kreirajSesiju();

$text = getTableData();

function getTableData()
{
    $connection = new Baza();
    $connection->spojiDB();

    $query = "SELECT grupa.grupa_id, grupa.naziv, COUNT(rodjendan.rodjendan_id) FROM grupa, rodjendan WHERE grupa.grupa_id = rodjendan.grupa_id AND rodjendan.status_id = 2 GROUP BY 1";

    $result = $connection->selectDB($query);
    $data = '';

    $a = 0;
    while ($row = mysqli_fetch_array($result)) {
        $groupId = $row['grupa_id'];
        $groupName = $row['naziv'];
        $count = $row["COUNT(rodjendan.rodjendan_id)"];

        $data .= "<tr><td>$groupName</td><td>$count</td>"
            . "<td><form novalidate method=\"get\" target=\"_blank\" action=\"./rss.php\"><button type=\"submit\" name=\"id\" class=\"unstyled-button\" value=\"$groupId\">RSS</button></form></td></tr>\n";

        $a++;
    }

    $connection->zatvoriDB();
    return $data;
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Rođendani - početna</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Početna stranica" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="11.06.2021. Početna stranica web stranice, ključne riječi: početna, rođendan" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="alternate stylesheet" href="./css/main_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Rođendani</a>
        <?php
        include './menu.php';
        ?>

    </header>
    <main id="content">
        <section aria-label="statistics" class="box box-scrollable centered center-content">
            <table class="table">
                <thead class="table__head table__head--dark">
                    <tr>
                        <th>Naziv grupe</th>
                        <th>Broj rođendana</th>
                        <th>RSS</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <?php
                    echo $text;
                    ?>
                </tbody>
            </table>
        </section>
        <div class="box box-scrollable centered center-content m-t-md rowdata"></div>
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