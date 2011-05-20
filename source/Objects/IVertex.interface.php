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