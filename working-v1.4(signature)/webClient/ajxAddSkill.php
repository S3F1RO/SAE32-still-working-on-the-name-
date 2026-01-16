<?php

  include_once('./utils.php');
  include_once('./params.php');

  $html = "Information(s) invalide(s) ou manquante(s)";

  // Data from session
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];
  if (isset($_SESSION['privU'])) $privUC = $_SESSION['privU'];

  // Check
  if ($idUser == NULL || $privUC == NULL) {
    fail($html);
  }

  // File from client (ajax)
  $clientFilename = NULL;
  if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
    $clientFilename = $_FILES["file"]["name"];
  } else {
    fail("Aucun fichier");
  }

  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $_POST['mainName'])) $mainName = $_POST['mainName'];
  $subName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $_POST['subName'])) $subName = $_POST['subName'];
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $_POST['domain'])) $domain = $_POST['domain'];
  $level = NULL;
  if (preg_match("/^[0-8]$/", $_POST['level'])) $level = $_POST['level'];
  $color = NULL;
  if (preg_match("/^[A-Fa-f0-9]{6}$/", $_POST['color'])) $color = $_POST['color'];
  $imgFile = $_FILES['file'];

  // Check
  if ($mainName == NULL || $domain == NULL || $level == NULL || $color == NULL || !isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail($html);
  }
  
  // Signature
  $signatureData = $idUser . $mainName . $subName . $domain . $level . $color;
  openssl_sign($signatureData, $skillInfosHashCryptPrivUC, $privUC, OPENSSL_ALGO_SHA256);
  $skillInfosHashCryptPrivUC = base64_encode($skillInfosHashCryptPrivUC);

  // ----- Send to WebService -----
  $data = sendAjaxImg(
      $URL . "svcAddSkill.php",
      [
          "idUCreator" => $idUser,
          "mainName" => $mainName,
          "subName"  => $subName,
          "domain"   => $domain,
          "level"    => $level,
          "color"    => $color,
          "skillInfosHashCryptPrivUC" => $skillInfosHashCryptPrivUC
      ],
      ["file" => $_FILES["file"],]
  );

  // Check response
  if (!$data["success"]) {
    fail($html);
  } else {
    // Client response
    success(["idSkill" => $data["idSkill"]]);
  }

?>
