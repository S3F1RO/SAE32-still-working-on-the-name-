<?php

  include_once('./utils.php');
  include_once('./params.php');
  include_once('./cfgDbWebClient.php');
  
  //Open DB
  $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
  $db->set_charset("utf8");
  $html = "Identifiant ou mot de passe invalide";

  // Check
  if (!isset($_POST['data'])) fail($html);

  // JSON decode
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $idUser = NULL;
  if (preg_match("/^[0-9]{1,20}$/", $data['idUser'])) $idUser = $db->real_escape_string($data['idUser']);
  $passphrase = NULL;
  if (preg_match("/^.+$/", $data['passphrase'])) $passphrase = $db->real_escape_string($data['passphrase']);

  // Check
  if ($idUser == NULL || $passphrase == NULL) fail($html);

  
  //Get Crypted Key from DB
  $query="SELECT * FROM tblClientUsers WHERE id = '$idUser'";
  $result = $db->query($query);
  
  //Fetch symetric items
  while($row = $result->fetch_assoc()){
    $privUCryptPassU = $row['privUCryptPassU'];
    $privUCryptPassUIv = $row['privUCryptPassUIv'];
    $privUCryptPassUTag  = $row['privUCryptPassUTag'];
  }

  //Decode the keys to use them
  $privUCryptPassU = base64_decode($privUCryptPassU);
  $privUCryptPassUIv = base64_decode($privUCryptPassUIv);
  $privUCryptPassUTag = base64_decode($privUCryptPassUTag);

  //Decrypt data
  $isKeyDecrypted = openssl_decrypt($privUCryptPassU, "aes-256-gcm", $passphrase, $options=0, $privUCryptPassUIv, $privUCryptPassUTag);

  //If empty data could not be recovered then it's false
  if (!$isKeyDecrypted) fail($html);
  
  session_start();
  $_SESSION['idUser'] = $idUser;
  $_SESSION['privU'] = $isKeyDecrypted;
  success(["idUser"=>$idUser]);
  
?>
