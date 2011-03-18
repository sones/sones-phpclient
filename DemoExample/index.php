<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
         <?php include("Head.php"); ?>
    </head>
    <body>
        <form action="CreateDatabase.php" style="padding: 20px">
            <li>Service Address:&nbsp&nbsp<input type="text" name="host" value="localhost"/><br/></li>
            <li>Username:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="username" value="test"/><br/></li>
            <li>Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="password"  value="test"/><br/></li>
            
            <br/><input type="submit" name="create" value=" Create Database Example -->>"/>
            <pre>We're going to build up an test database. This may take a few seconds!</pre>
        </form>
    </body>
</html>
