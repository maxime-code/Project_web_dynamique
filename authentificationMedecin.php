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
<div class="login-form">
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
        $erreur = "Vos identifiants sont incorrect ou n'existe pas.";
    }  
}
 ?>

<form action="" method="post">
<h1 class="text-center">Se connecter</h1>
  <div class="form-group">
<input type="text" class="form-control" name="email" placeholder="Email" required />
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
  </div>
  <div class="form-group">
    <input type="submit" name="submit" value="Se connecter" class="btn btn-secondary" />
  </div>
  </form>
    <?php if (! empty($erreur)) { ?>
  <div class="alert alert-danger">
                                <strong> <?php echo $erreur; ?> </strong>
</div>
<?php } ?>
  <p class="text-center"><a href="inscriptionMedecin.php">Inscription</a></p>
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
