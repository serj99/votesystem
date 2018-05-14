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

$party_inserted = -1;
$error = "";
if(isset($_POST['btn-ins-party'])) {
    $name           = $_POST['nume'];
    $cnt_members    = $_POST["membri"];
    $leader         = $_POST["presedinte"];
    $borndate       = strtotime($_POST["data_infiint"]);
    $borndate       = date("Y-m-d", $borndate);
    echo "borndate=$borndate";
    $last_proc      = $_POST["ult_proc"];
    $wins           = $_POST["victorii"];
    $ideology       = $_POST["ideologie"];

    $query = "INSERT INTO partid(nume_partid, membri, presedinte, data_infiintare,
              ultimul_procent, victorii_totale, ideologie) 
              VALUES(?, ?, ?, ?, ?, ?, ?)";
    $party_inserted = 0;
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("sissiis", $name, $cnt_members, $leader, $borndate,
                          $last_proc, $wins, $ideology);
        $stmt->execute();
        if(strlen($stmt->error)==0)
            $party_inserted = 1;
        else
            $error = $stmt->error;
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
        <td><label for='membri'>Numar membri</label></td>
        <td><input type="text" id="membri" name="membri"></td>
      </tr>
      <tr>
        <td><label for='presedinte'>Presedinte</label></td>
        <td><input type="text" id='presedinte' name="presedinte"></td>
      </tr>
      <tr>
        <td><label for='data_infiint'>Data infiintare</label></td>
        <td><input type="date" id="data_infiint" name="data_infiint"></td>
      </tr>
      <tr>
        <td><label for='ult_proc'>Ultimul procent</label></td>
        <td><input type="text" id='ult_proc' name="ult_proc" value="0"></td>
      </tr>
      <tr>
        <td><label for='victorii'>Victorii totale</label></td>
        <td><input type="text" id='victorii' name="victorii" value="0"></td>
      </tr>
      <tr>
        <td><label for='ideologie'>Ideologie</label></td>
        <td><input type="text" id='ideologie' name="ideologie"></td>
      </tr>
        <td colspan='2'>
          <input type="submit" name='btn-ins-party' value="Adauga partid">
          <a href='home.php'><button type='button'>Inapoi</button></a>
        </td>
      </tr>
      <tr>
        <td colspan='2'>
          <?php 
              if($party_inserted==1)
                  echo "<p id='green_message'>Partidul a fost introdus cu succes 
                        in baza de date!</p>";
              if($party_inserted==0)
                  echo "<p id='red_message'>Eroare!$error Partidul  nu a fost introdus cu succes 
                        in baza de date!</p>";
          ?>
    </table>
  </form>

</html>

