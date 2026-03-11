<?php

    $dsn = "mysql:host=localhost;port=8080;dbname=ticketing_service;charset=utf8mb4";
    $user = "devuser";
    $password = "devpassword";

    //connect la database
    try {
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die("Erreur connexion : " . $e->getMessage());
    }
?>