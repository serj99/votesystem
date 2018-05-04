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

date_default_timezone_set("Europe/Bucharest");
$uservoted = 0;
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
}
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simulare votari regionale</title>
<link rel="stylesheet" href="style.css" type="text/css" />
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
      <li><a href="book-add.php">Genereaza sondaje</a></li>
    </ul>
  </div>

  <?php if($uservoted == 0) : ?>    
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
            <td><select id='party' name='party'>
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
    endif; 
    if($uservoted == 1) : 
  ?>
    <div id='green_message'>Votul tau a fost inregistrat cu succes in baza de date!</div>
    <table>
      <tr>
        <td>
          <table>
            <tr><td>Top candidati</td></tr>
            <tr><td>1. Anton Mavrocordat (Partidul Social Liberal) 17 voturi</td></tr>
            <tr><td>2. Sebastian Iulica (Partidul Democrat Liberal) 15 voturi</td></tr>
          </table>
        </td>
        <td>
          <table>
            <tr><td>Ultimele voturi</td></tr>
            <tr><td>03.04 24:03 Marta Vasile -> Anton Mavrocordat</td></tr>
            <tr><td>03.04 11:01 Sciabli Ecentu -> Sebastian Iulica</td></tr>
          </table>
        </td>
      </tr>
    </table>
  <?php endif; ?>    















































</html>
