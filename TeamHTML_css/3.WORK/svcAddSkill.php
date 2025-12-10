<?php

  include_once('./utils.php');
  include_once('./dataStorage.php');



  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $idUCreator = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUCreator'])) $idUCreator = escape_string($data['idUCreator']);
  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-éèêëÉÈÊËïÏàÀçÇ&\' ]{1,20}$/", $data['mainName'])) $mainName = escape_string($data['mainName']);
  $subName = "";
  if (preg_match("/^[A-Za-z0-9\-éèêëïàç&\' ]{1,20}$/", $data['subName'])) $subName = escape_string($data['subName']);
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-éèêëïàç&\' ]{1,20}$/", $data['domain'])) $domain = escape_string($data['domain']);
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $data['level'])) $level = escape_string($data['level']);
  $imgUrl = "";
  if (preg_match("/^.{0,100}$/", $data['imgUrl'])) $imgUrl = escape_string($data['imgUrl']);
  $color = NULL;
  if (preg_match("/^[A-Fa-f0-9]{6}$/", $data['color'])) $color = escape_string($data['color']);


  // Check
  if ($idUCreator == NULL || $mainName == NULL || $domain == NULL || $level == NULL || $color == NULL) {
    echo json_encode([null]);
    exit;
  }

  $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);

  // Renvoyer une réponse JSON
  // echo json_encode(["Hello"=>"Hiiii"]);
  echo json_encode(["id" => $idSkill]);

  
?>