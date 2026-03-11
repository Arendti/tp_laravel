<?php
    require_once 'ticket_list.php';

    $requestedId = isset($_GET['id']) ? $_GET['id'] : null;

    $ticket = null;
    if ($requestedId) {
        foreach ($tickets as $t) {
            if ($t['Ticket_ID'] == $requestedId) { $ticket = $t; break; }
        }
    }

    if (!$ticket) {
        $ticket = $tickets[0];
    }

    // on gère le traitement du formulaire
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $sql = "INSERT INTO Time_Entries (Date, Duration, Comment, Ticket_ID, User_ID) VALUES (:Date, :Duration, :Comment, :Ticket_ID, :User_ID);";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ":Date"   => $_POST["Date"],
            ":Duration"   => $_POST["Duration"],
            ":Comment"   => $_POST["Comment"],
            ":Ticket_ID"   => $ticket['Ticket_ID'],
            ":User_ID"   => $ticket['User_ID']
        ]);
    }


    header("location:../ticket_details.php?id={$ticket['Ticket_ID']}");
?>