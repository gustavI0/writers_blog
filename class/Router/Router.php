<?php
namespace Blog\Router;

use Blog\Controller\{
	FrontController,
	AdminController,
	LoginController
};

class Router {

	private $request;
	private $paths = [
						"home" 			=> ["controller" => 'FrontController', "method" => 'home'], //Front
						"showPost" 		=> ["controller" => 'FrontController', "method" => 'showPost'],
						"addComment" 	=> ["controller" => 'FrontController', "method" => 'addComment'],
						"signalComment" => ["controller" => 'FrontController', "method" => 'signalComment'],
						"signup" 		=> ["controller" => 'LoginController', "method" => 'signup'], // Login
						"register" 		=> ["controller" => 'LoginController', "method" => 'register'],
						"regSuccess" 	=> ["controller" => 'LoginController', "method" => 'regSuccess'],
						"signin" 		=> ["controller" => 'LoginController', "method" => 'signin'],
						"login" 		=> ["controller" => 'LoginController', "method" => 'login'],
						"disconnect" 		=> ["controller" => 'LoginController', "method" => 'disconnect'],
						"admin" 		=> ["controller" => 'AdminController', "method" => 'admin'], // Admin
						"addPost" 		=> ["controller" => 'AdminController', "method" => 'addPost'],
						"createPost" 		=> ["controller" => 'AdminController', "method" => 'createPost'],
						"editPost" 		=> ["controller" => 'AdminController', "method" => 'editPost'],
						"updatePost" 	=> ["controller" => 'AdminController', "method" => 'modifyPost'],
						"erasePost" 	=> ["controller" => 'AdminController', "method" => 'erasePost'],
						"approveComment" => ["controller" => 'AdminController', "method" => 'approveComment'],
						"eraseComment" 	=> ["controller" => 'AdminController', "method" => 'eraseComment']
					];

	public function __construct($request)
	{
        $this->request = $request;
    }

    /**
     * Récupère la requête
     * @return string Première élément de l'URL
     */
    public function getPath()
    {
    	$elements = explode('-', $this->request);
    	return $elements[0];
    }

    /**
     * Récupère les paramêtres de la requête
     * @return array Différents paramêtres de l'URL
     */
    public function getParams()
    {
    	$params = null;

    	// extract GET params
    	$elements = explode('-', $this->request);
    	unset($elements[0]);

    	for($i = 1; $i < count($elements); $i++) {
    		$params[$elements[$i]] = $elements[$i+1];
    		$i++;
    	}

    	// extract POST params
    	if($_POST) {
    		foreach($_POST as $key => $val) {
    			$params[$key] = $val;
    		}
    	}

    	return $params;
    }

    /**
     * Envoie vers le controleur et la méthode appelée par la requête
     * @return [type] [description]
     */
    public function dispatch() 
    {
    	
    	$path = $this->getPath();
    	$params = $this->getParams();

    	if (key_exists($path, $this->paths)) {
    		$controller = 'Blog\\Controller\\' . $this->paths[$path]['controller'];
    		$method = $this->paths[$path]['method'];

    		$currentController = new $controller();
    		$currentController->$method($params);
    	}
    	else {
    		echo '404';
    	}
    }
}