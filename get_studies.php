<?php
    $return_arr = array();
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) 
        die('Connect Error: ' . $mysqli->connect_errno);
    $higher_education_count = 0;
    $basic_education_count = 0;
    $education = 1;
    $query = "SELECT COUNT(id_votant) FROM votant WHERE educatie=?";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $education);
        $stmt->bind_result($higher_education_count);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $education = 0;
    $query = "SELECT COUNT(id_votant) FROM votant WHERE educatie=?";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $education);
        $stmt->bind_result($basic_education_count);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $mysqli->close();
    $total = $higher_education_count + $basic_education_count;
    $return_arr["higher_perc"] = 100 * $higher_education_count/$total;
    $return_arr["basic_perc"] = 100 * $basic_education_count/$total;
    echo json_encode($return_arr);
?>     
