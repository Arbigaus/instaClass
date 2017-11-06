-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 07:39 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_clientes`
--

CREATE TABLE `tab_clientes` (
  `id_clientes` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sexo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tab_clientes`
--

INSERT INTO `tab_clientes` (`id_clientes`, `name`, `sexo`) VALUES
(1, 'Gerson Arbigaus', 'masculino');

-- --------------------------------------------------------

--
-- Table structure for table `tab_clients`
--

CREATE TABLE `tab_clients` (
  `id_client` int(11) NOT NULL,
  `client_name` varchar(80) NOT NULL,
  `client_genre` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tab_clients`
--

INSERT INTO `tab_clients` (`id_client`, `client_name`, `client_genre`) VALUES
(1, 'Gerson Arbigaus', 'M'),
(2, 'Adriele Arbigaus', 'F'),
(3, 'Bella Arbigaus', 'F'),
(5, 'Rafael Caçator', 'M'),
(6, 'Fernando Arbigaus', 'M'),
(7, 'Helder Prestes', 'M'),
(8, 'José', 'M'),
(9, 'Mariazinha', 'M'),
(10, 'Kiko', 'M'),
(11, 'Rafel Caçator', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `tab_users`
--

CREATE TABLE `tab_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tab_users`
--

INSERT INTO `tab_users` (`user_id`, `user_name`, `user_email`, `user_pass`) VALUES
(1, 'Gerson Arbigaus', 'gerson87@gmail.com', 123);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `picture` varchar(35) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `passwd`, `picture`, `time`, `status`) VALUES
(1, 'Adriele Arbigaus', 'adriele@arbigaus.com', '123', '', '2017-10-31 14:22:02', 0),
(3, 'Gerson Arbigaus', 'gerson87@gmail.com', '202cb962ac59075b964b07152d234b70', 'profile2.jpg', '2017-11-01 12:45:26', 0),
(4, 'Rafael Caçator', 'rafael.cacator@cotrasa.com.br', '202cb962ac59075b964b07152d234b70', 'user4-128x128.jpg', '2017-11-01 15:25:31', 0),
(6, 'Mariazinha', 'maria@jose.com', '202cb962ac59075b964b07152d234b70', 'user3-128x128.jpg', '2017-11-06 12:38:18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_clientes`
--
ALTER TABLE `tab_clientes`
  ADD PRIMARY KEY (`id_clientes`);

--
-- Indexes for table `tab_clients`
--
ALTER TABLE `tab_clients`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `tab_users`
--
ALTER TABLE `tab_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_clientes`
--
ALTER TABLE `tab_clientes`
  MODIFY `id_clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tab_clients`
--
ALTER TABLE `tab_clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tab_users`
--
ALTER TABLE `tab_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
