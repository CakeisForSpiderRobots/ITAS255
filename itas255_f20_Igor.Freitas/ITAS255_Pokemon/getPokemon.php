<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE);
function __autoload ($class_name) {
	require_once $class_name . '.php';
}

$reset = false;
if (isset($_GET['reset'])) {
    $reset = true;
}

$world = null;

if (!isset($_SESSION['counter']) || $reset == true) {
    $_SESSION['counter'] = 0;

    World::reset();
    $world = World::getInstance();

    try {
        $world->load();
        $world->addMessage("Loaded pokemon from files");
    } catch (Exception $e) {
        $world->addMessage("Failed to load pokemon from files");
    }

    $_SESSION['world'] = $world;

} else {
    $_SESSION['counter'] = $_SESSION['counter'] + 1;

    $world = $_SESSION['world'];


}

if ($_SESSION['counter'] >= 1) {
    $world->battle();
}

echo $world->getJSON();

$world->clearMessage();
