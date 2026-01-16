<?php

  include_once('./utils.php');
  include_once('./params.php');
  
  // Data from session
  session_start();
  $idUTeacher = NULL;
  if (isset($_SESSION['idUser'])) $idUTeacher = $_SESSION['idUser'];
  $privUT = NULL;
  if (isset($_SESSION['privU'])) $privUT = $_SESSION['privU'];

  $html = "Information(s) incorrecte(s)";

  // Check
  if ($idUTeacher == NULL || $privUT == NULL) {
    fail($html);
  }

  // Data ajax from client (filtered + escaped)
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $idUStudent = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUStudent'])) $idUStudent = $data['idUStudent'];
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = $data['idSkill'];
  $revokedDate = NULL;
  if (preg_match("/^[0-9\-]{10}$/", $data['revokedDate'])) $revokedDate = $data['revokedDate'];
  $masteringLevel = NULL;
  if (preg_match("/^[0-9]$/", $data['masteringLevel'])) $masteringLevel = $data['masteringLevel'];
  
  // Check	
  if ($idUStudent == NULL || $masteringLevel == NULL || $idSkill == NULL) {
    fail($html);
  }

  // Dates regularization
  $beginDate = date('Y-m-d H:i:s');
  if ($revokedDate != NULL) $revokedDate .= " 00:00:00";

  // Signature
  $signatureData = $idUTeacher . $idUStudent . $idSkill . $beginDate . $revokedDate . $masteringLevel;
  openssl_sign($signatureData, $competenceInfosHashCryptPrivUT, $privUT, OPENSSL_ALGO_SHA256);
  $competenceInfosHashCryptPrivUT = base64_encode($competenceInfosHashCryptPrivUT);

  // ----- Send to WebService -----
  $competence = ["idUTeacher" => $idUTeacher, "idUStudent" => $idUStudent, "idSkill" => $idSkill, "beginDate" => $beginDate, "revokedDate" => $revokedDate, "masteringLevel" => $masteringLevel, "competenceInfosHashCryptPrivUT" => $competenceInfosHashCryptPrivUT];
  $data = sendAjax($URL . "svcAddCompetence.php", $competence);

  // Check response
  if (!$data["success"]) fail($data["html"]);
  // if (!$data["success"]) fail($html);
  else success(["idCompetence" => $data["idCompetence"]]);

?>