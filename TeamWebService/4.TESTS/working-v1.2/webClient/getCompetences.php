<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/00_reset.css' media='screen' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <link rel='stylesheet' type='text/css' href='./css/02_fonts.css' media='screen' />
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <script type='text/javascript' src='./js/ajxDisplayBadges.js'></script> 
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
  </head>



<?php 

  include_once("./utils.php");
  include_once("./params.php");

  echo $_GET['idC'];

  if (isset($_GET['idC'])) {
    $idCompetences=explode(",",$_GET['idC']);
    sendAjax("$URL.svcGetCompetences.php",$idCompetences);
  } else if (isset($_GET['idS'])) {
    $idCompetences=explode(",",$_GET['idS']);
    sendAjax("$URL.svcGetCompetences.php",$idCompetences);;
  }
  
?>