<?php
namespace Blog;

require_once('config/_config.php');

Autoloader::start();

use Blog\Router\Router;

$request = $_GET['p'];

try {
	$router = new Router($request);
	$router->dispatch();
}
catch(Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}