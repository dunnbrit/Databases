<!DOCTYPE html>
<html>
<head>
	<title>Update Your Cuisine Preference</title>
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
        //Query to add account information by form
        if(isset($_POST['userID'])){
            //Insert account information into customer table
            $sql = "UPDATE `customers` 
                    SET `cuisineID` = '$_POST[cuisineID]'
                    WHERE`id` = '$_POST[userID]'";

            //If query fails
            if(!mysql_query($sql)){
                die('Error:'.mysql_error());
            }
            else{
                echo 'Customer Cuisine Preference Updated';
            }
        }
    ?>
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
            <input type="submit" name="select_restaurant">

  		</fieldset>
	</form>
</body>
</html>