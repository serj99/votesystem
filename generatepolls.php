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

    <table id="gen_polls_pg">
      <tr>
        <td>Varsta medie a votantilor partidului
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
        <td>
          <button id='BttnGenAvgAge'>Genereaza</button>
        </td>
      </tr>
      <tr>
        <td id='AvgAge'colspan='2'></td>
      </tr>
      <tr>
        <td>
          Numarul de voturi provenite din cel mai sarac judet din tara
        </td>
        <td>
          <button id='BttnGenVotesCntPoor'>Genereaza</button>
        </td>
      </tr>
      <tr>
        <td id='VotesCntPoor'colspan='2'></td>
      </tr>
      <tr>
        <td>
          Procentul votantilor cu studii superioare si al celora fara studii superioare 
        </td>
        <td>
          <button type='button' id='BttnGenStudiesPercent'>Genereaza</button>
        </td>
      </tr>
      <tr>
        <td id='StudiesPercent'colspan='2'></td>
      </tr>
      <tr>
        <td>
          Numarul de voturi provenite din regiunea           
          <select id='region'>
            <option value='Banat'>Banat</option>
            <option value='Crisana'>Crisana</option>
            <option value='Dobrogea'>Dobrogea</option>
            <option value='Maramures'>Maramures</option>
            <option value='Moldova'>Moldova</option>
            <option value='Muntenia'>Muntenia</option>
            <option value='Oltenia'>Oltenia</option>
            <option value='Transilvania'>Transilvania</option>
          </select> 
        </td>
        <td>
          <button type='button' id='BttnGenRegionVotes'>Genereaza</button>
        </td>
      </tr>
      <tr>
        <td id='RegionVotes' colspan='2'></td>
      </tr>
      <tr>
        <td>
          Partidul majoritar din regiunea 
          <select id='region_maj'>
            <option value='Banat'>Banat</option>
            <option value='Crisana'>Crisana</option>
            <option value='Dobrogea'>Dobrogea</option>
            <option value='Maramures'>Maramures</option>
            <option value='Moldova'>Moldova</option>
            <option value='Muntenia'>Muntenia</option>
            <option value='Oltenia'>Oltenia</option>
            <option value='Transilvania'>Transilvania</option>
          </select> 
        </td>
        <td>
          <button type='button' id='BttnGenRegWin'>Genereaza</button>
        </td>
      </tr>
      <tr>
        <td id='RegWin' colspan='2'></td>
      </tr>
    </table>  
      
</html> 
