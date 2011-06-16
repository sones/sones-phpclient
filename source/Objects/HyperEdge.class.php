<?php
/*
* sones GraphDB PHP Client Library 
* Copyright (C) 2007-2011 sones GmbH - http://www.sones.com
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2.1 of the License, or (at your option) any later version.
* 
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.
* 
* You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*/

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