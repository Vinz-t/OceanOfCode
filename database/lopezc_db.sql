-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 03:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lopezc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '2097c69fbd54c190cd87c5eb3d1e7caa');

-- --------------------------------------------------------

--
-- Table structure for table `apartment_tbl`
--

CREATE TABLE `apartment_tbl` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(250) NOT NULL,
  `unit_price` varchar(15) NOT NULL,
  `unit_location` varchar(20) NOT NULL,
  `unit_size` varchar(20) NOT NULL,
  `unit_address` varchar(150) NOT NULL,
  `unit_description` varchar(150) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `unit_images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment_tbl`
--

INSERT INTO `apartment_tbl` (`id`, `unit_name`, `unit_price`, `unit_location`, `unit_size`, `unit_address`, `unit_description`, `remarks`, `unit_images`) VALUES
(19, 'Classic', '18,000', 'bulacan', '10 sqm', 'Brgy. Mayapa Calamba City, Laguna', 'sfsdf dsf sdf d sdfsfsfsfs sdf sdf', 'Available', 'unit1.jpg,unit2.jpg,unit3.jpg'),
(22, 'KEME', '400', 'valenzuela', '90 sqm', 'Mapagong Calamba City, Laguna', 'dadwa a awd gh fty rt rtgrtgrtg', 'Available', 'unit4.jpg,unit5.jpg,unit6.png');

-- --------------------------------------------------------

--
-- Table structure for table `application_tbl`
--

CREATE TABLE `application_tbl` (
  `id` int(11) NOT NULL,
  `unit_iden` varchar(50) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `c_address` varchar(250) NOT NULL,
  `occupation` varchar(250) NOT NULL,
  `m_income` varchar(50) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `move_ins` varchar(10) NOT NULL,
  `move_date` varchar(100) NOT NULL,
  `have_pet` varchar(5) NOT NULL,
  `valid_id` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `avail_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commercial_tbl`
--

CREATE TABLE `commercial_tbl` (
  `id` int(11) NOT NULL,
  `space_name` varchar(150) NOT NULL,
  `space_price` varchar(20) NOT NULL,
  `space_location` varchar(250) NOT NULL,
  `space_size` varchar(50) NOT NULL,
  `space_address` text NOT NULL,
  `space_description` varchar(250) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `space_images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commercial_tbl`
--

INSERT INTO `commercial_tbl` (`id`, `space_name`, `space_price`, `space_location`, `space_size`, `space_address`, `space_description`, `remarks`, `space_images`) VALUES
(2, 'GOOOW', '14,000', 'bulacan', '25 sqm', 'Brgy. Mapagong Calamba City, Laguna', 'dasda asd asd das asda dsadadadas dad dadad', 'Available', 'unit2.jpg,unit5.jpg,unit6.png'),
(3, 'Mewww', '18,000', 'valenzuela', '35 sqm', 'Brgy. Mayapa Calamba City, Laguna', 'asdjhj kasi hdkash kjaksj ', 'Available', 'lopez-logo.png,person.png,unit6.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `contactno` varchar(11) DEFAULT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `contactno`, `posting_date`) VALUES
(19, 'Juan', 'Carlo', 'j_carlo@gmail.com', 'Hello123', '09123456782', '2025-04-21 07:17:58'),
(20, 'Hiro', 'Villa', 'Hiro@gmail.com', 'World123', '09121231234', '2025-05-02 11:36:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartment_tbl`
--
ALTER TABLE `apartment_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_tbl`
--
ALTER TABLE `application_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commercial_tbl`
--
ALTER TABLE `commercial_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apartment_tbl`
--
ALTER TABLE `apartment_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `application_tbl`
--
ALTER TABLE `application_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `commercial_tbl`
--
ALTER TABLE `commercial_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
