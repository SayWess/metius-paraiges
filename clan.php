<!DOCTYPE html>


<?php 

	$cssFile = "clan";
	include "Templates/head.php"; 

?>

<?php 
	
	include "Templates/header.php";   //On inclue le fichier qui contient l'image d'en tête
	
	$pageActive = "clan"; //On définit $pageActive par "clan", pour indiquer que la page qui est active est clan
	include "Templates/navigation.php"; //On inclue le fichier qui contient la navigation
?>




<div class="containerlargeclan"> 
    <?php 
        $donneesClan = file_get_contents('JSON/clan.json');
        $donneesClan = json_decode($donneesClan);
        $typeClan = $donneesClan->type;
        $origineClan = $donneesClan->{'location'}->name;
        //Action pour afficher l'origine du clan en français est non en anglais
        if($origineClan === "French Southern Territories") {
			$origineClan = "Terres australes et antarctiques françaises";
        } elseif($origineClan === "France") {
			$origineClan = "France";
        } else {
			$origineClan = "France";
        }
        //Action pour afficher le type de clan (ouvert,fermer,sur invitation)
        if($typeClan === "open") {
			$typeClan = "ouvert";
        } elseif($typeClan === "close") {
			$typeClan = "fermer";
        } else {
			$typeClan = "sur invitation";
        }
        
        $donneesClanMax = file_get_contents('JSON/max/max.json');
        $donneesClanMax = json_decode($donneesClanMax);
        
        
        $topClansLocal = file_get_contents('JSON/top/infoTopClansLocal.json');
		$topClansLocaldecoded = json_decode($topClansLocal);
		//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
		foreach($topClansLocaldecoded as $value) {
			//si il y a notre tag de clan, on execute l'action
			if($value->tag === "PGYRVQ2") {
				$PositionClanLocal = $value->rank;
				break;
			}
		}
        
        
        $topClansGeneral = file_get_contents('JSON/top/infoTopClansGeneral.json');
		$topClansGeneraldecoded = json_decode($topClansGeneral);
		//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
		foreach($topClansGeneraldecoded as $value) {
			//si il y a notre tag de clan, on execute l'action
			if($value->tag === "PGYRVQ2") {
				$PositionClanGeneral = $value->rank;
				break;
			} else {
				$PositionClanGeneral = ">1000";
				break;
			  }
		} 
		
        
        $topClansGDCLocal = file_get_contents('JSON/top/infoTopClansWarsLocal.json');
		$topClansGDCLocaldecoded = json_decode($topClansGDCLocal);
		//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
		foreach($topClansGDCLocaldecoded as $value) {
			//si il y a notre tag de clan, on execute l'action
			if($value->tag === "PGYRVQ2") {
				$PositionClanGDCLocal = $value->rank;
				break;
			}
		} 
		
        
		$topClansGDCGeneral = file_get_contents('JSON/top/infoTopClansWarsGeneral.json');
		$topClansGDCGeneraldecoded = json_decode($topClansGDCGeneral);
		//Le foreach permet d'avoir chaque clan du classement, puis on assigne un clan a $value
		foreach($topClansGDCGeneraldecoded as $value) {
			//si il y a notre tag de clan, on execute l'action
			if($value->tag === "PGYRVQ2") {
				$PositionClanGDCGeneral = $value->rank;
				break;
			} else {
				$PositionClanGDCGeneral = ">1000";
				break;
			  }
		} 
    ?>
    <div class="w3-animate-zoom articleclan">
        <div class="TitreArticle">  
            <img class="imageclan float-left" src="<?php echo $donneesClan->{"badge"}->image ?>"> 
            <h2 class="nomclan"> <?php echo $donneesClan->name ?> </h2>
            <h4 class="tagclan"> #<?php echo $donneesClan->tag ?> </h4>
            <br>
            <h4 class="descriptionclan"> <?php echo $donneesClan->description ?> </h4>
        </div>
		<div class="StatistiqueClan-Container">
			<div class="StatistiqueClan-DivStats">
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Situé en : <?php echo $origineClan ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Trophées requis : <?php echo $donneesClan->requiredScore ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Trophées maximum de clan : <?php echo $donneesClanMax->TrMaxClan ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Trophées maximum de clan en GDC : <?php echo $donneesClanMax->TrMaxGDC ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Nombre de membres maximum ayant participé à une GDC : <?php echo $donneesClanMax->ParticipantsMaxGDC ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Date de création du clan : 06/05/2016 </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Type : <?php echo $typeClan ?> </h4>
			</div>
			<div class="StatistiqueClan-DivStats"> 
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position du clan en Local : <?php echo $PositionClanLocal ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position du clan en General : <?php echo $PositionClanGeneral ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position du clan en GDC Local : <?php echo $PositionClanGDCLocal ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position du clan en GDC General : <?php echo $PositionClanGDCGeneral ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position maximum du clan en Local : <?php echo $donneesClanMax->PositionMaxClanLocal ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position maximum du clan en General : <?php echo $donneesClanMax->PositionMaxClanGeneral ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position maximum du clan en GDC Local : <?php echo $donneesClanMax->PositionMaxGDCLocal ?> </h4>
				<h4 class="StatistiqueClan-Stats"><img src="image/Podiums.png" class="theadimage"> Position maximum du clan en GDC General : <?php echo $donneesClanMax->PositionMaxGDCGeneral ?> </h4>
			</div>
		</div>
    </div>
</div>

</div>

<div class="containerlarge">
    <div class="w3-animate-zoom article">
		<div class="TitreArticle text-center">
			<p> Statistique des joueurs </p>
        </div>
        
        <div class="ArticleJoueurContent">
			<h4>Cliquez sur les en-têtes de chaque colonne pour trier le tableau, le premier range les lignes dans l'ordre décroissant, le deuxième dans l'ordre croissant.</h4>
        </div>
        
			<input id="Seasons" type="checkbox" >
			<label for="Seasons"> Statistique de Saisons </label>
			<input id="Combats" type="checkbox" > 
			<label for="Combats"> Statistique de Combats </label>
			<input id="Dons" type="checkbox" > 
			<label for="Dons"> Statistique de Dons </label>
			<input id="TournoisDefi" type="checkbox" > 
			<label for="TournoisDefi"> Statistique de tournois et défis </label>
		
      <div class="Tableau">
       
        <table border="1" id="tabletrier" align="center">
	<thead>
		<tr>
			 
			 
				<th class="un" title="Rang"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortTable(1)" class="deux" title="Pseudo du joueur"><img src="image/Podiums.png" class="theadimage" class="theadimage"></th>
				<th onclick="sortTable(2)" class="trois" title="Identifiant"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortTable(3)" class="quatre" title="Grade"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(4)" class="cinq" title="Niveau d'expérience"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(5)" class="six" title="Nombre de cartes trouvées"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(6)" class="sept" title="Nombre maximum de trophées atteint"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(7)" class="huit" title="Nombre de trophées actuel"><img src="image/Podiums.png" class="theadimage"></th>

				<th onclick="sortTableSaison(8)" class="neuf Stats-Seasons" title="Meilleur trophées cette saison"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortTableSaison(9)" class="dix Stats-Seasons" title="Trophées saison précédente"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortTableSaison(10)" class="onze Stats-Seasons" title="Max trophées saison précédente"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortTableSaison(11)" class="douze Stats-Seasons" title="Trophées de meilleur saison"><img src="image/Podiums.png" class="theadimage"></th>
				
				<th onclick="sortnumTable(12)" class="treize Stats-Combats" title="Nombre de victoires"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(13)" class="quatorze Stats-Combats" title="Nombre de défaites"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(14)" class="quinze Stats-Combats" title="Nombre de victoires à 3 couronnes"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(15)" class="seize Stats-Combats" title="Nombre d'égalités"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(16)" class="dixsept Stats-Combats" title="Pourcentage de victoire"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(17)" class="dixhuit Stats-Combats" title="Pourcentage de défaite"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(18)" class="dixneuf Stats-Combats" title="Pourcentage d'égalité"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(19)" class="vingt Stats-Combats" title="Victoires de JDC"><img src="image/Podiums.png" class="theadimage"></th>
			
				<th onclick="sortnumTable(20)" class="vingtun Stats-Dons" title="Dons"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(21)" class="vingtdeux Stats-Dons" title="Dons reçus"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(22)" class="vingttrois Stats-Dons" title="Dons totals"><img src="image/Podiums.png" class="theadimage"></th>
			
				<th onclick="sortnumTable(23)" class="vingtquatre Stats-TournoisDefi" title="Total parties tournois et défi"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(24)" class="vingtcinq Stats-TournoisDefi" title="Nombre de cartes gagnées en tournois"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(25)" class="vingtsix Stats-TournoisDefi" title="Nombre de cartes gagnées en défi"><img src="image/Podiums.png" class="theadimage"></th>
				<th onclick="sortnumTable(26)" class="vingtsept Stats-TournoisDefi" title="Nombre de victoires maximum en défi"><img src="image/Podiums.png" class="theadimage"></th>
			
		</tr>
	</thead>
	<tbody>
     <?php
     

           $file = file_get_contents('JSON/clan.json');
           $decodedtest = json_decode($file);
		   $n = 1;
		   $colonneNombreCouleur = 30;
		   
		   foreach($decodedtest->{"members"} as $value){
		     $tag = $value->tag;
		     $fp = file_get_contents('JSON/joueurProfil/'.$tag.'.json');
		     $decodedProfil = json_decode($fp);
             $i = $n++;
             $d = $colonneNombreCouleur++; 
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
             
             
     ?>
		<tr>
		    <td class="text-align-centre 1"><?php echo $i; ?></td>
			<td class="text-align-gauche 2"><a data-name="<?php echo $decodedProfil->name ?>" href="profil.php?tag=<?php echo $decodedProfil->tag ?>"><?php echo $decodedProfil->name ?></a></td>
			<td class="text-align-gauche 3">#<?php echo $decodedProfil->tag ?></td>
			<td class="text-align-gauche 4"><?php echo $decodedProfil->{"clan"}->role ?></td>
			<td class="5"><?php echo $decodedProfil->{"stats"}->level ?></td>
			<td class="6"><?php echo $decodedProfil->{"stats"}->cardsFound ?></td>
			<td class="7"><?php echo $decodedProfil->{"stats"}->maxTrophies ?></td>
			<td class="8"><?php echo $decodedProfil->trophies ?></td>
			<td class="9 Stats-Seasons"><?php echo $saisonActuel ?></td>
			<td class="10 Stats-Seasons"><?php echo $saisonPrecedenteTrophees ?></td>
			<td class="11 Stats-Seasons"><?php echo $saisonPrecedente ?></td>
			<td class="12 Stats-Seasons"><?php echo $meilleurSaison ?></td>
			<td class="13 Stats-Combats"><?php echo $decodedProfil->{"games"}->wins ?></td>
			<td class="14 Stats-Combats"><?php echo $decodedProfil->{"games"}->losses ?></td>
			<td class="15 Stats-Combats"><?php echo $decodedProfil->{"stats"}->threeCrownWins ?></td>
			<td class="16 Stats-Combats"><?php echo $decodedProfil->{"games"}->draws ?></td>
			<td class="17 Stats-Combats"><?php echo $decodedProfil->{"games"}->winsPercent*100 ?>%</td>
			<td class="18 Stats-Combats"><?php echo $decodedProfil->{"games"}->lossesPercent*100 ?>%</td>
			<td class="19 Stats-Combats"><?php echo $decodedProfil->{"games"}->drawsPercent*100 ?>%</td>
			<td class="20 Stats-Combats"><?php echo $decodedProfil->{"games"}->warDayWins ?></td>
			<td class="21 Stats-Dons"><?php echo $decodedProfil->{"clan"}->donations ?></td>
			<td class="22 Stats-Dons"><?php echo $decodedProfil->{"clan"}->donationsReceived ?></td>
			<td class="23 Stats-Dons"><?php echo $decodedProfil->{"stats"}->totalDonations ?></td>
			<td class="24 Stats-TournoisDefi"><?php echo $decodedProfil->{"games"}->tournamentGames ?></td>
			<td class="25 Stats-TournoisDefi"><?php echo $decodedProfil->{"stats"}->tournamentCardsWon ?></td>
			<td class="26 Stats-TournoisDefi"><?php echo $decodedProfil->{"stats"}->challengeCardsWon ?></td>
			<td class="27 Stats-TournoisDefi"><?php echo $decodedProfil->{"stats"}->challengeMaxWins ?></td>
		</tr>
     <?php
    	} 
     ?>
	     </tbody>
     	</table>
     	
      </div>
    </div>
</div>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

<script>
         
         
function sortTable(n) {                                                                                                     // fonction trie pour les lettres
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("tabletrier");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
    var rows = Array.from(document.querySelectorAll('#tabletrier tbody tr'));
    if (dir === 'asc') {
        for (let i = 1; i <= rows.length; i++ ) {
        rows[i-1].querySelector('td').innerHTML = i;
        }
    } else {
        for (let i = 0; i < rows.length; i++ ) {
        rows[i].querySelector('td').innerHTML = rows.length-i;
        }
    }
}

function sortTableSaison(n) {                                                                                                    // foncton pour le meilleur trophees saison uniquement
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("tabletrier");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
    var rows = Array.from(document.querySelectorAll('#tabletrier tbody tr'));
    if (dir === 'asc')
        for (let i = 1; i <= rows.length; i++ ) {
        rows[i-1].querySelector('td').innerHTML = i;
        }
    else {
        for (let i = 0; i < rows.length; i++ ) {
        rows[i].querySelector('td').innerHTML = rows.length-i;
        }
    }
}
 
      
function sortnumTable(n) {                                                                                                  // foncton trie pour les nombres
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("tabletrier");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
 
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      
      if (dir == "asc") {
        if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
       }
      } else if (dir == "desc") {
        if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
       }
      }
    }
    if (shouldSwitch) {
     
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
    var rows = Array.from(document.querySelectorAll('#tabletrier tbody tr'));
    if (dir === 'asc') {
        for (let i = 1; i <= rows.length; i++ ) {
        rows[i-1].querySelector('td').innerHTML = i;
        }
    } else {
        for (let i = 0; i < rows.length; i++ ) {
        rows[i].querySelector('td').innerHTML = rows.length-i;
        }
    }
}

//Thead de la colonne du tableau qui est survolé en vert  
$(document).ready(function(){
	$(".1").mouseover(function(){
		$(".un").css("background-color", "darkcyan");})
		.mouseout(function(){
		$(".un").css("background-color", "grey");
		});
	
	$(".2").mouseover(function(){
		$(".deux").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".deux").css("background-color", "grey");
		});

	$(".3").mouseover(function(){
		$(".trois").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".trois").css("background-color", "grey");
		});
		
	$(".4").mouseover(function(){
		 
		$(".quatre").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".quatre").css("background-color", "grey")
		});
	
	$(".5").mouseover(function(){
		 
		$(".cinq").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".cinq").css("background-color", "grey")
		});
	
	$(".6").mouseover(function(){
		 
		$(".six").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".six").css("background-color", "grey")
		});
		
	$(".7").mouseover(function(){
		 
		$(".sept").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".sept").css("background-color", "grey")
		});
	
	$(".8").mouseover(function(){
		 
		$(".huit").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".huit").css("background-color", "grey")
		});

	$(".9").mouseover(function(){
		 
		$(".neuf").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".neuf").css("background-color", "grey")
		});
	
	$(".10").mouseover(function(){
		 
		$(".dix").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".dix").css("background-color", "grey")
		});
	
	$(".11").mouseover(function(){
		 
		$(".onze").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".onze").css("background-color", "grey")
		});
	
	$(".12").mouseover(function(){
		 
		$(".douze").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".douze").css("background-color", "grey")
		});

	$(".13").mouseover(function(){
		 
		$(".treize").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".treize").css("background-color", "grey")
		});
	
	$(".14").mouseover(function(){
		 
		$(".quatorze").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".quatorze").css("background-color", "grey")
		});

	$(".15").mouseover(function(){
		 
		$(".quinze").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".quinze").css("background-color", "grey")
		});
	
	$(".16").mouseover(function(){
		 
		$(".seize").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".seize").css("background-color", "grey")
		});
	
	$(".17").mouseover(function(){
		 
		$(".dixsept").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".dixsept").css("background-color", "grey")
		});
	
	$(".18").mouseover(function(){
		 
		$(".dixhuit").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".dixhuit").css("background-color", "grey")
		});
		
	$(".19").mouseover(function(){
		 
		$(".dixneuf").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".dixneuf").css("background-color", "grey")
		});
	
	$(".20").mouseover(function(){
		 
		$(".vingt").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingt").css("background-color", "grey")
		});

	$(".21").mouseover(function(){
		 
		$(".vingtun").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingtun").css("background-color", "grey")
		});
	
	$(".22").mouseover(function(){
		 
		$(".vingtdeux").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingtdeux").css("background-color", "grey")
		});
	
	$(".23").mouseover(function(){
		 
		$(".vingttrois").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingttrois").css("background-color", "grey")
		});
	
	$(".24").mouseover(function(){
		 
		$(".vingtquatre").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingtquatre").css("background-color", "grey")
		});
  
	$(".25").mouseover(function(){
		 
		$(".vingtcinq").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingtcinq").css("background-color", "grey")
		});
	
	$(".26").mouseover(function(){
		 
		$(".vingtsix").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingtsix").css("background-color", "grey")
		});
		
	$(".27").mouseover(function(){
		 
		$(".vingtsept").css("background-color", "darkcyan")})
		.mouseout(function(){
		$(".vingtsept").css("background-color", "grey")
		});
});

</script>

</body>
</html>

