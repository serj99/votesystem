<?php
session_start();

$mysqli = @new mysqli("localhost", "votesystdbuser", "12345", "votesystdb");
if($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno);
}

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

$loginfailed = 0;
if(isset($_POST['btn-login']))
{	
	$email = $_POST['email'];
	$pass = $_POST['pass'];

    if($stmt = $mysqli->prepare("SELECT id_votant, parola FROM votant WHERE email=?")) {
        $stmt->bind_param("s", $email);
        $stmt->bind_result($voterid, $pw);
        $stmt->execute();
        $stmt->fetch();
        if(password_verify($pass, $pw)) {
            if($voterid == 51)
                $_SESSION['root'] = 1;
            $_SESSION['user_id'] = $voterid;
            $stmt->close();
            header("Location: home.php");
        }
        else 
            $loginfailed = 1;
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="frontpage-background">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simulare votare prezidentiala</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>



<div id="login-form">
  <form action="index.php" method="post">
    <table width="30%">
      <tr>
        <td>
          <table>
            <tr> <td><h4>Votul este important iar tu decizi!</h4></td> </tr>
            <tr> <td><input type="text" name="email" placeholder="Email" required /></td> </tr>
            <tr> <td><input type="password" name="pass" placeholder="Parola" required /></td> </tr>
            <tr> <td><button type="submit" name="btn-login">Autentificare</button></td> </tr>
            <tr> <td><a href="register.php"><button type='submit'>Inregistrare</button></a></td> </tr>
          </table>
        </td>
        <td> 
          <table><tr><td><img src="images/vote_logo.png" alt=""></td></tr></table> 
        </td>
      </tr>
    </table>
  </form>
</div>
<div>
<?php
    if($loginfailed)
        echo "<div id='red_message'>Parola/email-ul oferit nu este in regula. Reincearca!</div>";
?>

</body>

</html>

