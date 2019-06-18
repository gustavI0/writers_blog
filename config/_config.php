<?php
namespace Blog;

class Autoloader{

    /**
     * Enregistre l'autoloader
     * 
     */
    public static function start()
    {   
        
        if(!isset($_SESSION)) {
            session_start(); 
        }

        spl_autoload_register(array(__CLASS__, 'autoload'));

        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define('ROOT', $root.'/blog/');
        define('HOST', $host.'/blog/');

        define('BLOGTITLE', 'Le Blog de l\'Écrivain');
    }

    /**
     * Autoloader
     * @param  string $class Classe à charger
     * 
     */
    public static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require 'class/' . $class . '.php';
        }
    }

}