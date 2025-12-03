<?php
include_once('./utils.php');
include_once('dataStorage.php');


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");
include_once("./cfgDbEscape.php");
$db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
$db->set_charset("utf8");
// Data ajax from server (filtered + escaped)
$data = json_decode(file_get_contents('php://input'), true);

$idUCreator = $db->real_escape_string($data['idUCreator']);
$mainName = NULL;
$mainName = $db->real_escape_string($data['mainName']);
$subName = NULL;
$subName = $db->real_escape_string($data['subName']);
$domain = NULL;
$domain = $db->real_escape_string($data['domain']);
$level = NULL;
$level = $db->real_escape_string($data['level']);
$color = NULL;
$color = $db->real_escape_string($data['color']);


  //Check
  if ($idUCreator == NULL || $mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL  || $color == NULL) {
    echo json_encode([null]);
    exit;
  }
  
  
  $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $color);
  
  // Exemple de traitement
  $response = [
    "id" => $idSkill
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

