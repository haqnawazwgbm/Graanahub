-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2019 at 07:44 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `human_resource`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_cities`
--

CREATE TABLE `hr_cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_cities`
--

INSERT INTO `hr_cities` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Peshawar, Khyber Pakhtunkhwa', 1, '2019-02-18 13:11:00', '0000-00-00 00:00:00'),
(3, 'Karachi, Sindh', 1, '2019-02-18 13:11:50', '0000-00-00 00:00:00'),
(4, 'Lahore', 1, '2019-02-18 13:13:13', '0000-00-00 00:00:00'),
(5, 'Faisalabad', 1, '2019-02-18 13:12:30', '0000-00-00 00:00:00'),
(6, 'Rawalpindi', 1, '2019-02-18 13:13:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_code_conducts`
--

CREATE TABLE `hr_code_conducts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_code_conduct_pictures`
--

CREATE TABLE `hr_code_conduct_pictures` (
  `id` int(11) NOT NULL,
  `code_conduct_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_departments`
--

CREATE TABLE `hr_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_departments`
--

INSERT INTO `hr_departments` (`id`, `name`, `description`, `status`, `created`, `modified`) VALUES
(1, 'Graana Dev', 'Graana Development Team', 1, '2019-02-20 17:08:33', '0000-00-00 00:00:00'),
(2, 'Graana architect', '', 1, '2019-02-21 15:04:00', '2019-01-21 06:26:11'),
(3, 'Dev Team 2', '', 1, '2019-01-21 06:26:50', '2019-01-21 06:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `hr_dependants`
--

CREATE TABLE `hr_dependants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_dependants`
--

INSERT INTO `hr_dependants` (`id`, `user_id`, `name`, `dob`, `relationship`, `mobile_no`, `address`, `mobile`, `created`, `modified`) VALUES
(148, 35, '', '0000-00-00', '', '', '', 0, '2019-03-08 12:16:48', '2019-03-08 12:16:48'),
(149, 1, 'name', '2019-01-09', 'Husband', '222222', '', 0, '2019-03-21 02:37:30', '2019-03-21 02:37:30'),
(150, 1, 'name2', '2019-01-23', 'Mother', '1111111', '', 0, '2019-03-21 02:37:30', '2019-03-21 02:37:30'),
(151, 2, '', '0000-00-00', '', '', '', 0, '2019-03-26 10:42:32', '2019-03-26 10:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `hr_designations`
--

CREATE TABLE `hr_designations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_designations`
--

INSERT INTO `hr_designations` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Manager', 1, '2019-02-20 00:00:00', '0000-00-00 00:00:00'),
(3, 'Developers', 1, '2019-02-20 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_domicile`
--

CREATE TABLE `hr_domicile` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_domicile`
--

INSERT INTO `hr_domicile` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Khyber Pakhtunkhwa', '2019-03-27 04:41:53', '0000-00-00 00:00:00'),
(2, 'Islamabad Capital Territory', '2019-03-27 04:41:53', '0000-00-00 00:00:00'),
(5, 'Punjab', '2019-03-27 04:42:10', '0000-00-00 00:00:00'),
(6, 'Sindh', '2019-03-27 04:42:10', '0000-00-00 00:00:00'),
(9, 'Balochistan', '2019-03-27 04:42:26', '0000-00-00 00:00:00'),
(10, 'Gilgit-Baltistan', '2019-03-27 04:42:26', '0000-00-00 00:00:00'),
(13, 'Azad Jammu and Kashmir', '2019-03-27 04:42:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_educations`
--

CREATE TABLE `hr_educations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `degree_title` varchar(255) DEFAULT NULL,
  `major_subjects` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_educations`
--

INSERT INTO `hr_educations` (`id`, `user_id`, `university_name`, `degree_title`, `major_subjects`, `start_date`, `end_date`, `status`, `created`, `modified`) VALUES
(226, 35, '', '', '', '1970-01-01', '1970-01-01', 1, '2019-03-08 12:16:48', '2019-03-08 17:16:48'),
(227, 1, '', 'Msc (computer science)', 'Computer Science', '2017-01-20', '2018-01-21', 1, '2019-03-21 02:37:30', '2019-03-21 07:37:30'),
(228, 1, '', 'Msc (computer science)', 'Computer Science', '2017-01-17', '2018-01-26', 1, '2019-03-21 02:37:30', '2019-03-21 07:37:30'),
(230, 2, '', '', '', '1970-01-01', '1970-01-01', 1, '2019-03-26 10:42:32', '2019-03-26 15:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `hr_experience`
--

CREATE TABLE `hr_experience` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_experience`
--

INSERT INTO `hr_experience` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Fresh', '2019-03-27 04:43:55', '0000-00-00 00:00:00'),
(2, 'Less than 1 year', '2019-03-27 04:43:55', '0000-00-00 00:00:00'),
(3, '1 Year', '2019-03-27 04:44:50', '0000-00-00 00:00:00'),
(4, '2 Years', '2019-03-27 04:44:50', '0000-00-00 00:00:00'),
(5, '3 Years', '2019-03-27 04:45:10', '0000-00-00 00:00:00'),
(6, '4 Years', '2019-03-27 04:45:10', '0000-00-00 00:00:00'),
(7, '5 Years', '2019-03-27 04:45:26', '0000-00-00 00:00:00'),
(8, '6 Years', '2019-03-27 04:45:26', '0000-00-00 00:00:00'),
(9, '7 Years', '2019-03-27 04:45:42', '0000-00-00 00:00:00'),
(10, '8 Years', '2019-03-27 04:45:42', '0000-00-00 00:00:00'),
(11, '9 Years', '2019-03-27 04:47:04', '0000-00-00 00:00:00'),
(12, '10 Years', '2019-03-27 04:47:10', '0000-00-00 00:00:00'),
(13, '11 Years', '2019-03-27 04:47:19', '0000-00-00 00:00:00'),
(14, '12 Years', '2019-03-27 04:47:24', '0000-00-00 00:00:00'),
(15, '13 Years', '2019-03-27 04:47:28', '0000-00-00 00:00:00'),
(16, '14 Years', '2019-03-27 04:47:32', '0000-00-00 00:00:00'),
(17, '15 Years', '2019-03-27 04:48:03', '0000-00-00 00:00:00'),
(18, 'More than 15 years', '2019-03-27 04:48:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_jobs`
--

CREATE TABLE `hr_jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `vacancies` varchar(100) NOT NULL,
  `experience_id` int(11) NOT NULL,
  `age` varchar(100) NOT NULL,
  `salary_from` varchar(100) NOT NULL,
  `salary_to` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `job_type` varchar(100) NOT NULL,
  `job_status` varchar(100) NOT NULL,
  `domicile_id` int(11) NOT NULL,
  `education` varchar(100) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_jobs`
--

INSERT INTO `hr_jobs` (`id`, `title`, `location`, `vacancies`, `experience_id`, `age`, `salary_from`, `salary_to`, `department_id`, `start_date`, `expire_date`, `job_type`, `job_status`, `domicile_id`, `education`, `description`, `status`, `created`, `modified`) VALUES
(1, 'Web Development', 'test33', '3', 6, '23', '', '', 1, '2019-03-13', '2019-03-15', 'full time', 'open', 1, 'master', 'test', 1, '2019-03-28 06:57:27', '0000-00-00 00:00:00'),
(3, 'test1', 'test', '33', 23, '23', '232', '232', 1, '2019-03-23', '2019-03-25', 'part time', 'open', 0, '0', '<h2 style=\"margin-bottom: 10px; padding: 0px; line-height: 24px; font-family: DauphinPlain; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif;\"><b style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '2019-03-17 16:23:09', '2019-03-14 01:32:57'),
(4, 'test', 'peshawar', '33', 4, '23', '333', '232', 1, '2019-03-27', '2019-03-30', 'full time', 'open', 0, 'master', 'tst', 1, '2019-03-27 05:11:13', '2019-03-27 01:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_applications`
--

CREATE TABLE `hr_job_applications` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone_no` varchar(150) NOT NULL,
  `apply_date` date NOT NULL,
  `application_status` varchar(100) NOT NULL,
  `domicile_id` int(11) NOT NULL,
  `education` varchar(100) NOT NULL DEFAULT '0',
  `experience_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_job_applications`
--

INSERT INTO `hr_job_applications` (`id`, `job_id`, `name`, `email`, `phone_no`, `apply_date`, `application_status`, `domicile_id`, `education`, `experience_id`, `file`, `message`, `status`, `created`, `modified`) VALUES
(1, 0, 'Haq Nawaz', 'haqnawazwgbm@gmail.com', '23423423', '2019-03-17', 'new', 0, '0', 0, 'c0b14e985d201b7921fed6a2fa04cd86.pdf', 'tet', 1, '2019-03-17 12:08:31', '2019-03-17 12:08:31'),
(2, 1, 'Haq Nawaz', 'haqnawazwgbm@gmail.com', '23423423', '2019-03-17', 'new', 0, '0', 0, 'cfa4cef9528eab377e5792d05b60929d.pdf', 'test', 1, '2019-03-28 09:32:29', '2019-03-17 12:12:44'),
(3, 3, 'test', 'amazon@gmail.com', '23423423', '2019-03-18', 'new', 0, '0', 0, '', 'test', 1, '2019-03-18 09:54:38', '2019-03-18 09:54:38'),
(4, 1, 'test', 'admin@gmail.com', '23423423', '2019-03-18', 'rejected', 0, '0', 0, '', 'test', 1, '2019-03-18 14:56:11', '2019-03-18 10:00:41'),
(6, 0, 'Haq Nawaz', 'haqnawazwgbm@gmail.com', '23423423', '2019-03-27', 'new', 2, 'bachelor', 4, '8487bb89bd7636edd80cc9c3c825480c.jpg', 'test', 1, '2019-03-27 01:35:37', '2019-03-27 01:35:37'),
(7, 1, 'Haq Nawaz', 'haqnawazwgbm@gmail.com', '23423423', '2019-03-27', 'hired', 1, 'master', 6, '80cb0c06a071423c612496daa2a1e57b.jpg', 'test', 1, '2019-03-28 09:49:53', '2019-03-27 01:39:43'),
(8, 1, 'Haq Nawaz', 'haqnawazwgbm@gmail.com', '23423423', '2019-03-27', 'hired', 1, 'master', 6, 'd6ff056e16396cdfe915e9e4be8c263c.jpg', 'test', 1, '2019-03-28 09:48:34', '2019-03-27 01:52:14'),
(9, 1, 'Haq Nawaz', 'haqnawazwgbm@gmail.com', '23423423', '2019-03-27', 'new', 2, 'bachelor', 4, '349f2f82f7d55637ac89ee37221d8f65.jpg', 'TET', 1, '2019-03-27 02:08:34', '2019-03-27 02:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_interviews`
--

CREATE TABLE `hr_job_interviews` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `place` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_job_interviews`
--

INSERT INTO `hr_job_interviews` (`id`, `job_id`, `date`, `place`, `time`, `description`, `user_id`, `created`, `modified`) VALUES
(2, 3, '2019-03-05', 'test', '19:43:36', 'test', 1, '2019-03-18 10:46:01', '2019-03-18 10:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_interview_candidates`
--

CREATE TABLE `hr_job_interview_candidates` (
  `id` int(11) NOT NULL,
  `interview_id` int(11) NOT NULL,
  `job_application_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_job_interview_candidates`
--

INSERT INTO `hr_job_interview_candidates` (`id`, `interview_id`, `job_application_id`, `created`, `modified`) VALUES
(1, 1, 2, '2019-03-18 04:46:02', '0000-00-00 00:00:00'),
(2, 2, 3, '2019-03-18 10:46:01', '2019-03-18 10:46:01'),
(3, 2, 5, '2019-03-18 10:46:02', '2019-03-18 10:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `hr_job_interview_interviewers`
--

CREATE TABLE `hr_job_interview_interviewers` (
  `id` int(11) NOT NULL,
  `interview_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_job_interview_interviewers`
--

INSERT INTO `hr_job_interview_interviewers` (`id`, `interview_id`, `user_id`, `created`, `modified`) VALUES
(1, 1, 1, '2019-03-18 04:46:34', '0000-00-00 00:00:00'),
(2, 2, 1, '2019-03-18 10:46:02', '2019-03-18 10:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `hr_leaves`
--

CREATE TABLE `hr_leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `casual_leave` int(5) NOT NULL,
  `medical_leave` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_leaves`
--

INSERT INTO `hr_leaves` (`id`, `user_id`, `casual_leave`, `medical_leave`, `status`, `created`, `modified`) VALUES
(2, 1, 3, 3, 1, '2019-02-06 10:11:11', '2019-01-24 06:14:35'),
(17, 35, 0, 0, 1, '2019-03-08 12:16:47', '2019-03-08 12:16:47'),
(18, 2, 0, 0, 1, '2019-03-26 10:42:32', '2019-03-26 10:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `hr_password_resets`
--

CREATE TABLE `hr_password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_payrolls`
--

CREATE TABLE `hr_payrolls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `house_rent_allowance` int(11) NOT NULL,
  `food_allowance` int(11) NOT NULL,
  `medical_allowance` int(11) NOT NULL,
  `provident_fund` int(11) NOT NULL,
  `tax_deduction` int(11) NOT NULL,
  `travelling_allowance` int(11) NOT NULL,
  `dearness_allowance` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_policies`
--

CREATE TABLE `hr_policies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_policy_pictures`
--

CREATE TABLE `hr_policy_pictures` (
  `id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_request_pictures`
--

CREATE TABLE `hr_request_pictures` (
  `id` int(11) NOT NULL,
  `user_request_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_request_types`
--

CREATE TABLE `hr_request_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_request_types`
--

INSERT INTO `hr_request_types` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Leave', 1, '2019-01-23 04:26:22', '0000-00-00 00:00:00'),
(2, 'Ummrah/Haj/Exam', 1, '2019-01-23 04:26:22', '0000-00-00 00:00:00'),
(3, 'Experience Letter', 1, '2019-01-23 10:46:39', '0000-00-00 00:00:00'),
(4, 'Tax Certificate', 1, '2019-01-23 10:46:39', '0000-00-00 00:00:00'),
(5, 'Job Requisition', 1, '2019-01-23 10:47:01', '0000-00-00 00:00:00'),
(6, 'Expence Claim', 1, '2019-01-23 10:47:01', '0000-00-00 00:00:00'),
(7, 'Travel Arrangements', 1, '2019-01-23 10:47:35', '0000-00-00 00:00:00'),
(8, 'Lunch/Hi Tea Meetings', 1, '2019-01-23 10:47:35', '0000-00-00 00:00:00'),
(9, 'Advance Claim', 1, '2019-01-23 10:47:50', '0000-00-00 00:00:00'),
(10, 'Employee Referals', 1, '2019-01-23 10:47:50', '0000-00-00 00:00:00'),
(11, 'Business Cards', 1, '2019-01-23 10:48:09', '0000-00-00 00:00:00'),
(12, 'Official Number Issue', 1, '2019-01-23 10:48:09', '0000-00-00 00:00:00'),
(13, 'Employee Handset', 1, '2019-01-23 10:48:46', '0000-00-00 00:00:00'),
(14, 'Checkin Update Request', 1, '2019-01-23 10:48:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_roles`
--

CREATE TABLE `hr_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_roles`
--

INSERT INTO `hr_roles` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Admin', 1, '2019-01-18 05:50:50', '0000-00-00 00:00:00'),
(2, 'Manager', 1, '2019-01-18 05:50:50', '0000-00-00 00:00:00'),
(3, 'HR', 1, '2019-01-18 05:51:23', '0000-00-00 00:00:00'),
(4, 'Employee', 1, '2019-01-18 07:04:30', '0000-00-00 00:00:00'),
(5, 'HOD', 1, '2019-01-23 10:41:37', '0000-00-00 00:00:00'),
(6, 'GF Manager', 1, '2019-01-23 10:41:49', '0000-00-00 00:00:00'),
(7, 'Finance', 1, '2019-01-23 10:41:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_salaries`
--

CREATE TABLE `hr_salaries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `house_rent_allowance` int(11) NOT NULL,
  `food_allowance` int(11) NOT NULL,
  `medical_allowance` int(11) NOT NULL,
  `provident_fund` int(11) NOT NULL,
  `tax_deduction` int(11) NOT NULL,
  `travelling_allowance` int(11) NOT NULL,
  `dearness_allowance` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_salaries`
--

INSERT INTO `hr_salaries` (`id`, `user_id`, `basic_salary`, `house_rent_allowance`, `food_allowance`, `medical_allowance`, `provident_fund`, `tax_deduction`, `travelling_allowance`, `dearness_allowance`, `status`, `created`, `modified`) VALUES
(16, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-03-08 12:21:47', '2019-03-07 19:00:00'),
(17, 35, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-03-08 12:16:47', '2019-03-08 12:16:47'),
(18, 2, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-03-26 10:42:32', '2019-03-26 10:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `hr_users`
--

CREATE TABLE `hr_users` (
  `id` int(11) NOT NULL,
  `code` varchar(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `bank_account_no` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'user.jpg',
  `address` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `cnic` varchar(50) NOT NULL,
  `martial_status` varchar(50) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `joining_date` date NOT NULL,
  `ice_no` varchar(100) DEFAULT NULL,
  `ntn_no` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `in_probation` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_users`
--

INSERT INTO `hr_users` (`id`, `code`, `name`, `father_name`, `email`, `password`, `gender`, `dob`, `bank_account_no`, `photo`, `address`, `mobile_no`, `city`, `cnic`, `martial_status`, `department_id`, `designation_id`, `joining_date`, `ice_no`, `ntn_no`, `role_id`, `in_probation`, `status`, `created`, `modified`) VALUES
(1, '830022', 'Haq Nawaz', 'khan', 'admin@gmail.com', '6516a1353440f682e6ea552d23608065', 'male', '2020-12-02', '', 'cdb1ee73e8b1fd7218e8bc0a2131942c.png', 'address', '34234234', 'Peshawar, Khyber Pakhtunkhwa', '', 'single', 2, 1, '2019-02-06', '', '', 1, 0, 1, '2019-03-21 06:37:30', '0000-00-00 00:00:00'),
(2, '332', 'Haq Nawaz', 'father name', 'haqnawazwgbm@gmail.com', '630f3d41d9b7f7e7dc849e73980b730e', 'male', '2019-03-26', '', 'user.jpg', '', '234234', 'Peshawar, Khyber Pakhtunkhwa', '', 'married', 1, 1, '2019-03-27', '', '', 2, 1, 1, '2019-03-26 15:58:09', '2019-03-26 10:42:32'),
(10, NULL, 'test', 'test', 'haqnawazwgbm@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', '0000-00-00', '', 'user.jpg', '', '', '', '', '1', 1, 3, '0000-00-00', NULL, NULL, 4, 0, 1, '2019-03-28 09:52:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_user_pictures`
--

CREATE TABLE `hr_user_pictures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_user_pictures`
--

INSERT INTO `hr_user_pictures` (`id`, `user_id`, `photo`, `created`, `modified`) VALUES
(12, 1, 'c06ae6d8f96985c34e585270bc332d13.png', '2019-02-20 12:42:00', '2019-02-20 12:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_user_requests`
--

CREATE TABLE `hr_user_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_type_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `approved_by_manager` tinyint(1) NOT NULL,
  `approved_by_gf_manager` tinyint(1) NOT NULL,
  `approved_by_hod` tinyint(1) NOT NULL,
  `approved_by_hr` tinyint(1) NOT NULL,
  `approved_by_admin` tinyint(1) NOT NULL,
  `approved_by_finance` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `approved` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_cities`
--
ALTER TABLE `hr_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_code_conducts`
--
ALTER TABLE `hr_code_conducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_code_conduct_pictures`
--
ALTER TABLE `hr_code_conduct_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_conduct_id` (`code_conduct_id`);

--
-- Indexes for table `hr_departments`
--
ALTER TABLE `hr_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_dependants`
--
ALTER TABLE `hr_dependants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hr_designations`
--
ALTER TABLE `hr_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_domicile`
--
ALTER TABLE `hr_domicile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_educations`
--
ALTER TABLE `hr_educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_experience`
--
ALTER TABLE `hr_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_jobs`
--
ALTER TABLE `hr_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_job_applications`
--
ALTER TABLE `hr_job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_job_interviews`
--
ALTER TABLE `hr_job_interviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_job_interview_candidates`
--
ALTER TABLE `hr_job_interview_candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_job_interview_interviewers`
--
ALTER TABLE `hr_job_interview_interviewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_leaves`
--
ALTER TABLE `hr_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hr_payrolls`
--
ALTER TABLE `hr_payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hr_policies`
--
ALTER TABLE `hr_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_policy_pictures`
--
ALTER TABLE `hr_policy_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_id` (`policy_id`);

--
-- Indexes for table `hr_request_pictures`
--
ALTER TABLE `hr_request_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_request_id` (`user_request_id`);

--
-- Indexes for table `hr_request_types`
--
ALTER TABLE `hr_request_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_roles`
--
ALTER TABLE `hr_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_salaries`
--
ALTER TABLE `hr_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hr_users`
--
ALTER TABLE `hr_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`,`designation_id`,`role_id`),
  ADD KEY `designation_id` (`designation_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `hr_user_pictures`
--
ALTER TABLE `hr_user_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hr_user_requests`
--
ALTER TABLE `hr_user_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr_cities`
--
ALTER TABLE `hr_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hr_code_conducts`
--
ALTER TABLE `hr_code_conducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_code_conduct_pictures`
--
ALTER TABLE `hr_code_conduct_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_departments`
--
ALTER TABLE `hr_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_dependants`
--
ALTER TABLE `hr_dependants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `hr_designations`
--
ALTER TABLE `hr_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_domicile`
--
ALTER TABLE `hr_domicile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hr_educations`
--
ALTER TABLE `hr_educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `hr_experience`
--
ALTER TABLE `hr_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hr_jobs`
--
ALTER TABLE `hr_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hr_job_applications`
--
ALTER TABLE `hr_job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hr_job_interviews`
--
ALTER TABLE `hr_job_interviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_job_interview_candidates`
--
ALTER TABLE `hr_job_interview_candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_job_interview_interviewers`
--
ALTER TABLE `hr_job_interview_interviewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr_leaves`
--
ALTER TABLE `hr_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hr_payrolls`
--
ALTER TABLE `hr_payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_policies`
--
ALTER TABLE `hr_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_policy_pictures`
--
ALTER TABLE `hr_policy_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_request_pictures`
--
ALTER TABLE `hr_request_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hr_request_types`
--
ALTER TABLE `hr_request_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hr_roles`
--
ALTER TABLE `hr_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hr_salaries`
--
ALTER TABLE `hr_salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hr_users`
--
ALTER TABLE `hr_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hr_user_pictures`
--
ALTER TABLE `hr_user_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hr_user_requests`
--
ALTER TABLE `hr_user_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hr_users`
--
ALTER TABLE `hr_users`
  ADD CONSTRAINT `hr_users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `hr_departments` (`id`),
  ADD CONSTRAINT `hr_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `hr_roles` (`id`),
  ADD CONSTRAINT `hr_users_ibfk_3` FOREIGN KEY (`designation_id`) REFERENCES `hr_designations` (`id`);

--
-- Constraints for table `hr_user_requests`
--
ALTER TABLE `hr_user_requests`
  ADD CONSTRAINT `hr_user_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `hr_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
