<?php 

	$clan  = "";
	$reglement  = "";
	$recrutement  = "";
	$login = "";
	$admin  = "";
	$deconnection = "";
	$oldwarriors = "";
	
	
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
	
?>



<nav class="navbar navbar-expand-sm bg-dark navbar-dark">                                                                                           <!--  Barre de navigation avec bootstrap  -->
  <a class="navbar-brand" href="index.php" onclick="sound()">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link<?php echo $clan ?>" href="clan.php" onclick="sound()">Clan</a>                                             <!--  "linkactive" signifie que c'est le lien actif, pour que l'utilisateur repère sur quelle page il est  -->
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo $reglement ?>" href="reglement.php" onclick="sound()">Règlement</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo $recrutement ?>" href="recrutement.php" onclick="sound()">Recrutement</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link<?php echo $admin ?>" href="login.php" onclick="sound()">Espace Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo $oldwarriors ?>" href="oldWarriors.php" onclick="sound()">Les disparus</a>
      </li>
    </ul>
  </div> 
  <?php
      
		if($deconnection == "true") {
		?>
		<li class="nav-item">
			<a class='navbar-brand' href='logout.php' onclick="sound()">Se déconnecter</a>
		</li>
		<?php
		}
      ?>
		<li class="nav-item">
			<a class='navbar-brand' href='parametre.php' onclick="sound()"><img class="parametre" src="image/parametre.png" alt="Paramètres"></a>
		</li>
</nav> 





