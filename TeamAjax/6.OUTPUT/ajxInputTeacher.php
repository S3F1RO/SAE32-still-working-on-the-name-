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
if (isset($data["idTeacher"])) {
    $idTeacher= $data["idTeacher"];
}

// Vérif
if ($idTeacher=== null|| $idTeacher==='') {
    echo json_encode([
        "success" => false,
        "message" => "ID compétence manquant"
    ]);
    exit();
}

// redirec
echo json_encode([
    "success" => true,
    "url" => "getCompetence.php?idTeacher=" . $idTeacher
]);

