<?php
namespace Blog\Model;

use \PDO;

class UserManager extends Manager {

	const TABLE_NAME = 'users';

	/**
	 * Récupère les données utilisateur
	 * @param  String $pseudo Pseudo
	 * @return obj         Utilisateur
	 */
	public function getUserCred($values) 
	{
		$column = 'pseudo';
		$binded = ':pseudo';
		$db = $this->dbConnect();
		$sql = $this->find($column, $binded);
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
		$columns = 'pseudo, pwd';
        $binded = ':pseudo, :pwd';

        $db = $this->dbConnect();
        $sql = $this->create($columns, $binded);
        $req = $db->prepare($sql);

        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue(':pwd', $pass_hache, PDO::PARAM_STR);
		$req->execute();

		return $req;
	}

}