<?php

include_once "IVertex.interface.php";

class Vertex implements IVertex{
	
	private $propertyList = array();
	
	private $binaryPropertyList  = array();
	
	private $edges = array();
	
	public function __construct($myPropertyList,$myBinaryPropertyList,$myEdges){
		$this->propertyList = $myPropertyList;
		$this->binaryPropertyList = $myBinaryPropertyList;
		$this->edges = $myEdges;
	}
	
	public function hasProperty($myPropertyID){
		return in_array($myBinaryPropertyID, $this->propertyList);
	}
	
	public function hasEdge($myEdgeName){
		return in_array($myBinaryPropertyID, $this->edges);
	}
	
	public function hasBinaryProperty($myBinaryPropertyID){
		return in_array($myBinaryPropertyID, $this->binaryPropertyList);
	}
	
	public function hasProperties(){
		return empty($this->propertyList);
	}
	
	public function hasBinaryProperties(){
		return empty($this->binaryPropertyList);
	}
	
	public function hasEdges(){
		return empty($this->edges);
	}
	
	public function getPropertyByID($myPropertyID){
		return $this->propertyList[$myPropertyID];
	}
	
	public function getSingleEdge($mySingleEdgeName){
		return $this->edges[$mySingleEdgeName];
	}
	
	public function getHyperEdge($myHyperEdgeName){
		return $this->edges[$myHyperEdgeName];
	}
	
	public function getSingleEdges(){
		$payload = array();
		$i = 0;
		foreach($this->edges as $edge){
			if(get_class($edge) == "SingleEdge"){
				$payload[$edge.getName()] = $edge;
			}
		}
		return $payload;
	}
	
	public function getProperties(){
		return $this->propertyList;
	}
	
	public function getHyperEdges(){
		$payload = array();
		
		foreach($this->edges as $edge){
			if(get_class($edge) == "HyperEdge"){
				$payload[$edge.getName()]= $edge;
				
			}
		}
		return $payload;
	}
	
	public function getAllEdges(){
		return $this->edges;
	}
	
	public function getBinaryProperties(){
		return $this->binaryPropertyList;
	}
	
	
	
	
	
	public function getAllNeighbours(){
		$payload = array();
		foreach($this->edges as $edge){
			if(get_class($edge) == "SingleEdge"){
				$payload[$edge.getName()] = $edge.getTargetVertex();
			}
			if(get_class($edge) == "HyperEdge"){
				$payload += $edge->getTargetVertices();
			}
		}
		return $payload;
	}
	
	public function getAllNeighboursByEdge($myEdgeName){
		$payload = array();
		foreach($this->edges as $edge){
			if(get_class($edge) == "SingleEdge"){
				if($edge.getName() == $myEdgeName){
					$payload[$edge.getName()] = $edge.getTargetVertex();	
				}
			}
			if(get_class($edge) == "HyperEdge"){
				if($edge.getName() == $myEdgeName){
					$payload += $edge->getTargetVertices;	
				}
			}
		}
		return $payload;
	}
	
	public function getBinaryPropertyByID($myBinaryPropertyID){
		return $this->binaryPropertyList[$myBinaryPropertyID];
	}
	
		
	
	
}

?>