<?php
include_once('./utils.php');

// Vérifier réception
if (!isset($_POST['data'])) {
    echo json_encode([
        "success" => false,
        "message" => "Aucune donnée reçue"
    ]);
    exit();
}

$data = json_decode($_POST['data'], true);
/////////////////////////////////
if (isset($data["idStudent"])) {
    $idStudent= $data["idStudent"];
}

// Vérif
if ($idStudent=== null|| $idStudent==='') {
    echo json_encode([
        "success" => false,
        "message" => "ID student manquant"
    ]);
    exit();
}

// redirec
echo json_encode([
    "success" => true,
    "url" => "getCompetences.php?idS=" . $idStudent
]);

