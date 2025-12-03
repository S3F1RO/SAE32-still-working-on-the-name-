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
  $idUCreator = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUCreator'])) $idUCreator = $db->real_escape_string($data['idUCreator']);
  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9]{1,10}$/", $data['mainName'])) $mainName = $db->real_escape_string($data['mainName']);
  $subName = NULL;
  if (preg_match("/^[A-Za-z0-9]{1,10}$/", $data['subName'])) $subName = $db->real_escape_string($data['subName']);
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-]{1,15}$/", $data['domain'])) $domain = $db->real_escape_string($data['domain']);
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $data['level'])) $level = $db->real_escape_string($data['level']);
  $imgUrl = NULL;
  if (preg_match("/^.{0,100}$/", $data['imgUrl'])) $imgUrl = $db->real_escape_string($data['imgUrl']);
  $color = NULL;
  if (preg_match("/^[A-Fa-f0-9]{6}$/", $data['color'])) $color = $db->real_escape_string($data['color']);
  

  // Check
  if ($idUCreator == NULL || $mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL || $imgUrl == NULL || $color == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  // DB close
  $db->close();
  
  $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);
  
  // Exemple de traitement
  $response = [
    "id" => $idSkill
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

