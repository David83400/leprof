<?php

use LeProf\Autoloader;
use LeProf\Core\Main;

// route containing the project root folder
define('ROOT', dirname(__DIR__));

require_once ROOT.'/Autoloader.php';
Autoloader::register();

$leProf = new Main();

$leProf->routerRequest();