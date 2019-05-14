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
<div class="form-style-10">
	<h1>Look Up User ID</h1>
	<form action="user_id.php" method="POST">
		<fieldset>
    		<legend>Enter Your Information:</legend>
    		First Name: <input type="text" name="fname"><br>
    		Last Name: <input type="text" name="lname"><br>
    		Email: <input type="email" name="email"><br>
    		<input type="submit" name="look_up_id">
  		</fieldset>
	</form>
</div>
    <h2>User ID</h2>
    <?
        //Query to look up user ID
        $sql = "SELECT id FROM customers
                        WHERE email = '$_POST[email]' AND fname = '$_POST[fname]' AND lname = '$_POST[lname]' ";
                        
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