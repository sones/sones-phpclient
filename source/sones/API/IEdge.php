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

/** @author Michael Schilonka
 */
interface IEdge {
    /*
     * getter
     */
    public function getUUID();

    public function getType();

    public function getEdition();

    public function getRevisionID();

    public function getComment();

    public function getEdgeTypeName();

    public function getSourceVertex();

    public function getTargetVertex();

    public function getTargetVertices();

    /*
     * setter
     */

    public function setUUID($myObjectUUID);

    public function setType($myObjectType);

    public function setEdition($myEdition);

    public function setRevisionID($myRevisionID);

    public function setComment($myCommend);

    public function setEdgeTypeName($myEdgeTypeName);
}

?>
