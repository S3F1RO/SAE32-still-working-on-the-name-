<?php
include_once('./utils.php');
<<<<<<< HEAD
include_once('dataStorage.php');
=======
include_once('./dataStorage.php');
>>>>>>> 863dd281f6306f934580e35e229abd29694da766


// Autoriser le contenu JSON
header("Content-Type: application/json; charset=UTF-8");

// Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUCreator = NULL;
<<<<<<< HEAD
  if (preg_match("/^[0-9]+$/", $data['idUCreator'])) $idUCreator = $db->real_escape_string($data['idUCreator']);
  $mainName = NULL;
  if (preg_match("/^[\p{L}0-9 \-]{1,10}$/u", $data['mainName'])) $mainName = $db->real_escape_string($data['mainName']);
  $subName = NULL;
  if (preg_match("/^[\p{L}0-9 \-]{1,10}$/u", $data['subName'])) $subName = $db->real_escape_string($data['subName']);
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-]{1,15}$/", $data['domain'])) $domain = $db->real_escape_string($data['domain']);
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $data['level'])) $level = $db->real_escape_string($data['level']);
  $imgUrl = NULL;
  if (preg_match("/^.{0,100}$/", $data['imgUrl'])) $imgUrl = $db->real_escape_string($data['imgUrl']);
=======
  if (preg_match("/^.*{1,10}/", $data['idUCreator'])) $idUCreator = $db->real_escape_string($data['idUCreator']);
  $mainName = NULL;
  if (preg_match("/^.*{1,10}$/u", $data['mainName'])) $mainName = $db->real_escape_string($data['mainName']);
  $subName = NULL;
  if (preg_match("/^.*{1,10}$/u", $data['subName'])) $subName = $db->real_escape_string($data['subName']);
  $domain = NULL;
  if (preg_match("/^.*{1,10}$/", $data['domain'])) $domain = $db->real_escape_string($data['domain']);
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $data['level'])) $level = $db->real_escape_string($data['level']);
  $imgUrl = NULL;
  if (preg_match("/^.*{0,100}$/", $data['imgUrl'])) $imgUrl = $db->real_escape_string($data['imgUrl']);
>>>>>>> 863dd281f6306f934580e35e229abd29694da766
  $color = NULL;
  if (preg_match("/^#[A-Fa-f0-9]{6}$/", $data['color'])) $color = $db->real_escape_string($data['color']);
  

  // Check
  if ($idUCreator == NULL || $mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL || $imgUrl == NULL || $color == NULL) {
    echo json_encode([null]);
    exit;
  }
  
<<<<<<< HEAD
  
=======
>>>>>>> 863dd281f6306f934580e35e229abd29694da766
  $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);
  
  // Exemple de traitement
  $response = [
    "id" => $idSkill
  ];
  
  // Renvoyer une réponse JSON
  echo json_encode($response);
  
  ?>

