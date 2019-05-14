<!DOCTYPE html>
<html>
<head>
	<title>Add Restaurant</title>
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

	<h1>Add Restaurant</h1>
		<form>
			<fieldset>
	    		<legend>Add Restaurant Information:</legend>
	    			Name: <input type="text" name=name"><br>
	    			Cuisine Type: <select name="cuisines">
	    				<option value="$cuisine_type">$cuisine_type</option>
	    			</select>
	    			Cuisine Type Not Listed? <button>Add it
	    				<a href="add_cuisine.html"></a>
	    			</button>
	    			<br>
	    		<fieldset>
	    			<legend>Location:</legend>
	    			Street Name: <input type="text" name="street_name">
	    			Suite Number: <input type="Number" name="suite"> <br>
	    			City: <input type="text" name="city">
	    			State: <input type="text" name="state">
	    			Zip Code: <input type="Number" name="zip"> 
	    		</fieldset><br>
	    		<input type="submit" name="add_restaurant">
	  		</fieldset>
		</form>

	<h2>Current Restaurants</h2>
	<?		
		//Query to get cuisine table
		$sql = "SELECT *
				FROM `restaurants`";
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