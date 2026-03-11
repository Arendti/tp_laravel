<?php
    require_once 'db.php';
    
    $sql = "SELECT * FROM Projects";
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll();
?>