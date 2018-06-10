<?php
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $candid_id = $_POST['candid_id'];
    
    $return_arr = array();
    $party = "";
    $query = "SELECT nume_partid FROM candidat WHERE id_candidat=?";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $candid_id);
        $stmt->bind_result($party);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $return_arr["party"] = $party;
    echo json_encode($return_arr);
?>
        
