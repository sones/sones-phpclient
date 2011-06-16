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