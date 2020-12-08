<?php

namespace LeProf\Controllers;

abstract class Controller
{
    public function render(string $file, array $data = [])
    {
        // On extrait le contenu de data
        extract($data);

        // On démarre le buffer de sortie
        ob_start();
        // A partir de ce point, toute sortie est conservée en mémoire
        
        // On crée le chemin vers la view
        require_once ROOT.'/Views/'.$file.'.php';
        
        // transfère le buffer dans $content
        $content = ob_get_clean();
        $navbar = ob_get_clean();
        $footer = ob_get_clean();
        
        require_once ROOT.'/Views/navbar.php';
        require_once ROOT.'/Views/template.php';
        require_once ROOT.'/Views/footer.php';
    }
}