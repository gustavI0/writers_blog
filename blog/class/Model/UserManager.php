<?php
namespace Blog\Model;

use \PDO;

class UserManager extends Manager {

	const TABLE_NAME = 'users';

	/**
	 * Récupère les données utilisateur
	 * @param  String $pseudo Pseudo
	 * @return Array         Données utilisateur
	 */
	public function getUserCred($values) 
	{
		$db = $this->dbConnect();
		$sql = $this->getCreds();
		$req = $db->prepare($sql);
		$req->bindValue(':pseudo', $values['pseudo'], PDO::PARAM_STR);
		$req->execute();
		$row = $req->fetch(PDO::FETCH_ASSOC);

		$user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setPwd($row['pwd']);
		
		return $user;
	}

	/**
	 * Ajoute les données utilisateur à la base de données
	 * @param  string $pseudo     Pseudo
	 * @param  string $pass_hache Password
	 * @return boolean             Statut inscription
	 */
	public function inscription($pseudo, $pass_hache) 
	{
		$db = $this->dbConnect();
		$req = $db->prepare('
			INSERT INTO users(pseudo, pwd) 
			VALUES(:pseudo, :pwd)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'pwd' => $pass_hache));

		return $req;
	}

}