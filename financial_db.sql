-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 05:28 PM
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
(2000, 'Account Receivable', 'Liability');

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
  `customer_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `customer_name` varchar(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `item_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `stock`, `item_name`) VALUES
(0016, 'shiori', 30, 'Pink Cloth'),
(0017, 'earl', 100, 'Red Cloth'),
(0018, 'Reil', 230, 'Blue Cloth'),
(0027, 'Reil', 10, 'Red Cloth'),
(0028, 'Shio', 120, 'Red Cloth'),
(0029, 'shio', 360, 'Blue Cloth'),
(0030, 'reil', 100, 'Green Cloth'),
(0031, 'fang', 10, 'Green Cloth');

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
(19, 2000, 12, 12, 'Liability', '2022-05-16', 'dwa'),
(20, 1003, 20, 20, 'Asset', '2022-07-09', 'dwadaw');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_posting_id` varchar(10) NOT NULL,
  `account_id` int(6) NOT NULL,
  `inv_date` date NOT NULL,
  `inventory_entry_id` varchar(20) NOT NULL,
  `supplier_id` int(6) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `inv_amount` float NOT NULL,
  `Explanation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_posting_id`, `account_id`, `inv_date`, `inventory_entry_id`, `supplier_id`, `item_name`, `category`, `price`, `quantity`, `total`, `debit`, `credit`, `inv_amount`, `Explanation`) VALUES
('PS-000008', 1003, '2022-07-17', 'INV-000004', 1, 'Blue Button', 'Button', 20, 150, 3000, 0, -100, -100, 'HAHA'),
('PS-000009', 1003, '2022-07-17', 'INV-000004', 1, '0', '0', 0, 0, 0, 200, 0, 200, 'HAHA'),
('PS-000010', 1003, '2022-07-17', 'INV-000004', 1, '0', '0', 0, 0, 0, 0, -300, -300, 'HAHA'),
('PS-000011', 1003, '2022-07-17', 'INV-000005', 1, 'Red Cloth', 'Cloth', 20, 100, 2000, 0, -100, -100, 'TEST'),
('PS-000012', 1003, '2022-07-17', 'INV-000005', 1, '0', '0', 0, 0, 0, 300, 0, 300, 'TEST'),
('PS-000013', 1003, '2022-07-17', 'INV-000006', 1, 'Red Cloth', 'Cloth', 30, 20, 600, 0, -100, -100, 'Another'),
('PS-000014', 1003, '2022-07-17', 'INV-000006', 1, '0', '0', 0, 0, 0, 100, 0, 100, 'Another'),
('PS-000015', 1003, '2022-07-17', 'INV-000007', 1, 'Red Cloth', 'Cloth', 10, 10, 100, 0, -10, -10, 'dwadwa'),
('PS-000016', 1003, '2022-07-17', 'INV-000007', 1, '0', '0', 0, 0, 0, 10, 0, 10, 'dwadwa');

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `address` char(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ip`
--

INSERT INTO `ip` (`address`, `timestamp`, `status`) VALUES
('::1', '2022-07-07 12:09:48', 'Valid'),
('::1', '2022-07-07 12:10:00', 'Valid'),
('::1', '2022-07-07 12:10:04', 'Valid'),
('::1', '2022-07-07 12:10:11', 'Valid'),
('::1', '2022-07-07 12:10:33', 'Valid'),
('::1', '2022-07-07 12:10:36', 'Valid'),
('::1', '2022-07-07 12:11:24', 'Valid'),
('::1', '2022-07-07 12:11:43', 'Invalid'),
('::1', '2022-07-07 12:11:48', 'Invalid'),
('::1', '2022-07-07 12:11:50', 'Invalid'),
('::1', '2022-07-07 12:11:54', 'Invalid'),
('::1', '2022-07-07 12:11:57', 'Invalid'),
('::1', '2022-07-07 12:11:59', 'Invalid'),
('::1', '2022-07-09 04:26:02', 'Valid'),
('::1', '2022-07-12 13:43:02', 'Invalid'),
('::1', '2022-07-12 13:43:17', 'Invalid'),
('::1', '2022-07-12 13:43:26', 'Invalid'),
('::1', '2022-07-12 13:43:31', 'Invalid'),
('::1', '2022-07-12 13:43:43', 'Invalid'),
('::1', '2022-07-12 13:43:53', 'Invalid'),
('::1', '2022-07-07 12:09:48', 'Valid'),
('::1', '2022-07-07 12:10:00', 'Valid'),
('::1', '2022-07-07 12:10:04', 'Valid'),
('::1', '2022-07-07 12:10:11', 'Valid'),
('::1', '2022-07-07 12:10:33', 'Valid'),
('::1', '2022-07-07 12:10:36', 'Valid'),
('::1', '2022-07-07 12:11:24', 'Valid'),
('::1', '2022-07-07 12:11:43', 'Invalid'),
('::1', '2022-07-07 12:11:48', 'Invalid'),
('::1', '2022-07-07 12:11:50', 'Invalid'),
('::1', '2022-07-07 12:11:54', 'Invalid'),
('::1', '2022-07-07 12:11:57', 'Invalid'),
('::1', '2022-07-07 12:11:59', 'Invalid'),
('::1', '2022-07-09 04:26:02', 'Valid'),
('::1', '2022-07-12 13:43:02', 'Invalid'),
('::1', '2022-07-12 13:43:17', 'Invalid'),
('::1', '2022-07-12 13:43:26', 'Invalid'),
('::1', '2022-07-12 13:43:31', 'Invalid'),
('::1', '2022-07-12 13:43:43', 'Invalid'),
('::1', '2022-07-12 13:43:53', 'Invalid'),
('::1', '2022-07-07 12:09:48', 'Valid'),
('::1', '2022-07-07 12:10:00', 'Valid'),
('::1', '2022-07-07 12:10:04', 'Valid'),
('::1', '2022-07-07 12:10:11', 'Valid'),
('::1', '2022-07-07 12:10:33', 'Valid'),
('::1', '2022-07-07 12:10:36', 'Valid'),
('::1', '2022-07-07 12:11:24', 'Valid'),
('::1', '2022-07-07 12:11:43', 'Invalid'),
('::1', '2022-07-07 12:11:48', 'Invalid'),
('::1', '2022-07-07 12:11:50', 'Invalid'),
('::1', '2022-07-07 12:11:54', 'Invalid'),
('::1', '2022-07-07 12:11:57', 'Invalid'),
('::1', '2022-07-07 12:11:59', 'Invalid'),
('::1', '2022-07-09 04:26:02', 'Valid'),
('::1', '2022-07-12 13:43:02', 'Invalid'),
('::1', '2022-07-12 13:43:17', 'Invalid'),
('::1', '2022-07-12 13:43:26', 'Invalid'),
('::1', '2022-07-12 13:43:31', 'Invalid'),
('::1', '2022-07-12 13:43:43', 'Invalid'),
('::1', '2022-07-12 13:43:53', 'Invalid');

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
-- Table structure for table `journal_entry`
--

CREATE TABLE `journal_entry` (
  `journal_entry_posting_id` varchar(100) NOT NULL,
  `journal_entry_date` date NOT NULL,
  `journal_entry_id` varchar(100) NOT NULL,
  `journal_entry_account_id` int(11) NOT NULL,
  `journal_entry_amount` float NOT NULL,
  `journal_entry_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_entry`
--

INSERT INTO `journal_entry` (`journal_entry_posting_id`, `journal_entry_date`, `journal_entry_id`, `journal_entry_account_id`, `journal_entry_amount`, `journal_entry_description`) VALUES
('PS-000004', '2022-07-16', 'JS-000002', 1003, -100, 'AHAHHH'),
('PS-000005', '2022-07-16', 'JS-000002', 1003, 200, 'AHAHHH'),
('PS-000006', '2022-07-16', 'JS-000002', 1003, -300, 'AHAHHH'),
('PS-000007', '2022-07-16', 'JS-000002', 1003, -400, 'AHAHHH');

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
(52, 1001, '2022-07-04 15:08:05', '2022-07-04 15:10:17'),
(53, 1001, '2022-07-04 15:09:39', '2022-07-04 15:10:17'),
(54, 1001, '2022-07-04 15:09:54', '2022-07-04 15:10:17'),
(55, 1001, '2022-07-04 15:10:21', '2022-07-04 15:10:27'),
(56, 1001, '2022-07-04 15:29:24', '2022-07-04 15:29:27'),
(57, 1001, '2022-07-04 15:29:37', '2022-07-04 15:29:39'),
(58, 1002, '2022-07-05 12:58:27', '2022-07-05 13:00:43'),
(59, 1001, '2022-07-05 13:38:11', '2022-07-05 13:38:16'),
(60, 1001, '2022-07-05 13:55:57', '2022-07-05 13:56:00'),
(61, 1001, '2022-07-05 15:02:21', '2022-07-05 15:02:23'),
(62, 1001, '2022-07-05 15:02:42', '2022-07-05 15:02:45'),
(63, 1001, '2022-07-06 16:25:34', '2022-07-06 16:25:42'),
(64, 1001, '2022-07-06 16:41:10', '2022-07-06 16:41:13'),
(65, 1001, '2022-07-06 16:41:23', '2022-07-06 16:41:26'),
(66, 1001, '2022-07-06 16:43:27', '2022-07-06 16:43:29'),
(67, 1001, '2022-07-06 16:43:36', '2022-07-06 16:43:38'),
(68, 1001, '2022-07-06 16:43:51', '2022-07-06 16:43:54'),
(69, 1001, '2022-07-06 16:43:59', '2022-07-06 16:44:01'),
(70, 1001, '2022-07-07 13:10:00', '2022-07-07 13:17:15'),
(71, 1001, '2022-07-07 13:18:01', '2022-07-07 13:18:04'),
(72, 1001, '2022-07-07 13:31:40', '2022-07-07 13:31:42'),
(73, 1001, '2022-07-07 13:51:37', '2022-07-07 13:51:41'),
(74, 1001, '2022-07-07 14:10:18', '2022-07-07 14:10:25'),
(75, 1001, '2022-07-07 14:11:34', '2022-07-07 14:11:40'),
(76, 1001, '2022-07-07 14:27:21', '2022-07-07 14:29:01'),
(77, 1002, '2022-07-07 14:29:05', '2022-07-07 14:29:09'),
(78, 1001, '2022-07-07 14:48:22', '2022-07-09 06:25:57'),
(79, 1001, '2022-07-07 15:07:01', '2022-07-09 06:25:57'),
(80, 1001, '2022-07-07 15:19:30', '2022-07-09 06:25:57'),
(81, 1001, '2022-07-07 15:38:22', '2022-07-09 06:25:57'),
(82, 1001, '2022-07-09 06:23:21', '2022-07-09 06:25:57'),
(83, 1001, '2022-07-09 06:26:10', '2022-07-09 06:26:16'),
(84, 1002, '2022-07-09 06:26:21', '2022-07-09 06:28:15'),
(85, 1001, '2022-07-09 06:28:19', '2022-07-12 15:41:44'),
(86, 1001, '2022-07-10 06:36:19', '2022-07-12 15:41:44'),
(87, 1001, '2022-07-10 13:52:42', '2022-07-12 15:41:44'),
(88, 1001, '2022-07-11 14:24:38', '2022-07-12 15:41:44'),
(89, 1001, '2022-07-12 13:08:11', '2022-07-12 15:41:44'),
(90, 1001, '2022-07-12 14:23:13', '2022-07-12 15:41:44'),
(91, 1001, '2022-07-12 15:41:50', '2022-07-12 15:42:01'),
(92, 1001, '2022-07-12 15:42:05', '2022-07-12 15:42:22'),
(93, 1001, '2022-07-12 15:42:28', '2022-07-12 15:42:38'),
(94, 1001, '2022-07-12 15:42:54', '2022-07-12 15:42:59'),
(95, 1001, '2022-07-12 15:54:06', '2022-07-16 14:47:19'),
(96, 1001, '2022-07-13 13:51:20', '2022-07-16 14:47:19'),
(97, 1001, '2022-07-16 13:46:34', '2022-07-16 14:47:19'),
(98, 1001, '2022-07-16 14:47:22', '0000-00-00 00:00:00'),
(99, 1001, '2022-07-17 06:45:55', '0000-00-00 00:00:00'),
(100, 1001, '2022-07-17 13:07:59', '0000-00-00 00:00:00'),
(101, 1001, '2022-07-17 17:27:13', '0000-00-00 00:00:00');

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
(14, 'Blue Cloth', 'Cloth', 600),
(15, 'Red Cloth', 'Cloth', 400),
(16, 'Green Cloth', 'Cloth', 1010),
(17, 'Blue Button', 'Button', 132),
(18, 'Pink Button', 'Button', 101),
(19, 'Red Cloth', 'c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_posting_id` varchar(10) NOT NULL,
  `account_id` int(6) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_entry_id` varchar(20) NOT NULL,
  `buyer_name` varchar(20) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `sales_amount` float NOT NULL,
  `explanation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_posting_id`, `account_id`, `sales_date`, `sales_entry_id`, `buyer_name`, `item_name`, `category`, `price`, `quantity`, `total`, `debit`, `credit`, `sales_amount`, `explanation`) VALUES
('PS-000001', 1003, '2022-07-17', 'SLS-000001', 'shio', 'Blue Cloth', 'Cloth', 10, 100, 1000, 0, -100, -100, 'test'),
('PS-000002', 1003, '2022-07-17', 'SLS-000001', 'shio', '0', '0', 0, 0, 0, 100, 0, 100, 'test'),
('PS-000003', 1003, '2022-07-17', 'SLS-000002', 'shio', 'Blue Cloth', 'Cloth', 10, 30, 300, 0, -100, -100, 'test'),
('PS-000004', 1003, '2022-07-17', 'SLS-000002', 'shio', '0', '0', 0, 0, 0, 100, 0, 100, 'test'),
('PS-000005', 1003, '2022-07-17', 'SLS-000003', 'shio', 'Red Cloth', 'Cloth', 10, 100, 1000, 0, -100, -100, 'Test'),
('PS-000006', 1003, '2022-07-17', 'SLS-000003', 'shio', '0', '0', 0, 0, 0, 100, 0, 100, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `stock_date` date NOT NULL,
  `supplier_name` varchar(20) NOT NULL,
  `item_id` int(6) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(6) NOT NULL,
  `total` float NOT NULL,
  `stock_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_date`, `supplier_name`, `item_id`, `category`, `price`, `quantity`, `total`, `stock_status`) VALUES
(0053, '2022-07-17', 'shiori', 14, 'Cloth', 20, 30, 600, 'in'),
(0054, '2022-07-17', 'shiori', 15, 'Cloth', 20, 100, 2000, 'in'),
(0055, '2022-07-17', 'shiori', 14, 'Cloth', 20, 100, 2000, 'in'),
(0056, '2022-07-17', 'shiori', 14, 'Cloth', 20, 70, 1400, 'in'),
(0057, '2022-07-17', 'shiori', 14, 'Cloth', 20, 30, 600, 'in'),
(0058, '2022-07-17', 'shiori', 14, 'Cloth', 30, 20, 600, 'in'),
(0059, '2022-07-17', 'shiori', 15, 'Cloth', 20, 100, 2000, 'in'),
(0060, '2022-07-17', 'shiori', 15, 'Cloth', 30, 20, 600, 'in'),
(0061, '2022-07-17', 'shiori', 19, 'c', 10, 10, 100, 'in'),
(0062, '2022-07-17', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0063, '0000-00-00', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0064, '2022-07-17', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0065, '2022-07-17', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0066, '2022-07-17', 'shio', 14, 'Cloth', 10, 30, 300, 'out'),
(0067, '2022-07-17', 'shio', 15, 'Cloth', 10, 100, 1000, 'out');

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
(2, 'earl', 'daraga', '09324152321'),
(5, 'Shio', 'Daraga Legazpi', '09345178452');

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
  ADD PRIMARY KEY (`inventory_posting_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`journal_id`),
  ADD KEY `journal_entry` (`journal_entry`);

--
-- Indexes for table `journal_entry`
--
ALTER TABLE `journal_entry`
  ADD PRIMARY KEY (`journal_entry_posting_id`),
  ADD KEY `je_account_id` (`journal_entry_account_id`);

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
  ADD PRIMARY KEY (`sales_posting_id`),
  ADD KEY `fk_account` (`account_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `FK_stockItem` (`item_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `general_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `item_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_adminLogs` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_stockItem` FOREIGN KEY (`item_id`) REFERENCES `merchandise` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
