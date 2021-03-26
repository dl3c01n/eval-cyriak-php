<?php
require('./database.php');
$chienIdUrl = $_REQUEST['id'];
if(isset($chienIdUrl)){
    global $pdo;
$deleteRow = $pdo->prepare('DELETE FROM chien WHERE idchien = ?');
$deleteRow->bindParam(1, $chienIdUrl);
$deleteRow->execute();
}
header("refresh:5;url=index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Animaux</title>
</head>
<body>

<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">Animaux</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="index.php">Accueil</a></li>
      </ul>
    </div>
  </nav>
    
<div class="progress center">
      <div class="indeterminate"></div>
  </div>
  <h1 class="center">Suppression en cours, vous allez être redirigé...</h1>
  <p class="center">Si ce n'est pas le cas, cliquez ici : <a href="index.php">Accueil</a></p>
  <div class="progress center">
      <div class="indeterminate"></div>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>