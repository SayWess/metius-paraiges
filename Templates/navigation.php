<?php 

	$clan  = "";
	$reglement  = "";
	$recrutement  = "";
	$login = "";
	$admin  = "";
	$deconnection = "";
	$oldwarriors = "";
	$LogOuAdmin = "login.php";
	
	
	if($pageActive == "clan") {
		$clan = "active";
	} elseif($pageActive == "reglement") {
		$reglement = "active";
	} elseif($pageActive == "recrutement") {
		$recrutement = "active";
	} elseif($pageActive == "espace admin") {
		$admin = "active";
		$deconnection = "true";
	} elseif($pageActive == "les disparus") {
		$oldwarriors = "active";
	} elseif($pageActive == "login") {
		$admin = "active";
	} elseif($pageActive == "profil") {
		$clan = "active";
	}
	
	if(isset($_SESSION['username'])) {
		$LogOuAdmin = "espaceadmin.php";
	}
	
?>



<nav class="navbar navbar-expand-sm bg-dark navbar-dark">                                                                                           <!--  Barre de navigation avec bootstrap  -->
  <a class="navbar-brand" href="index.php" onclick="LinkSound()">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link<?= $clan ?>" href="clan.php" onclick="LinkSound()">Clan</a>                                             <!--  "linkactive" signifie que c'est le lien actif, pour que l'utilisateur repère sur quelle page il est  -->
      </li>
      <li class="nav-item">
        <a class="nav-link<?= $reglement ?>" href="reglement.php" onclick="LinkSound()">Règlement</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?= $recrutement ?>" href="recrutement.php" onclick="LinkSound()">Recrutement</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link<?= $admin ?>" href="<?= $LogOuAdmin ?>" onclick="LinkSound()">Espace Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?= $oldwarriors ?>" href="oldWarriors.php" onclick="LinkSound()">Les disparus</a>
      </li>
    </ul>
  </div> 
  <?php
      
		if($deconnection == "true") {
		?>
		<li class="nav-item">
			<a class='navbar-brand' href='logout.php' onclick="LinkSound()">Se déconnecter</a>
		</li>
		<?php
		}
      ?>
		<li class="nav-item">
			<a class='navbar-brand' href='parametre.php' onclick="LinkSound()"><img class="parametre" src="image/parametre.png" alt="Paramètres"></a>
		</li>
</nav> 





