<?php 

if(isset($_POST['Submit'])) {
	$formulaire = [];
	$formulaire['date'] = date('W|y');
	if(isset($_POST['Question'])) {
		$formulaire['question'] = $_POST['Question'];
	}
	if(!empty($_POST['Reponse'])) {
		foreach($_POST['Reponse'] as $reponse) {
			if(!empty($reponse)) {
				$formulaire['answers'][$reponse] = 0;
			}
		}
	}
	if(isset($_POST['NbReponses'])) {
		$formulaire['NbReponses'] = $_POST['NbReponses'];
	}
	
	
	$questions = json_decode(file_get_contents("JSON/InfoHomePage/Questionnaire/Resultats.json"),true);
	$questions[] = $formulaire;
	
	file_put_contents("JSON/InfoHomePage/Questionnaire/Resultats.json", json_encode($questions));
}

if(isset($_POST['Remove'])) {
	$quest = json_decode(file_get_contents('JSON/InfoHomePage/Questionnaire/Resultats.json'), true);
	$QuestionToDelete = array_filter($quest, function ($question) {
			return $question['question'] == $_POST['QuestionADelete'];
		} );
	unset($quest[key($QuestionToDelete)]);
	file_put_contents('JSON/InfoHomePage/Questionnaire/Resultats.json', json_encode(array_values($quest)));
}

header('location: espaceadmin.php');

?>
