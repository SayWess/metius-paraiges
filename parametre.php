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

	<div class="flex">
	
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
						<input type="radio" name="Music" value="Clash of Kings" <?php if($cookie['Music'] === 'Clash of Kings') { echo 'checked'; } ?> > Clash of Kings
					</div>
					<div class="choi">
						<input type="radio" name="Music" value="Clash Of" <?php if($cookie['Music'] === 'Clash Of') { echo 'checked'; } ?> > Clash of Kings
					</div>
					<div class="choi">
						<input type="radio" name="Music" value="Clash Kings" <?php if($cookie['Music'] === 'Clash Kings') { echo 'checked'; } ?> > Clash of Kings
					</div>
					
				</div>
			
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
						<input type="radio" name="Son" value="Clash of Kings" <?php if($cookie['Son'] === 'Clash of Kings') { echo 'checked'; } ?> > Clash of Kings
					</div>
					<div class="choi">
						<input type="radio" name="Son" value="Clash of" <?php if($cookie['Son'] === 'Clash of') { echo 'checked'; } ?> > Clash of Kings
					</div>
					<div class="choi">
						<input type="radio" name="Son" value="Clash" <?php if($cookie['Son'] === 'Clash') { echo 'checked'; } ?> > Clash of Kings
					</div>
					<div class="choi">
						<input type="radio" name="Son" value="King" <?php if($cookie['Son'] === 'Kings') { echo 'checked'; } ?> > Clash of Kings
					</div>
			
				</div>
			
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
						<input type="radio" name="Langue" value="Francais" <?php if($cookie['Langue'] === 'Francais') { echo 'checked'; } ?> > Français
					</div>
					<div class="choi">
						<input type="radio" name="Langue" value="Anglais" <?php if($cookie['Langue'] === 'Anglais') { echo 'checked'; } ?> > Anglais
					</div>
			
				</div>
			
			</div>
		
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
							<input type="radio" name="Theme" value="Light1" <?php if($cookie['Theme'] === 'Light1') { echo 'checked'; } ?>>
								<img class="imageTheme" src="OldWarriorsLight1.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Light2" <?php if($cookie['Theme'] === 'Light2') { echo 'checked'; } ?>>
								<img class="imageTheme" src="OldWarriorsLight2.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="LightRed" <?php if($cookie['Theme'] === 'LightRed') { echo 'checked'; } ?>>
								<img class="imageTheme" src="OldWarriorsLightRed.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Dark1" <?php if($cookie['Theme'] === 'Dark1') { echo 'checked'; } ?>>
								<img class="imageTheme" src="OldWarriorsDark1.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Dark2" <?php if($cookie['Theme'] === 'Dark2') { echo 'checked'; } ?>>
								<img class="imageTheme" src="OldWarriorsDark2.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="DarkRed" <?php if($cookie['Theme'] === 'DarkRed') { echo 'checked'; } ?>>
								<img class="imageTheme" src="OldWarriorsDarkRed.png">
					</li>
				</ul>
				
			</div>
		
		</div>
	
	</div>
	
	<div class="Button">
	
		<button class="w3-button submitButton" type="submit" onclick="reload();"> Sauvegarder les  Changements </button>
	
	</div>
	
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

