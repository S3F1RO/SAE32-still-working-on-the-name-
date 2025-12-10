
<!-- if u wana test blud just pass to .php -->

<!-- <?php

  // Data to session
  session_start();
  $_SESSION['idUser'] = 1;

?> -->

<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />

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
    <title>Skills</title>
  </head>



  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <div class='wrapper'>
      <h1>Add skills</h1>
      <span></span>
          
      <!-- Skills field --> 
      <section>
        <ul>
          <li>
            <input type='text' name='mainName' placeholder='Le titre' pattern='[a-z0-9]{0,20}' required autofocus/>
          </li>
          <li>
            <input type='text' name='subName' placeholder='Sous-titre' pattern='[a-z0-9]{0,20}' required />
          </li>
          <li>
            <input type='text' name='domain' placeholder='Le domain' pattern='[a-z0-9]{0,20}' required />
          </li>
          <li>
            <input type= "range" name="level" min = "0" max = "8" step = "1" value = "8" required />
          </li>
          <li>
            <input type= "color" value="#FF0000" />
          </li>
          <li>
            <button id= "btnOK" type='submit'  > OK</button>
          </li>
        </ul>
      </section>
    </div>
  </body>
</html>
