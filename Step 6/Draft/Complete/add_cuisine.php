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
		$link = mysql_connect(DB_host,DB_user,DB_password);

		//If connection fails
		if(!$link){
			die("Connection Error:".mysql_error());
		}

		//Connect to database
		$db_selected = mysql_select_db(DB_name,$link);	
	?>

	<div class="form-style-10">
		<h1>Add Cuisine Type</h1>
			<form action="add_cuisine.php" method="post">
				<fieldset>
		    		<legend>Enter Description of a Type of Cuisine:</legend>
		    			<br>
		    			<input type="text" name="type" required><br>
		    		<input type="submit" name="add_cuisine">
		  		</fieldset>
			</form>
		</div>
	<?
	if(isset($_POST['type'])){
		//Insert cuisine type into cuisine table
		$sql = "INSERT INTO `cuisine` (`type`) VALUES ('$_POST[type]')";

		//If query fails
		if(!mysql_query($sql)){
			die('Error:'.mysql_error());
		}	
	}	
	?>
	
	<h2>Current Cuisine Types</h2>
       <table class='center'>
            <tr>
                <th>Cuisine Type</th>
                <th></th>
            </tr>
        <?
       //Used code from https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table

            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

            $result = $conn->query("SELECT id, type
                FROM cuisine");
       
            while($row = mysqli_fetch_assoc($result)){

               echo "<tr>";
               echo "<td>".$row['type']."</td>";
               echo "<td><a href='delete_cuisine.php?id=".$row['id']."'>Delete</a></td>"; 
               echo "</tr>";
            } 
        ?>           
</body>
</html>