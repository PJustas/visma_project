<?php
echo 'Įveskite kliento vardą: ';
$name = null;
while (strlen(trim($name)) < 3) {
    $question;
    $name = fgets($question);
    if (strlen(trim($name)) < 3) {
        echo "Vardas turi būti sudarytas bent iš 3 simbolių ";
    }
}

echo "\n";
echo 'Įveskite kliento pavardę: ';
$surname = null;
while (strlen(trim($surname)) < 3) {
    $question;
    $surname = fgets($question);
    if (strlen(trim($surname)) < 3) {
        echo "Pavardė turi būti sudaryta bent iš 3 simbolių ";
    }
}

echo "\n";
echo 'Įveskite kliento el. paštą: ';
$emailValidation = false;
while ($emailValidation == false) {
    $question;
    $email = trim(fgets($question));
    $emailValidation = $clients->emailValidation($email);
    if ($emailValidation == false) {
        echo "Įveskite galiojantį el. paštą";
    }
}

echo "\n";
echo 'Įveskite kliento telefono nr. (1): +3706';
$phone1 = null;
while (strlen($phone1) != 7) {
    $question;
    $phone1 = intval(trim(fgets($question)));

    if (strlen($phone1) != 7) {
        echo 'Numerio formatas turi būti: +3706xxxxxxx';
    }
}

echo "\n";
echo 'Įveskite kliento telefono nr. (2): +3706';
$phone2 = null;
while (strlen($phone2) != 7) {
    $question;
    $phone2 = intval(trim(fgets($question)));
    if (strlen($phone2) != 7) {
        echo 'Numerio formatas turi būti: +3706xxxxxxx';
    }
}

echo "\n";
echo 'Komentaras: ';
$comment = null;
while (strlen(trim($comment)) < 1) {
    $question;
    $comment = fgets($question);
    if (strlen(trim($comment)) < 5) {
        echo "Komentaro laukas negali būti tuščias";
    }
}

$phone1 = "+3706" . $phone1;
$phone2 = "+3706" . $phone2;

$client = $clients->create($name, $surname, $email, $phone1, $phone2, $comment);
if ($client) {
    echo 'Naujas klientas sukurtas';
} else {
    echo 'Kliento nepavyko sukurti';
}
echo "\n";
include "index.php";
?>