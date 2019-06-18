<?php
namespace Blog\Model; 

class User {

	private $id;
	private $pseudo;
	private $pwd;

	public function getId() { return $this->id; }
	public function getPseudo() { return $this->pseudo; }
	public function getPwd() { return $this->pwd; }

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}

	public function setPwd($pwd)
	{
		$this->pwd = $pwd;
	}
}