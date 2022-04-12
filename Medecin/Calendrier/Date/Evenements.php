<?php 
include 'dabatase.php';
class Evenement {
  public function getEvenementsEntre($debut, $fin) : array{
    db = dbConnect();
    $statement = $db->quety("SELECT * FROM rdv where debut BETWEEN '{$debut->format(format:'Y--m-d 00:00:00')} AND '{$fin->format(format:'Y-m-d 23:59:59')}");
    $results = $statement->fectAll();
    return $results
    }
  public function getEvenementsEntreParJour($debut, $fin) : array {
    $evenement = $this->getEvenementEntre($debut, $fin);
    $days = [];
    foreach($evenement as $event) {
      $date = explode(delimiter' ', $event['debut'])[0];
      if(!isset($days[
  }
?>
