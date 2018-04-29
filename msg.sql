-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 11:48 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

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
(1, 'This is a fix for the game Portal added by Admin', '2018-04-24 21:54:27', 5, 1, 1, 2),
(2, 'This is a fix for the game Portal added by Active', '2018-04-24 21:54:27', 10, 2, 2, 2);

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
(1, 'This is a comment from Active on the fix added by Admin', '2018-04-24 21:55:26', 2, 1, 2, 1),
(2, 'This is a comment from Admin on the fix created by Active', '2018-04-25 00:00:14', 11, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fixreply`
--

CREATE TABLE `fixreply` (
  `fixReplyID` int(10) UNSIGNED NOT NULL,
  `fixReply` text NOT NULL,
  `fixReplyDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fixReplyThUp` int(10) UNSIGNED NOT NULL,
  `fixReplyThDown` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `fixcommID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixreply`
--

INSERT INTO `fixreply` (`fixReplyID`, `fixReply`, `fixReplyDateTime`, `fixReplyThUp`, `fixReplyThDown`, `userID`, `fixcommID`) VALUES
(1, 'This is a reply comment for a fix comment', '2018-04-25 07:31:37', 2, 1, 2, 2);

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
(2, 'Portal', 4, 2, '2018-03-23 12:56:59'),
(5, 'Portal 2', 0, 0, '2018-03-23 16:18:48'),
(6, 'Half Life', 1, 0, '2018-03-30 09:27:41'),
(7, 'Half Life 2', 0, 0, '2018-03-30 09:31:57');

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
(1, 'This is a comment on a game by Admin on the game Portal', '2018-04-24 21:52:52', 10, 1, 1, 2),
(2, 'This is comment on a game by Active on the game Portal', '2018-04-24 21:52:52', 0, 0, 2, 2),
(3, 'Comment by Admin for game Portal 2', '2018-04-24 23:41:36', 15, 3, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `gamereply`
--

CREATE TABLE `gamereply` (
  `gameReplyID` int(10) UNSIGNED NOT NULL,
  `replyComment` text NOT NULL,
  `replyCommDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `replyCommThUp` int(10) UNSIGNED NOT NULL,
  `replyCommThDown` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `gameCommID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamereply`
--

INSERT INTO `gamereply` (`gameReplyID`, `replyComment`, `replyCommDateTime`, `replyCommThUp`, `replyCommThDown`, `userID`, `gameCommID`) VALUES
(1, 'This is a reply comment to a game comment', '2018-04-25 07:30:39', 1, 1, 1, 2);

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
(1, 'Admin', 'password', '2018-03-23 00:00:00', 3),
(2, 'Active', 'password', '2018-03-23 00:00:00', 1),
(3, 'Disabled', 'password', '2018-03-23 10:57:09', 2),
(4, 'test', 'password', '2018-03-23 10:58:10', 1),
(11, 'test5', 'password', '2018-03-23 11:57:01', 1),
(12, 'test6', 'password', '2018-03-24 11:05:59', 1);

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
  ADD KEY `fk_fixID_1` (`fixID`),
  ADD KEY `fk_userID_3` (`userID`);

--
-- Indexes for table `fixreply`
--
ALTER TABLE `fixreply`
  ADD PRIMARY KEY (`fixReplyID`),
  ADD KEY `fixcommID` (`fixcommID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameID`),
  ADD UNIQUE KEY `gameName` (`gameName`);

--
-- Indexes for table `gamecomm`
--
ALTER TABLE `gamecomm`
  ADD PRIMARY KEY (`gameCommID`),
  ADD KEY `fk_userID_1` (`gameID`),
  ADD KEY `fk_gameID_1` (`userID`);

--
-- Indexes for table `gamereply`
--
ALTER TABLE `gamereply`
  ADD PRIMARY KEY (`gameReplyID`),
  ADD KEY `gameCommID` (`gameCommID`),
  ADD KEY `replyuserID` (`userID`);

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
  MODIFY `fixID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fixcomm`
--
ALTER TABLE `fixcomm`
  MODIFY `fixCommID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fixreply`
--
ALTER TABLE `fixreply`
  MODIFY `fixReplyID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gamecomm`
--
ALTER TABLE `gamecomm`
  MODIFY `gameCommID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gamereply`
--
ALTER TABLE `gamereply`
  MODIFY `gameReplyID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
-- Constraints for table `fixreply`
--
ALTER TABLE `fixreply`
  ADD CONSTRAINT `fixreply_ibfk_1` FOREIGN KEY (`fixcommID`) REFERENCES `fixcomm` (`fixCommID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fixreply_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gamecomm`
--
ALTER TABLE `gamecomm`
  ADD CONSTRAINT `fk_gameID_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID_1` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gamereply`
--
ALTER TABLE `gamereply`
  ADD CONSTRAINT `gameCommID` FOREIGN KEY (`gameCommID`) REFERENCES `gamecomm` (`gameCommID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replyuserID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
