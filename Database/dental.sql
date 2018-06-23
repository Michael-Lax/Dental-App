-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2017 at 08:03 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `aid` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `phone` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`aid`, `name`, `email`, `phone`, `address`, `id`) VALUES
(7, 'Michael  Pearson', 'pearson.michael@uwlax.edu', '2623530656', '349 Prairie Run Grafton, WI 53024', 2),
(8, 'David Doll', 'ddoll8@yahoo.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `dentid` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`name`, `email`, `phone`, `address`, `dentid`, `id`) VALUES
('Lou Sainous', 'sainous.lou@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 2, 4),
('Gary Winthorpe', 'winthorpe.gary@test.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 4, 7),
('Tyler Leverance', 'leverance.tyler@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 5, 10),
('Dan Johnson', 'johnson.dan@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `dentNotifications`
--

CREATE TABLE `dentNotifications` (
  `id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dentSchedules`
--

CREATE TABLE `dentSchedules` (
  `id` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `start` datetime NOT NULL,
  `endT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dentSchedules`
--

INSERT INTO `dentSchedules` (`id`, `did`, `name`, `start`, `endT`) VALUES
(46, 2, 'Lou Sainous', '2017-05-01 09:00:00', '2017-05-01 10:00:00'),
(70, 2, 'Lou Sainous', '2017-05-03 09:00:00', '2017-05-03 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dentTimeOff`
--

CREATE TABLE `dentTimeOff` (
  `id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `start` datetime NOT NULL,
  `endT` datetime NOT NULL,
  `did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dentTimeOff`
--

INSERT INTO `dentTimeOff` (`id`, `name`, `start`, `endT`, `did`) VALUES
(14, 'Gary Winthorpe', '2017-05-04 08:50:00', '2017-05-04 12:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hygienists`
--

CREATE TABLE `hygienists` (
  `hid` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `phone` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hygienists`
--

INSERT INTO `hygienists` (`hid`, `name`, `email`, `phone`, `address`, `id`) VALUES
(1, 'Mike Hunt', 'hunt.mike@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 5),
(2, 'Pat McCrotch', 'pat@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 6),
(3, 'Test Test', 'testing@test.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 8),
(4, 'Michael Pound', 'pound.michael@test.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 9);

-- --------------------------------------------------------

--
-- Table structure for table `hygNotifications`
--

CREATE TABLE `hygNotifications` (
  `id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `hid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hygSchedules`
--

CREATE TABLE `hygSchedules` (
  `id` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `start` datetime NOT NULL,
  `endT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hygSchedules`
--

INSERT INTO `hygSchedules` (`id`, `hid`, `name`, `start`, `endT`) VALUES
(48, 1, 'Mike Hunt', '2017-05-01 09:00:00', '2017-05-01 10:00:00'),
(72, 1, 'Mike Hunt', '2017-05-03 09:00:00', '2017-05-03 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hygTimeOff`
--

CREATE TABLE `hygTimeOff` (
  `id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `start` datetime NOT NULL,
  `endT` datetime NOT NULL,
  `hid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patappts`
--

CREATE TABLE `patappts` (
  `id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `start` datetime NOT NULL,
  `endT` datetime NOT NULL,
  `resourceId` int(11) NOT NULL,
  `dentist` varchar(400) NOT NULL,
  `hyg` varchar(400) NOT NULL,
  `did` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patappts`
--

INSERT INTO `patappts` (`id`, `description`, `title`, `start`, `endT`, `resourceId`, `dentist`, `hyg`, `did`, `hid`, `pid`) VALUES
(130, 'Cleaning', 'Mary Jo', '2017-05-01 09:00:00', '2017-05-01 10:00:00', 1, 'Lou Sainous', 'Mike Hunt', 2, 1, 2),
(154, 'Cleaning', 'Mary Jo', '2017-05-03 09:00:00', '2017-05-03 10:00:00', 2, 'Lou Sainous', 'Mike Hunt', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pid` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `phone` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pid`, `name`, `email`, `phone`, `address`, `id`) VALUES
(2, 'Mary Jo', 'jo.mary@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 3),
(3, 'Joanna Jones', 'jones.joanna@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 11),
(4, 'Chris Schoessow', 'schoessow.chris@email.com', '2623530656', '349 Prairie Run Grafton, WI 53024', 13);

-- --------------------------------------------------------

--
-- Table structure for table `patNotifications`
--

CREATE TABLE `patNotifications` (
  `id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `pid` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `endT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`) VALUES
(1, 'Room 1'),
(2, 'Room 2'),
(3, 'Room 3'),
(4, 'Room 4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `user_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `firstname`, `lastname`, `email`, `pwd`, `phone`, `address`, `user_key`) VALUES
(1, 'David', 'Doll', 'ddoll8@yahoo.com', '$2y$10$7jnagMO.TyEmqfUESr1izeePYpVIr1.2eEZcX5Bxx0oe15l8dnCtm', '2623530656', '349 Prairie Run Grafton, WI 53024', 0),
(2, 'Michael ', 'Pearson', 'pearson.michael@uwlax.edu', '$2y$10$0v.6NGdOQD6rRrkngnvE0eE3SpbA/HXiyrfWvHW.2zGdI6j9m1VvO', '2623530656', '349 Prairie Run Grafton, WI 53024', 0),
(3, 'Mary', 'Jo', 'jo.mary@email.com', '$2y$10$Z/0Rqn.kfy2d7.708GxCu.N1HzWGv/vfZKyMPbAikt.u8XIGW.C46', '2623530656', '349 Prairie Run Grafton, WI 53024', 1),
(4, 'Lou', 'Sainous', 'sainous.lou@email.com', '$2y$10$YWrOUjXOJvraK9D4o.mYUu/3dSNIV6nKdliFUBhBWjF2y.VFaQ9u2', '2623530656', '349 Prairie Run Grafton, WI 53024', 2),
(5, 'Mike', 'Hunt', 'hunt.mike@email.com', '$2y$10$FDejH33EkAwPiVKhRaVv3uEcl06c6ApqqHDUTX2o4iqzuSvthd1ay', '2623530656', '349 Prairie Run Grafton, WI 53024', 3),
(6, 'Pat', 'McCrotch', 'pat@email.com', '$2y$10$.o6JT/K6IYpxbmYcMfl6sOSRJwROo78Avi.ikNxMEArMK74Bt8h0C', '2623530656', '349 Prairie Run Grafton, WI 53024', 3),
(7, 'Gary', 'Winthorpe', 'winthorpe.gary@test.com', '$2y$10$bvplH4H2vywg7NMZoTTr4eSovcKiNlUetxnguOd62SfbXpGlWP4yu', '2623530656', '349 Prairie Run Grafton, WI 53024', 2),
(8, 'Test', 'Test', 'testing@test.com', '$2y$10$dj1auxfc5vAp/eCEA5TurOnDm4V4jgf7E4nWwsCmYleYexQLU3GDS', '2623530656', '349 Prairie Run Grafton, WI 53024', 3),
(9, 'Michael', 'Pound', 'pound.michael@test.com', '$2y$10$cSWKmwAAfrZ6Y7G1nK5CD.MuN8IAUcxA4eF/AZmlbBtuc5wOyQKQq', '2623530656', '349 Prairie Run Grafton, WI 53024', 3),
(10, 'Tyler', 'Leverance', 'leverance.tyler@email.com', '$2y$10$Nw8WebvMpIF6XrwjP53uzOt4CefQNaUykLNsnj8ZvEYE9BBYz2msa', '2623530656', '349 Prairie Run Grafton, WI 53024', 2),
(11, 'Joanna', 'Jones', 'jones.joanna@email.com', '$2y$10$BsXwVbVBRX7xZb/tv.F9ReWox4yPdIhFuIhZXll1hGYmReCUQNnyK', '2623530656', '349 Prairie Run Grafton, WI 53024', 1),
(12, 'Dan', 'Johnson', 'johnson.dan@email.com', '$2y$10$oXojH3Ab2WvzlXy9VjrfuudHEHHzhFZyd8BuaONObklAtNZCwxPZe', '2623530656', '349 Prairie Run Grafton, WI 53024', 2),
(13, 'Chris', 'Schoessow', 'schoessow.chris@email.com', '$2y$10$xFJVEVxtlyV7oXi6mvw2J.c9TR31Yx2ut1m1ToQC0KI9K/09t4qwa', '2623530656', '349 Prairie Run Grafton, WI 53024', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`dentid`);

--
-- Indexes for table `dentNotifications`
--
ALTER TABLE `dentNotifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dentSchedules`
--
ALTER TABLE `dentSchedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `dentTimeOff`
--
ALTER TABLE `dentTimeOff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hygienists`
--
ALTER TABLE `hygienists`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `hygNotifications`
--
ALTER TABLE `hygNotifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hygSchedules`
--
ALTER TABLE `hygSchedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dentid` (`hid`),
  ADD KEY `dentid_2` (`hid`);

--
-- Indexes for table `hygTimeOff`
--
ALTER TABLE `hygTimeOff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patappts`
--
ALTER TABLE `patappts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `patNotifications`
--
ALTER TABLE `patNotifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dentists`
--
ALTER TABLE `dentists`
  MODIFY `dentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dentNotifications`
--
ALTER TABLE `dentNotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dentSchedules`
--
ALTER TABLE `dentSchedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `dentTimeOff`
--
ALTER TABLE `dentTimeOff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `hygienists`
--
ALTER TABLE `hygienists`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hygNotifications`
--
ALTER TABLE `hygNotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hygSchedules`
--
ALTER TABLE `hygSchedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `hygTimeOff`
--
ALTER TABLE `hygTimeOff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patappts`
--
ALTER TABLE `patappts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `patNotifications`
--
ALTER TABLE `patNotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dentSchedules`
--
ALTER TABLE `dentSchedules`
  ADD CONSTRAINT `fk_did` FOREIGN KEY (`did`) REFERENCES `dentists` (`dentid`) ON UPDATE CASCADE;

--
-- Constraints for table `hygSchedules`
--
ALTER TABLE `hygSchedules`
  ADD CONSTRAINT `hygSchedules_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hygienists` (`hid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
