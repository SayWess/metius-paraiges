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

header('location: espaceadmin.php');

?>
