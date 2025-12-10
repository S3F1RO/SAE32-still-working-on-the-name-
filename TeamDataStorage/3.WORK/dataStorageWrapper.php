<?php

    include_once("./dataStorage.php");


    function verifyData($pubU, $InfosHashCryptPrivU, $data) {
        // Decode
        $InfosHashCryptPrivU = base64_decode($InfosHashCryptPrivU);
        $pubU = base64_decode($pubU);

        // Asym verify data : (dataA, dataAHashSignPrivA, pubA) --> (isDataAVerified)
        return openssl_verify($data, $userInfosHashSignPrivU, $pubU, "sha256WithRSAEncryption");
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
        $data = $user["id"] . $user["firstName"] . $user["lastName"] . $user["nickname"] . $user["pubU"];
        if (verifyData($user["pubU"], $user["userInfosHashCryptPrivU"], $data)) {
            return $user;
        } else {
            return false;
        }
    }

    function getVerifiedSkill($idSkill) {
        $skill = DataStorage::getFullSkill($idSkill);
        $data = $skill["id"] . $skill["mainName"] . $skill["subName"] . $skill["domain"] . $skill["level"] . $skill["imgUrl"] . $skill["color"];
        if (verifyData($skill["creator"]["pubU"], $skill["skillInfosHashCryptPrivUC"], $data)) {
            return $skill;
        } else {
            return false;
        }
    }


    function getVerifiedCompetence($idCompetence) {
        $competence = DataStorage::getFullCompetence($idCompetence);
        $data = $competence["id"] . $competence["idUTeacher"] . $competence["idUStudent"] . $competence["revokedDate"] . $competence["masteryLevel"];
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
?>