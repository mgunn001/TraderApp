<?php
    ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(-1);

class SellerComment
{
	private	$id;
	private	$comment;
	private	$timePosted;
	private	$commenterName;

	
	public function __construct($id,$comment,$timePosted, $commenterName)
	{
		 $this->id = $id;
		 $this->comment = $comment;
		 $this->timePosted = $timePosted;
		 $this->commenterName = $commenterName;
	}
		public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getComment(){
		return $this->comment;
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function getTimePosted(){
		return $this->timePosted;
	}

	public function setTimePosted($timePosted){
		$this->timePosted = $timePosted;
	}

	public function getCommenterName(){
		return $this->commenterName;
	}

	public function setCommenterName($commenterName){
		$this->commenterName = $commenterName;
	}
}
?>