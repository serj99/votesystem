<?php
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $party = $_POST['party'];
    
    $return_arr = array();
    $candid_id = 0;
    $query = "SELECT id_candidat FROM candidat WHERE nume_partid=?";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $party);
        $stmt->bind_result($candid_id);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $return_arr["candid_id"] = strval($candid_id);
    echo json_encode($return_arr);
?>
        
