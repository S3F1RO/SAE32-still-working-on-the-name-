<?php
include_once('./utils.php');

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
if (preg_match("/^.{0,20}$/", $_POST['mainName'])) {
    $mainName = $_POST['mainName'];
}

$subName = NULL;
if (preg_match("/^.{0,20}$/", $_POST['subName'])) {
    $subName = $_POST['subName'];
}

$domain = NULL;
if (preg_match("/^.{0,20}$/", $_POST['domain'])) {
    $domain = $_POST['domain'];
}

$level = NULL;
if (preg_match("/^.{0,20}$/", $_POST['level'])) {
    $level = $_POST['level'];
}

$color = NULL;
if (preg_match("/^.{0,20}$/", $_POST['color'])) {
    $color = $_POST['color'];
}

// Check
if ($mainName==NULL || $subName==NULL || $domain==NULL || $level==NULL || $color==NULL) {
    echo json_encode(["success" => false, "message" => "Données incorrectes"]);
    exit();
}

// Delete previously uploaded files
foreach (glob("uploads/*") as $oldFile) {
    unlink($oldFile);
}

// Save file
$newFilename = "$mainName-$subName-$clientFilename-$domain-$level-$color";
$success = move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/$newFilename");

// Response to client
echo json_encode(["success" => $success]);
?>
