<!DOCTYPE html>

<?php 

	$cookie = json_decode($_COOKIE['metius-settings'], true);

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
		<button type="button" class="buttonSon w3-btn w3-cercle" onclick="pauses()"> <img class="Son" src="image/audio_off.png" alt="active"> </button>
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
						<input type="radio" name="Langue" value="Francais"> Français
					</div>
					<div class="choi">
						<input type="radio" name="Langue" value="Anglais"> Anglais
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
			<h1 class="text-left"> Thèmes </h1>
		</div>
		
		<div class="choixMusiques"> 
				
			<div class="themes">
				<ul class="diapoTheme">
				
					<li>
						<label>
							<input type="radio" name="Theme" value="Light1">
								<img src="image/header.jpeg">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Light2">
								<img src="image/header.jpeg">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="LightRed">
								<img src="image/header.jpeg">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Dark1">
								<img src="image/header.jpeg">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Dark2">
								<img src="image/header.jpeg">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="DarkRed">
								<img src="image/header.jpeg">
					</li>
				</ul>
				
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

document.querySelector('.js-form').addEventListener('submit', event => {
    event.preventDefault();
    var formFields = Array.from(event.target.elements).filter(q => q.checked);
    var settings = formFields.reduce((data, element) => ({
      ...data,
      [element.name]: element.value,
    }), {});
    cookie = getSettings();
	settings = Object.assign(cookie, settings);
    setCookie('metius-settings', JSON.stringify(settings), 365);
});

</script>




<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-13</p>
</div>

</body>
</html>

