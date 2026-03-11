<?php
    require_once 'db.php';
    
    $sql = "SELECT * FROM Users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll();
?>