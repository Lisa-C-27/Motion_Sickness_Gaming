-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2018 at 10:34 AM
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
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `avatarID` int(10) UNSIGNED NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avatar`
--

INSERT INTO `avatar` (`avatarID`, `url`) VALUES
(1, '../img/avatars/unknown.png'),
(2, '../img/avatars/amazed.png'),
(3, '../img/avatars/avatar.png'),
(4, '../img/avatars/bluey.png'),
(5, '../img/avatars/control.png'),
(6, '../img/avatars/cool.png'),
(7, '../img/avatars/dude.png'),
(8, '../img/avatars/evil.png'),
(9, '../img/avatars/orc.png'),
(10, '../img/avatars/panda.png'),
(11, '../img/avatars/penguin.png'),
(12, '../img/avatars/sidedude.png'),
(13, '../img/avatars/smiley.png'),
(14, '../img/avatars/vampire.png');

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
  `gameID` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fix`
--

INSERT INTO `fix` (`fixID`, `fixInfo`, `fixDateTime`, `fixThUp`, `fixThDown`, `userID`, `gameID`, `deleted`) VALUES
(1, 'Go into options and change FOV setting to 90', '2018-05-07 04:28:55', 16, 1, 1, 1, 0),
(2, 'Maybe try this: ...\r\n.... another fix .....', '2018-05-09 07:21:01', 6, 0, 6, 1, 0),
(3, 'askldjdf alskdjkas', '2018-05-16 03:36:28', 503, 2, 2, 1, 0);

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
  `fixID` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixcomm`
--

INSERT INTO `fixcomm` (`fixCommID`, `fixComment`, `fixCommDateTime`, `fixCommThUp`, `fixCommThDown`, `userID`, `fixID`, `deleted`) VALUES
(1, 'A comment on Admin\'s fix to Portal', '2018-05-07 22:35:25', 1, 2, 2, 1, 0),
(4, 'New comment', '2018-05-09 05:36:02', 1, 0, 6, 1, 0),
(5, 'Here is a comment', '2018-05-16 04:17:06', 540, 0, 2, 2, 0);

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
  `fixcommID` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixreply`
--

INSERT INTO `fixreply` (`fixReplyID`, `fixReply`, `fixReplyDateTime`, `fixReplyThUp`, `fixReplyThDown`, `userID`, `fixcommID`, `deleted`) VALUES
(1, 'This is a reply to Active\'s comment on Admin\'s fix for Portal', '2018-05-07 22:38:23', 1, 0, 4, 1, 0),
(2, 'Reply to comment', '2018-05-16 04:19:05', 1, 0, 2, 5, 0);

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
(1, 'Portal', 17, 2, '2018-05-07 14:12:47'),
(2, 'Portal 2', 0, 0, '2018-05-07 14:12:59'),
(3, 'Half Life', 0, 0, '2018-05-07 14:13:12'),
(4, 'Test Game', 0, 0, '2018-05-16 13:19:48');

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
  `gameID` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamecomm`
--

INSERT INTO `gamecomm` (`gameCommID`, `gameComment`, `gameCommDateTime`, `gameCommThUp`, `gameCommThDown`, `userID`, `gameID`, `deleted`) VALUES
(1, 'This is a comment on the game Portal by user Admin', '2018-05-07 05:34:16', 13, 20, 1, 1, 0),
(2, '<span style=\"font-weight: 700; text-align: center;\"><h3 style=\"text-align: left;\"><font color=\"#f79646\" style=\"\" face=\"Comic Sans MS\">Test comment</font></h3></span><div style=\"text-align: left;\"><span style=\"color: rgb(0, 41, 33); text-align: center;\"><font face=\"Comic Sans MS\">Inserted this comment using the text editor available for the comments, but then changed the sanitised data in the database to display this comment as intended</font></span></div><div><span style=\"color: rgb(0, 41, 33); text-align: center;\"><font face=\"Comic Sans MS\">I didn\'t want to remove my sanitisation but wanted to show that I could implement a Javascript component</font></span></div>', '2018-05-08 04:09:33', 13, 4, 1, 1, 0);

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
  `gameCommID` int(10) UNSIGNED NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamereply`
--

INSERT INTO `gamereply` (`gameReplyID`, `replyComment`, `replyCommDateTime`, `replyCommThUp`, `replyCommThDown`, `userID`, `gameCommID`, `deleted`) VALUES
(1, 'A reply to admin\'s comment on Portal', '2018-05-07 22:34:40', 8, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rep_calcs`
--

CREATE TABLE `rep_calcs` (
  `repcalcsID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `fixCommRep` int(11) NOT NULL,
  `fixReplyRep` int(11) NOT NULL,
  `gameCommRep` int(11) NOT NULL,
  `gameReplyRep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rep_calcs`
--

INSERT INTO `rep_calcs` (`repcalcsID`, `userID`, `fixCommRep`, `fixReplyRep`, `gameCommRep`, `gameReplyRep`) VALUES
(1, 1, 0, 0, 2, 0),
(2, 2, 539, 1, 0, 7),
(3, 3, 0, 0, 0, 0),
(4, 4, 0, 1, 0, 0),
(5, 5, 0, 0, 0, 0),
(6, 6, 1, 0, 0, 0),
(7, 7, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(512) NOT NULL,
  `userCreateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acctStatus` int(10) UNSIGNED NOT NULL,
  `avatarID` int(10) UNSIGNED DEFAULT NULL,
  `commRep` int(10) UNSIGNED NOT NULL,
  `fixRep` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `userCreateDate`, `acctStatus`, `avatarID`, `commRep`, `fixRep`) VALUES
(1, 'Admin', '$2y$10$trkkHLSlGpO0v6cVjA1IPuF.kohc8SZ4zGpuPlfoQrTybsHndPLBe', '2018-05-06 14:53:47', 3, 1, 2, 15),
(2, 'Active', '$2y$10$3iEh/LXBqGh2T2ivqUBYx.lw.BxxGKs3M9o31ugB.xo5dw6tZAxn2', '2018-05-06 15:06:53', 1, 1, 547, 501),
(3, 'Disabled', '$2y$10$2vpM/NyD3bKC5YxwlHQEQ.iiPlt7j1gM5lTOwZIJlVbHr/FwgTPsK', '2018-05-06 15:07:19', 2, 1, 0, 0),
(4, 'abc123', '$2y$10$8uC9HypnLqn.PksdbsvLi.CgVtntHGl3y4n1jT5/Pymm5pQbbUiHe', '2018-05-07 12:39:06', 1, 1, 1, 0),
(5, 'test1', '$2y$10$EU/k0Hya4RDWcPy/l2IDyekZrBwEGZAnM7dvgM6gsy6qUxD7U7Jn.', '2018-05-09 13:26:41', 1, 1, 0, 0),
(6, 'newuser', '$2y$10$Wsz63/o7yDUiCUVbyWhpJOuIV/2zAJZrt0WYUyN7xHBAA4cZKxzWO', '2018-05-09 15:35:45', 1, 1, 1, 6),
(7, 'newuser1', '$2y$10$gEFy7ue3EeVfaeaAvz8WRecDv5.031SjS2maBj48UTyBB7OoG3ypq', '2018-05-14 12:09:03', 1, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`avatarID`);

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
-- Indexes for table `rep_calcs`
--
ALTER TABLE `rep_calcs`
  ADD PRIMARY KEY (`repcalcsID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `avatarID` (`avatarID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `avatarID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `fix`
--
ALTER TABLE `fix`
  MODIFY `fixID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fixcomm`
--
ALTER TABLE `fixcomm`
  MODIFY `fixCommID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fixreply`
--
ALTER TABLE `fixreply`
  MODIFY `fixReplyID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gamecomm`
--
ALTER TABLE `gamecomm`
  MODIFY `gameCommID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gamereply`
--
ALTER TABLE `gamereply`
  MODIFY `gameReplyID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rep_calcs`
--
ALTER TABLE `rep_calcs`
  MODIFY `repcalcsID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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

--
-- Constraints for table `rep_calcs`
--
ALTER TABLE `rep_calcs`
  ADD CONSTRAINT `rep_calcs_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`avatarID`) REFERENCES `avatar` (`avatarID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
