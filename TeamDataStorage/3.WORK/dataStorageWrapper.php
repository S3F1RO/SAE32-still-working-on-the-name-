<?php

    include_once("./dataStorage.php");


    function verifyData($pubU, $InfosHashCryptPrivU, $data) {
        // $pubU = base64_decode($pubU);
        // Creates private and public key
        $res = openssl_pkey_new(['private_key_bits' => 2048]);
        openssl_pkey_export($res, $privU);
        $pubU = openssl_pkey_get_details($res)['key'];

//         $privU = ;

//         $pubU = "-----BEGIN PUBLIC KEY-----
// MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArtIWtdFLWu31qjeLZIN0
// JbHsP+m32pihhLyP5xDftnVTx9naQvLvj1ehoz8ClHvvS2TZZP7tQZ5fZ/42niZY
// po2l7cxbYSVEZhVdSvEuTNGlZJSXq8RHT8xE47OVr3SJnnIkFEVtRbQVj2vNxfr+
// nzqOA/NivdyycBSnVwHEojUpVLySfTacdXj4SkEj/OST0P6zvBa6RQyqWERQZ1V0
// tEnTaGc/SGHhsn7N0TmM4DbPXcW0/W5k6gYeNjDpWmbVxiYA9jHfiGf+ejMc/twB
// RJIFmCdDUmDLxI1W89Mw+eJ36DrD0TPXTXFrdQXShoONp2pFcLqgck0mr3Q5tlnK
// MQIDAQAB
// -----END PUBLIC KEY-----";
        
        // Creates false private and public key
        // $falseRes = openssl_pkey_new(['private_key_bits' => 2048]);
        // openssl_pkey_export($falseRes, $falsePrivU);
        // $falsePubU = openssl_pkey_get_details($falseRes)['key'];

        // Encoding for test
        openssl_sign($data, $signature, $privU, OPENSSL_ALGO_SHA256);
        $InfosHashCryptPrivU = base64_encode($signature);

        // Decode
        echo $privU . "\n\n";
        echo $pubU . "\n\n";
        echo $InfosHashCryptPrivU . "\n\n";
        
        $pubU = base64_decode($pubU);
        $InfosHashCryptPrivU = base64_decode($InfosHashCryptPrivU);
        $pubU = openssl_pkey_get_public($pubU);

        echo $data . "\n\n";

        $InfosHashCryptPrivU = base64_decode($InfosHashCryptPrivU);
        if (openssl_verify($data, $InfosHashCryptPrivU, $pubU, "sha256WithRSAEncryption")){
            echo "true\n";
            return true;
        }else{
            return false;
        }
        
        // Asym verify data : (dataA, dataAHashSignPrivA, pubA) --> (isDataAVerified)
    }

    function addVerifiedUser(string $firstName, string $lastName, string $nickname, string $pubU, string $userInfosHashCryptPrivU) {
        $data = $firstName . $lastName . $nickname . $pubU;
        if (verifyData($pubU, $userInfosHashCryptPrivU, $data)) {
            return DataStorage::addUser($firstName, $lastName, $nickname, $pubU, $userInfosHashCryptPrivU);
        } else {
            return false;
        }
    }

    function addVerifiedSkill(string $idUCreator, string $mainName, string $subName, string $domain, int $level, string $imgUrl, string $color, string $skillInfosHashCryptPrivUC, string $pubU) {
        $data = $idUCreator . $mainName . $subName . $domain . $level . $imgUrl . $color;
        if (verifyData($pubU, $skillInfosHashCryptPrivUC, $data)) {
            return DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color, $skillInfosHashCryptPrivUC);
        } else {
            return false;
        }
    }

    function addVerifiedCompetence(string $idUTeacher, string $idUStudent, string $idSkill, string $revokedDate, int $masteryLevel, string $competenceInfosHashCryptPrivUT, string $pubU) {
        $data = $idUTeacher . $idUStudent . $idSkill . $revokedDate . $masteryLevel . $competenceInfosHashCryptPrivUT;
        if (verifyData($pubU, $competenceInfosHashCryptPrivUT, $data)) {
            return DataStorage::addCompetence($idUTeacher, $idUStudent, $idSkill, $revokedDate, $masteryLevel, $competenceInfosHashCryptPrivUT);
        } else {
            return false;
        }

    }

    function getVerifiedUser($idUser) {
        $user = DataStorage::getUser($idUser);
        $data = $user["idUser"] . $user["firstName"] . $user["lastName"] . $user["nickname"];
        if (verifyData($user["pubU"], $user["userInfosHashCryptPrivU"], $data)) {
            return $user;
        } else {
            return false;
        }
    }

    function getVerifiedSkill($idSkill) {
        $skill = DataStorage::getFullSkill($idSkill);
        $data = $skill["idSkill"] . $skill["idUCreator"] . $skill["mainName"] . $skill["subName"] . $skill["domain"] . $skill["level"] . $skill["imgUrl"] . $skill["color"];
        if (verifyData($skill["creator"]["pubU"], $skill["skillInfosHashCryptPrivUC"], $data)) {
            return $skill;
        } else {
            return false;
        }
    }


    function getVerifiedCompetence($idCompetence) {
        $competence = DataStorage::getFullCompetence($idCompetence);
        $data = $competence["idCompetence"] . $competence["idUTeacher"] . $competence["idUStudent"] . $competence["idSkill"] . $competence["beginDate"] . $competence["revokedDate"] . $competence["masteringLevel"];
        if (verifyData($competence["teacher"]["pubU"], $competence["competenceInfosHashCryptPrivUT"], $data)) {
            return $competence;
        } else {
            return false;
        }
    }    

    function getVerifiedCompetences($idCompetences) {
        $competences = [];
        foreach ($idCompetences as $idCompetence) {
            $competences[] = getVerifiedCompetence($idCompetence);
        }
        return $competences;      
    }

    function getVerifiedSkills($idSkills){
        $skills = [];
        foreach ($idSkills as $idSkill){
            $skills[] = getVerifiedSkill($idSkill);
        }
        return $skills;
    }

    function getStudentVerifiedCompetences($idUStudent){
        $studentCompetences = [];
        $studentIdCompetences = DataStorage::getStudentIdCompetences($idUStudent);
        foreach ($studentIdCompetences as $studentIdCompetence) {
            $studentCompetences[] = getVerifiedCompetence($studentIdCompetence);
        }
        return $studentCompetences;
    }  
    
    function getTeacherVerifiedCompetences($idUTeacher){
        $teacherCompetences = [];
        $teacherIdCompetences = DataStorage::getTeacherIdCompetences($idUTeacher);
        foreach ($teacherIdCompetences as $teacherIdCompetence) {
            $teacherCompetences[] = getVerifiedCompetence($teacherIdCompetence);
        }
        return $teacherCompetences;
    }

    function getCreatorSkills($idUCreator){
        $creatorSkills = [];
        $creatorIdSkills = DataStorage::getCreatorIdSkills($idUCreator);
        foreach ($creatorIdSkills as $creatorIdSkill) {
            $creatorSkills[] = getVerifiedSkill($creatorIdSkill);
        }
        echo $InfosHashCryptPrivU;
        return $creatorSkills;
    }

    print_r(getVerifiedCompetence("15"));
    // print_r(verifyData("1","2","3"));

?>