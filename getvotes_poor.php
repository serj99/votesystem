<?php
    $return_arr = array();
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }
    $query = "SELECT nume_judet, total_votanti FROM judet ORDER BY pib ASC LIMIT 1";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_result($return_arr["poorest_county"], $return_arr["votes_count"]);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $mysqli->close();
    echo json_encode($return_arr);
?>
    
