<?php

namespace LeProf\Core;

use LeProf\Controllers\Frontend\MainController;
use LeProf\Models\Frontend\MembersModel;
use LeProf\Models\Frontend\VisitorsModel;

class Main
{
    public function routerRequest()
    {
        // On récupère l'URL
        $uri = $_SERVER['REQUEST_URI'];

        // On vérifie que l'URL n'est pas vide et qu'elle se termine par un slash
        if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
            // On enlève le slash
            $uri = substr($uri, 0, -1);

            // On envoie un code de redirection permanente
            http_response_code(301);

            // On redirige vers l'URL sans le slash
            header('Location: '.$uri);
        }

        // On gère les paramètres d'URL
        // p=controller/méthode/paramètre
        // On sépare les paramètres dans un tableau
        $params = [];
        if(isset($_GET['p'])){
            $params = explode('/', $_GET['p']);
            
            // On vérifie qu'on a au moins un paramètre
            if($params[0] != ''){
                //On récupère le nom du controller à instancier
                // On met une majuscule en 1ère lettre, 
                // on ajoute le namespace complet avant, 
                // et on ajoute "Controller" après.
                $controller = '\\LeProf\\Controllers\\Frontend\\' .ucfirst(array_shift($params)) . 'Controller';
                
                // On instancie le controller
                $controller = new $controller;

                // On récupère le 2ème paramètre d'URL
                $action = (isset($params[0])) ? array_shift($params) : 'index';

                if(method_exists($controller, $action)){
                    // Si il reste des paramètres on les passe à la méthode
                    (isset($params[0])) ? $controller->$action($params) : $controller->$action();
                }else{
                    http_response_code(404);
                    echo 'La page demandée n\'existe pas !';
                }
            }
        }else{
            // On n'a pas de paramètre donc on instancie le controller par défaut
            $homeController = new MainController;

            // On appelle la méthode home
            $homeController->index();
        }
    }
}
