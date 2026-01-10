<?php

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

  // Data from client (filtered)
  $idSkill = NULL;
  if (preg_match("/^[0-9]{0,20}$/", $_GET['idSkill'])) $idSkill = $_GET['idSkill'];

  // Check
  if ($idSkill == NULL) {
    header("Location: getSkillsAndMasterCompetences.php");
    exit();
  }

?>
<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <script type='text/javascript' src='./js/ajxAddCompetence.js'></script> 

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png'/>

    <!-- Title -->
    <title>Compétence</title>
  </head>

  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <div class='wrapper'>

      <h1>Ajout d'une compétence</h1>

      <!-- User field -->
     <span></span>
     
      <article>
        <ul>
          <li>
            <input name="idSkill" style="display:none" type="number" value="<?=$idSkill?>">
          </li>
          <li>
            <input name="idUStudent" type="number" placeholder="id student" required>
          </li>

          <li>
            <select name="masteringLevel" size = "1">
              <option value="1" selected> Comprise </option>
              <option value="2"> Acquise </option>
              <option value="3"> Maîtrisée </option>
              <option value="4"> Enseignée </option>
            </select >
          </li>
  
          <li>
            <input name="revokedDate" type = "date" min = "2025" max = "2047"/>
          </li>
  
          <li>
            <button class="ok">OK</button>
          </li>
        </ul>
      </article>
    </div>
  </body>
</html>
