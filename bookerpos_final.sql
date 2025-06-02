-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 02, 2025 at 09:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookerpos_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(65) NOT NULL,
  `productDesc` text NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productStock` int(11) NOT NULL,
  `ProductCategory` varchar(65) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productDesc`, `productPrice`, `productStock`, `ProductCategory`, `image`) VALUES
(1234510, 'Normal People by Sally Rooney', 'Explores the complex and evolving relationship between two young people, Marianne and Connell, as they navigate class, first love, and identity through their college years and beyond.', 230.00, 96, 'Fiction', 'uploads/normal_people.jpg'),
(1234511, 'Atomic Habits byJames Clear', 'Offers a practical framework for improving daily habits, achieving significant results through small, consistent changes, and building systems for long-term growth.', 180.00, 97, 'Self-Help', 'uploads/atomic_habits.jpg'),
(1234512, 'Watchmen', 'A deconstructionist superhero story exploring themes of power, morality, and the human condition in an alternate 1980s. By Alan Moore.', 200.00, 98, 'Graphic Novel', 'uploads/watchmen.jpg'),
(1234513, 'Chronicles', 'A memoir offering a kaleidoscopic look into the life and times of the iconic musician, focusing on key periods of his career and artistic development. By Bob Dylan.', 500.00, 88, 'Non-Fiction', 'uploads/chronicles.jpg'),
(1234514, 'My Hero Academia', 'In a world where superpowers (Quirks) are common, a Quirkless boy inherits a powerful Quirk and enrolls in a prestigious hero academy to become the greatest hero. By Kohei Horikoshi.', 460.00, 99, 'Manga', 'uploads/myheroacademia.jpg'),
(1234515, 'The Diary of a Young Girl', 'The poignant and intimate diary entries of a Jewish teenager hiding from the Nazis during World War II, offering a personal perspective on the Holocaust. By Anne Frank.', 310.00, 100, 'Non-Fiction', 'uploads/thediaryofayounggirl.jpg'),
(1234516, 'Batman: The Killing Joke', 'A dark and controversial story exploring the psychological origins of the Joker and his devastating impact on Batman and Commissioner Gordon. By Alan Moore.', 300.00, 100, 'Graphic Novel', 'uploads/batmanthekillingjoke.jpg'),
(1234517, 'The Daily Stoic', 'A daily devotional offering practical wisdom and exercises based on the ancient philosophy of Stoicism, aiming to help readers cultivate virtue, resilience, and inner peace. By Ryan Holiday.', 600.00, 100, 'Self-Help', 'uploads/thedailystoic.jpg'),
(1234518, 'The Subtle Art of Not Giving a Fuck', 'A counterintuitive self-help book that challenges conventional wisdom, arguing that true happiness comes from embracing life\'s inevitable struggles and choosing what truly matters. By Mark Manson.', 120.00, 97, 'Self-Help', 'uploads/thesubtleartofnotgivingafuck.jpg'),
(1234519, 'Diary of a Wimpy Kid', 'The illustrated journal of a middle schooler navigating the challenges of adolescence, friendship, and family life with a humorous and relatable perspective. By Jeff Kinney.', 530.00, 70, 'Fiction', 'uploads/diaryofawimpykid.jpg'),
(1234520, 'The Badboy and the Tomboy', 'A Wattpad novel about a seemingly mismatched pair who find unexpected connection and romance. By Nicole Nwosu.', 230.00, 40, 'Fiction', 'uploads/thebadboyandthetomboy.jpg'),
(1234521, 'The Shack', 'A man grappling with immense grief and spiritual doubt after a family tragedy receives a mysterious invitation to an isolated shack, leading to an extraordinary encounter with the divine. By William P. Young.', 11.00, 35, 'Fiction', 'uploads/theshack.jpg'),
(1234560, 'The Hunger Games Series by Suzanne Collins', 'In a dystopian future, teenagers are selected by lottery to participate in a televised fight to the death as a punishment and deterrent against rebellion.', 26.00, 45, 'Fiction', 'uploads/hunger_games_series.jpg'),
(1234567, 'Once Upon an expat', '\"Once Upon An Expat\" is a genre-bending anthology, a compilation of short stories and essays that explore the diverse experiences of expatriates around the world. It\'s not a single, unified story, but rather a collection of narratives, offering a window into the lives, adventures, and challenges faced by people living and working abroad.', 890.00, 90, 'Genre-bending anthology', 'uploads/Once upon an exapt.jpg'),
(1234568, 'The name of the Wind', 'The Name of the Wind, also referred to as The Kingkiller Chronicle: Day One, is a heroic fantasy novel written by American author Patrick Rothfuss. It is the first book in the ongoing fantasy trilogy The Kingkiller Chronicle, followed by The Wise Man\'s Fear.', 120.00, 97, 'Fantasy fiction', 'uploads/the name of the wind.jpg'),
(4550419, 'Percy Jackson The sea of monster!', 'The son of Poseidon', 450.00, 11, 'Fantasy Fiction', 'uploads/percy-jackson-book-covers-the-sea-of-monsters-us-1-621x1024.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitems`
--

CREATE TABLE `purchaseitems` (
  `id` int(11) NOT NULL,
  `purchaseID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchaseitems`
--

INSERT INTO `purchaseitems` (`id`, `purchaseID`, `productID`, `quantity`) VALUES
(144, 5068393, 4550419, 10),
(145, 2906965, 4550419, 5),
(146, 4107216, 1234518, 3),
(147, 4107216, 1234568, 3),
(148, 4107216, 4550419, 3),
(149, 3677245, 4550419, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchaseID` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL,
  `invoiceNo` varchar(50) NOT NULL,
  `datePurchased` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchaseID`, `supplierID`, `invoiceNo`, `datePurchased`) VALUES
(2906965, 4128992, '4491442', '2025-06-02 06:09:20'),
(3677245, 8381964, '1744528', '2025-06-02 06:13:28'),
(4107216, 8381964, '2926379', '2025-06-02 06:09:43'),
(5068393, 8381964, '1585353', '2025-06-02 06:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `returnID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `returnQuantity` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `returnDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`returnID`, `purchaseID`, `productID`, `returnQuantity`, `reason`, `returnDate`) VALUES
(14, 4107216, 1234518, 2, 'sdfdsf', '2025-06-02 06:10:25'),
(15, 4107216, 1234568, 2, 'kfsldflksf', '2025-06-02 06:10:25'),
(16, 4107216, 4550419, 2, 'sdfdfds', '2025-06-02 06:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesID` int(11) NOT NULL,
  `itemQuantity` int(11) NOT NULL,
  `totalSales` float(10,2) NOT NULL,
  `salesDate` date NOT NULL,
  `invoiceNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesID`, `itemQuantity`, `totalSales`, `salesDate`, `invoiceNumber`) VALUES
(60, 3, 690.00, '2025-06-02', 2411067),
(61, 9, 3060.00, '2025-06-02', 97728),
(62, 6, 2700.00, '2025-06-02', 8833064);

-- --------------------------------------------------------

--
-- Table structure for table `salesitems`
--

CREATE TABLE `salesitems` (
  `salesItemID` int(11) NOT NULL,
  `salesID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesitems`
--

INSERT INTO `salesitems` (`salesItemID`, `salesID`, `productID`, `quantity`, `price`) VALUES
(69, 60, 1234518, 2, 120.00),
(70, 60, 4550419, 1, 450.00),
(71, 61, 1234518, 1, 120.00),
(72, 61, 1234568, 2, 120.00),
(73, 61, 4550419, 6, 450.00),
(74, 62, 4550419, 6, 450.00);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(65) NOT NULL,
  `Contact` varchar(25) NOT NULL,
  `Address` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierID`, `supplierName`, `Contact`, `Address`) VALUES
(4128992, 'Kate Company', '091234567892', 'Clarin'),
(8381964, 'Poseidon King of the Sea', '555555', 'Olympus -');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`) VALUES
('fiel', '$2y$10$hKTdfJi1shfYV16x1SGNqevIBw/Fc.lUggLV/jDVeJx9QpiKnG9hm', 'Cashier'),
('kate', '$2y$10$2RChcPVyv21cbc/D8FMlxOHry8V6CEel979tTexeim6BZVeitcGra', 'Cashier'),
('mac25', '$2y$10$6fbvJt9rtFduxV2Ik7Yoc.B2DuD9Y9vQ8hcMf59RS8Su2RwG39NTG', 'Admin'),
('Percy', '$2y$10$d0RmLvCorxXxhJq6DkGtJ.PDeuuvgaHiAM260xRAToH5C0KomPeJa', 'Cashier'),
('rain', '$2y$10$VCAYd1D7SBOpdB8Wc3RAmusJVwE0VgNOgSc6KLXAlt0YjdkKdJaMS', 'Admin'),
('Sally', '$2y$10$TvL7gNwkM8meezv5lLS1quxuJviNjbIYRW6SLG50Qn6C89Uq/QPRa', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchaseID` (`purchaseID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `fk_supplier` (`supplierID`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`returnID`),
  ADD KEY `purchaseID` (`purchaseID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`);

--
-- Indexes for table `salesitems`
--
ALTER TABLE `salesitems`
  ADD PRIMARY KEY (`salesItemID`),
  ADD KEY `fk_salesitems_sales` (`salesID`),
  ADD KEY `fk_salesitems_product` (`productID`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5915679;

--
-- AUTO_INCREMENT for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `returnID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `salesitems`
--
ALTER TABLE `salesitems`
  MODIFY `salesItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD CONSTRAINT `purchaseitems_ibfk_1` FOREIGN KEY (`purchaseID`) REFERENCES `purchases` (`purchaseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `fk_supplier` FOREIGN KEY (`supplierID`) REFERENCES `suppliers` (`supplierID`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`purchaseID`) REFERENCES `purchases` (`purchaseID`),
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
