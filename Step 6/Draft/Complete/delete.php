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
            <a href="user_id.php">Look Up User ID</a>
        </li>   
        <li>
            <a href="add_cuisine.php">Add/Remove Cuisine Type</a>
        </li>
        <li> 
            <a href="update_cuisine.php">Update Your Cuisine Preference</a>
        </li>
        <li>
            <a href="add_restaurant.php">Add Restaurant</a>
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
    </ul>

    <?
        //Get user and restaurant ids from previous page
        $id = $_GET['id'];
        $customer = $_GET['userID'];


        //Connection Constants
        define('DB_name', 'cs340_dunnbrit');
        define('DB_user', 'cs340_dunnbrit');
        define('DB_password', '1967');
        define('DB_host', 'classmysql.engr.oregonstate.edu');

        $conn = new mysqli(DB_host, DB_user, DB_password, DB_name) 
                or die ('Cannot connect to db');
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "DELETE FROM reviews_restaurants_customers
                    WHERE restaurantID = '$id' AND customerID = '$customer' ";

        if (mysqli_query($conn, $sql)) {
                //Update restaurant table
                $query = "UPDATE `restaurants` 
                          SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = '$id')
                          WHERE `id` = '$id' ";
            if (mysqli_query($conn, $query)){

                echo "Review Deleted";
                mysqli_close($conn);

                exit;
            }
        } 
        else {
            echo "Error deleting review";
        }

    ?>
</body>
</html>








