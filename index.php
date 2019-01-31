<!DOCTYPE html>

<?php 

	$cssFile = "home";
	include "Templates/head.php"; 

?>

<body onload="musicFond()">

<script> 

var mySound;
var myMusic;

function musique() {
    myMusic = new sound("34_Clash_of_Kings.mp3");
    myMusic.play();
}

</script>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "home"; //On définit $pageActive par "home", pour indiquer que la page qui est active est home
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<div class="container" style="margin-top:30px">
  <div class="row">
  
     <div class="col-sm-12 w3-animate-zoom article">
      <img src="image/CartesCR/CR_Sorcier.png" class="w3-animate-zoom float-right imagenone"></img>
      <h2>Métius Paraiges</h2>
      <br>
      <h4>Description :</h4>
      <br>
      <p>Métius Paraiges est un clan français qui est présent sur Clash Royale, un jeu ou des millions de personnes s'affrontent en ligne pour être le meilleur !</p>
      <br>
      <h6> Le 26 Décembre 2018 </h6>
     </div>
    
    <div class="col-sm-12 w3-animate-zoom article">
      <img src="image/CartesCR/CR_Squelette.png" class="w3-animate-zoom float-right imagenone"></img>
      <h2>Dernière News !</h2>
      <br>
      <h4>Enfin, le voila !</h4>
      <br>
      <p>Après plusieurs mois de travail, le site Métius Paraiges est enfin là ! Il est tout beau, tout fini, le voilà à votre disposition !</p> <br>
      <br>
      <h6>Le 26 Décembre 2018</h6>
      <br>     
    </div>
    
    <div class="col-sm-12 w3-animate-zoom article">
      <img src="image/CartesCR/CR_Esprits de Feu.png" class="w3-animate-zoom float-right imagenone"></img>
      <h2>Contrat SUPERCELL</h2>
      <br>
      <h4>CONTRAT</h4>
      <br>
      <p>"This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-policy."</p>
      <br>
    </div>
    
    
    
  </div>
</div>

<!--<audio src="Sounds/One Piece Epic Music.mp3"  controls></audio> -->

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

</body>
</html>

