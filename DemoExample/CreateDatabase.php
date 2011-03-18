<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php include("Head.php"); ?>

    </head>
    <body>
        <form action ="ShowResult.php">
            <input type="submit" value="Select user id's and user-data (default depth 0) -->>"

        </form>
        <?php

        include_once "../source/sones/GraphDBClient.php";
        



        $_SESSION["Host"] = $_GET["host"];
        $_SESSION["Username"] = $_GET["username"];
        $_SESSION["Password"] = $_GET["password"];

        $myGraphClient = new GraphDBClient($_SESSION["Host"], $_SESSION["Username"], $_SESSION["Password"]);


        
        $_SESSION["Client"] = serialize($myGraphClient);
        $myGraphClient->InsertQuery("CREATE VERTEX Car ATTRIBUTES (String Color, Integer HP, Integer Weight)");
        $myGraphClient->InsertQuery("CREATE VERTEX User EXTENDS DBObject ATTRIBUTES (Integer UserID, User BestFriend, String Name, Integer Age, LIST<Integer> FavouriteNumbers, SET<User> Friends, SET<User> Enemies, Car Car) INDICES (Age)");
        $myGraphClient->InsertQuery("ALTER VERTEX Car ADD BACKWARDEDGES (User.Car IsCarOf)");
	$myGraphClient->InsertQuery("ALTER VERTEX User ADD BACKWARDEDGES (User.Friends IsFriendOf)");
	$myGraphClient->InsertQuery("INSERT INTO Car VALUES (Color = 'red', HP = 75, Weight = 1000)");
	$myGraphClient->InsertQuery("INSERT INTO Car VALUES (Color = 'white', HP = 120, Weight = 1400)");
	$myGraphClient->InsertQuery("INSERT INTO Car VALUES (Color = 'black', HP = 300, Weight = 1500)");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Fry', UserID = 12, Age = 22, Car = REF ( Color = 'red' ))");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Lila', UserID = 13, Age = 22, Car = REF ( HP = 120 ))");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Bender', UserID = 14, Age = 300, Car = REF ( Weight = 1500 ))");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Farnsworth', UserID = 15, Age = 129)");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Amy', UserID = 18, Age = 17)");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Hermes', UserID = 16)");
	$myGraphClient->InsertQuery("INSERT INTO User VALUES (Name = 'Zoidberg', UserID = 17)");
	$myGraphClient->InsertQuery("UPDATE User SET (Friends = SETOF (UserID = 13, UserID = 14, UserID = 15)) WHERE UserID = 12");
	$myGraphClient->InsertQuery("UPDATE User SET (Friends = SETOF (UserID = 12, UserID = 14), Enemies = SETOF (UserID = 18)) WHERE UserID = 13");
	$myGraphClient->InsertQuery("UPDATE User SET (Friends = SETOF (UserID = 12)) WHERE UserID = 14");
	$myGraphClient->InsertQuery("UPDATE User SET (Friends = SETOF (UserID = 16)) WHERE UserID = 15");
	$myGraphClient->InsertQuery("UPDATE User SET (Friends = SETOF (UserID = 15)) WHERE UserID = 16");
	$myGraphClient->InsertQuery("UPDATE User SET (Friends = SETOF (UserID = 12, UserID = 13, UserID = 14, UserID = 15, UserID = 16)) WHERE UserID = 17");
	$myGraphClient->InsertQuery("CREATE VERTEX Tag ATTRIBUTES (String Name, Integer Hits, SET<WEIGHTED(Double, DEFAULT=1, SORTED=DESC)<Tag>> RelatedTags, LIST<String> Urls)");
	$myGraphClient->InsertQuery("CREATE INDEX IDX_Tag ON TYPE Tag ( Name )");
	$myGraphClient->InsertQuery("INSERT INTO Tag VALUES (Name = 'Summer')");
	$myGraphClient->InsertQuery("INSERT INTO Tag VALUES (Name = 'Sun', RelatedTags = SETOF(Name = 'Summer':(0.5)))");
	$myGraphClient->InsertQuery("INSERT INTO Tag VALUES (Name = 'Water')");
	$myGraphClient->InsertQuery("INSERT INTO Tag VALUES (Name = 'Diving')");
	$myGraphClient->InsertQuery("INSERT INTO Tag VALUES (Name = 'Relaxing')");


        echo "<h2>Generate Test Database Complete!</h2>";
     
        
        echo "<table border='0'>";
        echo "<tr><td style='vertical-align:top; text-align:left;'>";
        echo "<pre>

First of all we have to include the php connector for the GraphDB,
then we create an instance of that

Those GQL commands were inserted:
1) Create a Vertex Type 'Car which has the following attributes:
   - Color of basic-type String
   - horse power (HP) of basic-type Integer
   - a weight of basic-type Integer

2) Create a Vertex Type 'User'which has the following attributes:
   - an UserID of basic-type Integer
   - an Edge to another User (reference) which is his best friend
   - the user's name of basic-type String
   - the user's age of basic-type Integer
   - a list of favourite numbers (oO) the list items are of basic-type Double

3) Add some backwardedges to the defnied vertex-types
   - 'IsCarOf' itentifies a user's car
   - 'IsFriendOf' identifies users who have this user as friend

4) Add some car data.

5) Add some users
   - we use some futurama chars as an descriptive example

6) Create the relations between the futurama chars

7) Create a weighted graph of vertex type 'Tag'

8) Create an index on the 'Name'-attribute

9) Insert some weighted data

            </pre>";

        echo "</td><td style='vertical-align:top; text-align:left;'>";

        echo" <pre>
include_once '../sones/GraphDBClient.php';


\$myGraphClient = new GraphDBClient(\$Host, \$Username, \$Password);

1) 2)
\$myGraphClient->InsertQuery('CREATE VERTEX Car ATTRIBUTES (String Color, Integer HP, Integer Weight)');
\$myGraphClient->InsertQuery('CREATE VERTEX User EXTENDS DBObject ATTRIBUTES (Integer UserID, User BestFriend, String Name, Integer Age, LIST<Integer> FavouriteNumbers, SET<User> Friends, SET<User> Enemies, Car Car) INDICES (Age)');

3)
\$myGraphClient->InsertQuery('ALTER VERTEX Car ADD BACKWARDEDGES (User.Car IsCarOf)');
\$myGraphClient->InsertQuery('ALTER VERTEX User ADD BACKWARDEDGES (User.Friends IsFriendOf)');

4)
\$myGraphClient->InsertQuery('INSERT INTO Car VALUES (Color = 'red', HP = 75, Weight = 1000)');
\$myGraphClient->InsertQuery('INSERT INTO Car VALUES (Color = 'white', HP = 120, Weight = 1400)');
\$myGraphClient->InsertQuery('INSERT INTO Car VALUES (Color = 'black', HP = 300, Weight = 1500)');

5)
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Fry', UserID = 12, Age = 22, Car = REF ( Color = 'red' ))');
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Lila', UserID = 13, Age = 22, Car = REF ( HP = 120 ))');
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Bender', UserID = 14, Age = 300, Car = REF ( Weight = 1500 ))');
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Farnsworth', UserID = 15, Age = 129)');
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Amy', UserID = 18, Age = 17)');
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Hermes', UserID = 16)');
\$myGraphClient->InsertQuery('INSERT INTO User VALUES (Name = 'Zoidberg', UserID = 17)');

6)
\$myGraphClient->InsertQuery('UPDATE User SET (Friends = SETOF (UserID = 13, UserID = 14, UserID = 15)) WHERE UserID = 12');
\$myGraphClient->InsertQuery('UPDATE User SET (Friends = SETOF (UserID = 12, UserID = 14), Enemies = SETOF (UserID = 18)) WHERE UserID = 13');
\$myGraphClient->InsertQuery('UPDATE User SET (Friends = SETOF (UserID = 12)) WHERE UserID = 14');
\$myGraphClient->InsertQuery('UPDATE User SET (Friends = SETOF (UserID = 16)) WHERE UserID = 15');
\$myGraphClient->InsertQuery('UPDATE User SET (Friends = SETOF (UserID = 15)) WHERE UserID = 16');
\$myGraphClient->InsertQuery('UPDATE User SET (Friends = SETOF (UserID = 12, UserID = 13, UserID = 14, UserID = 15, UserID = 16)) WHERE UserID = 17');

7)
\$myGraphClient->InsertQuery('CREATE VERTEX Tag ATTRIBUTES (String Name, Integer Hits, SET<WEIGHTED(Double, DEFAULT=1, SORTED=DESC)<Tag>> RelatedTags, LIST<String> Urls)');

8)
\$myGraphClient->InsertQuery('CREATE INDEX IDX_Tag ON TYPE Tag ( Name )');

9)
\$myGraphClient->InsertQuery('INSERT INTO Tag VALUES (Name = 'Summer')');
\$myGraphClient->InsertQuery('INSERT INTO Tag VALUES (Name = 'Sun', RelatedTags = SETOF(Name = 'Summer':(0.5)))');
\$myGraphClient->InsertQuery('INSERT INTO Tag VALUES (Name = 'Water')');
\$myGraphClient->InsertQuery('INSERT INTO Tag VALUES (Name = 'Diving')');
\$myGraphClient->InsertQuery('INSERT INTO Tag VALUES (Name = 'Relaxing')');

</pre>";
        echo "</td></tr></table>";


        

        ?>
    </body>
</html>
