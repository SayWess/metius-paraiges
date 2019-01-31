<!DOCTYPE html>
<?php 

	$cssFile = "reglement";
	include "Templates/head.php"; 

?>
<body>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "reglement"; //On définit $pageActive par "home", pour indiquer que la page qui est active est home
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<div class="container">
  <div class="row">
    
    <div class="col-sm-12 w3-animate-zoom article">
      <h1 class="text-center ">Règlement du clan :</h1>
      <br>
      <p class="policemoyen"> -Obligation de faire ses combats de GDC si il y a participation. </p>
      <br>
      <p class="policemoyen"> -Doit être respectueux envers autrui.</p>
      <br>
      <p class="policemoyen"> -Doit être actif.</p>
      <br>
      <p class="policemoyen"> -Participer à au moins une GDC par mois. </p>
      <br>
      <p class="policemoyen"> -Doit être actif.</p>
      <br>
      <p class="policemoyen"> -Participer à au moins une GDC par mois. </p>
      <br>
      <p class="policemoyen"> -Doit être actif.</p>
      <br>
      <p class="policemoyen"> -Participer à au moins une GDC par mois. </p>
      <br>
    </div>
    
  </div>
</div>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

</body>
</html>

