<?php

include_once "ISingleEdge.interface.php";

class SingleEdge implements ISingleEdge{
	
	private $name = "";
	
	private $propertyList = array();
	
	private $targetVertex;
	
	public function __construct($myID, $myPropertyList, $myTargetVertex){
		$this->name = $myID;
		$this->propertyList = $myPropertyList;
		$this->targetVertex = $myTargetVertex;
	}
	
	
	public function getProperties(){
		return $this->propertyList;
	}
	
	public function getTargetVertex(){
		return $this->targetVertex;
	}
	
	public function getID(){
		return $this->name;
	}

        public function  hasProperty($myPropertyID) {
        if($propertyList[$myPropertyID] != null){
            return true;
        }
        return false;
        }
	
	
	
	
	public function getPropertyByID($myPropertyID){
		return $this->propertyList[$myPropertyID];
	}
	
	
	
		
	
}

?>