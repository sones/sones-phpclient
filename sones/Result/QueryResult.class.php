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

class QueryResult {

    private $vertexViews = array();

    private $querystring;

    private $querylanguage;

    private $duration;

    private $errormessage;

    private $resulttype;

    private $valideXML;

    public function  __construct($myQuerString,$myQueryLanguage,$myResultType,$myDuration,$myErrorMessage,$myVertexViewList,$valideXML) {
       $this->vertexViews = $myVertexViewList;
       $this->duration = $myDuration;
       $this->errormessage = $myErrorMessage;
       $this->querystring = $myQuerString;
       $this->querylanguage = $myQueryLanguage;
       $this->resulttype = $myResultType;
       $this->valideXML = $valideXML;
    }


    public function wasXMLValide(){
        return $this->valideXML;
    }

    public function getVertexViewList(){
        return $this->vertexViews;
    }

    public function getQueryString(){
        return $this->querystring;
    }
    
    public function getQueryLanguage() {
        return $this->querylanguage;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getErrorMessage() {
        return $this->errormessage;
    }

    public function getResultType() {
        return $this->resulttype;
    }

}
?>
