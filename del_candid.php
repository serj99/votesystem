<?php
    $return_arr = array();
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $candid_id = $_POST['candid_id']; 
    $return_arr["success"] = 0;

    $query1 = "DELETE FROM candidat WHERE id_candidat = ?";
    $query2 = "DELETE FROM voturi WHERE id_candidat = ?"; 
    if($stmt = $mysqli->prepare($query1)) {
        $stmt->bind_param("i", $candid_id);
        $stmt->execute();
        if(empty($stmt->error))
            $return_arr["success"] = 1;
        else
            $return_arr["success"] = $stmt->error;
        $stmt->close();
    }
    if($stmt = $mysqli->prepare($query2)) {
        $stmt->bind_param("i", $candid_id);
        $stmt->execute();
        if(empty($stmt->error))
            $return_arr["success"] = 1;
        else
            $return_arr["success"] = $stmt->error;
        $stmt->close();
    }

    $mysqli->close();
    echo json_encode($return_arr);
?>
