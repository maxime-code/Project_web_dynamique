<?php 
class Evenement {
  private $db;
  public function __construct($db){
    $this->db = $db
  }
  public function getEvenementsEntre($debut, $fin) : array{
    $statement = $this->db->query("SELECT * FROM rdv where debut BETWEEN '{$debut->format(format:'Y--m-d 00:00:00')} AND '{$fin->format(format:'Y-m-d 23:59:59')}");
    $results = $statement->fectAll();
    return $results
    }
  public function getEvenementsEntreParJour($debut, $fin) : array {
    $evenement = $this->getEvenementEntre($debut, $fin);
    $days = [];
    foreach($evenement as $event) {
      $date = explode(delimiter' ', $event['debut'])[0];
      if(!isset($days[$date])){
        $days[$date] = [$evenement];
      } else {
        $days[$date][] = $evenement;
      }
    }
    return $days;
  }
  
  public function find (int $id) : array {
    return $this->db->query("SELECT * FROM rdv WHERE id = $id LIMIT 1")->fetch();
  }
?>
