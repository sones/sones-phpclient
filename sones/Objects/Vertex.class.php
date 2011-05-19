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