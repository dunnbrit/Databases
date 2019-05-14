<!DOCTYPE html>
<html>
<head>
	<title>Add Cuisine Type</title>
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



	<h1>Add Cuisine Type</h1>
		<form action="add_cuisine.php" method="post">
			<fieldset>
	    		<legend>Add Cusinie Type Description:</legend>
	    			<input type="text" name="type"><br>
	    		<input type="submit" name="add_cuisine">
	  		</fieldset>
		</form>

	<?
		//Assign varible for add_cuisine.html "Add Cuisine Type" form
		$type = $_POST['type'];

		if(isset($_POST['type'])){
			//Insert cuisine type into cuisine table
			$sql = "INSERT INTO `cuisine` (`type`) VALUES ('$type')";

			//If query fails
			if(!mysql_query($sql)){
				die('Error:'.mysql_error());
			}	
		}
		
	?>
	

	<h2>Current Cuisine Types</h2>
	
	<?		
		//Query to get cuisine table
		$sql = "SELECT *
				FROM `cuisine`";
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