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
// Réponse AJAX envoyée au JavaScript
$data = sendAjax("http://localhost/SAE32/workingTemplate/svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname]);
echo json_encode(["success" => true, "id" => $data["id"]]);

?>
