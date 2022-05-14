-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2022 at 02:51 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `financial_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(6) NOT NULL,
  `account_name` varchar(20) DEFAULT NULL,
  `account_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_type`) VALUES
(1001, 'Cash', 'Assets'),
(1003, 'Yes', 'Asset'),
(2000, 'Account Receivable', 'Liability'),
(3000, 'Common Stock', 'Owners Equ');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(6) NOT NULL,
  `admin_name` varchar(20) DEFAULT NULL,
  `admin_pass` varchar(10) DEFAULT NULL,
  `admin_contact` varchar(11) NOT NULL,
  `address` varchar(20) NOT NULL,
  `admin_key` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`, `admin_contact`, `address`, `admin_key`) VALUES
(1000, 'notshio', 'shio123', '54554354', 'Daraga', 42069),
(1001, 'reil', 'shio321', '54554354', 'Daraga', 421111);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(6) NOT NULL,
  `customer_name` varchar(10) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `stock`) VALUES
(1, 'earl', 10),
(2, 'earl', 10),
(3, 'earl', 10),
(4, 'earl', 1),
(5, 'earl', 2),
(6, 'earl', 23),
(7, 'earl', 32),
(8, 'earl', 32),
(9, 'dwa', 32),
(10, 'earl', 20),
(11, 'shio', 20),
(12, 'hi', 10),
(13, 'John', 10),
(14, 'dwa', 32),
(15, 'Reil', 50);

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `general_id` int(6) NOT NULL,
  `account_id` int(6) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `journal` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `explanation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`general_id`, `account_id`, `debit`, `credit`, `journal`, `date`, `explanation`) VALUES
(1, 1001, 33, 22, 'Assets', '2022-05-05', ''),
(8, 2000, 100, 100, 'Liability', '2022-05-14', 'y'),
(9, 3000, 200, 200, 'Owners Equ', '2022-05-14', 'e'),
(11, 3000, 100, 100, 'Owners Equ', '2022-05-14', 'yesss'),
(12, 1001, 1200, 1200, 'Assets', '2022-05-14', 'yesss'),
(13, 3000, 69, 69, 'Owners Equ', '2022-05-14', 'no'),
(14, 1003, 3, 3, 'Asset', '2022-05-14', '3');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(6) NOT NULL,
  `account_id` int(6) NOT NULL,
  `inv_date` date NOT NULL,
  `supplier_id` int(6) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float NOT NULL,
  `journal` varchar(20) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `Explanation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `account_id`, `inv_date`, `supplier_id`, `item_name`, `category`, `price`, `quantity`, `total`, `journal`, `debit`, `credit`, `Explanation`) VALUES
(2, 1001, '2022-04-20', 1, 'red cloth', 'pink', 100, 10, 1000, 'Asset', 1000, 0, ''),
(31, 2000, '2022-05-14', 1, 'DWA', 'DWA', 2, 32, 64, 'Liability', 32, 32, 'DWA'),
(32, 2000, '2022-05-14', 1, 'DWA', 'DWA', 2, 32, 64, 'Liability', 32, 32, 'DWA'),
(33, 1001, '2022-05-14', 1, 'dwa', 'dwa', 2, 32, 64, 'Assets', 69, 69, 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `journal_id` int(5) NOT NULL,
  `journal_entry` int(5) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(6) NOT NULL,
  `admin_id` int(6) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `admin_id`, `login`, `logout`) VALUES
(54, 1000, '2022-05-14 13:56:50', '2022-05-14 13:57:01'),
(55, 1000, '2022-05-14 13:57:09', '2022-05-14 13:57:21'),
(56, 1000, '2022-05-14 13:57:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(6) NOT NULL,
  `account_id` int(6) NOT NULL,
  `sales_date` date NOT NULL,
  `buyer_name` varchar(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float NOT NULL,
  `journal` varchar(20) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `explanation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `account_id`, `sales_date`, `buyer_name`, `item_name`, `category`, `price`, `quantity`, `total`, `journal`, `debit`, `credit`, `explanation`) VALUES
(4, 1001, '2022-05-05', 'hi', 'pink', 'cloth', 5, 10, 50, 'Assets', 0, 0, ''),
(5, 2000, '2022-05-14', 'reil', 'Pink Ribbon', 'Ribbon', 3, 50, 150, 'Liability', 69, 69, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_ID` int(6) NOT NULL,
  `supplier_name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_ID`, `supplier_name`, `address`, `contact`) VALUES
(1, 'shiori', 'daraga', '09369888542'),
(2, 'earl', 'daraga', '09324152321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`general_id`),
  ADD KEY `fk_gen_acc` (`account_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`journal_id`),
  ADD KEY `journal_entry` (`journal_entry`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `fk_account` (`account_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3001;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `general_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `journal_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `general`
--
ALTER TABLE `general`
  ADD CONSTRAINT `fk_gen_acc` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_ID`);

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `fk_journal_entry` FOREIGN KEY (`journal_entry`) REFERENCES `inventory` (`inventory_id`),
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`journal_entry`) REFERENCES `sales` (`sales_id`),
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`journal_entry`) REFERENCES `general` (`general_id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
