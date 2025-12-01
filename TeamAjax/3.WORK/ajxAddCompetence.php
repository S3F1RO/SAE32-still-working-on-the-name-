<?php
include_once('./utils.php');

// Vérifier si on a bien reçu les données JSON
if (!isset($_POST['data'])) {
  echo json_encode([
    "success" => false,
    "message" => "Aucune donnée reçue"
  ]);
  exit();
}

// Décoder JSON
$data = json_decode($_POST['data'], true);

// Récupération des champs
$currentDate    = $data["currentDate"]    ?? "";
$revokedDate    = $data["revokedDate"]    ?? "";
$masteryLevel = $data["masteringLevel"] ?? "";

// Appel vers le webservice serveur
$response = sendAjax(
  "http://localhost/SAE32/TeamAjax/3.WORK/svcAddCompetence.php",
  [
    "currentDate"    => $currentDate,
    "revokedDate"    => $revokedDate,
    "masteryLevel" => $masteryLevel
  ]
);

// renvoyer au JS
echo json_encode($response);
?>
