<?php

namespace LeProf;

class Autoloader
{
    /**
     * Lance le spl_autoload_register
     *
     * @return void
     */
    static function register()
    {
        // spl_autoload_register est une méthode php qui permet 
        // de mettre en place une détection automatique 
        // des instanciations de classes (new) et d'exécuter une méthode (autoload)
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        // On récupère dans $class la totalité du namespace de la classe concernée
        // On va le découper et enlever LeProf\  avec la constante magique __NAMESPACE__ 
        // pour avoir le chemin d'accés au fichier
        $class = str_replace(__NAMESPACE__ . '\\', '', $class); /* str_replace('\\' = chaine de caractère à chercher, 
        '' = ce par quoi on remplace, $class = l'objet dans lequel on va aller chercher) */
        
        // On remplace les \ par des /
        $class = str_replace('\\', '/', $class);
        
        // On charge le fichier correspondant
        // __DIR__ = dossier dans lequel se trouve l'autoloader
        $file = __DIR__ . '/' . $class . '.php';

        if(file_exists($file)){
            require_once $file;
        }
    }
}