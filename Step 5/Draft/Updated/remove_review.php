<!DOCTYPE html>
<html>
<head>
	<title>Remove Your Review</title>
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

	<h1>Remove Your Review</h1>
	<form action="remove_review.php" method="POST">
		<fieldset>
            <legend>Remove Your Review:</legend>
            Restaurant:
            <?php

            //Code from https://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database

            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                    or die ('Cannot connect to db');

            $result = $conn->query("select id, name from restaurants");

            echo "<select name='restaurantID'>";

                while ($row = $result->fetch_assoc()) {

                    unset($id, $name);
                    $id = $row['id'];
                    $name = $row['name']; 
                    echo '<option value="'.$id.'">'.$name.'</option>';
                }

            echo "</select>";

            ?>      
            <br>       
            Enter Your User ID:<input type="number" name="customerID">
            <input type="submit" name="remove_review">
        </fieldset>
    </form>
    <?
        if(isset($_POST['customerID'])){
            //Delete review from 'reviews_restaurants_customers' table
            $sql = "DELETE FROM reviews_restaurants_customers
                    WHERE restaurantID = '$_POST[restaurantID]' AND customerID = '$_POST[customerID]' ";

            //If query fails
            if(!mysql_query($sql)){
                die('Error:'.mysql_error());
            }  
            else{
                echo 'Review Deleted';
            } 
        }   
    ?> 
</body>
</html>