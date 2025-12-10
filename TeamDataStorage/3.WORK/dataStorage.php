<?php

include_once("./utils.php");

class DataStorage {
    //ADD User
    static function addUser(string $firstName, string $lastName, string $nickname, string $pubU, string $userInfosHashCryptPrivU) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB insert
        $query = "INSERT INTO tblUsers (id ,firstName, lastName, nickname, pubU, userInfosHashCryptPrivU) VALUES (NULL , '$firstName', '$lastName', '$nickname' '$pubU', '$userInfosHashCryptPrivU');";
        $success = $db->query($query);

        // Check
        if (!$success) {
            return false;
        }
        $lastInsertedId = $db->insert_id;

        $db->close();
        
        return $lastInsertedId;
        // DB close
    }

    //ADD Skill
    static function addSkill(string $idUCreator, string $mainName, string $subName, string $domain, int $level, string $imgUrl, string $color, string $skillInfosHashCryptPrivUC ) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB insert
        $query = "INSERT INTO tblSkills (id ,idUCreator, mainName, subName, domain, level, imgUrl, color, skillInfosHashCryptPrivUC) VALUES (NULL , '$idUCreator', '$mainName', '$subName', '$domain', '$level', NULL, '$color', '$skillInfosHashCryptPrivUC');";
        $success = $db->query($query);

        // Check
        if (!$success) {
            return false;
        }
        $lastInsertedId = $db->insert_id;

        $db->close();
        
        return $lastInsertedId;
        // DB close
    }

    //ADD Competence
    static function addCompetence(string $idUTeacher, string $idUStudent, string $idSkill, string $revokedDate, int $masteryLevel, string $competenceInfosHashCryptPrivUT) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");


        // DB select
        $query = "SELECT masteringLevel FROM tblCompetences WHERE idUStudent = '$idUTeacher' AND idSkill = $idSkill;";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Data from DB
        $isTeacher = false;
        while ($row = $result->fetch_assoc()) {
            $masteringLevel = $row['masteryLevel'];
            if ($masteringLevel == 4) $isTeacher = true;
        }

        $skill = DataStorage::getSkill($idSkill);
    
        if ($isTeacher || $skill['idUCreator'] == $idUTeacher) {
            // DB insert
            if ($revokedDate == "") {
                $query = "INSERT INTO tblCompetences (id ,idUTeacher, idUStudent, idSkill, beginDate, revokedDate, masteringLevel, competenceInfosHashCryptPrivUT) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', NOW(), NULL, '$masteryLevel', '$competenceInfosHashCryptPrivUT');";
            } else {
                $query = "INSERT INTO tblCompetences (id ,idUTeacher, idUStudent, idSkill, beginDate, revokedDate, masteringLevel, competenceInfosHashCryptPrivUT) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', NOW(), '$revokedDate', '$masteryLevel', '$competenceInfosHashCryptPrivUT');";
            }
            $success = $db->query($query);

            // Check
            if (!$success) {
                return false;
            }
            $lastInsertedId = $db->insert_id;

            $db->close();
            
            return $lastInsertedId;
            // DB close
        }
        return false;
    }

    //GET User infos from idUser
    static function getUser($idUser) { 
            
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB select
        $query = "SELECT * FROM tblUsers WHERE id = '$idUser';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            return NULL;
        }

        $data = [];
        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['idUser'] = $row['id'];
            $data['firstName'] = $row['firstName'];
            $data['lastName'] = $row['lastName'];
            $data['nickname'] = $row['nickname'];
            $data['pubU'] = $row['pubU'];
            $data['userInfosHashCryptPrivU'] = $row['userInfosHashCryptPrivU'];
        }

        $result->close();
        return $data;
        // DB close
    }
    //Gets skill infos from idSkill
    static function getSkill($idSkill) {    
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT * FROM tblSkills WHERE id = '$idSkill';";
        $result = $db->query($query);
        $numRows = $result->num_rows;
        
        // Check
        if ($numRows == 0) {
            return NULL;
        }

        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['idSkill'] = $row['id'];
            $data['idUCreator'] = $row['idUCreator'];
            $data['mainName'] = $row['mainName'];
            $data['subName'] = $row['subName'];
            $data['domain'] = $row['domain'];
            $data['level'] = $row['level'];
            $data['imgUrl'] = $row['imgUrl'];
            $data['color'] = $row['color'];
            $data['skillInfosHashCryptPrivUC'] = $row['skillInfosHashCryptPrivUC'];
        }
        $result->close();
        return $data;
        // DB close
    }


    //GET Basic competences informations
    static function getCompetence($idCompetence,$isMastering=false) { 

        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT * FROM tblCompetences WHERE id = '$idCompetence';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            return NULL;
        }
        
        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['idCompetence'] = $row['id'];
            $data['idUTeacher'] = $row['idUTeacher'];
            $data['idUStudent'] = $row['idUStudent'];
            $data['idSkill'] = $row['idSkill'];
            $data['beginDate'] = $row['beginDate'];
            $data['revokedDate'] = $row['revokedDate'];
            $data['masteringLevel'] = $row['masteringLevel'];
            $data['competenceInfosHashCryptPrivUT'] = $row['competenceInfosHashCryptPrivUT'];
        }
        $result->close();
        return $data;
        // DB close
    }


    //GETS Full Skill informations recursively
    static function getFullSkill($idSkill){
        $fullSkill = DataStorage::getSkill($idSkill);
        $fullSkill['creator'] = DataStorage::getUser($fullSkill['idUCreator']);
        return $fullSkill;
    }



        //GETS Full Skill informations recursively
    static function getFullCompetence($idCompetence){
        $fullCompetence = DataStorage::getCompetence($idCompetence);
        $fullCompetence['teacher'] = DataStorage::getUser($fullCompetence['idUTeacher']);
        $fullCompetence['student'] = DataStorage::getUser($fullCompetence['idUStudent']);
        $fullCompetence['skill'] = DataStorage::getSkill($fullCompetence['idSkill']);
        return $fullCompetence;
        // DB close

    }


    //GET Id list of competences obtained
    static function getStudentIdCompetences($idUStudent){
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT id FROM tblCompetences WHERE idUStudent = '$idUStudent';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            return NULL;
        }

        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['id'];
        }
        $result->close();
        return $data;
        // DB close

    }

    //GET Id list of competences given
    static function getTeacherIdCompetences($idUTeacher){
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT id FROM tblCompetences WHERE idUTeacher = '$idUTeacher';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            return NULL;
        }

        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['id'];   
            
        }
        $result->close();
        return $data;
        // DB close

    }

    //GET informations for multiple competences
    static function getCompetences($idCompetences){
        $competences = [];
        foreach ($idCompetences as $idCompetence){
            $competences[] = DataStorage::getFullCompetence($idCompetence);
        }
        return $competences;
    }
    //GET informations for multiple competences obtained for a user
    static function getStudentCompetences($idUStudent){
        $studentCompetences=DataStorage::getCompetences(DataStorage::getStudentIdCompetences($idUStudent));
        return $studentCompetences;
    }
    //GET informations for multiple competences given by a user
    static function getTeacherCompetences($idUTeacher){
        $teacherCompetences=DataStorage::getCompetences(DataStorage::getTeacherIdCompetences($idUTeacher));
        return $teacherCompetences;
    }


    static function getSkillCompetences($idSkill){
                // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT * FROM tblCompetences WHERE idSkill = '$idSkill';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            return NULL;
        }

        $competences = [];
        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['idCompetence'] = $row['id'];
            $data['idUTeacher'] = $row['idUTeacher'];
            $data['idUStudent'] = $row['idUStudent'];
            $data['idSkill'] = $row['idSkill'];
            $data['beginDate'] = $row['beginDate'];
            $data['revokedDate'] = $row['revokedDate'];
            $data['masteringLevel'] = $row['masteringLevel'];   
            $data['competenceInfosHashCryptPrivUT'] = $row['competenceInfosHashCryptPrivUT'];
            $competences[] = $data;
        }
        $result->close();
        return $competences;
        // DB close
    }
    static function getCreatorIdSkills($idUCreator){
                // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT id FROM tblSkills WHERE idUCreator = '$idUCreator';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            return NULL;
        }

        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['id'];
            
        }
        $result->close();
        return $data;
        // DB close
    }
    static function getSkills($idSkills){
        $skills = [];
        foreach ($idSkills as $idSkill){
            $skills[] = DataStorage::getFullSkill($idSkill);
        }
        return $skills;
    }

    static function getCreatorSkills($idUCreator){
        $creatorSkills = DataStorage::getSkills(DataStorage::getCreatorIdSkills($idUCreator));
        return $creatorSkills;
    }
}

// $idSkill = DataStorage::addSkill(36, "macabou", "le poto", "RT2", 1, "", "ffffff");
// $idCompetence = DataStorage::addCompetence(22, 36, 21, "", 1);

print_r(DataStorage::getSkillCompetences(20));
// print_r(DataStorage::getSkill($idSkill));
// $competencesList = 28;
?>