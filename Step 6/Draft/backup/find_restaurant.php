<!DOCTYPE html>
<html>
<head>
	<title>Find Restaurant</title>
</head>
<body>
    <?
        //Connection Constants
        define('DB_name', 'cs340_dunnbrit');
        define('DB_user', 'cs340_dunnbrit');
        define('DB_password', '1967');
        define('DB_host', 'classmysql.engr.oregonstate.edu');

        //Connect
        $link = mysql_connect(DB_host,DB_user,DB_password);

        //If connection fails
        if(!$link){
            die("Connection Error:".mysql_error());
        }

        //Connect to database
        $db_selected = mysql_select_db(DB_name,$link);  
    ?>
	<h1>Find Restaurant</h1>
	<form action="find_restaurant.php" method="POST">
		<fieldset>
    		By Name:<input type="text" name="name">
            <br>
            By Zip Code:<input type="number" name="zip">
            <br>
            By City:<input type="text" name="city">
            <br>          
            <input type="submit" name="find_restaurant">
        </fieldset>
    </form>

    <form action="find_restaurant.php" method="POST">
        <fieldset>
                By Cuisine:
            <?php

                //Code from https://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database

                $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

                $result = $conn->query("select id, type from cuisine");

                echo "<select name='cuisineID'>";

                while ($row = $result->fetch_assoc()) {

                    unset($id, $name);
                    $id = $row['id'];
                    $name = $row['type']; 
                    echo '<option value="'.$id.'">'.$name.'</option>';
                }

                echo "</select>";

            ?>  
            <input type="submit" name="find_restaurant_by_cuisine">
        </fieldset>
    </form>

    <h2>Matching Restaurants</h2>
    <?      
        //Query to get restaurant table
        $sql = "SELECT restaurants.name , location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type , restaurants.rating
                FROM restaurants
                INNER JOIN location ON location.id = restaurants.locationID
                INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID
                WHERE restaurants.name LIKE '%$_POST[name]%' OR location.zip = '$_POST[zip]' OR location.city = '$_POST[city]' OR restaurants.cuisineID = '$_POST[cuisineID]' ";
        
        $result = mysql_query($sql,$link);  

        print "<table border = 1>\n";

        //Get field names
        print "<tr>\n";
        while ($field = mysql_fetch_field($result)){
            print " <th>$field->name</th>\n";
        }
        print "</tr>\n\n";

        //Get rows
        while($row = mysql_fetch_assoc($result)){
            print "<tr>\n";
            //for each field
            foreach($row as $col=>$val){
                print "<td>$val</td>\n";
            }
            print "</tr>\n\n";
        }

        print "</table>\n";

    ?>
    
 


  


</body>
</html>