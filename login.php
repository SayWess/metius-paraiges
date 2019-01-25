<?php

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $users = json_decode(file_get_contents("users.json"), true);
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (array_key_exists($username, $users)) {
        if ($users[$username] == $password) {
            $_SESSION['username'] = $username;
            header("Location: espaceadmin.php");
            // redirect to where you want
        } else {
            echo "wrong password";
        }
    } else {
        echo "unknown user";
    }
} else { ?>

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
  <link rel="stylesheet" href="login.css" type="text/css">
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
        <a class="nav-linkactive" href="login.php">Espace Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="oldWarriors.php">Les disparus</a>
      </li>
    </ul>
  </div>  
</nav>

<div class="container">
  <div class="row">
    
    <div class="col-sm-12 w3-animate-zoom article">
      <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
    <div class="form-group">
      <h1>Admin login</h1>
      <br><br>
      <h4>Name:</h4>
      <input type="text" class="form-control" id="name" placeholder="Enter your name" name='username'>
    </div>
      <br>
    <div class="form-group">
      <h4>Password:</h4>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name='password'>
    </div>
    <br><br><br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
      <br>
    </div>
    
    <img src="image/CR_Geant Royal.png" class="w3-animate-right float-right image"></img>
    
    
  </div>
</div>

<div class="jumbotron footer">
  <p>Auteur : SayWess | Dernière modification: 2018-12-27</p>
</div>

</body>
</html>

<?php } ?>
