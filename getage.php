<?php
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $party = $_POST['party'];
    
    $return_arr = array();
    $age = 0;
    $query = "SELECT AVG(votant.varsta) FROM voturi INNER JOIN votant 
              ON voturi.id_votant=votant.id_votant WHERE voturi.nume_partid=?
              GROUP BY voturi.nume_partid";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $party);
        $stmt->bind_result($age);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $return_arr["age"] = $age;
    echo json_encode($return_arr);
?>
        
