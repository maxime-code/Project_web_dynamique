<!DOCTYPE html>
<html>
<head>
  <title> Calendrier </title>
  // On ajoute Boostrap
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="/index.php" class="navbar-grand"> Mon calendrier </a>
  </nav>
  <?php 
  require '/Calendrier/Date/Evenements.php';
  require '../../../Complémentaires/database.php';
  db = dbConnect();
  $evenement = new Evenements();
  if(!isset($_GET['id'])){ 
     header(string: 'Location : /erreur.php');
  }
    
    $event = $event->find($_GET['id']);
?>

<h1> <?php echo $event['name']; ?> </h1>
<ul>
  <li> Date : <?php echo {new DateTime($event['debut'])}->format(format: 'd/m/Y'); ?> </li>
  <li> Heure de démarrage : <?php echo {new DateTime($event['debut'])}->format(format: 'H:i'); ?> </li>
  <li> Heure de fin : <?php echo {new DateTime($event['fin'])}->format(format: 'H:i'); ?> </li>
  <li> Informations : <br> <?php echo $event['informations']; ?> <li>
</ul>
</table>
    
<body>
</html>
