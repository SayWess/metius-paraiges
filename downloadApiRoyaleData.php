 
<?php 

$secrets = file_get_contents("secrets.json");
$secrets = json_decode($secrets, true);
$token = $secrets['APIkey'];



//
//Modification du fichier .htaccess pour mise en maintenance du site
//
/*function modifHtaccess() {
    if (file_exists("../.htaccess")) {
      try {
       rename("../.htaccess","../.htaccessOriginal");
       $fp = fopen('../.htaccess','w');
       $txt = "RewriteEngine on\n\n";
       $txt .= "# Mode maintenance\n";
       $txt .= "RewriteCond %{REQUEST_URI} !^/Projet_Metius_Paraiges/maintenance.php [NC]\n";
       $txt .= "RewriteRule .* /Projet_Metius_Paraiges/maintenance.php [L]";
       fwrite($fp,$txt);
       fclose($fp);
       return true;
    } catch (Exception $e) {
            echo $e;
            return false;
      }
    } else {
            return true;
    }
}
$test = modifHtaccess();
echo $test; */
////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Copie de l'ancien fichier clan.json pour avoir les date d'arrivé et les  date de départ des joueurs !
//

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
		file_put_contents("JSON/copyClanMembers.json", json_encode($copyClanMembers));
	}
}

//On appèle la fonction copieFichierClan
echo copieFichierClan();

////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Téléchargement apiClan
//
$dossier = "JSON";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);

date_default_timezone_set('UTC');
echo "Début du téléchargement des données du clan : ".date('l jS \of F Y h:i:s A')."<br>";

$test = file_get_contents("https://api.royaleapi.com/clan/PGYRVQ2",true, $context);
$decodedtest = json_decode($test);

$fp = fopen("JSON/clan.json","w+");
      fputs($fp, $test);
      fclose($fp);
echo "Fin du téléchargement des données du clan : ".date('l jS \of F Y h:i:s A')."<br><br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Actualisation des fichiers pour les nouveau joueur et de ceux qui sont partis 
//

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
						}
						//echo "$tagIndex: $tag \n";
					}
				}
			}
			$oldWarriors[date('W|y')][] = $copyClanMembers[$i];
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

///////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Téléchargement apiJoueurs
//

$dossier = "JSON/joueurProfil";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$infocoded = file_get_contents("JSON/clan.json");
$infodecoded = json_decode($infocoded);

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données des joueurs : ".date('l jS \of F Y h:i:s A')."<br>";
 foreach($infodecoded->{"members"} as $value){ 
         $infojoueurprofil = file_get_contents("https://api.royaleapi.com/player/$value->tag",true, $context);
         $decodedprofil = json_decode($infojoueurprofil);
         $fp = fopen("JSON/joueurProfil/$value->tag.json","w+");
               fwrite($fp, $infojoueurprofil);
               fclose($fp);
               };
echo "Fin du téléchargement des données des joueurs : ".date('l jS \of F Y h:i:s A')."<br><br>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Téléchargement apiJoueursCoffres
//
$dossier = "JSON/joueurChest";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};


$infocoded = file_get_contents("JSON/clan.json");
$infodecoded = json_decode($infocoded);

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données des futurs coffres des joueurs : ".date('l jS \of F Y h:i:s A')."<br>";
 foreach($infodecoded->{"members"} as $value){ 
         $infojoueurchest = file_get_contents("https://api.royaleapi.com/player/$value->tag/chests",true, $context);
         $fp = fopen("JSON/joueurChest/$value->tag.json","w+");
               fwrite($fp, $infojoueurchest);
               fclose($fp);
               };
echo "Fin du téléchargement des données des futurs coffres des joueurs : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
//
//Téléchargement des données de clan battle
//

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de clan battle : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoClanBattle = file_get_contents("https://api.royaleapi.com/clan/PGYRVQ2/battles",true, $context);
         $fp = fopen("JSON/infoClanBattle.json","w+");
               fwrite($fp, $infoClanBattle);
               fclose($fp);
echo "Fin du téléchargement des données de clan battle : ".date('l jS \of F Y h:i:s A')."<br><br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

/*
//
//Téléchargement des données de clan war
//

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de clan war : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoClanWar = file_get_contents("https://api.royaleapi.com/clan/PGYRVQ2/war",true, $context);
         $fp = fopen("JSON/infoClanWar.json","w+");
               fwrite($fp, $infoClanWar);
               fclose($fp);
echo "Fin du téléchargement des données de clan war : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

//
//Téléchargement des données clan warlog
//

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de clan warlog : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoClanWarLog = file_get_contents("https://api.royaleapi.com/clan/PGYRVQ2/warlog",true, $context);
         $fp = fopen("JSON/infoClanWarLog.json","w+");
               fwrite($fp, $infoClanWarLog);
               fclose($fp);
echo "Fin du téléchargement des données de clan warlog : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des données top clans local
//
$dossier = "JSON/top";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de top clans local : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoTopClansLocal = file_get_contents("https://api.royaleapi.com/top/clans/TF",true, $context);
         $fp = fopen("JSON/top/infoTopClansLocal.json","w+");
               fwrite($fp, $infoTopClansLocal);
               fclose($fp);
echo "Fin du téléchargement des données de top clans local : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des données top players local
//
$dossier = "JSON/top";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de top players local : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoTopPlayersLocal = file_get_contents("https://api.royaleapi.com/top/players/TF",true, $context);
         $fp = fopen("JSON/top/infoTopPlayersLocal.json","w+");
               fwrite($fp, $infoTopPlayersLocal);
               fclose($fp);
echo "Fin du téléchargement des données de top players local : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des données top clans wars local
//
$dossier = "JSON/top";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de top clans wars local : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoTopClansWarsLocal = file_get_contents("https://api.royaleapi.com/top/war/TF",true, $context);
         $fp = fopen("JSON/top/infoTopClansWarsLocal.json","w+");
               fwrite($fp, $infoTopClansWarsLocal);
               fclose($fp);
echo "Fin du téléchargement des données de top clans wars local : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des données top clans général
//
$dossier = "JSON/top";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de top clans général : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoTopClansGeneral = file_get_contents("https://api.royaleapi.com/top/clans/",true, $context);
         $fp = fopen("JSON/top/infoTopClansGeneral.json","w+");
               fwrite($fp, $infoTopClansGeneral);
               fclose($fp);
echo "Fin du téléchargement des données de top clans général : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des données top players général
//
$dossier = "JSON/top";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de top players général : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoTopPlayersGeneral = file_get_contents("https://api.royaleapi.com/top/players/",true, $context);
         $fp = fopen("JSON/top/infoTopPlayersGeneral.json","w+");
               fwrite($fp, $infoTopPlayersGeneral);
               fclose($fp);
echo "Fin du téléchargement des données de top players général : ".date('l jS \of F Y h:i:s A')."<br><br>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des données top clans wars général
//
$dossier = "JSON/top";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des données de top clans wars général : ".date('l jS \of F Y h:i:s A')."<br>";
         $infoTopClansWarsGeneral = file_get_contents("https://api.royaleapi.com/top/war/",true, $context);
         $fp = fopen("JSON/top/infoTopClansWarsGeneral.json","w+");
               fwrite($fp, $infoTopClansWarsGeneral);
               fclose($fp);
echo "Fin du téléchargement des données de top clans wars général : ".date('l jS \of F Y h:i:s A')."<br><br>";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//
//Téléchargement des cartes du jeu
//
$dossier = "JSON";
if(!is_dir($dossier)){
   mkdir($dossier, 0777,true);
};

$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
echo "Début du téléchargement des cartes du jeu : ".date('l jS \of F Y h:i:s A')."<br>";
         $cartesClashRoyale = file_get_contents("https://api.royaleapi.com/constants?keys=cards",true, $context);
         $fp = fopen("JSON/cartesClashRoyale.json","w+");
               fwrite($fp, $cartesClashRoyale);
               fclose($fp);
echo "Fin du téléchargement des cartes du jeu : ".date('l jS \of F Y h:i:s A')."<br><br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Modification du fichier .htaccess pour remise en ligne du site
//
unlink("../.htaccess");
rename("../.htaccessOriginal","../.htaccess");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Modification droit des dossiers
//
chmod("JSON", 0777);
chmod("JSON/max", 0777);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Trophées Maximum de clan
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$clan = file_get_contents('JSON/clan.json');
$clandecoded = json_decode($clan);
$trClan = $clandecoded->{'score'};

$max = file_get_contents('JSON/max/max.json');
$maxdecoded = json_decode($max);
$trMaxClan = $maxdecoded->TrMaxClan;

if($trClan > $trMaxClan) {
	$maxdecoded->TrMaxClan = $trClan;
	file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Trophées Maximum de GDC
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$gdc = file_get_contents('JSON/clan.json');
$gdcdecoded = json_decode($gdc);
$trGdc = $gdcdecoded->warTrophies;

$max = file_get_contents('JSON/max/max.json');
$maxdecoded = json_decode($max);
$trMaxGdc = $maxdecoded->TrMaxGDC;

if($trGdc > $trMaxGdc) {
	$maxdecoded->TrMaxGDC = $trGdc;
	file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Dons Maximum par semaine
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$dons = file_get_contents('JSON/clan.json');
$donsdecoded = json_decode($dons);
$donsSemaine = $donsdecoded->donations;

$max = file_get_contents('JSON/max/max.json');
$maxdecoded = json_decode($max);
$donsMaxSemaine = $maxdecoded->DonsMaxSemaine;

if($donsSemaine > $donsMaxSemaine) {
	$maxdecoded->DonsMaxSemaine = $donsSemaine;
	file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Participants Maximum en GDC
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};


$participants = file_get_contents('JSON/infoClanWarLog.json');
$participantsdecoded = json_decode($participants);
//Le foreach permet d'avoir chaque clan de la dernière GDC, et on assigne le clan a $value
foreach($participantsdecoded[0]->{'standings'} as $value) {
	//si le tag du clan qui participe est le notre, on execute l'action
	if($value->tag === "PGYRVQ2") {
		$participantsGdc = $value->participants;
		$max = file_get_contents('JSON/max/max.json');
		$maxdecoded = json_decode($max);
		$participantsMaxGdc = $maxdecoded->ParticipantsMaxGDC;
		//si le nombre de participants de notre clan a cette GDC est superieur au nombre de participants max, on execute l'action qui remplace le nombre max par le nouveau
		if($participantsGdc > $participantsMaxGdc) {
			$maxdecoded->ParticipantsMaxGDC = $participantsGdc;
			file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		}
		break;
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Position Maximum du clan en LOCAL
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$topClansLocal = file_get_contents('JSON/top/infoTopClansLocal.json');
$topClansLocaldecoded = json_decode($topClansLocal);
//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
foreach($topClansLocaldecoded as $value) {
	//si il y a notre tag de clan, on execute l'action
	if($value->tag === "PGYRVQ2") {
		$PositionClanLocal = $value->rank;
		$max = file_get_contents('JSON/max/max.json');
		$maxdecoded = json_decode($max);
		$PositionClanMaxLocal = $maxdecoded->PositionMaxClanLocal;
		//Si la position de notre clan est plus petite que la position max, on execute l'action
		if($PositionClanLocal < $PositionClanMaxLocal) {
			$maxdecoded->PositionMaxClanLocal = $PositionClanLocal;
			file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		}
		break;
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Position Maximum du clan en GENERAL
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$topClansGeneral = file_get_contents('JSON/top/infoTopClansGeneral.json');
$topClansGeneraldecoded = json_decode($topClansGeneral);
//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
foreach($topClansGeneraldecoded as $value) {
	//si il y a notre tag de clan, on execute l'action
	if($value->tag === "PGYRVQ2") {
		$PositionClanGeneral = $value->rank;
		$max = file_get_contents('JSON/max/max.json');
		$maxdecoded = json_decode($max);
		$PositionClanMaxGeneral = $maxdecoded->PositionMaxClanGeneral;
		//Si la position de notre clan est plus petite que la position max, on execute l'action
		if($PositionClanGeneral < $PositionClanMaxGeneral) {
			$maxdecoded->PositionMaxClanGeneral = $PositionClanGeneral;
			file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		}
		break;
	} else {
		$maxdecoded->PositionMaxClanGeneral = ">1000";
		file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		break;
	  }
} 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Position Maximum du clan en GDC LOCAL
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$topClansGDCLocal = file_get_contents('JSON/top/infoTopClansWarsLocal.json');
$topClansGDCLocaldecoded = json_decode($topClansGDCLocal);
//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
foreach($topClansGDCLocaldecoded as $value) {
	//si il y a notre tag de clan, on execute l'action
	if($value->tag === "PGYRVQ2") {
		$PositionClanGDCLocal = $value->rank;
		$max = file_get_contents('JSON/max/max.json');
		$maxdecoded = json_decode($max);
		$PositionClanGDCMaxLocal = $maxdecoded->PositionMaxGDCLocal;
		//Si la position de notre clan est plus petite que la position max, on execute l'action
		if($PositionClanGDCLocal < $PositionClanGDCMaxLocal) {
			$maxdecoded->PositionMaxGDCLocal = $PositionClanGDCLocal;
			file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		} 
		break;
	}
} 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
//Position Maximum du clan en GDC GENERAL
//
$dossier = "JSON/max";
if(!is_dir($dossier)){
mkdir($dossier, 0777,true);
};

$topClansGDCGeneral = file_get_contents('JSON/top/infoTopClansWarsGeneral.json');
$topClansGDCGeneraldecoded = json_decode($topClansGDCGeneral);
//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
foreach($topClansGDCGeneraldecoded as $value) {
	//si il y a notre tag de clan, on execute l'action
	if($value->tag === "PGYRVQ2") {
		$PositionClanGDCGeneral = $value->rank;
		$max = file_get_contents('JSON/max/max.json');
		$maxdecoded = json_decode($max);
		$PositionClanGDCMaxGeneral = $maxdecoded->PositionMaxGDCGeneral;
		//Si la position de notre clan est plus petite que la position max, on execute l'action
		if($PositionClanGDCGeneral < $PositionClanGDCMaxGeneral) {
			$maxdecoded->PositionMaxGDCGeneral = $PositionClanGDCGeneral;
			file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		} 
		break;
	} else {
		$maxdecoded->PositionMaxGDCGeneral = ">1000";
		file_put_contents('JSON/max/max.json', json_encode($maxdecoded));
		break;
	  }
} 
       
       
       
       
       
       
       
       

?>
