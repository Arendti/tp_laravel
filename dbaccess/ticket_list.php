<?php
    require_once 'time_entry_list.php';

    //function de sommation des durées (heures:minutes)
    function sumTime($times) {
        $totalMinutes = 0;

        foreach ($times as $time) {
            list($hours, $minutes) = explode(':', $time);
            $totalMinutes += $hours * 60 + $minutes;
        }

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    //import la table Tickets
    $sql = "SELECT * FROM Tickets";
    $stmt = $pdo->query($sql);
    $tickets = $stmt->fetchAll();

    foreach ($tickets as &$ticket){
        //rajout de la colonne 'Time_Spent'
        $times=[];
        foreach ($timeentries as $entry){
            if ($entry['Ticket_ID'] == $ticket['Ticket_ID']){
                $times[] = $entry['Duration'];
            }
        }
        $ticket['Time_Spent'] = sumTime($times);

        
        //rajout de la colonne 'Project_Name'
        $sql = "SELECT Project_Name FROM Projects WHERE Project_ID=:Project_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":Project_ID" => $ticket['Project_ID'] ]);
        $ticket['Project_Name'] = $stmt->fetchAll()[0]['Project_Name'];
    }
    unset($ticket);
?>