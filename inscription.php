<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = 'mot_de_passe_bdd';
    $db_name     = 'nom_bdd';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['username'] = $username;
           header('Location: principale.php');
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!-- <link rel="stylesheet" href="style.css">-->
    <!--//col-md-10 c pour diviser l'ecran en partie//-->
</head>
  <body>
      <div class="container bg-success">
        <div class="row col-md-10 mx-auto">  <!-- mx-auto =margin-auto pour centrer-->
    <div class="col-md-8 bg bg-light mt-2 mb-2"><!--mt=margin-top    ml=margin-left    mr=margin-right  mb= margin-bottom-->
        <h1>INSCRIPTION</h1>
    </div>
    <div class="col-md-2 float-right">
  <img src="ic-login.png" class="rounded rounded-circle float-right" height='80px' alt=""><!--rounded-circle c pour rendre rond l'image-->
    </div>
        </div>
        <form action="" method="post">
            <div class="form-group col-md-10 mx-auto">
              <label for=""></label>
              <input type="text"
                class="form-control " name="prenom" id="prenom" aria-describedby="helpId" placeholder="PRENOM">
              <small id="helpId" class="form-text text-muted">Help text</small> <label for=""></label>
              <input type="text"
                class="form-control " name="nom" id="nom" aria-describedby="helpId" placeholder="NOM">
              <small id="helpId" class="form-text text-muted">Help text</small>
              <label for=""></label>
              <input type="text"
                class="form-control " name="login" id="login" aria-describedby="helpId" placeholder="LOGIN">
              <small id="helpId" class="form-text text-muted">Help text</small>
              <label for=""></label>
              <input type="password"
                class="form-control " name="password" id="password" aria-describedby="helpId" placeholder="PASSWORD">
              <small id="helpId" class="form-text text-muted">Help text</small>
              <label for=""></label>
              <input type="password"
                class="form-control " name="password" id="password" aria-describedby="helpId" placeholder="confirm-PASSWORD">
              <small id="helpId" class="form-text text-muted">Help text</small>
              
              <button class="btn btn-outline-dark" type='submit'>Creer un compte</button>
              <button class="btn btn-outline-dark float-right" type='submit'>Choisir un fichier</button>

            </div>
            
        </form>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
