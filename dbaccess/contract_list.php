<?php
    require_once 'db.php';
    
    $sql = "SELECT * FROM Contracts";
    $stmt = $pdo->query($sql);
    $contracts = $stmt->fetchAll();
?>