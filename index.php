<!DOCTYPE html>

<?php 
	
	if(isset($_COOKIE["Vote"]) && date("D") == "Mon") {
		setcookie('Vote', "", - 1, '/');
	}

	$cssFile = "home";
	include "Templates/head.php"; 

?>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "home"; //On définit $pageActive par "home", pour indiquer que la page qui est active est home
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<div class="Colonne" style="margin-top:30px">

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
		
		$i = 0;
		
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

$jNew= file_get_contents("JSON/InfoHomePage/JoueurArrive/JoueurArrive.json");
$jNew = json_decode($jNew, true);

$date = date('W|y');

if(!is_null($jNew)) { ?>
		<div class="News">
			<div class="TitreNews">
				<p> Dites bonjours aux nouveaux, </p>
			</div>
	
			<div class="Content"> 
				<p> Bienvenue à <?php echo join(', ', $jNew[$date])." arrivé le ".key($jNew) ?>  </p>
			</div>
			
		
		</div>
		
	<?php } 
	
	$jOld = json_decode(file_get_contents("JSON/InfoHomePage/JoueurParti/JoueurParti.json"), true);
	
	if(!is_null($jOld)) {
	
	?>
		
		<div class="News">
			<div class="TitreNews">
				<p> Dites au revoir aux partis, </p>
			</div>
	
			<div class="Content"> 
				<p> Au revoir à <?php echo join(', ', $jOld[$date])." parti le ".key($jOld) ?>  </p>
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
		
    </div>
    
    <div class="w3-animate-zoom article">
		<h2>Contrat SUPERCELL</h2>
		<h4>CONTRAT</h4>
		<p>"This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-policy."</p>
    </div>
    
</div>





<script> 

	function setCookie(cname,cvalue,exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	
</script>






<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

</body>
</html>

