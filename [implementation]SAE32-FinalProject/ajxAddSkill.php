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

// Vérifier que toutes les données attendues existent
if (!isset($data["mainName"]) ||
    !isset($data["subName"])  ||
    !isset($data["domain"])   ||
    !isset($data["level"])    ||
    !isset($data["color"])) 
{
    echo json_encode([
        "success" => false,
        "message" => "Données manquantes"
    ]);
    exit();
}
// Récupération des valeurs en toute sécurité
$mainName   = $data["mainName"];
$subName    = $data["subName"];
$domain     = $data["domain"];
$level      = $data["level"];
$color      = $data["color"];


// ----- Envoi au WebService -----
$response = sendAjax(
    "http://localhost/SAE32/[implementation]SAE32-FinalProject/svcAddSkill.php",
    [
        "idUCreator" => 1,
        "mainName"   => $mainName,
        "subName"    => $subName,
        "domain"     => $domain,
        "level"      => $level,
        "color"      => $color,
    ]
);

// Debug : pour tester facilement
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
