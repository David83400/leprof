<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Display the home page
     *
     * @return void
     */
    public function index()
    {
        $this->frontRender('Frontend/home/index', []);
    }
}