<?php
$clientData = false;
while ($clientData == false) {
    $question = fopen("php://stdin", "r");
    $answer = intval(fgets($question));

    $clientData = $clients->getClientData($answer);
    if ($clientData == false) {
        echo 'Toks kliento id nerastas';
    }
}

$id = $answer;

echo 'Įveskite (1), jeigu norite redaguoti kliento duomenis';
echo "\n";
echo 'Įveskite (2), jeigu norite ištrinti klientą iš duombazės';

$question = fopen("php://stdin", "r");
$answer = intval(fgets($question));

if (trim($answer) == 2) {
    if ($clients->delete($id)) {
        echo 'Klientas ištrintas';
    } else {
        echo 'Kliento nepavyko ištrinti';
    }
} elseif (trim($answer) == 1) {
    foreach ($clientData as $item) {
        echo 'Įveskite naują kliento vardą. Dabartinis: ' . $item['name'];
        $name = null;
        while (strlen(trim($name)) < 3) {
            $question = fopen("php://stdin", "r");
            $name = fgets($question);

            if (strlen(trim($name)) < 3) {
                echo "Vardas turi būti sudarytas bent iš 3 simbolių ";
            }
        }

        echo "\n";
        echo 'Įveskite kliento pavardę. Dabartinis: ' . $item['surname'];
        $surname = null;
        while (strlen(trim($surname)) < 3) {
            $question;
            $surname = fgets($question);
            if (strlen(trim($surname)) < 3) {
                echo "Pavardė turi būti sudaryta bent iš 3 simbolių ";
            }
        }

        echo "\n";
        echo 'Įveskite kliento el. paštą. Dabartinis: ' . $item['email'];
        $emailValidation = null;
        while ($emailValidation == false) {
            $question;
            $email = trim(fgets($question));
            $emailValidation = $clients->emailValidation($email);
            if ($emailValidation == false) {
                echo "Įveskite galiojantį el. paštą";
            }
        }

        echo "\n";
        echo 'Įveskite kliento telefono numerį (1). Dabartinis: ' . $item['phone1'];
        echo "\n";
        echo '+3706';

        $phone1 = null;
        while (strlen($phone1) != 7) {
            $question;
            $phone1 = trim(fgets($question));

            if (strlen($phone1) != 7) {
                echo 'Numerio formatas turi būti: +3706xxxxxxx';
            }
        }

        echo "\n";
        echo 'Įveskite kliento telefono numerį (2). Dabartinis: ' . $item['phone2'];
        echo "\n";
        echo '+3706';
        $phone2 = null;
        while (strlen($phone2) != 7) {
            $question;
            $phone2 = trim(fgets($question));

            if (strlen($phone2) != 7) {
                echo 'Numerio formatas turi būti: +3706xxxxxxx';
            }
        }

        echo "\n";
        echo 'Komentaras. Dabartinis: ' . $item['comment'];
        $comment = null;
        while (strlen(trim($comment)) < 1) {
            $question;
            $comment = fgets($question);

            if (strlen(trim($comment)) < 1) {
                echo "Komentaro laukas negali būti tuščias";
            }
        }

    }

    $phone1 = "+3706" . $phone1;
    $phone2 = "+3706" . $phone2;
    if ($clients->update($id, $name, $surname, $email, $phone1, $phone2, $comment)) {
        echo 'Kliento duomenys atnaujinti';
    } else {
        echo 'Kliento duomenų nepavyko atnaujinti';
    }
}
echo "\n";
include "index.php";
?>