-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2019 at 02:18 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `payrollappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `time_reports`
--

CREATE TABLE IF NOT EXISTS `time_reports` (
  `date_worked` varchar(10) NOT NULL,
  `hours_worked` double NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `job_group` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_reports`
--

INSERT INTO `time_reports` (`date_worked`, `hours_worked`, `employee_id`, `job_group`) VALUES
('14/11/2016', 7.5, '1', 'A'),
('9/11/2016', 4, '2', 'B'),
('10/11/2016', 4, '2', 'B'),
('9/11/2016', 11.5, '3', 'A'),
('8/11/2016', 6, '3', 'A'),
('11/11/2016', 3, '3', 'A'),
('2/11/2016', 6, '3', 'A'),
('3/11/2016', 12, '2', 'B'),
('4/11/2016', 11, '2', 'B'),
('6/11/2016', 5, '4', 'B'),
('21/11/2016', 6, '1', 'A'),
('22/11/2016', 5, '1', 'A'),
('23/11/2016', 5, '4', 'B'),
('24/11/2016', 5, '4', 'B'),
('25/11/2016', 5, '4', 'B'),
('14/12/2016', 7.5, '1', 'A'),
('9/12/2016', 4, '2', 'B'),
('10/12/2016', 4, '2', 'B'),
('9/12/2016', 11.5, '3', 'A'),
('8/12/2016', 6, '3', 'A'),
('12/11/2016', 3, '3', 'A'),
('2/12/2016', 6, '3', 'A'),
('3/12/2016', 12, '2', 'B'),
('4/12/2016', 11, '2', 'B'),
('6/12/2016', 5, '4', 'B'),
('21/12/2016', 6, '1', 'A'),
('22/12/2016', 5, '1', 'A'),
('23/12/2016', 5, '4', 'B'),
('24/12/2016', 5, '4', 'B'),
('25/12/2016', 5, '4', 'B'),
('23/2/2015', 5, '4', 'A'),
('24/2/2016', 5, '4', 'B');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
