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
include_once "Result/QueryResult.php";
include_once "API/Edge.php";
include_once "API/Vertex.php";
include_once "DataStructures/ObjectUUID.php";
include_once "DataStructures/ObjectRevisionID.php";
include_once "Errors/UnspecifiedWarning.php";
include_once "Errors/UnspecifiedError.php";
include_once "RESTClient/RestCredentials.php";
include_once "RESTClient/GQLRestRequest.php";
include_once "API/VertexGroup.php";
include_once "API/VertexWeightedEdge.php";

/** @author Michael Schilonka
 */
class GraphDBClient {
    /*
     * Private members
     */

    private $GQLUriTemplate = "gql?";
    private $Host = "";
    private $Username = "";
    private $Password = "";
    private $Port = null;
    private $uri = null;

    /**
     * Create a new Instance of PHP GraphDB Client
     * 
     * @param myUri the URI of the GraphDB Service
     * @param myUserName the username for authentication
     * @param myPassword the password for authentication
     * @param myPort the Port of the GraphDB Service, default is 9975
     */
    public function __construct($myUri, $myUsername, $myPassword, $myPort = "9975") {
        $this->Host = $myUri;
        $this->Username = $myUsername;
        $this->Password = $myPassword;
        $this->Port = $myPort;

        $this->SetUriFormat($myUri, $myPort, $this->GQLUriTemplate);
    }

    /**
     * Generate the FQDN for the service
     * 
     */
    private function SetUriFormat($Host, $Port, $GQLUriTemplate) {
        $this->uri = "http://" . $Host . ":" . $Port . "/" . $GQLUriTemplate;
    }

    /**
     * Insert a GQL Command to the GraphDB instance.
     * @param myGQLQuery the Query to insert
     * @return QueryResult Object if the Response was Successful - null if not!
     */
    public function InsertQuery($myGQLQuery) {
        $query_string = urlencode($myGQLQuery);
        //execute the request
        $result = new GQLRestRequest($this->uri . $query_string, new RestCredentials($this->Username, $this->Password), "application/xml");
        $tem = $result->getResponseBody();
        //build the result
        if ($tem != false) { //if false, the connection refused
            $xml = simplexml_load_string($tem); //parse the response string with simplexml
            if ($xml) {
                //Meta
                $queryString = "" . $xml->graphdb->queryresult->query;
                $queryResult = "" . $xml->graphdb->queryresult->result;
                $queryDuration = "" . $xml->graphdb->queryresult->duration . "ms";

                if ($xml->graphdb->queryresult->errors->children() != null) {
                    //Errors
                    $queryErrors = $this->readErrors($xml->graphdb->queryresult->errors);
                }
                if ($xml->graphdb->queryresult->warnings->children() != null) {
                    //Warnings
                    $queryWarnings = $this->readWarning($xml->graphdb->queryresult->warnings);
                }
                if ($xml->graphdb->queryresult->results->children() != null) {
                    //Results
                    $queryVertices = $this->readVertices($xml->graphdb->queryresult->results);
                }
            }
            return new QueryResult($queryVertices, $queryWarnings, $queryErrors, $queryString, $queryResult, $queryDuration);
        } else {
            return false; //returns false if the connection refused
        }
    }

    /**
     * Reads all errors
     *
     */
    private function readErrors($myErrorNodes) {
        $error_List = array();
        $i = 0;
        foreach ($myErrorNodes->children() as $error) {

            $attr = $error->attributes();
            $id = "" . $attr->code;
            $message = "" . $error;
            $error_List[$i] = new UnspecifiedError($id, $message);


            $i += 1;
        }

        return $error_List;
    }

    /**
     * Reads all warnings
     *
     */
    private function readWarning($myWarningNodes) {

        $warning_List = array();
        $i = 0;
        foreach ($myWarningNodes->children() as $warning) {

            $attr = $warning->attributes();
            $id = $attr["code"];
            $message = "" . $warning;
            $warning_List[$i] = new UnspecifiedWarning($id, $message);
            $i += 1;
        }

        return $warning_List;
    }

    /**
     * Reads all vertices
     *
     */
    private function readVertices($myVertexNodes) {
        $i = 0;
        $payLoad = array();
        foreach ($myVertexNodes->children() as $Vertex) {

            $payLoad["Vertex" . $i] = $this->readVertex($Vertex);

            $i += 1;
        }
        return $payLoad;
    }

    /**
     * Parse correct attributes
     *
     */
    private function parseAttribute($myAttributeType, $myAttributeValue) {

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

        return $myAttributeValue;
    }

    private function generateEdgeContent($myEdge) {

        $targetVertices = array();
        $i = 0;
        foreach ($myEdge->vertex as $target) {
            $targetVertices["Vertex" . $i] = $this->readVertex($target);
            $i += 1;
        }
        return $targetVertices;
    }

    /**
     * Reads a entity of an vertex
     *
     */
    private function readVertex($myVertex) {

        $payLoad = array();
        foreach ($myVertex as $attribute) {

            $attributeName = "" . $attribute["name"];
            $attributeType = "" . $attribute["type"];
            $attributeValue = "" . $attribute;
            $payLoad["$attributeName"] = $this->parseAttribute($attributeType, $attributeValue);
        }


        foreach ($myVertex->edge as $edge) {

            $edgeName = "" . $edge["name"];
            $edgeType = "" . $edge["type"];
            $targetVertices = $this->generateEdgeContent($edge);

            $tmpEdge = new Edge(null, $targetVertices, null);
            $tmpEdge->setEdgeTypeName($edgeType);



            $payLoad["$edgeName"] = $tmpEdge;
        }


        $edgelabel = $myVertex->edgelabel;
        if ($edgelabel != null) {

            $edgeident = $edgelabel->attribute["name"];
            if ($edgeident != null) {
                if ($edgeident == "weight") {
                    return new VertexWeightedEdge($payLoad, $edgelabel, $edgelabel->attribute["type"]);
                } elseif ($edgeident == "group") {
                    return new VertexGroup($payLoad, $this->readVertices($edgelabel));
                }
            }
        }

        return new Vertex($payLoad);
    }

    /**
     * Returns the Uri of the specified Host.
     * 
     * @return String
     */
    public function getHost() {
        return $this->Host;
    }

}

?>
