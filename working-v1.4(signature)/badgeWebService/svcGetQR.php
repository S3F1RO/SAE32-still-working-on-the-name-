<?php

  include_once('./utils.php');
  include_once('dataStorageWrapper.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from server (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  $qrCode = NULL;
  if (preg_match("/^[0-9]{1,20}$/", $data['idSkill'])) $qrCode = escape_string($data['qrCode']);

  // Check
  if ($qrCode == NULL) {
    fail();
  }

  if ($qrCode != NULL) {

  }
  

  success(["skills" => $skills]);



?>