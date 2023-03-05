-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2023 at 11:14 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-tutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tutee_id` int(11) NOT NULL,
  `tutor_id` varchar(255) NOT NULL,
  `course` varchar(50) NOT NULL,
  `sched_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activities_submitted`
--

CREATE TABLE `activities_submitted` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tutee_id` int(11) NOT NULL,
  `tutor_id` varchar(255) NOT NULL,
  `course` varchar(50) NOT NULL,
  `sched_id` varchar(255) NOT NULL,
  `status` enum('Late','Submitted') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$eTUVBS/vj/uIHRsr1T3nsOGWMVKdyrQOvnhiPLLSHOHXVRFL1lW8i');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(11) NOT NULL,
  `tutor_id` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `tutee_id` int(11) NOT NULL,
  `sched_id` varchar(255) NOT NULL,
  `app_date` date NOT NULL,
  `app_time_start` time NOT NULL,
  `app_time_end` time NOT NULL,
  `status` enum('1','0') NOT NULL,
  `app_status` enum('Done','Pending','Queue','Cancelled','In-Progress','Denied','NULL','Checking') NOT NULL,
  `app_link` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`) VALUES
(1, 'Program Logic Formulation', 'PLF101'),
(3, 'The Contemporary World (Peace Education)', 'GEC3A'),
(4, 'Mathematics in the Modern World', 'GEC4'),
(5, 'Environmental Science', 'GEE1'),
(6, 'Kontekstwalisadong Komunikasyon sa Filipino', 'FILN1'),
(7, 'Fundamentals of Mathematics of Computer Science', 'FMCS101'),
(8, 'Computer Programming', 'CC102'),
(12, 'Software Engineering', 'SE404');

-- --------------------------------------------------------

--
-- Table structure for table `reset_pass`
--

CREATE TABLE `reset_pass` (
  `id` int(11) NOT NULL,
  `reset_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` enum('Tutor','Tutee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `sched_id` varchar(255) NOT NULL,
  `tutor_id` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `sched_date` date NOT NULL,
  `app_time_start` varchar(255) NOT NULL,
  `app_time_end` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutees`
--

CREATE TABLE `tutees` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `y_lvl` enum('I','II','III','IV') NOT NULL,
  `password` varchar(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  `dp` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('Yes','No','Disabled') NOT NULL,
  `active_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` int(11) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `about_me` longtext NOT NULL,
  `my_tagline` varchar(100) NOT NULL,
  `course` varchar(255) NOT NULL,
  `y_lvl` enum('I','II','III','IV') NOT NULL,
  `password` varchar(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  `dp` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` enum('Yes','No','Disabled') NOT NULL,
  `active_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutors_cv`
--

CREATE TABLE `tutors_cv` (
  `id` int(11) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `cv_name` varchar(255) NOT NULL,
  `cv_size` varchar(255) NOT NULL,
  `cv_type` varchar(255) NOT NULL,
  `cv_content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutors_testi`
--

CREATE TABLE `tutors_testi` (
  `id` int(11) NOT NULL,
  `t_id` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `testi` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities_submitted`
--
ALTER TABLE `activities_submitted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_pass`
--
ALTER TABLE `reset_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutees`
--
ALTER TABLE `tutees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutors_cv`
--
ALTER TABLE `tutors_cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutors_testi`
--
ALTER TABLE `tutors_testi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activities_submitted`
--
ALTER TABLE `activities_submitted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reset_pass`
--
ALTER TABLE `reset_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutees`
--
ALTER TABLE `tutees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors_cv`
--
ALTER TABLE `tutors_cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutors_testi`
--
ALTER TABLE `tutors_testi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
