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

?>
