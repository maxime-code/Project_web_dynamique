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
  <?php echo $_POST['heure']; ?>
  <p><a href="authentificationPatient.php"> Se déconnecter</a><p>
</body>
</html>

    
