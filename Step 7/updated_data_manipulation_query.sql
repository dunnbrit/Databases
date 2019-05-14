--create_account.php

	--get all cuisine types to populate dropdown menu for cuisine preference
		SELECT `id`,`type` FROM `cuisine`;	

	--add a new customer profile to customers table
		INSERT INTO `customers` (`fname`,`lname`,`email`,`birthdate`,`cuisineID`)
		VALUES ($fname, $lname, $email, $birthdate, $cuisineID_from_dropdown_option);

	--get all names and birthdates from customers table to populate current customer profiles table
		SELECT `fname` AS First_Name, `lname` AS Last_Name, birthdate AS Birthday
        FROM customers;



--user_id.php
	
	--find user id in customers table by information entered into form
		SELECT `id` AS UserID
		FROM `customers`
		WHERE `fname` = $fname AND `lname` = $lname AND `email` = $email;



--add_cuisine.php
		
	--add a new cuisine type entered in form to cuisine table
		INSERT INTO `cuisine` (`type`)
		VALUES ($type);

	--display all current cuisine types from cuisine table in current cuisine types table
		SELECT `type` AS cuisine_type
		FROM `cuisine`;



--delete_cuisine.php

	--delete cuisine from cuisine table where selected row id matches
		DELETE FROM `cuisine`
		WHERE `id` = $id;



--update_cuisine.php

	--get all cuisine types from cuisine table to populate dropdown menu
		SELECT `id`,`type` FROM `cuisine`;

	--update cuisine preference for the user in customer table
		UPDATE `customers`
		SET `cuisineID` = $cuisine_ID_from_dropdown_option;
		WHERE `id` = $userID;

	--get all customer names and cuisine preferences from cuisine and customer tables to populate current cuisine preferences table
		SELECT customers.fname AS First_Name, customers.lname AS Last_Name, cuisine.type AS Cuisine_Preference
        FROM `customers`
        LEFT JOIN `cuisine` ON customers.cuisineID = cuisine.id;



--add_restaurant.php

	--add a new location to location table from the form
		INSERT INTO `location` ( `street_name`, `suite`, `city`, `state`, `zip`)
		VALUES ($street_name, $suite, $city, $state, $zip);	

	--get all cuisine types from cuisine table to populate dropdown for cuisine type selection
		SELECT `id`,`type` FROM `cuisine`;
		
	--get all locations from location table to populate dropdown for restaurant location selection
		SELECT * FROM `location`;

	--add a new restaurant to the restaurants table from the form
		INSERT INTO `restaurants` (`name`, `locationID`, `cuisineID`)
		VALUES ($name, $locationID_from_dropdown_option, $cuisineID_from_dropdown_option);

	--display all current restaurants with location and cuisine from restaurant,location, and cuisine table in current restaurants table
		SELECT restaurants.name AS restaurant, location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type AS cuisine_type
		FROM restaurants
		INNER JOIN location ON location.id = restaurants.locationID
		INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID;



--add_review.php

	--get all restaurant names from restaurants table to poplulate dropdown menu
		SELECT `id`,`name` FROM `restaurants`;

	--add new review to reviews_restaurant_customer table from form
		INSERT INTO `reviews_restaurant_customer` (`customerID`,`restaurantID`,`review`)
		VALUES ($userID,$restaurant_ID_from_dropdown_option,$radio_button_selection_value);
 
    --update rating for restaurant on restaurants table after adding a review
    	UPDATE `restaurants` 
        SET `rating` = (
        	SELECT AVG (review)
        	FROM `reviews_restaurants_customers`
        	WHERE `restaurantID` = $selected_restaurant)
        WHERE `id` = $selected_restaurant; 

	--display all current reviews for that user in your current reviews table
		SELECT restaurants.name AS Restaurants_Reviewed, reviews_restaurants_customers.review
        FROM reviews_restaurants_customers
        INNER JOIN restaurants ON restaurants.id = reviews_restaurants_customers.restaurantID
        WHERE reviews_restaurants_customers.customerID = $userID;



--remove_review.php

	--display all current reviews by a customer fromreviews_restaurants_customers table in your current reviews table 
	SELECT restaurants.id, restaurants.name, reviews_restaurants_customers.review
    FROM reviews_restaurants_customers
    INNER JOIN restaurants ON restaurants.id = reviews_restaurants_customers.restaurantID
    WHERE reviews_restaurants_customers.customerID = $userID);



--delete.php

	--remove review from reviews_restaurant_customer table from selected row
		DELETE FROM `reviews_restaurants_customers` 
		WHERE `restaurantID` = $restaurant_from_selected_row AND `customerID` = $userID;
	
	--update the rating in restaurants table for restaurant with removed review
		UPDATE `restaurants` 
        SET `rating` = (
        	SELECT AVG (review) 
        	FROM `reviews_restaurants_customers` 
        	WHERE `restaurantID` = $restaurant_from_selected_row)
        WHERE `id` = $restaurant_from_selected_row;



--find_restaurant.php

	--get all cuisine types from cuisine table to populate dropdown for cuisine type selection
		SELECT `id`,`type` FROM `cuisine`;
		
	--get all restaurants from restaurants table with matching name, zip code, city, or cuisine type from form
		SELECT restaurants.name , location.street_name , location.suite , location.city , location.state, location.zip , cuisine.type, restaurants.rating
        FROM restaurants
        INNER JOIN location ON location.id = restaurants.locationID
        INNER JOIN cuisine ON cuisine.id = restaurants.cuisineID
        WHERE restaurants.name = $name OR location.zip = $zip OR location.city = $city OR restaurants.cuisineID = $cuisineID;



--view.php
	
	--get count of likes and dislikes from reviews_restaurants_customers table to display in reviews table
		SELECT COUNT(review)
        FROM `reviews_restaurants_customers`
        WHERE `restaurantID` = $id AND `review` = 1;

        SELECT COUNT(review)
        FROM `reviews_restaurants_customers`
        WHERE `restaurantID` = $id AND `review` = 0;
