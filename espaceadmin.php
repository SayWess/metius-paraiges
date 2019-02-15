<?php

//if(!isset($_SESSION['username'])) {
//    die('please <a href="login.php">login</a>');
    
//}

?>

<?php 

	$cssFile = "espaceadmin";
	include "Templates/head.php"; 

?>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "espace admin"; //On définit $pageActive par "clan", pour indiquer que la page qui est active est clan
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>

<div class="container">
  <div class="row">
    
    <div class="col-sm-12 w3-animate-zoom article">
      <p> <?php 
      echo "<h2>Bonjours ". $_SESSION['username']."</h2>";
      ?> </p> 
      <br>
      <h5>How are you today ? </h5> 
    </div>
    
    
  </div>
</div>

<div class="GrandContainer">

<div class="containerFormulaire">
  <form method="post" action="formulaire.php">
    <label for="Question"> Ecrire une question</label>
    <input type="text" id="Question" name="Question" placeholder="Entrez votre question.."  pattern="^\s*[^\s]+.*$" required >
	
	<input id="answer-2" hidden type="checkbox">
	<input id="answer-3" hidden type="checkbox">
	<input id="answer-4" hidden type="checkbox">
	
	<div class="answer-1">
		<div>
		Réponse 1 <input type="text" id="Reponse" name="Reponse[]" placeholder="Entrez votre réponse"  pattern="^\s*[^\s]+.*$" required>
		</div>
		<div>
			<label for="answer-2"> Ajouter une réponse </label>
		</div>
	</div>
	
	<div class="answer answer-2">
		<div>
		Réponse 2 <input type="text" id="Reponse" name="Reponse[]" placeholder="Entrez votre réponse"  pattern="^\s*[^\s]+.*$">
		</div>
		<div>
		<label for="answer-3"> Ajouter une réponse </label>
		</div>
	</div>
	
	<div class="answer answer-3">
		<div>
		Réponse 3 <input type="text" id="Reponse" name="Reponse[]" placeholder="Entrez votre réponse"  pattern="^\s*[^\s]+.*$">
		</div>
		<div>
		<label for="answer-4"> Ajouter une réponse </label>
		</div>
	</div>
	
	<div class="answer answer-4">
		<div>
		Réponse 4 <input type="text" id="Reponse" name="Reponse[]" placeholder="Entrez votre réponse"  pattern="^\s*[^\s]+.*$">
		</div>
	</div>
	
	
    
    <div class="Reponse">
		
		<div>
			<input id="Radio" type="radio" name="NbReponses" value="radio" required>
			<label for="Radio"> Choix simples </label>
		</div>
		
		<div>
			<input id="Checkbox" type="radio" name="NbReponses" value="checkbox" required>
			<label for="Checkbox"> Choix multiples </label>
		</div>

	</div>
	
	
    <input type="submit" name="Submit" value="Ajouter des données au formulaire ?">
  </form>
  
  <div class="Attention">
		<h4> Attention, ne laisser pas d'espace seul dans les réponses </h4>
  </div>
  
</div>

<?php 

$DernierQuest = file_get_contents("JSON/InfoHomePage/Questionnaire/Resultats.json");
$DernierQuest = json_decode($DernierQuest, true);

?>

<div class="ContainerVote">
		<div class="titre">
			<h1> Formulaire actuel :</h1>
		</div>
		
		<?php
		
		$firstOldDate = false;
		$i = count($DernierQuest) - 1;
		while( !$firstOldDate && $i >= 0 ) {
			if($DernierQuest[$i]['date'] != date('W|y')) {
				$firstOldDate = $DernierQuest[$i]['date'];
			}
			$i--;
		}
		
		$i = 0;
		
		$QuestionActive = array_filter($DernierQuest, function ($question) use ($firstOldDate) {
			return $question['date'] === $firstOldDate;
		} );
		
		foreach($QuestionActive as $Question) {
		
		?>
		
		<div class="Question">
			<h2> <?= $Question['question'] ?> </h2>
		</div>
		
		<div class="Reponses">
		
		<?php foreach($Question['answers'] as $key => $value) { ?>
		
			<div>
				<input id="<?= $key.$i ?>" type="<?= $Question['NbReponses'] ?>" name="Reponse<?= $i ?>" value="Choi 1">
				<label for="<?= $key.$i ?>"> <?= $key ?> </label>
			</div>
			
		<?php } $i++ ?>
		
		</div>
		
		<?php }	?> 
		
		<div class="titre">
			<h1> Formulaire suivant :</h1>
		</div>
		
		<?php 
		
// 		$QuestionActive = array_filter( array_slice($DernierQuest, 1), function ($question) {
// 			$DernierQuest = file_get_contents("JSON/InfoHomePage/Questionnaire/Resultats.json");
// 			$DernierQuest = json_decode($DernierQuest, true);
// 			$active = $DernierQuest[0];
// 			return in_array( $question['question'], $active);
// 		} );
		
		$NextQuestions = array_filter($DernierQuest, function ($question) use ($firstOldDate) {
			return $question['date'] === date('W|y');
		} );
		
		foreach($NextQuestions as $Question) {
			
		?>
		
		<form method="post" action="formulaire.php">
		
		<div class="Question CroixDelete">
			<h2 class="Quest"> <?= $Question['question'] ?> </h2> 
			<input hidden name="QuestionADelete" value="<?= $Question['question'] ?>"> </input>
			<button type="submit" class="Remove" name="Remove"> <i class="material-icons"> clear </i> </button>
		</div>
		
		</form>
		
		<div class="Reponses">
		
		<?php foreach($Question['answers'] as $key => $value) { ?>
		
			<div>
				<input id="<?= $key.$i ?>" type="<?= $Question['NbReponses'] ?>" name="Reponse<?= $i ?>" value="Choi 1">
				<label for="<?= $key.$i ?>"> <?= $key ?> </label>
			</div>
			
		<?php } $i++ ?>
		
		</div>
		
		<?php } ?>
		
		
		<div class="Button">
			<button type="button" class="Boutton"> Confirmer </button>
		</div>
		
</div>

</div>

<script> 

function RemoveQuestion(question) {
	var Questions = JSON.parse('JSON/InfoHomePage/Questionnaire/Resultats.json');
	var QuestionsFutures = Questions.filter( index => valeur['question'] == question);
	console.log(QuestionsFutures);
	
}

</script>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-06</p>
</div>

</body>
</html>

