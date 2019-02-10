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

	<div class="flex">
	
	<div class="containerD">
		
		<div class="borderDiv">
		<h1 class="text-left"> Musiques </h1>
		<button id="Music-Button" class="buttonSon w3-btn w3-cercle Music-Button" onclick="pauses()"> <i class="material-icons"></i> </button>
		</div>
		
		<div class="choixMusiques"> 
				
			<div class="Groupe-musique">
				
				<h3 class="sous-titre"> Quelle musique de fond voulez-vous ? </h3>
			
				<div class="choix">
						
					<div>
						<input id="musique 1" type="radio" name="Music" value="Clash royale" <?php if($cookie['Music'] === 'Clash royale') { echo 'checked'; } ?> >
						<label for="musique 1" class="choi"> <i class="material-icons"></i> Clash royale </label>
					</div>
					<div>
						<input id="musique 2" type="radio" name="Music" value="Clash royale battle" <?php if($cookie['Music'] === 'Clash royale battle') { echo 'checked'; } ?> >
						<label for="musique 2" class="choi"> <i class="material-icons"></i> Clash Royale battle </label>
					</div>
					<div>
						<input id="musique 3" type="radio" name="Music" value="Clash of Kings" <?php if($cookie['Music'] === 'Clash of Kings') { echo 'checked'; } ?> >
						<label for="musique 3" class="choi"> <i class="material-icons"></i> Clash of Kings </label>
					</div>
					
				</div>
			
			</div>
		
		</div>
	
	</div>
	
	<div class="containerD">
		
		<div class="borderDiv">
		<h1 class="text-left">Son boutons </h1>
		<button class="buttonSon w3-btn w3-cercle Sound-Button" onclick="Sound()"><i class="material-icons"></i>  </button>
		</div>
		
		<div class="choixMusiques"> 
				
			<div class="Groupe-musique">
				
				<h3 class="sous-titre"> Quelle bruit de boutons voulez-vous ? </h3>
			
				<div class="choix">
				
					<div>
						<input id="son 1" type="radio" name="Son" value="Button Click 1" <?php if($cookie['Son'] === 'Button Click 1') { echo 'checked'; } ?> >
						<label for="son 1" class="choi"> <i class="material-icons"></i> Son 1 </label>
					</div>
					<div>
						<input id="son 2" type="radio" name="Son" value="Button Click 2" <?php if($cookie['Son'] === 'Button Click 2') { echo 'checked'; } ?> >
						<label for="son 2" class="choi"> <i class="material-icons"></i> Son 2 </label>
					</div>
					<div>
						<input id="son 3" type="radio" name="Son" value="Button Click 3" <?php if($cookie['Son'] === 'Button Click 3') { echo 'checked'; } ?> >
						<label for="son 3" class="choi"> <i class="material-icons"></i> Son 3 </label>
					</div>
					<div>
						<input id="son 4" type="radio" name="Son" value="Button Click 4" <?php if($cookie['Son'] === 'Button Click 4') { echo 'checked'; } ?> >
						<label for="son 4" class="choi"> <i class="material-icons"></i> Son 4 </label>
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
				
					<div>
						<input id="francais" type="radio" name="Langue" value="Francais" <?php if($cookie['Langue'] === 'Francais') { echo 'checked'; } ?> >
						<label for="francais" class="choi"> <i class="material-icons"></i> Français </label>
					</div>
					<div>
						<input id="anglais" type="radio" name="Langue" value="Anglais" <?php if($cookie['Langue'] === 'Anglais') { echo 'checked'; } ?> >
						<label for="anglais" class="choi"> <i class="material-icons"></i> Anglais </label>
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
		
		<div class="Themes"> 
				
			<div class="themes">
				<ul class="diapoTheme">
				
					<li>
						<label>
							<input type="radio" name="Theme" value="Light1" <?php if($cookie['Theme'] === 'Light1') { echo 'checked'; } ?>>
								<img class="imageTheme" src="CSS/OldWarriors/OldWarriorsLight1.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Light2" <?php if($cookie['Theme'] === 'Light2') { echo 'checked'; } ?>>
								<img class="imageTheme" src="CSS/OldWarriors/OldWarriorsLight2.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="LightRed" <?php if($cookie['Theme'] === 'LightRed') { echo 'checked'; } ?>>
								<img class="imageTheme" src="CSS/OldWarriors/OldWarriorsLightRed.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Dark1" <?php if($cookie['Theme'] === 'Dark1') { echo 'checked'; } ?>>
								<img class="imageTheme" src="CSS/OldWarriors/OldWarriorsDark1.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="Dark2" <?php if($cookie['Theme'] === 'Dark2') { echo 'checked'; } ?>>
								<img class="imageTheme" src="CSS/OldWarriors/OldWarriorsDark2.png">
					</li>
					<li>
						<label>
							<input type="radio" name="Theme" value="DarkRed" <?php if($cookie['Theme'] === 'DarkRed') { echo 'checked'; } ?>>
								<img class="imageTheme" src="CSS/OldWarriors/OldWarriorsDarkRed.png">
					</li>
				</ul>
				
			</div>
		
		</div>
	
	</div>
	
	<div class="Button">
	
		<button class="submitButton" type="submit" onclick="reload();"> <i class="material-icons">save_alt</i> Sauvegarder les changements </button>
	
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

if(sound == true) {
	document.querySelector('.Sound-Button').classList.add('Sound-Button--on');
} else if(sound == false) {
	document.querySelector('.Sound-Button').classList.add('Sound-Button--off');
}

if(isMusicPaused == true) {
	document.querySelector('.Music-Button').classList.add('Music-Button--play');
} else if(isMusicPaused == false) {
	document.querySelector('.Music-Button').classList.add('Music-Button--paused');
}


</script>




<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-13</p>
</div>

</body>
</html>

