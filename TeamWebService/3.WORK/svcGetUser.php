<?php
include_once('./utils.php');
include_once('dataStorage.php');

// DB open
  include_once("./cfgDbTest.php");
  $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
  $db->set_charset("utf8");

// Allow JSON content
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUser = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUser'])) $idUser = $db->real_escape_string($data['idUser']);
  
  // Check
  if ($idUser == NULL) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit;
  }
  
  // DB close
  $db->close();
  
  $responce = DataStorage::getUser($idUser);
  
  // Send back a JSON response
  echo json_encode($responce);
  
  ?>

