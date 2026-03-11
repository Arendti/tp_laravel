<?php
    require_once '../project_list.php';

    if (isset($_GET["delete"])) {
        $sql = "DELETE FROM Projects WHERE Project_ID = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":id" => $_GET["delete"]
        ]);
    }

    header("location:../../projects.php");
?>