
<!-- if u wana test blud just pass to .php -->

<!-- <?php

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

?> -->

<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <script type='text/javascript' src='./js/ajxAddSkill.js'></script> 
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png'/>

    <!-- Title -->
    <title>Certisûr - Ajout skills</title>
  </head>

  <!-- Body -->
  <body>
    <section>
      <h1>Ajout de skills</h1>
      <span></span>
          
      <!-- Skills field --> 
      <article>
        <ul>
          <li>
            <input type='text' name='mainName'  maxlength="20" placeholder='Le titre' autofocus/>
          </li>
          <li>
            <input type='text' name='subName' maxlength="20" placeholder='Sous-titre'/>
          </li>
          <li>
            <input type='text' name='domain' maxlength="15" placeholder='Le domain'/>
          </li>
          <li>
            <input type='file' maxlength="20" name='file'/> 
          </li>
          <li>
            <input type="range" name="level" min = "0" max = "8" step = "1" value = "8"/>
          </li>
          <li>
            <input type="color" value="#FF0000"/>
          </li>
          <li>
            <button id="btnOK" type='submit'>OK</button>
          </li>
        </ul>
      </article>
    </section>

    <nav>
      <a href="getCompetences.php?idS=<?=$idUser?>"><i class="back">&#xe5c4;</i></a>
      <a href="inputCompetence.php" class="magnifyingGlass"><i>&#8981;</i></a>
      <a href="getSkillsAndMasterCompetences.php"><i class="profile">&#xe853;</i></a>
    </nav>
  </body>
</html>