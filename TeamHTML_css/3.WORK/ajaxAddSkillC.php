<?php
include_once('./utils.php');
include_once('./params.php');

 // File from client (ajax)
 $clientFilename = NULL;
 if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
     $clientFilename = $_FILES["file"]["name"];
 } else {
     echo json_encode(["success" => false, "message" => "Aucun fichier reçu"]);
        exit();
 }

 // Data from client (ajax)
 $mainName = NULL;
 if (preg_match("/^[A-Za-z0-9\-éèêëÉÈÊËïÏàÀçÇ&\' ]{1,20}$/", $_POST['mainName'])) {
     $mainName = $_POST['mainName'];
 }

 $subName = NULL;
 if (preg_match("/^[A-Za-z0-9\-éèêëïàç&\' ]{1,20}$/", $_POST['subName'])) {
     $subName = $_POST['subName'];
 }

 $domain = NULL;
 if (preg_match("/^[A-Za-z0-9\-éèêëïàç&\' ]{1,20}$/", $_POST['domain'])) {
     $domain = $_POST['domain'];
 }

 $level = NULL;
 if (preg_match("/^[0-9]+$/", $_POST['level'])) {
     $level = $_POST['level'];
 }

$color = NULL;
if (preg_match("/^[A-Fa-f0-9]{6}$/", $_POST['color'])) {
    $color = $_POST['color'];
 }

 // Check
if ($mainName==NULL || $subName==NULL || $domain==NULL || $level==NULL || $color==NULL) {
    echo json_encode(["success" => false, "message" => "Données incorrectes"]);
    exit();
 }

// Save file (à supprimer)
$newFilename = generateRandomString($length=20);
$success =  move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/$newFilename.png");
  

// Réponse AJAX envoyée au JavaScript, Call WebService
$data = sendAjax($URL . "svcAddSkill.php", 
                  ["mainName" => $mainName, 
                  "subName"  => $subName, 
                  "domain" => $domain , 
                  "level" => $level, 
                  "color" => $color, 
                  "file"  => $_FILES,
]);

  // Renvoyer une réponse JSON
success(["idUser" => $data["idUser"]])

?>]
