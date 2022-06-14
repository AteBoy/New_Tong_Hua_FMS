-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 09:23 AM
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
  `admin_contact` varchar(12) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `admin_key` int(6) DEFAULT NULL,
  `admin_role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`, `admin_contact`, `address`, `admin_key`, `admin_role`) VALUES
(1001, 'Shio', 'shio123', '09369888542', 'Daraga', 42069, 'Owner'),
(1002, 'Shiori', 'shio321', '09361386954', 'Albay', 393203, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(6) NOT NULL,
  `customer_name` varchar(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `item_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `stock`, `item_name`) VALUES
(16, 'shiori', 20, 'Pink Cloth'),
(17, 'earl', 100, 'Red Cloth');

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
(15, 1003, 69, 69, 'Asset', '2022-05-16', 'yes'),
(16, 1001, 43, 50, 'Assets', '2022-05-16', 'dwa'),
(17, 2000, 42, 32, 'Liability', '2022-05-16', 'dwa'),
(19, 2000, 12, 12, 'Liability', '2022-05-16', 'dwa');

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
(135, 3000, '2022-06-10', 1, 'Pink Cloth', 'Cloth', 100, 100, 10000, 'Owners Equ', 69, 16, 'idk'),
(136, 1003, '2022-06-10', 1, 'Red Cloth', 'Cloth', 100, 200, 20000, 'Asset', 0, 69, 'dwdwa'),
(137, 1003, '2022-06-10', 2, 'Pink Cloth', 'Cloth', 20, 100, 2000, 'Asset', 69, 0, 'dwadwa'),
(138, 2000, '2022-06-13', 1, 'Pink Cloth', 'Cloth', 100, 30, 3000, 'Liability', 4, 100, 'dwadwa'),
(139, 1001, '2022-06-13', 1, 'Red Button', 'Button', 33, 100, 3300, 'Assets', 11, 11, 'dwadaw'),
(140, 1003, '2022-06-13', 1, 'Pink Cloth', 'Cloth', 10, 1000, 10000, 'Asset', 11, 11, 'dwada');

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
  `logout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `admin_id`, `login`, `logout`) VALUES
(1, 1001, '2022-05-26 14:39:11', '2022-05-26 14:39:39'),
(2, 1002, '2022-05-26 14:40:04', '2022-05-26 14:40:09'),
(3, 1002, '2022-05-26 14:41:14', '2022-05-26 16:52:50'),
(4, 1001, '2022-05-26 16:50:39', '2022-05-26 16:52:50'),
(5, 1001, '2022-05-26 16:52:14', '2022-05-26 16:52:50'),
(6, 1001, '2022-05-30 13:26:49', '2022-06-02 15:16:12'),
(7, 1001, '2022-05-31 13:15:08', '2022-06-02 15:16:12'),
(8, 1001, '2022-06-01 13:28:43', '2022-06-02 15:16:12'),
(9, 1001, '2022-06-02 13:22:14', '2022-06-02 15:16:12'),
(10, 1001, '2022-06-05 14:13:44', '2022-06-13 14:14:46'),
(11, 1001, '2022-06-06 14:44:12', '2022-06-13 14:14:46'),
(12, 1001, '2022-06-09 13:49:45', '2022-06-13 14:14:46'),
(13, 1001, '2022-06-10 14:13:49', '2022-06-13 14:14:46'),
(14, 1001, '2022-06-12 14:02:42', '2022-06-13 14:14:46'),
(15, 1001, '2022-06-13 13:33:57', '2022-06-13 14:14:46'),
(16, 1001, '2022-06-13 13:58:57', '2022-06-13 14:14:46'),
(17, 1001, '2022-06-13 14:10:48', '2022-06-13 14:14:46'),
(18, 1001, '2022-06-13 14:14:54', '2022-06-13 14:17:27'),
(19, 1001, '2022-06-13 14:17:41', '2022-06-13 14:18:35'),
(20, 1001, '2022-06-13 14:18:56', '2022-06-13 14:20:24'),
(21, 1001, '2022-06-13 14:35:46', '2022-06-13 14:36:29'),
(22, 1001, '2022-06-13 14:36:49', '2022-06-14 09:14:11'),
(23, 1001, '2022-06-14 09:11:48', '2022-06-14 09:14:11'),
(24, 1001, '2022-06-14 09:13:03', '2022-06-14 09:14:11'),
(25, 1001, '2022-06-14 09:15:08', '2022-06-14 09:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `item_id` int(6) NOT NULL,
  `item_name` varchar(20) DEFAULT NULL,
  `item_category` varchar(20) DEFAULT NULL,
  `item_stock` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`item_id`, `item_name`, `item_category`, `item_stock`) VALUES
(3, 'Pink Cloth', 'Cloth', 890),
(4, 'Red Cloth', 'Cloth', -50),
(5, 'Red Button', 'Button', 100);

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
(7, 1003, '2022-06-10', 'Shio', 'Pink Cloth', 'Cloth', 200, 100, 20000, 'Asset', 69, 100, 'dwadaw'),
(8, 1003, '2022-06-10', 'Shio', 'Red Cloth', 'Cloth', 60, 50, 3000, 'Asset', 11, 11, 'dwadwa'),
(10, 1003, '2022-06-10', 'shiori', 'Pink Cloth', 'Cloth', 100, 10, 1000, 'Asset', 11, 11, 'dwadwa'),
(12, 1003, '2022-06-13', 'shiori', 'Pink Cloth', 'Cloth', 1, 100, 100, 'Asset', 33, 100, 'dwadwa'),
(13, 2000, '2022-06-13', 'earl', 'Red Cloth', 'Cloth', 5, 100, 500, 'Liability', 11, 11, 'dwadwa'),
(14, 2000, '2022-06-13', 'earl', 'Red Cloth', 'Cloth', 5, 100, 500, 'Liability', 11, 11, 'dwadwa'),
(15, 1003, '2022-06-13', 'shiori', 'Pink Cloth', 'Cloth', 100, 10, 1000, 'Asset', 1, 1, 'dwa');

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

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(6) NOT NULL,
  `tag_code` varchar(6) NOT NULL,
  `tag_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `fk_adminLogs` (`admin_id`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`item_id`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3001;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `general_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `journal_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `item_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(6) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_adminLogs` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
