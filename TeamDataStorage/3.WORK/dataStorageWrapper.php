<?php

    include_once("./dataStorage.php");


    function verifyData($pubU, $InfosHashCryptPrivU, $data) {
        // Decode
        $InfosHashCryptPrivU = base64_decode($InfosHashCryptPrivU);
        $pubU = base64_decode($pubU);

        // Asym verify data : (dataA, dataAHashSignPrivA, pubA) --> (isDataAVerified)
        return openssl_verify($data, $userInfosHashSignPrivU, $pubU, "sha256WithRSAEncryption");
    }

    function addVerifiedUser(string $firstName, string $lastName, string $nickname, string $pubU) {
        DataStorage::addUser(string $firstName, string $lastName, string $nickname, string $pubU);
    }


?>