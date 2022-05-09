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

function ThisMonday()
{
    setlocale(LC_TIME, "fr_FR");
    $CeLundi = strftime("%A - %d/%m/%Y", strtotime("this week"));
    return $CeLundi;
}

function ajouterDay($plus)
{
    setlocale(LC_TIME, "fr_FR");
    $Jour = strftime("%A - %d/%m/%Y", strtotime("this week +".$plus." day"));
    return $Jour;
}

function sosutractionDay($moins)
{
    setlocale(LC_TIME, "fr_FR");
    $Jour = strftime("%A - %d/%m/%Y", strtotime("this week -".$moins." day"));
    return $Jour;
}

function LastMonday($moins)
{
    setlocale(LC_TIME, "fr_FR");
    $DernierJour = strftime("%A - %d/%m/%Y", strtotime("this week -".$moins." week"));
    return $DernierJour;
}

function NextMonday($plus)
{
    setlocale(LC_TIME, "fr_FR");
    $ProchainLundi = strftime("%A - %d/%m/%Y", strtotime("this week +".$plus." week"));
    return $ProchainLundi;
}

function getTimeStamp($plus)
{
    setlocale(LC_TIME, "fr_FR");
    $heure = strftime("%Y-%m-%d", strtotime("this week +".$plus." day"));
    return $heure;
}
?>
