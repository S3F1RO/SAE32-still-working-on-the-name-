<?php

  include_once("./utils.php");
  include_once("./params.php");

  session_start();
  $idTeacher = NULL;
  if (isset($_SESSION['idUser'])) $idTeacher = $_SESSION['idUser'];
  $privU = NULL;
  if (isset($_SESSION['privU'])) $privU = $_SESSION['privU'];

  // Check
  if ($idTeacher == NULL || $privU == NULL) {
    header("Location: logout.php");
    exit();
  }
  
  $articleCreatorHtml = "";
  $articleTeacherHtml = "";
  $errorHtml = "      <ul>\n";
  $errorHtml .= "        <li class='img'><img src='medias/error.png' alt='error'></li>\n";
  $errorHtml .= "        <li><span>Auccune aptitude trouver (눈_눈)</span></li>\n";
  $errorHtml .= "      </ul>\n\n";

  $data = ['idCreator' => $idTeacher];
  $skills = sendAjax($URL . "svcGetSkills.php", $data);
  if (!$skills['success']) $articleCreatorHtml = $errorHtml;
  else {
    for ($i = 0 ; $i < count($skills['skills']) ; $i++) {
      $articleCreatorHtml .= "      <a href='addCompetence.php?idSkill=" . $skills['skills'][$i]['idSkill'] . "'><ul>\n";
      $articleCreatorHtml .= "        <li class='img'><img src='" . $skills['skills'][$i]['imgUrl'] . "' alt='Image diplôme'></li>\n";
      $articleCreatorHtml .= "        <li class='title'>" . $skills['skills'][$i]['mainName'] . "</li>\n";
      $articleCreatorHtml .= "        <li>" . $skills['skills'][$i]['subName'] . "</li>\n";
      $articleCreatorHtml .= "        <li>Domain : " . $skills['skills'][$i]["domain"] . "</li>\n";
      $articleCreatorHtml .= "        <li>Niveau : " . $skills['skills'][$i]["level"] . "</li>\n";
      $articleCreatorHtml .= "      </ul></a>\n\n";
    }
  }

  $data = ['idStudent' => $idTeacher];
  $competences = sendAjax($URL . "svcGetCompetences.php", $data);

  if (!$skills['success']) $articleTeacherHtml = $errorHtml;
  else {
    for ($i = 0 ; $i < count($competences['competences']) ; $i++) {
      if ($competences['competences'][$i]["masteringLevel"] == 4) {
        $articleTeacherHtml .= "      <a href='addCompetence.php?idSkill=" . $competences['competences'][$i]["skill"]['idSkill'] . "'><ul>\n";
        $articleTeacherHtml .= "        <li class='img'><img src='" . $competences['competences'][$i]["skill"]['imgUrl'] . "' alt='Image diplôme'></li>\n";
        $articleTeacherHtml .= "        <li class='title'>" . $competences['competences'][$i]["skill"]['mainName'] . "</li>\n";
        $articleTeacherHtml .= "        <li>" . $competences['competences'][$i]["skill"]['subName'] . "</li>\n";
        $articleTeacherHtml .= "        <li>Domain : " . $competences['competences'][$i]["skill"]["domain"] . "</li>\n";
        $articleTeacherHtml .= "        <li>Niveau : " . $competences['competences'][$i]["skill"]["level"] . "</li>\n";
        $articleTeacherHtml .= "      </ul></a>\n\n";
      }
    }
  }

  // $data = ['idCreator' => $idTeacher];
  // $skills = sendAjax($URL . "svcGetSkills.php", $data);

?>
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
    <title>Compétence</title>
  </head>

  <!-- Body -->
  <body>
    <header>
      <h1>lulupro973</h1>

      <ul>
        <li>
          <a href="exportUser.php"><button>Exporter mon compte</button></a>
        </li>
        <li>
          <a href="logout.php">Déconnexion</a>
        </li>
      </ul>
    </header>

    <article>
      <h1>Vos création :</h1>
<?=$articleCreatorHtml?>

      <h1>Vous pouvez transmettre :</h1>
<?=$articleTeacherHtml?>
    </article>

    <nav>
      <a href="getCompetences.php?idS=<?=$idTeacher?>"><i class="back">&#xe5c4;</i></a>
      <a href="inputCompetence.php" class="magnifyingGlass"><i>&#8981;</i></a>
      <a href="addSkill.php"><i class="plus">&#x2b;</i></a>
    </nav>
  </body>
</html>