<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <?php include '/Head.php'; ?>
    <body>

        <form action="">
            <pre style="margin:15px auto auto 15px">Just enter any GQL Statement below - for help click <a href="http://developers.sones.de/category/gql/">sones Cheatsheet</a></pre >
            <input type="text" id="gql" size="100" name="q" style="margin:15px auto auto 15px"/>
            <input type="submit" value="Submit Query" style="margin:15px auto auto 15px"><br/>
        </form>

        <?php
            include_once '../source/GraphDBClient.class.php';

            $query = $_GET["q"];
            if($query !== null){
             $GraphDSClient = new GraphDBClient("localhost", "test", "test");
             $QueryResult = $GraphDSClient->Query($query);

             if($QueryResult !== null){
                $i = 0;
                echo "<div style='width: 800px;'>";
                    foreach($QueryResult->getVertexViewList() as $Vertex){
                         echo "<b>Properties of Vertex ".$i.":</b>";
                         $i++;
                             foreach($Vertex->getProperties() as $Property){
                                echo "<div style='border:solid 1px; margin:5px; display:block;'>";
                                var_dump($Property);
                                echo "</div>";
                                }
                    }
                    echo "</div>";
             }
             else{
                echo "<b>Service unavailable!</b>";
             }

             
             
           }
            
            
        ?>



    </body>
</html>
