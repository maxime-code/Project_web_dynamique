<?php
include ("database.php");

ini_set('display_errors',1);
error_reporting(E_ALL);
dbConnect();
$db = dbConnect();
session_start();
if(empty($_SESSION['initialise']))
{
  $_SESSION['nombre'] = 0;
  $_SESSION['plus'] = 0;
  $_SESSION['moins'] = 0;
  $_SESSION['initialise'] = 10;
}

$requestmedecin = 'SELECT * FROM medecin where email=:email'; 
$statementmedecin = $db->prepare($requestmedecin);
$statementmedecin->bindParam(':email',$_SESSION['medecin']);
$statementmedecin->execute();
$resultmedecin = $statementmedecin->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
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
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/heroes/">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">
  <title> Page Prise RDV </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<div class="b-example-divider"></div>
  <br>
  <br>
  <h2 style="text-align:center"> Prise de rendez-vous avec le médecin <?php echo $resultmedecin['prenom']." ".$resultmedecin['nom']; ?> </h2>

  <!-- --------------- -->
  <!-- <div class="container">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="" method="post">
   
      <div class="row">
          <div class="col-sm">
      <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"> Début du Rendez Vous </span>
      </div>
      <input type="text" class="form-control" placeholder="
      " aria-label="Username" aria-describedby="basic-addon1" disabled>
      </div>
      </div>
      <div class="col-sm">
      <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"> Fin du Rendez Vous </span>
      </div>
      <input type="text" class="form-control" placeholder="
      " aria-label="Username" aria-describedby="basic-addon1" disabled>
    </div>
    </div>
    </form> -->
      <?php 
      if(!empty($_POST['heure']))
      {

            $_SESSION['nombre'] = 0;
            $requestrdv = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
            $statementrdv = $db->prepare($requestrdv);
            $statementrdv->bindParam(":heure",$_POST['heure']);
            $statementrdv->bindParam(":medecinemail",$_SESSION['email']);
            $statementrdv->execute();
            $resultrdv = $statementrdv->fetch(PDO::FETCH_ASSOC);
            
            $requestpatient = 'SELECT * FROM patient WHERE email=:patientemail';
            $statementpatient = $db->prepare($requestpatient);
            $statementpatient->bindParam(':patientemail',$resultrdv['patientemail']);
            $statementpatient->execute();
            $resultpatient = $statementpatient->fetch(PDO::FETCH_ASSOC);

            // echo "<br> Vous avez rendez vous avec ".$resultpatient['nom']." ".$resultpatient['prenom'];
            // echo "<br> Informations du rendez vous : <br>".$resultrdv['informations'];
            // echo "<br> Informations du patient : <br> ";
            // echo $resultpatient['email'];
            // echo "<br>";
            // echo $resultpatient['telephone'];
            // echo "<br>";
           echo' <h6 style="text-align:center"> Votre rendez vous avec : </h6>';
           echo' <table class="table">';
          echo ' <thead class="">';
          echo'  <tr>';
          echo' <th scope="col"> Nom </th>';
          echo'  <th scope="col"> Prénom </th>';
          echo'  <th scope="col"> Téléphone </th>';
          echo' <th scope="col"> Email </th>';
          echo'  <th scope="col"> Informations </th>';

            echo'  </thead>';
            echo'  <tbody>';
            echo'  <tr>';
            echo'  <td> '.$resultpatient['nom'].' </td>';
            echo' <td> '.$resultpatient['prenom'].' </td>';
            echo'  <td> '.$resultpatient['telephone'].' </td>';
            echo'  <td> '.$resultpatient['email'].' </td>';
            echo'  <td> '.$resultrdv['informations'].' </td>';

            echo'  </tr>';
            echo'  <br>';
            echo'  </tbody>';
            echo'  </table>';

      }

      ?>


    </div>
  </div> 
    </div>

  <!-- -------------- -->


  <?php 


  ?> </p>
  <?php

    // echo "Valeur de + = ".$_SESSION['plus'];
    // echo "<br> Valeur de - = ".$_SESSION['moins'];
    if(isset($_POST['plus']))
    {
      $_SESSION['plus'] = $_SESSION['plus'] + 1;
      $_SESSION['nombre'] = 0;
    }
    if(isset($_POST['moins']))
    {
      $_SESSION['moins'] = $_SESSION['moins'] + 1;
      $_SESSION['nombre'] = 0; 
    }

    echo '<div style="margin-left: 5%; margin-right: 5%">';
    echo '<table class="table table-bordered"> <thead>';

    echo '<tr>';
    for($i=0; $i<=4; $i++)
    { 
      echo "<th score='col' style='text-align: center'> ".ajouterDay($i,$_SESSION['plus'],$_SESSION['moins'])." </th> ";
    }

    echo '</tr>';
    echo '</thead>';  
    echo '<tbody>';
    echo "<tr>";

    echo '<form action="" method="post">';
    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 09:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
            echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
        }
    }

    echo "</tr>";
    echo "<tr>"; // 2

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 10:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
            echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
        }
    }

    echo "</tr>";
    echo "<tr>"; // 3

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 11:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
            echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
        }
    
    }
    echo "</tr>";
    echo "<tr>"; // 4
    echo "<td style='text-align: center'> ------ </td> <td style='text-align: center'> ------ </td><td style='text-align: center'> ------ </td><td style='text-align: center'> ------ </td><td style='text-align: center'> ------ </td>";
    echo "</tr>";
    echo "<tr>"; // 5

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 14:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
            echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
        }
    }

    echo "</tr>";
    echo "<tr>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 15:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
            echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
        }
    }

    echo "</tr>";
    echo "<tr>";


    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 16:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
            echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
        }
    }

    echo "</tr>";
    echo "<tr>";
    echo "</tbody>";
    echo "</table> ";
    echo "</form>";
    echo '</div>';
    echo '<form action="" method="post">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-sm" style="text-align:right">';
    echo '<button type="submit" class="btn btn-primary" name="moins"> < Semaine précedente   </button>';
    echo '</div>';
    echo '<div class="col-sm" style="text-align:left" >';
    echo '<button type="submit" class="btn btn-primary" name="plus"> Semaine suivante > </button> ';
    echo '</div>';
    echo '<br>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo "<h2 style='text-align:center'> Vous avez ".$_SESSION['nombre']." rendez vous cette semaine</h2>";

  ?>

<hr class="my-4">

<button class="btn btn-lg btn-outline-secondary" style="width:20%; margin-left: 40%; margin-right:40%" onclick="window.location.href = 'accueil.php';"> Retour à l'accueil </button>
<br>
<br>
<div class="b-example-divider"></div>
</body>
</html>

    
