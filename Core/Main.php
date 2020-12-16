<?php

namespace LeProf\Core;

use LeProf\Controllers\Frontend\MainController;
use LeProf\Models\MembersModel;
use LeProf\Models\VisitorsModel;

class Main
{
    public function routerRequest()
    {
        // On démarre la session
        session_start();
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
        }
        // On vérifie qu'on a au moins un paramètre
        if($params[0] != ''){
            // On a au moins 1 paramètre
            //On récupère le nom du controller à instancier
            // On met une majuscule en 1ère lettre, 
            // on ajoute le namespace complet avant, 
            // et on ajoute "Controller" après.
            $controller = array_shift($params); // array_shift enlève le 1er paramètre d'un tableau

            if($controller === 'descriptif' || $controller === 'members' || $controller === 'main'){
                $controller = '\\LeProf\\Controllers\\Frontend\\'.ucfirst($controller).'Controller';
            }else{
                $controller = '\\LeProf\\Controllers\\Backend\\'.ucfirst($controller).'Controller';
            }

            // On instancie le controller
            $controller = new $controller();

            // Le 1er paramètre n'est plus dans le tableau, on récupère donc le 2ème paramètre d'URL s'il y'en a un
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            // On vérifie si la méthode ($action) existe dans le controller
            if(method_exists($controller, $action)){
                // Si il reste des paramètres on les envoie à la fonction
                // Le call_user_func_array va chercher la méthode $action qui se trouve dans la fonction controller, 
                // et passe en plus les paramètres (elle permet de démonter un tableau et de mettre les paramètres les uns après les autres)
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            }else{
                http_response_code(404);
                echo 'La page demandée n\'existe pas !';
            }
        }else{
            // On n'a pas de paramètre donc on instancie le controller par défaut
            $homeController = new MainController;

            // On appelle la méthode index
            $homeController->index();
        }
    }
}
