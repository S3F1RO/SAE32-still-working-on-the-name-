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
        $query = "INSERT INTO tblSkills (id ,idUCreator, mainName, subName, domain, level, imgUrl, color) VALUES (NULL , '$idUCreator', '$mainName', '$subName', '$domain', '$level', '$imgUrl', '$color');";
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


        static function addCompetence(string $idUTeacher, string $idUStudent, string $idSkill, string $currentDate, string $revokedDate, int $masteryLevel) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB insert
        $query = "INSERT INTO tblCompetences (id ,idUTeacher, idUStudent, idSkill, currentDate, revokedDate, masteryLevel) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', '$currentDate', '$revokedDate', '$masteryLevel');";
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


            static function getUser($idUser) {
        // DB open
        include_once("./cfgDb.php");
        $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
        $db->set_charset("utf8");

        // DB insert
        $query = "SELECT FROM tblCompetences (id) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', '$currentDate', '$revokedDate', '$masteryLevel');";
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
}

?>

