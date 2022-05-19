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
    $fin = addHour($tableau['heure']);
    echo '<tr>';
    echo '<td> Rendez vous avec '.$tableau['medecinemail'].'</td>';
    echo '<td> le '.$tableau['heure'].' - '.$fin.'</td>';
    echo '<td> Info: '.$tableau['informations'].'</td>';
    echo '</tr>';
    echo '<br>';
  }
?>
    </div>
    <h2> Prendre un nouveau rendez vous </h2>
      <form action="" method="post">
          <input type="text" class="form-control" name="nom" placeholder="Nom du médecin" />
          <input type="text" class="form-control" name="prenom" placeholder="Prénom du médecin" />
          <input type="text" class="form-control" name="specialite" placeholder="Spécialité" />
          <input type="text" class="form-control" name="codepostal" placeholder="Code Postal" />
          <input type="submit" name="submit" value="Rechercher" class="btn btn-primary" />
        </form>
    <div>
<?php

  if (isset($_POST['submit']) && !empty($_POST['submit'])){
    if(empty($_POST['nom']) && empty($_POST["prenom"]) && empty($_POST['specialite']) && empty($_POST['codepostal'])){
      echo "Veuillez au moins remplir un de ces critères";
    }
    else {
      if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom AND specialite=:specialite AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && !empty($_POST['prenom']) && empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':prenom', $_POST['prenom']); 
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['specialite']) && empty($_POST['codepostal']))
      {
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom AND specialite=:specialite';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE prenom=:prenom AND specialite=:specialite AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && !empty($_POST['prenom']) && empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE prenom=:prenom';
        $statement = $db->prepare($request);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && empty($_POST['prenom']) && !empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE prenom=:prenom';
        $statement = $db->prepare($request);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && empty($_POST['prenom']) && !empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE specialite=:specialite AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND specialite=:specialite AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE prenom=:prenom AND specialite=:specialite';
        $statement = $db->prepare($request);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && empty($_POST['prenom']) && !empty($_POST['specialite']) && empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND specialite=:specialite';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(empty($_POST['nom']) && !empty($_POST['prenom']) && empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE prenom=:prenom AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && empty($_POST['prenom']) && !empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND specialite=:specialite AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':specialite', $_POST['specialite']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      if(!empty($_POST['nom']) && !empty($_POST['prenom']) && empty($_POST['specialite']) && !empty($_POST['codepostal'])){
        $request = 'SELECT * FROM medecin WHERE nom=:nom AND prenom=:prenom AND codepostal=:codepostal';
        $statement = $db->prepare($request);
        $statement->bindParam(':nom', $_POST['nom']);
        $statement->bindParam(':prenom', $_POST['prenom']);
        $statement->bindParam(':codepostal', $_POST['codepostal']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      }
      $row = $statement->rowCount();

      $requestmedecin = 'SELECT * FROM medecin where email=:email'; 
      $statementmedecin = $db->prepare($requestmedecin);
      $statementmedecin->bindParam(':email',$_POST['medecin']);
      $statementmedecin->execute();
      $resultmedecin = $statementmedecin->fetch(PDO::FETCH_ASSOC);

      echo "Il y a ".$row." médecins qui correspond à votre recherche";
      echo "<form action='priseRDV.php' method='post'>";
      echo "<select name='medecin' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'>";
      foreach($result as $resultat){
        echo "<option value='".$resultat['email']."'> Docteur ".$resultat['nom']." ".$resultat['prenom']." situé en ".$resultat['codepostal'].", spécialiste en ".$resultat['specialite']."</option>";
      }

      echo "</select> <input type='submit' name='valider' value='Selectionner' class='btn btn-primary'> </form>";

    }
  }
?>
    </div>
    <p><a href="accueil.php"> Se déconnecter</a><p>
</body>
</html>
