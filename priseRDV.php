<?php
include ("database.php");

ini_set('display_errors',1);
error_reporting(E_ALL);
dbConnect();
$db = dbConnect();
session_start();
if(isset($_POST['medecin']))
{
  $_SESSION['medecin'] = $_POST['medecin'];
  $_SESSION['plus'] = 0;
  $_SESSION['moins'] = 0;
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
  <title> Page patient </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <br>
  <?php echo "Bonjour ".$_SESSION['email']; ?>
  <br>
  <?php echo $resultmedecin['email']; ?>
  <h2> Prise de rendez-vous avec le médecin <?php echo $resultmedecin['nom']." ".$resultmedecin['prenom']; ?> </h2>
  <p> Début du Rendez Vous :
   <?php 

    if(isset($_POST['heure']) && !empty($_POST['heure']))
      { 
        $_SESSION['heure'] = $_POST['heure'];
        echo $_SESSION['heure']; 
      } else
      { 
        echo "Aucun horaire choisi"; 
      }
    ?> 
  <br> Fin du Rendez Vous : 
  <?php 
    if(isset($_POST['heure']) && !empty($_POST['heure']))
    { 
      $fin = addHour($_POST['heure']); 
      $fin = $fin."-00";
      echo $fin; 
    } else
    { 
      echo "Aucun horaire choisi"; 
    }

    if(isset($_POST['submit']) && !empty($_POST['submit']))
    {
      $requestrdv = 'INSERT INTO rdv (heure, medecinemail, patientemail, informations) VALUES
      (:debut,:medecinemail, :patientemail, :informations)';
      $statementrdv = $db->prepare($requestrdv);
      $statementrdv->bindParam(":medecinemail",$_SESSION['medecin']);
      $statementrdv->bindParam(":patientemail",$_SESSION['email']);
      $statementrdv->bindParam(":informations",$_POST['informations']);
      $statementrdv->bindParam(":debut",$_SESSION['heure']);
      $statementrdv->execute();
      echo "<br>";
      echo $_SESSION['medecin'];
      echo "<br>";
      echo $_SESSION['email'];
      echo "<br>";
      echo $_POST['informations'];
      echo "<br>";
      echo $_SESSION['heure'];
      echo "<br>";
    }

  ?> </p>
  <?php

    if(empty($_POST['heure'])){
    echo "Valeur de + = ".$_SESSION['plus'];
    echo "<br> Valeur de - = ".$_SESSION['moins'];
    if(isset($_POST['plus']))
    {
      $_SESSION['plus'] = $_SESSION['plus'] + 1;
    }
    if(isset($_POST['moins']))
    {
      $_SESSION['moins'] = $_SESSION['moins'] + 1;
    }

    echo '<form action="" method="post">';
    echo '<hr>';
    echo '<table class="table"><thead>';
    echo '<tr><th scope="col"><button type="submit" class="btn btn-secondary" name="plus"> < </button><button type="submit" class="btn btn-secondary" name="moins"> > </button> </th>';
    echo '</form>';
    echo '<form action="" method="post">';
    for($i=0; $i<=4; $i++)
    { 
      echo "<th score='col'> ".ajouterDay($i,$_SESSION['plus'],$_SESSION['moins'])." </td> ";
    }

    echo '</tr>';
    echo '</thead>';  
    echo "<tr>"; // 1
    echo "<td> Medecin : </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 09:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$_SESSION['medecin']);
    $statement->execute();
    $row = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($row == 0)
    {
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 9h - 10h </button> </td>";
    }
    else{
      echo "<td> ------ </td> ";
    }
    }

    echo "</tr>";
    echo "<tr>"; // 2
    echo "<td> ".$resultmedecin['nom']." ".$resultmedecin['prenom']." </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 10:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$_SESSION['medecin']);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $row = $statement->rowCount();
    if($row == 0)
    {
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 10h - 11h </button> </td>";
    }
    else{
      echo "<td> ------ </td> ";
    }
    }

    echo "</tr>";
    echo "<tr>"; // 3
    echo "<td> Contacts : </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 11:00:00-00";
    $request = 'SELECT * FROM RDV WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$_SESSION['medecin']);
    $statement->execute();
    $row = $statement->rowCount();
    if($row == 0)
    {
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 11h - 12h </button> </td>";
    }
    else{
      echo "<td> ------ </td> ";
    }
    }
    echo "</tr>";
    echo "<tr>"; // 4
    echo "<td> mail : ".$resultmedecin['email']. "</td><td> ------ </td> <td> ------ </td><td> ------ </td><td> ------ </td><td> ------ </td>";
    echo "</tr>";
    echo "<tr>"; // 5
    echo "<td>  tel : ".$resultmedecin['telephone']."</td> ";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 14:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$_SESSION['medecin']);
    $statement->execute();
    $row = $statement->rowCount();
    if($row == 0)
    {
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 14h - 15h </button> </td>";
    }
    else{
      echo "<td> ------ </td> ";
    }
    }

    echo "</tr>";
    echo "<tr>";
    echo "<td> code postal : ".$resultmedecin['codepostal']."</td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 15:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$_SESSION['medecin']);
    $statement->execute();
    $row = $statement->rowCount();
    if($row == 0)
    {
    echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 15h - 16h </button> </td>";
    }
    else{
      echo "<td> ------ </td> ";
    }
    }

    echo "</tr>";
    echo "<tr>";
    echo "<td> spécialité : ".$resultmedecin['specialite']."  </td>";

    for($i=0; $i<=4 ; $i++)
    {
    $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
    $timestamp = $timestamp . " 16:00:00-00";
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$_SESSION['medecin']);
    $statement->execute();
    $row = $statement->rowCount();
    if($row == 0)
    {
      echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> 16h - 17h </button> </td>";
    }
    else{
      echo "<td> ------ </td> ";
    }
    }

    echo "</tr>";
    echo "<tr>";
    echo "</table> ";
    echo "</form>";
  }
  else{
    echo "<form action ='' method='post'>";
    echo "<input type='text' class ='form-control' name='informations' placeholder='Informations' require \>";
    echo "<input type='submit' name='submit' class='btn btn-primary' value='Je Prends Rendez Vous'>";
    echo "</form>";
  }
  ?>
  <p><a href="deconnexion.php"> Se déconnecter</a><p>
</body>
</html>

    
