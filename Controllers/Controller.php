<?php

namespace LeProf\Controllers;

abstract class Controller
{
    private $title;

    /**
     * Generate and display Frontend views
     *
     * @param [mixed] $data
     * @return void
     */
    public function render(string $file, array $data = [], string $template = 'template')
    {
        $content = $this->generateFile($file, $data);
        $navbar = $this->generateFile("/navbar", $data);
        $adminNavbar = $this->generateFile("/adminNavbar", $data);
        $footer = $this->generateFile("/footer", $data);
        $view = $this->generateFile('/'.$template, array('title' => $this->title, 'navbar' => $navbar, 'adminNavbar' => $adminNavbar, 'content' => $content, 'footer' => $footer));

        echo $view;
    }

    /**
     * Generate a view file and return the result
     *
     * @param [string] $file
     * @param [mixed] $data
     * @return [mixed]
     */
    private function generateFile($file, $data)
    {
        extract($data);
        ob_start();
        require ROOT.'/Views/'.$file.'.php';
        return ob_get_clean();
    }
    
    /*public function render(string $file, array $data = [], string $template = 'template')
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
        $navbarAdmin = ob_get_clean();
        $footer = ob_get_clean();

        require_once ROOT.'/Views/navbar.php';
        require_once ROOT.'/Views/navbarAdmin.php';
        require_once ROOT.'/Views/'.$template.'.php';
        require_once ROOT.'/Views/footer.php';
    }*/
}