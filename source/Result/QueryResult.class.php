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
