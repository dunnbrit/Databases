

    <?
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
        	echo "\n<a href='index.html'>Return Home</a>";
        	mysqli_close($conn);

        	exit;
        }
	} 
	else {
    	echo "Error deleting record";
	}

    ?>






