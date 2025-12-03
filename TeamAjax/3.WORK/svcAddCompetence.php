<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");
include_once("./cfgDbEscape.php");
$db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
$db->set_charset("utf8");
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
  $masteringLevel = NULL;
  $masteringLevel = $db->real_escape_string($data['masteringLevel']);
  
  // Check
  if ($idUTeacher == NULL || $idUStudent == NULL || $idSkill == NULL || $masteringLevel == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $idCompetence = DataStorage::addCompetence($idUTeacher, $idUStudent, $idSkill, $revokedDate, $masteringLevel);
  
  // Exemple de traitement
  $response = [
    "id" => $idUTeacher
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

