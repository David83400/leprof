<?php

namespace LeProf\Controllers;

use LeProf\Controllers\Controller;
use LeProf\Models\VisitorsModel;

class DescriptifController extends Controller
{
    public function index()
    {
        // On instancie le modèle correspondant à la table descriptif
        $visitorsModel = new VisitorsModel();

        // On va chercher tous les visitors
        $visitors = $visitorsModel->findAll();

        // On génère la view
        $this->render('descriptif/index', ['visitors' => $visitors]);
    }
}