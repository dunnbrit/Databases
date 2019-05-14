<!DOCTYPE html>
<html>
<head>
	<title>Create Customer Profile</title>
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
        if(isset($_POST['fname'])){
            //Insert account information into customer table
            $sql = "INSERT INTO `customers` (`fname`,`lname`,`email`,`birthdate`,`cuisineID`)
                    VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[birthdate]', '$_POST[cuisineID]')";

            //If query fails
            if(!mysql_query($sql)){
                die('Error:'.mysql_error());
            }   
        }
    ?>

	<h1>Create Account</h1>
	<form action="create_account.php" method="post">
		<fieldset>
    		<legend>Add Your Information:</legend>
    		First Name: <input type="text" name="fname"><br>
    		Last Name: <input type="text" name="lname"><br>
    		Email: <input type="email" name="email"><br>
    		Date of birth: <input type="date" name="birthdate"><br>
    		Cuisine Preference(optional): 
            
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
            
    		<input type="submit" name="create_account">
  		</fieldset>
	</form>
</body>
</html>