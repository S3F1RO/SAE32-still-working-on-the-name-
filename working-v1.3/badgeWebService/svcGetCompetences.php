<?php
  include_once('./utils.php');
  include_once('./dataStorage.php');
  
  // DB open
  include_once("./cfgDbEscape.php");
  $db = new mysqli(DBESCAPE_HOST, DBESCAPE_LOGIN, DBESCAPE_PWD, DBESCAPE_NAME);
  $db->set_charset("utf8");
  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");
  // Data ajax from server
  $data = json_decode(file_get_contents('php://input'), true);
  $idCompetences = $data['idCompetences'];
  
  // Check
  if (empty($idCompetences)) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit;
  }
  
  //array to stock competences 
  $idC = [];
  // Loop through each competence ID
  foreach ($idCompetences as $idCompetence) {
    
    // filtered + escaped data
    if (preg_match("/^[0-9]+$/", $idCompetence)) $idCompetence = $db->real_escape_string($idCompetence);
    $idC[] = $idCompetence; 
    
    // Check
    if (empty($idC)) {
      echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
      exit;
    }
  }
  // Get competence data
  $competences = DataStorage::getCompetences($idC);
  // DB close
  $db->close();
  
  // Send back a JSON response
  success(['competences'=>$competences]);
  
  ?>

