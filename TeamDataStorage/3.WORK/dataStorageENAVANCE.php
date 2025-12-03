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

        #Il faut récup la currenDate
        static function addCompetence(string $idUTeacher, string $idUStudent, string $idSkill, string $revokedDate, int $masteryLevel) {
            // DB open
            include_once("./cfgDb.php");
            $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
            $db->set_charset("utf8");


            // DB select
            $query = "SELECT masteryLevel FROM tblCompetences WHERE idUStudent = '$idUTeacher';";
            $result = $db->query($query);
            $numRows = $result->num_rows;

            // Data from DB
            while ($row = $result->fetch_assoc()) {
                $masteryLevel = $row['masteryLevel'];
            }

        

            if ($masteryLevel == 4) {
            // DB insert
            $query = "INSERT INTO tblCompetences (id ,idUTeacher, idUStudent, idSkill, currentDate, revokedDate, masteryLevel) VALUES (NULL , '$idUTeacher', '$idUStudent', '$idSkill', NOW, '$revokedDate', '$masteryLevel');";
            $success = $db->query($query);

            // Check
            if (!$success) {
                return false;
            }
            $lastInsertedId = $db->insert_id;

            $db->close();
            
            return $lastInsertedId;
            // DB close
    }}
    static function getUser($idUser) {
            
            // DB open
            include_once("./cfgDb.php");
            $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
            $db->set_charset("utf8");

            // DB select
            $query = "SELECT firstName, lastName, nickname FROM tblUsers WHERE id = '$idUsers';";
            $result = $db->query($query);
            $numRows = $result->num_rows;

            // Check
            if ($numRows == 0) {
                header("Location: logout.php");
                exit();
            }

            // Data from DB
            while ($row = $result->fetch_assoc()) {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $nickname = $row['nickname'];
            }
            $result->close();

            // DB close
        }
        
    

    static function getSkill($idSkill) {
            
            // DB open
            include_once("./cfgDb.php");
            $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
            $db->set_charset("utf8");

            // DB select
            $query = "SELECT idUCreator, mainName, subName, domain, level, imgUrl, color FROM tblSkills WHERE id = '$idSkill';";
            $result = $db->query($query);
            $numRows = $result->num_rows;

            // Check
            if ($numRows == 0) {
                header("Location: logout.php");
                exit();
            }

            // Data from DB
            while ($row = $result->fetch_assoc()) {
                $idUCreator = $row['idUCreator'];
                $mainName = $row['mainName'];
                $subName = $row['subName'];
                $domain = $row['domain'];
                $level = $row['level'];
                $imgUrl = $row['imgUrl'];
                $color = $row['color'];
            }
            $result->close();

            // DB close
        }
}

?>

