<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class UserManager extends Manager {

	public function getUserCred($pseudo) {

		$db = $this->dbConnect();
		$req = $db->prepare('
			SELECT id, pwd 
			FROM users 
			WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $pseudo));
		$result = $req->fetch();
		
		return $result;
	}

	public function inscription($pseudo, $pass_hache, $email) {

		$db = $this->dbConnect();
		$req = $db->prepare('
			INSERT INTO users(pseudo, pwd, email) 
			VALUES(:pseudo, :pwd, :email)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'pwd' => $pass_hache,
			'email' => $email));

		return $req;
	}

}