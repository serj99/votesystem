<?php
    $return_arr = array();
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $party = $_POST['party']; 
    $return_arr["success"] = 0;

    $query1 = "DELETE FROM partid WHERE nume_partid = ?";
    $query2 = "DELETE FROM voturi WHERE nume_partid = ?"; 
    if($stmt = $mysqli->prepare($query1)) {
        $stmt->bind_param("s", $party);
        $stmt->execute();
        if(empty($stmt->error))
            $return_arr["success"] = 1;
        else
            $return_arr["success"] = $stmt->error;
        $stmt->close();
    }
    if($stmt = $mysqli->prepare($query2)) {
        $stmt->bind_param("s", $party);
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

