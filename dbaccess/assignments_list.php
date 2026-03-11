<?php
    require_once 'db.php';
    //import la table Assignments
    $sql = "SELECT * FROM Assignments";
    $stmt = $pdo->query($sql);
    $assignments = $stmt->fetchAll();
?>