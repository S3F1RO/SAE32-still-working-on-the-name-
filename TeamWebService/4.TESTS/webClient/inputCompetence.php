<?php

  include_once("./utils.php");
  include_once("./params.php");

  // Data from session
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

?>
<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/00_reset.css' media='screen' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <!-- <script type='text/javascript' src='./js/jquery-ui.min.js'></script> -->
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->
    <script type='text/javascript' src='./js/web.js'></script>
    <script type='text/javascript' src='./js/ajxSearchCompetences.js'></script>

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png' />

    <!-- Title -->
    <title>Certisûr - recherche par ID</title>
  </head>



  <!-- Body -->
  <body>
    <section>
      <h1>Recherche par identifiant</h1>
      <span></span>
          
      <!-- Skills field --> 
      <article>
        <ul>
          <li>
            <select name="idType" size = "1">
              <option selected>Que recherchez-vous...</option>
              <option value="idC">Une ou plusier compétence(s). Ex: 1,2,3</option>
              <option value="idS">Les competences d'un utilisateur</option>
              <option value="idT">Les compétences donné par un utilisateur</option>
            </select >
          </li>
          <li>
            <input type='text' name='id' placeholder="Identifiant d'utilisateur/compétence" autofocus/>
          </li>
          <li>
            <button class='ok'>OK</button>
          </li>
        </ul>
      </article>
    </section>

    <nav>
      <a href="getCompetences.php?idS=<?=$idUser?>"><i class="back">&#xe5c4;</i></a>
      <a href="addSkill.php"><i class="plus">&#x2b;</i></a>
      <a href="getSkillsAndMasterCompetences.php"><i class="profile">&#xe853;</i></a>
    </nav>
  </body>
</html>