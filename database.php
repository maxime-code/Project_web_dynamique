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

function verifrdv($medecin, $date, $text, $db)
{
    $request = 'SELECT * FROM rdv WHERE medecinemail=:medecin AND debut=:debut';
    $statement = $db->prepare($request);
    $statement->bindParam(':medecin',$medecin);
    $statement->bindParam(':debut',$date);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($statement->rowCount()==1){
        return "-----";
    } else {
        return "<button type='submit' class='btn btn-secondary' name='heure' value='".$date."'>".$text." </button>";
    }
}

function ajouterDay($i,$plus,$moins)
{
    setlocale(LC_TIME, "fr_FR");
    $Jour = strftime("%A - %d/%m/%Y", strtotime("this week +".$i." day -".$moins." week +".$plus." week"));
    return $Jour;
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
