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
  
<?php

if (isset($_POST['submit']) && !empty($_POST['submit'])){
  if($_POST['email'] == $_POST['email2']){
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mdp = htmlspecialchars($_POST['password']);
    $phone = htmlspecialchars($_POST['phone']);

    // récupérer le nom et l'insérer dans la base de données
    $statement = $db->prepare("INSERT INTO Patient(email,nom, prenom, mdp,telephone) VALUES (:email,:nom,:prenom,:mdp,:telephone)");
    $statement->bindParam(':nom', $nom);
    
      // récupérer le prénom et l'insérer dans la base de données
    $statement->bindParam(':prenom', $prenom);
    
    // récupérer l'email et l'insérer dans la base de données
    $statement->bindParam(':email', $email);
      
    // récupérer le mot de passe et l'insérer dans la base de données
    $statement->bindParam(':mdp', $mdp);

    $statement->bindParam(':telephone', $phone);
    $statement->execute();
    header("Location: authentificationPatient.php");
  }else{
    echo "<h3> Erreur dans les adresses mail </h3>";
  }
}else{
?>
<form action="" method="post">
<h1>S'inscrire</h1>
<input type="text" class="form-control" name="nom" placeholder="Nom" required />
<input type="text" class="form-control" name="prenom" placeholder="Prénom" required />
<input type="number" class="form-control" name="phone" placeholder="Téléphone" required />
<input type="email" class="form-control" name="email" placeholder="Email" required />
<input type="email" class="form-control" name="email2" placeholder="Confirmation de votre email" required />
<input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="S'inscrire" class="btn btn-secondary" />
</form>
<form action="authentificationPatient.php" method="post">
    <p> Déjà inscrit ?  <button type="submit">Connectez vous ici</button> <p>
<?php } ?>
</body>
</html>
