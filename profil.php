<!DOCTYPE html>
<?php 

	$cssFile = "profil";
	include "Templates/head.php"; 

?>                                                                                                         <!--  En-tête de page (image)  -->

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "profil"; //On définit $pageActive par "clan", pour indiquer que la page qui est active est clan
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<?php
	//ON RECUPERE LA VALEUR TAG QUI A ETE APPORTE PAR L'URL
	$tag = $_GET['tag'];
	$dataJoueur = file_get_contents("JSON/joueurProfil/$tag.json", true);
	$dataJoueur = json_decode($dataJoueur);
	$pseudo = $dataJoueur->name;
	$level = $dataJoueur->{"stats"}->level;

	//SI LE MEILLEUR TROPHEE DE LA SAISON ACTUEL N'EST PAS PRESENT DANSLE FICHIER JSON
	if(!isset($dataJoueur->{"leagueStatistics"}->{"currentSeason"}->bestTrophies)) {
				//LA VALEUR EST EGALE A RIEN, A UN ESPACE QUOI
                $saisonActuel = "";
             } else {
				//SINON, ELLE EST EGALE AU NOMBRE DE MEILLEUR TROPHEE DE CETTE SAISON
                $saisonActuel = $dataJoueur->{"leagueStatistics"}->{"currentSeason"}->bestTrophies;
             }
	//MEME PRINCIPE QUE AU DESSUS
	if(!isset($dataJoueur->{"leagueStatistics"}->{"previousSeason"}->trophies)) {
                $saisonPrecedenteTrophees = "";
             } else {
                $saisonPrecedenteTrophees = $dataJoueur->{"leagueStatistics"}->{"previousSeason"}->trophies;
             }
	//MEME PRINCIPE QUE AU DESSUS
	if(!isset($dataJoueur->{"leagueStatistics"}->{"previousSeason"}->bestTrophies)) {
                $saisonPrecedente = "";
             } else {
                $saisonPrecedente = $dataJoueur->{"leagueStatistics"}->{"previousSeason"}->bestTrophies;
             }
	//MEME PRINCIPE QUE AU DESSUS MAIS AVEC UN PETIT CHANGEMENT POUR LA DATE DE LA MEILLEUR SAISON
	if(!isset($dataJoueur->{"leagueStatistics"}->{"bestSeason"}->trophies)) {
                $meilleurSaison = "";
             } else {
                $dateMeilleurSaison = $dataJoueur->{"leagueStatistics"}->{"bestSeason"}->id;
                //ON ENLEVE LES 2 PREMIERS CHIFFRES/LETTRES SOIT 2 ET 0 DE 2018 POUR QUE CA SOIT MOINS LONG  
                $date = substr($dateMeilleurSaison, 2);
                $meilleurSaison = $dataJoueur->{"leagueStatistics"}->{"bestSeason"}->trophies." | ".$date;
             }

?>

<!-- PARTIE OU L'ON AFFICHE LES STATS DU JOUEUR  -->
<div class="containerlargeclan"> 
    <div class="col-sm-12 w3-animate-zoom articleclan">
    
		<div class="text-left EnTeteProfil">
			<h2 class="pasDeMarge"> <?php echo $pseudo ?> </h2>
			<p class="pasDeMarge"> #<?php echo $dataJoueur->tag ?> </p>
			<div class="flexLevelAndTrophees">
				<h3 class="levelJoueur"> <?php echo $level ?> </h3> | <h3 class="tropheesActuel"> <img src="image/Podiums.png" class="imageTropheesActuel"> <?php echo $dataJoueur->trophies ?>  </h3>
			</div>
		</div>
		
		<div class="Statistiques">
			<div class="text-left Stats">
				<h2 class="TitreStatistiques"> Combats </h2>
				<h5> Victoires : <?php echo $dataJoueur->{"games"}->wins ?>  </h5>
				<h5> Dont <?php echo $dataJoueur->{"stats"}->threeCrownWins ?> à 3 couronnes  </h5>
				<h5> Défaites : <?php echo $dataJoueur->{"games"}->losses ?>  </h5>
				<h5> Egalité : <?php echo $dataJoueur->{"games"}->draws ?>  </h5>
				<h5> Pourcentage de victoires : <?php echo $dataJoueur->{"games"}->winsPercent*100 ?>% </h5>
				<h5> Pourcentage de défaites : <?php echo $dataJoueur->{"games"}->lossesPercent*100 ?>% </h5>
				<h5> Pourcentage d'égalités : <?php echo $dataJoueur->{"games"}->drawsPercent*100 ?>%  </h5>
				<h5> Jours de guerre gagnés : <?php echo $dataJoueur->{"games"}->warDayWins ?>  </h5>
			</div>
			<div class="text-left Stats">
				<h2 class="TitreStatistiques"> Saisons </h2>
				<h5> Meilleur trophées de la saison actuel : <?php echo $saisonActuel ?>  </h5>
				<h5> Nombre de trophées saison précédente : <?php echo $saisonPrecedenteTrophees ?>  </h5>
				<h5> Meilleur trophées saison précédente : <?php echo $saisonPrecedente ?>  </h5>
				<h5> Trophées de meilleur saison : <?php echo $meilleurSaison ?>  </h5>
			</div>
			<div class="text-left Stats">
				<h2 class="TitreStatistiques"> Tournois et défis </h2>
				<h5> Parties en tournois et défi : <?php echo $dataJoueur->{"games"}->tournamentGames ?>  </h5>
				<h5> Cartes gagnées en tournois : <?php echo $dataJoueur->{"stats"}->tournamentCardsWon ?>  </h5>
				<h5> Cartes gagnées en défi : <?php echo $dataJoueur->{"stats"}->challengeCardsWon ?>  </h5>
				<h5> Victoires maximum en défi : <?php echo $dataJoueur->{"stats"}->challengeMaxWins ?>  </h5>
			</div>
			<div class="text-left Stats">
				<h2 class="TitreStatistiques"> Joueur</h2>
				<h5> Cartes trouvées : <?php echo $dataJoueur->{"stats"}->cardsFound ?>  </h5>
				<h5> Max trophées : <?php echo $dataJoueur->{"stats"}->maxTrophies ?>  </h5>
				<h5> Grade : <?php echo $dataJoueur->{"clan"}->role ?>  </h5>
				<h5> Dons : <?php echo $dataJoueur->{"clan"}->donations ?>  </h5>
				<h5> Dons reçus : <?php echo $dataJoueur->{"clan"}->donationsReceived ?>  </h5>
				<h5> Total dons : <?php echo $dataJoueur->{"stats"}->totalDonations ?>  </h5>
		</div>
		</div>
		
		
	</div>
	
</div>

<!-- PARTIE OU SONT AFFICHES LES COFFRES A VENIR  -->
<div class="containerlarge">
  <div class="row">
    <div class="col-sm-12 w3-animate-zoom article">
	  <h1 class="text-center"> Prochains coffres : </h1>
		<div class="flexCoffres">
		<?php 

		$joueurCoffres = file_get_contents("JSON/joueurChest/$tag.json");
		$joueurCoffres = json_decode($joueurCoffres);
		$r = 1;
		$i = 0;
		while($r < 10) {
			if($joueurCoffres->{"upcoming"}[$i]) {
				$name = $joueurCoffres->{"upcoming"}[$i];
				$c = "<img class='coffres' src='image/chest-$name.png'>";
				$i++;
			}
	
?>
		<div class="w3-display-container w3-text-white"> 
			<?php echo $c ?>
			<div class="w3-display-bottomright numerotationCoffres"><p>+ <?php echo $r ?></p></div>
		</div>
		<?php
		$r++;
		$c++;
			}
		?>
		</div>
		<div class="flexCoffres"> 
			<div class="w3-display-container w3-text-white">
				<img class="coffres" src="image/chest-magical.png">
				<div class="w3-display-bottomright numerotationCoffres"><p>+ <?php echo $joueurCoffres->magical+1 ?></p></div>
			</div>
			<div class="w3-display-container w3-text-white">
				<img class="coffres" src="image/chest-megalightning.png">
				<div class="w3-display-bottomright numerotationCoffres"><p>+ <?php echo $joueurCoffres->megaLightning+1 ?></p></div>
			</div>
			<div class="w3-display-container w3-text-white">
				<img class="coffres" src="image/chest-legendary.png">
				<div class="w3-display-bottomright numerotationCoffres"><p>+ <?php echo $joueurCoffres->legendary+1 ?></p></div>
			</div>
			<div class="w3-display-container w3-text-white">
				<img class="coffres" src="image/chest-giant.png">
				<div class="w3-display-bottomright numerotationCoffres"><p>+ <?php echo $joueurCoffres->giant+1 ?></p></div>
			</div>
			<div class="w3-display-container w3-text-white">
				<img class="coffres" src="image/chest-epic.png">
				<div class="w3-display-bottomright numerotationCoffres"><p>+ <?php echo $joueurCoffres->epic+1 ?></p></div>
			</div>
		</div>
		
		
    </div>
  </div>
</div>

<div class="containerlarge">
  <div class="row">
    <div class="col-sm-12 w3-animate-zoom article">
		<h1 class="text-center"> Cartes : </h1>
		<div class="flexCartes legendaires">
		
		<?php 
		
		$carteJoueur = $dataJoueur->{"cards"};
		$i = 0;
		foreach($carteJoueur as $carte) {
		  $carteInfo = $dataJoueur->{"cards"}[$i];
		  if($carteInfo->rarity == "Legendary") {
			$name = $dataJoueur->{"cards"}[$i]->key;
			$name = "<img alt='$name' class='cartes' src='image/$name.png'>";
			$priority = $carteInfo->displayLevel;
			
			if($carteInfo->requiredForUpgrade == "Maxed") {
				$nombreCarte = "Maxées";
			} else {
				$nombreCarte = $carteInfo->count."/".$carteInfo->requiredForUpgrade;
			}
			
			$level = $carteInfo->displayLevel;
			if($carteInfo->requiredForUpgrade !== "Maxed") {
				$width = ceil($carteInfo->count / $carteInfo->requiredForUpgrade*100);
				$barre = "<div class='progression' style='width:$width%'></div>";
				if($width >= 100) {
					$barre = "<div class='niveauSupPossible' style='width:100%'></div>";
				}
			} elseif($carteInfo->requiredForUpgrade == "Maxed") {
				$barre = "<div class='niveauMaxed' style='width:100%'></div>";
			}   
		
		?>
		
		<div class="w3-display-container w3-text-white spaceBetween <?php echo $priority ?>">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
				<div class="w3-card"> 
					<div class="nombreCartes"><p class="sansMarge" data-value="<?php echo $carteInfo->count/1000 ?>"><?php echo $nombreCarte ?></p></div>
					<div class="couleurFondBarre">
						<?php echo $barre ?>
					</div>
				</div>
		</div>
		<?php
			} 
		$i++;
		}
		
		$carteDuJeu = file_get_contents("JSON/cartesClashRoyale.json");
		$carteJeu = json_decode($carteDuJeu);
		$carteDuJeu = $carteJeu->{"cards"};
		
		
		$carteTableau = array();
		$i = 0;
		foreach($dataJoueur->{"cards"} as $carta) {
			array_push($carteTableau, strval($dataJoueur->{"cards"}[$i]->key));
			$i++;
		}
		
		$Jeu = array();
		$c = 0;
		foreach($carteJeu->{"cards"} as $carta) {
			array_push($Jeu, strval($carteJeu->{"cards"}[$c]->key));
			$c++;
		}
		
		$carteManquante = array();
		$o = 0;
		foreach($Jeu as $carteJEU) {
			if (!in_array($Jeu[$o], $carteTableau)) {
				array_push($carteManquante, $Jeu[$o]);
			}
			$o++;
		}
		
		
		
		
		
		$carteDuJe = file_get_contents("JSON/cartesClashRoyale.json");
		$CARTEjeu = json_decode($carteDuJe);
		$rarete = array();
		$i = 0;
		foreach($CARTEjeu->{"cards"} as $carteJeu) {
			if(in_array(strval($CARTEjeu->{"cards"}[$i]->key), $carteManquante)) {
				array_push($rarete, $CARTEjeu->{"cards"}[$i]->rarity);
			}
			$i++;
		}
		
		//FONCTION POUR AFFICHER LES CARTES LEGENDAIRES MANQUANTES 
		$i = 0;
		//POUR CHAQUE CARTE MANQUANTE
		foreach($carteManquante as $carteMANQUANTE) {
		  if($rarete[$i] == "Legendary") {
			$name = $carteManquante[$i];
			$name = "<img alt='$name' class='cartes w3-grayscale-max' src='image/$name.png'>";
			$nombreCarte = "0/0";
			$level = 9;
			$width = 0;
			$barre = "<div class='progression' style='width:$width%'></div>";
		
		?>
		<div class="w3-display-container w3-text-white spaceBetween 9">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
		</div>
		<?php
			} 
		$i++;
		}
		?>
		
	
		
		</div>

		<div class="flexCartes epiques">
		
		<?php 
		
		$carteJoueur = $dataJoueur->{"cards"};
		$i = 0;
		foreach($carteJoueur as $carte) {
		  $carteInfo = $dataJoueur->{"cards"}[$i];
		  if($carteInfo->rarity == "Epic") {
			$name = $dataJoueur->{"cards"}[$i]->key;
			$name = "<img alt='$name' class='cartes' src='image/$name.png'>";
			$priority = $carteInfo->displayLevel;
			
			if($carteInfo->requiredForUpgrade == "Maxed") {
				$nombreCarte = "Maxées";
			} else {
				$nombreCarte = $carteInfo->count."/".$carteInfo->requiredForUpgrade;
			}
			
			$level = $carteInfo->displayLevel;
			if($carteInfo->requiredForUpgrade !== "Maxed") {
				$width = ceil($carteInfo->count / $carteInfo->requiredForUpgrade*100);
				$barre = "<div class='progression' style='width:$width%'></div>";
				if($width >= 100) {
					$barre = "<div class='niveauSupPossible' style='width:100%'></div>";
				}
			} elseif($carteInfo->requiredForUpgrade == "Maxed") {
				$barre = "<div class='niveauMaxed' style='width:100%'></div>";
			}   
		?>
		
		<div class="w3-display-container w3-text-white spaceBetween <?php echo $priority ?>">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
				<div class="w3-card"> 
					<div class="nombreCartes"><p class="sansMarge" data-value="<?php echo $carteInfo->count/8000 ?>"><?php echo $nombreCarte ?></p></div>
					<div class="couleurFondBarre">
						<?php echo $barre ?>
					</div>
				</div>
		</div>
		<?php
			} 
		$i++;
		}
		
		//FONCTION POUR AFFICHER LES CARTES EPIQUES MANQUANTES 
		$i = 0;
		//POUR CHAQUE CARTE MANQUANTE
		foreach($carteManquante as $carteMANQUANTE) {
		  if($rarete[$i] == "Epic") {
			$name = $carteManquante[$i];
			$name = "<img alt='$name' class='cartes w3-grayscale-max' src='image/$name.png'>";
			$nombreCarte = "0/0";
			$level = 6;
			$width = 0;
			$barre = "<div class='progression' style='width:$width%'></div>";
		
		?>
		<div class="w3-display-container w3-text-white spaceBetween 6">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
		</div>
		<?php
			} 
		$i++;
		}
		?>
		
		</div>
		
		<div class="flexCartes rares">
		
		<?php 
		
		$carteJoueur = $dataJoueur->{"cards"};
		$i = 0;
		foreach($carteJoueur as $carte) {
		  $carteInfo = $dataJoueur->{"cards"}[$i];
		  if($carteInfo->rarity == "Rare") {
			$name = $dataJoueur->{"cards"}[$i]->key;
			$name = "<img alt='$name' class='cartes' src='image/$name.png'>";
			$priority = $carteInfo->displayLevel;
			
			if($carteInfo->requiredForUpgrade == "Maxed") {
				$nombreCarte = "Maxées";
			} else {
				$nombreCarte = $carteInfo->count."/".$carteInfo->requiredForUpgrade;
			}
			
			$level = $carteInfo->displayLevel;
			if($carteInfo->requiredForUpgrade !== "Maxed") {
				$width = ceil($carteInfo->count / $carteInfo->requiredForUpgrade*100);
				$barre = "<div class='progression' style='width:$width%'></div>";
				if($width >= 100) {
					$barre = "<div class='niveauSupPossible' style='width:100%'></div>";
				}
			} elseif($carteInfo->requiredForUpgrade == "Maxed") {
				$barre = "<div class='niveauMaxed' style='width:100%'></div>";
			}   
		
		?>
		
		<div class="w3-display-container w3-text-white spaceBetween <?php echo $priority ?>">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
				<div class="w3-card"> 
					<div class="nombreCartes"><p class="sansMarge" data-value="<?php echo $carteInfo->count/8000 ?>"><?php echo $nombreCarte ?></p></div>
					<div class="couleurFondBarre">
						<?php echo $barre ?>
					</div>
				</div>
		</div>
		<?php
			} 
		$i++;
		}
		
		//FONCTION POUR AFFICHER LES CARTES RARES MANQUANTES 
		$i = 0;
		//POUR CHAQUE CARTE MANQUANTE
		foreach($carteManquante as $carteMANQUANTE) {
		  if($rarete[$i] == "Rare") {
			$name = $carteManquante[$i];
			$name = "<img alt='$name' class='cartes w3-grayscale-max' src='image/$name.png'>";
			$nombreCarte = "0/0";
			$level = 3;
			$width = 0;
			$barre = "<div class='progression' style='width:$width%'></div>";
		
		?>
		<div class="w3-display-container w3-text-white spaceBetween 3">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
		</div>
		<?php
			} 
		$i++;
		}
		?>
		
		</div>
		
		<div class="flexCartes communes">
		
		<?php 
		
		$carteJoueur = $dataJoueur->{"cards"};
		$i = 0;
		foreach($carteJoueur as $carte) {
		  $carteInfo = $dataJoueur->{"cards"}[$i];
		  if($carteInfo->rarity == "Common") {
			$name = $dataJoueur->{"cards"}[$i]->key;
			$name = "<img alt='$name' class='cartes' src='image/$name.png'>";
			$priority = $carteInfo->displayLevel;
			
			if($carteInfo->requiredForUpgrade == "Maxed") {
				$nombreCarte = "Maxées";
			} else {
				$nombreCarte = $carteInfo->count."/".$carteInfo->requiredForUpgrade;
			}
			
			$level = $carteInfo->displayLevel;
			if($carteInfo->requiredForUpgrade !== "Maxed") {
				$width = ceil($carteInfo->count / $carteInfo->requiredForUpgrade*100);
				$barre = "<div class='progression' style='width:$width%'></div>";
				if($width >= 100) {
					$barre = "<div class='niveauSupPossible' style='width:100%'></div>";
				}
			} elseif($carteInfo->requiredForUpgrade == "Maxed") {
				$barre = "<div class='niveauMaxed' style='width:100%'></div>";
			}   
		
		?>
		
		<div class="w3-display-container w3-text-white spaceBetween <?php echo $priority ?>">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
				<div class="w3-card"> 
					<div class="nombreCartes"><p class="sansMarge" data-value="<?php echo $carteInfo->count/1000 ?>"><?php echo $nombreCarte ?></p></div>
					<div class="couleurFondBarre">
						<?php echo $barre ?>
					</div>
				</div>
		</div>
		<?php
			} 
		$i++;
		}
		
		//FONCTION POUR AFFICHER LES CARTES COMMUNES MANQUANTES 
		$i = 0;
		//POUR CHAQUE CARTE MANQUANTE
		foreach($carteManquante as $carteMANQUANTE) {
		  if($rarete[$i] == "Common") {
			$name = $carteManquante[$i];
			$name = "<img alt='$name' class='cartes w3-grayscale-max' src='image/$name.png'>";
			$nombreCarte = "0/0";
			$level = 1;
			$width = 0;
			$barre = "<div class='progression' style='width:$width%'></div>";
		
		?>
		<div class="w3-display-container w3-text-white spaceBetween 1">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
		</div>
		<?php
			} 
		$i++;
		}
		?>
		
		</div>
		
		<script> //TRIE DES CARTE PAR NIVEAU ET PAS CARTES OPTENUES
		
		//DONNE DES ORDRES DE PRIORITE AUX CARTES EN FONCTION DE LEUR NIVEAU (NIVEAU INDIQUER DANS LES CLASSES DE LA CARTES)
		 $(document).ready(function(){
			//ON PREND L'ELEMENT QUI A LA CLASSE 1, ON AJOUTE LE PROPRIETE CSS ORDER ET ON LUI ATTRIBUT LA VALEUR 13, LA CARTE SERA DONC DISPOSEE EN DERNIERE
			$(".1").css("order", "13");
			$(".2").css("order", "12");
			$(".3").css("order", "11");
			$(".4").css("order", "10");
			$(".5").css("order", "9");
			$(".6").css("order", "8");
			$(".7").css("order", "7");
			$(".8").css("order", "6");
			$(".9").css("order", "5");
			$(".10").css("order", "4");
			$(".11").css("order", "3");
			$(".12").css("order", "2");
			$(".13").css("order", "1");
		 });
		
		//FONCTION DE TRIE DES CARTES LEGENDAIRES SELON LE NOMBRE DE CARTES POSSEDE
		$(document).ready(function(){
				//PREND LES LEGENDAIRES
				var $divLegendaire = $("div.legendaires div.9, div.legendaires div.9, div.legendaires div.10, div.legendaires div.11, div.legendaires div.12, div.legendaires div.13");
				//ON CREE LA FONCTION DE TRIE
				var numericallyOrderedDivs = $divLegendaire.sort(function (a, b) {
				return $(a).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value') < $(b).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value');
				});
				//ON REORGANISE LES CARTES DANS LE NOUVEL ORDRE
				$("div.legendaires").html(numericallyOrderedDivs);
		});
		//FONCTION DE TRIE DES CARTES EPIQUES SELON LE NOMBRE DE CARTES POSSEDE
		$(document).ready(function(){
				var $divEpique = $("div.epiques div.5, div.epiques div.6, div.epiques div.7, div.epiques div.8, div.epiques div.9, div.epiques div.9, div.epiques div.10, div.epiques div.11, div.epiques div.11, div.epiques div.12, div.epiques div.13");
				var numericallyOrderedDivs = $divEpique.sort(function (a, b) {
				return $(a).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value') < $(b).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value');
				});
				$("div.epiques").html(numericallyOrderedDivs);
		});
		//FONCTION DE TRIE DES CARTES RARES SELON LE NOMBRE DE CARTES POSSEDE
		$(document).ready(function(){
				var $divRare = $("div.rares div.3, div.rares div.4, div.rares div.5, div.rares div.6, div.rares div.7, div.rares div.8, div.rares div.9, div.rares div.10, div.rares div.11, div.rares div.12, div.rares div.13");
				var numericallyOrderedDivs = $divRare.sort(function (a, b) {
				return $(a).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value') < $(b).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value');
				});
				$("div.rares").html(numericallyOrderedDivs);
		});
		//FONCTION DE TRIE DES CARTES COMMUNES SELON LE NOMBRE DE CARTES POSSEDE
		$(document).ready(function(){
				var $divCommune = $("div.communes div.1, div.communes div.2, div.communes div.3, div.communes div.4, div.communes div.5, div.communes div.6, div.communes div.7, div.communes div.8, div.communes div.9, div.communes div.10, div.communes div.11, div.communes div.12, div.communes div.13");
				var numericallyOrderedDivs = $divCommune.sort(function (a, b) {
				return $(a).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value') < $(b).find("div.w3-card div.nombreCartes p.sansMarge").attr('data-value');
				});
				$("div.communes").html(numericallyOrderedDivs);
		});
		
		</script>
    
    </div>
    
    <?php
    
		
		/*$carteDuJeu = file_get_contents("JSON/cartesClashRoyale.json");
		$carteJeu = json_decode($carteDuJeu);
		$carteDuJeu = $carteJeu->{"cards"};
		
		
		$carteTableau = array();
		$i = 0;
		foreach($dataJoueur->{"cards"} as $carta) {
			array_push($carteTableau, strval($dataJoueur->{"cards"}[$i]->key));
			$i++;
		}
		
		$Jeu = array();
		$c = 0;
		foreach($carteJeu->{"cards"} as $carta) {
			array_push($Jeu, strval($carteJeu->{"cards"}[$c]->key));
			$c++;
		}
		
		$carteManquante = array();
		$o = 0;
		foreach($Jeu as $carteJEU) {
			if (!in_array($Jeu[$o], $carteTableau)) {
				array_push($carteManquante, $Jeu[$o]);
			}
			$o++;
		}
		
		
		
		
		
		$carteDuJe = file_get_contents("JSON/cartesClashRoyale.json");
		$CARTEjeu = json_decode($carteDuJe);
		$rarete = array();
		$i = 0;
		foreach($CARTEjeu->{"cards"} as $carteJeu) {
			if(in_array(strval($CARTEjeu->{"cards"}[$i]->key), $carteManquante)) {
				array_push($rarete, $CARTEjeu->{"cards"}[$i]->rarity);
			}
			$i++;
		}
		
		$i = 0;
		//POUR CHAQUE CARTE MANQUANTE
		foreach($carteManquante as $carteMANQUANTE) {
		  if($rarete[$i] == "Legendary") {
			$name = $carteManquante[$i];
			$name = "<img alt='$name' class='cartes' src='image/$name.png'>";
			$nombreCarte = "0/0";
			$level = 0;
			$width = 0;
			$barre = "<div class='progression' style='width:$width%'></div>";
		
		?>
		<div class="w3-display-container w3-text-white spaceBetween 1">
				<?php echo $name ?>
				<div class="w3-display-bottommiddle w3-container"><p>Niveau <?php echo $level ?></p></div>
				<div class="w3-card"> 
					<div class="nombreCartes"><p class="sansMarge"><?php echo $nombreCarte ?></p></div>
					<div class="couleurFondBarre">
						<?php echo $barre ?>
					</div>
				</div>
		</div>
		<?php
			} 
		$i++;
		}*/
		
		?>
    
  </div>
</div>
    
<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-13</p>
</div>

</body>
</html>

