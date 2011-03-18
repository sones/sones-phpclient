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
class QueryResult {

    private $ResultType = null;
    private $QueryString = null;
    private $Errors = null;
    private $Warnings = null;
    private $Vertices = null;
    private $Duration = null;

    public function __construct($myVertices, $myWarnings, $myErrors, $myQueryString, $myResultType, $myDuration) {
        $this->Vertices = $myVertices;
        $this->Errors = $myErrors;
        $this->Warnings = $myWarnings;
        $this->QueryString = $myQueryString;
        $this->ResultType = $myResultType;
        $this->Duration = $myDuration;
    }

    public function getResultType() {
        return $this->ResultType;
    }

    public function getErrors() {
        return $this->Errors;
    }

    public function getWarnings() {
        return $this->Warnings;
    }

    public function getQueryString() {
        return $this->QueryString;
    }

    public function getDuration() {
        return $this->Duration;
    }

    public function getVertices() {
        return $this->Vertices;
    }

    public function setVertices($myVertices) {
        $this->Vertices = $myVertices;
    }

}

?>
