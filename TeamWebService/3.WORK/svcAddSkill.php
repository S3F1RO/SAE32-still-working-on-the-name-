<?php
  // Includes
  include_once('./utils.php');
  include_once('./dataStorage.php');
  include_once('./params')

  // Default error message
  $html = "Information(s) invalide(s) ou manquante(s)";

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // $idUCreator = NULL;
  // if (preg_match("/^[0-9]+$/", $data['idUCreator'])) $idUCreator = escape_string($data['idUCreator']);
  // Data from client (ajax)
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
  if ($mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL || $color == NULL || !isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail($html);
    exit();
  } 
  
  // ----- Send img to image WebService -----
  $imgUrl = sendAjax($URL . "svcAddSkill.php", ["File" => $imgFile]);  
  if (preg_match("/^.{0,100}$/", $imgUrl)) $imgUrl = escape_string($imgUrl);

  // // Check
  // if ($imgUrl == NULL) {
  //   echo json_encode([null]);
  //   exit;
  // }

  // TEST
  // $test = json_encode($imgFile);
  // file_put_contents("./uploads/file2.txt", $imgFile["file"]["tmp_name"], LOCK_EX);

  // TEST
  // Save file (À SUPPRIMER)
  $newFilename = generateRandomString($length=20);
  // $success =  move_uploaded_file($imgFile["file"]["tmp_name"], "uploads/DD$mainName.png");
  $success =  move_uploaded_file($imgFile["tmp_name"], "uploads/aaa$newFilename.png");

  // // Add skill
  // $idSkill = DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color);

  // JSON send back
  echo json_encode(["message" => "image reçu"]);
  
?>