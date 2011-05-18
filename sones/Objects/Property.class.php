<?php

class Property{
	private $id = "";
	
	private $type = "";
	
	private $value;
	
	
	public function __construct($myID,$myType,$myValue){
		$this->id = $myID;
		$this->type = $myType;
		$this->value = $myValue;
	}
	
	public function getID(){
		return $this->id;
	}
	 	
	public function getType(){
		return $this->type;
	}
	
	public function getValue(){
		return $this->value;
	}
}

?>