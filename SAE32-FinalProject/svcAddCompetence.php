<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUTeacher = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUTeacher'])) $idUTeacher = $db->real_escape_string($data['idUTeacher']);
  $idUStudent = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUStudent'])) $idUStudent = $db->real_escape_string($data['idUStudent']);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = $db->real_escape_string($data['idSkill']);
  $revokedDate = NULL;
  if (preg_match("/^.{0,100}$/", $data['revokedDate'])) $revokedDate = $db->real_escape_string($data['revokedDate']);
  $masteryLevel = NULL;
  if (preg_match("/^[0-9]+$/", $data['masteryLevel'])) $masteryLevel = $db->real_escape_string($data['masteryLevel']);
  
  // Check
  if ($idUTeacher == NULL || $idUStudent == NULL || $idSkill == NULL || $masteryLevel == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $idCompetence = DataStorage::addCompetence($idUTeacher, $idUStudent, $idSkill, $revokedDate, $masteryLevel);
  
  // Exemple de traitement
  $response = [
    "id" => $idCompetence
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

