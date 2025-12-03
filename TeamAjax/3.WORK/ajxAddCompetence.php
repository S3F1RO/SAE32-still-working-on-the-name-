<?php
include_once('./utils.php');

if (!isset($_POST['data'])) {
    echo json_encode(["success" => false, "message" => "Aucune donnée reçue"]);
    exit();
}
$data = json_decode($_POST['data'], true);

$response = sendAjax(
    "http://localhost/SAE32/TeamAjax/3.WORK/svcAddCompetence.php",
    [
        "idUTeacher"     => $data["idUTeacher"],
        "idUStudent"     => $data["idUStudent"],
        "idSkill"        => $data["idSkill"],
        "masteringLevel" => $data["masteringLevel"],
        "currentDate"    => $data["currentDate"]
    ]
);

echo json_encode($response);
?>
