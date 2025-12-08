<?php

  include_once('./utils.php');
  include_once('./params.php');

  $html = "Information(s) invalide(s) ou manquante(s)";

  // Data from session
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];

  // Check
  if ($idUser == NULL) {
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

  // ----- Send to WebService -----
  $data = sendAjax($URL . "svcAddSkill.php", ["idUCreator"=>$idUser, "mainName"=>$mainName, "subName"=>$subName, "domain"=>$domain, "level"=>$level, "color"=>$color]);

  // Check response
  if (!isset($data["idSkill"])) {
    fail($html);
  }

  // Client response
  success(["idSkill" => $data["idSkill"]]);

?>