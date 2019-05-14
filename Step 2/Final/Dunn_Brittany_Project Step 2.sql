DROP TABLE IF EXISTS `location`;
CREATE TABLE `location`(
    `id` int NOT NULL AUTO_INCREMENT,
    `street_name` varchar(255) NOT NULL,
    `suite` int,
    `city` varchar(100) NOT NULL,
    `state` varchar(2) NOT NULL,
    `zip` int(5) NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE=INNODB;


DROP TABLE IF EXISTS `cuisine`;
CREATE TABLE `cuisine`(
    `id` int NOT NULL AUTO_INCREMENT,
    `type` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
)
ENGINE=INNODB;


DROP TABLE IF EXISTS `restaurants`;
CREATE TABLE `restaurants` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `locationID` int NOT NULL,
    `cuisineID` int NOT NULL,
    `rating` decimal(5,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`locationID`),
    FOREIGN KEY (`locationID`) REFERENCES `location` (`id`),
    FOREIGN KEY (`cuisineID`) REFERENCES `cuisine` (`id`)
)
ENGINE=INNODB;


DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`(
	`id` int NOT NULL AUTO_INCREMENT,
	`fname` varchar(100) NOT NULL, 
	`lname` varchar(100) NOT NULL, 
	`email` varchar(100) NOT NULL UNIQUE, 
	`birthdate` date, 
	`cuisineID` int, 
	PRIMARY KEY (`id`),  
	FOREIGN KEY (`cuisineID`) REFERENCES `cuisine` (`id`)
) 
ENGINE=INNODB;


DROP TABLE IF EXISTS `reviews_restaurants_customers`;
CREATE TABLE `reviews_restaurants_customers`(
    `customerID` int NOT NULL,
    `restaurantID` int NOT NULL,
    `review` bit NOT NULL,
    FOREIGN KEY (`customerID`) REFERENCES `customers` (`id`),
    FOREIGN KEY (`restaurantID`) REFERENCES `restaurants` (`id`) 
)
ENGINE=INNODB;


INSERT INTO `location` (`street_name`,`city`,`state`,`zip`) VALUES ("East Street","Atlanta", "GA", 30301);
INSERT INTO `location` (`street_name`,`city`,`state`,`zip`) VALUES ("West Street","Portland", "OR", 97035);
INSERT INTO `location` (`street_name`,`city`,`state`,`zip`) VALUES ("North Street","Phoenix", "AZ", 85001);
INSERT INTO `location` (`street_name`,`city`,`state`,`zip`) VALUES ("South Street","Denver", "CO", 80014);

INSERT INTO `cuisine` (`type`) VALUES ("italian");
INSERT INTO `cuisine` (`type`) VALUES ("southern");
INSERT INTO `cuisine` (`type`) VALUES ("fast food");
INSERT INTO `cuisine` (`type`) VALUES ("comfort food");

INSERT INTO `customers` (`fname`,`lname`, `email`,`birthdate`, `cuisineID`) VALUES ("Mario", "Kart", "mariok@gmail.com",'1990-10-12', 1);
INSERT INTO `customers` (`fname`,`lname`, `email`,`birthdate`, `cuisineID`) VALUES ("Peach", "Princess", "princess@gmail.com",'1990-05-12', 2);
INSERT INTO `customers` (`fname`,`lname`, `email`,`birthdate`) VALUES ("Bowser", "Baby", "bb@gmail.com",'2000-06-13');
INSERT INTO `customers` (`fname`,`lname`, `email`,`cuisineID`) VALUES ("Yoshi", "Green", "yoshi@gmail.com",3);

INSERT INTO `restaurants` (`name`, `locationID`, `cuisineID`) VALUES ("Toad's Kitchen", 1, 2);
INSERT INTO `restaurants` (`name`, `locationID`, `cuisineID`) VALUES ("Lugi's Pizzeria", 4, 1);
INSERT INTO `restaurants` (`name`, `locationID`, `cuisineID`) VALUES ("Shell Fast Food", 2, 3);
INSERT INTO `restaurants` (`name`, `locationID`, `cuisineID`) VALUES ("Daisy Family Traditions", 3, 4);

INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (1,1,0);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (1,2,1);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (1,3,1);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (3,1,1);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (3,2,1);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (3,3,1);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (2,1,1);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (2,2,0);
INSERT INTO `reviews_restaurants_customers` (`customerID`,`restaurantID`,`review`) VALUES (2,3,1);

UPDATE `restaurants` 
SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = 1)
WHERE `id` = 1;
UPDATE `restaurants` 
SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = 2)
WHERE `id` = 2;
UPDATE `restaurants` 
SET `rating` = (SELECT AVG (review) FROM `reviews_restaurants_customers` WHERE `restaurantID` = 3)
WHERE `id` = 3;