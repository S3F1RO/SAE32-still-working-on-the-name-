<?php

  include_once('./utils.php');
  include_once('./cfgDbWebClient.php');
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];
  $privU = NULL;
  if (isset($_SESSION['privU'])) $privU = $_SESSION['privU'];

  // Check
  if ($idUser == NULL || $privU == NULL) {
    header("Location: logout.php");
    exit();
  }

  //Open DB
  $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
  $db->set_charset("utf8");

  //Get Crypted Key from DB
  $query="SELECT * FROM tblClientUsers WHERE id = '$idUser'";
  $result = $db->query($query);
  
  //Fetch symetric items
  while($row = $result->fetch_assoc()){
    $privUCryptPassU = $row['privUCryptPassU'];
    $privUCryptPassUIv = $row['privUCryptPassUIv'];
    $privUCryptPassUTag  = $row['privUCryptPassUTag'];
  }

  $content .= "id;privUCryptPassU;privUCryptPassUIv;privUCryptPassUTag\n";
  $content .= "$idUser;$privUCryptPassU;$privUCryptPassUIv;$privUCryptPassUTag";

  header("Content-Type: text/plain");
  header("Content-Disposition: attachment; filename=\"user$idUser.txt\"");
  header("Content-Length: " . strlen($content));

  echo $content;
  exit;
?>