<?php


//{"tag":"P8QLRQ9U"
$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MjE4NiwiaWRlbiI6IjQ4MTQ5ODM0NDU4MjE1MjIwNiIsIm1kIjp7InVzZXJuYW1lIjoiU2F5V2VzcyIsImtleVZlcnNpb24iOjMsImRpc2NyaW1pbmF0b3IiOiI5NTczIn0sInRzIjoxNTQ2NjMwNDgzNTcyfQ.N4WAhAuHG5Xbrl5j4f2YQLGJHWvdR1h13E3nsXWlbkk";
$opts = [
    "http" => [
        "header" => "auth:" . $token
    ]
];

$context = stream_context_create($opts);
$infojoueurprofil = file_get_contents("https://api.royaleapi.com/player/P8QLRQ9U",true, $context);
$data=json_decode($infojoueurprofil)


           $file = file_get_contents('JSON/clan.json');
           $decodedtest = json_decode($file);
		   $n = 1;
		
		   foreach($decodedtest->{"members"} as $value){
		     $tag = $value->tag;
		     $fp = file_get_contents('JSON/joueurProfil/'.$tag.'.json');
		     $decodedProfil = json_decode($fp);
             $i = $n++;
             if(!isset($decodedProfil->{"leagueStatistics"}->{"bestSeason"}->trophies)) {
                $meilleurSaison = "";
             } else {
                $dateMeilleurSaison = $decodedProfil->{"leagueStatistics"}->{"bestSeason"}->id;
                $date = substr($dateMeilleurSaison, 2);
                $meilleurSaison = $decodedProfil->{"leagueStatistics"}->{"bestSeason"}->trophies." | ".$date;
             }
             
             if(!isset($decodedProfil->{"leagueStatistics"}->{"currentSeason"}->bestTrophies)) {
                $saisonActuel = "";
             } else {
                $saisonActuel = $decodedProfil->{"leagueStatistics"}->{"currentSeason"}->bestTrophies;
             }
             
             if(!isset($decodedProfil->{"leagueStatistics"}->{"previousSeason"}->bestTrophies)) {
                $saisonPrecedente = "";
             } else {
                $saisonPrecedente = $decodedProfil->{"leagueStatistics"}->{"previousSeason"}->bestTrophies;
             }
             
             if(!isset($decodedProfil->{"leagueStatistics"}->{"previousSeason"}->trophies)) {
                $saisonPrecedenteTrophees = "";
             } else {
                $saisonPrecedenteTrophees = $decodedProfil->{"leagueStatistics"}->{"previousSeason"}->trophies;
             }
             
             
    
		<tr>
		    <td class="text-align-centre"><?php echo $i; ?></td>
			<td class="text-align-gauche"><a data-name="<?php echo $decodedProfil->name ?>" href="profil.php?tag=<?php echo $decodedProfil->tag ?>"><?php echo $decodedProfil->name ?></a></td>
			<td class="text-align-gauche">#<?php echo $decodedProfil->tag ?></td>
			<td class="text-align-gauche"><?php echo $decodedProfil->{"clan"}->role ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->level ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->cardsFound ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->maxTrophies ?></td>
			<td ><?php echo $decodedProfil->trophies ?></td>
			<td ><?php echo $saisonActuel ?></td>
			<td ><?php echo $saisonPrecedenteTrophees ?></td>
			<td ><?php echo $saisonPrecedente ?></td>
			<td ><?php echo $meilleurSaison ?></td>
			<td ><?php echo $decodedProfil->{"games"}->wins ?></td>
			<td ><?php echo $decodedProfil->{"games"}->losses ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->threeCrownWins ?></td>
			<td ><?php echo $decodedProfil->{"games"}->draws ?></td>
			<td ><?php echo $decodedProfil->{"games"}->winsPercent*100 ?>%</td>
			<td ><?php echo $decodedProfil->{"games"}->lossesPercent*100 ?>%</td>
			<td ><?php echo $decodedProfil->{"games"}->drawsPercent*100 ?>%</td>
			<td ><?php echo $decodedProfil->{"games"}->warDayWins ?></td>
			<td ><?php echo $decodedProfil->{"clan"}->donations ?></td>
			<td ><?php echo $decodedProfil->{"clan"}->donationsReceived ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->totalDonations ?></td>
			<td ><?php echo $decodedProfil->{"games"}->tournamentGames ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->tournamentCardsWon ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->challengeCardsWon ?></td>
			<td ><?php echo $decodedProfil->{"stats"}->challengeMaxWins ?></td>
		</tr>

?>
