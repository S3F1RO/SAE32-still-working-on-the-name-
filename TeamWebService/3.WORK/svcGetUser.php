<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUser = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUser'])) $idUser = $db->real_escape_string($data['idUser']);
  
  // Check
  if ($idUser == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $responce = DataStorage::getUser($idUser);
  
  // Renvoyer une réponse JSON
  echo json_encode($responce);
  
  ?>

