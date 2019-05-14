<!DOCTYPE html>
<html>
<head>
	<title>Look Up User ID</title>
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

	<h1>Look Up User ID</h1>
	<form action="user_id.php" method="POST">
		<fieldset>
    		<legend>Enter Your Information:</legend>
    		First Name: <input type="text" name=fname"><br>
    		Last Name: <input type="text" name="lname"><br>
    		Email: <input type="email" name="email"><br>
    		Date of birth: <input type="date" name="birthdate"><br>
    		<input type="submit" name="look_up_id">
  		</fieldset>
	</form>
    <h2>User ID</h2>
    <?
        //Query to look up user ID
        $sql = "SELECT id FROM customers
                        WHERE email = '$_POST[email]'";
                        
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