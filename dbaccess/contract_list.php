<?php
    require_once 'db.php';
    //import la table Contracts
    $sql = "SELECT * FROM Contracts";
    $stmt = $pdo->query($sql);
    $contracts = $stmt->fetchAll();
?>