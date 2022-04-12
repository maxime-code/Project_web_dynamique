// Page d'inscription pour un patient

<!DOCTYPE html>
<html>
<head>
  <title> Page d'inscription </title>
  // On ajoute Boostrap
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  
<?php
include 'database.php';
  db = dbConnect();
if (isset($_POST['nom'],$_POST['Prenom'], $_POST['email'], $_POST['email2'] $_POST['password'])){
if($_POST['email'] == $_POST['email2']){
  
 // récupérer le nom et l'insérer dans la base de données
$lastname = $db->prepare("INSERT INTO patient(nom) VALUES (:nom)");
$lastname->bindParam(':nom', $_POST['nom']);
$lastname->execute();

 // récupérer le prénom et l'insérer dans la base de données
$firstname = $db->prepare("INSERT INTO patient(prenom) VALUES (:prenom)");
$firstname->bindParam(':prenom', $_POST['prenom']);
$firstname->execute();
 
// récupérer l'email et l'insérer dans la base de données
$email = $db->prepare("INSERT INTO patient(email) VALUES (:email)");
$email->bindParam(':email', $_POST['email']);
$email->execute();
  
// récupérer le mot de passe et l'insérer dans la base de données
$mdp = $db->prepare("INSERT INTO patient(mdp) VALUES (:mdp)");
$mdp->bindParam(':mdp', $_POST['password']);
$mdp->execute();

header("Location: authentification.php);
}
}else{
  echo "<h3> Erreur dans les adresses mail" </h3>
}else{
?>
<form action="" method="post">
<h1>S'inscrire</h1>
<input type="text" class="form-control" name="nom" placeholder="Nom" required />
<input type="text" class="form-control" name="prenom" placeholder="Prénom" required />
<input type="email" class="form-control" name="email" placeholder="Email" required />
<input type="email" class="form-control" name="email2" placeholder="Confirmation de votre email" required />
<input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="S'inscrire" class="btn btn-secondary" />
<p> Si vous êtes déja inscrit <a class="nav-link" href="authentification.php"> Vous pouvez vous connectez à cet endroit </a></p>
</form>
<?php } ?>
</body>
</html>
