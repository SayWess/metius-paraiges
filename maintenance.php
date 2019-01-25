<?php 
//
//Renvoie en mode maintenance
//
header('HTTP/1.1 503 Service Unavailable');
header('Retry-After: 150');
?>



<!DOCTYPE html>
<html lang="en">
<head>



  <title>Métius Paraiges</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
  <link rel="stylesheet" href="maintenance.css" type="text/css">
  <link rel="icon" href="image/ImageClan.jpeg" type="image/jpeg">
  
  
</head>
<body>

<div class="jumbotron header" style="margin-bottom:0"> </div>

<div class="container" style="margin-top:30px">
  <div class="row">
    
    <div class="col-sm-12 article1">
      <h1 class="text-center ">Mise à jour des données de clan en cours !<br><br> Site indisponible durant les 3 prochaines minutes <br><br> Veuillez revenir après ce délai</h1>
      <br>
      <h2></h2>
      <br>
    </div>
    
  </div>
</div>

<div>
  <footer class="footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
  </footer>
</div>

</body>
</html>

