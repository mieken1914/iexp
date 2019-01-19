-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 09:12 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iexpert_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `id_num` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `details` text NOT NULL,
  `problem_type` varchar(20) NOT NULL,
  `recommendation` varchar(40) NOT NULL,
  `is_accepted` tinyint(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`id_num`, `date`, `details`, `problem_type`, `recommendation`, `is_accepted`, `client_id`) VALUES
(12, '2018-12-08 12:39:28', 'problem_type = power ; battery = not damaged ; red battery icon on start up = doesn\'t showed up ; physical damage = recently submerged in water ; recommendation = dry the phone before charging or powering up', 'power', 'dry the phone before charging or powerin', 0, 2),
(13, '2018-12-14 14:49:36', 'problem_type = power ; battery = damaged ; recommendation = change the battery', 'power', 'change the battery', 1, 6),
(14, '2018-12-14 16:04:22', 'problem_type = power ; battery = damaged ; recommendation = change the battery', 'power', 'change the battery', -1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_num` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `f_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_num`, `username`, `password`, `user_type`, `l_name`, `f_name`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 'Allen', 'Barry'),
(2, 'client1', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1, 'Ramon', 'Cisco'),
(3, 'client2', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1, 'Snow', 'Caitlyn'),
(5, 'client3', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1, 'Dibny', 'Ralph'),
(6, 'client4', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1, 'Wells', 'Harrison'),
(7, 'client5', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1, 'West', 'Joe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id_num`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `client_user_consul` FOREIGN KEY (`client_id`) REFERENCES `user` (`id_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
