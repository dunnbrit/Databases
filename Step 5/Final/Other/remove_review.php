<!DOCTYPE html>
<html>
<head>
	<title>Remove Your Review</title>
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

	<h1>Remove Your Review</h1>
	<form action="remove_review.php" method="POST">
		<fieldset>
            Enter Your User ID:<input type="number" name="userID">
            <input type="submit" name="remove_review">
        </fieldset>
    </form>
    <h2>Your Current Reviews</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Name </th>
                <th>Review</th>
                <th>Delete</th>
            </tr>

       <?
       //Used code from https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table

            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

            $result = $conn->query("SELECT restaurants.id, restaurants.name, reviews_restaurants_customers.review
                FROM reviews_restaurants_customers
                INNER JOIN restaurants ON restaurants.id = reviews_restaurants_customers.restaurantID
                WHERE reviews_restaurants_customers.customerID = '$_POST[userID]'");
       
            while($row = mysqli_fetch_assoc($result)){

               echo "<tr>";
               echo "<td>".$row['id']."</td>";
               echo "<td>".$row['name']."</td>";
               echo "<td>".$row['review']."</td>";
               echo "<td><a href='delete.php?id=".$row['id']."&userID=".$_POST['userID']."'>Delete</a></td>"; 
               echo "</tr>";
            } 

        ?>
</body>
</html>