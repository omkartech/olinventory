-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2018 at 02:14 PM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `uom_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `date_created`, `date_modified`) VALUES
(1, 'Rug', 'A cool rug', '0000-00-00', '0000-00-00'),
(2, 'Cup', 'A coffee cup', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `product_mapping`
--

CREATE TABLE `product_mapping` (
  `product_mapping_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_mapping`
--

INSERT INTO `product_mapping` (`product_mapping_id`, `product_id`, `size_id`, `color_id`, `stock`, `uom_id`, `date_created`, `date_modified`) VALUES
(1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00'),
(2, 1, 1, 2, 10, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `uom_id` int(11) NOT NULL,
  `uom_name` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_gst`
--

CREATE TABLE `vendor_gst` (
  `gst_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `gst_amount` float NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_sale`
--

CREATE TABLE `vendor_sale` (
  `sale_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `sale_amount` float NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_mapping`
--
ALTER TABLE `product_mapping`
  ADD PRIMARY KEY (`product_mapping_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`uom_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_gst`
--
ALTER TABLE `vendor_gst`
  ADD PRIMARY KEY (`gst_id`);

--
-- Indexes for table `vendor_sale`
--
ALTER TABLE `vendor_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_mapping`
--
ALTER TABLE `product_mapping`
  MODIFY `product_mapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `uom_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_gst`
--
ALTER TABLE `vendor_gst`
  MODIFY `gst_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_sale`
--
ALTER TABLE `vendor_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
