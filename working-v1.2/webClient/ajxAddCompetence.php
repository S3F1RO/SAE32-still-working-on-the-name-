<?php

  include_once('./utils.php');
  include_once('./params.php');
  
  // Data from session
  session_start();
  $idUTeacher = NULL;
  if (isset($_SESSION['idUser'])) $idUTeacher = $_SESSION['idUser'];

  $html = "Information(s) incorrecte(s)";

  // Check
  if ($idUTeacher == NULL) {
    fail($html);
  }

  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = $data['idSkill'];
  $idUStudent = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUStudent'])) $idUStudent = $data['idUStudent'];
  $masteringLevel = NULL;
  if (preg_match("/^[0-9]$/", $data['masteringLevel'])) $masteringLevel = $data['masteringLevel'];
  $revokedDate = NULL;
  if (preg_match("/^[0-9\-]{10}$/", $data['revokedDate'])) $revokedDate = $data['revokedDate'];

  // Check
  if ($idUStudent == NULL || $masteringLevel == NULL || $idSkill == NULL) {
    fail($html);
  }
  
  $data = ["idSkill" => $idSkill, "idUTeacher" => $idUTeacher, "idUStudent" => $idUStudent, "revokedDate" => $revokedDate, "masteringLevel" => $masteringLevel];

  // ----- Send to WebService -----
  $data = sendAjax($URL . "svcAddCompetence.php", $data);

  // Check response
  if ($data["idCompetence"] == NULL) {
    fail($html);
  }
  
  success(["idCompetence"=> $data["idCompetence"]]);

?>
