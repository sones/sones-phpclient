<?php

interface IGraphElement{
	
	public function getPropertyByID($myPropertyID);
	
	public function hasProperty($myPropertyID);
	
	public function getProperties();
}
?>