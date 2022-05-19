<?php
include ("database.php");

ini_set('display_errors',1);
error_reporting(E_ALL);
dbConnect();
$db = dbConnect();
session_start();
$requestmedecin = 'SELECT * FROM medecin where email=:email'; 
$statementmedecin = $db->prepare($requestmedecin);
$statementmedecin->bindParam(':email',$_SESSION['email']);
$statementmedecin->execute();
$resultmedecin = $statementmedecin->fetch(PDO::FETCH_ASSOC);
if(empty($_SESSION['plus']))
{
    $_SESSION['plus'] = 0;
}

if(empty($_SESSION['moins']))
{
    $_SESSION['moins'] = 0;
}

if(empty($_SESSION['nombre']))
{
    $_SESSION['nombre']=0;
}

?>
<!DOCTYPE html>
<html>
<head>
  <title> Page medecin </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
        echo $_SESSION['email'];
        
        
        if(empty($_POST['heure'])){
        echo "<br> Valeur de + = ".$_SESSION['plus'];
        echo "<br> Valeur de - = ".$_SESSION['moins'];    
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

        echo '<form action="" method="post">';
        echo '<hr>';
        echo '<table class="table"><thead>';
        echo '<tr><th scope="col"><button type="submit" class="btn btn-secondary" name="moins"> < </button><button type="submit" class="btn btn-secondary" name="plus"> > </button> </th>';
        echo '</form>';
        echo '<form action="" method="post">';
        for($i=0; $i<=4; $i++)
        { 
        echo "<th score='col'> ".ajouterDay($i,$_SESSION['plus'],$_SESSION['moins'])." </td> ";
        }

        echo '</tr>';
        echo '</thead>';  
        echo "<tr>"; // 1
        echo "<td> 9h - 10h </td>";

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
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($row == 1)
        {
        echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
        echo "<td> ------ </td> ";
        }
        }

        echo "</tr>";
        echo "<tr>"; // 2
        echo "<td> 10h - 11h </td>";

        for($i=0; $i<=4 ; $i++)
        {
        $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
        $timestamp = $timestamp . " 10:00:00-00";
        $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
        echo "<td> ------ </td> ";
        }
        }

        echo "</tr>";
        echo "<tr>"; // 3
        echo "<td> 11h - 12h </td>";

        for($i=0; $i<=4 ; $i++)
        {
        $timestamp = getTimeStamp($i,$_SESSION['plus'],$_SESSION['moins']);
        $timestamp = $timestamp . " 11:00:00-00";
        $request = 'SELECT * FROM RDV WHERE heure=:heure AND medecinemail=:medecinemail';
        $statement = $db->prepare($request);
        $statement->bindParam(":heure",$timestamp);
        $statement->bindParam(":medecinemail",$_SESSION['email']);
        $statement->execute();
        $row = $statement->rowCount();
        if($row == 1)
        {
        echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
        echo "<td> ------ </td> ";
        }
        }
        echo "</tr>";
        echo "<tr>"; // 4
        echo "<td> PAUSE </td><td> ------ </td> <td> ------ </td><td> ------ </td><td> ------ </td><td> ------ </td>";
        echo "</tr>";
        echo "<tr>"; // 5
        echo "<td>  14h - 15h </td> ";

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
        echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
        echo "<td> ------ </td> ";
        }
        }

        echo "</tr>";
        echo "<tr>";
        echo "<td> 15h - 16h </td>";

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
        echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
        echo "<td> ------ </td> ";
        }
        }

        echo "</tr>";
        echo "<tr>";
        echo "<td> 16h - 17h  </td>";

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
        echo "<td> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> RDV </button> </td>";
        $_SESSION['nombre'] = $_SESSION['nombre'] +1;
        }
        else{
        echo "<td> ------ </td> ";
        }
        }

        echo "</tr>";
        echo "<tr>";
        echo "</table> ";
        echo "</form>";
        echo "Vous avez ".$_SESSION['nombre']." rendez vous cette semaine";
    }
    else {
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

            echo "<br> Vous avez rendez vous avec ".$resultpatient['nom']." ".$resultpatient['prenom'];
            echo "<br> Informations du rendez vous : <br>".$resultrdv['informations'];
            echo "<br> Informations du patient : <br> ";
            echo $resultpatient['email'];
            echo "<br>";
            echo $resultpatient['telephone'];
            echo "<br>";
        }
        
?>
<p><a href="accueil.php"> Se déconnecter</a><p>
</body>
</html>

