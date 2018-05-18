<?php
session_start();
if(!isset($_SESSION['user_id']))
    header("Location: index.php");

$mysqli = new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno);
}
else
	echo("<div style='font-size:x-small'>Connected succesfully to database!<br></div>");	 

$query = "SELECT nume, prenume, varsta, educatie, venit_lunar, casatorit
          FROM votant WHERE id_votant = ?";
$userRow = array();
if($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $userRow = $result->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
}


$uservoted = 0;
$query = "SELECT id_votant FROM voturi WHERE id_votant=?";
if($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->bind_result($user_id);
    $stmt->execute();
    $stmt->fetch();
    
    //if we find the user_id on voturi table
    //the user voted before
    if($user_id)
        $uservoted = 1;
    $stmt->close();
}

date_default_timezone_set("Europe/Bucharest");
if(isset($_POST['btn-vote'])) {
    $voter_id = $_SESSION['user_id'];
    $candidate_id = $_POST['candidate'];
    $party = $_POST['party'];
    $county = $_POST['county'];
    $vote_time = date("H:i:s");
    $vote_date = date("Y-m-d");
    echo "vote date = $vote_date<br>";
    $ip = $_SERVER['REMOTE_ADDR'];
    echo "ip = $ip<br>";
    $os = $_POST['platform'];
    echo "os = $os<br>";
    
    $query = "INSERT INTO voturi(id_votant, id_candidat, nume_partid,
              nume_judet, timp_vot, data_vot, ip, sistem_operare)
              VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("iissssss", $voter_id, $candidate_id, $party,
                           $county, $vote_time, $vote_date, $ip, $os);
        $stmt->execute();
        $stmt->close();
        $uservoted = 1;
    }
    
    $query = "UPDATE judet SET total_votanti = total_votanti + 1
              WHERE nume_judet = ?";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $county);
        $stmt->execute();
        $stmt->close();
    }
}
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simulare votari regionale</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type='text/javascript' src='script.js'></script> 
</head>


<div id="header">
	<div id="left">
    <label>Votul inseamna schimbare</label>
    </div>
    <div id="right">
    	<div id="content"> 
        	salutare' <?php echo $userRow['prenume']; ?> &nbsp; &nbsp; <a href="logout.php?logout">Iesire</a>
        </div>
    </div>
</div>

<div id="body">
  <div id='puthere'></div>
  <div id="nav">
    <ul>
      <li><a href="home.php">Acasa</a></li>
      <li><a href="generatepolls.php">Genereaza sondaje</a></li>
    </ul>
  </div>

  <?php if(isset($_SESSION['root'])) : ?>
    <table>
      <tr>
        <td>
          Alege candidat pentru eliminare din baza de date
          <select id='candid_to_del' name='candid_to_del'>
            <?php
                $query = "SELECT id_candidat, nume, prenume
                          FROM candidat";
                if($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_result($cand_id, $cand_sname, $cand_fname);
                    $stmt->execute();
                    while($stmt->fetch()) 
                        echo "<option value='$cand_id'>$cand_sname $cand_fname</option>";
                    $stmt->close();
                }
            ?>
            </select>   
        </td>
        <td>
          <button id='BttnDelCandid' class='redbttn'>Eliminare</button>
        </td>
        <td> 
          <a href="ins_candid.php"><button id='BttnInsertCandid' class='greenbttn'>Adauga candidat</button></a>
        </td>
      </tr>
      <tr>
        <td id='MssgDelCandid'colspan='2'></td>
      </tr>
      <tr>
        <td>
          Alege partid pentru eliminare din baza de date
          <select id='party_to_del' name='party_to_del'>
          <?php
              $query = "SELECT nume_partid FROM partid";
              if($stmt = $mysqli->prepare($query)) {
                  $stmt->bind_result($partyname);
                  $stmt->execute();
                  while($stmt->fetch())
                      echo "<option value='{$partyname}'>$partyname</option>";
                  $stmt->close();
              }
          ?>
          </select>
        </td>
        <td>
          <button id='BttnDelParty' class='redbttn'>Eliminare</button>
        </td>
        <td>
          <a href="ins_party.php"><button id='BttnInsertParty' class='greenbttn' >Adauga partid</button></a>
        </td>
      <tr>
        <td id='MssgDelParty'colspan='2'></td>
      </tr>
    </table>  

  <?php elseif (!isset($_SESSION['root']) && $uservoted == 0) : ?>    
      <form id='voteform' method="post">
        <table>
          <tr>
            <td><label for='county'>Judet resedinta</label></td>
            <td><select id='county' name='county'>
              <?php 
                  $query = "SELECT nume_judet FROM judet";
                  if($stmt = $mysqli->prepare($query)) {
                      $stmt->bind_result($county);
                      $stmt->execute();
                      while($stmt->fetch())
                          echo "<option value='{$county}'>$county</option>";
                      $stmt->close();
                  }
              ?>
            </td>
          </tr>
          <tr>
            <td><label for='candidate'>Candidat</label></td>
            <td><select id='candidate' name='candidate'>
              <?php
                  $query = "SELECT id_candidat, nume, prenume FROM candidat";
                  if($stmt = $mysqli->prepare($query)) {
                      $stmt->bind_result($candidate_id, $candidate_sname, $candidate_fname);
                      $stmt->execute();
                      while($stmt->fetch())
                          echo "<option value='{$candidate_id}'>$candidate_sname" . 
                               " $candidate_fname</option>"; 
                      $stmt->close();
                  }
               ?>
             </td>
          </tr>
          <tr>
            <td><label for='party'>Partid</label></td>
            <td>
              <select id='party' name='party'>
              <?php
                  $query = "SELECT nume_partid FROM partid";
                  if($stmt = $mysqli->prepare($query)) {
                      $stmt->bind_result($partyname);
                      $stmt->execute();
                      while($stmt->fetch())
                          echo "<option value='{$partyname}'>$partyname</option>";
                      $stmt->close();
                  }
              ?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan='2'>
              <input type='hidden' name='platform' id='platform' value=''>
                <script>
                  document.getElementById("platform").value = navigator.platform;
                </script>
            </td>
          <tr>
            <td colspan='2'>
              <button type='submit' name='btn-vote'>Voteaza</button>
            </td>
          </tr>
        </table>
  <?php 
    elseif( !isset($_SESSION['root']) && $uservoted == 1) : 
  ?>
    <h5 id='green_message'>Ai votat deja! Lupta prezidentiala este foarte stransa! </h5>
    <table>
      <tr>
        <td>
          <table class="dbtbl">
            <tr><th>Top candidati</th></tr>
            <?php
                $query = "SELECT candidat.nume, candidat.prenume, candidat.nume_partid,
                          COUNT(candidat.nume) AS voturi FROM candidat
                          INNER JOIN voturi ON voturi.id_candidat=candidat.id_candidat
                          GROUP BY candidat.nume ORDER BY count(candidat.nume) DESC LIMIT 10";
                if($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_result($sname, $fname, $party, $votes_count);
                    $stmt->execute();
                    $row_count = 1;
                    while($stmt->fetch()) {
                        echo "<tr><td>$row_count. $sname $fname ($party) $votes_count voturi</td></tr>";   
                        $row_count++;
                    }
                    $stmt->close();
                }
            ?>
          </table>
        </td>
        <td>
          <table class="dbtbl">
            <tr><th>Ultimele voturi</th></tr>
            <?php
                $query = "SELECT voturi.data_vot, voturi.timp_vot, 
                          votant.nume, votant.prenume, candidat.nume, candidat.prenume 
                          FROM voturi 
                          INNER JOIN votant ON voturi.id_votant=votant.id_votant 
                          INNER JOIN candidat ON voturi.id_candidat=candidat.id_candidat 
                          ORDER BY voturi.id_votant DESC LIMIT 10";
                if($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_result($vote_date, $vote_time, $voter_sname, $voter_fname,
                                       $candidate_sname, $candidate_fname);
                    $stmt->execute();
                    while($stmt->fetch()) {
                        echo "<tr><td>$vote_date $vote_time $voter_sname $voter_fname 
                              <img src='images/singlevote_logo.jpg' alt=''> 
                              $candidate_sname $candidate_fname</td></tr>";
                    }
                $stmt->close();
                }
            ?>
          </table>
        </td>
      </tr>
    </table>
  <?php endif; ?>    















































</html>
