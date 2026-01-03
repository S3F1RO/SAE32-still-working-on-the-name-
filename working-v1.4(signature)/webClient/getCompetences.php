<?php 

  include_once("./utils.php");
  include_once("./params.php");
  
  if (isset($_GET['idC']) && $_GET['idC'] != "") {
    $idCompetences = explode(",", $_GET['idC']);
    $data = ['idCompetences' => $idCompetences];
    $competences = sendAjax($URL . "svcGetCompetences.php", $data);

    if (!$competences['success']) $html = "No competencies found";
    else {
      if ($competences['competences'][0]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
      else if ($competences['competences'][0]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
      else if ($competences['competences'][0]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
      else if ($competences['competences'][0]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

      $sectionHtml .= "<img src='" . $competences['competences'][0]["skill"]['imgUrl'] . "' alt='Image certif'/>\n";
      $sectionHtml .= "\n        <ul>";
      $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['mainName'] . "</li>";
      $sectionHtml .= "\n          <li>N° d'aptitude : " . $competences['competences'][0]['idSkill'] . "</li>";
      $sectionHtml .= "\n          <li>N° de compétence : " . $competences['competences'][0]['idCompetence'] . "</li>";
      $sectionHtml .= "\n          <li>Créateur : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
      $sectionHtml .= "\n          <li>Donné par : " . $competences['competences'][0]['teacher']["nickname"] . "</li>";
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

        $html .= "        <ul>";
        $html .= "\n          <li class='img'><img src='" . $competences['competences'][$i]["skill"]['imgUrl'] . "' alt='Image diplôme'></li>";
        $html .= "\n          <li class='title'>" . $competences['competences'][$i]["skill"]['mainName'] . "</li>";
        $html .= "\n          <li>Domain : " . $competences['competences'][$i]['skill']["domain"] . "</li>";
        $html .= "\n          <li>Obtenu par : " . $competences['competences'][0]['student']["nickname"] . "</li>";
        $html .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
        $html .= "\n        </ul>\n\n";
      }
    }
  } else if (isset($_GET['idS']) && $_GET['idS'] != "") {
    $idStudent = $_GET['idS'];

    $data = ['idStudent' => $idStudent];
    $competences = sendAjax($URL . "svcGetCompetences.php", $data);
    if (!$competences['success']) $html = "No competencies found";
    else {
      if ($competences['competences'][0]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
      else if ($competences['competences'][0]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
      else if ($competences['competences'][0]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
      else if ($competences['competences'][0]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

      $sectionHtml .= "<h1>Toutes les compétences de " . $competences['competences'][0]['student']['firstName'] . "</h1>";
      $sectionHtml .= "\n        <img src='" . $competences['competences'][0]["skill"]['imgUrl'] . "' alt='Image certif'/>\n";
      $sectionHtml .= "\n        <ul>";
      $sectionHtml .= "\n          <li>" . $competences['competences'][0]["skill"]['mainName'] . "</li>";
      $sectionHtml .= "\n          <li>N° d'aptitude : " . $competences['competences'][0]['idSkill'] . "</li>";
      $sectionHtml .= "\n          <li>N° de compétence : " . $competences['competences'][0]['idCompetence'] . "</li>";
      $sectionHtml .= "\n          <li>Créateur : " . $competences['competences'][0]["skill"]['creator']["nickname"] . "</li>";
      $sectionHtml .= "\n          <li>Donné par : " . $competences['competences'][0]['teacher']["nickname"] . "</li>";
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

        $html .= "        <ul>";
        $html .= "\n          <li class='img'><img src='" . $competences['competences'][$i]["skill"]['imgUrl'] . "' alt='Image diplôme'></li>";
        $html .= "\n          <li class='title'>" . $competences['competences'][$i]["skill"]['mainName'] . "</li>";
        $html .= "\n          <li>Domain : " . $competences['competences'][$i]['skill']["domain"] . "</li>";
        $html .= "\n          <li>Obtenu par : " . $competences['competences'][0]['student']["nickname"] . "</li>";
        $html .= "\n          <li>Niveau de maîtrise : " . $formattedMasteringLevel . "</li>";
        $html .= "\n        </ul>\n\n";
      }
    }
  } else $html = "No competencies found";

?>
<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/00_reset.css' media='screen' />
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <link rel='stylesheet' type='text/css' href='./css/02_fonts.css' media='screen' />
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->
    <script type='text/javascript' src='./js/web.js'></script>

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png' />

    <!-- Title -->
    <title>Compétence</title>
    <body>

      <header>
        <?=$sectionHtml?>
      </header>

      <article>
<?php echo $html;?>
      </article>

      <nav>
        <a href="addSkill.php"><i class="plus">&#x2b;</i></a>
        <a href="inputCompetance.php" class="magnifyingGlass"><i>&#8981;</i></a>
        <a href="getSkillsAndMasterCompetences.php"><i class="profile">&#xe853;</i></a>
      </nav>
    </body>
  </head>
</html>