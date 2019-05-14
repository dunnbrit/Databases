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
            <a href="add_restaurant.php">Add Restaurant</a>
        </li>
        <li>
            <a href="add_cuisine.php">Add Cuisine Type</a>
        </li>
        <li> 
            <a href="update_cuisine.php">Update Your Cuisine Preference</a>
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
        <li>
            <a href="user_id.php">Look up User ID</a>
        </li>
        <li>
            <a href="delete_account.php">Delete Your Account</a>
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
    <?
        //Query to add review by form
        if(isset($_POST['add_review'])){

            if(isset($_POST['opinion'])){
                //Insert review into `reviews_restaurants_customers` table
                $sql = "INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`)
                        VALUES ('$_POST[userID]', '$_POST[selected_restaurant]', '$_POST[opinion]')";

                //If query fails
                if(!mysql_query($sql)){
                    die('Error:'.mysql_error());
                } 
            }
        }
    ?>
<div class="form-style-10">
	<h1>Add Review</h1>
    <form action = "add_review.php" method="post">
        <fieldset>
            <legend>Review a Restaurant:</legend>
            <br><br>
            Enter Your User ID:<input type="number" name="userID">
            Select a Restaurant:
            <?php

                //Code from https://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database

                $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

                $result = $conn->query("select id, name from restaurants");

                echo "<select name='selected_restaurant'>";

                while ($row = $result->fetch_assoc()) {

                    unset($id, $name);
                    $id = $row['id'];
                    $name = $row['name']; 
                    echo '<option value="'.$id.'">'.$name.'</option>';
                }

                    echo "</select>";

            ?> 
            Your Review:
            <select name='opinion'>
                <option value="1"> Like</option>
                <option value="0"> Dislike</option>
            </select>
            <br><br>
            <input type="submit" name="add_review">
        </fieldset>
    </form>
</div>
    <?
            //Update restaurant table
            $query = "UPDATE `restaurants` 
                      SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = '$_POST[selected_restaurant]')
                      WHERE `id` = '$_POST[selected_restaurant]' ";
            if(!mysql_query($query)){
                die('Error:'.mysql_error());
            }
    ?>
        <h2>Your Current Reviews</h2>
    <?      
        //Query to get restaurant table
        $sql = "SELECT restaurants.name AS Restaurants_Reviewed, reviews_restaurants_customers.review
                FROM reviews_restaurants_customers
                INNER JOIN restaurants ON restaurants.id = reviews_restaurants_customers.restaurantID
                WHERE reviews_restaurants_customers.customerID = '$_POST[userID]'";
       
        $result = mysql_query($sql,$link);  

        print "<table border = 1 class = 'center'>\n";

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