<!DOCTYPE html>
<html>
<head>
	<title>Delete Your Account</title>
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
    <h1>Delete Your Account</h1>
	<form action="delete_account.php" method="POST">
		<fieldset>
    		<legend>Enter Your Information:</legend>
    		First Name: <input type="text" name="fname"><br>
    		Last Name: <input type="text" name="lname"><br>
    		Email: <input type="email" name="email"><br>
            UserID: <input type="number" name="userID">
    		<input type="submit" name="look_up_id">
  		</fieldset>
	</form>
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