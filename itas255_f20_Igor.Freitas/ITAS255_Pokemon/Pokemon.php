<?php
abstract class Pokemon extends Character
{
  private $weight;
  private $hp;
  private $type;

  public function get_Name()
  {
    return $this->name;
  }

  public function get_Image()
  {
    return $this->image;
  }
  
  public function getWeight()
  {
    return $this->weight;
  }
  
  public function getHp()
  {
    return $this->hp;
  }
  
  public function get_Latitude()
  {
    return $this->latitude;
  }
  
  public function get_Longitude()
  {
    return $this->longitude;
  }
  
  public function getType()
  {
    return $this->type;
  }
  
  public function setHp($hp) {
    $this->hp = $hp;
  }
  
  public function set_Latitude($latitude)
  {
    $this->latitude = $latitude;
  }
  
  public function set_Longitude($longitude)
  {
    $this->longitude = $longitude;
  }


  public function __construct($name, $image, $weight, $hp, $latitude, $longitude, $type)
  {  
    $this->name = $name;
    $this->image = $image;
    $this->weight = $weight;
    $this->hp = $hp;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->type = $type;

 
  }

  public function __toString()
  {
    return "<tr><td>" . $this->name . "</td><td><img src='images/" . $this->image . "' width='50'></td><td>" . $this->weight . "</td><td>" . $this->hp . "</td><td>" . $this->latitude . "</td><td>" . $this->longitude . "</td><td>" . $this->type . "</td></tr>";
  }

  public function Attack(Pokemon $other)
  {


    $other->hp = $other->hp - $this->getDamage();

    if ($other->hp <= 0) {
      $other->setHp(0);
    }

    return $this->name . " attacked " . $other->name . " doing " . $this->getDamage() . " damage!!";

    return " " . $other->name . "'s HP is now" . $other->hp;
  }

  public abstract function getDamage();

  public function getJSON()
  {
    $tpoke = '{' . '"lat"' . ': ' . $this->latitude . ',' . '"long"' . ': ' . $this->longitude . ',' . '"name"' . ': ' . '"' . $this->name . '"' . ',' . '"image"' . ': ' . '"' . $this->image . '"' . '}';

    return $tpoke;
  }
}
