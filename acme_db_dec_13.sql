-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 11:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(1, 'Nik', 'Tek', 'teknik@booty.edu', '$2y$10$gn/GZYq5W5te31FDHVXxJeix/J3ZQgxWwBddkYud9594wK4xLCXcS', '1', ''),
(8, 'Admin', 'User', 'admin@cit336.net', '$2y$10$rOrTUbLdzdCt494d9KEO.ej0u8HCBSKrytjX9AFYnQRyHMe8uEw4S', '3', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(5, 2, 'rocket.png', '/acme/images/products/rocket.png', '2017-11-26 04:29:32'),
(6, 2, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2017-11-26 04:29:32'),
(7, 4, 'catapult.png', '/acme/images/products/catapult.png', '2017-11-26 04:29:42'),
(8, 4, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2017-11-26 04:29:42'),
(9, 16, 'helmet.png', '/acme/images/products/helmet.png', '2017-11-26 04:30:04'),
(10, 16, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2017-11-26 04:30:04'),
(11, 5, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2017-11-26 04:30:09'),
(12, 5, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2017-11-26 04:30:09'),
(13, 6, 'trap.jpg', '/acme/images/products/trap.jpg', '2017-11-26 04:30:22'),
(14, 6, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2017-11-26 04:30:22'),
(15, 15, 'piano.jpg', '/acme/images/products/piano.jpg', '2017-11-26 04:30:27'),
(16, 15, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2017-11-26 04:30:27'),
(17, 7, 'hole.png', '/acme/images/products/hole.png', '2017-11-26 04:30:36'),
(18, 7, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2017-11-26 04:30:36'),
(19, 8, 'no-image.png', '/acme/images/products/no-image.png', '2017-11-26 04:30:41'),
(20, 8, 'no-image-tn.png', '/acme/images/products/no-image-tn.png', '2017-11-26 04:30:41'),
(21, 9, 'anvil.png', '/acme/images/products/anvil.png', '2017-11-26 04:30:56'),
(22, 9, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2017-11-26 04:30:56'),
(23, 20, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2017-11-26 04:31:11'),
(24, 20, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2017-11-26 04:31:11'),
(25, 12, 'mallet.png', '/acme/images/products/mallet.png', '2017-11-26 04:31:15'),
(26, 12, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2017-11-26 04:31:15'),
(27, 11, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2017-11-26 04:31:40'),
(28, 11, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2017-11-26 04:31:40'),
(29, 17, 'rope.jpg', '/acme/images/products/rope.jpg', '2017-11-26 04:31:49'),
(30, 17, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2017-11-26 04:31:49'),
(31, 14, 'seed.jpg', '/acme/images/products/seed.jpg', '2017-11-26 04:31:53'),
(32, 14, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2017-11-26 04:31:53'),
(33, 19, 'bomb.png', '/acme/images/products/bomb.png', '2017-11-26 04:32:18'),
(34, 19, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2017-11-26 04:32:18'),
(35, 18, 'fence.png', '/acme/images/products/fence.png', '2017-11-26 04:32:27'),
(36, 18, 'fence-tn.png', '/acme/images/products/fence-tn.png', '2017-11-26 04:32:27'),
(37, 13, 'tnt.png', '/acme/images/products/tnt.png', '2017-11-26 04:32:31'),
(38, 13, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2017-11-26 04:32:31'),
(39, 7, 'sweatPig.jpg', '/acme/images/products/sweatPig.jpg', '2017-11-26 05:36:08'),
(40, 7, 'sweatPig-tn.jpg', '/acme/images/products/sweatPig-tn.jpg', '2017-11-26 05:36:08'),
(41, 7, 'oh_my.jpg', '/acme/images/products/oh_my.jpg', '2017-11-26 05:36:47'),
(42, 7, 'oh_my-tn.jpg', '/acme/images/products/oh_my-tn.jpg', '2017-11-26 05:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(11) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invStock` smallint(6) NOT NULL DEFAULT '0',
  `invSize` smallint(6) NOT NULL DEFAULT '0',
  `invWeight` smallint(6) NOT NULL DEFAULT '0',
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(2, 'Back-mounted Rocket', 'Rocket for multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast!', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '1320.00', 5, 60, 90, 'California', 4, 'Goddard', 'metal'),
(3, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(4, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(5, 'Female RoadRuner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(6, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(7, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(8, 'Koenigsegg CCX', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '500000.00', 1, 25000, 3000, 'San Jose', 3, 'Koenigsegg', 'Metal'),
(9, 'Large Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '150.00', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(10, 'Medium Anvil', 'This solid iron 35 lb. anvil is sure to crush anything under it and provide a solid surface for all metal on it.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '65.00', 5000, 60, 35, 'San Jose', 5, 'Steel Made', 'Metal'),
(11, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(12, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(13, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(14, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs can\'t resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(15, 'Grand Piano', 'This upright grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(16, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(17, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(18, 'Sticky Fence', 'This fence is covered with Gorilla Glue and is guaranteed to stick to anything that touches it and is sure to hold it tight.', '/acme/images/products/fence.png', '/acme/images/products/fence-tn.png', '75.00', 15, 48, 2, 'San Jose', 3, 'Acme', 'Nylon'),
(19, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal'),
(20, 'Large Mortar', 'This mortar is great for getting over those large mountains that get in the way.', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '125.00', 2, 207, 87, 'Las Vegas', 1, 'Mortar Baby', 'Metal'),
(22, 'Rubber Boa', 'Realistic', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '12.00', 3, 90, 2, 'Bangkok', 7, 'Thai Novelties', 'Rubber');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(7, 'Shabadabood', '2017-12-13 22:06:54', 7, 1),
(8, 'I love my life', '2017-12-13 19:52:35', 7, 1),
(10, 'I flew too far, and then I exploded! Do not recommend for cheap travel!', '2017-12-13 22:11:09', 2, 1),
(11, 'Love it! I&#39;m not a robot!', '2017-12-13 22:12:50', 2, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `fk_reviews_1` (`invId`),
  ADD KEY `fk_reviews_2` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
