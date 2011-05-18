<?php

include_once "IHyperEdge.interface.php";

class HyperEdge implements IHyperEdge{
	
	private $name = "";
	
	private $propertyList = array();
	
	private $binaryPropertyList = array();
	
	private $containedSingleEdges  = array();
	
	public function __construct($myName,$myProperties,$mySingleEdges){
		$this->name = $myName;
		$this->propertyList = $myProperties;
		$this->containedSingleEdges = $mySingleEdges;
	}


	public function getTargetVertices(){
	 	$payload  = array();
	 	$i = 0;
	 	foreach($this->containedSingleEdges as $edge){
	 		$payload[$i] =  $edge.getTargetVertex();
	 		$i += 1;
	 	}
	 	return payload;
	}
	
	public function getPropertyByID($myPropertyName){
		return $this->propertyList[$myPropertyName];
	}
	
	public function getProperties(){
		return $this->propertyList;
	}
	
	public function getEdges(){
		return $this->containedSingleEdges;
	}
	
	public function getID() {
		return $this->name;
	}

        public function  hasProperty($myPropertyID) {
        if($propertyList[$myPropertyID] != null){
            return true;
        }
        return false;
        }

        public function getBinaryProperty(){
            return $this->binaryPropertyList;
        }
	
	
	
}
?>