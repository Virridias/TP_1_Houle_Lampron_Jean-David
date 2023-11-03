<?php
// Fonction pour valider un mot de passe
function validerPWD($PWD)
{
    // Vérifier la longueur du mot de passe min6 max 10
    $length = strlen($PWD);
    $responses = [
        'isValid' => true,
        'msg' => ''
    ];
    if ($length < 6) {
        $responses = [
            'isValid' => false,
            'msg' => 'Votre mots de passe est trop petit',
        ];
    } elseif ($length > 10) {
        $responses = [
            'isValid' => false,
            'msg' => 'Votre mots de passe est trop long'
        ];
    }
    return $responses;
}
function addSalt($PWD)
{
    $salt = "wantSomeSalt123!@#";

    // Concaténer le "salt" au mot de passe
    $PWDAvecSalt = $salt . $PWD . $salt;

    return $PWDAvecSalt;
}
function criptedPWD($saltedPWD)
{
    $criptedPWD = password_hash($saltedPWD, PASSWORD_DEFAULT);

    return $criptedPWD;
}

echo "</>";
$saltedPWD = addSalt($_POST['PWD']);
var_dump($saltedPWD);


echo "</br>";
$criptedPWD = criptedPWD($saltedPWD);
var_dump($criptedPWD);

if (isset($_POST['PWD'])) {
    $PWD = $_POST['PWD'];

    if (empty($PWD)) {
        // Le mot de passe est valide
        echo "</br>Le Mots de pass est vide";
    } else {
        $resultat = validerPWD($PWD);
        if ($resultat['isValid']) {
            echo "</br>Votre mots de pass est : " . $PWD;
        } else {
            echo "</br>" . $resultat['error'];
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Validation du mot de passe</title>
</head>

<body>
    <form method="post" name="fname">
        <label for="PWD">Mot de passe :</label>
        <input type="password" id="PWD1" name="PWD" required>
        <input type="submit" value="Valider">
    </form>
</body>

</html>