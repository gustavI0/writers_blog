<?php

namespace Blog\View;


class View {

	private $template;

	public function __construct($template) 
	{
		$this->template = $template;
	}

	public function renderFront($params = array()) 
	{
		extract($params);

		$this->params = $params;
		$template = $this->template;
		ob_start();
		include_once('view/frontend/' . $template . '.php');
		$content = ob_get_clean();
		include_once('view/templates/default.php');
	}

	public function renderBack($params = array()) 
	{
		if ($_SESSION['id']) {
			extract($params);

			$this->params = $params;
			$template = $this->template;
			ob_start();
			include_once('view/admin/' . $template . '.php');
			$content = ob_get_clean();
			include_once('view/templates/admin.php');
		}
		else {
			$this->redirect('signin');
		}
		
	}

	public function renderLog($params = array()) 
	{
		extract($params);

		$this->params = $params;
		$template = $this->template;
		ob_start();
		include_once('view/frontend/' . $template . '.php');
		$content = ob_get_clean();
		include_once('view/templates/login.php');
	}

	public function redirect($path) 
	{
		header('Location: '.$path);
		exit;
	}

}