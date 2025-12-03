<?php

  include_once('./utils.php');
  include_once('./params.php');

  // Check
  if (!isset($_POST['data'])) {
    echo json_encode([
      "success" => false,
      "message" => "Aucune donnée reçue"
    ]);
    exit();
  }

  // Decode JSON
  $data = json_decode($_POST['data'], true);

  // Variables initialisation
  $firstName = NULL;
  $lastName  = NULL;

  if (isset($data['firstName'])) {
    $firstName = $data['firstName'];
  }
  if (isset($data['lastName'])) {
    $lastName = $data['lastName'];
  }
  if (isset($data['nickname'])) {
    $nickname = $data['nickname'];
  }

  // Réponse AJAX envoyée au JavaScript
  $data = sendAjax(URL, ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname]);
  echo json_encode(["success" => true, "id" => $data["id"]]);

?>
