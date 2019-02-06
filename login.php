<?php

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $users = json_decode(file_get_contents("secrets.json"), true);
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (array_key_exists($username, $users)) {
        if ($users[$username] == $password) {
            $_SESSION['username'] = $username;
            header("Location: espaceadmin.php");
            // redirect to where you want
        } else {
            echo "wrong password";
        }
    } else {
        echo "unknown user";
    }
} else { ?>

<?php 

	$cssFile = "login";
	include "Templates/head.php"; 

?>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "login"; //On définit $pageActive par "clan", pour indiquer que la page qui est active est clan
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<div class="container">
  <div class="row">
    
    <div class="col-sm-12 w3-animate-zoom article">
      <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
    <div class="form-group">
      <h1>Admin login</h1>
      <br><br>
      <h4>Name:</h4>
      <input type="text" class="form-control" id="name" placeholder="Enter your name" name='username'>
    </div>
      <br>
    <div class="form-group">
      <h4>Password:</h4>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name='password'>
    </div>
    <br><br><br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
      <br>
    </div>
    
    <img src="image/CartesCR/CR_Geant Royal.png" class="w3-animate-right float-right image"></img>
    
    
  </div>
</div>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

</body>
</html>

<?php } ?>
