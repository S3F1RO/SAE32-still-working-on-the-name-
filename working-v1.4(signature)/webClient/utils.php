<?php
////////////////////////////////////////////////////////////////////////////////
// Utils library
////////////////////////////////////////////////////////////////////////////////



  // Generate random string
  function generateRandomString($length=100) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';
    for ($i = 0 ; $i < $length ; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }

  // SUCCESS / FAIL functions
  function success($fields=[], $html=NULL, $obj=NULL) {
    // Merge
    $out = array_merge(["success"=>true, "html"=>$html, "obj"=>$obj], $fields);

    // Data ajax to client
    echo json_encode($out);
    exit();
  }

  function fail($html=NULL, $fields=[]) {
    // Merge
    $out = array_merge(["success"=>false, "html"=>$html], $fields);

    // Data ajax to client
    echo json_encode($out);
    exit();
  }

  function logout($db=NULL, $result=NULL) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Logout
    header("Location: logout.php");
    exit();
  }

  function redirect($page, $db=NULL, $result=NULL) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Logout
    header("Location: $page");
    exit();
  }
  
  function sendAjax(string $url, array $data): array {
    // Convertion to JSON
    $jsonPayload = json_encode($data);

    // Prepare cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // JSON Headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json",
      "Content-Length: " . strlen($jsonPayload)
    ]);

    // Run query
    $response = curl_exec($ch);

    // cURL error
    if ($response == false) {
      return null;
    }

    curl_close($ch);

    // Return the decoded JSON response
    $decoded = json_decode($response, true);

    if ($decoded != null) {
      return $decoded;
    } else {
      return null;
    }
  }
  
  function sendAjaxTxt(string $url, string $data): array {

    // Prepare cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // JSON Headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json",
      "Content-Length: " . strlen($data)
    ]);

    // Run query
    $response = curl_exec($ch);

    // cURL error
    if ($response == false) {
      return null;
    }

    curl_close($ch);

    // Return the decoded JSON response
    $decoded = json_decode($response, true);

    if ($decoded != null) {
      return $decoded;
    } else {
      return null;
    }
  }

  function escape_string($str) {
    $search  = ["\\",   "\x00", "\n",  "\r",  "'",   '"',  "\x1a"];
    $replace = ["\\\\", "\\0",  "\\n", "\\r", "\\'", '\\"', "\\Z"];
    return str_replace($search, $replace, $str);
  }
  
  function debug($debugItem="debug") {
    echo json_encode(["debug"=>"fonctionnel","requiredItem"=>$debugItem]);
    exit();
  }

  function dateInFr(string $dateString): string {
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
    if (!$date) {
      return '';
    }

    // Month in French
    $month = [
      1 => 'janv.',
      2 => 'févr.',
      3 => 'mars',
      4 => 'avr.',
      5 => 'mai',
      6 => 'juin',
      7 => 'juil.',
      8 => 'août',
      9 => 'sept.',
      10 => 'oct.',
      11 => 'nov.',
      12 => 'déc.'
    ];

    $day = (int) $date->format('j');
    $monthNbr = (int) $date->format('n');
    $year = $date->format('Y');

    // 1st day of the month
    if ($day == 1) $day = "1er";

    return $dayStr . ' ' . $month[$monthNbr] . ' ' . $year;
  }

  function sendAjaxImg(string $url, array $data, array $files = null): array {
    // Prepare cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //With img
    if ($files !== null) {

        foreach ($files as $key => $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $data[$key] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
            }
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // JSON Headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/json",]);

      //sans img
    } else {
      $jsonPayload = json_encode($data);

      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
          "Content-Type: application/json",
          "Content-Length: " . strlen($jsonPayload)
      ]);
    }

    // Run query
    $response = curl_exec($ch);

    // cURL error
    if ($response == false) {
      return null;
    }

    curl_close($ch);

    // Return the decoded JSON response
    $decoded = json_decode($response, true);

    if ($decoded != null) {
      return $decoded;
    } else {
      return null;
    }
  }

?>
