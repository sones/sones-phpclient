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
include_once "ObjectUUID.php";

/**
 * An ObjectRevisionID is the identifier for an object revision.
 * @author Michael Schilonka
 */
class ObjectRevisionID {
    /*
     * private members
     */

    private $TimeStamp = null;
    private $ObjectUUID = null;

    public function __construct($myObjectRevisionID) {


        //TODO: find a way to parse TimeStamp
        $revisionID_Timestamp = substr($myObjectRevisionID, 0, strpos($myObjectRevisionID, "("));
        $revisionID_UUID = substr($myObjectRevisionID, (strlen($revisionID_Timestamp) + 1), (strlen($myObjectRevisionID) - 1));


        $this->TimeStamp = $revisionID_Timestamp;

        $this->ObjectUUID = new ObjectUUID($revisionID_UUID);
    }

    public function getTimestamp() {
        return $this->TimeStamp;
    }

    public function getObjectUUID() {
        return $this->TimeStamp;
    }

}

?>
