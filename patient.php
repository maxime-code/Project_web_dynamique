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
          <input type="submit" name="submit" value="Rechercher" class="btn btn-primary" />
        </form>
    <div>
<?php
  if(isset($_POST['medecin'])){
    
    $requestmedecin = 'SELECT * FROM medecin where email=:email'; 
    $statementmedecin = $db->prepare($requestmedecin);
    $statementmedecin->bindParam(':email',$_POST['medecin']);
    $statementmedecin->execute();
    $resultmedecin = $statementmedecin->fetch(PDO::FETCH_ASSOC);
    
    echo '<form action="priseRDV.php" method="post">';
    echo '<input type="hidden" name="emailmedecin" value="'.$resultmedecin['email'].'">';
    echo '<hr>';
    echo '<table class="table"><thead>';
    echo '<tr><th scope="col"> Medecin </th>';

    for($i=0; $i<=4; $i++)
    { 
      echo "<th score='col'> ".ajouterDay($i)." </td> ";
    }

    echo '</tr>';
    echo '</thead>';  
    echo "<tr>"; // 1
    echo "<td> ".$resultmedecin['nom']." ".$resultmedecin['prenom']."</td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i);
    $timestamp = $timestamp . " 09:00:00-00";
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 9h - 10h </button> </td>";
    }

    echo "</tr>";
    echo "<tr>"; // 2
    echo "<td> Contacts : </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i);
    $timestamp = $timestamp . " 10:00:00-00";
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 10h - 11h </button> </td>";
    }

    echo "</tr>";
    echo "<tr>"; // 3
    echo "<td> tel : ".$resultmedecin['telephone']."</td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i);
    $timestamp = $timestamp . " 11:00:00-00";
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 11h - 12h </button> </td>";
    }
    echo "</tr>";
    echo "<tr>"; // 4
    echo "<td> mail : ".$resultmedecin['email']. "</td><td> ------ </td> <td> ------ </td><td> ------ </td><td> ------ </td><td> ------ </td>";
    echo "</tr>";
    echo "<tr>"; // 5
    echo "<td> code postal : ".$resultmedecin['codepostal']."</td> ";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i);
    $timestamp = $timestamp . " 14:00:00-00";
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 14h - 15h </button> </td>";
    }

    echo "</tr>";
    echo "<tr>";
    echo "<td> spécialité : ".$resultmedecin['specialite']." </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i);
    $timestamp = $timestamp . " 15:00:00-00";
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 15h - 16h </button> </td>";
    }

    echo "</tr>";
    echo "<tr>";
    echo "<td> <button type ='submit' class=' btn btn-primary'> En Savoir Plus </button>  </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i);
    $timestamp = $timestamp . " 16:00:00-00";
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 16h - 17h </button> </td>";
    }

    echo "</tr>";
    echo "<tr>";
    echo "</table> ";
  }
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
      echo "Il y a ".$row." médecins qui correspond à votre recherche";
      echo "<form action='' method='post'> <select name='medecin' class='form-select'>";
      foreach($result as $resultat){
        echo "<option value='".$resultat['email']."'> Docteur ".$resultat['nom']." ".$resultat['prenom']." situé en ".$resultat['codepostal'].", spécialiste en ".$resultat['specialite']."</option>";
      }
      echo "</select> <input type='submit' value='Selectionner' class='btn btn-primary'> </form>";

    }
  }
?>
    </div>
    <p><a href="authentificationPatient.php"> Se déconnecter</a><p>
</body>
</html>
