-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 03:06 PM
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
(2001, 'Account Payable', 'Liability');

-- --------------------------------------------------------

--
-- Table structure for table `account_payable`
--

CREATE TABLE `account_payable` (
  `payable_id` varchar(10) NOT NULL,
  `inventory_id` varchar(10) NOT NULL,
  `supplier_id` int(20) NOT NULL,
  `ap_initial_payment` float NOT NULL,
  `collection` float NOT NULL,
  `total_collection` float NOT NULL,
  `account_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(0017, 'earl', 110, 'Red Cloth'),
(0018, 'Reil', 230, 'Blue Cloth'),
(0027, 'Reil', 10, 'Red Cloth'),
(0028, 'Shio', 1132, 'Red Cloth'),
(0029, 'shio', 1070, 'Blue Cloth'),
(0030, 'reil', 100, 'Green Cloth'),
(0031, 'fang', 110, 'Green Cloth'),
(0033, 'shiori', 10, 'Red Cloth'),
(0034, 'shio', 200, 'Green Cloth');

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
  `inv_measurement_type` varchar(10) NOT NULL,
  `inv_measurement` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float NOT NULL,
  `inv_amount` float NOT NULL,
  `Explanation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_posting_id`, `account_id`, `inv_date`, `inventory_entry_id`, `supplier_id`, `item_name`, `category`, `inv_measurement_type`, `inv_measurement`, `price`, `quantity`, `total`, `inv_amount`, `Explanation`) VALUES
('PS-000000', 1003, '2022-07-27', '', 1, 'Blue Cloth', 'Cloth', 'Piece', 1, 10, 10, 100, -100, 'test3'),
('PS-000001', 1003, '2022-07-24', 'INV-000001', 1, 'Red Cloth', 'Cloth', 'Yard', 1, 10, 10, 100, -100, 'test'),
('PS-000002', 1003, '2022-07-24', 'INV-000001', 1, '0', '0', '', 0, 0, 0, 0, 200, 'test'),
('PS-000003', 1003, '2022-07-27', 'INV-000002', 1, 'Blue Cloth', 'Cloth', 'Piece', 1, 10, 10, 100, -100, 'test3'),
('PS-000004', 1003, '2022-07-27', 'INV-000002', 1, '0', '0', '', 0, 0, 0, 0, 100, 'test3'),
('PS-000005', 1003, '2022-07-27', 'INV-000003', 1, 'Blue Cloth', 'Cloth', 'Piece', 2, 10, 10, 100, -100, 'test3'),
('PS-000006', 1003, '2022-07-27', 'INV-000003', 1, '0', '0', '', 0, 0, 0, 0, 100, 'test3');

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
  `journal_entry_description` varchar(100) NOT NULL,
  `journal_entry_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_entry`
--

INSERT INTO `journal_entry` (`journal_entry_posting_id`, `journal_entry_date`, `journal_entry_id`, `journal_entry_account_id`, `journal_entry_amount`, `journal_entry_description`, `journal_entry_client`) VALUES
('PS-000001', '2022-07-25', 'JS-000001', 1003, -100, 'test', 0),
('PS-000002', '2022-07-25', 'JS-000001', 1003, 200, 'test', 0),
('PS-000003', '2022-07-25', 'JS-000002', 1003, -100, 'test2', 0),
('PS-000004', '2022-07-25', 'JS-000002', 1003, 300, 'test2', 0),
('PS-000005', '2022-07-25', 'JS-000003', 1003, -200, 'test3', 0),
('PS-000006', '2022-07-25', 'JS-000003', 1003, 300, 'test3', 0);

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
(113, 1001, '2022-07-18 13:58:13', '2022-07-18 13:58:55'),
(114, 1001, '2022-07-18 13:59:11', '2022-07-18 13:59:19'),
(115, 1001, '2022-07-18 14:00:23', '0000-00-00 00:00:00'),
(116, 1001, '2022-07-19 14:22:14', '0000-00-00 00:00:00'),
(117, 1001, '2022-07-21 14:06:01', '0000-00-00 00:00:00'),
(118, 1001, '2022-07-22 15:30:34', '0000-00-00 00:00:00'),
(119, 1001, '2022-07-23 09:14:22', '0000-00-00 00:00:00'),
(120, 1001, '2022-07-23 13:02:27', '0000-00-00 00:00:00'),
(121, 1001, '2022-07-24 08:15:42', '0000-00-00 00:00:00'),
(122, 1001, '2022-07-24 13:55:02', '0000-00-00 00:00:00'),
(123, 1001, '2022-07-24 15:59:51', '0000-00-00 00:00:00'),
(124, 1001, '2022-07-24 16:05:29', '0000-00-00 00:00:00'),
(125, 1001, '2022-07-24 16:05:45', '0000-00-00 00:00:00'),
(126, 1001, '2022-07-24 16:05:53', '0000-00-00 00:00:00'),
(127, 1001, '2022-07-24 16:06:06', '0000-00-00 00:00:00'),
(128, 1001, '2022-07-25 13:57:12', '0000-00-00 00:00:00'),
(129, 1001, '2022-07-26 13:35:51', '0000-00-00 00:00:00'),
(130, 1001, '2022-07-27 13:51:52', '0000-00-00 00:00:00'),
(131, 1001, '2022-07-27 14:21:02', '0000-00-00 00:00:00');

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
(14, 'Blue Cloth', 'Cloth', 142),
(15, 'Red Cloth', 'Cloth', -202),
(16, 'Green Cloth', 'Cloth', 800),
(17, 'Blue Button', 'Button', 132),
(18, 'Pink Button', 'Button', 101);

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
  `sales_measurement_type` varchar(10) NOT NULL,
  `sales_measurement` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` float NOT NULL,
  `sales_amount` float NOT NULL,
  `explanation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_posting_id`, `account_id`, `sales_date`, `sales_entry_id`, `buyer_name`, `item_name`, `category`, `sales_measurement_type`, `sales_measurement`, `price`, `quantity`, `total`, `sales_amount`, `explanation`) VALUES
('PS-000001', 1003, '2022-07-24', 'SLS-000001', 'shio', 'Red Cloth', 'Cloth', 'Yard', 1, 10, 10, 100, -100, 'test'),
('PS-000002', 1003, '2022-07-24', 'SLS-000001', 'shio', '0', '0', '', 0, 0, 0, 0, 200, 'test'),
('PS-000003', 1003, '2022-07-24', 'SLS-000002', 'shio', 'Green Cloth', 'Cloth', 'Yard', 1, 10, 100, 1000, -300, 'test'),
('PS-000004', 1003, '2022-07-24', 'SLS-000002', 'shio', '0', '0', '', 0, 0, 0, 0, 300, 'test'),
('PS-000005', 1003, '2022-07-27', 'SLS-000003', 'shio', 'Red Cloth', 'Cloth', 'Yard', 3, 10, 500, 5000, -100, 'test4'),
('PS-000006', 1003, '2022-07-27', 'SLS-000003', 'shio', '0', '0', '', 0, 0, 0, 0, 200, 'test4'),
('PS-000007', 1003, '2022-07-27', 'SLS-000003', 'shio', '0', '0', '', 0, 0, 0, 0, -300, 'test5');

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
(0062, '2022-07-17', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0064, '2022-07-17', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0065, '2022-07-17', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0066, '2022-07-17', 'shio', 14, 'Cloth', 10, 30, 300, 'out'),
(0067, '2022-07-17', 'shio', 15, 'Cloth', 10, 100, 1000, 'out'),
(0069, '2022-07-18', 'fang', 16, 'Cloth', 19, 100, 1900, 'out'),
(0070, '2022-07-21', 'earl', 15, 'Cloth', 20, 100, 2000, 'in'),
(0071, '2022-07-21', 'shiori', 14, 'Cloth', 20, 100, 2000, 'in'),
(0072, '2022-07-21', 'earl', 15, 'Cloth', 20, 100, 2000, 'in'),
(0073, '2022-07-21', 'shiori', 15, 'Cloth', 20, 10, 200, 'in'),
(0075, '2022-07-23', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0077, '2022-07-23', 'shiori', 15, 'Cloth', 20, 10, 200, 'in'),
(0078, '2022-07-23', 'shiori', 16, 'Cloth', 10, 100, 1000, 'in'),
(0079, '2022-07-23', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0080, '2022-07-24', 'shiori', 15, 'Cloth', 20, 10, 200, 'in'),
(0082, '2022-07-24', 'shio', 15, 'Cloth', 10, 100, 1000, 'out'),
(0083, '2022-07-24', 'shio', 14, 'Cloth', 10, 10, 100, 'out'),
(0084, '2022-07-24', 'shiori', 15, 'Cloth', 10, 100, 1000, 'in'),
(0085, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0086, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0087, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0088, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'out'),
(0089, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0090, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0091, '2022-07-24', 'shio', 15, 'Cloth', 20, 100, 2000, 'out'),
(0092, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0093, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0094, '2022-07-24', 'shiori', 15, 'Cloth', 20, 100, 2000, 'in'),
(0095, '2022-07-24', 'shiori', 15, 'Cloth', 10, 100, 1000, 'in'),
(0096, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0097, '2022-07-24', 'shiori', 15, 'Cloth', 10, 100, 1000, 'in'),
(0098, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0099, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0100, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0101, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0102, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0103, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0104, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0105, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0106, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0107, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0108, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0109, '2022-07-24', 'shiori', 16, 'Cloth', 10, 10, 100, 'in'),
(0110, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0111, '2022-07-24', 'Shio', 16, 'Cloth', 10, 10, 100, 'in'),
(0113, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0114, '2022-07-24', 'shio', 16, 'Cloth', 10, 100, 1000, 'out'),
(0115, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0116, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0117, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0118, '2022-07-24', 'shio', 15, 'Cloth', 10, 100, 1000, 'out'),
(0119, '2022-07-24', 'shio', 16, 'Cloth', 10, 100, 1000, 'out'),
(0120, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0121, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0122, '2022-07-24', 'shio', 15, 'Cloth', 10, 100, 1000, 'out'),
(0123, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0124, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0125, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0126, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0127, '2022-07-24', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0128, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0129, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0130, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0131, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0132, '2022-07-24', 'shio', 15, 'Cloth', 10, 10, 100, 'out'),
(0133, '2022-07-24', 'shio', 15, 'Cloth', 1, 1, 1, 'out'),
(0134, '2022-07-24', 'shio', 15, 'Cloth', 1, 1, 1, 'out'),
(0135, '2022-07-24', 'earl', 15, 'Cloth', 10, 1, 10, 'in'),
(0136, '2022-07-24', 'earl', 15, 'Cloth', 10, 10, 100, 'out'),
(0137, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0138, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0139, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0140, '2022-07-24', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0141, '2022-07-24', 'shiori', 14, 'Cloth', 1, 1, 1, 'in'),
(0142, '2022-07-24', 'shiori', 14, 'Cloth', 1, 1, 1, 'in'),
(0143, '2022-07-25', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0144, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0145, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0146, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0147, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0148, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0149, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0150, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0151, '2022-07-25', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0152, '2022-07-25', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0153, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0154, '2022-07-25', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0155, '2022-07-25', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0156, '2022-07-25', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0157, '2022-07-27', 'shio', 14, 'Cloth', 10, 100, 1000, 'out'),
(0158, '2022-07-27', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0159, '2022-07-27', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0160, '2022-07-27', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0161, '2022-07-27', 'shiori', 15, 'Cloth', 10, 10, 100, 'in'),
(0162, '2022-07-27', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0163, '2022-07-27', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0164, '2022-07-27', 'shiori', 14, 'Cloth', 10, 10, 100, 'in'),
(0165, '2022-07-27', 'shio', 15, 'Cloth', 10, 500, 5000, 'out'),
(0166, '2022-07-27', 'shio', 14, 'Cloth', 10, 200, 2000, 'out');

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
-- Indexes for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD PRIMARY KEY (`payable_id`),
  ADD KEY `FK_inv_payable` (`inventory_id`),
  ADD KEY `FK_supplier_payable` (`supplier_id`);

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
  ADD PRIMARY KEY (`journal_id`);

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
  MODIFY `customer_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `general`
--
ALTER TABLE `general`
  MODIFY `general_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `item_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_payable`
--
ALTER TABLE `account_payable`
  ADD CONSTRAINT `FK_inv_payable` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_posting_id`),
  ADD CONSTRAINT `FK_supplier_payable` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_ID`);

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
