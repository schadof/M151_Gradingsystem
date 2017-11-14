-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2017 at 04:58 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greades`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`) VALUES
(1, 'AP15a'),
(2, 'AP15b'),
(3, 'AP15c');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `weight` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `module` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `mark`, `weight`, `description`, `module`, `user`, `teacher`) VALUES
(2, 6, 2, 'Very Good', 1, 1, 4),
(3, 5, 1, 'meh', 2, 1, 4),
(4, 6, 1, 'good', 1, 1, 4),
(5, 6, 2, 'Good', 3, 1, 4),
(6, 5, 1, '', 2, 14, 4),
(7, 5, 1, '', 3, 14, 4),
(8, 6, 1, '', 3, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`) VALUES
(1, 'M151'),
(2, 'M150'),
(3, 'M146');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `occupation`) VALUES
(1, 'Student'),
(2, 'Teacher'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `occupation` int(11) NOT NULL,
  `class` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `password`, `occupation`, `class`) VALUES
(1, 'Lars', 'Ragutt', 'l.ragutt', '098f6bcd4621d373cade4e832627b4f6', 1, 2),
(4, 'Michael', 'Müller', 'm.müller', '098f6bcd4621d373cade4e832627b4f6', 2, NULL),
(13, 'Heinz', 'Gruber', 'h.gruber', '098f6bcd4621d373cade4e832627b4f6', 3, NULL),
(14, 'William', 'Turner', 'w.turner', '098f6bcd4621d373cade4e832627b4f6', 1, 1),
(15, 'Gandalf', 'Heinzel', 'g.heinzel', '098f6bcd4621d373cade4e832627b4f6', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `module` (`module`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class` (`class`),
  ADD KEY `occupation` (`occupation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`module`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`class`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`occupation`) REFERENCES `occupations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
