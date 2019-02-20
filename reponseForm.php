<?php  

$DernierQuest = json_decode(file_get_contents('JSON/InfoHomePage/Questionnaire/Resultats.json'), true);

$vote = [];

for($i = 0; $i <= 3; $i++ ) {
	if(isset($_POST['question-'.$i])) {
		foreach($_POST['Reponse'.$_POST['question-'.$i]] as $Reponse) {
			$DernierQuest[$_POST['question-'.$i]]['answers'][$Reponse]++;
		}
	}
}


file_put_contents('JSON/InfoHomePage/Questionnaire/Resultats.json', json_encode($DernierQuest));

header('location: index.php');



?>
