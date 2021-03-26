<?php
require('./database.php');
$urlId = $_REQUEST['id'];
$updateNom = $_POST['nom'];
$updateRace = $_POST['idRace'];
if(isset($updateNom) && isset($updateRace)){
    if(empty($updateNom) || empty($updateRace)){
        echo 'Oops, un truc manque, vérifier votre formulaire';
    }else{
        global $pdo;
        $updateRow = $pdo->prepare('UPDATE chien SET nom=?, race_id=? WHERE idchien=?');
        $updateRow->bindParam(1, $updateNom);
        $updateRow->bindParam(2, $updateRace);
        $updateRow->bindParam(3, $urlId);
        $updateRow->execute();
    }
}
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

<section>
    <div class="container">
        <div class="row">
            <div class="col s6 center offset-s3">
                <form method="post">
                <h2>Mettre à jour un chien</h2>
                        <?php 
                            global $pdo;
                            $getChien = $pdo->prepare('SELECT * FROM chien as c, race as r WHERE c.idchien = :idUrl AND c.race_id = r.id');
                            $getChien->bindParam(':idUrl', $urlId);
                            $getChien->execute();
                            $getChien = $getChien->fetch();
                        ?>
                        <input type="text" style="margin: 15px 0px" name="nom" id="nom" value="<?= $getChien['nom'] ?>">
                        <select style="margin: 15px 0px" name="idRace">
                        <?php
                            global $pdo;
                            $sql = $pdo->query('SELECT * FROM race');
                            $sql = $sql->fetchAll(PDO::FETCH_OBJ);

                            foreach($sql as $key => $value){
                                ?>
                                <option value="<?= $value->id ?>" <?php echo ($value->id == $getChien['race_id']) ? ' selected="selected"' : '' ?>><?= $value->type?></option>
                            <?php }
                        ?>
                        </select>
                        <input style="margin: 15px 0px" type="submit" value="Créer">
                </form>
            </div>
        </div>
    </div>
</section>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});</script>

</body>
</html>