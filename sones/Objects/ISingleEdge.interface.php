<?php

include_once "IEdge.interface.php";

interface ISingleEdge extends IEdge{
	
	public function getTargetVertex();
	
}

?>