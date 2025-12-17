<?php 

function generateSticker($color,$level,$masteryLevel,$file,$title,$subtitle,$domain,$idCompetence,$beginDate,$teacherName){
    $cmd="./generateSticker.sh $color $level $masteryLevel '$file' '$title' '$subtitle' '$domain' '$idCompetence' '$beginDate' '$teacherName' ";
    exec($cmd,$output,$returncode);
    for ($i=0; $i<count($output); $i++){
        echo "<li>$output[$i]</li>";
    }
}

function generateQrCode($id,$isUser=true,$textTitle="Utilisateur"){
    if ($isUser) $textTitle="Utilisateur";
    else $textTitle="Compétence";
    $cmd="./generateUserSticker.sh $id $isUser $textTitle";
    exec($cmd,$output,$returncode);
    for ($i=0; $i<count($output); $i++){
        echo "<li>$output[$i]</li>";
    }
}
generateSticker("00ccff",1,3,"giveMeTheZuck",'The','ZUCK','SAE67','KR-1209','2025','Sulyvan');
generateQrCode("67");
generateQrCode("41",false);

?>