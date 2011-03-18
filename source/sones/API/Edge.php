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
include_once "IEdge.php";
include_once "DBObject.php";

/** @author Michael Schilonka
 */
class Edge extends DBObject implements IEdge {
    /*
     * Private members
     */

    private $SourceVertex;
    private $TargetVertex;
    private $TargetVertices;
    private $EdgeTypeName;

    public function __construct($mySourceVertex = null, $myTargetVertex = null, $myAttributes = null) {
        parent::__construct();



        $this->SourceVertex = $mySourceVertex;
        $this->TargetVertex = $myTargetVertex;

        if ($myAttributes != null) {
            $this->Attributes = $myAttributes;
        }
        return $this;
    }

    /*
     * Getter / Setter
     */

    public function getEdgeTypeName() {
        return $this->EdgeTypeName;
    }

    public function getSourceVertex() {
        return $this->SourceVertex;
    }

    public function getTargetVertices() {
        return $this->TargetVertices;
    }

    public function setEdgeTypeName($myEdgeTypeName) {
        $this->EdgeTypeName = $myEdgeTypeName;
    }

    public function getTargetVertex() {
        return $this->TargetVertex;
    }

}

?>
