<!DOCTYPE html>
<html lang="en">
<head>



  <title>Métius Paraiges</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="oldWarriors.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">                                                                           <!--  Utilisation Boostrap et W3.css  -->
  <link rel="stylesheet" href="oldWarriors.css" type="text/css">
  
  <link rel="icon" href="image/ImageClan.jpeg" type="image/jpeg">


  
</head>
<body>

<div class="jumbotron header"></div>                                                                                                                <!--  En-tête de page (image)  -->


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">                                                                                           <!--  Barre de navigation avec bootstrap  -->
  <a class="navbar-brand" href="index.html">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="clan.php">Clan</a>                                                                         <!--  "linkactive" signifie que c'est le lien actif, pour que l'utilisateur repère sur quelle page il est  -->
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reglement.html">Règlement</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="recrutement.html">Recrutement</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" href="login.php">Espace Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-linkactive" href="oldWarriors.php">Les disparus</a>
      </li>
    </ul>
  </div>  
</nav>


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
											<h3 class="NomGuerrier"> <?php echo $fichierJoueurParti->name ?> </h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #<?php echo $fichierJoueurParti->tag ?> </h6>
<!-- 									<h3> <?php //echo $fichierJoueurParti->{"stats"}->level ?> </h3> -->
										<h5 class="trophees"> <?php echo $fichierJoueurParti->{"stats"}->maxTrophies ?> <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du <?php echo $dateArrivee ?> au <?php echo key($dateParti) ?> </h3>
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
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
	 		<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
	 		<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
	 		<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
					<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
			<div  class="joueurParti">
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
			<div  class="joueurParti"> 
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>
 			<div  class="joueurParti"> 
									<div class="Guerrier">
										<div class="levelEtNom">
											<h3 class="NomGuerrier"> CFD</h3>
											<img class="level" src="image/level1.png">
										</div>
										<h6 class="TagGuerrier"> #25J5H431RT</h6>
										<h5 class="trophees"> 5200 <img class="tropheesImage" src="image/trophees.png"> max </h5>
										<h3 class="date"> Du 01|17 au 12|19</h3>
									</div>
			</div>

		</div>
		
		<script> 
		
	//Longueur du background fondbois, pour que les affiches des joueurs soient dans les rangées du background
		function background() {
			var nbJoueur = $('div.joueurParti').length;
			nbJoueurs = nbJoueur - nbJoueur  % 4 + 4
			var x = nbJoueurs / 4;
			var pourcentage = 100 / x;
			var size = pourcentage.toFixed(2) + "%";
			$('.flex').css("background-size", "100% " + size);
		}
		background()
	
	//Choisir aléatoirement la feuille d'un joueur'
		function balancier() {
			var nbJoueur = $('div.joueurParti').length;
			var time = Math.ceil(Math.random() * nbJoueur);
			document.querySelector('div.joueurParti:nth-child(' + time + ')').classList.add("balancier");
			setTimeout(balancier, 1000);
		}
		balancier();
		
		
		</script>
	
		
		
	</div>
</div>
    
<!-- Bas de page -->
<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-13</p>
</div>

</body>
</html>

