<?php

include_once "IEdge.interface.php";

interface IHyperEdge extends IEdge{
	
	public function getEdges();
	
	public function getTargetVertices();
	
}
?>