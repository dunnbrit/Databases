<!DOCTYPE html>
<html>
<head>
	<title>Add Review</title>
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
        //Query to add review by form
        if(isset($_POST['add_review'])){

            if(isset($_POST['opinion'])){
                //Insert review into `reviews_restaurants_customers` table
                $sql = "INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`)
                        VALUES ('$_POST[userID]', '$_POST[selected_restaurant]', '$_POST[opinion]')";

                //If query fails
                if(!mysql_query($sql)){
                    die('Error:'.mysql_error());
                } 
            }
        }
    ?>
	<h1>Add Review</h1>
    <form action = "add_review.php" method="post">
        <fieldset>
            <legend>Add Your Review:</legend>
            Enter Your User ID:<input type="number" name="userID">
            Select a Restaurant:
            <?php

                //Code from https://stackoverflow.com/questions/8022353/how-to-populate-html-dropdown-list-with-values-from-database

                $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

                $result = $conn->query("select id, name from restaurants");

                echo "<select name='selected_restaurant'>";

                while ($row = $result->fetch_assoc()) {

                    unset($id, $name);
                    $id = $row['id'];
                    $name = $row['name']; 
                    echo '<option value="'.$id.'">'.$name.'</option>';
                }

                    echo "</select>";

            ?> 
            <br>
            <select name='opinion'>
                <option value="1"> Like</option>
                <option value="0"> Dislike</option>
            </select>
            <input type="submit" name="add_review">
        </fieldset>
    </form>
    <?
            //Update restaurant table
            $query = "UPDATE `restaurants` 
                      SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = '$_POST[selected_restaurant]')
                      WHERE `id` = '$_POST[selected_restaurant]' ";
            if(!mysql_query($query)){
                die('Error:'.mysql_error());
            }
    ?>
        <h2>Your Current Reviews</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Name </th>
                <th>Delete</th>
            </tr>

       <?
       //Used code from https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table

            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

            $result = $conn->query("SELECT restaurants.id, restaurants.name
                FROM reviews_restaurants_customers
                INNER JOIN restaurants ON restaurants.id = reviews_restaurants_customers.restaurantID
                WHERE reviews_restaurants_customers.customerID = '$_POST[userID]'");
       
            while($row = mysqli_fetch_assoc($result)){

               echo "<tr>";
               echo "<td>".$row['id']."</td>";
               echo "<td>".$row['name']."</td>";
               echo "<td><a href='delete.php?id=".$row['id']."&userID=".$_POST['userID']."'>Delete</a></td>"; 
               echo "</tr>";
            } 

        ?>

</body>
</html>