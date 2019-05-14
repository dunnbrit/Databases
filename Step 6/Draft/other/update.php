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

        $email = "SELECT email 
                FROM customers
                WHERE id = '$customer' ";
        ?>
        <form action="update.php" method="POST">
            Email: 
            <?
             echo"<input type="text" name="email">".$email.;
             ?>
            <input type="submit" name="update_email">
        </form>
    <?
    if(isset($_POST['update_email'])){
        $query = "UPDATE `customers` 
                    SET `email` = '$_POST[email]'
                    WHERE `id` = '$customer' ";
        if (mysqli_query($conn, $query)){

            echo "Email Updated";
            mysqli_close($conn);

            exit;
        }

    else {
        echo "Error Updating Email";
    }
}
    ?>
</body>
</html>








