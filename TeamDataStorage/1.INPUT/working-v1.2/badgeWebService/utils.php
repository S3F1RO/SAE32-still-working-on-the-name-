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
  function success($db=NULL, $result=NULL, $html=NULL, $obj=NULL, $fields=[]) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Merge
    $out = array_merge(["success"=>true, "html"=>$html, "obj"=>$obj], $fields);

    // Data ajax to client
    echo json_encode($out);
    exit();
  }
  function fail($db=NULL, $result=NULL, $errorMsg=NULL) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Data ajax to client
    echo json_encode(array("success"=>false, "errorMsg"=>$errorMsg));
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
  
  function escape_string($str) {
    $search  = ["\\",   "\x00", "\n",  "\r",  "'",   '"',  "\x1a"];
    $replace = ["\\\\", "\\0",  "\\n", "\\r", "\\'", '\\"', "\\Z"];
    return str_replace($search, $replace, $str);
  }

?>
