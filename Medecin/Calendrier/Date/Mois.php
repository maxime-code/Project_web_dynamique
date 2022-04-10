<?php

class Mois
{
  
  private $month = ['Janvier', 'Février', 'Mars', 'Avril', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
  private $mois;
  private $an;
    public function __construct(?int $mois=null,?int $an=null)
    {
    // On peut rajouter des tests d'erreur mais flemme, j'en fais pas
    if($mois === null){
      $mois = intval(date(format:'m');
    }
                     
                     
    if($an === null){
      $an = intval(date(format:'Y');
    }     
    $mois = $mois/12;
    $this->mois = $mois;
    $this->an = $an;
  }
                   // Renvoie le premier jour ud mois
  public function getPremierJour() : DateTime{
    return  new DateTime(time:"{this->an}-{this->mois}-01");
  }
    
  public function StringMois (): string{
   $this->month[$this->mois - 1].' '.$this->an;
  }
                 
  public function getSemaine () : int{
    
    $debut = getPremierJour();
    $fin = (clone $start)->modify(modify: '-1 month -1 day');
    $week intval($fin->format(format: 'W')) - intval($debut->format(format: 'W'))+1;
    if($week < 0)
    {
      $week = intval($fin->format(format: 'W'));
    }
    return $week;
  }
}                   
 
                  
  
                   
    
                  
 
      

