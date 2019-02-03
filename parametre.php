<!DOCTYPE html>

<?php 

	$cssFile = "parametre";
	include "Templates/head.php"; 

?>
<body onload="musicFond(music);">

<?php 
	
	include "Templates/header.php";
	
	$pageActive = "parametre";
	include "Templates/navigation.php"; 
?>

<form class="js-form">

<div class="content">
	
	<div class="containerD">
		
		<div class="borderDiv">
		<button type="button" class="buttonSon w3-btn w3-cercle" onclick="pause();"> <img class="Son" src="image/audio_off.png" alt="active"> </button>
		<h1 class="text-left"> Musiques </h1>
		</div>
		
		<div class="choixMusiques"> 
				
			<div class="Groupe-musique">
				
				<h3 class="sous-titre"> Quelle musique de fond voulez-vous ? </h3>
			
				<div class="choix">
					
					<div class="choi">
						<input type="radio" name="Music" value="Clash of Kings"> Clash of King
					</div>
					<div class="choi">
						<input type="radio" name="Music" value="One Piece Epic Music"> One Piece Music
					</div>
					<div class="choi">
						<input type="radio" name="Music" value="Clash of Kings"> Clash of King
					</div>
			
				</div>
			
			</div>
			
			<div>
				<h3> Volume </h3>
				
				<audio id="music" controls> </audio> 
			</div>
		
		
			
		
		</div>
	
	</div>
	
	<div class="containerD">
		
		<div class="borderDiv">
		<button class="buttonSon w3-btn w3-cercle"> <img class="Son" src="image/audio_off.png" alt="active"> </button>
		<h1 class="text-left"> Son boutons </h1>
		</div>
		
		<div class="choixMusiques"> 
				
			<div class="Groupe-musique">
				
				<h3 class="sous-titre"> Quelle bruit de boutons voulez-vous ? </h3>
			
				<div class="choix">
				
					<div class="choi">
						<input type="radio" name="Son" value="Clash of Kings"> Clash of King
					</div>
					<div class="choi">
						<input type="radio" name="Son" value="Clash of"> Clash of King
					</div>
					<div class="choi">
						<input type="radio" name="Son" value="Clash"> Clash of King
					</div>
					<div class="choi">
						<input type="radio" name="Son" value="King"> Clash of King
					</div>
			
				</div>
			
			</div>
			
			<div>
				<h3> Volume </h3>
				
				<audio controls> </audio> 
			</div>
		
		
			
		
		</div>
	
	</div>
	
	<div class="containerD">
		
		<div class="borderDiv">
			<h1 class="text-left"> Langue </h1>
		</div>
		
		<div class="choixMusiques"> 
				
			<div class="Groupe-musique">
				
				<h3 class="sous-titre"> Quelle langue voulez-vous ? </h3>
			
				<div class="choix">
				
					<div class="choi">
						<input type="radio" name="Langue" value="Clash  of King"> Clash of King
					</div>
					<div class="choi">
						<input type="radio" name="Langue" value="Clash of King"> Clash of King
					</div>
			
				</div>
			
			</div>
			
			<div>
				<h3> Volume </h3>
				
				<audio controls> </audio> 
			</div>
		
		
			
		
		</div>
	
	</div>
	
	<div class="containerD">
	
	<h1 class="text-left"> Thèmes </h1>
		
		<h3 class="musique"> Quelle thème voulez-vous ? </h3>
		<div class="choixMusiques"> 
		</div>
		
	</div>
	
	</div>
	
	<button type="submit" onclick="reload();"> Sauvegarder les  Changements </button>

</div>

</form>

<script>

function setCookie(cname,cvalue,exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

document.querySelector('.js-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(event.target);
    var settings = [...formData.entries()];
    setCookie('metius-settings', JSON.stringify(settings), 1000);
});

</script>




<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-13</p>
</div>

</body>
</html>

