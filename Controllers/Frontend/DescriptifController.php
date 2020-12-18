<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;
use LeProf\Models\Frontend\VisitorsModel;

class DescriptifController extends Controller
{
    /**
     * Display the descriptif page
     *
     * @return void
     */
    public function index()
    {
        $visitorsModel = new VisitorsModel();

        $visitors = $visitorsModel->findAll();

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