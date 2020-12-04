<?php

namespace LeProf\Controllers;

use LeProf\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $this->render('home/index');
    }
}