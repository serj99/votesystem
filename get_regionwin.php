<?php
    $return_arr = array();
    $mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
    if($mysqli->connect_errno) {
        die('Connect Error: ' . $mysqli->connect_errno);
    }

    $region = $_POST['region']; 
    $regionwin_party = "";
    $query = "SELECT voturi.nume_partid, COUNT(*) AS count 
              FROM voturi INNER JOIN judet 
              ON voturi.nume_judet = judet.nume_judet 
              WHERE judet.regiune = ? 
              GROUP BY voturi.nume_partid 
              ORDER BY count DESC LIMIT 1";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $region);
        $stmt->bind_result($regionwin_party, $val);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    $mysqli->close();
    $return_arr["regionwin_party"] = $regionwin_party;
    echo json_encode($return_arr);
?>
