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
}
    // function getUser($idUser) {

    //     // DB open
    //     include_once("./cfgDb.php");
    //     $db = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
    //     $db->set_charset("utf8");
        
    //     // DB select
    //     $query = "SELECT * FROM tblUsers WHERE idUser = '$idUser';";
    //     $result = $db->query($query);
    //     $numRows = $result->num_rows;

    //     // Check
    //     if ($numRows == 0) {
    //         header("Location: logout.php");
    //         exit();
    //     }

    //     // Data from DB
    //     while ($row = $result->fetch_assoc()) {
    //         $login = $row['login'];
    //         $pwd = $row['pwd'];
    //     }
    //     $result->close();


        
    // }
?>

