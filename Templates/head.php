<script>

	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	var settings = getCookie('metius-settings');
	var parseSettings = JSON.parse(settings);
	console.log(parseSettings);
	var music = parseSettings[0][1];
	
</script>

<html lang="fr">
<head>



  <title>Métius Paraiges</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="Javascript/sounds.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">                                                                           <!--  Utilisation Boostrap et W3.css  -->
  <link rel="stylesheet" href="<?php echo $cssFile ?>.css" type="text/css">
  <link rel="stylesheet" href="CSS/Navigation/navigation.css" type="text/css">
  <link rel="icon" href="image/ImageClan.jpeg" type="image/jpeg">


  
</head> 
