<?php

  //-----------------
  // To implement later
  //-----------------
  // // Data from session
  // session_start();
  // $idUser = NULL;
  // if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];

  // // Check
  // if ($idUser == NULL) {
  //   header("Location: logout.php");
  //   exit();
  // }

  //-----------------
  // To delete later
  //-----------------
  // Data to session
  session_start();
  $_SESSION['idUser'] = 1;

  $idSkill = 3; // To modify later too

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
