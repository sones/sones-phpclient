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
include_once "Objects/HyperEdge.class.php";

include_once "Objects/SingleEdge.class.php";

include_once "Objects/BinaryProperty.class.php";

include_once "Objects/Vertex.class.php";

include "Objects/Property.class.php";

include_once "Result/QueryResult.class.php";
include_once "RESTClient/RestCredentials.class.php";
include_once "RESTClient/GQLRestRequest.class.php";

class GraphDBClient{
	
    private $GQLUriTemplate = "gql?";
    private $Host = "";
    private $Username = "";
    private $Password = "";
    private $Port = null;
    private $Uri = null;
	
	public function __construct($myUri, $myUsername, $myPassword, $myPort = "9975") {
        $this->Host = $myUri;
        $this->Username = $myUsername;
        $this->Password = $myPassword;
        $this->Port = $myPort;

        $this->Uri = "http://" . $myUri . ":" . $myPort . "/" . $this->GQLUriTemplate;
    }
    
    public function Query($myGQLQuery){
    	$query_string = urlencode($myGQLQuery);
        //execute the request
        $result = new GQLRestRequest($this->Uri . $query_string, new RestCredentials($this->Username, $this->Password), "application/xml");
        $tem = $result->getResponseBody();
        //build the result
        if ($tem != false) {
        	$xdoc = new DOMDocument;
        	$xdoc->loadXML($tem);
        	$xmlschema = '../sones/QueryResultSchema.xsd';
        	if($xdoc->schemaValidate($xmlschema)){
        		$valideXML = true;
        	}
                else{
                        $valideXML = false;
                }
        	$xml = simplexml_load_string($tem); //parse the response string with simplexml to xml document
        	 if ($xml){
                    $language = (string)$xml->Query->attributes()->Language;
                    $querystring = (string)$xml->Query->attributes()->Value;
                    $resulttype = (string)$xml->Query->attributes()->ResultType;
                    $duration = (string)$xml->Query->attributes()->Duration;
                    $verticescount = (string)$xml->Query->attributes()->VerticesCount;

                    $errormessage = "";
                    if($resulttype == "Failed"){
                        $errormessage = (string)$xml->Query->attributes()->Error;
                    }

                    $vertexviews = $xml->VertexViews;
                    return new QueryResult($querystring, $language, $resulttype, $duration, $errormessage, $this->ParseVertexViews($vertexviews),$valideXML);
        	 }
        }
        return null;
    }

    private function ParseVertexViews($myVertexViewsNode){
         $i = 0;
        $payLoad = array();
        foreach ($myVertexViewsNode->children() as $VertexView) {
            $payLoad["Vertex" . $i] = $this->ParseVertexView($VertexView);
            $i += 1;
        }
        return $payLoad;

    }

    private function ParseVertexView($myVertexView){

        $properties = $this->ParsePropertyList($myVertexView->Properties);

        $binproperties = $this->ParsBinaryProperties($myVertexView->BinaryProperties);

        $edges = $this->ParseEdge($myVertexView->Edges);

        return new Vertex($properties, $binproperties, $edges);
    }
	

    public function ParsePropertyList($myPropertiesNode) {
 
        $payLoad = array();
        foreach ($myPropertiesNode->children() as $Property) {
            $id = (string)$Property->ID;
            $type = (string)$Property->Type;
            $value = $this->ParseAttribute($type, (string)$Property->Value);
            $payLoad[$id] = new Property($id, $type, $value);
        }
        return $payLoad; 
    }

    public function ParsBinaryProperties($myBinPropertiesNode) {

        $payLoad = array();
        foreach ($myBinPropertiesNode->children() as $BinProperty) {
            $id = (string)$BinProperty->ID;
            $content = (string)$BinProperty->Content;
            $payLoad[$id] = new BinaryProperty($id, $content);
        }
        return $payLoad;
    }
    
     public function ParseEdge($myEdgesNode) {

        $payLoad = array();
        foreach ($myEdgesNode->children() as $edge) {

            $type = (string)$edge->attributes("xsi",true)->type;
           if($type == "HyperEdgeView"){
                $name = (string)$edge->Name;
                $payload[$name] = $this->ParseHyperEdge($edge);
           }
           else if($type == "SingleEdgeView"){
                $name = (string)$edge->Name;
                $payload[$name] = $this->ParseSingleEdge($edge);
           }
        }
        return $payLoad;
    }

    public function ParseHyperEdge($myHyperEdgeNode) {
      $name = (string)$myHyperEdgeNode->Name;
      $edgeProperties = $this->ParsePropertyList($myHyperEdgeNode->Properties);

      $i = 0;
      $payload = array();
      foreach ($myHyperEdgeNode->children() as $singleedge) {
          if($singleedge->getName() == "SingleEdge"){
             $id = (string)$singleedge->Name;
          $payLoad[$i] = $this->ParseSingleEdge($singleedge);
          $i += 1;  
          }
      }
      return new HyperEdge($name, $edgeProperties, $payLoad);
    }

    public function ParseSingleEdge($mySingleEdgeNode) {
      $name = (string)$mySingleEdgeNode->Name;
      $edgeProperties = $this->ParsePropertyList($mySingleEdgeNode->Properties);
      $targetvertex = $this->ParseVertexView($mySingleEdgeNode->TargetVertex);
      return new SingleEdge($name, $edgeProperties, $targetvertex);
    }




















    private function ParseAttribute($myAttributeType, $myAttributeValue) {

        if (("Double" == $myAttributeType) || ("Float" == $myAttributeType)) {
            settype($myAttributeValue, "float");
            return $myAttributeValue;
        }

        if (("Boolean" == $myAttributeType) || ("Bool" == $myAttributeType)) {
            settype($myAttributeValue, "bool");
            return $myAttributeValue;
        }

        if (("Integer" == $myAttributeType) || ("Int64" == $myAttributeType) || ("Int32" == $myAttributeType) || ("UInt64" == $myAttributeType) || ("UInt32" == $myAttributeType)) {
            settype($myAttributeValue, "int");
            return $myAttributeValue;
        }

        if ("ObjectUUID" == $myAttributeType) {
            return new ObjectUUID($myAttributeValue);
        }

        if ("ObjectRevisionID" == $myAttributeType) {
            return new ObjectRevisionID($myAttributeValue);
        }

        if ("DateTime" == $myAttributeType) {

            //Hack
            $date = new DateTime($myAttributeValue);
            $date->format("dd.MM.YYYY hh:mm:ss");
            return $date;
        }

        if (strpos($myAttributeType,"ListCollectionWrapper") !== false) {
            $pattern = "/\[(.*?)\]/i";
            preg_match_all($pattern, $myAttributeValue, $matches);
            return $matches[1];
        }



        return $myAttributeValue;
    }
}

?>