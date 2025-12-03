<?php
include_once('./utils.php');

// Vérifier si les données arrivent bien
if (!isset($_POST['data'])) {
    echo json_encode([
        "success" => false,
        "message" => "Aucune donnée reçue"
    ]);
    exit();
}

// Décoder les données envoyées par le JS
$data = json_decode($_POST['data'], true);

// Vérifier que les données attendues existent
if (!isset($data["idUTeacher"])   ||
    !isset($data["idUStudent"])   ||
    !isset($data["idSkill"])      ||
    !isset($data["currentDate"])  ||
    !isset($data["masteringLevel"])) 
{
    echo json_encode([
        "success" => false,
        "message" => "Données manquantes"
    ]);
    exit();
}

// Récupération des valeurs en toute sécurité
$idUTeacher     = $data["idUTeacher"];
$idUStudent     = $data["idUStudent"];
$idSkill        = $data["idSkill"];
$currentDate    = $data["currentDate"];
$revokedDate    = $data["revokedDate"] ;
$masteringLevel = $data["masteringLevel"]; // ⚠ bien "masteringLevel"

// ----- Envoi au WebService -----
$response = sendAjax(
    "http://localhost/SAE32/TeamAjax/3.WORK/svcAddCompetence.php",
    [
        "idUTeacher"     => $idUTeacher,
        "idUStudent"     => $idUStudent,
        "idSkill"        => $idSkill,
        "currentDate"    => $currentDate,
        "revokedDate"    => $revokedDate,
        "masteringLevel" => $masteringLevel,
    ]
);

// Debug si besoin :
// echo json_encode(["debug" => $response]);
// exit();

// Vérifier la réponse du serveur
if (!isset($response["id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Réponse serveur invalide",
        "serverResponse" => $response
    ]);
    exit();
}

// Réponse finale pour le JS
echo json_encode([
    "success" => true,
    "id"      => $response["id"]
]);
exit();
?>
