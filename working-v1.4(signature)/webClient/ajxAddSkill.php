<?php

  include_once('./utils.php');
  include_once('./params.php');

  $html = "Information(s) invalide(s) ou manquante(s)";

  // Data from session
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];
  if (isset($_SESSION['privU'])) $privU = $_SESSION['privU'];

  // Check
  if ($idUser == NULL || $privU == NULL) {
    fail($html);
  }

  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $data['mainName'])) $mainName = $data['mainName'];
  $subName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $data['subName'])) $subName = $data['subName'];
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\' ]{1,20}$/", $data['domain'])) $domain = $data['domain'];
  $level = NULL;
  if (preg_match("/^[0-9]+$/", $data['level'])) $level = $data['level'];
  $color = NULL;
  if (preg_match("/^[A-Fa-f0-9]{6}$/", $data['color'])) $color = $data['color'];

  // Check
  if ($mainName == NULL || $domain == NULL || $level == NULL || $color == NULL) {
    fail($html);
  }

  // Signature
  $privUC = base64_decode($privU);
  $signatureData = $idUser . $mainName . $subName . $domain . $level . $color;
  openssl_sign($signatureData, $skillInfosHashCryptPrivUC, $privUC, OPENSSL_ALGO_SHA256);
  $skillInfosHashCryptPrivUC = base64_encode($skillInfosHashCryptPrivUC);

  // ----- Send to WebService -----
  $data = sendAjax($URL . "svcAddSkill.php", ["idUCreator"=>$idUser, "mainName"=>$mainName, "subName"=>$subName, "domain"=>$domain, "level"=>$level, "color"=>$color, "skillInfosHashCryptPrivUC"=>$skillInfosHashCryptPrivUC]);

  // Check response
  if (!$data["success"]) {
    fail($html);
    // fail($data['html']);
  } else {
    // Client response
    success(["idSkill" => $data["idSkill"]]);
  }

?>
