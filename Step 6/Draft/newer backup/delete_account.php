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
    <h1>Delete Your Account</h1>
	<form action="delete_account.php" method="POST">
		<fieldset>
    		<legend>Enter Your Information:</legend>
            <br><br>
    		First Name: <input type="text" name="fname">
    		Last Name: <input type="text" name="lname">
    		Email: <input type="email" name="email">
            UserID: <input type="number" name="userID">
            <br><br>
    		<input type="submit" name="look_up_id">
  		</fieldset>
	</form>
</div>
    <?
    if(isset($_POST['fname'])){
        //Insert cuisine type into cuisine table
        $sql = "DELETE FROM customers
                WHERE fname = '$_POST[fname]' AND lname = '$_POST[lname]' AND email = '$_POST[email]' AND  id = '$_POST[userID]' ";

        //If query fails
        if(!mysql_query($sql)){
            die('Error:'.mysql_error());
        }  
        else{
            echo 'Account Deleted';
        } 
    }   
    ?>    
</body>
</html>