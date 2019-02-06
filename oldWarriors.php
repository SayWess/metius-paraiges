<!DOCTYPE html>
<?php 
	
	if(count($_COOKIE) > 0) {
		$cookie = json_decode($_COOKIE['metius-settings'], true);
		$cssFile = "CSS/OldWarriors/oldWarriors".$cookie['Theme'];
	} else {
		$cssFile = "CSS/OldWarriors/oldWarriorsLight1";
	}
	
	include "Templates/head.php"; 

?>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "les disparus"; //On définit $pageActive par "clan", pour indiquer que la page qui est active est clan
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>


<!-- PARTIE OU L'ON AFFICHE LES STATS DU JOUEUR  -->
<div class="containerMoyen"> 
    <div class="col-sm-12 w3-animate-zoom articleOldWarriors">
		<h1 class="TitreGuerriers"> Ancien Guerriers </h1>
		<div class="flex">
			<?php 
			
			function anniversaireJoueurClan() {
			
				$oldWarriors = file_get_contents("JSON/oldWarriors.json");
				$oldWarriors = json_decode($oldWarriors, true);
				
				$membersClan = file_get_contents("JSON/clan.json");
				$membersClan = json_decode($membersClan);
				
				//On créer un tableau pour les membres du clan actuel
				$clanMembersActuel = array();
	
				$i = 0;
				//Pour chaque membre du clan
				foreach($membersClan->{"members"} as $member) {
					//On prend son tag
					$tag = $membersClan->{"members"}[$i]->tag;
					//Et on l'ajoute dans le tableau des membres du clan actuel
					array_push($clanMembersActuel, $tag);
					$i++;
				}
	
	
				//On définit la variable $tagJoueurs a un espace, pour que le $tagJoueur .= $enfin puisse marcher
				$tagJoueurs = "";
				
				//Pour chaque tableau du tableau $oldWarriors(Tableau multi-dimensionnel) contenant les tag des joueurs partis tel jour
				foreach($oldWarriors as $key => $dateParti) {
					//Pour chaque date (même si il n'y en a qu'une par tableau)
					foreach($dateParti as $tag) {
						
						//Pour chaque tag de joueurs partis
						foreach($tag as $tag) {
							//Si le tag du joueur n'est pas dans le clan actuellement
							if(!in_array($tag, $clanMembersActuel)) {
								//On prend les données de son fichier joueur
								$fichierJoueurParti = file_get_contents("JSON/joueurProfil/$tag.json"); 
								//On ne le decode pas en array classique mais on le laisse en stdClass (tableau d'objet)
								$fichierJoueurParti = json_decode($fichierJoueurParti);
								
								
								//On prend le fichier newWarrior (Pour les dates d'arrivées)
								$dateArrivee = file_get_contents("JSON/newWarriors.json");
								//On le decode et on met true pour l'avoir en array et non en stdClass
								$dateArrivee = json_decode($dateArrivee, true);
								
								//Pour chaque tableau du tableau $dateArrivee(Tableau multi-dimensionnel) contenant les tag des joueurs arrivés tel jour
								foreach($dateArrivee as $key => $value) {
									//Pour chaque date
									foreach($value as $joueur) {
										//Pour chaque joueur du tableau de la date
										foreach($joueur as $joueur) {
											//Si le tag du joueur partis ($tag) et le même que le tag du joueur arrivée 
											if($tag == $joueur) {
												//On prend la key(la date) du tableau $value
												$dateArrivee = key($value);
											}
										}
									}
								}
								//On prend la key (La date dans ce cas) du tableau $dateParti
							
								?>
								
								
								<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> <?php echo $fichierJoueurParti->name ?> </h2>
											<img class="level" src="image/level<?php echo $fichierJoueurParti->{"stats"}->level ?>.png">
										</div>
										<p class="TagGuerrier"> #<?php echo $fichierJoueurParti->tag ?> </p>
										<p class="trophees"> <?php echo $fichierJoueurParti->{"stats"}->maxTrophies ?> <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du <?php echo $dateArrivee ?> au <?php echo key($dateParti) ?> </p>
									</div>
								
								</div>
								
								
								
								<?php
									
							}
						}
					}
				}
			}
			//Fonction enfin terminée mdr
			
			//On echo la fonction
			echo anniversaireJoueurClan();
			?>
			
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> CFD</h2>
											<img class="level" src="image/level13.png">
										</div>
										<p class="TagGuerrier"> #25J5H431RT</p>
										<p class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du 01|17 au 12|19</p>
									</div>
			</div>
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> CFD</h2>
											<img class="level" src="image/level1.png">
										</div>
										<p class="TagGuerrier"> #25J5H431RT</p>
										<p class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du 01|17 au 12|19</p>
									</div>
			</div>
	 		<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> CFD</h2>
											<img class="level" src="image/level1.png">
										</div>
										<p class="TagGuerrier"> #25J5H431RT</p>
										<p class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du 01|17 au 12|19</p>
									</div>
			</div>
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> CFD</h2>
											<img class="level" src="image/level1.png">
										</div>
										<p class="TagGuerrier"> #25J5H431RT</p>
										<p class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du 01|17 au 12|19</p>
									</div>
			</div>
	 		<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> CFD</h2>
											<img class="level" src="image/level1.png">
										</div>
										<p class="TagGuerrier"> #25J5H431RT</p>
										<p class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du 01|17 au 12|19</p>
									</div>
			</div>
	 		<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h2 class="NomGuerrier"> CFD</h2>
											<img class="level" src="image/level1.png">
										</div>
										<p class="TagGuerrier"> #25J5H431RT</p>
										<p class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </p>
										<p class="date"> Du 01|17 au 12|19</p>
									</div>
			</div>
			
		</div>
		
		<!--<script> 
		
	//Longueur du background fondbois, pour que les affiches des joueurs soient dans les rangées du background
		function background() {
			var nbJoueur = $('div.joueurParti').length;
			var x = nbJoueur / 4;
			x = Math.ceil(x);
			var pourcentage = 100 / x;
			var size = pourcentage.toFixed(2) + "%";
			$('.flex').css("background-size", "100% " + size);
		}
		background()
	
	//Choisir aléatoirement la feuille d'un joueur'
		function balancier() {
			document.querySelectorAll('.joueurParti').forEach(joueur => joueur.classList.remove("balancier"));
			var nbJoueur = $('div.joueurParti').length;
			var time = Math.ceil(Math.random() * nbJoueur);
			document.querySelector('div.joueurParti:nth-child(' + time + ')').classList.add("balancier");
			setTimeout(balancier, 50000);
			console.log(time)
		}
		balancier();
		
		
		</script>-->
	
		
		
	</div>
</div>
    
<!-- Bas de page -->
<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-13</p>
</div>

</body>
</html>

