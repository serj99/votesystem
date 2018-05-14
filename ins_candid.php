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

$candid_inserted = -1;
if(isset($_POST['btn-ins-candid'])) {
    $query = "SELECT id_candidat FROM candidat ORDER BY id_candidat DESC LIMIT 1"; 
    $candid_id = 0;
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_result($candid_id);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
    }
    
    $candid_id++;
    $sname           = $_POST['nume'];
    $fname           = $_POST["prenume"];
    $party           = $_POST["partid"];
    $age             = $_POST["varsta"];
    $fortune         = $_POST["avere"];
    $former_party    = $_POST["partid_anterior"];
    $education       = $_POST["studii_absolvite"];
    $job_b4_politics = $_POST["slujba_inainte"]; 

    $query = "INSERT INTO candidat(id_candidat, nume, prenume, nume_partid,
              varsta, avere_declarata, partid_anterior, studii_absolvite, 
              slujba_inainte_de_politica) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $candid_inserted = 0;
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("isssiisss", $candid_id, $sname, $fname, $party,
                          $age, $fortune, $former_party, $education, $job_b4_politics);
        $stmt->execute();
        if(strlen($stmt->error)==0)
            $candid_inserted = 1;
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


  <form method='post'>
    <table>
      <tr>
        <td><label for='nume'>Nume</label></td>
        <td><input type="text" id="nume"name="nume"></td>
      </tr>
      <tr>
        <td><label for='prenume'>Prenume</label></td>
        <td><input type="text" id="prenume" name="prenume"></td>
      </tr>
      <tr>
        <td><label for='partid'>Partid</label></td>
        <td><input type="text" id='partid' name="partid"></td>
      </tr>
      <tr>
        <td><label for='varsta'>Varsta</label></td>
        <td><input type="text" id="varsta" name="varsta"></td>
      </tr>
      <tr>
        <td><label for='avere'>Avere declarata</label></td>
        <td><input type="text" id='avere' name="avere"></td>
      </tr>
      <tr>
        <td><label for='partid_anterior'>Partid anterior</label></td>
        <td><input type="text" id='partid_anterior' name="partid_anterior"></td>
      </tr>
      <tr>
        <td><label for='studii_absolvite'>Studii absolvite</label></td>
        <td>
          <textarea name='studii_absolvite' id='studii_absolvite' rows='1' cols='40'>
          </textarea>
        </td>
      </tr>
      <tr>
        <td><label for='slujba_inainte'>Slujba inainte de politica</label></td>
        <td><input type="text" id='slujba_inainte' name="slujba_inainte"></td>
      </tr>
        <td colspan='2'>
          <input type="submit" name='btn-ins-candid' value="Adauga candidat">
          <a href='home.php'><button type='button'>Inapoi</button></a>
        </td>
      </tr>
      <tr>
        <td colspan='2'>
          <?php 
              if($candid_inserted==1)
                  echo "<p id='green_message'>Candidatul a fost introdus cu succes 
                        in baza de date!</p>";
              if($candid_inserted==0)
                  echo "<p id='red_message'>Eroare! Candidatul nu a fost introdus cu succes 
                        in baza de date!</p>";
          ?>
    </table>
  </form>

</html>
