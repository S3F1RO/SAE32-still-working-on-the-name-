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
  $competences=[];
  // Loop through each competence ID
  foreach ($idCompetences as $idCompetence) {
    
    // filtered + escaped data
    if (preg_match("/^[0-9]+$/", $idCompetence)) $idCompetence = $db->real_escape_string($idCompetence);
    // Get competence data
    $competence = DataStorage::getCompetence($idCompetence);
    // Add competence data to array
    if (!empty($competence)) $competences[] = $competence;
  }
  // DB close
  $db->close();
  if (empty($competences)) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit;
  }
  // Send back a JSON response
  echo json_encode(['success'=>true,'competences'=>$competences]);
  exit(); 
  ?>

