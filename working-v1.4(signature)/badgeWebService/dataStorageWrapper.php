<?php

    include_once("./dataStorage.php");


    function verifyData($pubU, $InfosHashCryptPrivU, $data) {
        /* -----------------
          test generate keys
        ------------------*/
        // $pubU = base64_decode($pubU);
        // Creates private and public key
        // $res = openssl_pkey_new(['private_key_bits' => 2048]);
        // openssl_pkey_export($res, $privU);
        // $pubU = openssl_pkey_get_details($res)['key'];

        /* ---------------------
          test with defined keys 
        ----------------------*/
//         $privU = "-----BEGIN PRIVATE KEY-----
// MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCu0ha10Uta7fWq
// N4tkg3Qlsew/6bfamKGEvI/nEN+2dVPH2dpC8u+PV6GjPwKUe+9LZNlk/u1Bnl9n
// /jaeJlimjaXtzFthJURmFV1K8S5M0aVklJerxEdPzETjs5WvdImeciQURW1FtBWP
// a83F+v6fOo4D82K93LJwFKdXAcSiNSlUvJJ9Npx1ePhKQSP85JPQ/rO8FrpFDKpY
// RFBnVXS0SdNoZz9IYeGyfs3ROYzgNs9dxbT9bmTqBh42MOlaZtXGJgD2Md+IZ/56
// Mxz+3AFEkgWYJ0NSYMvEjVbz0zD54nfoOsPRM9dNcWt1BdKGg42nakVwuqByTSav
// dDm2WcoxAgMBAAECggEAHm38PP6mxreX5N6ROVg2Td9n94IHmhmqN7AYvkguIJTQ
// lf9iIfgmYcWHoaI0oULnVrDBtHY5NwxJoBDcUe/ry2XphXhmSYUSoFBEsmhDvmRZ
// jSXeNqxOG2I7dYULX4SB9d35ULv69sCPZi0GHtl/G5k2IhLp05GIT8EQlbD9mJwt
// m13b43emYiSq3TPvFnJxI2/5sn0/RgRg9tAwZRlqcrm8gOaDvmEM/rHBWqVBiX7q
// AvavRr6cg3rMPI7ya85rsnQCwy3JIJ3ZdIMolUXVj62FWsmnaZUQLBF2vC8OQvu4
// eCfIamfAskUKED3SoKyuqg8YMDHJXF8Yfc+Obg1ZSQKBgQDai9K9l41j3R3+c0lR
// m1c+qj7plauO2x64r8IemgcLCAXRFVd0KtrOUbmpTAtfi3XGeCaiYoZg8bTlsl+G
// vEvLW/+KajukVgNWeuXahACsq8uPtc0EVHollDWJBsE654vx0qc9qy81JM9/+3Lu
// bS6igRcKzim1Vmr4dC7Fr+YyVQKBgQDMx+pgLvQlHASN1RCoaxmoGO8X0gpRY8+P
// C+jCF/NYOLjbLwJb6NQkZ8+iBp6pDlKoHCwFhft0hc2bw99pWwVLf1pJXjPqa9rX
// llombgLMHokD6KLLZvX4jpUeYAUDhjyjgflCqb7FaeMA6Uz9Mx8Bu0YhAv9LiTUp
// INK0fzDsbQKBgDbnCXo3qH19/xr9O14U+EX13vgvcXnh8kXTYaDucPaEfXGZOu8k
// FPPf9BRj1jeagWvqo0oIFlokXp2VwgnHJANiiT/skC8orI39MeFDaCf4wJrJwUdl
// MYpfQVO7Lq/tm2qU0Q7dAm8HYFl2gdkD9MM+StucDz5PB3CDP3zKQ7pBAoGBAIt/
// U+WZlq8A2wlTLznLW3rrIVR0vJqdB3NGhZRShG6AlUyaRV0eygTSwtp47/Px0dS6
// /DH3B0hlLZ8CW1qFqqG3a2W3Sl5Sgo2B2n97SWSLGIMVInC0/rIHTwWWG1Q/SWeI
// zqfewhnw+7ZPNyb0gBbJ4Af05rwqB5Cwz1gtnMIxAoGAT7nTCPQhhzQQB8tYfHJQ
// miPwmQh4gvsTHCD4PGr1jbmZ3/CMh4h/xIWw4MlLU3UlE8O6KQUHOYcxNZLMXAo4
// NS3omrKpGbHhSU1CzhHqcoc/A3V1pZ6afCGXWHBvB6Q/ClF4Yo+6oNOSa7RHKHS8
// hc1UrbA2fOgvz5w1Fk+CByk=
// -----END PRIVATE KEY-----";

//         $pubU = "-----BEGIN PUBLIC KEY-----
// MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArtIWtdFLWu31qjeLZIN0
// JbHsP+m32pihhLyP5xDftnVTx9naQvLvj1ehoz8ClHvvS2TZZP7tQZ5fZ/42niZY
// po2l7cxbYSVEZhVdSvEuTNGlZJSXq8RHT8xE47OVr3SJnnIkFEVtRbQVj2vNxfr+
// nzqOA/NivdyycBSnVwHEojUpVLySfTacdXj4SkEj/OST0P6zvBa6RQyqWERQZ1V0
// tEnTaGc/SGHhsn7N0TmM4DbPXcW0/W5k6gYeNjDpWmbVxiYA9jHfiGf+ejMc/twB
// RJIFmCdDUmDLxI1W89Mw+eJ36DrD0TPXTXFrdQXShoONp2pFcLqgck0mr3Q5tlnK
// MQIDAQAB
// -----END PUBLIC KEY-----";

        // // Encoding for test
        // openssl_sign($data, $signature, $privU, OPENSSL_ALGO_SHA256);
        // $InfosHashCryptPrivU = base64_encode($signature);

        // // Decode
        // echo $privU . "\n\n";
        // echo $pubU . "\n\n";
        // echo $InfosHashCryptPrivU . "\n\n";
        
        // $pubU = base64_decode($pubU);
        // $pubU = openssl_pkey_get_public($pubU);
        
        $InfosHashCryptPrivU = base64_decode($InfosHashCryptPrivU);
        $pubU = base64_decode($pubU);
        // echo $data . "\n\n";

        if (openssl_verify($data, $InfosHashCryptPrivU, $pubU, OPENSSL_ALGO_SHA256)){
            return true;
        } else {
            return false;
        }
        
        // Asym verify data : (dataA, dataAHashSignPrivA, pubA) --> (isDataAVerified)
    }

    function addVerifiedUser(string $firstName, string $lastName, string $nickname, string $pubU, string $userInfosHashCryptPrivU) {
        $data = $firstName . $lastName . $nickname . $pubU;
        if (verifyData($pubU, $userInfosHashCryptPrivU, $data)) {
            return DataStorage::addUser($firstName, $lastName, $nickname, $pubU, $userInfosHashCryptPrivU);
        } else {
            return NULL;
        }
    }

    function addVerifiedSkill(string $idUCreator, string $mainName, string $subName, string $domain, int $level, string $imgUrl, string $color, string $skillInfosHashCryptPrivUC) {
        $data = $idUCreator . $mainName . $subName . $domain . $level . $color;
        $pubUC = getVerifiedUser($idUCreator)["pubU"];
        if (verifyData($pubUC, $skillInfosHashCryptPrivUC, $data)) {
            return DataStorage::addSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color, $skillInfosHashCryptPrivUC);
        } else {
            return NULL;
        }
    }

    function addVerifiedCompetence(string $idUTeacher, string $idUStudent, string $idSkill, string $beginDate, string $revokedDate, int $masteringLevel, string $competenceInfosHashCryptPrivUT) {
        $data = $idUTeacher . $idUStudent . $idSkill . $beginDate . $revokedDate . $masteringLevel;
        $pubUT = getVerifiedUser($idUTeacher)["pubU"];

        // Check if the Teacher can give this skill
        $isTeacher = false;
        $competences = getStudentVerifiedCompetences($idUTeacher);
        $skill = getVerifiedSkill($idSkill);
        foreach ($competences as $competence) {
          if ($competence["masteringLevel"] == 4) {
            $isTeacher = true;
          }
        }
        
        if (($isTeacher || $skill["idUCreator"] == $idUTeacher) && verifyData($pubUT, $competenceInfosHashCryptPrivUT, $data)) {
            return DataStorage::addCompetence($idUTeacher, $idUStudent, $idSkill, $beginDate, $revokedDate, $masteringLevel, $competenceInfosHashCryptPrivUT);
        } else {
            return NULL;
        }
    }

    function getVerifiedUser($idUser) {
        $user = DataStorage::getUser($idUser);
        $data = $user["firstName"] . $user["lastName"] . $user["nickname"] . $user["pubU"];
        if (verifyData($user["pubU"], $user["userInfosHashCryptPrivU"], $data)) {
            return $user;
        } else {
            return NULL;
        }
    }

    function getVerifiedSkill($idSkill) {
        $skill = DataStorage::getFullSkill($idSkill);
        $data = $skill["idUCreator"] . $skill["mainName"] . $skill["subName"] . $skill["domain"] . $skill["level"] . $skill["color"];
        if (verifyData($skill["creator"]["pubU"], $skill["skillInfosHashCryptPrivUC"], $data)) {
            return $skill;
        } else {
            return NULL;
        }
    }


    function getVerifiedCompetence($idCompetence) {
        $competence = DataStorage::getFullCompetence($idCompetence);

        $dataCompetence = $competence["idUTeacher"] . $competence["idUStudent"] . $competence["idSkill"] . $competence["beginDate"] . $competence["revokedDate"] . $competence["masteringLevel"];
        $dataUTeacher = $competence["teacher"]["firstName"] . $competence["teacher"]["lastName"] . $competence["teacher"]["nickname"] . $competence["teacher"]["pubU"];
        $dataUStudent = $competence["student"]["firstName"] . $competence["student"]["lastName"] . $competence["student"]["nickname"] . $competence["student"]["pubU"];
        $dataSkill = $competence["skill"]["idUCreator"] . $competence["skill"]["mainName"] . $competence["skill"]["subName"] . $competence["skill"]["domain"] . $competence["skill"]["level"] . $competence["skill"]["color"];

        $isCompetenceVerified = verifyData($competence["teacher"]["pubU"], $competence["competenceInfosHashCryptPrivUT"], $dataCompetence);
        $isTeacherVerified = verifyData($competence["teacher"]["pubU"], $competence["teacher"]["userInfosHashCryptPrivU"], $dataUTeacher);
        $isStudentVerified = verifyData($competence["student"]["pubU"], $competence["student"]["userInfosHashCryptPrivU"], $dataUStudent);
        $isSkillVerified = verifyData($competence["skill"]["creator"]["pubU"], $competence["skill"]["skillInfosHashCryptPrivUC"], $dataSkill);

        if ($isCompetenceVerified && $isTeacherVerified && $isStudentVerified && $isSkillVerified) {
            return $competence;
        } else {
            return NULL;
        }
    }    

    function getVerifiedCompetences($idCompetences) {
        $competences = [];
        foreach ($idCompetences as $idCompetence) {
            $competence = getVerifiedCompetence($idCompetence);
            if ($competence != NULL) $competences[] = $competence;
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
        $studentIdCompetences = DataStorage::getStudentIdCompetences($idUStudent);
        $studentCompetences = getVerifiedCompetences($studentIdCompetences);
        return $studentCompetences;
    }  
    
    function getTeacherVerifiedCompetences($idUTeacher){
        $teacherIdCompetences = DataStorage::getTeacherIdCompetences($idUTeacher);
        $teacherCompetences = getVerifiedCompetences($teacherIdCompetences);
        return $teacherCompetences;
    }

    function getCreatorVerifiedSkills($idUCreator){
        $creatorSkills = [];
        $creatorIdSkills = DataStorage::getCreatorIdSkills($idUCreator);
        foreach ($creatorIdSkills as $creatorIdSkill) {
            $creatorSkills[] = getVerifiedSkill($creatorIdSkill);
        }
        return $creatorSkills;
    }

    // print_r(getCreatorVerifiedSkills("2"));
    // print_r(verifyData("1","2","3"));

?>