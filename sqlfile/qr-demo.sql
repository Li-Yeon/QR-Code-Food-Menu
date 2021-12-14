-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 08:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr-demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `No` int(10) UNSIGNED NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`No`, `Category`) VALUES
(1, 'Asian'),
(2, 'Beverages'),
(3, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `No` int(10) UNSIGNED NOT NULL,
  `food_Code` varchar(255) NOT NULL,
  `food_Name` varchar(255) NOT NULL,
  `food_Price` double NOT NULL,
  `food_Category` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`No`, `food_Code`, `food_Name`, `food_Price`, `food_Category`, `Image`) VALUES
(1, 'FD001', 'Nasi Goreng Indonesia', 7.5, 'Asian', './images/nasi_goreng.jpg'),
(2, 'FD002', 'Nasi Goreng Ayam', 7.5, 'Asian', './images/nasi_goreng_a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `No` int(11) NOT NULL,
  `TableNo` varchar(255) NOT NULL,
  `food_Code` varchar(255) NOT NULL,
  `food_Name` varchar(255) NOT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`No`, `TableNo`, `food_Code`, `food_Name`, `Remarks`, `Quantity`) VALUES
(27, '1', 'FD001', 'Nasi Goreng Indonesia', '', 7),
(28, '2', 'FD002', 'Nasi Goreng Ayam', '', 2),
(30, '1', 'FD001', 'Nasi Goreng Indonesia', 'Less Veggies', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `No` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`No`, `Name`, `Username`, `Password`) VALUES
(1, 'qwe', 'qwe', '$2y$10$egEZ.pUiKdy2lvOktu20guNIFmKoHmSERtWytBtwnX1MoYlBL94PW'),
(2, 'test', 'test', '$2y$10$RnSxFxhivvbKLvZvP9QLL.VfB/aculKL5J5G9LjZENdd.cUPdvhQy'),
(3, 'Leon', 'leon', '$2y$10$98SXevhnmgFcpMbN8j4jjua6NX6k1unt3EIAi/uu3VwuDS.O.nBgK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `No` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `No` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `No` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
