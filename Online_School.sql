-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 06:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Online_School`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `Class_number` char(3) NOT NULL,
  `COO_id` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`Class_number`, `COO_id`) VALUES
('07G', '01'),
('08G', '02'),
('09S', '03'),
('09C', '04'),
('09A', '05'),
('10S', '06'),
('10C', '08'),
('10A', '12');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_name` varchar(150) NOT NULL,
  `content_title` varchar(150) NOT NULL,
  `content_link` mediumtext NOT NULL,
  `content_serial_no` int(11) NOT NULL,
  `content_description` longtext DEFAULT NULL,
  `content_detail_text` longtext DEFAULT NULL,
  `content_id` char(12) NOT NULL,
  `week_id` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_name`, `content_title`, `content_link`, `content_serial_no`, `content_description`, `content_detail_text`, `content_id`, `week_id`) VALUES
('Linear equations', 'Variables', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/bAerID24QJ0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, 'Linear equations are equations of the first order. These equations are defined for lines in the coordinate system.', 'Linear equations are equations of the first order. These equations are defined for lines in the coordinate system. An equation for a straight line is called a linear equation. The general representation of the straight-line equation is y=mx+b, where m is the slope of the line and b is the y-intercept.', '19MAT07G0002', '19MAT07G');

-- --------------------------------------------------------

--
-- Table structure for table `content_content_type`
--

CREATE TABLE `content_content_type` (
  `content_type` varchar(10) NOT NULL,
  `content_id` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_content_type`
--

INSERT INTO `content_content_type` (`content_type`, `content_id`) VALUES
('video', '19MAT07G0002');

-- --------------------------------------------------------

--
-- Table structure for table `co_ordinator`
--

CREATE TABLE `co_ordinator` (
  `COO_id` char(2) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(15) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `Last_name` varchar(10) NOT NULL,
  `First_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_ordinator`
--

INSERT INTO `co_ordinator` (`COO_id`, `user_name`, `email`, `password`, `contact_no`, `Last_name`, `First_name`) VALUES
('01', 'ridvan01', 'ridvanmir01@gmail.com', '12345', '12345678911', 'mir', 'ridvan'),
('02', 'Mukesh123', 'mukesh123@gmail.com', '12345', '12345678911', 'Mukesh', 'Rishi Das'),
('03', 'dhrubaDas', 'dhrubadas482@gmail.com', '12345', '12345678911', 'Das', 'Arka Deep'),
('04', 'Tushar21', 'tusharmuhammadanik@gmail.com', '12345', '12345678911', 'Tushar', 'Muhammad Anik '),
('05', 'Abdul23', 'sajjadhai@gmail.com', '12345', '12345678911', 'Abdul', 'Sajjad Hai'),
('06', 'kormokar', 'kormokar@gmail.com', '12345', '12345678911', 'kormokar', 'Bindu Saha'),
('07', 'NidhiSharkar', 'nidhisharkar@gmail.com', '12345', '12345678911', 'sharkar', 'Nidhi'),
('08', 'sabik', 'sabikislam@gmail.com', '12345', '12345678911', 'sabik', 'saikat islam'),
('09', 'samiaAfroz01', 'samiaAfroz@gmail.com', '12345', '12345678911', 'Nahida', 'Samia Afroz'),
('10', 'stonedwood', 'stonedwooddw@gmail.com', '12345', '12345678911', 'wood', 'stoned'),
('11', 'Shilpi12', 'khadijaislam@gmail.com', '12345', '12345678911', 'Shilpi', 'Bushra Islam'),
('12', 'binitakhan23', 'binita.khan23@gmail.com', '12345', '12345678911', 'Shakal', 'Binita Khan');

-- --------------------------------------------------------

--
-- Table structure for table `co_ordinator_co_ordinator_type`
--

CREATE TABLE `co_ordinator_co_ordinator_type` (
  `co_ordinator_type` varchar(20) NOT NULL,
  `COO_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `co_ordinator_co_ordinator_type`
--

INSERT INTO `co_ordinator_co_ordinator_type` (`co_ordinator_type`, `COO_id`) VALUES
('Class_Co_Ordinator', '01'),
('Class_Co_Ordinator', '02'),
('Class_Co_Ordinator', '03'),
('Class_Co_Ordinator', '04'),
('Class_Co_Ordinator', '05'),
('Class_Co_Ordinator', '06'),
('Class_Co_Ordinator', '07'),
('Class_Co_Ordinator', '08'),
('Subject_Co_Ordinator', '09'),
('Subject_Co_Ordinator', '10'),
('Subject_Co_Ordinator', '11'),
('Subject_Co_Ordinator', '12');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_name` varchar(20) NOT NULL,
  `submission_link` mediumtext NOT NULL,
  `question_link` mediumtext NOT NULL,
  `exam_id` char(7) NOT NULL,
  `exam_mark` int(11) NOT NULL,
  `subject_id` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_name`, `submission_link`, `question_link`, `exam_id`, `exam_mark`, `subject_id`) VALUES
('Final', 'https://tutorial.math.lamar.edu/problems/alg/solvelineareqns.aspx', 'https://tutorial.math.lamar.edu/problems/alg/solvelineareqns.aspx', 'FMAT07G', 60, 'MAT07G'),
('Mid', 'https://tutorial.math.lamar.edu/problems/alg/solvelineareqns.aspx', 'https://tutorial.math.lamar.edu/problems/alg/solvelineareqns.aspx', 'MMAT07G', 50, 'MAT07G');

-- --------------------------------------------------------

--
-- Table structure for table `final`
--

CREATE TABLE `final` (
  `final_percentage` int(2) NOT NULL,
  `exam_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `final`
--

INSERT INTO `final` (`final_percentage`, `exam_id`) VALUES
(70, 'FMAT07G');

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE `grading` (
  `grade` char(1) NOT NULL,
  `subject_id` char(6) NOT NULL,
  `student_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grading`
--

INSERT INTO `grading` (`grade`, `subject_id`, `student_id`) VALUES
('B', 'MAT07G', '19301097'),
('A', 'PHY07G', '19301097');

-- --------------------------------------------------------

--
-- Table structure for table `mid`
--

CREATE TABLE `mid` (
  `mid_percentage` int(2) NOT NULL,
  `exam_id` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mid`
--

INSERT INTO `mid` (`mid_percentage`, `exam_id`) VALUES
(30, 'MMAT07G');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `mark` int(11) NOT NULL,
  `exam_id` char(7) NOT NULL,
  `student_id` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`mark`, `exam_id`, `student_id`) VALUES
(25, 'FMAT07G', '19301097'),
(15, 'MMAT07G', '19301097');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(10) NOT NULL,
  `user_name` char(25) NOT NULL,
  `contact_no` char(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `student_id` char(8) NOT NULL,
  `Class_number` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`First_name`, `Last_name`, `user_name`, `contact_no`, `password`, `email`, `student_id`, `Class_number`) VALUES
('abdullah hasan', 'sajjad', 'rafi', '12345678911', '12345', 'rafiabdullahhasansajjad@gmail.com', '19301097', '07G');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_name` varchar(30) NOT NULL,
  `subject_id` char(6) NOT NULL,
  `class_number` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_name`, `subject_id`, `class_number`) VALUES
('general biology', 'BIO09S', '09S'),
('basic chemistry', 'CHE09S', '09S'),
('class seven mathematics ', 'MAT07G', '07G'),
('general mathematics', 'MAT09S', '09S'),
('class seven physics', 'PHY07G', '07G'),
('elementary physics', 'PHY09S', '09S');

-- --------------------------------------------------------

--
-- Table structure for table `subject_manager`
--

CREATE TABLE `subject_manager` (
  `subject_id` char(6) NOT NULL,
  `COO_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_manager`
--

INSERT INTO `subject_manager` (`subject_id`, `COO_id`) VALUES
('MAT09S', '12'),
('PHY09S', '12');

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

CREATE TABLE `week` (
  `week_title` varchar(50) NOT NULL,
  `week_id` char(8) NOT NULL,
  `week_number` int(2) NOT NULL,
  `subject_id` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`week_title`, `week_id`, `week_number`, `subject_id`) VALUES
('Basic Algebra', '19MAT07G', 1, 'MAT07G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Class_number`),
  ADD KEY `class_ibfk_1` (`COO_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `content_ibfk_1` (`week_id`);

--
-- Indexes for table `content_content_type`
--
ALTER TABLE `content_content_type`
  ADD PRIMARY KEY (`content_type`,`content_id`),
  ADD KEY `content_content_type_ibfk_1` (`content_id`);

--
-- Indexes for table `co_ordinator`
--
ALTER TABLE `co_ordinator`
  ADD PRIMARY KEY (`COO_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `co_ordinator_co_ordinator_type`
--
ALTER TABLE `co_ordinator_co_ordinator_type`
  ADD PRIMARY KEY (`co_ordinator_type`,`COO_id`),
  ADD KEY `co_ordinator_co_ordinator_type_ibfk_1` (`COO_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `final`
--
ALTER TABLE `final`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `grading`
--
ALTER TABLE `grading`
  ADD PRIMARY KEY (`subject_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `mid`
--
ALTER TABLE `mid`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`exam_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `Class_number` (`Class_number`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `subject_ibfk_1` (`class_number`);

--
-- Indexes for table `subject_manager`
--
ALTER TABLE `subject_manager`
  ADD PRIMARY KEY (`subject_id`,`COO_id`),
  ADD KEY `COO_id` (`COO_id`);

--
-- Indexes for table `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`week_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`COO_id`) REFERENCES `co_ordinator` (`COO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`week_id`) REFERENCES `week` (`week_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_content_type`
--
ALTER TABLE `content_content_type`
  ADD CONSTRAINT `content_content_type_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `co_ordinator_co_ordinator_type`
--
ALTER TABLE `co_ordinator_co_ordinator_type`
  ADD CONSTRAINT `co_ordinator_co_ordinator_type_ibfk_1` FOREIGN KEY (`COO_id`) REFERENCES `co_ordinator` (`COO_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `final`
--
ALTER TABLE `final`
  ADD CONSTRAINT `final_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grading`
--
ALTER TABLE `grading`
  ADD CONSTRAINT `grading_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grading_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mid`
--
ALTER TABLE `mid`
  ADD CONSTRAINT `mid_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Class_number`) REFERENCES `class` (`Class_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`class_number`) REFERENCES `class` (`Class_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_manager`
--
ALTER TABLE `subject_manager`
  ADD CONSTRAINT `subject_manager_ibfk_1` FOREIGN KEY (`COO_id`) REFERENCES `co_ordinator` (`COO_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_manager_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `week`
--
ALTER TABLE `week`
  ADD CONSTRAINT `week_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
