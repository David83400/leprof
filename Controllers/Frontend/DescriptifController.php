<?php

namespace LeProf\Controllers\Frontend;

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
        $this->frontRender('Frontend/descriptif/index', ['visitors' => $visitors]);
    }

    public function connaitre(int $id)
    {
        // exemple d'affichage d'un visitor
        // On instancie le modèle
        $visitorModel = new VisitorsModel();

        // On va chercher 1 visitor
        $visitor = $visitorModel->find($id);

        // On envoie à la vue
        $this->frontRender('Frontend/descriptif/connaitre', ['visitor' => $visitor]);
    }
}