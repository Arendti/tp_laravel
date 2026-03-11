<?php
    require_once '../ticket_list.php';

    // créer un nouveau ticket
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //récupère l'id du projet sélectionné 
        $sql = "SELECT Project_ID FROM Projects WHERE Project_Name=\"" . $_POST["Project_Name"] . "\";";
        $stmt = $pdo->query($sql);
        $project_id = $stmt->fetchAll()[0]['Project_ID'];
        
        //récupère l'id du dev sélectionné 
        $sql = "SELECT User_ID FROM Users WHERE User_Name=\"" . $_POST["User_Name"] . "\";";
        $stmt = $pdo->query($sql);
        $user_id = $stmt->fetchAll()[0]['User_ID'];

        // créer le ticket
        $sql = "INSERT INTO Tickets (Ticket_Name, Ticket_Description, Status, Priority, Type, Duration_Estimate, Project_ID, User_ID) VALUES (:Ticket_Name, :Ticket_Description, :Status, :Priority, :Type, :Duration_Estimate, :Project_ID, :User_ID);";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ":Ticket_Name"   => $_POST["Ticket_Name"],
            ":Ticket_Description"   => $_POST["Ticket_Description"],
            ":Status"   => $_POST["Status"],
            ":Priority"   => $_POST["Priority"],
            ":Type"   => $_POST["Type"],
            ":Duration_Estimate"   => $_POST["Duration_Estimate"],
            ":Project_ID"   => $project_id,
            ":User_ID"   => $user_id
        ]);
    }


    header("location:../../tickets.php");
?>