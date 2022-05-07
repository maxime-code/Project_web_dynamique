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
    <h1> Bonjour Monsieur <?php echo $resultpatient['prenom'].'  de '.$resultpatient['nom']; ?> </h1>
    <h2> Vos anciens rdv </h2>
    <div>
<?php 
  $requestrdv = 'SELECT * FROM rdv WHERE patientemail=:email';
  $statementrdv = $db->prepare($requestrdv);
  $statementrdv->bindParam(':email', $_SESSION['email']);
  $statementrdv->execute();
  $resultrdv = $statementrdv->fetchAll(PDO::FETCH_ASSOC);
  foreach($resultrdv as $tableau)
  {
    echo '<tr>';
    echo '<td> Rendez vous avec '.$tableau['medecinemail'].'</td>';
    echo '<td> le '.$tableau['debut'].' - '.$tableau['fin'].'</td>';
    echo '<td> Info: '.$tableau['informations'].'</td>';
    echo '</tr>';
  }
?>
    </div>
    <h2> Prendre un nouveau rendez vous </h2>
      <form action="" method="post">
          <input type="text" class="form-control" name="nom" placeholder="Nom du médecin" />
          <input type="text" class="form-control" name="prenom" placeholder="Prénom du médecin" />
          <input type="text" class="form-control" name="specialite" placeholder="Spécialité" />
          <input type="text" class="form-control" name="codepostal" placeholder="Code Postal" />
          <input type="submit" name="submit" value="Rechercher" class="btn btn-secondary" />
        </form>
    <div>
<?php 
  if (isset($_POST['submit']) && !empty($_POST['submit'])){
     if(empty($_POST['nom']) && empty($_POST["prenom"]) && empty($_POST['specialite']) && empty($_POST['codepostal'])){
       echo "Veuillez au moins remplir un de ces critères";
       } 
     else {
       if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['specialite']) && isset($_POST['codepostal'])){
         $request = 'SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom AND specialite=:specialite AND codepostal=:codepostal';
         $statement = $db->prepare($request);
         $statement->bindParam(':nom', $_POST['nom']);
         $statement->bindParam(':prenom', $_POST['prenom']);
         $statement->bindParam(':specialite', $_POST['specialite']);
         $statement->bindParam(':codepostal', $_POST['codepostal']);
         $statement->execute();
         $result = $statement->fetchAll(PDO::FETCH_ASSOC);
       }
       if(isset($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }


         echo "<form action='' method='post'> <select name='medecin' class='form-select'>";
        foreach($result as $resultat){
          echo "<option value='".$resultat['mail']."'> Docteur ".$resultat['nom']." ".$resultat['prenom']." situé en ".$resultat['codepostal'].", spécialiste en ".$resultat['specialite']."</option>";
        }
        echo "</select> <input type='submit' name='valider' class='btn btn-secondary'> </form>";


        $requestmedecin = 'SELECT * FROM medecin where email=:email';
        $statementmedecin = $db->prepare($requestmedecin);
        $statementmedecin->bindParam(':email',$_POST['medecin']);
        $statementmedecin->execute();
        $resultmedecin = $statementmedecin->fetch(PDO::FETCH_ASSOC);
        if (isset($_POST['medecin'])){
        echo '<hr>';
        echo '<table class="table table-hover"><thead>';
        echo '<tr><th scope="col">Medecin </th><th scope="col"> Lundi </th><th scope="col"> Mardi </th><th scope="col"> Mercredi </th> <th scope="col"> Jeudi </th> <th scope="col"> Vendredi </th></tr>';
        echo '</thead>';  
        echo "<tr>";
        echo "<td> ".$resultmedecin['nom']." ".$resultmedecin['prenom']."</td>";
        echo "</tr>"; 
        }
      }
      }        
?>
    </div>
    <p><a href="authentificationPatient.php"> Se déconnecter</a><p>
</body>
</html>
