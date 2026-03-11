<?php
    require_once 'db.php';
    
    $sql = "SELECT * FROM Assignments";
    $stmt = $pdo->query($sql);
    $assignments = $stmt->fetchAll();
?>