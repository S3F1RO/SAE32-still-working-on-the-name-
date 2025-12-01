<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUTeacher = NULL;
  if (preg_match("/^.{0,100}$/", $data['idUTeacher'])) $idUTeacher = $db->real_escape_string($data['idUTeacher']);
  $idUStudent = NULL;
  if (preg_match("/^.{0,100}$/", $data['idUStudent'])) $idUStudent = $db->real_escape_string($data['idUStudent']);
  $idSkill = NULL;
  if (preg_match("/^.{0,100}$/", $data['idSkill'])) $idSkill = $db->real_escape_string($data['idSkill']);
  $currentDate = NULL;
  if (preg_match("/^.{0,100}$/", $data['currentDate'])) $currentDate = $db->real_escape_string($data['currentDate']);
  $revokedDate = NULL;
  if (preg_match("/^.{0,100}$/", $data['revokedDate'])) $revokedDate = $db->real_escape_string($data['revokedDate']);
  $masteryLevel = NULL;
  if (preg_match("/^.{0,100}$/", $data['masteryLevel'])) $masteryLevel = $db->real_escape_string($data['masteryLevel']);
  
  // Check
  if ($idUCreator == NULL || $mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL || $imgUrl == NULL || $color == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $idUser = DataStorage::addUser($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);
  
  // Exemple de traitement
  $response = [
    "id" => $idSkill
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

