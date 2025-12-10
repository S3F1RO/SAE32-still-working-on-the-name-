<?php 
$cmd="./test.sh";
$cmd="./generateSticker.sh 00ccff 8 3 logoD 'Full' 'Test' 'SAE32' 'KR-7777' '2025' 'Sulyvan'";

function generateSticker($color,$level,$masteryLevel,$file,$title,$subtitle,$domain,$idCompetence,$beginDate,$teacherName){
    $cmd="./generateSticker.sh $color $level $masteryLevel '$file' '$title' '$subtitle' '$domain' '$idCompetence' '$beginDate' '$teacherName' ";
    exec($cmd,$output,$returncode);
    for ($i=0; $i<count($output); $i++){
        echo "<li>$output[$i]</li>";
    }
}

generateSticker("00ccff",1,3,"logoD",'Full','Strike','SAE32','KR-7778','2025','Sulyvan');

?>