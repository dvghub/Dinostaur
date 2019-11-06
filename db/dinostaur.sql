-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2019 at 05:46 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinostaur`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'name@email.com', 'name', 'password'),
(2, 'staff@ethlan.fr', 'imval', 'hackmeifyoucan'),
(3, 'entry@email.com', 'third entry', 'goodpassword'),
(4, 'fourth.entry@email.com', 'fourth entry', 'supergoodpassword'),
(5, 'error@test.com', 'error test', 'error'),
(6, 'reggy@test.com', 'reggy', 'p4ss'),
(7, 'tester@email.com', 'tester one', 'password'),
(8, 'nernjrn@nruvnrei.ru', 'erjvwigbi', 'p4ss'),
(9, 'a@a.a', 'a', 'a'),
(10, 'trogg@good.music', 'trogg', 'wildthing'),
(11, 'test@email.com', 'test', 'test'),
(12, 'b@b.b', 'b', 'b'),
(13, 'namename@email.com', 'name', 'password'),
(14, 'uwecu@nvrun.gnri', 'wueuowb', 'pass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
