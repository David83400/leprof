<?php

use LeProf\Autoloader;
use LeProf\Core\Main;

require_once 'Autoloader.php';
Autoloader::register();

$leProf = new Main();

$leProf->routerRequest();