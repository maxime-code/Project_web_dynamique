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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
  session_start();
  if(isset($_POST['submit']) && !empty($_POST['submit'])){
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['password']);
    $request = 'SELECT email, mdp FROM Medecin WHERE email=:email AND mdp=:mdp';
    $statement = $db->prepare($request);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':mdp',$mdp);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $row = $statement->rowCount();
    if($row == 1 && $result['email'] == $email && $result['mdp'] === $mdp)
    {
      $_SESSION['email'] = $result['email'];
      header("Location: medecin.php");
    }else{
        $erreur = "Vos identifiants sont incorrect.";
    }  
}
 ?>

<form action="" method="post">
<h1>Se connecter</h1>
<input type="text" class="form-control" name="email" placeholder="Email" required />
<input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="Se connecter" class="btn btn-secondary" />
</form>
<form action="inscriptionMedecin.php" method="post">
    <p> Pas encore inscrit ?  <button type="submit">Faites-le ici</button> <p>
    <?php if (! empty($erreur)) { ?>
  <p><?php echo $erreur; ?></p>
<?php } ?>
</form>
</body>
</html>
