<?php
session_start();

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

function phpAlert($msg) 
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}


$mysqli = @new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno);
}
else
	echo("<div style='font-size:x-small'>Connected succesfully to database!<br></div>");	 

$newuser = -1;
if(isset($_POST['btn-signup']))
{
	$email = $_POST['email'];	
	//check if the email already exists 
    if($stmt = $mysqli->prepare("SELECT nume FROM votant WHERE email=?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();
        echo "nume votant: $name";
        if($name) {
            $newuser = 0;
        }
        $stmt->close();
    }
    
    //if we got new user
    if($newuser) {
        echo "email: $email<br>";
        $secondname = $_POST['nume'];
        $firstname = $_POST['prenume'];
        $age = $_POST['varsta'];
        $pw = $_POST['parola'];
        $pw = password_hash($pw, PASSWORD_DEFAULT);

        //fara educatie superioara = 0
        //cu educatie superioara = 1 
        $education = $_POST['educatie'];

        //500-1400 = nivelul 1
        //1400-3500 = nivelul 2
        //peste 3500 = nivelul 3
        $salary_range = $_POST['educatie'];
        $family = $_POST['casatorit'];
        
        if($stmt = $mysqli->prepare("INSERT INTO votant(nume, prenume, email,
                                     parola, varsta, educatie, venit_lunar, casatorit) 
                                     VALUES(?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ssssssss", $secondname, $firstname, $email, $pw, $age,
                              $education, $salary_range, $family);
            $stmt->execute();
            $newuser = 1;
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
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
        <td><label for='varsta'>Varsta</label></td>
        <td><input type="text" id='varsta' name="varsta"></td>
      </tr>
      <tr>
        <td><label for='email'>Email</label></td>
        <td><input type="text" id="email" name="email"></td>
      </tr>
      <tr>
        <td><label for='parola'>Parola</label></td>
        <td><input type="password" id='parola' name="parola"></td>
      </tr>
      <tr>
        <td><label for='educatie'>Educatie</label></td>
        <td>
          <select name='educatie' id='educatie'>
            <option value="0">Fara studii superioare</option>
            <option value="1">Cu studii superioare</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for='venit'>Venit lunar</label></td> 
        <td>
          <select name='venit' id='venit'>
            <option value="1">500-1400</option>
            <option value="2">1400-3500</option>
            <option value="3">peste 3500</option>
            </select>
        </td>
      </tr>
      <tr>
        <td><label for='casatorit'>Casatorit</label></td>
        <td>
          <select name='casatorit' id='casatorit'>
            <option value="-1">nu</option>
            <option value="0">fara copii</option>         
            <option value="1">1 copil</option>         
            <option value="2">2 copii</option>         
            <option value="3">3 copii</option>         
            <option value="4">4 copii</option>         
            <option value="5">5 copii</option>         
            <option value="10">mai mult de 5 copii</option>        
          </select>
        </td>
      </tr>
      <tr>   
        <td colspan='2'>
          <input type="submit" name='btn-signup' value="Inregistrare cont">
          <a href='index.php'><button type='button'>Inapoi</button></a>
        </td>
      </tr>
    </table>
  </form>
  <?php
    if($newuser==0)
        echo "<p class='red_message'>Un votant exista deja cu acest mail! Incearca din nou!</p>";
    if($newuser==1)
        echo "<p class='green_message'>Te-ai inregistrat cu succes! Votul tau conteaza!</p>";
  ?>


</body>

</html>

