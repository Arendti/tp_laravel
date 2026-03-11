<?php
    require_once '../project_list.php';

    // créer un nouveaux projet
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $sql = "INSERT INTO Projects (Project_Name, Project_Description, Included_Hours, Hourly_Rate, Start_Date, End_Date, Client_ID, Dev_ID, Contract_ID) VALUES (:Project_Name, :Project_Description, :Included_Hours, :Hourly_Rate, :Start_Date, :End_Date, :Client_ID, :Dev_ID, :Contract_ID);";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ":Project_Name"   => $_POST["Project_Name"],
            ":Project_Description"   => $_POST["Project_Description"],
            ":Included_Hours"   => $_POST["Included_Hours"],
            ":Hourly_Rate"   => $_POST["Hourly_Rate"],
            ":Start_Date"   => $_POST["Start_Date"],
            ":End_Date"   => $_POST["End_Date"],
            ":Client_ID"   => $_POST["Client_ID"],
            ":Dev_ID"   => $_POST["Dev_ID"],
            ":Contract_ID" => 1
        ]);
    }


    header("location:../../projects.php");
?>