<?php

namespace LeProf\Core;

use LeProf\Controllers\Frontend\MainController;
use LeProf\Models\MembersModel;
use LeProf\Models\VisitorsModel;

class Main
{
    /**
     * Route the incoming requests
     *
     * @return void
     */
    public function routerRequest()
    {
        session_start();
        // We recover the URL
        $uri = $_SERVER['REQUEST_URI'];

        if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
            $uri = substr($uri, 0, -1);

            http_response_code(301);

            header('Location: '.$uri);
        }

        // We manage URL parameters
        // p=controller/méthod/params
        // We separate the parameters in an array
        $params = [];
        if(isset($_GET['p'])){
            $params = explode('/', $_GET['p']);
        }
        // We check that we have at least one parameter
        if($params[0] != ''){
            $controller = array_shift($params); // array_shift remove the first parameter from an array

            if($controller === 'descriptif' || $controller === 'members' || $controller === 'main'){
                $controller = '\\LeProf\\Controllers\\Frontend\\'.ucfirst($controller).'Controller';
            }else{
                $controller = '\\LeProf\\Controllers\\Backend\\'.ucfirst($controller).'Controller';
            }

            // We instantiate the controller
            $controller = new $controller();

            // The fist parameter is no longer in the table, so we get the second URL parameter if there is one
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            // We check if the method ($action) exists in the controller
            if(method_exists($controller, $action)){
                // If there are any parameters we send them to the function
                // The call_user_func_array will look for the $action method which is in the controller function,
                // and also passes the parameters (it allows to dismantle an array and to put the parameters one after the other)
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
            }else{
                http_response_code(404);
                echo 'La page demandée n\'existe pas !';
            }
        }else{
            // If there's no parameter we instantiate the default controller and we call the index method
            $homeController = new MainController;

            $homeController->index();
        }
    }
}
