<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        $this->frontRender('Frontend/home/index', []);
    }
}