<?php

include_once "../source/sones/API/VertexWeightedEdge.php";

include_once "../source/sones/DataStructures/ObjectRevisionID.php";

include_once "../source/sones/DataStructures/ObjectUUID.php";

include_once "../source/sones/API/Edge.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DemoExample
 *
 * @author Michael Schilonka
 */
class DemoExample {

    public function printQueryResult($myResult) {
        echo "<pre>";
        // gql string
        echo "QueryString: " . $myResult->getQueryString() . "<br/>";
        // result type
        echo "ResultType: <b>" . $myResult->getResultType() . "</b><br/>";
        //duration in ms
        echo "Duration: " . $myResult->getDuration() . "<br/>";
        //warnings
        echo "Warnings:<br/>";
        $Warnings = $myResult->getWarnings();
        foreach ($Warnings as $warning) {
            echo $warning->getID() . " " . $warning->getMessage() . "<br/>";
        }
        echo "<br/>";
        //errors
        echo "Errors:<br/>";
        $Errors = $myResult->getErrors();
        foreach ($Errors as $Error) {
            echo $Error->getID() . " " . $Error->getMessage() . "<br/>";
        }
        echo "Vertices:<br/>";
        $Vertices = $myResult->getVertices();
        foreach ($Vertices as $vertex) {
            $this->printVertex($vertex, 1);
        }
    }

    public function printVertex($myVertex, $depth) {
        $tabs = "";

        for ($index = 0; $index < $depth; $index++) {
            $tabs = $tabs . "&nbsp;&nbsp;";
        }

        $Attributes = $myVertex->getAttributes();

        foreach ($Attributes as $att) {

            if ($att instanceof Edge) {

                echo $tabs . array_search($att, $Attributes) . ": " . "<br/>";
                $targetVertices = $att->getTargetVertex();
                foreach ($targetVertices as $v) {
                    $this->printVertex($v, $depth + 1);
                }
            } elseif ($att instanceof ObjectUUID) {

                echo $tabs . array_search($att, $Attributes) . ": " . $att->getUUID() . "<br/>";
            } elseif ($att instanceof ObjectRevisionID) {

                echo $tabs . array_search($att, $Attributes) . ": " . $att->getObjectUUID() . "<br/>";
            } else {
                echo $tabs . array_search($att, $Attributes) . ": " . $att . "<br/>";
            }
        }

       
    }

}

?>
