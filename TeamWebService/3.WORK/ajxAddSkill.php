<?php
include_once('./utils.php');
include_once('./params.php');

// Default error message
$html = "Information(s) invalide(s) ou manquante(s)";

 // File from client (ajax)
 $clientFilename = NULL;
 if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
     $clientFilename = $_FILES["file"]["name"];
 } else {
     echo json_encode(["success" => false, "message" => "Aucun fichier"]);
        exit();
 }

 // Data from client (ajax)
  $idUCreator = NULL;
  if (preg_match("/^[0-9]+$/", $_POST['idUCreator'])) $idUCreator = $_POST['idUCreator'];
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
  if ($idUCreator == NULL || $mainName == NULL || $subName == NULL || $domain == NULL || $level == NULL || $color == NULL || !isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail($html);
    exit();
  } 


// Send the data and image to server WebService
$data = sendAjaxImg(
    $URL . "svcAddSkill.php",
    [
        "idUCreator" => $idUCreator,
        "mainName" => $mainName,
        "subName"  => $subName,
        "domain"   => $domain,
        "level"    => $level,
        "color"    => $color,
    ],
    [
        "file" => $_FILES["file"],
    ]
);

// Check response
if (!isset($data["idSkill"])) {
fail($html);
}

// Client response
success(["idSkill" => $data["idSkill"]]);

?>
