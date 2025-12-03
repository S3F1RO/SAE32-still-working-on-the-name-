<?php
include_once('./utils.php');
include_once('dataStorage.php');

// DB open
  include_once("./cfgDbTest.php");
  $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
  $db->set_charset("utf8");

// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $firstName = NULL;
  if (preg_match("/^[A-Za-z0-9\-]{1,20}$/", $data['firstName'])) $firstName = $db->real_escape_string($data['firstName']);
  $lastName = NULL;
  if (preg_match("/^[A-Za-z0-9\-]{1,20}$/", $data['lastName'])) $lastName = $db->real_escape_string($data['lastName']);
  $nickname = NULL;
  if (preg_match("/^[A-Za-z0-9\-]{1,20}$/", $data['nickname'])) $nickname = $db->real_escape_string($data['nickname']);

  // Check
  if ($firstName == NULL || $lastName == NULL || $nickname == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  // DB close
  $db->close();
  
  $idUser = DataStorage::addUser($firstName, $lastName, $nickname);
  
  // Exemple de traitement
  $response = [
    "id" => $idUser
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

