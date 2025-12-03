<?php
include_once('./utils.php');
include_once('dataStorage.php');

// DB open
  include_once("./cfgDb.php");
  $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
  $db->set_charset("utf8");

// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idCompetence = NULL;
  if (preg_match("/^[0-9]+$/", $data['idCompetence'])) $idCompetence = $db->real_escape_string($data['idCompetence']);
  
  // Check
  if ($idCompetence == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  // DB close
  $db->close();
  
  $responce = DataStorage::getUser($idCompetence);
  
  // Renvoyer une réponse JSON
  echo json_encode($responce);
  
  ?>

