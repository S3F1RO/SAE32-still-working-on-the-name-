<?php

    include_once("./utils.php");
    include_once("./params.php");
    
    if (isset($_GET['idC']) && $_GET['idC'] != "") {
        $idCompetences = explode(",",$_GET['idC']);
        $data = ['idCompetences'=>$idCompetences];
        $competences=sendAjax($URL . "svcGetCompetences.php", $data);

        if (!$competences['success']) $html="No competencies found";
        else {
            $html .= "\n<img src='./" . $competences['competences'][0]['imgUrl'] . "' alt='Image diplôme'/>";
            $html .= "<ul>" . $competences['competences'][0]['name'] . "name";
            $html .= "\n<li>Skill : " . $competences['competences'][0]['idSkill'] . "</li>";
            $html .= "\n<li>Teacher: " .  $competences['competences'][0]['idUteacher'] . "</li>";
            $html .= "\n<li>Date d'obtention: " . $competences['competences'][0]['beginDate'] . "</li>";
            $html .= "\n<li>Date de fin de certification: " . $competences['competences'][0]['revokedDate'] . "</li>";

            if ($competences['competences'][0]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
            else if ($competences['competences'][0]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
            else if ($competences['competences'][0]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
            else if ($competences['competences'][0]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";

            $html .= "\n<li>Niveau de maîtrise: " . $formattedMasteringLevel . "</li>";
            $html .= "\n<li>Skill : " . $competences['competences'][0]['idSkill'] . "</li>";
            $html .= "\n<li>Teacher: " . $competences['competences'][0]['idUteacher'] . "</li>";
            $html .= "\n</ul>";

            for ($i=1 ; $i<count($competences['competences']) ; $i++) {
                $html .= "\n<ul class='competence'>";
                $html .= "\n<img src='./" . $competences['competences'][$i]['urlImage'] . "' alt='Image diplôme'>";
                $html .= "<ul>" . $competences['competences'][$i]['name'] . "name";
                $html .= "\n<li>Skill : " . $competences['competences'][$i]['idSkill'] . "</li>";
                $html .= "\n<li>Teacher: " . $competences['competences'][$i]['idUteacher'] . "</li>";
                $html .= "\n<li>Date d'obtention: " . $competences['competences'][$i]['beginDate'] . "</li>";
                $html .= "\n<li>Date de fin de certification: " . $competences['competences'][$i]['revokedDate'] . "</li>";
                
                // Formatting the mastering level
                if ($competences[$i]['masteringLevel'] == 1) $formattedMasteringLevel = "Comprise";
                else if ($competences[$i]['masteringLevel'] == 2) $formattedMasteringLevel = "Acquise";
                else if ($competences[$i]['masteringLevel'] == 3) $formattedMasteringLevel = "Maîtrisée";
                else if ($competences[$i]['masteringLevel'] == 4) $formattedMasteringLevel = "Enseignée";
                
                $html .= "\n<li>Niveau de maîtrise: " . $formattedMasteringLevel . "</li>";
                $html .= "\n<li>Skill : " . $competences[$i]['idSkill'] . "</li>";
                $html .= "\n<li>Teacher: " . $competences[$i]['idUteacher'] . "</li>";
                $html .= "\n</ul>";
                $html .= "\n</ul>";
            }
        }
    } else if (isset($_GET['idS']) && $_GET['idS']!= "") {
        $idCompetences = explode(",", $_GET['idS']);
        // print_r($idCompetences);
        $data = ['idCompetences'=>$idCompetences];
        $tokenData = sendAjax($URL . "svcGetCompetences.php", $data);
        print_r($tokenData);
    }
    else $html="No competencies found"
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
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no"> -->

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/iut.png' />

    <!-- Title -->
    <title>Compétence</title>
    <body>
      <style>
        ul:first {
          padding-bottom: 5vh;
          border: 1vh black solid;
          border-style: none none solid;
        }
        .competence{
          display:flex;
          flex-direction: row;
          align-items: center;
        }
        .competence li {
          margin-left:2vh;
        }
        ul {
          display:flex;
          flex-direction: column;
          margin-top:1vh;
        }
        ul ul{
          display:flex;
          flex-direction: column
        }
        li{
          margin:0vh;
          gap:0;
          padding:0;
        }
      </style>
      <ul>
        <?php echo $html;?>
      </ul>
    </body>

  </head>


