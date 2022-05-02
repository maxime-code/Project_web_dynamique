<?php
include ("database.php");

ini_set('display_errors',1);
error_reporting(E_ALL);
dbConnect();
$db = dbConnect();
?>
<!DOCTYPE html>
<html>
<head>
  <title> Page d'inscription </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="login-form">
<?php

if (isset($_POST['submit']) && !empty($_POST['submit'])){
  if($_POST['email'] == $_POST['email2']){
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $codepostal = htmlspecialchars($_POST['codepostal']);
    $specialite = htmlspecialchars($_POST['specialite']);
    $mdp = htmlspecialchars($_POST['password']);
    $phone = htmlspecialchars($_POST['phone']);

    // récupérer le nom et l'insérer dans la base de données
    $statement = $db->prepare("INSERT INTO Medecin (nom, prenom, telephone, email, codepostal, mdp, specialite) VALUES (:nom, :prenom, :telephone, :email, :codepostal, :mdp, , :specialite)");
    $statement->bindParam(':nom', $nom);
    
      // récupérer le prénom et l'insérer dans la base de données
    $statement->bindParam(':prenom', $prenom);
    
    // récupérer l'email et l'insérer dans la base de données
    $statement->bindParam(':email', $email);
      
    // récupérer le mot de passe et l'insérer dans la base de données
    $statement->bindParam(':mdp', $mdp);
    $statement->bindParam(':codepostal', $codepostal);
    $statement->bindParam(':specialite', $specialite);
    $statement->bindParam(':telephone', $phone);
    $statement->execute();
    header("Location: authentificationMedecin.php");
  }else{
    echo "<h3> Erreur dans les adresses mail </h3>";
  }
}else{
?>
<form action="" method="post">
<h1 class="text-center">S'inscrire</h1>
  <div class="form-group">
<input type="text" class="form-control" name="nom" placeholder="Nom" required />
  </div>
  <div class="form-group">
<input type="text" class="form-control" name="prenom" placeholder="Prénom" required />
  </div>
  <div class="form-group">
<input type="text" class="form-control" name="codepostal" placeholder="Code Postal" required />
  </div>
  <div class="form-group">
<input type="text" class="form-control" name="telephone" placeholder="Téléphone" required />
  </div>
  <div class="form-group">
<input type="text" class="form-control" name="email" placeholder="Email" required />
  </div>
  <div class="form-group">
<input type="text" class="form-control" name="email2" placeholder="Confirmation de votre email" required />
  </div>
  <div class="form-group">
<input type="text" class="form-control" name="specialite" placeholder="Spécialité" required />
  </div>
  <div class="form-group">
<input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
  </div>
  <div class="form-group">
<input type="submit" name="submit" value="S'inscrire" class="btn btn-secondary" />
  </div>
</form>
  </div>
<p class="text-center"><a href="authentificationMedecin.php"> Vous avez déjà un compte </a></p>
<?php } ?>
  <style>
            .login-form {
                width: 340px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
</body>
</html>
