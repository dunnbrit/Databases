--create_account.html
	
	--add a new customer profile to customers table
		INSERT INTO `customer` (`fname`,`lname`,`email`,`birthdate`,`cuisineID`)
		VALUES ($fname, $lname, $email, $birthdate, $cuisineID_from_dropdown_option);

	--get all cuisine types to populate dropdown menu
		SELECT `id`,`type` FROM `cuisine`;

--add_restaurant.html

	--add a new location to location table
		INSERT INTO `location` ( `street_name`, `suite`, `city`, `state`, `zip`)
		VALUES ($street_name, $suite, $city, $state, $zip);	

	--get all cuisine types to populate dropdown for cuisine type selection
		SELECT `id`,`type` FROM `cuisine`;
		
	--get all location to populate dropdown for restaurant location selection
		SELECT * FROM `location`

	--add a new restaurant to the restaurant table
		INSERT INTO `restaurant` (`name`, `locationID`, `cuisineID`)
		VALUES ($name, $locationID_from_dropdown_option, $cuisineID_from_dropdown_option);

	--display all current restaurant in a table
		SELECT restaurants.name , location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type
		FROM restaurants
		INNER JOIN location ON location.id = restaurants.locationID
		INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID;

--add_cuisine.html
		
	--add a new cuisine type to cuisine type
		INSERT INTO `cuisine` (`type`)
		VALUES ($type);

	--display all current cuisine types in a table
		SELECT `type`
		FROM `cuisine`

--add_review.html

	--get all restaurant names to poplulate dropdown menu
		SELECT `id`,`name` FROM `restaurant`;

	--add new review to reviews_restaurant_customer table
		INSERT INTO `reviews_restaurant_customer` (`customerID`,`restaurantID`,`review`)
		VALUES ($userID,$restaurant_ID_from_dropdown_option,$radio_button_selection_value);

	--display all current reviews for that user
		SELECT restaurants.name AS Restaurant, reviews_restaurants_customers.review
        FROM reviews_restaurants_customers
        INNER JOIN restaurants ON restaurants.id = reviews_restaurants_customers.restaurantID
        WHERE reviews_restaurants_customers.customerID = $userID



--find_restaurant.html

	--get all restaurant names to poplulate dropdown menu for find by name
		SELECT `id`,`name` FROM `restaurant`;

	--get all restaurants with matching zip code
		SELECT `name` 
		FROM `restaurant`
		WHERE `zip` = :zip;

	--get all restaurants with matching city
		SELECT `name` 
		FROM `restaurant`
		WHERE `city` = :city AND `state` = :state;

	--get all restaurants with matching rating
		SELECT `name` 
		FROM `restaurant`
		WHERE `rating` >= :rating;
	
	--get all cuisine types to populate dropdown menu
		SELECT `id`,`type` FROM `cuisine`;

	--get all with matching cuisine
		SELECT `name` 
		FROM `cuisine`
		WHERE `cuisineID` = :cuisine_ID_from_dropdown_option;

	--display selected restaurant information from list of matching restaurants
		SELECT r.name, c.type, l.street_name, l.city, l.state, l.zip,
		(SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = :restaurant_ID_from_select_button)
		FROM restaurant r 
		INNER JOIN cuisine c ON r.cuisineID = c.id
		INNER JOIN location l ON r.locationID = l.id
		WHERE r.id = :restaurant_ID_from_select_button;

	--display reviews in a table when see reviews button is clicked
		SELECT SUM(review) AS 'number of likes',
		(COUNT(review)-SUM(review)) AS 'number of dislikes' 
		FROM reviews_restaurant_customer;

--user_id.html
	
	--find user id by information entered by user
		SELECT `id`
		FROM `customer`
		WHERE `fname` = :fname AND `lname` = :lname AND `email` = :email AND `birthdate` = :birthdate;

--remove_review.html

	--get all restaurant names to poplulate dropdown menu
		SELECT `id`,`name` FROM `restaurant`;

	--display selected restaurant name
		SELECT `name` 
		FROM `restaurant`
		WHERE `id` = :restaurant_ID_from_dropdown_option;

	--remove review from reviews_restaurant_customer table
		DELETE FROM `reviews_restaurant_customer` 
		WHERE `restaurantID` = :restaurant_ID_from_dropdown_option AND `customerID` = :userID;

--update_cuisine.html

	--get all cuisine types to populate dropdown menu
		SELECT `id`,`type` FROM `cuisine`;

	--update cuisine preference for the user in customer table
		UPDATE `customer`
		SET `cuisineID` = :cuisine_ID_from_dropdown_option;
		WHERE `id` = :userID;

--delete_account.html

	--delete account from customer table if all information matches
		DELETE FROM `customer`
		WHERE `fname` = :fname AND `lname` = :lname AND `email` = :email AND `birthdate` = :birthdate AND `id` = :userID;