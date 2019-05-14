-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: Nov 24, 2018 at 07:30 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_dunnbrit`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`id`, `type`) VALUES
(1, 'italian'),
(2, 'southern'),
(3, 'fast food'),
(4, 'comfort food'),
(29, 'Japanese'),
(30, 'Mexican'),
(31, 'Indian'),
(32, 'vietnamese'),
(33, 'dessert'),
(34, 'Hot Garbage'),
(35, 'Vegan'),
(36, 'Sandwiches'),
(37, 'testtype'),
(38, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `cuisineID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fname`, `lname`, `email`, `birthdate`, `cuisineID`) VALUES
(1, 'Mario', 'Kart', '', '1990-10-12', 36),
(2, 'Peach', 'Princess', 'princess@gmail.com', '1990-05-12', 2),
(3, 'Bowser', 'Baby', 'bb@gmail.com', '2000-06-13', 4),
(4, 'Yoshi', 'Green', 'yoshi@gmail.com', NULL, 3),
(13, 'Lexi', 'Dog', 'lexi@heckingoodpupper.net', '2009-05-15', 3),
(14, 'John', 'Goodfood', 'ieatgood@foot.eat', '1990-01-01', 30),
(15, 'Dale', 'Cooper', 'dbcooper@fbi.com', '1964-11-29', 4),
(16, 'meep', 'meep', 'meep@meep.net', '2018-11-07', 2),
(17, 'Sam', 'Bot', 'sam@bot.net', '2018-10-14', 4),
(19, 'Jebediah', 'Springfield', 'hanssprungfeld@pirate.net', '2018-11-22', 4),
(22, 'Fat', 'Slob', 'bubba@bubba.com', '2018-11-30', 34),
(23, 'John', 'Cash', 'maninblack@folsomprison.com', '0000-00-00', 1),
(24, 'Bob', 'Smith', 'at@at.com', '2018-12-31', 2),
(49, 'Test', 'Test', 'Test@test.com', '1990-01-01', 34),
(50, 'testerR', 'testerM', 'test@test.test', '2018-11-05', 29),
(51, 'meep', 'woot', 'meep@woot.com', '2018-11-05', 29),
(52, 'Some', 'Guy', 'someguy@email.com', '2018-01-31', 2),
(53, 'testuser', 'tt', 't@t.com', '0000-00-00', 37),
(54, 'first', 'last', 'email@email.com', '0011-11-11', 35);

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic`
--

CREATE TABLE `diagnostic` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnostic`
--

INSERT INTO `diagnostic` (`id`, `text`) VALUES
(1, 'MySQL is Working!');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `suite` int(11) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `street_name`, `suite`, `city`, `state`, `zip`) VALUES
(1, 'East Street', NULL, 'Atlanta', 'GA', 30301),
(2, 'West Street', NULL, 'Portland', 'OR', 97035),
(3, 'North Street', NULL, 'Phoenix', 'AZ', 85001),
(4, 'South Street', NULL, 'Denver', 'CO', 80014),
(23, '234 Street Street', 6, 'American City', 'AL', 99995),
(24, '123 Main', 0, 'Twin Peaks', 'OR', 97401),
(25, '123 Rainbow Rd', 0, 'Best', 'AL', 12345),
(26, '343 W Monroe', 0, 'Eugene', 'OR', 97402),
(27, '999 Legit St Rd', 0, 'Anytown', 'US', 125),
(28, '1234 Main St', 0, 'Seattle', 'WA', 773),
(31, '123 DogTown', 0, 'Jaxville', 'FL', 4581),
(32, '7922 Antoine Drive', 0, 'Houston', 'Tx', 77088),
(33, 'street', NULL, 'new york', 'NY', 11111),
(34, '111 Main ST', 345, 'Smallton', 'OR', 97777),
(35, 'Sumo Dog', 15, 'Santa Monica', 'CA', 90401),
(36, 'st', 12, 'city', 'OR', 97330),
(37, 'test', 1, 'testcity', 'OR', 97330),
(38, '456 Street', 0, 'city', 'ny', 11111);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `locationID` int(11) NOT NULL,
  `cuisineID` int(11) NOT NULL,
  `rating` decimal(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `locationID`, `cuisineID`, `rating`) VALUES
(1, 'Toad\'s Kitchen', 1, 2, '1.00'),
(2, 'Lugi\'s Pizzeria', 4, 1, '0.25'),
(3, 'Shell Fast Food', 2, 3, '0.60'),
(4, 'Daisy Family Traditions', 3, 4, '1.00'),
(20, 'Super Good Food', 23, 2, '0.00'),
(21, 'Double R Diner', 24, 4, '0.33'),
(23, 'All Cakes', 26, 4, '0.67'),
(24, 'McDarnells', 27, 3, '0.83'),
(26, 'Applebees', 28, 34, '0.50'),
(27, 'Scooby Snacks', 31, 33, '0.50'),
(36, 'Pizza Time', 34, 1, '1.00'),
(37, 'Sumo Dog', 35, 29, '0.00'),
(38, 'testrestaurant', 37, 1, '0.00'),
(39, 'other', 38, 33, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews_restaurants_customers`
--

CREATE TABLE `reviews_restaurants_customers` (
  `customerID` int(11) DEFAULT NULL,
  `restaurantID` int(11) NOT NULL,
  `review` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews_restaurants_customers`
--

INSERT INTO `reviews_restaurants_customers` (`customerID`, `restaurantID`, `review`) VALUES
(3, 3, 1),
(3, 21, 1),
(2, 1, 1),
(24, 23, 1),
(24, 21, 0),
(13, 2, 0),
(13, 21, 0),
(13, 3, 0),
(13, 3, 0),
(13, 27, 0),
(13, 4, 1),
(24, 24, 1),
(NULL, 24, 1),
(NULL, 24, 1),
(NULL, 26, 0),
(NULL, 26, 0),
(NULL, 26, 1),
(NULL, 26, 1),
(NULL, 26, 0),
(49, 24, 1),
(49, 26, 1),
(50, 1, 1),
(50, 3, 1),
(50, 3, 1),
(49, 23, 1),
(2, 2, 1),
(1, 23, 0),
(1, 1, 1),
(1, 2, 0),
(1, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `cuisineID` (`cuisineID`);

--
-- Indexes for table `diagnostic`
--
ALTER TABLE `diagnostic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locationID` (`locationID`),
  ADD KEY `cuisineID` (`cuisineID`);

--
-- Indexes for table `reviews_restaurants_customers`
--
ALTER TABLE `reviews_restaurants_customers`
  ADD KEY `customerID` (`customerID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `diagnostic`
--
ALTER TABLE `diagnostic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`cuisineID`) REFERENCES `cuisine` (`id`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `restaurants_ibfk_2` FOREIGN KEY (`cuisineID`) REFERENCES `cuisine` (`id`);

--
-- Constraints for table `reviews_restaurants_customers`
--
ALTER TABLE `reviews_restaurants_customers`
  ADD CONSTRAINT `reviews_restaurants_customers_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_restaurants_customers_ibfk_2` FOREIGN KEY (`restaurantID`) REFERENCES `restaurants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
