-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2018 at 04:31 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msg`
--

-- --------------------------------------------------------

--
-- Table structure for table `fix`
--

CREATE TABLE `fix` (
  `fixID` int(10) UNSIGNED NOT NULL,
  `fixInfo` text NOT NULL,
  `fixDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fixThUp` int(10) UNSIGNED NOT NULL,
  `fixThDown` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `gameID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fix`
--

INSERT INTO `fix` (`fixID`, `fixInfo`, `fixDateTime`, `fixThUp`, `fixThDown`, `userID`, `gameID`) VALUES
(1, 'In options change field of view to 100', '2018-03-19 02:20:43', 1, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fixcomm`
--

CREATE TABLE `fixcomm` (
  `fixCommID` int(10) UNSIGNED NOT NULL,
  `fixComment` text NOT NULL,
  `fixCommDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fixCommThUp` int(10) UNSIGNED NOT NULL,
  `fixCommThDown` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `fixID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixcomm`
--

INSERT INTO `fixcomm` (`fixCommID`, `fixComment`, `fixCommDateTime`, `fixCommThUp`, `fixCommThDown`, `userID`, `fixID`) VALUES
(1, 'Yes this worked for me', '2018-03-19 02:21:08', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `gameID` int(10) UNSIGNED NOT NULL,
  `gameName` varchar(100) NOT NULL,
  `gameThUp` int(10) UNSIGNED NOT NULL,
  `gameThDown` int(10) UNSIGNED NOT NULL,
  `gameDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gameID`, `gameName`, `gameThUp`, `gameThDown`, `gameDate`) VALUES
(1, 'Portal', 42, 5, '2018-03-19 00:00:00'),
(2, 'Half Life', 14, 3, '2018-03-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gamecomm`
--

CREATE TABLE `gamecomm` (
  `gameCommID` int(10) UNSIGNED NOT NULL,
  `gameComment` text NOT NULL,
  `gameCommDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gameCommThUp` int(10) UNSIGNED NOT NULL,
  `gameCommThDown` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `gameID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamecomm`
--

INSERT INTO `gamecomm` (`gameCommID`, `gameComment`, `gameCommDateTime`, `gameCommThUp`, `gameCommThDown`, `userID`, `gameID`) VALUES
(1, 'I love this game but it makes me feel sick and dizzy', '2018-03-19 02:08:45', 1, 0, 1, 1),
(2, 'I love this game but it makes me feel sick and dizzy', '2018-03-19 02:08:45', 1, 0, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userCreateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acctStatus` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `userCreateDate`, `acctStatus`) VALUES
(1, 'kandi_galaxy', 'password', '2018-03-19 00:00:00', 3),
(2, 'sickgamer', 'password', '2018-03-19 00:00:00', 1),
(4, 'test', 'test', '2018-03-19 16:25:52', 2),
(19, 'test2', 'password', '2018-03-27 12:19:49', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fix`
--
ALTER TABLE `fix`
  ADD PRIMARY KEY (`fixID`),
  ADD KEY `fk_gameID_2` (`gameID`),
  ADD KEY `fk_userID_2` (`userID`);

--
-- Indexes for table `fixcomm`
--
ALTER TABLE `fixcomm`
  ADD PRIMARY KEY (`fixCommID`),
  ADD KEY `fk_userID_3` (`userID`),
  ADD KEY `fk_fixID` (`fixID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `gamecomm`
--
ALTER TABLE `gamecomm`
  ADD PRIMARY KEY (`gameCommID`),
  ADD KEY `fk_userID_1` (`gameID`),
  ADD KEY `fk_gameID_1` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fix`
--
ALTER TABLE `fix`
  MODIFY `fixID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fixcomm`
--
ALTER TABLE `fixcomm`
  MODIFY `fixCommID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gamecomm`
--
ALTER TABLE `gamecomm`
  MODIFY `gameCommID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fix`
--
ALTER TABLE `fix`
  ADD CONSTRAINT `fk_gameID_2` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fixcomm`
--
ALTER TABLE `fixcomm`
  ADD CONSTRAINT `fk_fixID` FOREIGN KEY (`fixID`) REFERENCES `fix` (`fixID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_3` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gamecomm`
--
ALTER TABLE `gamecomm`
  ADD CONSTRAINT `fk_gameID_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_1` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
