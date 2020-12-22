<?php

namespace LeProf\Controllers;

use LeProf\Core\Main;

abstract class Controller
{
    private $file;
    private $title;

    /**
     * Generate and display Frontend views
     *
     * @param string $file
     * @param array $data
     * @param string $template
     * @return void
     */
    public function frontRender(string $file, array $data = [], string $template = 'Frontend/template')
    {
        $content = $this->generateFile($file, $data);
        $head = $this->generateFile("head", $data);
        $header = $this->generateFile("Frontend/header", $data);
        $navbar = $this->generateFile("Frontend/navbar", $data);
        $session = $this->generateFile('session', $data);
        $footer = $this->generateFile("Frontend/footer", $data);
        $view = $this->generateFile($template, array(
            'title' => $this->title,
            'head' => $head,
            'header' => $header,
            'navbar' => $navbar,
            'session' => $session,
            'content' => $content,
            'footer' => $footer
        ));
    
        echo $view;
    }

    /**
     * Generate and display Backend views
     *
     * @param string $file
     * @param array $data
     * @param string $template
     * @return void
     */
    public function backRender(string $file, array $data = [], string $template = 'Backend/adminTemplate')
    {
        $content = $this->generateFile($file, $data);
        $head = $this->generateFile("/head", $data);
        $adminNavbar = $this->generateFile("/Backend/adminNavbar", $data);
        $session = $this->generateFile('/session', $data);
        $view = $this->generateFile('/'.$template, array(
            'title' => $this->title,
            'head' => $head,
            'adminNavbar' => $adminNavbar,
            'session' => $session,
            'content' => $content
        ));

        echo $view;
    }

    /**
     * Generate a view file and return the result
     *
     * @param string $file
     * @param array $data
     * @return mixed
     */
    private function generateFile(string $file, array $data = [])
    {
        $this->file = ROOT.'/Views/'.$file.'.php';

        if(file_exists($this->file)){
            extract($data);
            ob_start();
            require $this->file;
            return ob_get_clean(); 
        }else{
            throw new \Exception('le fichier ' . $file . ' est introuvable');
        }
    }
}