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
        //Query to add account information by form
        if(isset($_POST['fname'])){
            //Insert account information into customer table
            $sql = "INSERT INTO `customers` (`fname`,`lname`,`email`,`birthdate`,`cuisineID`)
                    VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$_POST[birthdate]', '$_POST[cuisineID]')";

            //If query fails
            if(!mysql_query($sql)){
                die('Error:'.mysql_error());
            }
            else{
                echo 'Customer Profile Created.';
            }
        }
    ?>
<div class="form-style-10">
	<h1>Create Your Profile</h1>
	<form action="create_account.php" method="post">
		<fieldset>
    		<legend>Add Your Information:</legend>
            <br><br>
    		First Name: <input type="text" name="fname"><br>
    		Last Name: <input type="text" name="lname"><br>
    		Email: <input type="email" name="email"><br>
    		Date of birth: <input type="date" name="birthdate"><br>
    		Cuisine Preference: 
            
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
            <br><br>
    		<input type="submit" name="create_account">
  		</fieldset>
	</form>
</div>
    <h2>Current Customers</h2>
    <?      
        $sql = "SELECT fname AS first_name, lname AS last_name, birthdate
                FROM customers";

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