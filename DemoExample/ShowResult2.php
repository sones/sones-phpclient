<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php include("Head.php"); ?>
       
    </head>
    <body>
        <form action ="ShowResult3.php">
            <input type="submit" value="Insert some data -->>"

        </form>
        <?php
        include_once 'DemoExample.php';
        include_once "../source/sones/GraphDBClient.php";
        
            echo"<h2> 2) Try a group statement </h2>";
            $myGraphClient = unserialize($_SESSION["Client"]);

            $result = $myGraphClient->InsertQuery("FROM User u SELECT u.Age group by u.Age");
            $demo = new DemoExample();

            echo "<table border='0'>";
            echo "<tr><td style='vertical-align:top; text-align:left;'>";
            $demo->printQueryResult($result);
            echo "</td><td style='vertical-align:top; text-align:left;'>";
            echo "<pre>
            \$myGraphClient = unserialize(\$_SESSION['Client']);
            \$result = \$myGraphClient->InsertQuery('FROM User u SELECT u.Age group by u.Age');
            \$demo = new DemoExample();'
            \$demo->printQueryResult(\$result);</pre></td></tr></table>";



        ?>
    </body>
</html>
