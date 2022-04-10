<?php

class Mois
{
  
  public $month = ['Janvier', 'Février', 'Mars', 'Avril', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
  public $mois;
  public $an;
    public function __construct(?int $mois=null,?int $an=null)
    {
    // On peut rajouter des tests d'erreur mais flemme, j'en fais pas
    if($mois === null[[ $mois < 1 || $mois > 12){
      $mois = intval(date(format:'m');
    }
                     
                     
    if($an === null){
      $an = intval(date(format:'Y');
    }     
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
                   
  public function ProchainMois(): Mois{
    $mois = $this->mois +1;
    $an = $this->an;
    if($mois >12){
      $mois = 1;
      $an +=1;
    }
    return new Mois($mois, $an);
    
    public function DernierMois(): Mois{
    $mois = $this->mois -1;
    $an = $this->an;
    if($mois < 12){
      $mois = 12;
      $an -=1;
    }
    return new Mois($mois, $an);
}                  

                  
  
                   
    
                  
 
      

