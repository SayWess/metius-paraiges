<!DOCTYPE html>

<?php 

	$date = json_decode(file_get_contents('JSON/InfoHomePage/Questionnaire/Semaine.json') ,true);
	
	if(isset($_COOKIE["Vote"]) && $date['date'] != date('W')) {
		setcookie('Vote', "", - 1, '/');
		$date['date'] = date('W');
		file_put_contents('JSON/InfoHomePage/Questionnaire/Semaine.json', json_encode($date));
	}
	

	$cssFile = "home";
	include "Templates/head.php"; 

?>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "home"; //On définit $pageActive par "home", pour indiquer que la page qui est active est home
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<div class="Colonne">

	<div class="Titre"> 
		<h1> Metius Paraiges </h1>
	</div>
  
	
	<div class="w3-animate-zoom article">
		<div class="TitreArticle">
			<p>Description </p>
		</div>
		
		<div class="ContentArticle">
			<div>
				<p>Métius Paraiges est un clan français qui est présent sur Clash Royale, un jeu ou des millions de personnes s'affrontent en ligne pour être le meilleur !</p>
			</div>
		
			<div class="Date">
				<p> Le 26 Décembre 2018 </p>
			</div>
		</div>
	</div>
	  
	<div class="w3-animate-zoom article">
	  
		<div class="Sondage">
			<div class="TitreArticle">
				<p>Sondage de la semaine, à vous de choisir !</p>
			</div>
			
			<?php 


		$DernierQuest = file_get_contents("JSON/InfoHomePage/Questionnaire/Resultats.json");
		$DernierQuest = json_decode($DernierQuest, true);

			?>

				<div class="ContainerVote">
					<form method="post" action="reponseForm.php">
		
		<?php
		
		$firstOldDate = false;
		$i = count($DernierQuest) - 1;
		while( !$firstOldDate && $i >= 0 ) {
			if($DernierQuest[$i]['date'] != date('W|y')) {
				$firstOldDate = $DernierQuest[$i]['date'];
			}
			$i--;
		}
		
		$QuestionActive = array_filter($DernierQuest, function ($question) use ($firstOldDate) {
			return $question['date'] === $firstOldDate;
		} );
		
		foreach($QuestionActive as $index => $Question) {
		
		?>
		
		<input hidden name="question-<?= $i ?>" value="<?= $index ?>">
		
		<div class="Question">
			<h3> <?= $Question['question'] ?> </h3>
		</div>
		
		<?php if(!isset($_COOKIE['Vote'])) { ?>
		
		<div class="Reponses">
		
		<?php 	foreach($Question['answers'] as $key => $value) { ?>
		
			<div>
				<input id="<?= $key.$i; ?>" type="<?= $Question['NbReponses']; ?>" name="Reponse<?= $index; ?>[]" value="<?= $key ?>" <?php if($Question["NbReponses"] == "radio") { echo 'required'; } ?> >
				<label for="<?= $key.$i ?>"> <?= $key ?> </label>
			</div>
			
		<?php } $i++;
		
		?>
		</div>
		
		<div>
			<button type="submit" onclick="setCookie('Vote', true, 30)"> Voter </button>
		</div>
		
		<?php } } 
		
			if(isset($_COOKIE['Vote'])) { ?>
			
			<div class="Resultats">
			
			<?php	foreach($QuestionActive as $index => $Question) {
					$max = 0;
					foreach($Question['answers'] as $Reponse => $valeur) {
					$max += $valeur;
					}
					foreach($Question['answers'] as $Reponse => $valeur) {
					
		?> 
		
			<div class="Resultat">
				<label class="resultats" for="file"> <?= $Reponse ?> :</label>
				<progress id="file" max="<?= $max ?>" value="<?= $valeur ?>">  </progress>
				<p class="Resultats"> <?= round($valeur / $max  * 100)."%" ?> </p>
			</div>
			
		<?php
					}
				} ?>
			
			</div>
			
		<?php	}
		
		?>
		
				</form>
			</div>
			
		</div> 
	  
	  </div>
	  
    
    <div class="w3-animate-zoom article">
		<div class="TitreArticle">
			<h1> Dernières News ! </h1>
		</div>
    
		<div class="News">
			<div class="TitreNews">
				<p>Enfin, le voila !</p>
			</div>
			
			<div class="Content">
				<p>Après plusieurs mois de travail, le site Métius Paraiges est enfin là ! Il est tout beau, tout fini, le voilà à votre disposition !</p>
			</div>
			
			<div class="Date">
				<p>Le 26 Décembre 2018</p>
			</div>
		</div>    
		
<?php

$date = date('W|y');

function Joueur($file) {

	$newWarriors = json_decode(file_get_contents('JSON/'.$file.'.json'), true);
	$jNew = [];
	$jName = [];
	$date = date('W|y');

	foreach($newWarriors as $key => $value) {
		if(key($value) == $date) {
			foreach($value as $index => $tag) {
				$jNew[] = $tag;
			}
		}
	}

	foreach($jNew as $index => $value) {
		foreach($value as $joueur) {
		$Profil = json_decode(file_get_contents('JSON/joueurProfil/'.$joueur.'.json'));
		$jName[] = $Profil->name;
		}
	}
	return $jName;
}

$jNew = Joueur('newWarriors');

if(!empty($jNew)) { ?>
		<div class="News">
			<div class="TitreNews">
				<p> Dites bonjours aux nouveaux, </p>
			</div>
	
			<div class="Content"> 
				<p> Bienvenue à <?php 
					if(count($jNew) == 2) {
						echo join(' et ', $jNew)." arrivés le ".$date; 
					} elseif(count($jNew) > 2) {
						echo join(', ', $jNew)." arrivés le ".$date; 
					} else {
						echo join(', ', $jNew)." arrivé le ".$date;
					}
					?>  </p>
			</div>
			
		
		</div>
		
	<?php } 
	
	$jOld = Joueur('oldWarriors');
	
	if(!empty($jOld)) {
	
	?>
		
		<div class="News">
			<div class="TitreNews">
				<p> Dites au revoir aux partis, </p>
			</div>
	
			<div class="Content"> 
				<p> Au revoir à <?php 
					if(count($jOld) == 2) {
						echo join(' et ', $jOld)." partis le ".$date; 
					} elseif(count($jOld) > 2) {
						echo join(', ', $jOld)." partis le ".$date; 
					} else {
						echo join(', ', $jOld)." parti le ".$date;
					}
					?>  </p>
			</div>
			
		
		</div>
		
	<?php } ?>
		
		<div class="News">
			<div class="TitreNews">
				<p> Phrase du jour :</p>
			</div>
			
			<div class="Content">
			
				<?php 

$fichierP = file_get_contents("JSON/InfoHomePage/DayPhrases/DayPhrases.json");
$fichierP = json_decode($fichierP, true);

srand(round(time()/86400));

$lenght = count($fichierP);
$phrase = rand(0, $lenght - 1);

?>
				<div>
					<?= $fichierP[$phrase] ?>
				</div>
				
			</div>
			
		</div>   

<?php
	$newWarriors = json_decode(file_get_contents("JSON/newWarriors.json"), true);
	
	$jTag = [];
	$jName = [];
	
	foreach($newWarriors as $key) {
		foreach($key as $dateArrivee => $value) {
			if(substr($dateArrivee, 0, 2) == date('W') && $dateArrivee != date('W|y')) {
				foreach($value as $index => $valeur) {
					$jTag[$dateArrivee][] = $valeur;
				}
			}
		}
	}
	
	foreach($jTag as $dateArrivee => $joueurs) {
		foreach($joueurs as $tag) {
			$name = json_decode(file_get_contents("JSON/joueurProfil/$tag.json"));
			$jName[$dateArrivee][] = $name->name; 
		}
	}
	
	if(!empty($jName)) {
		$keys = array_keys($jName);
		$last_key = $keys[count($keys)-1];
?>
		<div class="News">
			<div class="TitreNews">
				<p> C'est l'heure des anniversaires ! </p>
			</div>
	
			<div class="Content"> 
				<p> Joyeux anniversaire d'arrivée 
				
				<?php foreach($jName as $index => $tags) {
						if(is_array($tags)) {
								if(count($tags) == 2 && $index != $last_key && count($jName) > 1) {
									echo " à ".join(' et ', $tags)." arrivés le ".$index." et ";
								} elseif(count($tags) == 2) {
									echo " à ".join(' et ', $tags)." arrivés le ".$index;
								} elseif($index != $last_key && count($jName) > 1) {
									echo " à ".join(', ',$tags)." arrivés le ".$index." et ";
								} else {
									echo " à ".join(', ',$tags)." arrivés le ".$index;
								}
							} elseif(count($jName) > 1 && $index != $last_key) {
								echo " à ".$tags." arrivé le ".$index." et ";
							} else {
								echo " à ".$tags." arrivé le ".$index;
							}
					} ?>  </p>
			</div>
			
		</div>
		
<?php } /*join(', ', $jName)." arrivé le ".key($jName) */?>
		
    </div>
    
    <div class="w3-animate-zoom article">
    
		<div class="TitreArticle">
			<p>Contrat SUPERCELL</p>
		</div>
		
		<div class="News">
			<div class="Content">
				<p>"This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-	policy."</p> 
			</div>
		</div>
		
    </div>
    
</div>


<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

</body>
</html>

