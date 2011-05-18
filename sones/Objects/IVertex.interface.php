<?php
include_once 'IGraphElement.interface.php';

interface IVertex extends IGraphElement{
	
	public function hasEdge($myEdgeName);
	
	public function getHyperEdges();
	
	public function getSingleEdges();
	
	public function getHyperEdge($myHyperEdgeName);
	
	public function getSingleEdge($mySingleEdgeName);
	
	public function getAllEdges();
	
	public function getBinaryPropertyByID($myBinaryPropertyID);
	
	public function getBinaryProperties();
	
	public function getAllNeighbours();
	
	public function getAllNeighboursByEdge($myEdgeName);
	
}

?>