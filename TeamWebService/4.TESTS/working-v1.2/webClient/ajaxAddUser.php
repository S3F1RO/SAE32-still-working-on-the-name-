<?php

  include_once('./utils.php');
  include_once('./params.php');


  $html = "Prénom, nom ou pseudo invalide";

  // Check
  if (!isset($_POST['data'])) {
    fail($html);
  }

  // JSON decode
  $data = json_decode($_POST['data'], true);


  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $firstName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ]{1,20}$/", $data['firstName'])) $firstName = $data['firstName'];
  $lastName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ ]{1,20}$/", $data['lastName'])) $lastName = $data['lastName'];
  $nickname = NULL;
  if (preg_match("/^[A-Za-z0-9\-\'\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ& ]{1,20}$/", $data['nickname'])) $nickname = $data['nickname'];

  // Check
  if ($lastName == NULL || $nickname == NULL || $firstName == NULL) {
    fail($html);
  }

  // Réponse AJAX envoyée au JavaScript
  $data = sendAjax($URL . "svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname]);
  success(["idUser" => $data["idUser"]])

?>
