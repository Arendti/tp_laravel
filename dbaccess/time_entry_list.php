<?php
    require_once 'db.php';
    //import la table Time_Entries
    $sql = "SELECT * FROM Time_Entries";
    $stmt = $pdo->query($sql);
    $timeentries = $stmt->fetchAll();
?>