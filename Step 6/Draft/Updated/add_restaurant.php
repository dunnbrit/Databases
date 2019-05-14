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
		$link = mysql_connect(DB_host,DB_user,DB_password);

		//If connection fails
		if(!$link){
			die("Connection Error:".mysql_error());
		}

		//Connect to database
		$db_selected = mysql_select_db(DB_name,$link);	
	?>

    <?
    	//Query to add restaurant by form
        if(isset($_POST['restaurant_name'])){
  				$query = "INSERT INTO `restaurants` (`name`, `locationID`, `cuisineID`)
							VALUES ('$_POST[restaurant_name]', '$_POST[locationID]', '$_POST[cuisineID]')";
	            
		        //If query fails
		        if(!mysql_query($query)){
		            die('Error:'.mysql_error());
	            }   
        }
    ?>
<div class="form-style-10">
	<h1>Add Restaurant</h1>
		<form action="add_restaurant.php" method="post">
			<fieldset>
	    		<legend>First Enter and Submit Restaurant Location:</legend>
	    			<br><br>
	    			Street Name: <input type="text" name="street_name">
	    			Suite Number: <input type="Number" name="suite">
	    			City: <input type="text" name="city">
	    			State: <input type="text" name="state">
	    			Zip Code: <input type="Number" name="zip"> 
	    			<br><br>	    			
	    		<input type="submit" name="add_location">
	  		</fieldset>
		</form>	 
	<?
        //Query to add location by form
        if(isset($_POST['street_name'],$_POST['city'],$_POST['state'],$_POST['zip'] )){

            //Insert location into location table
            $query = "INSERT INTO `location` ( `street_name`, `suite`, `city`, `state`, `zip`)
                    VALUES ('$_POST[street_name]', '$_POST[suite]', '$_POST[city]', '$_POST[state]', '$_POST[zip]')";
        
            //If query fails
            if(!mysql_query($query)){
                die('Error:'.mysql_error());
            }
        }   
    ?>   
    <br><br>
		<form action="add_restaurant.php" method="post">
			<fieldset>
	    		<legend>Then Enter and Submit Restaurant Information:</legend>
	    			<br><br>
	    			Name: <input type="text" name="restaurant_name">
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
	   
	    			
	    			Location:
	    			<?php

			            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
			            or die ('Cannot connect to db');

			            $result = $conn->query("select * from location");

			            echo "<select name='locationID'>";

			            while ($row = $result->fetch_assoc()) {

			                unset($id, $street_name , $city);
			                $id = $row['id'];
			                $street_name = $row['street_name']; 
			                $city = $row['city'];
			                $state = $row['state'];
			                $zip = $row['zip'];
			                echo '<option value="'.$id.'"> '.$street_name, ", ", $city , ",", $state, "  ", $zip.'</option>';
			            }

			                echo "</select>";

		            ?> 
	    			<br>	
  
	    			<br>			    			
	    		<input type="submit" name="add_restaurant">
	  		</fieldset>
		</form>	  
	</div>

	<h2>Current Restaurants</h2>
	<?		
		//Query to get restaurant table
		$sql = "SELECT restaurants.name AS restaurant , location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type AS cuisine_type
				FROM restaurants
				INNER JOIN location ON location.id = restaurants.locationID
				INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID";
		$result = mysql_query($sql,$link);	

		print "<table border = 1 class='center'>\n";

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