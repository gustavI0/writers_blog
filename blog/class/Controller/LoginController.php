<?php
namespace Blog\Controller;

use Blog\Model\{
    UserManager,
    User
};

use Blog\View\View;

class LoginController extends Controller {

    private $emUser;

    public function __construct() 
    {
        $this->emUser = new UserManager();
    }

    public function signup($params) 
    {
        $view = new View('signup');
        $view->renderLog();
    }

    public function signin($params) 
    {
        $view = new View('signin');
        $view->renderLog();
    }

    public function regSuccess($params) 
    {
        $view = new View('regSuccess');
        $view->renderLog();
    }

    /**
     * S'enregistrer sur le site
     * @param  String $pseudo Pseudo
     * @param  String $pwd    Password
     * @param  String $pwd2   Vérification de password
     * @return Array         User credentials
     */
    public function register($params) 
    {
        $values  = $_POST['values'];
        if (!empty($values['pseudo']) && !empty($values['$pwd'])) {
            if($pwd !== $pwd2) {
                $view = new View('signup');
                $view->redirect('signup&status=difpwd');
            } 
            else {
                $pass_hache = password_hash($pwd, PASSWORD_DEFAULT);
                $newUser = $this->emUser->inscription($pseudo, $pass_hache);
            } 
        } 
        else {
            $view = new View('signup');
            $view->redirect('signup&status=fieldmissing');
        }
        
        if ($newUser === false) {
            throw new Exception('Impossible d\'inscrire le nouvel utilisateur !');
        }
        else {
            $view = new View('regSuccess');
            $view->redirect('signup&status=regSuccess');
        }
    }

    /**
     * Se connecter
     * @param  String $pseudo Pseudo
     * @param  String $pwd    Password
     * @return Boolean         Connecté ok ou non
     */
    public function login($params)
    {
        $values  = $_POST['values'];
        if (!empty($values['pseudo']) && !empty($values['pwd'])) {
            $user = $this->emUser->getUserCred($values);
        } 
        else {
            $view = new View('signin');
            $view->redirect('signin&status=fieldmissing');
        }

        $isPasswordCorrect = password_verify($values['pwd'], $user->getPwd());

        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $user->getId();
            $_SESSION['pseudo'] = $user->getPseudo();
            $view = new View('admin');
            $view->redirect('admin');
        }
        else {
            $view = new View('signin');
            $view->redirect('signin&status=failed');
        }

    }

    /**
     * Se déconnecter du site
     * @return Boolean Déconnexion
     */
    public function disconnect()
    {
        session_destroy();
        $view = new View('home');
        $view->redirect('home');
    }
}
