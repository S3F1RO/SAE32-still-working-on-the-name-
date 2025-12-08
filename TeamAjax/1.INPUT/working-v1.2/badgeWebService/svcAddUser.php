<?php

  // Inclusions 
  include_once('./dataStorage.php');
  include_once("./utils.php");

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");
  
  // Data ajax from client (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  
  $firstName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàÀïÏÿŸ]{1,20}$/", $data['firstName'])) $firstName = escape_string($data['firstName']);
  $lastName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàÀïÏÿŸ ]{1,20}$/", $data['lastName'])) $lastName = escape_string($data['lastName']);
  $nickname = NULL;
  if (preg_match("/^[A-Za-z0-9\-éèêëÉÈÊËàÀïÏÿŸ ]{1,20}$/", $data['nickname'])) $nickname = escape_string($data['nickname']);

  // Check
  if ($firstName == NULL || $lastName == NULL || $nickname == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  // Insert user
  $idUser = DataStorage::addUser($firstName, $lastName, $nickname);
  
  // Send back a JSON response
  echo json_encode(["id" => $idUser]);
  exit;

?>