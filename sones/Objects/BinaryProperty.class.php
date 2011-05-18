<?php

class BinaryProperty{
	
	private $id = "";
	
	private $content = "";
	
	
	public function __construct($myID, $myContent){
		$this->id = $myID;
		$this->content = $myContent;
	}
	
	public function getID(){
		return $this->id;
	}
	
	public function getContent(){
		return $this->content;
	}
}

?>