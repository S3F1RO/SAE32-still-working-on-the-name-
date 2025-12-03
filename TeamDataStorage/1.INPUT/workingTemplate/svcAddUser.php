<?php
include_once('./utils.php');
include_once('dataStorage.php');

// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Lire la requête JSON envoyée par le client
$input = file_get_contents("php://input");
$data = json_decode($input, true);

$firstName=$data["firstName"];
$lastName=$data["lastName"];
$nickname=$data["nickname"];

$idUser=DataStorage::addUser($firstName, $lastName, $nickname);


// Vérification d'erreur
if ($data == null) {
  echo json_encode([
    null
  ]);
  exit;
};


// Exemple de traitement
$response = [
  "id" => $idUser
];

// Renvoyer une réponse JSON
echo json_encode($response);

?>