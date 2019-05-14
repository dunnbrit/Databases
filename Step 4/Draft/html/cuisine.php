<?php
	
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

	//If connection fails
	if(!$db_selected){
		die("Database Error".mysql_error());
	}


	//Assign varible for add_cuisine.html "Add Cuisine Type" form
	$type = $_POST['type'];

	//Insert cuisine type into cuisine table
	$sql = "INSERT INTO `cuisine` (`type`) VALUES ('$type')";

	//If query fails
	if(!mysql_query($sql)){
		die('Error:'.mysql_error());
	}

	//Close connection
	mysql_close();

?>