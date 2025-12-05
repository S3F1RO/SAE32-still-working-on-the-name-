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
    !isset($data["color"])   ||
    !isset($data["idUCreator"]))
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
$idUCreator = $data["idUCreator"];


// // FILTREEEEE



// if (!preg_match("/^[0-9]+$/", $idUCreator)) {
//     echo json_encode(["success" => false, "message" => "idUCreator invalide"]);
//     exit();
// }

// if (!preg_match("/^[A-Za-z0-9]{1,10}$/", $mainName)) {
//     echo json_encode(["success" => false, "message" => "mainName invalide"]);
//     exit();
// }

// if (!preg_match("/^[A-Za-z0-9]{1,10}$/", $subName)) {
//     echo json_encode(["success" => false, "message" => "subName invalide"]);
//     exit();
// }

// if (!preg_match("/^[A-Za-z0-9\-]{1,15}$/", $domain)) {
//     echo json_encode(["success" => false, "message" => "domain invalide"]);
//     exit();
// }

// if (!preg_match("/^[0-9]+$/", $level)) {
//     echo json_encode(["success" => false, "message" => "level invalide"]);
//     exit();
// }

// // if (!preg_match("/^.{0,100}$/", $imgUrl)) {
// //     echo json_encode(["success" => false, "message" => "imgUrl invalide"]);
// //     exit();
// // }

// if (!preg_match("/^[A-Fa-f0-9]{6}$/", $color)) {
//     echo json_encode(["success" => false, "message" => "color invalide"]);
//     exit();
// }




// ----- Envoi au WebService -----
$response = sendAjax(
    "http://localhost/SAE32/TeamAjax/3.WORK/svcAddSkill.php",
    [
        "idUCreator" => $idUCreator,
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
