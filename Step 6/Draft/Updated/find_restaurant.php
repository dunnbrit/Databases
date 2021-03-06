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
	<h1>Find Restaurant</h1>
	<form action="find_restaurant.php" method="POST">

		<fieldset>
        <legend>Find By:</legend>
        <br>
    		Name:<input type="text" name="name">
            OR <br><br>
            Zip Code:<input type="number" name="zip">
            OR <br><br>
            City:<input type="text" name="city">
            <br><br>        
            <input type="submit" name="find_restaurant">
        </fieldset>
    </form>
    <br><br>
    OR
    <br>
    <form action="find_restaurant.php" method="POST">
        <fieldset>
            <legend>Find By Cuisine:</legend> 
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
            <input type="submit" name="find_restaurant_by_cuisine">
        </fieldset>
    </form>
</div>
    <h2>Matching Restaurants</h2>
       <table class='center'>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Street Name</th>
                <th>Suite</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Type</th>
                <th>Rating</th>
                <th>View Reviews</th>
               
            </tr>
        <?
       //Used code from https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table

            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');

            $result = $conn->query("SELECT restaurants.id, restaurants.name , location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type , restaurants.rating
                FROM restaurants
                INNER JOIN location ON location.id = restaurants.locationID
                INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID
                WHERE restaurants.name = '$_POST[name]' OR location.zip = '$_POST[zip]' OR location.city = '$_POST[city]' OR restaurants.cuisineID = '$_POST[cuisineID]' ");
       
            while($row = mysqli_fetch_assoc($result)){

               echo "<tr>";
               echo "<td>".$row['id']."</td>";
               echo "<td>".$row['name']."</td>";
                echo "<td>".$row['street_name']."</td>";
               echo "<td>".$row['suite']."</td>";
               echo "<td>".$row['city']."</td>";
               echo "<td>".$row['state']."</td>";
               echo "<td>".$row['zip']."</td>";
               echo "<td>".$row['type']."</td>";
               echo "<td>".$row['rating']."</td>";
               echo "<td><a href='view.php?id=".$row['id']."'>View</a></td>"; 
               echo "</tr>";
            } 

        ?>  

</body>
</html>