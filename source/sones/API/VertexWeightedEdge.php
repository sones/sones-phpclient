<?php

include_once "Vertex.php";

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

/** @author Michael Schilonka
 */
class VertexWeightedEdge extends Vertex {

    private $Weight = null;
    private $TypeName = null;

    public function __construct($myAttributes, $myWeight, $myTypeName) {
        parent::__construct($myAttributes);

        $this->Weight = $myWeight;
        $this->TypeName = $myTypeName;
    }

    public function getWeight() {
        return $this->Weight;
    }

    public function setWeight($myWeight) {
        $this->Weight = $myWeight;
    }

    public function getTypeName() {
        return $this->TypeName;
    }

    public function setTypeName($myTypeName) {
        $this->TypeName = $myTypeName;
    }

}

?>