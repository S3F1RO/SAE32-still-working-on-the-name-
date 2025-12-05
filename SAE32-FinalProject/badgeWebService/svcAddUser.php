<?php

  include_once('./utils.php');
  include_once('dataStorage.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Read the JSON request sent by the client
  $input = file_get_contents("php://input");
  $data = json_decode($input, true);

  $firstName=$data["firstName"];
  $lastName=$data["lastName"];
  $nickname=$data["nickname"];

  // adding to the database and retrieving the ID
  $idUser=DataStorage::addUser($firstName, $lastName, $nickname);


  // Check
  if ($data == null) {
    echo json_encode([
      null
    ]);
    exit;
  };

  // Response
  $response = [
    "id" => $idUser
  ];

  // Send back a JSON response
  echo json_encode($response);

?>