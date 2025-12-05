<?php

include_once("./utils.php");

class DataStorage {
    
    static function addUser(string $firstName, string $lastName, string $nickname) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB insert
        $query = "INSERT INTO tblUsers (id ,firstName, lastName, nickname) VALUES (NULL , '$firstName', '$lastName', '$nickname');";
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


    static function addSkill(string $idUCreator, string $mainName, string $subName, string $domain, int $level, string $imgUrl, string $color ) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB insert
        $query = "INSERT INTO tblSkills (id ,idUCreator, mainName, subName, domain, level, imgUrl, color) VALUES (NULL , '$idUCreator', '$mainName', '$subName', '$domain', '$level', NULL, '$color');";
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

    #Il faut récup la currenDate
    static function addCompetence(string $idUTeacher, string $idUStudent, string $idSkill, string $revokedDate, int $masteryLevel) {
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
                $query = "INSERT INTO tblCompetences (id ,idUTeacher, idUStudent, idSkill, currentDate, revokedDate, masteringLevel) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', NOW(), NULL, '$masteryLevel');";
            } else {
                $query = "INSERT INTO tblCompetences (id ,idUTeacher, idUStudent, idSkill, currentDate, revokedDate, masteringLevel) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', NOW(), '$revokedDate', '$masteryLevel');";
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
    static function getUser($idUser) {
            
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB select
        $query = "SELECT firstName, lastName, nickname FROM tblUsers WHERE id = '$idUser';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            header("Location: logout.php");
            exit();
        }

        $data = [];
        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['firstName'] = $row['firstName'];
            $data['lastName'] = $row['lastName'];
            $data['nickname'] = $row['nickname'];
        }

        $result->close();
        return $data;
        // DB close
    }

    static function getSkill($idSkill) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT idUCreator, mainName, subName, domain, 'level', imgUrl, color FROM tblSkills WHERE id = '$idSkill';";
        $result = $db->query($query);
        $numRows = $result->num_rows;
        
        // Check
        if ($numRows == 0) {
            header("Location: logout.php");
            exit();
        }

        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['idUCreator'] = $row['idUCreator'];
            $data['mainName'] = $row['mainName'];
            $data['subName'] = $row['subName'];
            $data['domain'] = $row['domain'];
            $data['level'] = $row['level'];
            $data['imgUrl'] = $row['imgUrl'];
            $data['color'] = $row['color'];
        }
        $result->close();
        return $data;
        // DB close
    }

    static function getCompetence($idCompetence) {

        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");
        
        // DB select
        $query = "SELECT idUTeacher, idUStudent, idSkill, currentDate, revokedDate, masteringLevel FROM tblCompetences WHERE id = '$idCompetence';";
        $result = $db->query($query);
        $numRows = $result->num_rows;

        // Check
        if ($numRows == 0) {
            header("Location: logout.php");
            exit();
        }

        // Data from DB
        while ($row = $result->fetch_assoc()) {
            $data['idUteacher'] = $row['idUTeacher'];
            $data['idUStudent'] = $row['idUStudent'];
            $data['idSkill'] = $row['idSkill'];
            $data['currentDate'] = $row['currentDate'];
            $data['revokedDate'] = $row['revokedDate'];
            $data['masteringLevel'] = $row['masteringLevel'];
        }
        $result->close();
        return $data;
        // DB close
    }
}

// $idSkill = DataStorage::addSkill(36, "macabou", "le poto", "RT2", 1, "", "ffffff");
// $idCompetence = DataStorage::addCompetence(22, 36, 21, "", 1);

// print_r(DataStorage::getUser(36));
// print_r(DataStorage::getSkill($idSkill));
// print_r(DataStorage::getCompetence($idCompetence));

?>