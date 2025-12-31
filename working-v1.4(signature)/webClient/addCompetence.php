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
  $_SESSION['idUser'] = 53;
  $_SESSION['privU'] = "LS0tLS1CRUdJTiBQUklWQVRFIEtFWS0tLS0tCk1JSUV2UUlCQURBTkJna3Foa2lHOXcwQkFRRUZBQVNDQktjd2dnU2pBZ0VBQW9JQkFRRHlGV09jMGtWbmhDQVoKa25vVkpUNFAyQ292UkpYVmt5UG1qV1pYS3lhWTRGM1VqVVNBblNLejlZRkJWdDF5aFFWdSt6c1JMYnpWNzhLUworQ3FKekp0MGkyRzYyZmkrMmVDaFVUUk5rbnQ3WWdBTUtXZEFuVmU1S1lNendGN1lLMCtjTHZtS05wZTRZTm1OCnd3bGRzRllzV0crSTdpRUZSb3RzdVF3dHI3UVh5UlNqVk9iRU1BVjQrajVrdXhYeUVJaWpnNVFzU2NCS2pvS2kKcTY4bEpqTVUzeVcvU1hpdkZpb2JwUVRPZW1YZy9QSGJlZ1pjcVFUdjJxcFA3ZWU4aGxIdUlQMjAyL0xOSEUzdQp3RHZqTk5uRmJsM003QlVOWXhVelRtTFBYUkZCRU1xVDVFaXBmeTd0UHpoTU5YYi9sK2FjQmtKY1ladi80eGNkCjFJRGdZa0ViQWdNQkFBRUNnZ0VBQVRvZ240TkFrOEt6SGMrWEhoQ0RCaDI2QUtIUE9QL1NINGJDbjVBREdPM3gKMVBSRDRaUEZ3T0MzbVVybXFjbGVRTHJteTZaYVhld0EwSHJaS2hDQTlpdWFIMmVUMGc1L2hiK0ZKZCtDM3pLUQp1elhvT3IzbXd5c0lDRnlsRWp5VHJjWTUyUUtrci9JdlFIK08zdUdQRkZzNTAvcm5IYWpmWjNuZCtvSGdXSlBYCmlmL3IxM3I1TU1mdFBEamdBbzEveUVmUVdvMGtBZG12T0dTNDVJd3JxTWxIYWFzdUN6bit1NEsxcFNvUC9jL08KYkRobDNTZVNTVk5wODhhVW5UZDhDSjdWS0I1Y1E5YjRFdURvU3FCY1BaTlpMMHhKcDcrZ044eFhobzZPdCtITgo0MEErSHRjQ0tSUnBWcWpQOTl0OUEva3lTd1ArL2llZUVnN0QxOVk4QVFLQmdRRDZhTHdLMFQ4M2pUS2NLYVIzCmRNMDhpWStUM0NMYkNEWHh1SmlsdUZ6cmZqV0pVUm5lNWovY1hHV2t3VFQ4dWlBajRtanFCeEpQM3NiRWErcmcKaWtUdnBObjhJNG1TVzd1QXlWVVR4NkQ4UWNWZS9LRDl5ZjEzR1ErOUxjNURKOExQVFVWSDVDbDBCbzdydmliSwpybU5KVzhXeWt6Mlp3NTQ1RGZGbVA1cDVzd0tCZ1FEM2ZSRnIrRUhtNnVzM3NhNnBEd2toZTNCSWVOWE45cDdKCmNRU0tnRjdZVWE2OStiRktSMWJaVzM1OENmazNvbEl6clZvU3hWMENkNHdXWGxFYzdqZFJ3OWJQbGo2TzVPZDUKT2hmNjBNelAxc1FVUXE1M1lkS1BrdW9IelFSSDlrSjlRRzNNb2tOWU1PUGQyNnB5UW9GTW8yUS9DUDNEZzRGUgpVbE5ta1dHVytRS0JnRkpVR3ZjSGd0eFZ6UHp3NkFUcVh3djNRa0JmMFFub2NpdnVBQ29FS25DMmh3MkZuNWJjClpzU2hrRDJSMUVUL1FNL3JnWWpvR0Vvd09YT2M4NVV0Z0txMXJZR3JnWENnUGs2Q1l6bGttZlkxL1psVVArNFEKK2dldE1yS0ZHOXFTZVFkRkpYRVVmOWlJeTNhUWh4cCtLV0NXRHJLK25ETXcwSlY3a3hHRitkam5Bb0dCQUxOTwpuK0t6K1R0T2xLRERVU0lYVEt3L2ZMaGxJN0tYcmErUS9KTkVNbk5UcXVEbEdUZ1J1N0M3QTBibkN2THQzZFNuCkVnMXJoTm1XdDU0MU0xdGNsQ1BmV2JFSXo4WkR2aGtzcDljR2xIMDR3dE5UQklobURXSU1OUmIxeU5aQ2F5WEkKR2tVYWd1UlFkNmR6MFdmN0d5YmxjbW5oSDhvWmF3WDZPWWFrYWlveEFvR0FMZU12ZWx3aVhNSmdGaVB2OWhnbApuNW5YNnM4ckN0L0JJNDY1Qjl1eGR1ejZ4RFI3Sk5BM0lyRktLdnRYVVhVUnRuRlpKL1VmMVVQeTBoNEJ5YWNUClZNTGo1cm5EKzVFcnlxNk1DWVFUQ0Fxc0ZPOWdDbTU0UUFsNXlXL29LeTd2Und6NU1PdWZSTzhsUnRUaVJnTGEKbDNMaU9INExab3JmRm0zS0lwR2hJaE09Ci0tLS0tRU5EIFBSSVZBVEUgS0VZLS0tLS0K";

  $idSkill = 25; // To modify later too

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no">

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/RTSAE.png'/>

    <!-- Title -->
    <title>Compétence</title>
  </head>

  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <div class='wrapper'>

      <h1>Ajout d'une compétence</h1>

      <!-- User field -->
     <span></span>
     
      <article>
        <ul>
          <li>
            <input name="idSkill" style="display:none" type="number" value="<?=$idSkill?>">
          </li>
          <li>
            <input name="idUStudent" type="number" placeholder="id student" required>
          </li>

          <li>
            <select name="masteringLevel" size = "1">
              <option value="1" selected> Comprise </option>
              <option value="2"> Acquise </option>
              <option value="3"> Maîtrisée </option>
              <option value="4"> Enseignée </option>
            </select >
          </li>
  
          <li>
            <input name="revokedDate" type = "date" min = "2025" max = "2047"/>
          </li>
  
          <li>
            <button class="ok">OK</button>
          </li>
        </ul>
      </article>
    </div>
  </body>
</html>
