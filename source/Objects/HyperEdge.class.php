<?php
/*
 * sones GraphDB(v2.0) - OpenSource Graph Database - http://www.sones.com
 * Copyright (C) 2007-2010 sones GmbH
 *
 * This file is part of sones GraphDB(v2.0) Community Edition.
 *
 * sones GraphDB OSE is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, version 3 of the License.
 *
 * sones GraphDB OSE is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with sones GraphDB OSE. If not, see <http://www.gnu.org/licenses/>.
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