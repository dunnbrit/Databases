<!DOCTYPE html>
<html>
<head>
	<title>Add Review</title>
</head>
<body>
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
        if(isset($_POST['userID'])){
            //Insert review into `reviews_restaurants_customers` table
            $sql = "INSERT INTO `reviews_restaurants_customers` (`restaurantID`, `customerID`,`review`)
                    VALUES ('$_POST[userID]', '$_POST[selected_restaurant]', '$_POST[review]')";

            //If query fails
            if(!mysql_query($sql)){
                die('Error:'.mysql_error());
            }   
        }
    ?>
	<h1>Add Review</h1>
    <form action = "add_review.php" method="post">
        <fieldset>
            <legend>Add Your Review:</legend>
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
            <p>
                Like<input type="radio" name="review" value="1">
                Dislike<input type="radio" name="review" value="0">
            </p>
            <input type="submit" name="add_review">
        </fieldset>
    </form>
</body>
</html>