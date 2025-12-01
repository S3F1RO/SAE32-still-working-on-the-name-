<?php
include_once('./utils.php');

if (!isset($_POST['data'])) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit();
}

$data = json_decode($_POST['data'], true);

$response = sendAjax(
    "http://localhost/SAE32/TeamAjax/3.WORK/svcAddSkill.php",
    [
        "idUCreator" => $data["idUCreator"],
        "mainName"   => $data["mainName"],
        "subName"    => $data["subName"],
        "domain"     => $data["domain"],
        "level"      => $data["level"],
        "imgUrl"     => $data["imgUrl"],
        "color"      => $data["color"]
    ]
);

echo json_encode($response);
?>
