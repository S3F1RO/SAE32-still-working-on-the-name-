<?php
include_once('./utils.php');
include_once('./params.php');

  $html = "<span>Information(s) invalide(s) ou manquante(s)</span>";
  // Data from session
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];

  // Check
  if ($idUser == NULL) {
    echo json_encode([
      "success" => false,
      "html" => $html
    ]);
    exit();
  }

// Check if the data is arriving correctly
if (!isset($_POST['data'])) {
    echo json_encode([
      "success" => false,
      "html" => $html
    ]);
    exit();
}

// Decode the data sent by the JS
$data = json_decode($_POST['data'], true);

// Verify that all expected data exists
if (!isset($data["mainName"]) ||
    !isset($data["domain"])   ||
    !isset($data["level"])    ||
    !isset($data["color"])) 
{
    echo json_encode([
        "success" => false,
        "html" => $html
    ]);
    exit();
}
// Secure value retrieval
$mainName   = $data["mainName"];
$subName    = $data["subName"];
$domain     = $data["domain"];
$level      = $data["level"];
$color      = $data["color"];

// ----- Send to WebService -----
$response = sendAjax(
    $URL . "svcAddSkill.php",
    [
        "idUCreator" => $idUser,
        "mainName"   => $mainName,
        "subName"    => $subName,
        "domain"     => $domain,
        "level"      => $level,
        "color"      => $color,
    ]
);

// Check the server response
if (!isset($response["id"])) {
  fail(NULL, NULL, $html);
}

// Final response for JS
success(NULL, NULL, NULL, NULL, ["id" => $response["id"]]);

?>
