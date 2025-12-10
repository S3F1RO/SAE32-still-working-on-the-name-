<?php

  include_once('./utils.php');
  include_once('./dataStorage.php');

  // Allow JSON content
  // header("Content-Type: application/json; charset=UTF-8");
  // // Data ajax from server
  // $data = json_decode(file_get_contents('php://input'), true);
  // $idCompetences = $data['idCompetences'];
  // // Check
  // if (empty($idCompetences)) {
  //   echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
  //   exit;
  // }

  $idCompetences = ["19", "16"];
  
  //array to stock competences 
  $competences=[];
  // Loop through each competence ID
  foreach ($idCompetences as $idCompetence) {
    
    // filtered + escaped data
    if (preg_match("/^[0-9]+$/", $idCompetence)) $idCompetence = escape_string($idCompetence);
    // Get competence data
    $competence = DataStorage::getFullCompetence($idCompetence);
    // Add competence data to array
    if (!empty($competence)) $competences[] = $competence;
  }

  if (empty($competences)) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit;
  }
  print_r($competences);
  exit;
  // Send back a JSON response
  echo json_encode(['success'=>true,'competences'=>$competences]);
  exit(); 

  $tkt = [["idCompetence", "idUTeacher", "idUStudent", "idSkill", "beginDate", "revokedDate", "masteringLevel", "teacher"=>["idUser", "firstName", "lastName", "nickname"], "student"=>["idUser", "firstName", "lastName", "nickname"]], []];

?>