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

  $sectionHtml = "";
  $articleHtml = "";
  $errorHtml = "     <img src='medias/error.png' alt='error'>\n";
  $errorHtml .= "      <ul>\n";
  $errorHtml .= "        <li><span>Auccune aptitude trouver (눈_눈)</span></li>\n";
  $errorHtml .= "      </ul>\n\n";
  
  if (isset($_GET['idC']) && $_GET['idC'] != "") {
    $idCompetences = explode(",", $_GET['idC']);
    $data = ['idCompetences' => $idCompetences];
    $competences = sendAjax($URL . "svcGetCompetences.php", $data);

    if (!$competences['success']) $sectionHtml = $errorHtml;
    else {
      if ($competences['competences'][0]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
      else if ($competences['competences'][0]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
      else if ($competences['competences'][0]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
      else if ($competences['competences'][0]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

      if ($_GET['isJustCreated'] == "true") $sectionHtml .= "<h1>La compétence que vous venez de donner a pour id " . $idCompetences[0] . "</h1>";
      $sectionHtml .= "\n        <img src='" . $competences['competences'][0]["imgCUrl"] . "' alt='Image certif'/>\n";
      $sectionHtml .= "\n        <ul>";
      $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['mainName'] . "</li>";
      if ($competences['competences'][0]["skill"]['subName'] != NULL || $competences['competences'][0]["skill"]['subName'] != "") {
        $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['subName'] . "</li>";
      }
      $sectionHtml .= "\n          <li>N° d'aptitude : " . $competences['competences'][0]['idSkill'] . "</li>";
      $sectionHtml .= "\n          <li>N° de compétence : " . $competences['competences'][0]['idCompetence'] . "</li>";
      if ($competences['competences'][0]["skill"]['creator']["nickname"] == $competences['competences'][0]['teacher']["nickname"]) {
        $sectionHtml .= "\n          <li>Créé et donner par : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
      } else {
        $sectionHtml .= "\n          <li>Créateur : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
        $sectionHtml .= "\n          <li>Donné par : " . $competences['competences'][0]['teacher']["nickname"] . "</li>";
      }
      $sectionHtml .= "\n          <li>À : " . $competences['competences'][0]['student']["nickname"] . "</li>";
      $sectionHtml .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
      $sectionHtml .= "\n          <li>Date d'obtention : " . dateInFr($competences['competences'][0]['beginDate']) . "</li>";
      $revokedDate = $competences['competences'][0]['revokedDate'];
      if ($revokedDate != NULL) $sectionHtml .= "\n          <li>Date d'expiration : " . dateInFr($competences['competences'][0]['revokedDate']) . "</li>";
      $sectionHtml .= "\n        </ul>\n";

      for ($i = 1 ; $i < count($competences['competences']) ; $i++) {
        // Formatting the mastering level
        if ($competences[$i]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
        else if ($competences[$i]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
        else if ($competences[$i]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
        else if ($competences[$i]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

        $articleHtml .= "        <ul>";
        $articleHtml .= "\n          <li class='img'><img src='" . $competences['competences'][$i]["imgCUrl"] . "' alt='Image diplôme'></li>";
        $articleHtml .= "\n          <li class='title'>" . $competences['competences'][$i]["skill"]['mainName'] . "</li>";
        $articleHtml .= "\n          <li>Domain : " . $competences['competences'][$i]['skill']["domain"] . "</li>";
        $articleHtml .= "\n          <li>Obtenu par : " . $competences['competences'][0]['student']["nickname"] . "</li>";
        $articleHtml .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
        $articleHtml .= "\n        </ul>\n\n";
      }
    }
  } else if (isset($_GET['idT']) && $_GET['idT'] != "") {
    $idTeacher = $_GET['idT'];

    $data = ['idTeacher' => $idTeacher];
    $competences = sendAjax($URL . "svcGetCompetences.php", $data);
    if (!$competences['success']) $sectionHtml = $errorHtml;
    else {
      if ($competences['competences'][0]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
      else if ($competences['competences'][0]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
      else if ($competences['competences'][0]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
      else if ($competences['competences'][0]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

      $sectionHtml .= "<h1>Toutes les compétences donné par " . $competences['competences'][0]['teacher']['lastName'] . " " . $competences['competences'][0]['teacher']['firstName'] . "</h1>";
      $sectionHtml .= "\n        <img src='" . $competences['competences'][0]["imgCUrl"] . "' alt='Image certif'/>\n";
      $sectionHtml .= "\n        <ul>";
      $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['mainName'] . "</li>";
      if ($competences['competences'][0]["skill"]['subName'] != NULL || $competences['competences'][0]["skill"]['subName'] != "") {
        $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['subName'] . "</li>";
      }
      $sectionHtml .= "\n          <li>N° d'aptitude : " . $competences['competences'][0]['idSkill'] . "</li>";
      $sectionHtml .= "\n          <li>N° de compétence : " . $competences['competences'][0]['idCompetence'] . "</li>";
      if ($competences['competences'][0]["skill"]['creator']["nickname"] == $competences['competences'][0]['teacher']["nickname"]) {
        $sectionHtml .= "\n          <li>Créé et donner par : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
      } else {
        $sectionHtml .= "\n          <li>Créateur : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
        $sectionHtml .= "\n          <li>Donné par : " . $competences['competences'][0]['teacher']["nickname"] . "</li>";
      }
      $sectionHtml .= "\n          <li>À : " . $competences['competences'][0]['student']["nickname"] . "</li>";
      $sectionHtml .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
      $sectionHtml .= "\n          <li>Date d'obtention : " . dateInFr($competences['competences'][0]['beginDate']) . "</li>";
      $revokedDate = $competences['competences'][0]['revokedDate'];
      if ($revokedDate != NULL) $sectionHtml .= "\n          <li>Date d'expiration : " . dateInFr($competences['competences'][0]['revokedDate']) . "</li>";
      $sectionHtml .= "\n        </ul>\n";

      for ($i = 1 ; $i < count($competences['competences']) ; $i++) {
        // Formatting the mastering level
        if ($competences[$i]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
        else if ($competences[$i]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
        else if ($competences[$i]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
        else if ($competences[$i]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

        $articleHtml .= "        <ul>";
        $articleHtml .= "\n          <li class='img'><img src='" . $competences['competences'][$i]["imgCUrl"] . "' alt='Image diplôme'></li>";
        $articleHtml .= "\n          <li class='title'>" . $competences['competences'][$i]["skill"]['mainName'] . "</li>";
        $articleHtml .= "\n          <li>Domain : " . $competences['competences'][$i]['skill']["domain"] . "</li>";
        $articleHtml .= "\n          <li>Obtenu par : " . $competences['competences'][0]['student']["nickname"] . "</li>";
        $articleHtml .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
        $articleHtml .= "\n        </ul>\n\n";
      }
    }
  } else {
    $idStudent = $_GET['idS'];
    if ($idStudent == NULL) $idStudent = $idUser;

    $data = ['idStudent' => $idStudent];
    $competences = sendAjax($URL . "svcGetCompetences.php", $data);
    if (!$competences['success']) $sectionHtml = $errorHtml;
    else {
      if ($competences['competences'][0]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
      else if ($competences['competences'][0]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
      else if ($competences['competences'][0]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
      else if ($competences['competences'][0]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

      $sectionHtml .= "<h1>Toutes les compétences de " . $competences['competences'][0]['student']['lastName'] . " " . $competences['competences'][0]['student']['firstName'] . "</h1>";
      $sectionHtml .= "\n        <img src='" . $competences['competences'][0]["imgCUrl"] . "' alt='Image certif'/>\n";
      $sectionHtml .= "\n        <ul>";
      $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['mainName'] . "</li>";
      if ($competences['competences'][0]["skill"]['subName'] != NULL || $competences['competences'][0]["skill"]['subName'] != "") {
        $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['subName'] . "</li>";
      }
      $sectionHtml .= "\n          <li>N° d'aptitude : " . $competences['competences'][0]['idSkill'] . "</li>";
      $sectionHtml .= "\n          <li>N° de compétence : " . $competences['competences'][0]['idCompetence'] . "</li>";
      if ($competences['competences'][0]["skill"]['creator']["nickname"] == $competences['competences'][0]['teacher']["nickname"]) {
        $sectionHtml .= "\n          <li>Créé et donner par : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
      } else {
        $sectionHtml .= "\n          <li>Créateur : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
        $sectionHtml .= "\n          <li>Donné par : " . $competences['competences'][0]['teacher']["nickname"] . "</li>";
      }
      $sectionHtml .= "\n          <li>À : " . $competences['competences'][0]['student']["nickname"] . "</li>";
      $sectionHtml .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
      $sectionHtml .= "\n          <li>Date d'obtention : " . dateInFr($competences['competences'][0]['beginDate']) . "</li>";
      $revokedDate = $competences['competences'][0]['revokedDate'];
      if ($revokedDate != NULL) $sectionHtml .= "\n          <li>Date d'expiration : " . dateInFr($competences['competences'][0]['revokedDate']) . "</li>";
      $sectionHtml .= "\n        </ul>\n";

      for ($i = 1 ; $i < count($competences['competences']) ; $i++) {
        // Formatting the mastering level
        if ($competences[$i]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
        else if ($competences[$i]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
        else if ($competences[$i]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
        else if ($competences[$i]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

        $articleHtml .= "        <ul>";
        $articleHtml .= "\n          <li class='img'><img src='" . $competences['competences'][$i]["imgCUrl"] . "' alt='Image diplôme'></li>";
        $articleHtml .= "\n          <li class='title'>" . $competences['competences'][$i]["skill"]['mainName'] . "</li>";
        $articleHtml .= "\n          <li>Domain : " . $competences['competences'][$i]['skill']["domain"] . "</li>";
        $articleHtml .= "\n          <li>Obtenu par : " . $competences['competences'][0]['student']["nickname"] . "</li>";
        $articleHtml .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
        $articleHtml .= "\n        </ul>\n\n";
      }
    }
  }
  
  if ($sectionHtml == NULL) $sectionHtml = "<h1>Auccune compétences trouver</h1>" 

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
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->
    <script type='text/javascript' src='./js/web.js'></script>

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png' />

    <!-- Title -->
    <title>Certisûr</title>
    <body>

      <header>
        <?=$sectionHtml?>
      </header>

      <article>
<?php echo $articleHtml;?>
      </article>

      <nav>
        <a href="addSkill.php"><i class="plus">&#x2b;</i></a>
        <a href="inputCompetence.php" class="magnifyingGlass"><i>&#8981;</i></a>
        <a href="getSkillsAndMasterCompetences.php"><i class="profile">&#xe853;</i></a>
      </nav>
    </body>
  </head>
</html>