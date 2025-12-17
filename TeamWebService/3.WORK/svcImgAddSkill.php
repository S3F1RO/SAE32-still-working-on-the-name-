<?php
  // Includes
  include_once('./utils.php');
  include_once('./params.php');
  include_once('./dataStorage.php');

  // Default error message
  $html = "Information(s) invalide(s) ou manquante(s)";

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data from WebService (ajax)
   $imgFile = $_FILES['file'];

  // Check
  if (!isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail($html);
    exit();
  } 
  
  // Save file 
  $newFilename = generateRandomString($length=20);

  $imgPath = "uploads/$newFilename.png";
  $success =  move_uploaded_file($imgFile["tmp_name"], $imgPath);

  // JSON send back
  echo json_encode(["imgPath" => $imgPath]);
  
?>