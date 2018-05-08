<?php
    $return_arr = array();
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $region = $_POST['region']; 
    $voters_count = 0;
    $query = "SELECT COUNT(voturi.nume_judet) 
               FROM voturi INNER JOIN judet 
               ON voturi.nume_judet = judet.nume_judet 
               WHERE judet.regiune = ?";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $region);
        $stmt->bind_result($voters_count);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $mysqli->close();
    $return_arr["voters_count"] = $voters_count;
    echo json_encode($return_arr);
?>
        

