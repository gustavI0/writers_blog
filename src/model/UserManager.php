<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class UserManager extends Manager {

	public function getUserInfo(){

		$db = $this->dbConnect();
        $req = $db->query('SELECT pseudo, pwd, email FROM users');

        return $req;
	}

	public function inscription($pseudo, $pass_hache, $email) {

		$db = $this->dbConnect();
		$req = $db->prepare('INSERT INTO users(pseudo, pwd, email) VALUES(:pseudo, :pwd, :email)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'pwd' => $pass_hache,
			'email' => $email));

		return $req;
	}

	public function admin($pseudo, $pwd) {

		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, pwd FROM users WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $pseudo));
		$result = $req->fetch();
		
		return $result;
	}

}