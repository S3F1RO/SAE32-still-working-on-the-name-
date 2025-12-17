<?php
  // Includes
  include_once('./utils.php');
  include_once('./params.php');
  include_once('./dataStorage.php');

  // Default error message
  $html = "Information(s) invalide(s) ou manquante(s)";

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data from client (ajax)
  $idUCreator = NULL;
  if (preg_match("/^[0-9]+$/", $_POST['idUCreator'])) $idUCreator = escape_string($_POST['idUCreator']);
   $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $_POST['mainName'])) $mainName =$_POST['mainName'];
  $subName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $_POST['subName'])) $subName = $_POST['subName'];
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $_POST['domain'])) $domain = $_POST['domain'];
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $_POST['level'])) $level = $_POST['level'];
  $color = NULL;
  if (preg_match("/^.{0,20}$/", $_POST['color'])) $color = $_POST['color'];
  $imgFile = $_FILES['file'];

  // Check
  if ($idUCreator == NULL || $mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL || $color == NULL || !isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail($html);
    exit();
  } 
  
  // ----- Send img to image WebService -----
  $data = sendAjaxImg($URL . "svcImgAddSkill.php", [], ["file" => $imgFile]);  
  $imgUrl = $URL;
  if (preg_match("/^.{0,100}$/", $data['imgPath'])) $imgUrl .= escape_string($data['imgPath']);

  // Check
  if ($imgUrl == NULL) {
    fail($html);
    exit;
  }

  // Add skill
  $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);

  // JSON send back
  echo json_encode(["idSkill" => $idSkill]);
  
?>