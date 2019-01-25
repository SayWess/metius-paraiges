<?php 

//Si le dossier JSON n'existe pas, on le créer
$dossier = "JSON";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};
//Création de la fonction copieFichierClan
function copieFichierClan() {
	//Si le fichier JSON/clan.json existe, on effectue le code
    if (file_exists("JSON/clan.json")) {
		//On prend le contenue du fichier clan.json
		$fichierClan = file_get_contents("JSON/clan.json");
		$fichierClan = json_decode($fichierClan);
		//On créer un tableau qui va contenir les tags de chaque membre
		$copyClanMembers = array();
		//On définit $i = 0 
		$i = 0;
		//Pour chaque membre du clan
		foreach($fichierClan->{"members"} as $membre) { 
			//On prend le tag du joueur
			$tagMembre = $fichierClan->{"members"}[$i]->tag;
			//Et on l'ajoute dans le tableau $copyCLanMembers'
			array_push($copyClanMembers, strval($tagMembre));
			//On increment le $i pour avoir le joueur suivant
			$i++;
		}
		//On met le tableau encodé dans le fichier copyCLanMembers.json
		//file_put_contents("JSON/copyClanMembers.json", json_encode($copyClanMembers));
	}
}

//On appèle la fonction copieFichierClan
echo copieFichierClan();

//On définit la fonction newWarriorsAndOldWarriors
function newWarriorsAndOldWarriors() {
	//On récupère le contenue du fichier JSON/copyClanMembers.json et on le décode pour obtenir un tableau
	$copyClanMembers = file_get_contents("JSON/copyClanMembers.json");
	$copyClanMembers = json_decode($copyClanMembers);
	//On récupère le contenue du fichier JSON/clan.json
	$membersClan = file_get_contents("JSON/clan.json");
	$membersClan = json_decode($membersClan);
	//On récupère le contenue du fichier JSON/oldWarriors.json
	$OLDWarriors = file_get_contents("JSON/oldWarriors.json");
	$OLDWarriors = json_decode($OLDWarriors, true);
	//Contenue fichier newWarriors.json
	$NEWWarriors = file_get_contents("JSON/newWarriors.json");
	$NEWWarriors = json_decode($NEWWarriors, true);
	
	//On créer le différents tableaus qui vont nous être utilent
	$newWarriors = array();
	$clanMembersActuel = array();
	$oldWarriors = array();
	$NEWWarriorsVerification = array();

	//Pour chaque NEWWarriors déjà dans le fichier newWarriors.json
	foreach($NEWWarriors as $key => $value) {
		foreach($value as $tag) {
			foreach($tag as $tag) {
			//On met leur tag dans le tableau $NEWWarriorsVerification
			array_push($NEWWarriorsVerification, $tag);
			}
		}
	}
	
	$i = 0;
	//Pour chaque membre du clan
	foreach($membersClan->{"members"} as $member) {
		//On prend son tag
		$tag = $membersClan->{"members"}[$i]->tag;
		//Si le tag du joueur n'apparait pas dans le tableau $copyClanMembers
		if (!in_array($tag, $copyClanMembers)) {
			//Si le tag du joueur n'est pas déjà dans les NEWWarriors
			if(!in_array($tag, $NEWWarriorsVerification)) {
				//On ajoute son tag dans un tableau dans le tableau newWarriors, dont la key est la date (pour avoir la date d'arrivé du joueur) 
				$newWarriors[date('W|y')][] = $tag;
			}
		}
		//On ajoute le tag du joueur dans le tableau clanMembersActuel 
		array_push($clanMembersActuel, $tag);
		$i++;
	}
	//Si le tableau newWarriors n'est pas vide
	if(!empty($newWarriors)) {
		//On redéfinit le tableau NEWWarriors qui sera égale a lui-même plus le tableau newWarriors encodé. C'est égale a $NEWWarriors = $NEWWarriors.json_encode($newWarriors); . Cela permet de na pas écraser les anciens newWarriors.
		$NEWWarriors[] = $newWarriors;
		//On met le nouveau tableau NEWWarriors dans le fichier newWarriors.json
		file_put_contents("JSON/newWarriors.json", json_encode($NEWWarriors));
	}
	$i = 0;
	//Pour chaque membre du fichier clan copié
	foreach($copyClanMembers as $value) {
		//Si le membre n'est pas dans le tableau clanMembersActuel (Le nouveau fichier clan)
		if (!in_array($copyClanMembers[$i], $clanMembersActuel)) {
			foreach( $OLDWarriors as $dateIndex => $date) {
				foreach( $date as $dateKey => $tags ) {
					foreach( $tags as $tagIndex => $tag ) {
						if ($copyClanMembers[$i] == $tag) {
						unset( $OLDWarriors[$dateIndex][$dateKey][$tagIndex] );
						$oldWarriors[date('W|y')][] = $copyClanMembers[$i];
						}
						//echo "$tagIndex: $tag \n";
					}
				}
			}
		}
		$i++;
	}
	//Si oldWarriors n'est pas vide
	if(!empty($oldWarriors)) {
		//On redéfinit le tableau OLDWarriors... Comme pour le tableau NEWWarriors juste au dessus !
		$OLDWarriors[] = $oldWarriors;
		//On met le nouv tableau dans oldWarriors.json
		file_put_contents("JSON/oldWarriors.json", json_encode($OLDWarriors));
	}
}

//On appèle la fonction newWarriorsAndOldWarriors
echo newWarriorsAndOldWarriors();



/*foreach($OLDWarriors as $key => $date) {
				//Pour chaque date (même si il n'y en a qu'une par tableau)
				foreach($date as $tags) {
					//Pour chaque tag de joueurs partis
					foreach($tags as $tag) {
						if($copyClanMembers[$i] = $tag) {
							unset($OLDWarriors[$key][$date]->$tag);
							//On l'ajoute au tableau oldWarriors... Même principe que pour les newWarriors
							$oldWarriors[date('W|y')][] = $copyClanMembers[$i];
						}
					}
				}
			}*/

?>
