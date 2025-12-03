<?php
include_once('./utils.php');

if (!isset($_POST['data'])) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit();
}

// Data from Client
$data = json_decode($_POST['data'], true);

$response = sendAjax(
    "http://localhost/SAE32/TeamAjax/3.WORK/svcAddSkill.php",
    [
        "idUCreator" => 1,
        "mainName"   => $data["mainName"],
        "subName"    => $data["subName"],
        "domain"     => $data["domain"],
        "level"      => $data["level"],
        "color"      => $data["color"]
    ]
);
echo json_encode(["id"=>$response['id']]);

?>
