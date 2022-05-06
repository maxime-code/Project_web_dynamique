<?php
include ("database.php");

ini_set('display_errors',1);
error_reporting(E_ALL);
dbConnect();
$db = dbConnect();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title> Page patient </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
  $requestpatient = 'SELECT * FROM patient WHERE email=:email';
  $statementpatient = $db->prepare($requestpatient);
  $statementpatient->bindParam(':email', $_SESSION['email']);
  $statementpatient->execute();
  $resultpatient = $statementpatient->fetch(PDO::FETCH_ASSOC);
?>
    <h1> Bonjour Monsieur <?php echo $result['nom'].' '.$result['prenom']; ?> </h1>
    <h2> Vos anciens rdv </h2>
    <div>
<?php 
  $requestrdv = 'SELECT * FROM RDV WHERE patientemail=:email';
  $statementrdv = $db->prepare($requestrdv);
  $statementrdv->bindParam(':email', $_SESSION['email']);
  $statementrdv->bindParam(':mdp',$mdp);
  $statementrdv->execute();
  $resultrdv = $statement->fetch(PDO::FETCH_ASSOC);
  foreach($resultrdv as $result)
  {
    echo '<tr>';
    echo '<td> Avec '.$result['medecinemail'].'</td>';
    echo '<td> Le '.$result['debut'].' - '.$result['fin'].'</td>';
    echo '<td> Pour '.$result['informations'].'</td>';
    echo '</tr>';
  }
?>
    </div>
    <h2> Prendre un nouveau rendez vous </h2>
      <form action="" method="post">
          <input type="text" class="form-control" name="nom" placeholder="Nom du médecin" />
          <input type="text" class="form-control" name="prenom" placeholder="Prénom du médecin" />
          <input type="text" class="form-control" name="specialite" placeholder "Spécialité" />
          <input type="text" class="form-control" name="codepostal" placeholder="Code Postal" />
          <input type="submit" name="submit" value="Rechercher" class="btn btn-secondary" />
        </form>
    <div>
<?php 
  if (isset($_POST['submit']) && !empty($_POST['submit'])){
     if(!isset($_POST['medecin']) && !isset($_POST['specialite']) && !isset($_POST['codepostal'])){
       echo "Veuillez au moins remplir un de ces critères";
       } else {
       if(isset($_POST['medecin']) && !isset($_POST['specialite']) && isset($_POST['codepostal'])){
         $request1 = 'SELECT * FROM medecin WHERE nom=:nom, prenom=:prenom, specialite=:specialite, codepostal=:codepostal';
         $statement1 = $db->prepare($request1);
         $statement1->bindParam(':nom', $_POST['nom']);
         $statement1->bindParam(':prenom', $_POST['prenom']);
         $statement1->bindParam(':nom', $_POST['specialite']);
         $statement1->bindParam(':nom', $_POST['codepostal']);
         $statement->execute();
         $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        echo "<form action='' method='POST'> <select class='form-select' name='medecin'>";
        foreach($result1 as $result){
          echo   "<option value='Docteur ".$result['nom']." ".$result['prenom']." situé en ".$result['codepostal'].", spécialiste en ".$result['specialite']."'</option>";
        }
        echo "</select> <br> <input type='submit' name='valider' class='btn btn-primary' value='Selectionne'> </form>";
        if(isset($_POST["medecin"])){
          // faut compléter la
        } 
       }
      }
    }
?>
    </div>
    <p><a href="deconnexion.php"> Se déconnecter</a><p>
</body>
</html>
