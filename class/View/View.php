<?php
namespace Blog\View;

class View {

	private $template;

	public function __construct($template) 
	{
		$this->template = $template;
	}

	/**
	 * Affichage des pages front
	 * @param  array  $params Billets et commentaires
	 * @return HTML         Pages front
	 */
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

	/**
	 * Affichage des pages admin controlés par la connexion de l'utilisaeur ou non
	 * @param  array  $params Billets et commentaires
	 * @return HTML         Pages d'administration
	 */
	public function renderBack($params = array()) 
	{
		if (!$_SESSION['id']) {
			$this->redirect('signin');
		}
		
		extract($params);

		$this->params = $params;
		$template = $this->template;
		ob_start();
		include_once('view/admin/' . $template . '.php');
		$content = ob_get_clean();
		include_once('view/templates/admin.php');
	}

	/**
	 * Affichage des pages liées à l'enregistrement des utilisateurs et connexion
	 * @return HTML         Pages d'administration
	 */
	public function renderLog() 
	{
		$template = $this->template;
		ob_start();
		include_once('view/frontend/' . $template . '.php');
		$content = ob_get_clean();
		include_once('view/templates/login.php');
	}

	/**
	 * Fonction de redirection
	 * @param  string $path Chemin de redirection
	 * @return HTML       Nouvelle page liée à la requête
	 */
	public function redirect($path) 
	{
		header('Location: '.$path);
		exit;
	}

}