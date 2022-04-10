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
    require '/Date/Mois.php';
    $mois = new Mois(mois: $_GET['mois'] ?? null . $_GET['an'] ?? null);
  ?>
  
  <h1> <?php echo $mois->StringMois(); ?> </h1>
  <?php echo $mois->getSemaine(); ?>
  <table class="w-100 p-3" >
    <?php for ($i =0; $i < $mois->getSemaine(); $i++); ?>
    <tr>
      <td> Lundi </td>
      <td> Mardi </td>
      <td> Mercredi </td>
      <td> Jeudi </td>
      <td> Vendredi </td>
      <td> Samedi </td>
      <td> Dimanche </td>
    </tr>
  </table>
    
<body>
</html>
