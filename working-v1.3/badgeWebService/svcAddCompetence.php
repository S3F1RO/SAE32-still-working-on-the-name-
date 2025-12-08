<?php

  include_once('./utils.php');
  include_once('./dataStorage.php');

  // Autoriser le contenu JSON
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUTeacher = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUTeacher'])) $idUTeacher = escape_string($data['idUTeacher']);
  $idUStudent = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUStudent'])) $idUStudent = escape_string($data['idUStudent']);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = escape_string($data['idSkill']);
  $revokedDate = NULL;
  if (preg_match("/^[0-9\-]{10}$/", $data['revokedDate'])) $revokedDate = escape_string($data['revokedDate']);
  $masteringLevel = NULL;
  if (preg_match("/^[1-4]$/", $data['masteringLevel'])) $masteringLevel = escape_string($data['masteringLevel']);
  

  // Check
  if ($idUTeacher == NULL || $idUStudent == NULL || $idSkill == NULL || $masteringLevel == NULL) {
    echo json_encode(['id' => null]);
    exit;
  }

  $idCompetence = DataStorage::addCompetence($idUTeacher, $idUStudent, $idSkill, "$revokedDate", $masteringLevel);
  
  // Exemple de traitement
  $response = [
    "id" => $idCompetence
  ];
  
  // Renvoyer une réponse JSON
  success($response);
  
?>