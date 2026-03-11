<?php
    require_once '../ticket_list.php';

    //supprime le ticket
    if (isset($_GET["delete"])) {
        $sql = "DELETE FROM Tickets WHERE Ticket_ID = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":id" => $_GET["delete"]
        ]);
    }

    header("location:../../tickets.php");
?>