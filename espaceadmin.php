<?php

session_start();

//if(!isset($_SESSION['username'])) {
//    die('please <a href="login.php">login</a>');
    
//}


//echo "hello ". $_SESSION['username'];

?>

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
  <link rel="stylesheet" href="espaceadmin.css" type="text/css">
  <link rel="icon" href="image/ImageClan.jpeg" type="image/jpeg">
  
  
</head>
<body>

<div class="jumbotron header"></div>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="index.html">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="clan.php">Clan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reglement.html">Règlement</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="recrutement.html">Recrutement</a>
      </li>    
      <li class="nav-item">
        <a class="nav-linkactive" href="espaceadmin.php">Espace Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="oldWarriors.php">Les disparus</a>
      </li>
    </ul>
  </div>  
  <a class="navbar-brand" href="logout.php">Logout</a>
</nav>

<div class="container"">
  <div class="row">
    
    <div class="col-sm-12 w3-animate-zoom article">
      <p> <?php 
      echo "<h2>Bonjours ". $_SESSION['username']."</h2>";
      ?> </p> 
      <br>
      <h5>How are you today ? </h5> 
      <br>
      <h5>Thank you very much TrainZug ! </h5>
      <br>
      <br>
    </div>
    
    
  </div>
</div>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2019-01-06</p>
</div>

</body>
</html>

