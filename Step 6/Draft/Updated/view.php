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
<br><br><br><br>
    <h2> Reviews </h2>
       <table class='center'>
            <tr>
                <th>Likes</th>
                <th>Dislikes</th>
            </tr>
        <?
            $id = $_GET['id'];

            $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');
            
            $result =  $conn->query("SELECT COUNT(review)
                FROM `reviews_restaurants_customers`
                WHERE `restaurantID` = '$id' AND `review` = 1 ");

            $row = mysqli_fetch_assoc($result);
            echo "<tr>";
            echo "<td>".$row['COUNT(review)']."</td>";

            $dislike =  $conn->query("SELECT COUNT(review)
                FROM `reviews_restaurants_customers`
                WHERE `restaurantID` = '$id' AND `review` = 0 ");

            $next_row = mysqli_fetch_assoc($dislike);
            echo "<td>".$next_row['COUNT(review)']."</td>";
            echo "</tr>";

       ?>

</body>
</html>