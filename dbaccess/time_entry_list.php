<?php
    require_once 'db.php';
    
    $sql = "SELECT * FROM Time_Entries";
    $stmt = $pdo->query($sql);
    $timeentries = $stmt->fetchAll();
?>