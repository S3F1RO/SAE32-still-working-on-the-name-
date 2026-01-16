<?php

  // Includes
  include_once('./utils.php');
  include_once('./params.php');
  include_once('./dataStorageWrapper.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data from client (ajax)
  $idUCreator = NULL;
  if (preg_match("/^[0-9]{1,20}$/", $_POST['idUCreator'])) $idUCreator = escape_string($_POST['idUCreator']);
  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $_POST['mainName'])) $mainName = escape_string($_POST['mainName']);
  $subName = "";
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $_POST['subName'])) $subName = escape_string($_POST['subName']);
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $_POST['domain'])) $domain = escape_string($_POST['domain']);
  $level = NULL;
  if (preg_match("/^[0-8]$/", $_POST['level'])) $level = escape_string($_POST['level']);
  $color = NULL;
  if (preg_match("/^.{1,20}$/", $_POST['color'])) $color = escape_string($_POST['color']);
  $skillInfosHashCryptPrivUC = NULL;
  if (preg_match("/^.+$/", $_POST['skillInfosHashCryptPrivUC'])) $skillInfosHashCryptPrivUC = escape_string($_POST['skillInfosHashCryptPrivUC']);
  $imgFile = $_FILES['file'];

  // Check
  if ($idUCreator == NULL || $mainName == NULL || $domain == NULL || $level == NULL || $color == NULL || $skillInfosHashCryptPrivUC == NULL || !isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail();
  }

  // ----- Send img to image WebService -----
  $data = sendAjaxImg($URL . "addImgSkill.php", [], ["file" => $imgFile]);
  $imgUrl = NULL;
  if (preg_match("/^.{1,200}$/", $data['imgPath'])) $imgUrl = $URL . escape_string($data['imgPath']);

  // Check
  if ($imgUrl == NULL) {
    fail();
  }

  // Add skill
  $idSkill = addVerifiedSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color, $skillInfosHashCryptPrivUC);

  // JSON send back
  if ($idSkill == NULL) fail();
  success(["idSkill" => $idSkill]);




























  // // Inclusions 
  // include_once('./utils.php');
  // include_once('./dataStorageWrapper.php');

  // // Allow JSON content
  // header("Content-Type: application/json; charset=UTF-8");

  // // Data ajax from server (filtered + escaped)
  // $data = json_decode(file_get_contents('php://input'), true);

  // $idUCreator = NULL;
  // if (preg_match("/^[0-9]{0,20}$/", $data['idUCreator'])) $idUCreator = escape_string($data['idUCreator']);
  // $mainName = NULL;
  // if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $data['mainName'])) $mainName = escape_string($data['mainName']);
  // $subName = "";
  // if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $data['subName'])) $subName = escape_string($data['subName']);
  // $domain = NULL;
  // if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $data['domain'])) $domain = escape_string($data['domain']);
  // $level = NULL;
  // if (preg_match("/^[0-9]+$/", $data['level'])) $level = escape_string($data['level']);
  // $imgUrl = "";
  // if (preg_match("/^.{0,100}$/", $data['imgUrl'])) $imgUrl = escape_string($data['imgUrl']);
  // $color = NULL;
  // if (preg_match("/^[A-Fa-f0-9]{6}$/", $data['color'])) $color = escape_string($data['color']);
  // $skillInfosHashCryptPrivUC = NULL;
  // if (preg_match("/^.+$/", $data['skillInfosHashCryptPrivUC'])) $skillInfosHashCryptPrivUC = $data['skillInfosHashCryptPrivUC'];

  // // Check
  // if ($idUCreator == NULL || $mainName == NULL || $domain == NULL || $level == NULL || $color == NULL || $skillInfosHashCryptPrivUC == NULL) {
  //   fail();
  // }

  // // add skill
  // $idSkill = addVerifiedSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color, $skillInfosHashCryptPrivUC);

  // // JSON send back
  // if ($idSkill == NULL) fail();
  // success(["idSkill" => $idSkill]);
  
?>