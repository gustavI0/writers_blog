<?php
namespace Blog\Model; 

class Post {

	private $id;
	private $title;
	private $content;
	private $date;

	public function getId() { return $this->id; }
	public function getTitle() { return $this->title; }
	public function getContent() { return $this->content; }
	public function getCreationDate() { return $this->date->format('d/m/Y à H:i'); }

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setCreationDate($date)
	{
		$this->date = new \DateTime($date);
	}
}