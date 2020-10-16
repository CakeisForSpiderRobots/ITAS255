<?php
class Trainer extends Character
{
  public $pokedex;

  public function __construct($name, $image, $latitude, $longitude)
  {
    $this->name = $name;
    $this->image = $image;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->pokedex = array();
  }

  public function get_Name()
  {
    return $this->name;
  }
  public function get_Image()
  {
    return $this->image;
  }
  public function get_Latitude()
  {
    return $this->latitude;
  }
  public function get_Longitude()
  {
    return $this->longitude;
  }


  public function set_Latitude($latitude)
  {
    $this->latitude = $latitude;
  }
  public function set_Longitude($longitude)
  {
    $this->longitude = $longitude;
  }

  public function add(Pokemon $pokemon)
  {
    $this->pokedex[] = $pokemon;
  }

  public function getPokemon()
  {
    return $this->pokedex;
  }
  public function printAll()
  {
    echo "<br><table id=pokemontable border='1'>";
    echo "<tr><th>Name</th><th>Image</th><th>Weight</th><th>HP</th><th>Latitude</th><th>Longitude</th><th>Type</th></tr>";
    echo "<caption>Trainer " . $this->name . "'s Pokemon </caption>";
      foreach ($this->pokedex as $pokemon) {
      echo $pokemon;
    } 
    echo "</table>";
  }

  public function __toString()
  {
    return "<table><tr><th>Name</th><th>Image</th><th>Lat</th><th>Long</th></tr><tr><td>" . $this->name . "</td><td><img src='images/" . $this->image . "' width='50'></td><td>" . $this->latitude . "</td><td>" . $this->longitude . "</td></tr></table>";
  }

  public function attackAll(Pokemon $other)
  {
    echo "All pokemon are attacking " . $other->name . "!!<br>";
    foreach ($this->pokedex as $pokemon) {
      $pokemon->attack($other);
    }
  }

  public function getDamage()
  {
    return 6;
  }

  public function getJSON()
  {
    $tpoke = array();
    $tpoke = '{' . '"lat"' . ': ' . $this->latitude . ',' . '"long"' . ': ' . $this->longitude . ',' . '"name"' . ': ' . '"' . $this->name . '"' . ',' . '"image"' . ': ' . '"' . $this->image . '"' . '}';

    return $tpoke;
  }
}
