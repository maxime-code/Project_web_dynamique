// Page d'authentification et d'enregistrement

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
  include 'database.php';
  session_start();
  if(isset($_POST['email'],$_POST['mdp'])){
    $request = 'SELECT email, mdp FROM patient WHERE email=:email AND mdp=:mdp';
    $db = dbConnect();
    $statement = $db->prepare($request);
    $statement->bindParam(':email', $_POST['email']);
    $statement->bindParam(':mdp',$_POST['mdp']);
    $statement->execute;
    if($statement)
    {
      $_SESSION['email'] = $email;
      header("Location: PageMedecin.php");
    }else{
      $erreur = "Vos identifiants sont incorrect.";
    }    
 ?>
<form action="" method="post">
<h1>Se connecter</h1>
<input type="text" class="form-control" name="email" placeholder="Email" required />
<input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="Se connecter" class="btn btn-secondary" />
  <a href="#motdepasse.php"> Mot de passe oublié </a>
<p> Vous êtes nouveau ? <a class="nav-link" href="InscriptionPatient.php"> Vous pouvez vous inscrire à cet endroit </a></p>
<?php if (! empty($erreur)) { ?>
  <p>?php echo $erreur; ?></p>
<?php } ?>
</form>
</body>
</html>
