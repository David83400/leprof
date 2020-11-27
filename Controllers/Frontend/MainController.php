<?php

namespace LeProf\Controllers\Frontend;

class MainController extends Controller
{
    public function index()
    {
        include_once ROOT.'/Views/Frontend/home/index.php';
    }
}