<?php

  // Data to session
  session_start();
  $_SESSION['idUser'] = 1;

  $idSkill = 3;

?>

<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/00_reset.css' media='screen' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='./css/02_fonts.css' media='screen' />
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' /> -->

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <script type='text/javascript' src='./js/ajxAddCompetence.js'></script> 
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no"> -->

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/iut.png' />

    <!-- Title -->
    <title>Compétence</title>
  </head>

  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <div class='wrapper'>

      <h1>Ajout Compétence</h1>

      <!-- Champ des utilisateurs-->
     <ul>
     </ul>
     
      <article>
        <ul>
          <li>
            <input name="idSkill" style="display:none" type="number" value="<?=$idSkill?>">
          </li>
          <li>
            <input name="idUStudent" type="number" placeholder="id student">
          </li>

          <li>
            <select name="masteringLevel" size = "1" >
              <option value="1" selected> Comprise </option>
              <option value="2"> Acquise </option>
              <option value="3"> Maîtrisée </option>
              <option value="4"> Enseignée </option>
            </select >
          </li>
  
          <li>
            <input name="revokedDate" type = "date" min = "2025" max = "2047" required />
          </li>
  
          <li>
            <button class="ok">OK</button>
          </li>
        </ul>
      </article>
    </div>
  </body>
</html>
