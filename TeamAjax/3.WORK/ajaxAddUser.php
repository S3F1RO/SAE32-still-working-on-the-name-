<?php
include_once('./utils.php');

// Vérifier si on a reçu des données
if (!isset($_POST['data'])) {
    echo json_encode([
        "success" => false,
        "message" => "Aucune donnée reçue"
    ]);
    exit();
}

// Décoder les données JSON envoyées
$data = json_decode($_POST['data'], true);

// Initialiser les variables
$firstName = NULL;
$lastName  = NULL;

if (isset($data['firstName'])) {
    $firstName = $data['firstName'];
}
if (isset($data['lastName'])) {
    $lastName = $data['lastName'];
}
if (isset($data['nickname'])) {
    $nickname = $data['nickname'];
}

// ==========================
//     FILTRE AVEC PREG_MATCH
// ==========================

// Autorisé : A-Z a-z 0-9 - (1 à 20 caractères)
// $regex = "/^[A-Za-z0-9\-]{1,20}$/";

// if (!preg_match($regex, $firstName) ||
//     !preg_match($regex, $lastName)  ||
//     !preg_match($regex, $nickname)) {

//     echo json_encode([
//         "success" => false,
//         "message" => "Format invalide : A-Z a-z 0-9 - (1 à 20 caractères)"
//     ]);
//     exit();
// }

// Réponse AJAX envoyée au JavaScript
$data = sendAjax("http://localhost/SAE32/workingTemplate/svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname]);

echo json_encode(["success" => true]);

?>
