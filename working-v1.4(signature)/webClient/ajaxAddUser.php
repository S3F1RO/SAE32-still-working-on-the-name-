<?php

  // Inclusions
  include_once('./utils.php');
  include_once('./params.php');
  include_once('./cfgDbWebClient.php');
  
  // Open DB
  $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
  $db->set_charset("utf8");

  $html = "Prénom, nom, pseudo ou mot de passe invalide";

  // Check
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  else fail($html);

  // Data ajax from client (filtered + escaped)
  $firstName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ]{1,20}$/", $data['firstName'])) $firstName = $db->real_escape_string($data['firstName']);
  $lastName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ ]{1,20}$/", $data['lastName'])) $lastName = $db->real_escape_string($data['lastName']);
  $nickname = NULL;
  if (preg_match("/^[A-Za-z0-9\-\'\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ& ]{1,20}$/", $data['nickname'])) $nickname = $db->real_escape_string($data['nickname']);
  $passphrase = NULL;
  if (preg_match("/^.+$/", $data['passphrase'])) $passphrase = $db->real_escape_string($data['passphrase']);

  // Check
  if ($lastName == NULL || $nickname == NULL || $firstName == NULL || $passphrase == NULL ) fail($html);

  // Creation of the Asym key couple
  $keysU = openssl_pkey_new(array('private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA));
  openssl_pkey_export($keysU, $privU);             // Private key
  $pubU = openssl_pkey_get_details($keysU)['key'];
  
  // Encrypt Key 
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-gcm"));                     // Generate initialization vector
  $encryptedPrivKey = openssl_encrypt($privU, "aes-256-gcm", $passphrase, $options=0, $iv, $tag); // Encrypt data and generate authentication tag
  
  // Signature
  $pubU = base64_encode($pubU);
  $signatureData = $firstName . $lastName . $nickname . $pubU;
  openssl_sign($signatureData, $userInfosHashCryptPrivU, $privU, OPENSSL_ALGO_SHA256);
  
  // // Tests
  // if (openssl_verify($signatureData, $userInfosHashCryptPrivU, $pubU, OPENSSL_ALGO_SHA256)) fail("Vérifié");
  // else fail("non vérifié");

  // Encode to be lisible
  $userInfosHashCryptPrivU = base64_encode($userInfosHashCryptPrivU);
  $encryptedPrivKey = base64_encode($encryptedPrivKey);
  $iv = base64_encode($iv);
  $tag = base64_encode($tag);

  // Send DATA and returns idUser
  $data = sendAjax($URL . "svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname, "pubU" => "$pubU", "userInfosHashCryptPrivU" => "$userInfosHashCryptPrivU"]);
  
  // Check if DATA failed
  if (!$data['success']) fail($html);
  
  // Insert DATA into DB
  $idUser = $data['idUser'];
  $query = "INSERT INTO `tblClientUsers` (`id`, `privUCryptPassU`, `privUCryptPassUIv`, `privUCryptPassUTag`) VALUES ($idUser, '$encryptedPrivKey', '$iv', '$tag');";
  $success = $db->query($query);
  
  if (!$success) fail($html);
  
  success(["idUser" => $idUser]);

?>
