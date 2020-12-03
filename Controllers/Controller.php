<?php

namespace LeProf\Controllers;

abstract class Controller
{
    public function render(string $file, array $data = [])
    {
        // On extrait le contenu de data
        extract($data);
        
        // On crée le chemin vers la view
        require_once ROOT.'/Views/'.$file.'.php';
    }
}