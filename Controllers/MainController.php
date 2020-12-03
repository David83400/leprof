<?php

namespace LeProf\Controllers;

use LeProf\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        include_once ROOT.'/Views/home/index.php';
    }
}