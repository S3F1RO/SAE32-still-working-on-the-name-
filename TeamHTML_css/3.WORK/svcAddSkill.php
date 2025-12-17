<?php

  // Inclusions 
  include_once('./utils.php');
  include_once('./dataStorage.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  debug($data);

  // $idUCreator = NULL;
  // if (preg_match("/^[0-9]+$/", $data['idUCreator'])) $idUCreator = escape_string($data['idUCreator']);
  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $data['mainName'])) $mainName = escape_string($data['mainName']);
  $subName = "";
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $data['subName'])) $subName = escape_string($data['subName']);
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $data['domain'])) $domain = escape_string($data['domain']);
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $data['level'])) $level = escape_string($data['level']);
  $color = NULL;
  if (preg_match("/^[A-Fa-f0-9]{6}$/", $data['color'])) $color = escape_string($data['color']);
  $imgFile = NULL;
  if ($data['file']["file"]["error"] == UPLOAD_ERR_OK) $imgFile = $data['file'];

  // Check
  if ($mainName == NULL || $domain == NULL || $level == NULL || $color == NULL || $imgFile == NULL) {
    fail();
    exit;
  }
  
  // // ----- Send img to image WebService -----
  // $imgUrl = sendAjax($URL . "svcAddSkill.php", ["File" => $imgFile]);  
  // if (preg_match("/^.{0,100}$/", $imgUrl)) $imgUrl = escape_string($imgUrl);

  // // Check
  // if ($imgUrl == NULL) {
  //   echo json_encode([null]);
  //   exit;
  // }

  // TEST
  // Save file (À SUPPRIMER)
  $newFilename = generateRandomString($length=20);
  $success =  move_uploaded_file($imgFile["file"]["tmp_name"], "uploads/$newFilename.png");

  // // Add skill
  // $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);

  // // JSON send back
  // success(["idSkill" => $idSkill]);
  
?>