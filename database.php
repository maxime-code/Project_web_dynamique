<?php

// On récupère les informations d'authentification

include 'constants.php';

// Connexion à la base de données SQL

function dbConnect()
{
    $dsn = 'pgsql:dbname='.DB_NAME.';host='.DB_SERVER.';port='.DB_PORT;
    $user = DB_USER;
    $password = DB_PASSDWORD;

    // On vérifie la connexion
    
    try 
    {
        return new PDO($dsn, $user, $password);
    } catch (PDOException $e) 
    {
        echo 'Connexion échouée : ' . $e->getMessage();
        return false;
    }
}

function verifrdvpatient($db,$timestamp,$medecin,$heure)
{
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$medecin);
    $statement->execute();
    $row = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($row == 0)
    {
        echo "<td style='text-align: center'> <button type='submit' class='btn btn-secondary' name='heure' value='".$timestamp."'> ".$heure." </button> </td>";
    }
    else{
      echo "<td style='text-align: center'> <button class='btn btn-danger' disabled> --------- </button> </td> ";
    }
}

function verifrdvmedecin($db,$timestamp,$medecin)
{
    $request = 'SELECT * FROM rdv WHERE heure=:heure AND medecinemail=:medecinemail';
    $statement = $db->prepare($request);
    $statement->bindParam(":heure",$timestamp);
    $statement->bindParam(":medecinemail",$medecin);
    $statement->execute();
    $row = $statement->rowCount();
    return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
}

function ajouterDay($i,$plus,$moins)
{
    setlocale(LC_TIME, "fr_FR");
    $Jour = strftime("%A - %d/%m/%Y", strtotime("this week +".$i." day -".$moins." week +".$plus." week"));
    return $Jour;
}

function getActualTimeStamp()
{
    setlocale(LC_TIME, "fr_FR");
    $heure = strftime("%Y-%m-%d H:i:s", strtotime("this week"));
    $heure = $heure."-00";
    return $heure;
}

function getTimeStamp($plus,$plusweek,$moinsweek)
{
    setlocale(LC_TIME, "fr_FR");
    $heure = strftime("%Y-%m-%d", strtotime("this week -".$moinsweek." week +".$plusweek." week +".$plus." day"));
    return $heure;
}

function addHour($TimeStamp)
{
    setlocale(LC_TIME, "fr_FR");
    $heure =    date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($TimeStamp)));
    return $heure;
}


?>
