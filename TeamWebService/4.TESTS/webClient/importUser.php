<?php

  // Inclusions
  include_once('./utils.php');
  include_once('./params.php');
  include_once('./cfgDbWebClient.php');
  
  // Initialization
  $lines = "";
  $html = "";

  // Form processing
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["userFile"])) {

    // Open DB
    $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
    $db->set_charset("utf8");

    // Data from client (filtered + escaped)
    $passphrase = NULL;
    if (preg_match("/^.+$/", $_POST['passphrase'])) $passphrase = $db->real_escape_string($_POST['passphrase']);

    // Check
    if ($passphrase == NULL) $html = "Mot de passe vide !";

    // Check errors
    elseif ($_FILES["userFile"]["error"] == UPLOAD_ERR_OK) {
      $tmpName = $_FILES["userFile"]["tmp_name"];
      $fileName = $_FILES["userFile"]["name"];

      // Read contents
      $lines = file($tmpName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      
      if ($lines == NULL) $html = "Impossible de lire le fichier.";
      else {
        $headers = str_getcsv($lines[0], ';');
        $lastLine = end($lines);
        
        $values = str_getcsv($lastLine, ';');
        
        $userInfos = array_combine($headers, $values);
  
        $privUCryptPassU = base64_decode($userInfos["privUCryptPassU"]);
        $privUCryptPassUIv = base64_decode($userInfos["privUCryptPassUIv"]);
        $privUCryptPassUTag = base64_decode($userInfos["privUCryptPassUTag"]);
        
        //Decrypt data
        $isKeyDecrypted = openssl_decrypt($privUCryptPassU, "aes-256-gcm", $passphrase, $options=0, $privUCryptPassUIv, $privUCryptPassUTag);
        
        //If empty data could not be recovered then it's false
        if (!$isKeyDecrypted) $html = "Mot de passe incorrect !";
        else {
          $idUser = $userInfos["id"];
    
          //Get Crypted Key from DB
          $query="SELECT * FROM tblClientUsers WHERE id = '$idUser'";
          $result = $db->query($query);
          $numRows = $result->num_rows;
    
          // Check
          if ($numRows != 0) $html = "Utilisateur déjà importé";
          else {
            $privUCryptPassUB64 = base64_encode($privUCryptPassU);
            $ivB64 = base64_encode($privUCryptPassUIv);
            $tagB64 = base64_encode($privUCryptPassUTag);
    
            $query = "INSERT INTO `tblClientUsers` (`id`, `privUCryptPassU`, `privUCryptPassUIv`, `privUCryptPassUTag`) VALUES ($idUser, '$privUCryptPassUB64', '$ivB64', '$tagB64');";
            $success = $db->query($query);
    
            if (!$success) $html = "Impossible d'insérer en base de données";
            else {
              session_start();
              $_SESSION['idUser'] = $idUser;
              $_SESSION['privU'] = $isKeyDecrypted;
              header("Location: getCompetences.php");
              exit();
            }
          }
        }
      }
    } else {
      $html = "Erreur lors de l'upload du fichier.";
    }
  }

?>
<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen'/>

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <!-- <script type='text/javascript' src='./js/ajaxLogin.js'></script> -->

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png'/>

    <!-- Title -->
    <title>Importation</title>
  </head>

  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <section>
      <h1>Importation d'un utilisateur</h1>
      <span><?=$html?></span>

      <!-- Client field -->
      <article>
        <form method="post" enctype="multipart/form-data">
          <ul>
            <li>
              <input type="file" name="userFile" id="">
            </li>
            <li>
              <input type='password' name='passphrase' placeholder='Mot de passe'/>
            </li>
            <li>
              <button type="submit">OK</button>
            </li>
            <li>
              <p>Pas encore de compte ? <a href="addUser.html">S'inscrire</a></p>
            </li>
            <li>
              <p>Retour à la page de <a href="login.html">connexion</a></p>
            </li>
          </ul>
        </form>
      </article>
    </section>
  </body>
</html>