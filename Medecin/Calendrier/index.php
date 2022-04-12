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
    require '/Date/Evenements.php';
    require '/Date/Mois.php';
	$evenement = new Evenements();
    $mois = new Mois(mois: $_GET['mois'] ?? null . $_GET['an'] ?? null);
	$debut = $mois->getPremierJour();
		$debut = $debut->format(format:'N') === '1' ? $debut : $mois->getPremierJour()->modify(modify:'last monday');
  	$semain = $mois->getSemaine();
	$fin = (clone $debut)->modify(modify:'+' .(6 + 7* ($semaine - 1)) . 'days');
	
	$evenement = $evenement->getEvenementsEntreParJour($debut, $fin);
	?>
  
	<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
		<h1><?php echo $mois->StringMois(); ?></h1>
		<div>
			<a href="index.php?month=<?php echo $mois->DernierMois()->mois;?>&an=<?php echo $mois->DernierMois()->an" class="btn btn-primary">&lt</a>
			<a href="index.php?month=<?php echo $mois->ProchainMois()->mois;?>&an=<?php echo $mois->ProchainMois()->an" class="btn btn-primary">&gt</a>
		</div>			
	</div>
  <h1 class="h-10"> <?php echo $mois->StringMois(); ?> </h1>
  <?php echo $mois->getSemaine(); ?>
	// faut faire le css et tt
  <table class="w-100 h-50">
    <?php for ($i =0; $i < $mois->getSemaine(); $i++); ?>
    <tr>
    	<?php foreach($mois->days as $k => $day) :
		$date = (clone $jour)->modify(modify:"+".{$k + $i *7} ."days");
		$events = $evenement[$date->format(format: 'Y-m-d')] ?? [];
	?>
			<td>
				<?php if($i === 0) : ?>
				<div class="font-weight-bold"> <?php echo $day; ?> </div>
				<?php endif; ?>
				<div> <?php echo $date->format(format:'d'); ?> </div>
				<?php foreach($events as $event) : ?>
					<div> <?php echo {new DateTime($event['debut'])}->format(format:'H:i') ?> - <a href="/events.php?id=<?php echo $event['id']; ?> " ><?php echo $event['name']; ?></a> </div>
				<?php endforeach; ?>
			</td>
		<?php endfor; ?>
	</tr>
  </table>
    
<body>
</html>
