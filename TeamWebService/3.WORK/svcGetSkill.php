<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = $db->real_escape_string($data['idSkill']);
  
  // Check
  if ($idSkill == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $responce = DataStorage::getSkill($idSkill);
  
  // Renvoyer une réponse JSON
  echo json_encode($responce);
  
  ?>

