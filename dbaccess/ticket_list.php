<?php
    require_once 'db.php';
    
    $sql = "SELECT * FROM Tickets";
    $stmt = $pdo->query($sql);
    $tickets = $stmt->fetchAll();
?>