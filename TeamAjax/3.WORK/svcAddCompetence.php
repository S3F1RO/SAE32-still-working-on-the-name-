<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUTeacher = NULL;
  $idUTeacher = $db->real_escape_string($data['idUTeacher']);
  $idUStudent = NULL;
  $idUStudent = $db->real_escape_string($data['idUStudent']);
  $idSkill = NULL;
  $idSkill = $db->real_escape_string($data['idSkill']);
  $revokedDate = NULL;
  $revokedDate = $db->real_escape_string($data['revokedDate']);
  $masteryLevel = NULL;
  $masteringLevel = $db->real_escape_string($data['masteringLevel']);
  
  // Check
  if ($idUTeacher == NULL || $idUStudent == NULL || $idSkill == NULL || $masteringLevel == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $idCompetence = DataStorage::addCompetence($idUTeacher, $idUStudent, $idSkill, $revokedDate, $masteringLevel);
  
  // Exemple de traitement
  $response = [
    "id" => $idCompetence
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

