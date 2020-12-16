<?php

use LeProf\Autoloader;
use LeProf\Core\Main;

// On définit une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

// On importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

$leProf = new Main();

$leProf->routerRequest();