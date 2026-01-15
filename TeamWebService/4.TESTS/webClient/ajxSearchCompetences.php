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

  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $idType = NULL;
  if (preg_match("/^[idCST]{3}$/", $data['idType'])) $idType = $data['idType'];
  $id = NULL;
  if (preg_match("/^[0-9,]{1,1000}$/", $data['id']) && $idType == "idC") $id = $data['id'];
  elseif (preg_match("/^[0-9]{1,20}$/", $data['id'])) $id = $data['id'];

  // Check
  if ($id == NULL || ($idType != "idC" && $idType != "idS" && $idType != "idT")) {
    fail($html);
  } 
  
  success(["idType"=>$idType, "id"=>$id]);
?>