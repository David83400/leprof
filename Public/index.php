<?php

use LeProf\Autoloader;
use LeProf\Core\Main;

define('ROOT', dirname(__DIR__));

require_once ROOT.'/Autoloader.php';
Autoloader::register();

$leProf = new Main();

$leProf->routerRequest();