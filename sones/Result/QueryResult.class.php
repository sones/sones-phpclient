<?php

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
