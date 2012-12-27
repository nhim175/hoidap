-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2012 at 07:46 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vtc`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `name`, `position`) VALUES
(1, 'chuyengia_thuysan', '4297f44b13955235245b2497399d7a93', 'Chuyên gia thủy sản', 'adviser'),
(2, 'chuyengia_trongtrot', '4297f44b13955235245b2497399d7a93', 'Chuyên gia trồng trọt', 'adviser'),
(3, 'chuyengia_channuoi', '4297f44b13955235245b2497399d7a93', 'Chuyên gia chăn nuôi', 'adviser'),
(4, 'mc', '4297f44b13955235245b2497399d7a93', 'MC', 'mc'),
(5, 'thuky', '4297f44b13955235245b2497399d7a93', 'Thư ký', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `content`, `date`, `active`, `account_id`) VALUES
(1, 'hello 123', '2012-12-26 20:01:36', '1', 1),
(2, 'hello world', '2012-12-26 20:02:21', '1', 1),
(3, 'welcome', '2012-12-26 20:02:24', '1', 1),
(4, 'hello hello', '2012-12-26 20:17:26', '1', 1),
(5, 'asdasd', '2012-12-26 20:17:50', '1', 1),
(6, 'askdjlasd', '2012-12-26 20:17:51', '1', 1),
(7, 'kasdklasdjklasd', '2012-12-26 20:17:52', '1', 1),
(8, 'casnkcmxzc', '2012-12-26 20:17:53', '1', 1),
(9, 'akskasdkjkasd', '2012-12-26 20:17:55', '1', 1),
(10, 'mcx,zm,xcm,', '2012-12-26 20:17:56', '1', 1),
(11, 'sdkoaskodas', '2012-12-26 20:17:58', '1', 1),
(12, 'oksdakosda', '2012-12-26 20:18:01', '1', 1),
(13, 'cmxkzmkcx', '2012-12-26 20:18:02', '1', 1),
(14, 'asjdkasjdk', '2012-12-26 20:18:03', '1', 1),
(15, 'mckxzmkcxz', '2012-12-26 20:18:05', '1', 1),
(16, 'asmdkajskd', '2012-12-26 20:18:06', '1', 1),
(17, 'cnmxzkcnkax', '2012-12-26 20:18:08', '1', 1),
(18, 'mcxkzmc', '2012-12-26 20:18:10', '1', 1),
(19, 'aksldkasl', '2012-12-26 20:20:14', '1', 1),
(20, 'baomoi.com', '2012-12-26 20:20:17', '1', 1),
(21, 'baomoi', '2012-12-26 20:20:26', '1', 1),
(22, 'hello', '2012-12-26 20:20:32', '1', 1),
(23, 'asddas', '2012-12-26 20:22:20', '1', 1),
(24, 'help', '2012-12-26 20:22:23', '1', 1),
(25, 'comeon baby', '2012-12-26 20:22:51', '1', 2),
(26, 'help', '2012-12-26 20:24:12', '1', 2),
(27, 'asdasd', '2012-12-26 20:49:15', '1', 5),
(28, 'babe', '2012-12-26 20:49:19', '1', 5),
(29, 'hello', '2012-12-27 12:04:08', '1', 5),
(30, 'come one', '2012-12-27 12:29:07', '1', 4),
(31, 'welcome', '2012-12-27 12:29:09', '1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 NOT NULL,
  `adviser` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '3=next,solved=2, unsolved=1',
  `active` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `later` bit(1) NOT NULL DEFAULT b'0' COMMENT 'trả lời sau',
  PRIMARY KEY (`id`),
  KEY `adviser` (`adviser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `content`, `adviser`, `status`, `active`, `date`, `later`) VALUES
(1, 'demo question', 1, 2, 1, '2012-12-26 00:00:00', '0'),
(2, 'another demo question', NULL, 1, 0, '2012-12-26 00:00:00', '0'),
(3, 'some question?', 3, 1, 1, '2012-12-26 00:00:00', '0'),
(4, 'adviser1''s question', 2, 2, 1, '2012-12-26 00:00:00', '0'),
(5, 'asdasdasd', NULL, 1, 0, '2012-12-26 00:00:00', '0'),
(6, 'asdasdasd', 1, 1, 1, '2012-12-26 00:00:00', '0'),
(7, 'Here''s a new question', 2, 1, 1, '2012-12-26 00:00:00', '0'),
(8, 'Another new question', 1, 2, 1, '2012-12-26 00:00:00', '0'),
(9, 'câu hỏi mới', 1, 2, 1, '2012-12-26 00:00:00', '0'),
(10, 'thêm câu hỏi', 3, 2, 1, '2012-12-26 00:00:00', '0'),
(11, 'What''s your name', 1, 2, 1, '2012-12-26 00:00:00', '0'),
(12, 'hello', NULL, 1, 0, '2012-12-25 00:00:00', '0'),
(13, 'demo demo demo', NULL, 1, 0, '2012-12-26 11:57:50', '0'),
(14, 'câu hỏi mới nhất chưa trả lời', 2, 2, 1, '2012-12-26 12:23:44', '1'),
(15, 'Câu hỏi mới nhất', 1, 2, 1, '2012-12-26 14:41:11', '1'),
(16, 'Câu hỏi mới nhất (demo)', NULL, 3, 1, '2012-12-26 14:55:28', '1'),
(17, 'Câu hỏi 1', NULL, 1, 1, '2012-12-26 14:56:58', '0'),
(18, 'Câu hỏi 2', NULL, 2, 1, '2012-12-26 14:57:00', '0'),
(19, 'Câu hỏi 3', NULL, 1, 1, '2012-12-26 14:57:02', '1'),
(20, 'câu hỏi 4', NULL, 3, 1, '2012-12-26 18:47:42', '0'),
(21, 'câu hỏi 5', NULL, 3, 1, '2012-12-26 18:47:45', '0'),
(22, 'câu hỏi 6', NULL, 3, 1, '2012-12-26 18:47:47', '0'),
(23, 'câu hỏi 7', NULL, 3, 1, '2012-12-26 18:47:49', '0'),
(24, 'câu hỏi 8', NULL, 3, 1, '2012-12-26 18:47:51', '0'),
(25, 'câu hỏi 9', NULL, 3, 1, '2012-12-26 18:47:53', '0'),
(26, 'câu hỏi 10', NULL, 3, 1, '2012-12-26 18:47:55', '0'),
(27, 'Câu hỏi mới nè', NULL, 1, 1, '2012-12-27 12:45:41', '0'),
(28, 'Thêm câu nữa', NULL, 1, 1, '2012-12-27 12:45:47', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`adviser`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
