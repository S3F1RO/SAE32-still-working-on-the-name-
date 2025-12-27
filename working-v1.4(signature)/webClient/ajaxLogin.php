<?php

  include_once('./utils.php');
  include_once('./params.php');
  include_once('./cfgDbWebClient.php');
  
  //Open DB
  $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
  $db->set_charset("utf8");
  $html = "Prénom, nom ou pseudo invalide";

  // Check
  if (!isset($_POST['data'])) fail("Prénom, nom ou pseudo invalide");

  // JSON decode
  $data = json_decode($_POST['data'], true);

  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $idUser = NULL;
  if (preg_match("/^[0-9]{1,20}$/", $data['idUser'])) $idUser = $data['idUser'];
  $passphrase = NULL;
  if (preg_match("/^[A-Za-z0-9\-\'\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ& ]{1,20}$/", $data['passphrase'])) $passphrase = $data['passphrase'];

  // Check
  if ( $idUser == NULL || $passphrase == NULL ) fail($html);
  
  //Get Crypted Key from DB
  $query="SELECT * FROM tblUsers WHERE idUser='$idUser'";
  $result = $db->query($query);
  
  
  //Fetch symetric items
  while($row = $result->fetch_assoc()){
    $privUCryptPassU = $row['privUCryptPassU'];
    $privUCryptIv = $row['privUCryptIv'];
    $privUCryptTag  = $row['privUCryptTag'];
  }

  //Decode the keys to use them
  $privUCryptPassU = base64_decode($privUCryptPassU);
  $privUCryptIv = base64_decode($privUCryptIv);
  $privUCryptTag = base64_decode($privUCryptTag);

  //Decrypt data
  $isKeyDecrypted = openssl_decrypt($privUCryptPassU, "aes-256-gcm", $passphrase, $options=0, $privUCryptIv, $privUCryptTag);

  //If empty data could not be recovered then it's false
  if (empty($isKeyDecrypted)) fail($html);
  
  session_start();
  $_SESSION['isKeyDecrypted'] = $isKeyDecrypted;
  success();
  
?>
