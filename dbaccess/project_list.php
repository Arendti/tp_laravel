<?php
    require_once 'db.php';
    //import la table Projects
    $sql = "SELECT * FROM Projects";
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll();
?>