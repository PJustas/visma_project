<?php
require_once ('database.php');
require_once ('clients.php'); // clients class

$clients = new Clients(); // createing new clients object

echo "Klientų registracijos forma";
echo "\n";

echo "norėdami sukurti naują klientą - įveskite 1";
echo "\n";
echo 'Norėdami gauti esamų klientų sąrašą - įveskite 2';
echo "\n";
echo 'Norėdami eksportuoti duomenis - įveskite e ';
echo "\n";
echo 'Norėdami baigti darbą  - įveskite bet kokį kitą simbolį';
echo "\n";

$exit = false;
while ($exit == false) {
    $question = fopen("php://stdin", "r");
    $answer = fgets($question);

    if (trim($answer) == 1) {
        require_once ('create_table.php'); // createing client table if not exist
        require_once ('registration.php'); // includeing registration form
        echo "\n";
    } elseif (trim($answer) == 2) {

        $clientList = $clients->getClientList();

        if ($clientList == false) {
            echo 'Duomenų nėra';
            echo "\n";
            include "index.php";
        } else {
            echo 'Klientų sąrašas';
            echo "\n";
            foreach ($clientList as $item) {
                echo 'Id: ' . $item['ID'] . ', vardas pavardė: ' . $item['name'] . ' ' . $item['surname'];
                echo "\n";
            }
            echo 'Norėdami redaguoti kliento duomenis - įveskite jo id';
            require_once ('update.php'); // includeing client update form
        }
    } elseif (trim($answer) == "e") {
        $clients->exportData();
        echo 'Failas data.csv buvo sukurtas';
    } else {
        $exit = true;
    }

}

echo 'Klientų registravimo sistema uždaryta';
exit();
?>