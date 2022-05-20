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

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title> Inscription Patient </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/heroes/">
    
<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

  <title> Page patient </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="b-example-divider"></div>
<?php
  $requestpatient = 'SELECT * FROM patient WHERE email=:email';
  $statementpatient = $db->prepare($requestpatient);
  $statementpatient->bindParam(':email', $_SESSION['email']);
  $statementpatient->execute();
  $resultpatient = $statementpatient->fetch(PDO::FETCH_ASSOC);

  $requestrdv = 'SELECT * FROM rdv WHERE patientemail=:email';
  $statementrdv = $db->prepare($requestrdv);
  $statementrdv->bindParam(':email', $_SESSION['email']);
  $statementrdv->execute();
  $resultrdv = $statementrdv->fetchAll(PDO::FETCH_ASSOC);

  // $maintenant = getActualTimeStamp();
  // $requestrdvprochain = 'SELECT * FROM rdv WHERE patientemail=:email AND heure > :heure';
  // $statementrdvprochain = $db->prepare($requestrdvprochain);
  // $statementrdvprochain->bindParam(':email', $_SESSION['email']);
  // $statementrdvprochain->bindParam(':heure', $maintenant);
  // $statementrdvprochain->execute();
  // $resultrdvprochain = $statementrdvprochain->fetchAll(PDO::FETCH_ASSOC);

  // $requestrdvancien = 'SELECT * FROM rdv WHERE patientemail=:email AND heure < :heure';
  // $statementrdvancien = $db->prepare($requestrdvancien);
  // $statementrdvancien->bindParam(':email', $_SESSION['email']);
  // $statementrdvancien->bindParam(':heure', $maintenant);
  // $statementrdvancien->execute();
  // $resultrdvancien = $statementrdvancien->fetchAll(PDO::FETCH_ASSOC);
?>
    <br>
    <h1 class="text-center"> Bienvenue sur votre espace personnel Monsieur <?php echo $resultpatient['prenom'].'  '.$resultpatient['nom']; ?> </h1>
    <br>
    <h2 class="text-center"> Vos prochains rendez vous </h2>

    <?php 


echo '<table class="table">';
echo '<thead class="thead-dark">';
echo '<tr>';
echo '<th scope="col"> Date </th>';
echo '<th scope="col"> Medecin </th>';
echo '<th scope="col"> Spécialité </th>';
echo '<th scope="col"> Informations </th>';
echo '<th scope="col"> Nouveau RDV </th>';
echo '</thead>';
echo '<tbody>';
echo '<tr>';

// foreach($resultrdvprochain as $tableau)
// {
//   $statement = 'SELECT * FROM medecin where email=:email';
//   $statement = $db->prepare($statement);
//   $statement->bindParam(':email',$tableau['medecinemail']);
//   $statement->execute();
//   $result = $statement->fetch(PDO::FETCH_ASSOC);

  
//   echo '<td> Le '.$tableau['heure'].'</td>';
//   echo '<td> Monsieur '.$result['nom'].' '.$result['prenom'].'</td>';
//   echo '<td> '.$result['specialite'].' </td>';
//   echo '<td> '.$tableau['informations'].'</td>';
//   echo "<td> <form action='priseRDV.php' method='post'>";
//   echo "<button type='submit' name='medecin' value=".$result['email']." class='btn btn-lg btn-secondary' class='btn btn-primary'> Nouveau Rendez vous </button>";
//   echo "</form>";
//   echo "</td>";
//   echo '</tr>';
// echo '<br>';
// } 
echo '</tbody>';
echo '</table>';

?>
    <br>
    <h2 class="text-center"> Vos anciens rendez vous </h2>

<?php 


    echo '<table class="table">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th scope="col"> Date </th>';
    echo '<th scope="col"> Medecin </th>';
    echo '<th scope="col"> Spécialité </th>';
    echo '<th scope="col"> Informations </th>';
    echo '<th scope="col"> Reprendre RDV </th>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
  
    foreach($resultrdv as $tableau)
    {

      $statement = 'SELECT * FROM medecin where email=:email';
      $statement = $db->prepare($statement);
      $statement->bindParam(':email',$tableau['medecinemail']);
      $statement->execute();
      $result = $statement->fetch(PDO::FETCH_ASSOC);

      
      echo '<td> Le '.$tableau['heure'].'</td>';
      echo '<td> Monsieur '.$result['nom'].' '.$result['prenom'].'</td>';
      echo '<td> '.$result['specialite'].' </td>';
      echo '<td> '.$tableau['informations'].'</td>';
      echo "<td> <form action='priseRDV.php' method='post'>";
      echo "<button type='submit' name='medecin' value=".$result['email']." class='btn btn-lg btn-secondary' class='btn btn-primary'> Nouveau Rendez vous </button>";
      echo "</form>";
      echo "</td>";
      echo '</tr>';
      echo '<br>';
  } 
  echo '</tbody>';
  echo '</table>';

?>

    <div class="container">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="" method="post">

        <h2 class="text-center"> Prendre un nouveau rendez vous </h2>
        <br>
          <div class="row">
          <div class="col-sm">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="nom">
            <label for="floatingInput"> Nom</label>
          </div>
            </div>
          <div class="col-sm">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="prenom">
            <label for="floatingInput"> Prénom </label>
          </div>
        </div>
        </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="specialite">
            <label for="floatingInput"> Spécialité </label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="codepostal">
            <label for="floatingInput"> Code postal </label>
          </div>
          
          <br>
          <input class="btn btn-lg btn-primary" style='width:20%; margin-left: 40%; margin-right:40%' name="submit" type="submit" value="Rechercher">
            </form>
    </div>
  </div> 

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
        $request = 'SELECT * FROM medecin WHERE specialite=:specialite';
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

      if(!empty($_POST['nom']) && !empty($_POST['prenom']) && empty($_POST['specialite']) && !empty($_POST['codepostal']))
      {
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

      echo "<p class='text-center'> Il y a ".$row." médecins qui correspond à votre recherche </p>";
      echo "<form action='priseRDV.php' method='post'>";
      echo "<select name='medecin' class='form-select' style='width:40%; margin-left: 30%; margin-right:30%' aria-label='.form-select-lg example'>";
      foreach($result as $resultat){
        echo "<option value='".$resultat['email']."'> Docteur ".$resultat['nom']." ".$resultat['prenom']." situé en ".$resultat['codepostal'].", spécialiste en ".$resultat['specialite']."</option>";
      }
      echo "</select> <br> <input type='submit' name='valider' class='btn btn-lg btn-primary' style='width:20%; margin-left: 40%; margin-right:40%' value='Voir les horaires' class='btn btn-primary'> </form>";
    }
  }
?>
<hr class="my-4">
<button class="btn btn-lg btn-outline-secondary" style="width:20%; margin-left: 40%; margin-right:40%" onclick="window.location.href = 'accueil.php';"> Retour à l'accueil </button>
<br>    
<br>
<div class="b-example-divider"></div>
</body>
</html>
