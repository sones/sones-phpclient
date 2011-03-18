<?php

/*
 * sones GraphDB - OpenSource Graph Database - http://www.sones.com
 * Copyright (C) 2007-2010 sones GmbH
 *
 * This file is part of sones GraphDB OpenSource Edition.
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
include_once "IVertex.php";
include_once "DBObject.php";

/** @author Michael Schilonka
 */
class Vertex extends DBObject implements IVertex {

    public function __construct($myAttributes) {
        parent::__construct();
        $this->Attributes = $myAttributes;
    }

    /*
     * Properties	
     */

    public function hasProperty($myPropertyName) {
        $property = $this->getProperty($myPropertyName);

        if ($property == null) {
            return false;
        }

        if ($property instanceof Vertex) {
            return false;
        }

        if ($property instanceof Iterator) {
            return false;
        }

        return true;
    }

    public function getProperty($myPropertyName) {
       return $this->Attributes[$myPropertyName];   
            
    }

    public function hasEdge($myEdgeName) {
        if ($this->getEdge($myEdgeName)) {
            return true;
        }
        return false;
    }

    public function getEdge($myEdgeName) {
        return $this->getProperty($myEdgeName);
    }

    public function getNeighbour($myEdgeName) {
        $targetvertices = $this->getNeighbours($myEdgeName);

        if ($targetvertices != null) {
            foreach ($targetvertices as $value) {
                return $value;
            }
        }
        return null;
    }

    public function getNeighbours($myEdgeName) {
        $tmp = null;

        if (($tmp = $this->Attributes[$myEdgeName]) instanceof Edge) {
            return $tmp->getTargetVertices();
        }
        return null;
    }

    
}

?>
