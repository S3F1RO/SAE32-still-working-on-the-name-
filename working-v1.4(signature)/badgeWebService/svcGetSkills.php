<?php

  include_once('./utils.php');
  include_once('dataStorageWrapper.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idSkill = NULL;
  if (preg_match("/^[0-9]{1,20}$/", $data['idSkill'])) $idSkill = escape_string($data['idSkill']);
  $idCreator = NULL;
  if (preg_match("/^[0-9]{1,20}$/", $data['idCreator'])) $idCreator = escape_string($data['idCreator']);

  // Check
  if ($idSkill == NULL && $idCreator == NULL) {
    fail();
  }

  if ($idSkill != NULL) $skills = getVerifiedSkill($idSkill);
  elseif ($idCreator != NULL) $skills = getCreatorVerifiedSkills($idCreator);

  // Send back a JSON response
  if ($skills == []) fail();
  success(["skills" => $skills]);

?>