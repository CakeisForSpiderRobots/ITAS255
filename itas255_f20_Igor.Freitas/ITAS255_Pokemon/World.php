<?php
class World
{
    static $instance;

    private $trainer;
    private $message = "";
    private $wildPokemon = array();
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new World();
        }
        return self::$instance;
    }
    public static function reset()
    {
        self::$instance == null;
    }

    private function __construct()
    {
        $this->trainer = new Trainer('Steven', 'Steven.png', 49.159706, -123.907757);
    }
    public function getTrainer()
    {
        return $this->trainer;
    }
    private function __clone()
    {
    }

    public function getWildPokemon()
    {
        echo "<br><table id=wildpokemontable border='1'>";
        echo "<tr><th>Name</th><th>Image</th><th>Weight</th><th>HP</th><th>Latitude</th><th>Longitude</th><th>Type</th></tr>";
        echo "<caption>Wild Pokemon</caption>";
        foreach ($this->wildPokemon as $wildpoke) {
            echo $wildpoke;
        }
        echo "</table>";
    }

    public function getTrainersPokemon()
    {
        return $this->trainer->getPokemon();
    }
    public function removeTPokemon(Pokemon $pokemon)
    {
        if (($key = array_search($pokemon, $this->trainer->pokedex)) !== false) {
            unset($this->trainer->pokedex[$key]);
        } else
            $this->trainer->pokedex = array_values($this->trainer->pokedex);
    }

    public function removeWPokemon(Pokemon $pokemon)
    {
        if (($key = array_search($pokemon, $this->wildPokemon)) !== false) {
            unset($this->wildPokemon[$key]);
        } else
            $this->wildPokemon = array_values($this->wildPokemon);
    }

    public function load()
    {
        $this->wildPokemon = $this->loadPokemon("wildPokemon.txt");

        $this->trainer->pokedex = $this->loadPokemon("trainerPokemon.txt");
    }

    protected $c = 0;
    public function battle()
    {
        $battletext = array();
        $battletext .= "<br><br><b>Battle Round: " . $this->c . "</b>";
        $this->c++;
        $this->addMessage("Battling... ");
        if (count($this->wildPokemon) == 0) {
            $battletext .= "<br><br><b><u>All wild pokemon are passed out!!!</u></b>";
            return;
        }
        $nearestWild = null;
        $nearestDistance = 0;

        foreach ($this->wildPokemon as $wild) {

            $distance = $this->distance(
                $this->trainer->get_Latitude(),
                $this->trainer->get_Longitude(),
                $wild->get_Latitude(),
                $wild->get_Longitude()
            );

            if ($nearestWild == null) {
                $nearestWild = $wild;
                $nearestDistance = $distance;
            } else if ($distance < $nearestDistance) {
                $nearestWild = $wild;
                $nearestDistance = $distance;
            }

        }
        $this->addMessage("Found the next nearest wild pokemon " . $wild->get_Name() . "!!!");

        $this->trainer->set_Latitude($nearestWild->get_Latitude());
        $this->trainer->set_Longitude($nearestWild->get_Longitude());

        foreach ($this->trainer->getPokemon() as $tPoke) {
            $tPoke->set_Latitude($nearestWild->get_Latitude());
            $tPoke->set_Longitude($nearestWild->get_Longitude());
        }

        foreach ($this->trainer->getPokemon() as $tPoke) {
            $tPokeAlive = true;
            if ($tPoke->getHp() > 0) {
                $tPokeAlive = true;
            } else {
                $tPokeAlive = false;
            }
            while ($tPokeAlive == true) {
                $battletext .= "<br>" . $this->trainer->get_Name() . "'s pokemon " . $tPoke->get_Name() . " attacking.";
                $battletext .= $tPoke->attack($nearestWild);
                $this->addMessage("Trainer_" . $tPoke->get_Name() . " attacked Wild_" . $nearestWild->get_Name() . " HP" . $nearestWild->getHp() . "!!!");

                if ($nearestWild->getHp() > 0) {
                    $battletext .= "<br>Wild Pokemon " . $nearestWild->get_Name() . " Attacking.";
                    $battletext .= $nearestWild->attack($tPoke);
                } else if ($nearestWild->getHp() <= 0) {
                    $battletext .= "<br><br><u>The wild pokemon " . $nearestWild->get_Name() . " has passed out!!!</u><br>";
                    $this->removeWPokemon($nearestWild);
                    return;
                }

                if ($tPoke->getHp() <= 0) {
                    $tPokeAlive = false;
                    $battletext .= "<br><br><u>" . $this->trainer->get_Name() . "'s Pokemon " . $tPoke->get_Name() . " has passed out!!!</u><br><br>";
                }
            }
        }
        $battletext .= "<hr>";
        return;
    }
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

        $dist = acos($dist);
        $dist = rad2deg($dist);

        $miles = $dist * 60 * 1.1515;

        return $miles * 1.609344;
    }

    public function addMessage($message)
    {
        $this->message .= $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function clearMessage()
    {
        $this->message = "";
    }

    public function getJSON()
    {

        $markers = '{"markers": [';

        foreach ($this->wildPokemon as $wpoke) {
            $markers .= $wpoke->getJSON();
            $markers .= ', ';
        }

        $length = count($this->trainer->pokedex);

        for ($count = 0; $count < $length; $count++) {
            $tpoke = $this->trainer->pokedex[$count];
            $markers .= $tpoke->getJSON();

            if ($count < $length - 1) {
                $markers .= ', ';
            }
        }

        $markers .= ', ' . $this->trainer->getJSON();

        $markers .= '], "message": "' . $this->getMessage() . '"}';

        return $markers;
    }

    public function loadPokemon($filename)
    {
        $lines = file($filename);

        $pokemons = array();

        foreach ($lines as $line) {

            list($name, $weight, $hp, $lat, $long) = explode(",", $line);

            $name = trim($name);

            $pokemon = new $name($name, $weight, $hp, $lat, $long);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
}
