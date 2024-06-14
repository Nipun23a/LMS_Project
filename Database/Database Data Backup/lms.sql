-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 08:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_officer`
--

CREATE TABLE `academic_officer` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `registered_by` varchar(100) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nic` varchar(15) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `registered_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `academic_officer`
--

INSERT INTO `academic_officer` (`email`, `fname`, `lname`, `mobile`, `verification_code`, `password`, `registered_by`, `last_login`, `birthday`, `nic`, `gender_id`, `mname`, `status_id`, `surname`, `registered_datetime`) VALUES
('i.chapa10070@gmail.com', 'I', 'Chapa', '0761878135', 'ac8ce7', '133212', 'kingsahan380w@gmail.com', '2024-05-31 11:37:43', '2002-08-07', '200214864679', 2, 'mna', 2, 'jay', NULL),
('nilannisal2004@gmail.com', 'Hasindu', 'Rukshan', '0718700817', 'tec_63b625521ab76', 'ao_63b61fa3ba028', 'kingsahan380w@gmail.com', '2024-01-14 16:16:23', NULL, NULL, 1, NULL, 2, NULL, NULL),
('prabashchathura2020h@gmail.com', 'Chamindu', 'Chathura', '0701229005', 'ao_63b7d619047be', 'ao_63b7d49eb94e0', 'kingsahan380w@gmail.com', NULL, NULL, NULL, 1, NULL, 1, NULL, '2024-01-06 13:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `academic_officer_has_grade`
--

CREATE TABLE `academic_officer_has_grade` (
  `academic_officer_email` varchar(100) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `academic_officer_has_grade`
--

INSERT INTO `academic_officer_has_grade` (`academic_officer_email`, `grade_id`, `id`) VALUES
('nilannisal2004@gmail.com', 4, 5),
('nilannisal2004@gmail.com', 5, 6),
('nilannisal2004@gmail.com', 11, 7),
('i.chapa10070@gmail.com', 1, 8),
('i.chapa10070@gmail.com', 2, 9),
('i.chapa10070@gmail.com', 5, 10),
('prabashchathura2020h@gmail.com', 1, 11),
('prabashchathura2020h@gmail.com', 2, 12),
('prabashchathura2020h@gmail.com', 3, 13),
('prabashchathura2020h@gmail.com', 8, 14);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nic` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `fname`, `lname`, `mobile`, `verification_code`, `password`, `last_login`, `gender_id`, `mname`, `surname`, `birthday`, `nic`) VALUES
('i.chapa10070@gmail.com', 'I', 'Chapa', '0750210996', 'adc02592', 'Test345@', '2024-05-31 14:40:35', 2, NULL, 'IChapa', NULL, NULL),
('kingsahan380w@gmail.com', 'Sahan', 'Sachintha', '0788760234', 'ad_63c288c6ac6f3', 'test@123', '2024-01-14 16:19:58', 1, '', 'Subasin Arachchige', '2004-06-02', '200419801942');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `path` varchar(500) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `period` datetime DEFAULT NULL,
  `grade_has_subject_id` int(11) NOT NULL,
  `teacher_email` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `path`, `time`, `period`, `grade_has_subject_id`, `teacher_email`, `title`) VALUES
(1, 'shared/assignments/6/Web/2_6_note_63b808957403a_Web.pdf', '2024-01-06 17:10:05', '2024-01-10 00:00:00', 6, 'i.chapa10070@gmail.com', 'Web'),
(2, 'shared/assignments/6/Web/2_6_note_63b808957403a_Web.pdf', '2024-01-06 19:10:05', '2024-01-10 00:00:00', 6, 'i.chapa10070@gmail.com', 'Web');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `c_id` int(11) NOT NULL,
  `cname` varchar(45) DEFAULT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`c_id`, `cname`, `district_id`) VALUES
(1, 'Tangalle', 1),
(2, 'Katuwewa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `cid` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`cid`, `name`, `code`) VALUES
(1, 'Sri Lanka', '+94');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `d_id` int(11) NOT NULL,
  `dname` varchar(45) DEFAULT NULL,
  `Province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`d_id`, `dname`, `Province_id`) VALUES
(1, 'Hambantota', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Rather Not to Say');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `fee` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `grade`, `fee`) VALUES
(1, 'Grade 1', 1000),
(2, 'Grade 2', 1000),
(3, 'Grade 3', 1000),
(4, 'Grade 4', 1000),
(5, 'Grade 5', 1000),
(6, 'Grade 6', 1000),
(7, 'Grade 7', 1000),
(8, 'Grade 8', 1000),
(9, 'Grade 9', 1000),
(10, 'Grade 10', 1500),
(11, 'Grade 11', 1500),
(12, 'Grade 12', 1500),
(13, 'Grade 13', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `grade_has_subject`
--

CREATE TABLE `grade_has_subject` (
  `grade_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grade_has_subject`
--

INSERT INTO `grade_has_subject` (`grade_id`, `subject_id`, `id`) VALUES
(1, 4, 1),
(1, 3, 2),
(1, 5, 3),
(1, 7, 4),
(1, 6, 5),
(2, 3, 6),
(2, 4, 7),
(2, 5, 8),
(2, 6, 9),
(2, 7, 10),
(3, 3, 11),
(3, 4, 12),
(3, 5, 13),
(3, 6, 14),
(3, 7, 15),
(4, 3, 16),
(4, 4, 17),
(4, 5, 18),
(4, 6, 19),
(4, 7, 20),
(5, 3, 21),
(5, 4, 22),
(5, 5, 23),
(5, 6, 24),
(5, 7, 25),
(1, 1, 26),
(2, 1, 27),
(3, 1, 28),
(4, 1, 29),
(5, 1, 30),
(6, 2, 31),
(7, 2, 32),
(8, 2, 33),
(6, 1, 35),
(7, 1, 36),
(8, 1, 37),
(9, 1, 38),
(10, 1, 39),
(11, 1, 40),
(9, 2, 41),
(10, 2, 42),
(11, 2, 43),
(6, 3, 44),
(7, 3, 45),
(8, 3, 46),
(9, 3, 47),
(10, 3, 48),
(11, 3, 49),
(6, 4, 50),
(7, 4, 51),
(8, 4, 52),
(9, 4, 53),
(10, 4, 54),
(11, 4, 55),
(6, 5, 56),
(7, 5, 57),
(8, 5, 58),
(9, 5, 59),
(10, 5, 60),
(11, 5, 61),
(6, 6, 62),
(7, 6, 63),
(8, 6, 64),
(9, 6, 65),
(10, 6, 66),
(11, 6, 67),
(6, 7, 68),
(7, 7, 69),
(8, 7, 70),
(9, 7, 71),
(10, 7, 72),
(11, 7, 73),
(6, 8, 74),
(7, 8, 75),
(8, 8, 76),
(9, 8, 77),
(10, 8, 78),
(11, 8, 79),
(6, 9, 80),
(7, 9, 81),
(8, 9, 82),
(9, 9, 83),
(10, 9, 84),
(11, 9, 85),
(6, 10, 86),
(7, 10, 87),
(8, 10, 88),
(9, 10, 89),
(10, 10, 90),
(11, 10, 91),
(6, 26, 92),
(7, 26, 93),
(8, 26, 94),
(9, 26, 95),
(10, 26, 96),
(11, 26, 97),
(6, 27, 98),
(7, 27, 99),
(8, 27, 100),
(9, 27, 101),
(10, 27, 102),
(11, 27, 103),
(10, 11, 104),
(11, 11, 105),
(10, 12, 106),
(11, 12, 107),
(10, 15, 108),
(11, 15, 109),
(10, 16, 110),
(11, 16, 111),
(10, 17, 112),
(11, 17, 113),
(10, 25, 114),
(11, 25, 115),
(10, 29, 116),
(11, 29, 117),
(10, 28, 118),
(11, 28, 119),
(6, 28, 120),
(7, 28, 121),
(8, 28, 122),
(8, 28, 123),
(10, 21, 124),
(11, 21, 125),
(6, 21, 126),
(7, 21, 127),
(8, 21, 128),
(8, 21, 129),
(12, 11, 130),
(13, 11, 131),
(12, 12, 132),
(13, 12, 133),
(12, 21, 134),
(13, 21, 135),
(12, 13, 136),
(13, 13, 137),
(12, 20, 138),
(13, 20, 139),
(12, 31, 140),
(13, 31, 141),
(12, 18, 142),
(13, 18, 143),
(12, 19, 144),
(13, 19, 145),
(12, 23, 146),
(13, 23, 147),
(12, 22, 148),
(13, 22, 149),
(12, 24, 150),
(13, 24, 151),
(12, 25, 152),
(13, 25, 153),
(12, 14, 154),
(13, 14, 155),
(12, 15, 156),
(13, 15, 157),
(12, 16, 158),
(13, 16, 159),
(12, 17, 160),
(13, 17, 161),
(12, 7, 162),
(13, 7, 163),
(12, 8, 164),
(13, 8, 165),
(12, 26, 166),
(13, 26, 167),
(12, 27, 168),
(13, 27, 169),
(12, 29, 170),
(13, 29, 171),
(12, 30, 172),
(13, 30, 173);

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `id` int(11) NOT NULL,
  `nic` varchar(20) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `mobile` varchar(13) DEFAULT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `relationship_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`id`, `nic`, `fname`, `lname`, `surname`, `mobile`, `mname`, `relationship_id`) VALUES
(1, '197234100129', 'Saduni', '', '', '0712230554', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `path` varchar(500) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `grade_has_subject_id` int(11) NOT NULL,
  `teacher_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `path`, `time`, `title`, `grade_has_subject_id`, `teacher_email`) VALUES
(8, 'shared/notes/6/sample/2_6_note_63b7de1d83fca_sample.pdf', '2024-01-06 14:08:53', 'sample', 6, 'i.chapa10070@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `status`) VALUES
(1, 'Not Paid'),
(2, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `p_id` int(11) NOT NULL,
  `pname` varchar(45) DEFAULT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`p_id`, `pname`, `country_id`) VALUES
(1, 'Southern', 1);

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `id` int(11) NOT NULL,
  `relation` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`id`, `relation`) VALUES
(1, 'Father'),
(2, 'Mother'),
(3, 'Husband'),
(4, 'Wife'),
(5, 'Guardian-in-Law');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Unverified'),
(2, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `index_no` varchar(8) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL,
  `academic_officer_email` varchar(100) DEFAULT NULL,
  `registered_datetime` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `guardian_id` int(11) DEFAULT NULL,
  `grade_id` int(11) NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `payment_status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`email`, `fname`, `lname`, `surname`, `index_no`, `mobile`, `verification_code`, `password`, `academic_officer_email`, `registered_datetime`, `last_login`, `birthday`, `gender_id`, `mname`, `status_id`, `guardian_id`, `grade_id`, `admin_email`, `payment_status_id`) VALUES
('i.chapa10070@gmail.com', 'I', 'chapa', 'Jayasingha', '1', '0750210996', '', '1234', 'i.chapa10070@gmail.com', '2024-05-31 14:22:27', '2024-05-31 14:26:44', '2015-02-28', 1, '1', 2, 1, 2, 'i.chapa10070@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_has_gs`
--

CREATE TABLE `student_has_gs` (
  `student_email` varchar(100) NOT NULL,
  `grade_has_subject_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `enrolled_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'Mathematics'),
(2, 'Science'),
(3, 'English'),
(4, 'Sinhala'),
(5, 'Tamil'),
(6, 'Buddhism'),
(7, 'Art'),
(8, 'Music'),
(9, 'Civic Education'),
(10, 'Geography'),
(11, 'Accounting'),
(12, 'Business Studies'),
(13, 'Economic Science'),
(14, 'Political Science'),
(15, 'Japan'),
(16, 'Sinhala Literature'),
(17, 'English Literature'),
(18, 'Physics'),
(19, 'Chemistry'),
(20, 'Combined Mathematics'),
(21, 'Information and Communication Technology'),
(22, 'Engineering Technology'),
(23, 'Science For Technology'),
(24, 'Bio Science Technology'),
(25, 'Agricuture'),
(26, 'Dance'),
(27, 'Drama'),
(28, 'Health Education'),
(29, 'Home Science'),
(30, 'Media'),
(31, 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `fee` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `type`, `fee`) VALUES
(1, 'Portal', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `verification_code` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `registered_by` varchar(100) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nic` varchar(15) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `grade_has_subject_id` int(11) DEFAULT NULL,
  `registered_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`email`, `fname`, `lname`, `mobile`, `verification_code`, `password`, `registered_by`, `last_login`, `birthday`, `nic`, `gender_id`, `mname`, `status_id`, `surname`, `grade_has_subject_id`, `registered_datetime`) VALUES
('i.chapa10070@gmail.com', 'I', 'chapa', '0750210996', 'tec_63ba9020821d9', '1234', 'i.chapa10070@gmail.com', '2024-05-31 14:27:45', NULL, NULL, 2, NULL, 2, NULL, 6, '2024-01-07 19:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `upload_status`
--

CREATE TABLE `upload_status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `upload_status`
--

INSERT INTO `upload_status` (`id`, `status`) VALUES
(1, 'Not Submitted'),
(2, 'Submitted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_officer`
--
ALTER TABLE `academic_officer`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_academic_officer_admin1_idx` (`registered_by`),
  ADD KEY `fk_academic_officer_gender1_idx` (`gender_id`),
  ADD KEY `fk_academic_officer_status1_idx` (`status_id`);

--
-- Indexes for table `academic_officer_has_grade`
--
ALTER TABLE `academic_officer_has_grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_academic_officer_has_grade_grade1_idx` (`grade_id`),
  ADD KEY `fk_academic_officer_has_grade_academic_officer1_idx` (`academic_officer_email`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_admin_gender1_idx` (`gender_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_assignments_grade_has_subject1_idx` (`grade_has_subject_id`),
  ADD KEY `fk_assignments_teacher1_idx` (`teacher_email`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_city_district1_idx` (`district_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `fk_district_Province1_idx` (`Province_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_has_subject`
--
ALTER TABLE `grade_has_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grade_has_subject_subject1_idx` (`subject_id`),
  ADD KEY `fk_grade_has_subject_grade1_idx` (`grade_id`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guardian_relationship1_idx` (`relationship_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notes_grade_has_subject1_idx` (`grade_has_subject_id`),
  ADD KEY `fk_notes_teacher1_idx` (`teacher_email`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `fk_Province_country1_idx` (`country_id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`,`fname`),
  ADD KEY `fk_student_academic_officer1_idx` (`academic_officer_email`),
  ADD KEY `fk_student_gender1_idx` (`gender_id`),
  ADD KEY `fk_student_status1_idx` (`status_id`),
  ADD KEY `fk_student_guardian1_idx` (`guardian_id`),
  ADD KEY `fk_student_grade1_idx` (`grade_id`),
  ADD KEY `fk_student_admin1_idx` (`admin_email`) USING BTREE,
  ADD KEY `fk_student_payment_status1_idx` (`payment_status_id`);

--
-- Indexes for table `student_has_gs`
--
ALTER TABLE `student_has_gs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_has_grade_has_subject_grade_has_subject1_idx` (`grade_has_subject_id`),
  ADD KEY `fk_student_has_grade_has_subject_student1_idx` (`student_email`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_teacher_admin1_idx` (`registered_by`),
  ADD KEY `fk_teacher_gender1_idx` (`gender_id`),
  ADD KEY `fk_teacher_status1_idx` (`status_id`),
  ADD KEY `fk_teacher_grade_has_subject1_idx` (`grade_has_subject_id`);

--
-- Indexes for table `upload_status`
--
ALTER TABLE `upload_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_officer_has_grade`
--
ALTER TABLE `academic_officer_has_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `grade_has_subject`
--
ALTER TABLE `grade_has_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_has_gs`
--
ALTER TABLE `student_has_gs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload_status`
--
ALTER TABLE `upload_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_officer`
--
ALTER TABLE `academic_officer`
  ADD CONSTRAINT `fk_academic_officer_admin1` FOREIGN KEY (`registered_by`) REFERENCES `admin` (`email`),
  ADD CONSTRAINT `fk_academic_officer_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  ADD CONSTRAINT `fk_academic_officer_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `academic_officer_has_grade`
--
ALTER TABLE `academic_officer_has_grade`
  ADD CONSTRAINT `fk_academic_officer_has_grade_academic_officer1` FOREIGN KEY (`academic_officer_email`) REFERENCES `academic_officer` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_academic_officer_has_grade_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`);

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_assignments_grade_has_subject1` FOREIGN KEY (`grade_has_subject_id`) REFERENCES `grade_has_subject` (`id`),
  ADD CONSTRAINT `fk_assignments_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`d_id`);

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk_district_Province1` FOREIGN KEY (`Province_id`) REFERENCES `province` (`p_id`);

--
-- Constraints for table `grade_has_subject`
--
ALTER TABLE `grade_has_subject`
  ADD CONSTRAINT `fk_grade_has_subject_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  ADD CONSTRAINT `fk_grade_has_subject_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `guardian`
--
ALTER TABLE `guardian`
  ADD CONSTRAINT `fk_guardian_relationship1` FOREIGN KEY (`relationship_id`) REFERENCES `relationship` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_notes_grade_has_subject1` FOREIGN KEY (`grade_has_subject_id`) REFERENCES `grade_has_subject` (`id`),
  ADD CONSTRAINT `fk_notes_teacher1` FOREIGN KEY (`teacher_email`) REFERENCES `teacher` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `province`
--
ALTER TABLE `province`
  ADD CONSTRAINT `fk_Province_country1` FOREIGN KEY (`country_id`) REFERENCES `country` (`cid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_academic_officer1` FOREIGN KEY (`academic_officer_email`) REFERENCES `academic_officer` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_admin1` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_guardian1` FOREIGN KEY (`guardian_id`) REFERENCES `guardian` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_payment_status1` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `student_has_gs`
--
ALTER TABLE `student_has_gs`
  ADD CONSTRAINT `fk_student_has_grade_has_subject_grade_has_subject1` FOREIGN KEY (`grade_has_subject_id`) REFERENCES `grade_has_subject` (`id`),
  ADD CONSTRAINT `fk_student_has_grade_has_subject_student1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_teacher_admin1` FOREIGN KEY (`registered_by`) REFERENCES `admin` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_grade_has_subject1` FOREIGN KEY (`grade_has_subject_id`) REFERENCES `grade_has_subject` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teacher_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
