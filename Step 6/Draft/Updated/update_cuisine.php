<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="form_table_nav.css">
</head>
<body>
    <ul>
        <li>
            <a href="create_account.php">Create Customer Profile</a>
        </li>
        <li>
            <a href="user_id.php">Look Up User ID</a>
        </li>   
        <li>
            <a href="add_cuisine.php">Add/Remove Cuisine Type</a>
        </li>
        <li> 
            <a href="update_cuisine.php">Update Your Cuisine Preference</a>
        </li>
        <li>
            <a href="add_restaurant.php">Add Restaurant</a>
        </li>
        <li>
            <a href="add_review.php">Add Review</a>
        </li>
        <li>
            <a href="remove_review.php">Remove Your Review</a>
        </li>
        <li>
            <a href="find_restaurant.php">Find Restaurant</a>
        </li>
    </ul>
  
    <?
        //Connection Constants
        define('DB_name', 'cs340_dunnbrit');
        define('DB_user', 'cs340_dunnbrit');
        define('DB_password', '1967');
        define('DB_host', 'classmysql.engr.oregonstate.edu');

        //Connect
        $link = mysql_connect(DB_host,DB_user,DB_password,DB_name);

        //If connection fails
        if(!$link){
            die("Connection Error:".mysql_error());
        }

        //Connect to database
        $db_selected = mysql_select_db(DB_name,$link); 
    ?>
    <div class="form-style-10">
    	<h1>Update Your Cuisine Preference</h1>
    	<form action="update_cuisine.php" method="POST">
    		<fieldset>
        	   <legend>Select Your Cuisine Preference:</legend>
        	        Cuisine Type:
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
        		    Enter Your User ID:<input type="number" name="userID">
                    <br>
                <input type="submit" name="update_cuisine">
      		</fieldset>
    	</form>
    </div>
    <?
        //Query to update cuisineID from form in customers table 
        if(isset($_POST['userID'])){
            //Insert account information into customer table
            $sql = "UPDATE `customers` 
                    SET `cuisineID` = '$_POST[cuisineID]'
                    WHERE`id` = '$_POST[userID]'";

            //If query fails
            if(!mysql_query($sql)){
                die('Error:'.mysql_error());
            }
        }
    ?>

    <h2>Current Cuisine Perferences</h2>
    <?      
        $sql = "SELECT customers.fname AS first_name, customers.lname AS last_name, cuisine.type AS cuisine_preference
                FROM customers
                INNER JOIN cuisine ON customers.cuisineID = cuisine.id";

        $result = mysql_query($sql,$link);  

        print "<table class='center'>\n";

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