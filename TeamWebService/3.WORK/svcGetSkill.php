<?php
include_once('./utils.php');
include_once('dataStorage.php');

// DB open
  include_once("./cfgDbEscape.php");
  $db = new mysqli(DBESCAPE_HOST, DBESCAPE_LOGIN, DBESCAPE_PWD, DBESCAPE_NAME);
  $db->set_charset("utf8");

// Allow JSON content
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = $db->real_escape_string($data['idSkill']);
  
  // Check
  if ($idSkill == NULL) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit;
  }

  // DB close
  $db->close();
  
  $responce = DataStorage::getSkill($idSkill);
  
  // Send back a JSON response
  echo json_encode($responce);
  
  ?>

