<?php
require('./database.php');
$nom = $_POST['nom'];
$idRace = $_POST['idRace'];
if(isset($nom) && isset($idRace)){
    if(empty($nom) || empty($idRace)){
        echo 'Oops, un truc manque, vérifier votre formulaire';
    }else{
        global $pdo;
        $add = $pdo->prepare('INSERT INTO chien(`nom`, `race_id`) VALUE(?, ?)');
        $add->bindParam(1, $nom);
        $add->bindParam(2, $idRace);
        $add->execute();
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
    </div>
  </nav>

  <section>
    <div class="container">
        <div class="row">
            <div class="col s6">
            <ul class="collection with-header">
        <li class="collection-header"><h4 class="center">Chiens</h4></li>

            <?php
                global $pdo;
                $stmt = $pdo->query('SELECT idchien, nom, type FROM chien as c, race as r WHERE c.race_id = r.id');
                $stmt = $stmt->fetchAll(PDO::FETCH_OBJ);

                foreach ($stmt as $k => $v){
                    ?>
                    <li class="collection-item"><div><?= $v->nom ?> est de la race <?= $v->type ?>
                        <a href="./update.php?id=<?= $v->idchien ?>" class="secondary-content">
                        <i class="material-icons text-darken-2">edit</i>
                        </a>
                        <a href="./delete.php?id=<?= $v->idchien ?>" class="secondary-content">
                        <i class="material-icons text-darken-2">delete</i>
                        </a>
                        </div></li>
                <?php }
            ?>
        
      </ul>
            </div>
            <div class="col s6 center">
                    <form method="post">
                    <h2>Ajouter un chien</h2>
                        <input type="text" style="margin: 15px 0px" name="nom" id="nom">
                        <select style="margin: 15px 0px" name="idRace" id="selectRace">
                        <?php
                            global $pdo;
                            $sql = $pdo->query('SELECT * FROM race');
                            $sql = $sql->fetchAll(PDO::FETCH_OBJ);

                            foreach($sql as $key => $value){
                                ?>
                                <option value="<?= $value->id ?>"><?= $value->type?></option>
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