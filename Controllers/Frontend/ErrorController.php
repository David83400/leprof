<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;

class ErrorController extends Controller
{
     /**
     * Display the error page
     *
     * @return void
     */
    public function index($errorMessage)
    {
        $this->frontRender('Frontend/errors/index', ['errorMessage' => $errorMessage]);
    }
}