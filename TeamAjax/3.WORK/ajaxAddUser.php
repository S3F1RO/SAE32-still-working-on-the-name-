<?php
include_once('./utils.php');
include_once('./params.php');

// Default error message
$html = "<span>Prénom, nom ou pseudo invalide</span>";

// Check if data has been received
if (!isset($_POST['data'])) {
    echo json_encode([
        "success" => false,
        "html" => $html
    ]);
    exit();
}

// Decode the sent JSON data
$data = json_decode($_POST['data'], true);

// Initialize variables
$firstName = NULL;
$lastName  = NULL;
$nickname = NULL;

// Retrieving values
if (isset($data['firstName'])) {
    $firstName = $data['firstName'];
}
if (isset($data['lastName'])) {
    $lastName = $data['lastName'];
}
if (isset($data['nickname'])) {
    $nickname = $data['nickname'];
}

// Check validity
if ($firstName == NULL || $lastName == NULL || $nickname == NULL) {
    fail(NULL, NULL, $html);
}

// AJAX response sent to JavaScript
$data = sendAjax($URL . "svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname]);

// Everything went well → SUCCESS
success(NULL, NULL, NULL, NULL, ["id" => $response["id"]]);


?>
