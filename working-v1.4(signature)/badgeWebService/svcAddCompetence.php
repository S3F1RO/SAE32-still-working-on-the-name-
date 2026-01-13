<?php

  // Inclusions 
  include_once('./utils.php');
  include_once('./dataStorage.php');
  include_once('./dataStorageWrapper.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from client (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  
  $idUTeacher = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUTeacher'])) $idUTeacher = escape_string($data['idUTeacher']);
  $idUStudent = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUStudent'])) $idUStudent = escape_string($data['idUStudent']);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = escape_string($data['idSkill']);
  $beginDate = NULL;
  if (preg_match("/^[0-9\:\- ]{19}$/", $data['beginDate'])) $beginDate = escape_string($data['beginDate']);
  $revokedDate = "";
  if (preg_match("/^[0-9\:\- ]{19}$/", $data['revokedDate'])) $revokedDate = escape_string($data['revokedDate']);
  $masteringLevel = NULL;
  if (preg_match("/^[1-4]$/", $data['masteringLevel'])) $masteringLevel = escape_string($data['masteringLevel']);
  $competenceInfosHashCryptPrivUT = NULL;
  if (preg_match("/^.+$/", $data['competenceInfosHashCryptPrivUT'])) $competenceInfosHashCryptPrivUT = escape_string($data['competenceInfosHashCryptPrivUT']);
  
  // Check
  if ($idUTeacher == NULL || $idUStudent == NULL || $idSkill == NULL || $beginDate == NULL || $masteringLevel == NULL || $competenceInfosHashCryptPrivUT == NULL) {
    fail();
  }
  // add competence
  $idCompetence = addVerifiedCompetence($idUTeacher, $idUStudent, $idSkill, $beginDate, "$revokedDate", $masteringLevel, $competenceInfosHashCryptPrivUT);
  
  // JSON send back
  if ($idCompetence == NULL) fail();
  success(["idCompetence" => $idCompetence]);
  
?>