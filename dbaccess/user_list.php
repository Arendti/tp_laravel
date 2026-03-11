<?php
    require_once 'db.php';
    //import la table Users
    $sql = "SELECT * FROM Users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll();
?>