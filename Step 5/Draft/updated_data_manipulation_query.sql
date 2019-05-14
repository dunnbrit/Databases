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

    --update rating for restaurant on restaurants table
    	UPDATE `restaurants` 
        SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = $selected_restaurant)
        WHERE `id` = $selected_restaurant; 


--user_id.html
	
	--find user id by information entered by user
		SELECT `id`
		FROM `customer`
		WHERE `fname` = $fname AND `lname` = $lname AND `email` = $email 


--delete_account.html

	--delete account from customer table if all information matches
		DELETE FROM `customers`
		WHERE `fname` = $fname AND `lname` = $lname AND `email` = $email AND `id` = $userID;


--remove_review.html

	--get all restaurant names to poplulate dropdown menu
		SELECT `id`,`name` FROM `restaurant`;

	--remove review from reviews_restaurant_customer table
		DELETE FROM `reviews_restaurants_customers` 
		WHERE `restaurantID` = $restaurant_ID_from_dropdown_option AND `customerID` = $customerID;


--find_restaurant.html

	--get all cuisine types to populate dropdown for cuisine type selection
		SELECT `id`,`type` FROM `cuisine`;
		
	--get all restaurants with matching name, zip code, city, or cuisine type
		SELECT restaurants.name , location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type, restaurants.rating
        FROM restaurants
        INNER JOIN location ON location.id = restaurants.locationID
        INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID
        WHERE restaurants.name = $name OR location.zip = $zip OR location.city = $city OR restaurants.cuisineID = $cuisineID;





--update_cuisine.html

	--get all cuisine types to populate dropdown menu
		SELECT `id`,`type` FROM `cuisine`;

	--update cuisine preference for the user in customer table
		UPDATE `customers`
		SET `cuisineID` = :cuisine_ID_from_dropdown_option;
		WHERE `id` = :userID;

