<?php 

//reload juste les données max si besoin. Plus court quede fair le donwload api data ...

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
