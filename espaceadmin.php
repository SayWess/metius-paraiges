<?php

session_start();

//if(!isset($_SESSION['username'])) {
//    die('please <a href="login.php">login</a>');
    
//}


//echo "hello ". $_SESSION['username'];

?>

<?php 

	$cssFile = "espaceadmin";
	include "Templates/head.php"; 

?>
<body>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "espace admin"; //On définit $pageActive par "clan", pour indiquer que la page qui est active est clan
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>


<div class="container"">
  <div class="row">
    
    <div class="col-sm-12 w3-animate-zoom article">
      <p> <?php 
      echo "<h2>Bonjours ". $_SESSION['username']."</h2>";
      ?> </p> 
      <br>
      <h5>How are you today ? </h5> 
      <br>
      <h5>Thank you very much TrainZug ! </h5>
      <br>
      <br>
    </div>
    
    
  </div>
</div>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-06</p>
</div>

</body>
</html>

