<?php

/*
Fichier Autoloader dans lequel on effectue le chargement automatique de classe.
Ce fichier est appelé via un require dans le fichier index.php et permet de définir nos classes contenues dans les autres fichiers du répertoire ./app
*/

namespace App;

/**
 * Class Autoloader
 */

class Autoloader{

    /**
     * Enregistre notre autoloader
     */

    static function register(){
		//On préfère spl_autoload_register à __autoload car cette dernière est en passe de devenir obsolète
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
		//strpos peut renvoyer False, on utilise donc === pour tester la bonne valeur de retour
        if(strpos($class, __NAMESPACE__ . '\\')===0){
            $class = str_replace(__NAMESPACE__ . '\\', '',$class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }

}
