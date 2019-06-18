<?php
namespace Blog\Model; 

class Comment {

	private $id;
	private $postId;
	private $author;
	private $content;
	private $date;
	private $moderation;
	private $postTitle;

	public function getId() { return $this->id; }
	public function getPostId() { return $this->postId; }
	public function getAuthor() { return $this->author; }
	public function getContent() { return $this->content; }
	public function getCreationDate() { return $this->date->format('d/m/Y à H:i'); }
	public function getModeration() { return $this->moderation; }
	public function getPostTitle() { return $this->postTitle; }

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setPostId($postId)
	{
		$this->postId = $postId;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function setCreationDate($date)
	{
		$this->date = new \DateTime($date);
	}

	public function setModeration($moderation)
	{
		$this->moderation = $moderation;
	}

	public function setPostTitle($postTitle)
	{
		$this->postTitle = $postTitle;
	}
}