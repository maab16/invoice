-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2017 at 12:54 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_num` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `invoice_id`, `item_num`, `item_name`, `price`, `qty`, `total`, `created_at`, `updated_at`) VALUES
(83, 25, 1, 'Mango', 150, 10, 1500, '2017-08-15 12:13:19', '2017-08-15 12:13:19'),
(84, 25, 3, 'Dairy Milk', 60, 10, 600, '2017-08-15 12:13:19', '2017-08-15 12:13:19'),
(85, 25, 2, 'Rice', 2700, 1, 2700, '2017-08-15 12:13:20', '2017-08-15 12:13:20'),
(86, 25, 4, 'Cofee', 50, 1, 50, '2017-08-15 12:13:20', '2017-08-15 12:13:20'),
(90, 26, 1, 'Mango', 150, 1, 150, '2017-08-15 12:14:36', '2017-08-15 12:14:36'),
(91, 26, 3, 'Dairy Milk', 60, 1, 60, '2017-08-15 12:14:36', '2017-08-15 12:14:36'),
(92, 26, 4, 'Cofee', 50, 15, 750, '2017-08-15 12:14:36', '2017-08-15 12:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Md Abu Ahsan Basir', '47/19, New Chashara, Jamtola, Fatullah, Narayanganj', '2017-08-13 00:00:00', '2017-08-13 00:00:00'),
(2, 'MD Abu Bakkar', '1/1 Shere Bangla road', '2017-08-13 00:00:00', '2017-08-13 00:00:00'),
(3, 'Ibrahim Hossain', 'Mirpur,Dhaka', '2017-08-13 00:00:00', '2017-08-13 00:00:00'),
(4, 'Subrata Dev Nath', 'Farmgate Dhaka', '2017-08-13 00:00:00', '2017-08-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Mango', 150, '2017-08-14 00:00:00', '2017-08-14 00:00:00'),
(2, 'Rice', 2700, '2017-08-14 00:00:00', '2017-08-14 00:00:00'),
(3, 'Dairy Milk', 60, '2017-08-14 00:00:00', '2017-08-14 00:00:00'),
(4, 'Cofee', 50, '2017-08-14 00:00:00', '2017-08-14 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
