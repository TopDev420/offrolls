-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2021 at 08:37 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_offrollsdev21`
--
CREATE DATABASE IF NOT EXISTS `admin_offrollsdev21` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `admin_offrollsdev21`;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_name` varchar(200) NOT NULL,
  `slug` text NOT NULL,
  `blog_desc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `blog_image` text NOT NULL,
  `tags` text NOT NULL,
  `creater` varchar(200) NOT NULL,
  `creater_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `blog_status` int(11) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_name`, `slug`, `blog_desc`, `category_id`, `blog_image`, `tags`, `creater`, `creater_id`, `role_id`, `likes`, `comments`, `blog_status`, `created_datetime`, `update_datetime`) VALUES
(20, 'Embracing the Global Staffing Strategy – What Is flexi-staffing?', '', '  <p>Flexi-staffing is a powerful tool for any organization’s arsenal, but not many understand the different types of flexi-staffing and how to choose the right model. This is the perfect place to get started.\r\n</p><p>In this article:\r\n</p><p>What flexi-staffing is.\r\n</p><p>Why companies leverage flexi-staffing.\r\n</p><p>Pros &amp; cons of flexi-staffing.\r\n</p><p>Types of flexi-staffing.\r\n</p><p>Types of flexi-staffing services.\r\n</p><p>How to choose the right flexi-staffing model.\r\n</p><p>Considerations and misunderstandings about flexi-staffing.\r\n</p><p>One of the most significant trends in today’s business is the dramatic increase in the use of contingent workers across organizations globally. The practice isn’t necessarily modern—it began essentially when administrators were borrowed across organizational borders to fill roles temporarily due to vacation, illnesses, and the like. Today, contingent work manifests itself in many working models, the most common being flexi-staffing.\r\n</p><p>flexi-staffing is the use of outside personnel on a temporary basis to augment the capacity of your organization.\r\n</p><p>There is a wide range of scenarios in which companies leverage flexi-staffing, including:\r\n</p><p>There is a wide range of scenarios in which companies leverage flexi-staffing.\r\n</p><p>flexi-staffing is incredibly common—the global staffing industry, one of the primary suppliers of flexi-staffing talent, is estimated to support $490 billion in annual spend. Another source of flexi-staffing talent is freelancing, which has been around for centuries but recently gained notoriety through the rise of global freelance platforms. It is estimated that in the US 34% percent of workers engage in freelancing today, and that number is expected to grow steadily over the next decade.\r\n</p><p>There are also many different options when it comes to engaging flexi-staffing talent. Selecting the right one depends on the specific needs of your organization.\r\n</p><p>Types of flexi-staffing services\r\n</p><p>Choosing the Right flexi-staffing Model\r\n</p><p>Most organizations use a mix of providers, depending on their needs. When you are considering flexi-staffing, the most important thing is to determine what you are trying to accomplish and what is most important. For example, if you are looking for an expert in machine learning (a highly in-demand skill today), prioritizing cost will be unrealistic. Likewise, if you need 100 people to do a task that can be easily trained, you won’t want to hire based on a high level of skill. With a broad range of flexi-staffing models available to organizations, it’s critical to weigh the pros and cons of each arrangement before selecting.</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', 0, '20.jpg', 'Flexi-Staffing, Freelance, Hiring', ' ', 130, 0, 0, 0, 0, '2021-06-11 16:38:23', '2021-06-11 16:48:24'),
(21, 'Embracing the Global Staffing Strategy – What Is flexi-staffing?', 'Embracing-the-Global-Staffing-Strategy-What-Is-flexi-staffing', '  <p><b>Is flexi-staffing the right model for your business?</b><br><br><br><img style=\"width: 532.433px;\" src=\"https://offrolls.in/application/assets/images/blog/editor/editor_img1624280617.png\"><br><br>Flexi-staffing is a powerful model that organizations can leverage to increase agility and respond to the changing needs of the enterprise. It’s being used increasingly across industry borders. flexi-staffing solutions are being used increasingly for roles ranging from R&D to Operations, HR, Finance, and more. When considered in light of moves from industry giants like Google—which acquired a freelance/contract network of data scientists called Kaggle in 2017—the importance of flexi-staff for enterprises, now and in the future, cannot be overstated.<br><br><b> Decision-Making Factor #1: Project Length</b><br><img style=\"width: 532.433px;\" src=\"https://offrolls.in/application/assets/images/blog/editor/editor_img1624280742.jpg\"><br><br><br><br>A flexi-staffing arrangement can help to meet the demands of an organization in unique ways. Still, it’s not a perfect solution in every scenario. flexi-staffing is typically best utilized in shorter-term projects, as opposed to long-term projects, which require months or years to complete. It could still make sense for an enterprise to engage a contingent worker on longer projects, in which case an outsourcing arrangement would be a better option than a flexi-staffing model. Often, flexi-staffing providers are willing to negotiate such agreements.<br><br><br><b>Decision-Making Factor #2: Secrecy</b><br><img style=\"width: 512px;\" src=\"https://offrolls.in/application/assets/images/blog/editor/editor_img1624280796.png\"><br><br>Some projects are of a clandestine nature and involve critical intellectual property (IP). flexi-staffing solutions should be carefully evaluated in these instances. However, the rationale for that decision is more often attributable to psychological comfort than hard evidence. Objectively, an agreement signed with a contractor is as bulletproof as one signed with a full-time employee. It’s worth noting that one of the most famous data leaks in history was helmed by a subcontractor who was previously employed by a tier 1 services firm and is currently living under asylum in Russia. The upshot: organizations should proceed slowly and with caution when hiring augmented staff for top-secret projects.<br><br><b><br>Decision-Making Factor #3: Ramp-up Time</b><br><img style=\"width: 532.433px;\" src=\"https://offrolls.in/application/assets/images/blog/editor/editor_img1624280831.png\"><br><br>When it comes to managing a contingent workforce, most companies report unsatisfactory processes. One reason for this could be attributed to Myths about context.<br><br>Most companies’ contingent workforce management strategies leave much to be desired.<br> <br>Context—a deeper cross-functional understanding—is beneficial in an enterprise setting. But the interplay of ramp-up time (by which an employee gains context) should not be ignored in the equation. A flexi-staffing model may not be the best practice for projects which require heavy levels of complexity, therefore implying a lengthy ramp-up time (although this factor sometimes depends on the competency of the potential flexi-staff hire in question).<br><br>For example, one major manufacturing company was losing months in flexi-staff costs because such a hefty level of complexity was needed for the job. This netted them a loss of almost 50% in costs; half of the flexi staff’s contract time was spent ramping up because of context.<br><br><br>Let’s understand a few myths now.<br><br><br><b>Myth #1: flexi-staffing as Cost Avoidance</b><br><br>Some hiring managers believe they can circumvent the cost of paying benefits for a full-time employee by hiring augmented staff instead. This is misguided and would be a good reason not to hire augmented staff. In the end, the staffing provider is paying benefit costs, which in turn get factored into the rate quoted to an organization. This Myth can actually lead to paying more out of pocket for augmented staff when full-time employment would have been a more suitable solution.<br><br><b>Myth #2: flexi-staffing Is More Expensive</b><br><img style=\"width: 532.433px;\" src=\"https://offrolls.in/application/assets/images/blog/editor/editor_img1624280874.png\"><br><br><br>This second Myth is a simple one that still trips up many employers. It starts with a misperception that augmented staff actually cost more than their equivalent full-time employees. “A INR 150 per hour contingent worker outweighs the cost of a full-time employee,” they reason.<br><br>The mistake here regards employer burden. Keeping a full-time employee with an annual salary of INR 100,000, for example, costs employers worldwide an average of 23%. In some countries, that percentage creeps into the 30–50% range. This includes costs for benefits like matching, health insurance, welfare, and ongoing training. Keeping these costs in mind, the financial benefit of contracting with augmented staff is quite reasonable and cost-effective.<br><b><br>Myth #3: flexi-staffing vs Managed Services</b><br><br>Much of the terminology used in the staffing industry is relatively new and tends to become muddled. This leads to one all-too-common Myth between flexi-staffing and another related approach: managed services.<br><br>A managed service approach concerns a definitive deliverable, possibly with a definitive quality rating; flexi-staffing concerns a job description and is paid for on a time and material basis. An augmented staff member might be brought into an organization to write lines of code for a specific application unusual for that company and would be paid per hour. A managed service contractor would be hired to create that specific application and meet a set of KPIs; they would be paid upon completion of the project.<br><br><br><br></p>', 0, '21.jpg', 'Flexi-Staffing, Freelance,Projects', ' ', 130, 0, 0, 0, 1, '2021-06-21 16:46:46', '2021-06-28 13:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE `blog_comments` (
  `cmt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `cmt_status` int(11) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_datetime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`cmt_id`, `user_id`, `comment`, `blog_id`, `parent_id`, `cmt_status`, `created_datetime`, `updated_datetime`) VALUES
(16, 152, 'Hey good Blog', 20, 0, 1, '2021-06-12 17:45:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

DROP TABLE IF EXISTS `candidate`;
CREATE TABLE `candidate` (
  `candidate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume` text,
  `dob` date DEFAULT NULL,
  `father_name` varchar(500) DEFAULT NULL,
  `mother_name` varchar(500) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `about` varchar(1000) DEFAULT NULL,
  `company_category` int(11) NOT NULL DEFAULT '0',
  `job_category` int(11) DEFAULT '0',
  `job_type` int(11) NOT NULL DEFAULT '0',
  `salary_range_from` int(11) NOT NULL DEFAULT '0',
  `salary_range_to` int(11) DEFAULT '0',
  `salary_period` int(11) NOT NULL DEFAULT '0',
  `job_location` varchar(120) DEFAULT NULL,
  `experience` int(11) DEFAULT '0',
  `relocate` tinyint(1) NOT NULL DEFAULT '0',
  `technologies` text,
  `skills` text,
  `keywords` text,
  `special_qualification` varchar(10000) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `state` varchar(120) DEFAULT NULL,
  `pin_code` varchar(6) DEFAULT NULL,
  `country` varchar(120) DEFAULT NULL,
  `isProfileCompleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `can_date_added` datetime NOT NULL,
  `can_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_certification`
--

DROP TABLE IF EXISTS `candidate_certification`;
CREATE TABLE `candidate_certification` (
  `certification_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL DEFAULT '0',
  `cc_name` varchar(500) NOT NULL,
  `cc_description` varchar(5000) NOT NULL,
  `cc_completion_year` year(4) NOT NULL,
  `cc_date_added` datetime NOT NULL,
  `cc_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_education`
--

DROP TABLE IF EXISTS `candidate_education`;
CREATE TABLE `candidate_education` (
  `candidate_education_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `ce_institute` varchar(500) NOT NULL,
  `ce_location` varchar(120) NOT NULL,
  `ce_qualification` int(11) NOT NULL,
  `ce_specialization` varchar(500) NOT NULL,
  `ce_course_type` varchar(120) DEFAULT NULL,
  `ce_yop` year(4) NOT NULL,
  `ce_description` varchar(10000) DEFAULT NULL,
  `ce_date_added` datetime NOT NULL,
  `ce_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_experience`
--

DROP TABLE IF EXISTS `candidate_experience`;
CREATE TABLE `candidate_experience` (
  `candidate_experience_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `cwe_job_title` varchar(120) NOT NULL,
  `cwe_company_name` varchar(120) NOT NULL,
  `cwe_current_company` tinyint(1) NOT NULL DEFAULT '0',
  `cwe_start_date` varchar(1000) NOT NULL,
  `cwe_end_date` varchar(1000) NOT NULL,
  `cwe_experience` varchar(20) DEFAULT NULL,
  `cwe_date_added` datetime NOT NULL,
  `cwe_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_filter`
--

DROP TABLE IF EXISTS `candidate_filter`;
CREATE TABLE `candidate_filter` (
  `candidate_filter_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `filter_keyword` varchar(120) NOT NULL,
  `filter_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_jobs`
--

DROP TABLE IF EXISTS `candidate_jobs`;
CREATE TABLE `candidate_jobs` (
  `candidate_job_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `cj_isApplied` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isShortListed` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isSaved` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isScheduled` tinyint(4) NOT NULL DEFAULT '0',
  `cj_isPipelined` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isArchived` tinyint(1) NOT NULL DEFAULT '0',
  `cj_schedule_details` text,
  `cj_isCompleted` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isRemoved` tinyint(1) NOT NULL DEFAULT '0',
  `cj_date_added` datetime NOT NULL,
  `cj_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_project`
--

DROP TABLE IF EXISTS `candidate_project`;
CREATE TABLE `candidate_project` (
  `candidate_project_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `cp_name` varchar(500) NOT NULL,
  `cp_company_name` varchar(500) NOT NULL,
  `cp_url` varchar(2084) NOT NULL,
  `cp_description` varchar(5000) NOT NULL,
  `cp_status` tinyint(1) DEFAULT '0',
  `cp_start_date` varchar(1000) NOT NULL,
  `cp_end_date` varchar(1000) NOT NULL,
  `cp_date_added` datetime NOT NULL,
  `cp_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `parent_id`, `industry_id`, `created_datetime`, `updated_datetime`) VALUES
(1, 'Fire & Safety', 0, 1, '2019-12-06 10:32:03', '2019-12-06 10:32:03'),
(2, 'Security', 0, 1, '2019-12-06 10:32:03', '2019-12-06 10:32:03'),
(3, 'Cleaning', 0, 0, '2019-12-06 10:32:33', '2019-12-06 10:32:33'),
(4, 'Electrical', 0, 3, '2019-12-06 10:32:33', '2019-12-06 10:32:33'),
(49, 'DATACOM', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(5, 'Chemicals', 0, 0, '2019-12-06 10:33:08', '2019-12-06 10:33:08'),
(48, 'LIGHT BULBS AND BALLASTS', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(46, '  BRANCHES/NOZZLES', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(45, '  RESCUE EQUIPMENT', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(44, 'CUTTING EQUIPMENT', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(43, '  LADDERS', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(41, 'FIRE SUITS', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(42, 'FIRE TRAINING DUMMIES', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(40, '  FIRE ENGINES', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(39, ' BREATHING APPARATUS', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(38, '  FIRE EXTINGUISHERS', 1, 0, '2019-12-28 17:28:02', '2019-12-28 17:28:02'),
(47, 'GENERATORS', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(50, 'BOXES AND FITTINGS', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(51, 'BREAKERS AND FUSES', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(52, 'WIREWAY', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(53, 'CONDUIT AND ACCESSORIES', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(54, 'WIRE CORDS AND CABLES', 4, 0, '2019-12-28 17:42:44', '2019-12-28 17:42:44'),
(55, 'LIGHT-SENSITIVE CHEMICALS', 7, 0, '2019-12-28 12:13:16', '2019-12-28 12:13:16'),
(56, 'FLUMINITES', 7, 0, '2019-12-28 12:18:17', '2019-12-28 12:18:17'),
(57, 'PESTICIDE', 7, 0, '2019-12-28 12:18:17', '2019-12-28 12:18:17'),
(58, 'HYDROCOTISONE', 7, 0, '2019-12-28 12:18:17', '2019-12-28 12:18:17'),
(59, 'CHLOROFORM', 7, 0, '2019-12-28 12:18:17', '2019-12-28 12:18:17'),
(60, 'SAFETY GLOVES', 3, 0, '2019-12-28 12:21:33', '2019-12-28 12:21:33'),
(61, 'CLEANING FOOTEWEAR', 3, 0, '2019-12-28 12:21:33', '2019-12-28 12:21:33'),
(62, 'FLOOR CARE CHEMICALS', 3, 0, '2019-12-28 12:21:33', '2019-12-28 12:21:33'),
(63, 'DISPOSABLE CLEANING', 3, 0, '2019-12-28 12:21:33', '2019-12-28 12:21:33'),
(64, 'BOX CAMERA', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(65, 'DOME CAMERA', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(66, 'PTZ CAMERA', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(67, 'BULLET CAMERA', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(68, 'ELECTRONIC KEYPADS', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(69, 'BIOMETRIC EQUIPMENT', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(70, 'ELOCKS', 2, 0, '2019-12-28 12:28:21', '2019-12-28 12:28:21'),
(71, 'Clothes', 0, 1, '2020-01-08 11:54:52', '2020-01-08 11:54:52'),
(72, 'Lights & Bulbs', 71, 1, '2020-01-08 11:54:52', '2020-01-08 11:54:52'),
(73, 'Lights', 71, 1, '2020-01-08 11:54:52', '2020-01-08 11:54:52'),
(74, 'Bulbs', 71, 1, '2020-01-08 11:54:52', '2020-01-08 11:54:52'),
(75, 'Ortho', 0, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(76, 'Physiotherapy & Rehabilitation Equipments', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(77, 'Orthopedic Instruments', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(78, 'Hip Prosthesis', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(79, 'Interlocking Nail', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(80, 'Spinal Implants', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(81, 'Non Locking Plates', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(82, 'Locking Plates', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(83, 'Bone Screws', 75, 2, '2020-01-08 12:02:21', '2020-01-08 12:02:21'),
(84, 'Sociology', 0, 3, '2020-01-08 12:05:01', '2020-01-08 12:05:01'),
(85, 'General', 84, 3, '2020-01-08 12:05:01', '2020-01-08 12:05:01'),
(86, 'Clothes', 0, 4, '2020-01-08 12:05:38', '2020-01-08 12:05:38'),
(87, 'Check clothes', 86, 4, '2020-01-08 12:05:38', '2020-01-08 12:05:38'),
(88, 'BMS', 0, 5, '2020-01-08 12:06:00', '2020-01-08 12:06:00'),
(89, 'iron', 88, 5, '2020-01-08 12:06:00', '2020-01-08 12:06:00'),
(90, 'Engines', 0, 6, '2020-01-08 12:06:34', '2020-01-08 12:06:34'),
(91, 'Single', 90, 6, '2020-01-08 12:06:34', '2020-01-08 12:06:34'),
(92, 'Fiber Cables', 0, 7, '2020-01-08 12:06:56', '2020-01-08 12:06:56'),
(93, 'Single coil cable', 92, 7, '2020-01-08 12:06:56', '2020-01-08 12:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_type` varchar(12) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_category` int(11) NOT NULL DEFAULT '0',
  `landline` varchar(11) DEFAULT NULL,
  `about` varchar(10000) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `state` varchar(120) DEFAULT NULL,
  `country` varchar(120) DEFAULT NULL,
  `pin_code` varchar(6) DEFAULT NULL,
  `web_link` varchar(2084) DEFAULT NULL,
  `gst_no` varchar(15) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `isProfileVerified` tinyint(1) NOT NULL DEFAULT '0',
  `isCommissionAgreed` tinyint(1) NOT NULL DEFAULT '0',
  `commission_agreed_datetime` datetime DEFAULT NULL,
  `cmp_date_added` datetime NOT NULL,
  `cmp_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `user_id`, `company_type`, `company_name`, `company_category`, `landline`, `about`, `address`, `city`, `state`, `country`, `pin_code`, `web_link`, `gst_no`, `pan_no`, `isProfileVerified`, `isCommissionAgreed`, `commission_agreed_datetime`, `cmp_date_added`, `cmp_date_modified`) VALUES
(71, 153, NULL, NULL, 0, NULL, NULL, 'Kandivali, Mumbai', 'Mumbai City,Mumbai Suburban', 'Maharashtra', 'India', '400101', NULL, NULL, NULL, 0, 0, NULL, '2021-06-13 18:39:02', '2021-07-05 15:15:15'),
(73, 157, NULL, 'Aeidenz', 0, '9447976218', 'Abcd', 'abcd', 'Thrissur', 'Kerala', 'India', '680510', 'https://timezapp.mentrictech.in/', '', '', 0, 0, NULL, '2021-06-16 10:46:30', '2021-06-16 10:52:10'),
(76, 163, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2021-06-18 12:28:52', NULL),
(77, 166, NULL, 'mentric technology', 1261, '9008527505', 'We help our customers organize their business and adapt to changes, and reach the organizational goals faster than they plan.', 'Dasarahalli', 'bangalore', 'Karnataka', 'India', '560024', 'https://offrolls.in', '', '', 0, 1, '2021-06-22 10:04:02', '2021-06-18 15:26:41', '2021-06-22 10:04:02'),
(78, 171, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2021-06-20 07:33:13', NULL),
(79, 175, NULL, 'Octane Capital', 1251, '9810386102', 'Investment Banking Boutique', 'New Delhi', 'New Delhi', 'Delhi', 'India', '110019', '', '', '', 0, 0, NULL, '2021-06-29 16:12:39', '2021-07-02 20:10:50'),
(80, 176, NULL, NULL, 0, NULL, NULL, '#72/A,Sri Venkateshwara Complex,1st floor, Dasarahalli Main Road Near KaragadammaTemple, H.A.F, Post, Hebbal, Bengaluru, Karnataka 560024', 'Bengaluru', 'Karnataka', 'India', '560024', NULL, NULL, NULL, 0, 0, NULL, '2021-07-02 11:06:32', '2021-07-02 11:54:42'),
(81, 186, NULL, 'Global Best HR & Management Consulting Private Limited', 0, '9840002731', 'OD Consulting and HR Services company', 'No.5, B Block, 5th Floor, New NO. 442 Anna Salai,', 'Chennai', 'Tamil Nadu', 'India', '600006', 'https://www.globalbesthr.com', '33AAGCG0456P1ZE', 'AAGCG0456P', 0, 0, NULL, '2021-07-09 22:58:31', '2021-07-09 23:06:05'),
(82, 187, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2021-07-10 01:41:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_candidate_jobtype`
--

DROP TABLE IF EXISTS `company_candidate_jobtype`;
CREATE TABLE `company_candidate_jobtype` (
  `jobtype_duration_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `cjt_id` int(11) NOT NULL,
  `cjt_period` varchar(5000) NOT NULL,
  `cjt_duration` int(11) NOT NULL,
  `cjt_date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_freelancer_jobs`
--

DROP TABLE IF EXISTS `company_freelancer_jobs`;
CREATE TABLE `company_freelancer_jobs` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_duration` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `job_type` varchar(120) NOT NULL,
  `job_category` int(11) NOT NULL,
  `job_specialization` int(11) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `job_project_files` text NOT NULL,
  `project_type` int(11) NOT NULL,
  `questions` text NOT NULL,
  `attachments` text,
  `skills` text NOT NULL,
  `languages` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `location` varchar(120) DEFAULT NULL,
  `experience` int(11) NOT NULL,
  `experience_level` varchar(50) NOT NULL,
  `project_duration` int(11) NOT NULL,
  `job_time_period` int(11) NOT NULL,
  `pay_type` varchar(20) NOT NULL,
  `pay_amount` decimal(15,2) NOT NULL,
  `status` int(11) NOT NULL,
  `remove` int(11) NOT NULL DEFAULT '0',
  `is_Jobaccepted` tinyint(1) NOT NULL DEFAULT '0',
  `job_freelancer_id` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_freelancer_jobs`
--

INSERT INTO `company_freelancer_jobs` (`job_id`, `company_id`, `job_duration`, `title`, `job_type`, `job_category`, `job_specialization`, `description`, `job_project_files`, `project_type`, `questions`, `attachments`, `skills`, `languages`, `country`, `location`, `experience`, `experience_level`, `project_duration`, `job_time_period`, `pay_type`, `pay_amount`, `status`, `remove`, `is_Jobaccepted`, `job_freelancer_id`, `date_added`, `date_modified`) VALUES
(358, 77, 14, 'graphics designer', 'onetime', 1281, 1312, 'The graphic designer will work with the rest of the creative team to develop advertising materials for our clients. They will use Adobe software to design deliverables such as logos, brochures, print and digital advertisements, magazines, eBooks and more. This individual should have a deep passion for design and always be looking for the latest graphic design trends and techniques.', '', 0, '', NULL, '[\"1151\"]', '[\"1\"]', '', 'Bengaluru', 1362, 'experienced', 0, 23, 'fixed', '10000.00', 1, 0, 0, 0, '2021-06-18 16:53:40', '2021-06-18 16:54:49'),
(359, 77, 15, 'graphics designers', 'ongoing', 1281, 1312, 'The graphic designer will work with the rest of the creative team to develop advertising materials for our clients. They will use Adobe software to design deliverables such as logos, brochures, print and digital advertisements, magazines, eBooks and more. This individual should have a deep passion for design and always be looking for the latest graphic design trends and techniques.', '', 0, '', NULL, '[\"955\"]', '[\"1\"]', '', 'Bengaluru', 0, 'fresher', 0, 22, 'fixed', '10000.00', 1, 0, 0, 0, '2021-06-22 10:09:15', '2021-06-22 10:09:25'),
(360, 77, 12, 'Full Stack Web Development', 'ongoing', 1442, 1444, 'Mentric has proven experience in delivering and implementing advanced technology solutions for all types, sizes, and shapes of companies.', '', 0, '', NULL, '[\"699\"]', '[\"1\"]', '', 'Bengaluru Urban', 0, 'fresher', 0, 22, 'fixed', '3000.00', 0, 1, 0, 0, '2021-06-22 15:09:22', '2021-06-22 15:12:57'),
(361, 73, 14, 'YouTube Marketing for Food Channel', 'ongoing', 2506, 2513, 'I need a person to do Youtube marketing for my food channel.', '', 0, '', NULL, '[\"932\",\"706\"]', '[\"1\",\"5\",\"4\"]', '', 'Thrissur', 1193, 'experienced', 0, 22, 'fixed', '50000.00', 0, 0, 0, 0, '2021-06-22 17:35:11', NULL),
(362, 73, 14, 'YouTube Marketing for Food Channel', 'ongoing', 2506, 1, 'I need a person to do Youtube marketing for my food channel.', '', 0, '', NULL, '', '[\"\"]', '', '', 1193, 'experienced', 0, 22, 'fixed', '50000.00', 0, 0, 0, 0, '2021-06-22 17:35:50', NULL),
(363, 73, 14, 'YouTube Marketing for Food Channel', 'ongoing', 1284, 1339, 'YouTube Marketing for Food Channel', '', 0, '', NULL, '', '[\"\"]', '', '', 1193, 'experienced', 0, 22, 'fixed', '50000.00', 1, 0, 0, 0, '2021-06-22 17:41:47', '2021-06-22 17:41:55'),
(364, 80, 15, 'Senior Web Developer', 'ongoing', 1280, 1309, 'This position is applicable for 4 to 5 years experienced candidates only. Eligible candidates must be having very good knowledge and experience in PHP [codeigniter / laravel], MySQL, HTML,CSS, HTML5, CSS3, Bootstrap Framework (for Responsive Web Design. Optional), AJAX, JavaScript and JQuery.', '', 0, '', NULL, '[\"800\",\"1058\",\"909\",\"1018\"]', '[\"1\"]', '', 'Bengaluru', 1193, 'experienced', 0, 22, 'hourly', '200.00', 1, 0, 0, 0, '2021-07-02 12:20:32', '2021-07-02 12:21:04'),
(365, 80, 15, 'Android Developer', 'ongoing', 1280, 1305, 'Job description\r\nThis position is applicable for 4 to 5 years experienced candidates only.\r\n‬\r\nRoles & Responsibilities:\r\n•	Analyze functional and technical requirements\r\n•	Design, modify, develop, write and implement software programming applications and components.\r\n•	Create compelling mobile device specific user interfaces and experiences\r\n•	Develop and unit test functionality based on design specifications\r\n•	Adhere to coding standards, review design and code to ensure standards compliance, leverages reusable code components\r\n•	Fixing defects arising out of system integration, API Writing, Testing and user acceptance testing\r\n•	Optimizing performance for the mobile apps.\r\n•	Deliver across the entire app life cycle concept, design, build, deploy, test, release to Google Play store & Apple app stores and support.\r\n•	Working along with other developers to create and maintain a robust framework to support the mobile apps.\r\n\r\nTechnical Skills and Abilities:\r\n•	Design and build applications for the Android using Java/Kotlin\r\n•	Proficient with Javascript & Typescript\r\n•	Good working knowledge and understanding of iOS architecture/Android architecture\r\n•	Very good experience with Responsive designs and front-end frameworks (HTML5, CSS AngularJS 6+)\r\n•	Strong Object-Oriented Programming Skills\r\n•	Experience on web service integration (SOAP, REST, JSON, XML) APIs to connect applications to back-end services\r\n•	Understanding of Google & Apples design principles and interface guidelines\r\n•	Proficient understanding of code versioning tools\r\n•	Experience with third-party libraries and APIs\r\n•	Publishing apps to the app store / Play store\r\n•	Good understanding on Progressive Web Apps\r\n\r\nBehavioral skills:\r\n•	Should have Planning and Organization skills\r\n•	Strong written and oral communication skills\r\n•	Efficient time management skills\r\n\r\nKey skills:\r\n•	HTML5, CSS, Javascript, Typescript, AJAX, Angular, React, Ionic Framework, Mean Stack, IOS, Android and Hybrid.\r\n•	Good analytical Skills\r\n•	Strong interpersonal skills\r\n', '', 0, '', NULL, '[\"779\",\"1058\"]', '[\"1\"]', '', 'Bengaluru', 1193, 'experienced', 0, 22, 'hourly', '200.00', 1, 0, 0, 0, '2021-07-02 18:51:09', '2021-07-02 18:51:26'),
(366, 81, 15, 'Digital Marketing', 'ongoing', 2506, 2513, 'Digital Marketing', '', 0, '', NULL, '', '[\"\"]', '', '', 1206, 'experienced', 0, 23, 'fixed', '50000.00', 1, 0, 0, 0, '2021-07-09 23:12:33', '2021-07-09 23:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `company_history`
--

DROP TABLE IF EXISTS `company_history`;
CREATE TABLE `company_history` (
  `company_history_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `value` varchar(2000) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

DROP TABLE IF EXISTS `freelancer`;
CREATE TABLE `freelancer` (
  `freelancer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume` text,
  `dob` date DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `about` varchar(1000) DEFAULT NULL,
  `industry` int(11) NOT NULL DEFAULT '0',
  `specialization` int(1) DEFAULT '0',
  `experience` int(11) NOT NULL,
  `skills` text,
  `languages` text,
  `address` varchar(2000) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `state` varchar(120) DEFAULT NULL,
  `pin_code` varchar(6) DEFAULT NULL,
  `country` varchar(120) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `isPaymentInfoGiven` tinyint(1) NOT NULL DEFAULT '0',
  `payment_Info_Given_Datetime` datetime DEFAULT NULL,
  `fl_date_added` datetime NOT NULL,
  `fl_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`freelancer_id`, `user_id`, `resume`, `dob`, `gender`, `about`, `industry`, `specialization`, `experience`, `skills`, `languages`, `address`, `city`, `state`, `pin_code`, `country`, `is_published`, `isVerified`, `isPaymentInfoGiven`, `payment_Info_Given_Datetime`, `fl_date_added`, `fl_date_modified`) VALUES
(30, 154, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, NULL, 'Kandivali, Mumbai', 'Mumbai City,Mumbai Suburban', 'Maharashtra', '400101', 'India', 1, 0, 0, NULL, '2021-06-13 19:07:43', '2021-06-13 21:09:09'),
(34, 164, NULL, '0000-00-00', NULL, '<p>I am priya Savale. I have 4 years experience on Digital marketing executive.&nbsp;</p>', 0, 0, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2021-06-18 13:17:13', '2021-07-05 14:42:43'),
(35, 165, NULL, '0000-00-00', NULL, '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Open Sans&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Writing a resume summary statement for a web developer position is necessary if you want employers to look at your most relevant skills first. Because the summary statement is the first section employers see, it gives you the chance to frame the rest of your resume in a way that is highly relevant to a specific web development job.</span><br></p>', 0, 0, 0, NULL, '[\"1\",\"2\"]', '321, 9TH CROSS, NTI LAYOUT', 'Bengaluru Urban', 'Karnataka', '560097', 'India', 1, 0, 0, NULL, '2021-06-18 14:52:45', '2021-06-28 11:45:06'),
(36, 167, NULL, '0000-00-00', NULL, '<p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">Highly creative and multitalented&nbsp;</span><b style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">Graphic Designer</b><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">&nbsp;with extensive experience in multimedia, marketing and print&nbsp;</span><b style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">design</b><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">. Exceptional collaborative and interpersonal skills; dynamic team player with well-developed written and verbal communication abilities</span><br></p>', 0, 0, 0, NULL, NULL, 'Dasarahalli', 'bangalore', 'Karnataka', '560024', 'India', 1, 0, 1, '2021-06-22 09:52:07', '2021-06-18 15:49:05', '2021-06-29 12:57:18'),
(39, 172, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, NULL, '9th cross,NTI layout, vidyaranyapura', 'Bengaluru Urban', 'Karnataka', '560097', 'India', 1, 0, 0, NULL, '2021-06-21 09:38:40', '2021-06-30 10:43:49'),
(40, 173, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, NULL, '...', '...', 'Karnataka', '577777', 'India', 0, 0, 0, NULL, '2021-06-21 21:43:17', '2021-06-21 21:45:34'),
(41, 174, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, '[\"1\"]', 'lakjdlasdfah', 'Bengaluru', 'Karnataka', '560097', 'India', 1, 0, 0, NULL, '2021-06-22 17:46:50', '2021-07-10 11:54:29'),
(42, 178, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2021-07-04 14:51:36', NULL),
(43, 180, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2021-07-04 19:48:06', NULL),
(44, 181, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, '[\"1\",\"4\",\"7\",\"10\"]', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2021-07-05 14:49:44', '2021-07-05 14:58:32'),
(45, 182, NULL, '0000-00-00', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2021-07-05 15:13:26', NULL),
(46, 183, NULL, '0000-00-00', NULL, '<p>Software <u>Architect</u> with <b>over</b> 20 years of experience in designing and developing enterprise applications&nbsp;</p>', 0, 0, 0, NULL, NULL, '1124 Spring Orchard Dr', 'Bengaluru', 'Karnataka', '63367', 'India', 0, 0, 0, NULL, '2021-07-06 01:43:15', '2021-07-06 01:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_certification`
--

DROP TABLE IF EXISTS `freelancer_certification`;
CREATE TABLE `freelancer_certification` (
  `freelancer_certification_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL DEFAULT '0',
  `cc_name` varchar(500) NOT NULL,
  `cc_description` varchar(5000) NOT NULL,
  `cc_completion_year` year(4) NOT NULL,
  `cc_date_added` datetime NOT NULL,
  `cc_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_certification`
--

INSERT INTO `freelancer_certification` (`freelancer_certification_id`, `freelancer_id`, `cc_name`, `cc_description`, `cc_completion_year`, `cc_date_added`, `cc_date_modified`) VALUES
(6, 35, 'Web Development', 'I have finished internship in web development', 2021, '2021-06-25 17:53:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_education`
--

DROP TABLE IF EXISTS `freelancer_education`;
CREATE TABLE `freelancer_education` (
  `freelancer_education_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `ce_institute` varchar(500) NOT NULL,
  `ce_location` varchar(120) NOT NULL,
  `ce_qualification` int(11) NOT NULL,
  `ce_specialization` varchar(500) NOT NULL,
  `ce_course_type` varchar(120) DEFAULT NULL,
  `ce_yop` year(4) NOT NULL,
  `ce_description` varchar(10000) DEFAULT NULL,
  `ce_date_added` datetime NOT NULL,
  `ce_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_education`
--

INSERT INTO `freelancer_education` (`freelancer_education_id`, `freelancer_id`, `ce_institute`, `ce_location`, `ce_qualification`, `ce_specialization`, `ce_course_type`, `ce_yop`, `ce_description`, `ce_date_added`, `ce_date_modified`) VALUES
(18, 35, 'SDMIT', 'Ujire', 676, 'Information Science', NULL, 2020, NULL, '2021-06-25 17:51:01', NULL),
(19, 30, 'University of Mumbai', 'Mumbai', 675, 'Marketing', NULL, 2013, NULL, '2021-07-05 15:12:05', NULL),
(20, 46, 'IIT', 'Chennai', 676, 'Mechanical', NULL, 1996, NULL, '2021-07-06 01:59:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_experience`
--

DROP TABLE IF EXISTS `freelancer_experience`;
CREATE TABLE `freelancer_experience` (
  `freelancer_experience_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `cwe_job_title` varchar(120) NOT NULL,
  `cwe_company_name` varchar(120) NOT NULL,
  `cwe_current_company` tinyint(1) NOT NULL DEFAULT '0',
  `cwe_start_date` varchar(1000) NOT NULL,
  `cwe_end_date` varchar(1000) NOT NULL,
  `cwe_date_added` datetime NOT NULL,
  `cwe_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_experience`
--

INSERT INTO `freelancer_experience` (`freelancer_experience_id`, `freelancer_id`, `cwe_job_title`, `cwe_company_name`, `cwe_current_company`, `cwe_start_date`, `cwe_end_date`, `cwe_date_added`, `cwe_date_modified`) VALUES
(14, 35, 'Web Development', 'Mentric Technologies', 1, '{\"year\":\"2021\",\"month\":\"01\"}', '', '2021-06-25 17:51:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_feedback`
--

DROP TABLE IF EXISTS `freelancer_feedback`;
CREATE TABLE `freelancer_feedback` (
  `freelancer_feedback_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `rating_points` float NOT NULL,
  `feedback_content` varchar(10000) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_filter`
--

DROP TABLE IF EXISTS `freelancer_filter`;
CREATE TABLE `freelancer_filter` (
  `freelancer_filter_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `filter_keyword` varchar(120) NOT NULL,
  `filter_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_filter`
--

INSERT INTO `freelancer_filter` (`freelancer_filter_id`, `freelancer_id`, `filter_keyword`, `filter_id`) VALUES
(23, 32, 'filter_skill', 800),
(22, 32, 'filter_skill', 1039),
(21, 32, 'filter_skill', 935),
(20, 31, 'filter_skill', 1161),
(25, 36, 'filter_skill', 1151),
(24, 32, 'filter_skill', 1058),
(26, 36, 'filter_skill', 763),
(37, 44, 'filter_language', 4),
(30, 35, 'filter_skill', 800),
(36, 44, 'filter_language', 1),
(38, 44, 'filter_language', 7),
(39, 44, 'filter_language', 10),
(40, 46, 'filter_skill', 779),
(41, 46, 'filter_skill', 782),
(42, 46, 'filter_skill', 1055),
(43, 41, 'filter_language', 1);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_jobs`
--

DROP TABLE IF EXISTS `freelancer_jobs`;
CREATE TABLE `freelancer_jobs` (
  `freelancer_job_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `cj_isApplied` tinyint(1) NOT NULL DEFAULT '0',
  `cj_amount` decimal(15,2) DEFAULT NULL,
  `cj_proposal` varchar(10000) DEFAULT NULL,
  `cj_isShortlisted` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isAccepted` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isSaved` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isCompleted` tinyint(1) NOT NULL DEFAULT '0',
  `cj_isRemoved` tinyint(1) NOT NULL DEFAULT '0',
  `cj_date_added` datetime NOT NULL,
  `cj_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_jobs`
--

INSERT INTO `freelancer_jobs` (`freelancer_job_id`, `freelancer_id`, `job_id`, `cj_isApplied`, `cj_amount`, `cj_proposal`, `cj_isShortlisted`, `cj_isAccepted`, `cj_isSaved`, `cj_isCompleted`, `cj_isRemoved`, `cj_date_added`, `cj_date_modified`) VALUES
(55, 36, 358, 1, '1000.00', 'im ready to work', 0, 1, 0, 1, 0, '2021-06-22 10:01:49', '2021-06-22 10:18:38'),
(56, 36, 359, 1, '10000.00', 'sdfsfsafasfdasfasf', 0, 0, 0, 0, 0, '2021-06-24 16:31:24', '2021-06-24 16:31:24'),
(57, 46, 365, 1, '150.00', '150/hr', 0, 0, 0, 0, 0, '2021-07-10 00:57:41', '2021-07-10 00:58:13'),
(58, 41, 366, 0, NULL, NULL, 0, 0, 1, 0, 0, '2021-07-10 11:53:24', '2021-07-10 11:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_jobs_message`
--

DROP TABLE IF EXISTS `freelancer_jobs_message`;
CREATE TABLE `freelancer_jobs_message` (
  `freelancer_job_message_id` int(11) NOT NULL,
  `freelancer_job_id` int(11) NOT NULL,
  `cjm_sender` varchar(12) NOT NULL,
  `cjm_receiver` varchar(12) NOT NULL,
  `cjm_type` varchar(12) NOT NULL,
  `cjm_message` varchar(10000) NOT NULL,
  `cjm_isSenderNotify` tinyint(1) NOT NULL DEFAULT '0',
  `cjm_isReceiverNotify` tinyint(1) NOT NULL DEFAULT '0',
  `cjm_date_added` datetime NOT NULL,
  `cjm_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_jobs_message`
--

INSERT INTO `freelancer_jobs_message` (`freelancer_job_message_id`, `freelancer_job_id`, `cjm_sender`, `cjm_receiver`, `cjm_type`, `cjm_message`, `cjm_isSenderNotify`, `cjm_isReceiverNotify`, `cjm_date_added`, `cjm_date_modified`) VALUES
(26, 55, 'FR', 'CMP', 'text', 'hi\r\n', 1, 1, '2021-06-22 10:12:36', '2021-06-22 10:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_milestones`
--

DROP TABLE IF EXISTS `freelancer_milestones`;
CREATE TABLE `freelancer_milestones` (
  `freelancer_job_milestone_id` int(11) NOT NULL,
  `freelancer_job_id` int(11) NOT NULL,
  `cjm_initiator` varchar(12) NOT NULL,
  `cjm_description` varchar(10000) NOT NULL,
  `cjm_amount` decimal(15,2) NOT NULL,
  `cjm_duration` int(11) NOT NULL,
  `cjm_start_date` date DEFAULT NULL,
  `cjm_end_date` date DEFAULT NULL,
  `cjm_requirements` varchar(10000) DEFAULT NULL,
  `cjm_status` int(11) NOT NULL DEFAULT '0',
  `cjm_isAccepted` int(11) NOT NULL DEFAULT '0',
  `cjm_isRejected` int(11) NOT NULL DEFAULT '0',
  `cjm_isApproved` int(11) NOT NULL DEFAULT '0',
  `cjm_isCompleted` int(11) NOT NULL DEFAULT '0',
  `cjm_isPayReleased` int(11) NOT NULL DEFAULT '0',
  `cjm_isClosed` int(11) NOT NULL DEFAULT '0',
  `cjm_date_added` datetime NOT NULL,
  `cjm_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `freelancer_milestones`
--

INSERT INTO `freelancer_milestones` (`freelancer_job_milestone_id`, `freelancer_job_id`, `cjm_initiator`, `cjm_description`, `cjm_amount`, `cjm_duration`, `cjm_start_date`, `cjm_end_date`, `cjm_requirements`, `cjm_status`, `cjm_isAccepted`, `cjm_isRejected`, `cjm_isApproved`, `cjm_isCompleted`, `cjm_isPayReleased`, `cjm_isClosed`, `cjm_date_added`, `cjm_date_modified`) VALUES
(54, 55, 'CMP', '&lt;p&gt;graphical designer&lt;/p&gt;', '9999.00', 45, '2021-06-22', NULL, '', 101, 1, 0, 0, 0, 0, 0, '2021-06-22 10:13:24', '2021-06-22 10:13:52'),
(55, 55, 'FR', '&lt;p&gt;design&lt;/p&gt;', '5000.00', 10, NULL, NULL, '', 101, 0, 1, 0, 0, 0, 0, '2021-06-22 10:14:41', '2021-06-22 10:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_milestones_payment`
--

DROP TABLE IF EXISTS `freelancer_milestones_payment`;
CREATE TABLE `freelancer_milestones_payment` (
  `milestone_payment_id` int(11) NOT NULL,
  `milestone_id` int(11) NOT NULL,
  `payer` varchar(12) NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `service_fee` int(11) DEFAULT NULL,
  `service_fee_type` varchar(20) DEFAULT NULL,
  `service_amount` decimal(15,2) DEFAULT NULL,
  `tax` decimal(15,2) DEFAULT NULL,
  `tax_type` varchar(120) DEFAULT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total` decimal(15,2) DEFAULT NULL,
  `payment_id` varchar(120) DEFAULT NULL,
  `instrument_type` varchar(120) DEFAULT NULL,
  `billing_instrument` varchar(200) DEFAULT NULL,
  `freelancer_transaction_type` varchar(100) DEFAULT NULL,
  `freelancer_transaction_id` varchar(100) DEFAULT NULL,
  `is_payNotify` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(1000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `freelancer_milestones_payment`
--

INSERT INTO `freelancer_milestones_payment` (`milestone_payment_id`, `milestone_id`, `payer`, `amount`, `service_fee`, `service_fee_type`, `service_amount`, `tax`, `tax_type`, `tax_amount`, `total`, `payment_id`, `instrument_type`, `billing_instrument`, `freelancer_transaction_type`, `freelancer_transaction_id`, `is_payNotify`, `message`, `status`, `date_added`, `date_modified`) VALUES
(35, 54, 'CMP', '9999.00', 10, 'percentage', '999.90', NULL, NULL, '0.00', '10998.90', NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '2021-06-22 10:17:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_payment`
--

DROP TABLE IF EXISTS `freelancer_payment`;
CREATE TABLE `freelancer_payment` (
  `freelancer_payment_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `upi_id` varchar(2000) DEFAULT NULL,
  `pan_number` varchar(20) NOT NULL,
  `gst_number` varchar(50) NOT NULL,
  `fp_created_datetime` datetime NOT NULL,
  `fp_updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `freelancer_payment`
--

INSERT INTO `freelancer_payment` (`freelancer_payment_id`, `freelancer_id`, `account_number`, `ifsc_code`, `bank_name`, `branch_name`, `upi_id`, `pan_number`, `gst_number`, `fp_created_datetime`, `fp_updated_datetime`) VALUES
(14, 36, '12345678910', 'kvbn0123456', 'karur vysya bank', 'bangalore', NULL, '', '', '2021-06-22 09:52:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_project`
--

DROP TABLE IF EXISTS `freelancer_project`;
CREATE TABLE `freelancer_project` (
  `freelancer_project_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `cp_name` varchar(500) NOT NULL,
  `cp_company_name` varchar(500) NOT NULL,
  `cp_url` varchar(2084) NOT NULL,
  `cp_description` varchar(5000) NOT NULL,
  `cp_status` tinyint(1) DEFAULT '0',
  `cp_start_date` varchar(1000) NOT NULL,
  `cp_end_date` varchar(1000) NOT NULL,
  `cp_date_added` datetime NOT NULL,
  `cp_date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_project`
--

INSERT INTO `freelancer_project` (`freelancer_project_id`, `freelancer_id`, `cp_name`, `cp_company_name`, `cp_url`, `cp_description`, `cp_status`, `cp_start_date`, `cp_end_date`, `cp_date_added`, `cp_date_modified`) VALUES
(14, 35, 'Offrolls', 'offrolls', 'offrolls.in', 'Freelancing Website', 1, '{\"year\":\"2021\",\"month\":\"01\"}', '{\"year\":\"\",\"month\":\"\"}', '2021-06-25 17:52:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_skills`
--

DROP TABLE IF EXISTS `freelancer_skills`;
CREATE TABLE `freelancer_skills` (
  `freelancer_skill_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `freelancer_skills`
--

INSERT INTO `freelancer_skills` (`freelancer_skill_id`, `freelancer_id`, `skill_id`, `percentage`, `date_added`, `date_modified`) VALUES
(11, 31, 1161, 0, '2021-06-16 15:44:19', NULL),
(12, 32, 935, 4, '2021-06-16 17:21:09', NULL),
(13, 32, 1039, 6, '2021-06-16 17:21:09', NULL),
(14, 32, 800, 6, '2021-06-16 17:21:09', NULL),
(15, 32, 1058, 6, '2021-06-16 17:21:09', NULL),
(16, 36, 1151, 0, '2021-06-18 16:22:06', NULL),
(17, 36, 763, 0, '2021-06-18 16:22:06', NULL),
(19, 35, 800, 5, '2021-07-02 13:01:09', NULL),
(21, 34, 1220, 100, '2021-07-05 14:32:07', NULL),
(22, 34, 932, 100, '2021-07-05 14:32:07', NULL),
(23, 44, 1115, 0, '2021-07-05 14:58:04', NULL),
(24, 44, 1149, 0, '2021-07-05 14:58:04', NULL),
(25, 46, 779, 10, '2021-07-06 02:02:28', NULL),
(26, 46, 782, 10, '2021-07-06 02:02:28', NULL),
(27, 46, 1055, 7, '2021-07-06 02:02:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

DROP TABLE IF EXISTS `industry`;
CREATE TABLE `industry` (
  `id` int(11) NOT NULL,
  `industry_name` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `industry_name`, `added_by`, `created_at`) VALUES
(1, 'Security and Maintainance', '89', '2019-12-24 11:51:53'),
(2, 'Hospital Management', '89', '2019-12-24 11:52:15'),
(3, 'Education and Training', '89', '2019-12-24 11:52:36'),
(4, 'Retail Industry', '89', '2019-12-26 08:56:39'),
(5, 'Civil and Constructions Industry', '89', '2019-12-26 08:59:43'),
(6, 'Automobile and Mechanics Industry', '89', '2019-12-26 09:00:32'),
(7, 'Tele-communication Industry', '89', '2019-12-26 09:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `information_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `code` varchar(800) NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_description` varchar(5000) DEFAULT NULL,
  `meta_keyword` varchar(5000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`information_id`, `title`, `code`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `date_added`, `date_modified`) VALUES
(2, 'About Us', 'about_us', '&lt;p&gt;&lt;span xss=removed&gt;Please Improve this article if you find anything incorrect by clicking on the &quot;Improve Article&quot; button below&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 'title', 'about company', 'about', 1, '0000-00-00 00:00:00', '2020-06-13 18:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `company_category` int(11) NOT NULL,
  `job_category` int(11) NOT NULL,
  `job_type` text NOT NULL,
  `job_vacancy` int(11) DEFAULT NULL,
  `gender` varchar(12) NOT NULL,
  `skills` text NOT NULL,
  `technology` text,
  `experience` int(11) NOT NULL,
  `salary_package_from` int(11) DEFAULT NULL,
  `salary_package_to` int(11) NOT NULL,
  `salary_package_period` int(11) NOT NULL,
  `location` varchar(120) NOT NULL,
  `keyword` text,
  `notice_period` int(11) NOT NULL,
  `certification` text,
  `benefits` varchar(5000) DEFAULT NULL,
  `job_expiry_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

DROP TABLE IF EXISTS `job_category`;
CREATE TABLE `job_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`category_id`, `name`, `sort_order`, `status`, `type_id`, `parent_id`, `date_added`, `date_modified`) VALUES
(26, 'Project Associate ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(27, 'Financial Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(28, 'Site Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(29, 'Mobile Test Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(30, 'SAP CRM Functional Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(31, 'VB Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(32, 'Office Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(33, 'Registrar ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(34, 'Content Development Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(35, 'MIS Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(36, 'Production Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(37, 'Senior Web Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(38, 'Administrative Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(39, 'VP Finance ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(40, 'Auto CAD Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(41, 'HR Executive Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(42, 'Java/J2EE Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(43, 'Director Sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(44, 'Assistant Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(45, 'Hospital Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(46, 'Security Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(47, 'Hotel Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(48, 'Corporate Trainer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(49, 'Web Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(50, 'Quality Control Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(51, 'Embedded Systems Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(52, 'Quality Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(53, 'Quality Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(54, 'Hardware Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(55, 'Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(56, 'General Manager Administration ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(57, 'Executive Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(58, 'Senior Network Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(59, 'Quality Assurance Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(60, 'Production Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(61, 'Business Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(62, 'Oracle DBA ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(63, 'Personal Secretary ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(64, 'Associate Project Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(65, '3D Animator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(66, 'HR Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(67, 'Air Hostess ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(68, 'Visual Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(69, 'CAD Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(70, 'Zonal Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(71, 'Regional Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(72, 'GIS Specialist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(73, 'Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(74, 'SEO Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(75, 'Head Legal ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(76, 'Administration Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(77, 'Hospital Pharmacist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(78, 'Web Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(79, 'AutoCAD Draftsman ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(80, 'NDT Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(81, 'VP Sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(82, 'Search Engine Optimizer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(83, 'Medical Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(84, 'Medical Representative ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(85, 'Senior Graphic Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(86, 'Export Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(87, 'Software Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(88, 'Data Entry Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(89, 'Oracle Functional Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(90, 'Regional Sales Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(91, 'HR Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(92, 'Programming Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(93, 'Director Finance ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(94, 'Cost Accountant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(95, 'HR Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(96, 'Embroidery Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(97, 'Instrumentation Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(98, 'Chief Administrative Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(99, 'General Manager Production ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(100, 'Linux Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(101, 'Fashion Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(102, 'Assistant Manager Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(103, 'J2EE Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(104, 'Editor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(105, 'GIS Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(106, 'Soft Skills Trainer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(107, 'MIS Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(108, 'Planning Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(109, 'Network Security Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(110, 'Desktop Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(111, 'Food Technologist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(112, 'Guest Faculty ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(113, 'Embedded Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(114, 'Law Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(115, 'Assistant Librarian ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(116, 'Piping Stress Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(117, 'SEO Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(118, 'Finance Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(119, 'Tax Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(120, 'Press Reporter ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(121, 'Senior Area Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(122, 'Finance Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(123, 'Assistant Software Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(124, 'SAP Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(125, 'Senior Customer Care Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(126, 'Database Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(127, 'Regional Marketing Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(128, 'Physiotherapist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(129, 'Financial Advisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(130, 'Radio Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(131, 'SAP Basis Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(132, 'Research Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(133, 'Java Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(134, 'Senior Project Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(135, 'Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(136, 'Embedded Software Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(137, 'Senior Area Sales Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(138, 'Travel Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(139, 'Electrical Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(140, 'CNC Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(141, 'Programming Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(142, 'Flash Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(143, 'Finance Director ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(144, 'Senior Finance Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(145, 'Assistant Finance Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(146, 'Embedded Hardware Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(147, 'Channel Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(148, 'Windows System Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(149, 'Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(150, 'Freelance Web Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(151, 'Purchase Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(152, 'Computer Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(153, 'Technical Support Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(154, 'Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(155, 'System Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(156, 'Junior Civil Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(157, 'Civil Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(158, 'Content Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(159, 'Branch Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(160, 'Instructional Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(161, 'Website Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(162, 'Research Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(163, 'Safety Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(164, 'gm sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(165, 'Assistant Manager Accounts & Finance ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(166, 'Purchase Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(167, 'vp engineering ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(168, '2D Animator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(169, 'Aircraft Maintenance Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(170, 'Physics Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(171, 'Project Leader ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(172, 'Deputy Manager Finance ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(173, 'Assistant Network Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(174, 'Area Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(175, 'Technical Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(176, 'Design Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(177, 'DTP Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(178, 'Lab Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(179, 'Senior Manager Human Resources ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(180, 'HR Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(181, 'Deputy Manager Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(182, 'Assistant Brand Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(183, 'Senior Sales Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(184, 'Sales Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(185, 'Assistant Product Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(186, 'Mobile Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(187, 'Peoplesoft Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(188, 'Junior Software Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(189, 'Computer Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(190, 'Electrical Project Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(191, 'Freelance Content Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(192, 'HVAC Design Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(193, 'Online Marketing Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(194, 'Clinical Research Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(195, 'Websphere Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(196, 'Intern ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(197, 'Flash Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(198, 'Senior Business Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(199, 'General Manager Sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(200, 'Relationship Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(201, 'Credit Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(202, 'Flash Animator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(203, 'Chemical Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(204, 'Assistant Manager Finance ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(205, 'Senior Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(206, 'Welding Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(207, 'Testing Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(208, 'Nurse ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(209, 'Hardware Design Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(210, 'Flash Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(211, 'Fire Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(212, 'Perfusionist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(213, 'Junior Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(214, 'Electrical Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(215, '3D Artist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(216, 'Computer Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(217, 'engineering manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(218, 'Software Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(219, 'Assistant Company Secretary ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(220, 'Electrical Design Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(221, 'Typist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(222, 'Accounts Director ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(223, 'Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(224, 'Assistant Director ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(225, 'Civil Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(226, 'Chartered Accountant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(227, 'MIS Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(228, 'Radio Jockey ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(229, 'Web Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(230, 'Sports Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(231, 'Customer Care Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(232, 'Unix Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(233, 'Supply Chain Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(234, 'Dialysis Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(235, 'Finance Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(236, 'Maintenance Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(237, 'General Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(238, 'Senior Networks Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(239, 'Manual Tester ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(240, 'Scientific Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(241, 'Data Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(242, 'Lecturer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(243, 'Information Technology Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(244, 'Chief Security Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(245, 'Senior Sales Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(246, 'Web Developer Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(247, 'General Manager Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(248, 'Technical Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(249, 'Clerk ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(250, 'PL/SQL Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(251, 'Management Faculty ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(252, 'Senior Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(253, 'Retail Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(254, 'General Manager Operations ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(255, 'Branch Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(256, 'CEO ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(257, 'Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(258, '3D Graphic Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(259, 'Desktop Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(260, 'MIS Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(261, 'Store Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(262, 'Mobile Game Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(263, 'Business Development Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(264, 'Quality Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(265, 'Network Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(266, 'Store Incharge ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(267, 'Secretary ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(268, 'Audit Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(269, 'Research Scientist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(270, 'Senior Product Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(271, 'Security Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(272, 'Guest Lecturer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(273, 'Graphic Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(274, 'Senior Web Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(275, 'SAP Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(276, 'Game Tester ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(277, 'Engineer Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(278, 'Merchandiser ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(279, '3D Visualiser ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(280, 'Customer Support Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(281, 'Senior Interior Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(282, 'Visual Merchandiser ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(283, 'MIS Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(284, 'Assistant Accounts Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(285, 'GIS Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(286, 'Senior Software Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(287, 'Stenographer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(288, 'Senior Manager Operations ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(289, 'Branch Incharge ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(290, 'Telecaller ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(291, 'Legal Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(292, 'PHP Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(293, 'GIS Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(294, 'Database Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(295, 'Welfare Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(296, 'Construction Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(297, 'Product Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(298, 'SAP Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(299, 'Oracle Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(300, 'Nursery Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(301, 'Area Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(302, 'Freelance Fashion Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(303, 'Application Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(304, 'Medical Advisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(305, 'Accounts Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(306, 'Medical Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(307, 'English Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(308, 'System Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(309, 'News Reader ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(310, 'SAP Fico Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(311, 'Sound Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(312, 'Yoga Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(313, 'Research Associate ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(314, 'HR Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(315, 'HR Recruiter ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(316, 'Senior Hardware Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(317, 'HTML Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(318, 'Sales Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(319, 'Sales Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(320, 'Electrical Engineer Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(321, 'Software Quality Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(322, 'Zonal Security Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(323, 'site engineering ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(324, 'IT Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(325, 'ABAP Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(326, 'Mechanical Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(327, 'SEO Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(328, 'Industrial Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(329, 'Software Tester ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(330, 'Computer Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(331, 'Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(332, 'Electrical Maintenance Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(333, 'Inspection Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(334, 'Journalist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(335, 'Content Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(336, 'Radiologist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(337, 'Restaurant Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(338, 'Deputy Manager Finance Accounts ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(339, 'Internal Auditor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(340, 'Electronics Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(341, 'Public Relation Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(342, 'Warehouse Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(343, '3D Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(344, 'VP Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(345, 'Counsellor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(346, 'CAD Draftsman ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(347, 'Piping Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(348, 'Software Trainer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(349, 'CRM Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(350, 'Business Development Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(351, 'Export Import Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(352, 'Biomedical Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(353, 'Freelancer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(354, 'Senior Technical Support Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(355, 'Electrical Site Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(356, 'Tester ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(357, 'VP Human Resources ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(358, 'Retail Store Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(359, 'Quality Controller ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(360, 'Weblogic Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(361, 'Sales Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(362, 'Computer Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(363, 'Management Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(364, 'AutoCAD Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(365, 'Placement Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(366, 'Retail Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(367, 'VP Sales & Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(368, 'Business Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(369, 'Library Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(370, 'Translator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(371, 'Senior Project Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(372, 'Windows Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(373, 'Field Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(374, 'EDP Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(375, '3D Modeler ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(376, 'Reporter ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(377, 'Senior Accountant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(378, 'HTML Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(379, 'Senior Project Leader ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(380, 'Field Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(381, 'Accountant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(382, 'Associate Software Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(383, 'VP IT ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(384, 'Chief Accounts Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(385, 'Chief Marketing Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(386, 'Customer Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(387, 'Content Editor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(388, 'SAP Functional Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(389, 'Electrical Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(390, 'Network Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(391, 'Assistant System Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(392, 'Research Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(393, '3D Interior Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(394, 'SEO Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(395, 'Quality Control Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(396, 'Executive Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(397, 'Textile Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(398, 'Security Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(399, 'Senior Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(400, 'PPC Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(401, 'Project Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(402, 'Operations Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(403, 'Physical Education Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(404, 'erp Functional Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(405, 'Junior System Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(406, 'Chief Finance Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(407, 'Financial Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(408, 'Structural Design Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(409, 'Senior Business Development Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(410, 'Project Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(411, 'Medical Transcriptionist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(412, 'Oracle Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(413, 'Trainer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(414, 'Marketing Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(415, 'SEO Team Leader ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(416, 'Collection Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(417, 'Automation Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(418, 'Event Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(419, 'Quality Control Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(420, 'Zonal Business Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(421, 'Chief Medical Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(422, 'Aircraft Maintenance Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(423, 'CNC Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(424, 'Senior Content Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(425, 'Marketing Director ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(426, 'Patent Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(427, 'Credit Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(428, 'Network Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(429, 'Freelance Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(430, 'Data Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(431, 'Process Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(432, 'Assistant Manager Sales & Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(433, 'SEO Expert ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(434, 'Assistant Software Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(435, 'Senior Manager Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(436, 'Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(437, 'Assistant Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(438, 'PL/SQL Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(439, 'CAD Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(440, 'Senior Marketing Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(441, 'VLSI Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(442, 'Office Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(443, 'Photographer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(444, 'Quality Assurance Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(445, 'Construction Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(446, 'Computer Hardware Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(447, 'Deputy Manager Sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(448, 'Project Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(449, 'General Manager Business Development ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(450, 'Market Research Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(451, 'General Manager Engineering ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(452, 'Senior Brand Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(453, 'Assistant Network Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(454, 'J2EE Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(455, 'Sales Accounts Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(456, 'System Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(457, 'Phone Banking Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(458, 'Web Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(459, 'Information Technology Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(460, 'J2ME Mobile Application ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(461, 'Senior PHP Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(462, 'SAP ABAP Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(463, 'Mainframe Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(464, 'Senior Software Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(465, 'Junior Accountant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(466, 'Copywriter ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(467, 'Tour Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(468, '3D Visualizer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(469, 'Accounts Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(470, 'Mobile Application Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(471, '2D Flash Animator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(472, 'Librarian ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(473, 'Software Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(474, 'Cobol Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(475, 'UI Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(476, 'Video Editor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(477, 'Pharmacist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(478, 'Site Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(479, 'Warehouse Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(480, 'General Manager Human Resources ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(481, 'Assistant Front Office Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(482, 'Director Human Resources ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(483, 'Associate Professor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(484, 'Junior Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(485, 'National Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(486, 'Electrician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(487, 'Senior Software Tester ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(488, 'Java Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(489, 'International Marketing Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(490, 'Software Engineer Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(491, 'Application Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(492, 'Senior Branch Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(493, 'Finance Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(494, 'Front Office Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(495, 'Senior Flash Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(496, 'Software Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(497, 'Finance Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(498, 'Research Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(499, 'Network Security Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(500, 'Piping Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(501, 'Link Builder ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(502, 'Dietician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(503, 'Equity Research Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(504, 'Script Writer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(505, 'Surveyor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(506, 'Linux System Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(507, 'Network Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(508, 'Head Sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(509, 'Assistant Manager Business Development ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(510, 'Java Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(511, 'Accounts Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(512, 'Safety Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(513, 'Operation Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(514, 'Music Teacher ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(515, 'Production Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(516, 'Blood Bank Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(517, 'Online Tutor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(518, 'ERP Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(519, 'Dot Net Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(520, 'News Anchor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(521, 'Company Secretary ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(522, 'HVAC Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(523, 'Assistant General Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(524, 'International Marketing Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(525, 'Senior Customer Care Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(526, 'AutoCAD Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(527, 'Oracle Apps Technical Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(528, 'Assistant Project Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(529, 'Director Marketing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(530, 'Accounts Trainee ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(531, 'Quality Assurance Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(532, 'Financial Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(533, 'Senior Sales & Marketing Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(534, 'Architect ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(535, 'Sales & Marketing Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(536, 'Probationary Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(537, 'Senior Database Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(538, 'HR Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(539, 'Front Office Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(540, 'Accounts Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(541, 'Assistant Branch Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(542, 'General Manager Manufacturing ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(543, 'General Manager Information Technology ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(544, 'ERP Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(545, 'CAD Operator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(546, 'Event Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(547, 'Product Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(548, 'Customer Relationship Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(549, 'Office Administrator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(550, 'Quality Assurance Tester ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(551, 'Senior Quality Assurance Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(552, 'Service Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(553, 'Project Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(554, 'Warehouse Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(555, 'Piping Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(556, 'Software Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(557, 'Senior SEO Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(558, 'Head Administration ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(559, 'Technical Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(560, 'Embedded Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(561, 'SAP Project Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(562, 'Legal Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(563, 'Website Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(564, 'Medical Lab Technician ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(565, 'Warehouse Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(566, 'J2ME Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(567, 'Area Business Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(568, 'vp hr ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(569, 'Senior Relationship Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(570, 'Software Test Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(571, 'Hardware Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(572, 'Senior Software Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(573, 'Regional Sales Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(574, 'Assistant Professor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(575, 'Administrative Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(576, 'RF Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(577, 'General Manager Finance & Accounts ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(578, 'Content Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(579, 'Business Development Executive ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(580, 'Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(581, 'Finance Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(582, 'Technical Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(583, 'Dot Net Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(584, 'UI Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(585, 'VP Operations ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(586, 'SEO Specialist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(587, 'Interior Designer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(588, 'Legal Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(589, 'Personal Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(590, 'PHP Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(591, 'Mobile Software Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(592, 'Chief Executive Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(593, 'Sales Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(594, 'TV Anchor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(595, 'System Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(596, 'Marketing Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(597, 'Assistant Sales Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(598, 'Assistant Manager Legal ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(599, 'Erp Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(600, 'Content Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(601, 'Legal Advisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(602, 'Senior Search Engine Optimizer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(603, 'Clinical Research Associate ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(604, 'Site Accountant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(605, 'Area Sales Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(606, 'Product Support Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(607, 'Regional Business Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(608, 'SAP ABAP Consultant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(609, 'General Manager Marketing & Sales ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(610, 'Senior Business Development Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(611, 'Housekeeping Supervisor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(612, 'Coordinator ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(613, 'Assistant Manager Human Resources ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(614, 'Data Analyst ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(615, 'Quantity Surveyor ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(616, 'Structural Engineer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(617, 'Business Head ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(618, 'SAS Programmer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(619, 'Product Development Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(620, 'Safety Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(621, 'Receptionist ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(622, 'Technical Assistant ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(623, 'Chief Financial Officer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(624, 'Assistant Audit Manager ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(625, 'Senior Java Developer ', 0, 1, 11, 0, '2020-03-12 18:30:30', NULL),
(626, 'Airline ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(627, 'Consultant ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(628, 'DBA ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(629, 'Pharma ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(630, 'Analytics ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(631, 'Logistics ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(632, 'Secretary ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(633, 'Engineering ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(634, 'Security ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(635, 'IT ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(636, 'Film ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(637, 'Corporate Planning ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(638, 'HR ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(639, 'Mainframe ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(640, 'Business Intelligence ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(641, 'Telecom ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(642, 'Graphic Designer ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(643, 'Accounting ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(644, 'EDP ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(645, 'Hotel ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(646, 'Bank ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(647, 'Export Import ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(648, 'Client Server ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(649, 'ERP ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(650, 'Merchandiser ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(651, 'Shipping ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(652, 'Testing ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(653, 'Maintenance ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(654, 'Site Engineering ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(655, 'Mobile ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(656, 'System Programming ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(657, 'Marketing ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(658, 'Sales ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(659, 'Application Programming ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(660, 'Ecommerce ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(661, 'Middleware ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(662, 'VLSI ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(663, 'Packaging ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(664, 'Legal ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(665, 'Interior Design ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(666, 'Network administrator ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(667, 'BPO ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(668, 'Content Writing ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(669, 'Telecom Software ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(670, 'Teacher ', 0, 1, 6, 0, '2020-03-12 18:30:30', NULL),
(671, 'B.Com', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(672, 'Any Graduate', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(673, 'Graduation Not Required', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(674, 'Post Graduation Not Required', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(675, 'MBA/ PGDM', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(676, 'B.Tech/ B.E.', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(677, 'Diploma', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(678, 'B.B.A / B.M.S', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(679, 'B.Sc', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(680, 'B.A', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(681, 'BCA', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(682, 'Other Graduate', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(683, 'MBBS', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(684, 'LLB', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(685, 'B.Pharma', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(686, 'Any Postgraduate', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(687, 'M.Tech', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(688, 'CA', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(689, 'MCA', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(690, 'PG Diploma', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(691, 'Other', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(692, 'M.Com', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(693, 'Medical-MS/ MD', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(694, 'M.A', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(695, 'MS/ M.Sc(Science)', 0, 1, 2, 0, '2020-03-12 18:30:30', NULL),
(696, 'Call Center ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(697, 'MCP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(698, 'Dreamweaver ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(699, 'Jquery ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(700, 'GSM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(701, 'AWT ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(702, 'ASP.NET ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(703, 'WAN ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(704, 'VPN ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(705, 'ActiveX ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(706, 'Online Marketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(707, 'Data Analysis ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(708, 'SAP Bl ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(709, 'PowerPlay ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(710, 'JavaFX ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(711, 'TCP/IP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(712, 'Photoshop ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(713, 'FACT ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(714, 'SAP Practice ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(715, 'XHTML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(716, 'GLOSS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(717, 'Humming Bird ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(718, 'TCL/TK ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(719, 'Database Administration ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(720, 'SAP abap ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(721, 'Tally ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(722, 'BASIC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(723, 'CCIE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(724, 'Microsoft Access ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(725, 'XStream ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(726, 'Linux ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(727, 'Novell ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(728, '.NET ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(729, 'FreeBSD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(730, 'Downstream ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(731, 'WebMethods ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(732, 'Vignette ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(733, 'Finacle ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(734, 'SEO ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(735, 'Mac OS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(736, 'RIM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(737, 'Assembly Language ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(738, 'DOS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(739, 'Delphi ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(740, 'Microsoft Excel ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(741, 'SAP PM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(742, 'WAP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(743, 'Maya ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(744, 'Apache Tomcat ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(745, 'Xenix ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(746, 'Kickboxing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(747, 'DSP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(748, 'SAP IS-Utilities ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(749, 'C ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(750, 'Perl ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(751, 'ASIC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(752, 'SAP Security ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(753, 'SAS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(754, 'Tibco ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(755, 'C++ ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(756, 'C# ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(757, 'Flash ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL);
INSERT INTO `job_category` (`category_id`, `name`, `sort_order`, `status`, `type_id`, `parent_id`, `date_added`, `date_modified`) VALUES
(758, 'Routing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(759, 'Load Runner ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(760, 'Finone ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(761, 'Progress 4GL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(762, 'CLDC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(763, 'Manual Testing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(764, 'SAP PS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(765, 'Symbian C++ ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(766, 'J2EE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(767, 'OpenGL ES ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(768, 'OOPS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(769, 'MS SQL Server ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(770, 'JavaScript ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(771, 'Sybase ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(772, 'Visual Foxpro ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(773, 'Software Testing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(774, 'QTP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(775, 'J++ ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(776, 'Calypso ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(777, 'WPF ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(778, 'MS Visio ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(779, 'Java ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(780, 'Automation Testing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(781, 'data warehousing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(782, 'Spring ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(783, 'ForTran ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(784, 'HP UNIX ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(785, 'Yantra ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(786, 'Networking ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(787, 'Expeditor ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(788, 'PASCAL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(789, 'PRO E ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(790, 'Visual C++ ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(791, 'Multimedia ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(792, 'MS Pro', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(793, 'VSAT ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(794, 'MATLAB ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(795, 'Autosys ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(796, 'VxWorks ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(797, 'Jini ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(798, 'Corel Draw ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(799, 'ADO ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(800, 'PHP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(801, 'WML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(802, 'Solaris ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(803, 'MicroStation ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(804, 'JDBC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(805, 'DCOM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(806, 'Java2D ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(807, 'Web Designing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(808, 'WCF ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(809, 'PVCS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(810, 'CRM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(811, 'FTP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(812, 'Installshield ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(813, 'Microprocessors ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(814, 'Silverlight ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(815, 'Remoting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(816, 'BPCS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(817, 'Adobe Illustrator ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(818, 'Vi ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(819, 'Video Editing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(820, 'Unix ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(821, 'Ingres ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(822, 'VLSI ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(823, 'SQL Server ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(824, 'Flexcube ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(825, 'Remedy ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(826, 'CoreJava ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(827, 'Switching ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(828, 'Focus ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(829, 'Embedded C ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(830, 'LINQ ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(831, 'SAP HR ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(832, 'Motif ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(833, 'T SQL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(834, 'Murex ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(835, 'AJAX ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(836, 'J2ME ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(837, 'Sharepoint MOSS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(838, 'ATL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(839, 'JBoss ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(840, 'JMS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(841, 'CDMA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(842, 'VMS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(843, 'Winrunner ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(844, 'Seam ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(845, 'Struts ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(846, 'SunOS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(847, 'SAP MM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(848, 'COBOL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(849, 'VAX/VMS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(850, 'Flex ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(851, 'Distribution ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(852, 'ABAP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(853, 'J2SE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(854, 'Backend ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(855, 'MCSA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(856, 'JPA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(857, 'JBoss Seam ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(858, 'Verilog ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(859, 'FlashLite ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(860, 'SPSS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(861, 'Plc ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(862, 'CATIA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(863, 'IMS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(864, 'Editing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(865, 'Adobe Pagemaker ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(866, 'SAP FICO ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(867, 'Informix ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(868, 'UIQ ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(869, 'Bluetooth ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(870, 'Programming ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(871, 'JSE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(872, 'SyncML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(873, 'SAP BI ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(874, 'XDoclet ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(875, 'Adobe Photoshop ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(876, 'PowerBuilder ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(877, 'ALE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(878, 'Maven ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(879, 'ISDN ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(880, 'Vision Plus ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(881, 'AutoLISP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(882, 'SAP IS-GAS/OIL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(883, 'SAP EP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(884, 'SAP XI ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(885, 'RedHat ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(886, 'SCADA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(887, 'Impromptu ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(888, 'Apache Web Server ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(889, 'MIS Reports ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(890, 'JFace ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(891, 'FPGA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(892, 'JDOM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(893, 'Shell Scripting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(894, 'DCA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(895, 'Savvion ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(896, 'Blackberry ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(897, 'NetWeaver ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(898, 'SAP SEM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(899, 'MS DOS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(900, 'Natural Adabas ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(901, 'Informatica ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(902, 'MFC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(903, 'Clipper ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(904, 'Excel ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(905, 'JSF ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(906, 'PostgreSQL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(907, 'TOAD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(908, 'Auto CAD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(909, 'CSS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(910, 'Derby ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(911, 'RTOS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(912, 'COM/COM+/DCOM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(913, 'Symbian ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(914, 'CORBA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(915, 'ColdFusion ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(916, 'Ansys ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(917, 'Quality Assurance/QA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(918, 'AIX ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(919, 'Designing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(920, 'Nortel ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(921, 'Winform ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(922, 'KSH ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(923, 'Crystal Report ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(924, 'Oracle Apps ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(925, 'Microsoft Exchange ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(926, 'Affiliate Marketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(927, 'SAP BW ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(928, 'Tuxedo ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(929, 'Documentum ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(930, 'ASP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(931, 'SAP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(932, 'Digital Marketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(933, 'DNS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(934, 'JSP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(935, 'Android Development ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(936, 'Log4', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(937, 'Maximo ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(938, 'QBasic ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(939, 'AbInitio ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(940, 'Cognos ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(941, 'SAP IS-Retail ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(942, 'VOIP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(943, 'MOSS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(944, 'JavaSE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(945, 'SAP CRM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(946, 'AS 400 ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(947, 'SAP WMS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(948, 'JUnit ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(949, 'Back office ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(950, 'XML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(951, 'Microcontrollers ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(952, 'Pro*C ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(953, 'DB2 ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(954, 'ImageReady ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(955, 'UniGraphics ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(956, 'BAAN ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(957, 'SWT ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(958, 'Ant ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(959, 'Apache Commons ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(960, 'Datawarehousing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(961, 'JNI ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(962, 'PeopleSoft ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(963, 'JavaCard ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(964, 'MSCIT ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(965, 'SMTP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(966, 'Lotus Notes ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(967, 'FileNet ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(968, 'Csharp ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(969, 'MIDP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(970, 'SAP QM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(971, 'MCSE ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(972, 'Operating Systems ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(973, 'Data Structures ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(974, 'JCL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(975, 'RDO ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(976, 'RMI ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(977, 'Chordiant ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(978, 'SAP MDM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(979, '3D Max ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(980, 'FoxPro ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(981, 'Oracle WareHouse Builder ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(982, 'ITIL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(983, 'PL/1 ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(984, 'TELNET ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(985, 'JMock ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(986, 'SMARTY ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(987, 'Sharepoint Server ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(988, 'TLM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(989, 'Upstream ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(990, 'Ideas ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(991, 'PPC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(992, 'Database ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(993, 'Visual Interdev ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(994, 'SMO ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(995, 'Mainframe ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(996, 'ArchiCAD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(997, 'Ethernet ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(998, 'DHTML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(999, 'DTP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1000, 'iBatis ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1001, 'DHCP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1002, 'VB.NET ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1003, 'STAAD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1004, 'RichFaces ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1005, 'Firewall ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1006, 'Eclipse ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1007, 'TPF ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1008, 'Documentation ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1009, 'Db4o ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1010, 'WebSphere ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1011, 'ORCAD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1012, 'Turbo Pascal ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1013, 'EJB ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1014, 'Oracle ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1015, 'Siebel ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1016, 'BPEL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1017, 'SAP idocs ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1018, 'MySQL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1019, 'REXX ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1020, 'PL/SQL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1021, 'Active Directory ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1022, 'SAP Basis ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1023, 'CICS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1024, 'Developer/D2K ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1025, 'SAP SCM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1026, 'UML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1027, 'BREW ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1028, 'Python ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1029, 'S60 ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1030, 'SAP PP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1031, 'ERP ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1032, 'IIS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1033, 'Teradata ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1034, 'MVS ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1035, 'Business Ob', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1036, 'SAP COPA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1037, 'VSS/Clearcase ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1038, 'Internet Marketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1039, 'Website Development ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1040, 'Fireworks ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1041, 'Microsoft Office ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1042, 'JIRA ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1043, 'Hyperion ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1044, 'SAP SD ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1045, 'OS/2 ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1046, 'Datastage ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1047, 'SQL ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1048, 'VBScript ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1049, 'ODBC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1050, 'Visual Basic ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1051, 'Multithreading ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1052, 'SoundForge ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1053, 'Primavera ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1054, 'Office Operations ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1055, 'Hibernate ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1056, 'WebLogic ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1057, 'Back office Operations ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1058, 'HTML ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1059, 'LAN ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1060, 'SAP SRM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1061, 'CAD/CAM ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1062, 'dBase ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1063, 'CISCO ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1064, 'Store planning ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1065, 'Visual Merchandising ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1066, 'Email Marketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1067, 'Industrial Designing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1068, 'Tax Audits ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1069, 'Baking ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1070, 'Headhunting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1071, 'Art ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1072, 'Aquisitions ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1073, 'Knowledge Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1074, 'Teaching ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1075, 'Design ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1076, 'Hiring ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1077, 'Interior Design ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1078, 'Jewellery ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1079, 'Body Art ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1080, 'Instructing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1081, 'Art Therapy ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1082, 'Taxation ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1083, 'Landscape Gardening ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1084, 'Astrology ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1085, 'Wine making ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1086, 'Dance ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1087, 'Writing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1088, 'Banking Insurance ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1089, 'Advertising ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1090, 'Bookbinding ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1091, 'Cooking ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1092, 'Merchandise ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1093, 'Supervising ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1094, 'Accounts Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1095, 'Accounts ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1096, 'Marketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1097, 'Training ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1098, 'Banking ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1099, 'Customer Relations ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1100, 'Channel Account Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1101, 'Illustration ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1102, 'Negotiating Skill ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1103, 'Image Consulting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1104, 'Document Administration ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1105, 'Sales Planning ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1106, 'Nursing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1107, 'Buying ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1108, 'Private Tutoring ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1109, 'Education ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1110, 'Authoring ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1111, 'Vehicle Operating ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1112, 'Music ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1113, 'Human Resource Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1114, 'Textile Designing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1115, 'Talent Acquisition ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1116, 'Lighting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1117, 'Weaving ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1118, 'Manufacturing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1119, 'Visa Expat Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1120, 'Finance ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1121, 'Chartered Accountancy ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1122, 'Trade Execution ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1123, 'Planning and Organising ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1124, 'Corporate Finance ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1125, 'Administration ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1126, 'Cost Accounting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1127, 'Screen Printing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1128, 'Bookkeeping ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1129, 'HVAC ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1130, 'Advertisement Sales ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1131, 'IT Recruitment ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1132, 'Motivating Skill ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1133, 'Guest Service ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1134, 'Tax Laws ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1135, 'Plumbing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1136, 'Electrical Distribution ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1137, 'Make up Art ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1138, 'Waste Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1139, 'Landscape Architecture ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1140, 'Cloth Design ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1141, 'Architecture ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1142, 'Map Making ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1143, 'Producing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1144, 'Photography ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1145, 'Yoga ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1146, 'Biotechnology ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1147, 'Advisory ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1148, 'Office Administration ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1149, 'Recruitment ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1150, 'Advertising Art Direction ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1151, 'Graphic Design ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1152, 'Advertising Account Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1153, 'Accounting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1154, 'Upholstery ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1155, 'Supply Chain ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1156, 'Key Accounts Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1157, 'Busines Analysis ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1158, 'Floristry ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1159, 'Personal Services ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1160, 'Animation ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1161, 'Sales ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1162, 'Curating ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1163, 'Mergers ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1164, 'Composing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1165, 'Film Editing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1166, 'Entertainment ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1167, 'Mathematical ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1168, 'Counselling ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1169, 'Sales Tax ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1170, 'Copywriting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1171, 'Coaching ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1172, 'Hairdressing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1173, 'Income Tax ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1174, 'Office Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1175, 'Acting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1176, 'Telemarketing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1177, 'Analysis ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1178, 'Journalism ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1179, 'Sales Accounting ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1180, 'Vendor Management ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1181, 'Record Producing ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1182, 'Telling ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1183, 'Therapy ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1184, 'Company Laws ', 0, 1, 4, 0, '2020-03-12 18:30:30', NULL),
(1186, 'Display Advertising', 0, 1, 12, 1290, '2020-03-24 15:19:24', '2020-06-05 17:31:58'),
(1187, 'Email & Marketing Automation', 0, 1, 12, 1290, '2020-03-24 15:19:49', '2020-06-05 17:32:28'),
(1193, '2 to 5 Years', 3, 1, 9, 0, '2020-03-24 15:25:18', '2021-03-30 11:50:36'),
(1196, 'Flexy', 0, 1, 7, 0, '2020-03-24 15:26:13', '2020-04-08 03:01:10'),
(1197, 'Contract', 0, 1, 7, 0, '2020-03-24 15:26:26', NULL),
(1198, '15 Days', 0, 1, 10, 0, '2020-03-24 15:27:00', NULL),
(1199, '1 Month', 0, 1, 10, 0, '2020-03-24 15:27:14', NULL),
(1200, '3 Month', 0, 1, 10, 0, '2020-03-24 15:27:38', NULL),
(1202, '1 Week', 0, 1, 10, 0, '2020-03-24 17:25:55', NULL),
(1203, '2 Months', 0, 1, 10, 0, '2020-03-24 17:26:22', NULL),
(1204, 'Permanent', 0, 1, 7, 0, '2020-03-24 17:27:31', NULL),
(1205, 'Public Relations', 0, 1, 12, 1290, '2020-03-28 11:03:33', '2020-06-05 17:33:47'),
(1206, '5 to 7 Years', 4, 1, 9, 0, '2020-04-23 14:47:54', '2021-03-30 11:51:02'),
(1207, '7 to 10 Years', 5, 1, 9, 0, '2020-04-23 14:48:55', '2021-03-30 11:51:55'),
(1208, '10 to 15 Years', 6, 1, 9, 0, '2020-04-23 14:51:19', '2021-03-30 11:52:18'),
(1209, 'Above to 15 Years', 7, 1, 9, 0, '2020-04-23 14:51:37', '2021-03-30 11:52:48'),
(1211, 'Others', 0, 1, 12, 0, '2020-05-23 17:37:17', NULL),
(1212, 'Server', 0, 1, 4, 0, '2020-05-23 17:42:24', NULL),
(1213, 'System Administration', 0, 1, 4, 0, '2020-05-23 17:42:52', NULL),
(1214, 'Server Administration', 0, 1, 4, 0, '2020-05-23 17:43:04', NULL),
(1216, 'Marketing Strategy', 0, 1, 12, 1290, '2020-05-23 18:05:17', '2020-06-05 17:33:30'),
(1217, 'Search Engine Marketing', 0, 1, 4, 0, '2020-05-23 18:08:55', '2020-05-23 18:12:02'),
(1218, 'Offline Marketing', 0, 1, 4, 0, '2020-05-23 18:09:13', '2020-05-23 18:11:54'),
(1219, 'Public Relations', 0, 1, 4, 0, '2020-05-23 18:09:30', '2020-05-23 18:11:44'),
(1220, 'Social Media Marketing', 0, 1, 4, 0, '2020-05-23 18:09:46', '2020-05-23 18:11:33'),
(1221, 'Email Marketing', 0, 1, 4, 0, '2020-05-23 18:10:16', '2020-05-23 18:11:23'),
(1222, 'Content Marketing', 0, 1, 4, 0, '2020-05-23 18:10:39', NULL),
(1223, 'Marketing Management', 0, 1, 4, 0, '2020-05-23 18:10:58', NULL),
(1224, 'Advertising Strategy', 0, 1, 4, 0, '2020-05-23 18:11:13', NULL),
(1225, 'Accounts Payable', 0, 1, 12, 0, '2020-05-29 11:05:49', NULL),
(1226, 'Accounts Payable Jobs', 0, 1, 12, 0, '2020-05-29 11:07:59', NULL),
(1229, 'Consulting', 0, 1, 12, 1291, '2020-05-29 16:09:43', '2020-06-05 17:30:52'),
(1230, 'Human Resources', 0, 1, 12, 1291, '2020-05-29 16:10:27', '2020-06-05 17:31:16'),
(1231, 'Lead Generation', 0, 1, 12, 1290, '2020-05-29 16:10:57', '2020-06-05 17:32:53'),
(1232, 'Business Planing ', 0, 1, 4, 0, '2020-05-29 16:15:16', NULL),
(1233, 'Business case ', 0, 1, 4, 0, '2020-05-29 16:15:30', NULL),
(1234, 'Company valuation ', 0, 1, 4, 0, '2020-05-29 16:15:51', NULL),
(1235, 'Finance Projection', 0, 1, 4, 0, '2020-05-29 16:16:11', NULL),
(1237, 'Management Consulting', 0, 1, 12, 1291, '2020-05-30 17:39:29', '2020-06-05 17:31:36'),
(1238, 'Market & Customer Research', 0, 1, 12, 1290, '2020-05-30 17:39:41', '2020-06-05 17:33:10'),
(1239, 'Mobile App Development', 0, 1, 4, 0, '2020-05-30 17:40:42', NULL),
(1240, 'Android Development', 0, 1, 4, 0, '2020-05-30 17:40:58', NULL),
(1241, 'iOS Development', 0, 1, 4, 0, '2020-05-30 17:41:14', NULL),
(1242, 'Google Analytics', 0, 1, 4, 0, '2020-05-30 17:41:36', NULL),
(1243, 'React Native', 0, 1, 4, 0, '2020-05-30 17:41:44', NULL),
(1244, 'Category One', 0, 1, 13, 1201, '2020-06-03 12:09:33', NULL),
(1245, 'Engineering and Capital Goods', 0, 1, 1, 0, '2020-06-05 16:25:47', '2020-06-05 16:33:09'),
(1246, 'Consumer Durables', 0, 1, 1, 0, '2020-06-05 16:26:05', '2020-06-05 16:32:28'),
(1247, 'Aviation', 0, 1, 1, 0, '2020-06-05 16:26:22', '2020-06-05 16:31:37'),
(1248, 'Cement tracks', 0, 1, 1, 0, '2020-06-05 16:26:40', '2021-03-01 16:03:56'),
(1249, 'Banking', 0, 1, 1, 0, '2020-06-05 16:27:07', '2020-06-05 16:31:49'),
(1250, 'FMCG', 0, 1, 1, 0, '2020-06-05 16:27:26', '2020-06-05 16:33:42'),
(1251, 'Financial Services', 0, 1, 1, 0, '2020-06-05 16:27:42', '2020-06-05 16:33:26'),
(1252, 'Ecommerce', 0, 1, 1, 0, '2020-06-05 16:28:08', '2020-06-05 16:32:43'),
(1253, 'Admin Support', 0, 1, 1, 0, '2020-06-05 16:28:30', NULL),
(1254, 'Auto Components', 0, 1, 1, 0, '2020-06-05 16:28:51', '2020-06-05 16:31:21'),
(1255, 'Education and Training', 0, 1, 1, 0, '2020-06-05 16:29:19', '2020-06-05 16:32:56'),
(1256, 'Automobiles', 0, 1, 1, 0, '2020-06-05 16:29:47', '2020-06-05 16:31:08'),
(1257, 'Gems and Jewellery', 0, 1, 1, 0, '2020-06-05 16:33:58', NULL),
(1258, 'Healthcare', 0, 1, 1, 0, '2020-06-05 16:34:11', NULL),
(1259, 'Infrastructure', 0, 1, 1, 0, '2020-06-05 16:34:24', NULL),
(1260, 'Insurance', 0, 1, 1, 0, '2020-06-05 16:34:37', NULL),
(1261, 'IT & ITeS', 0, 1, 1, 0, '2020-06-05 16:34:51', NULL),
(1262, 'Manufacturing', 0, 1, 1, 0, '2020-06-05 16:35:01', NULL),
(1263, 'Media and Entertainment', 0, 1, 1, 0, '2020-06-05 16:35:14', NULL),
(1264, 'Metals And Mining', 0, 1, 1, 0, '2020-06-05 16:35:32', NULL),
(1265, 'Oil and Gas', 0, 1, 1, 0, '2020-06-05 16:35:45', NULL),
(1266, 'Pharmaceuticals', 0, 0, 1, 0, '2020-06-05 16:35:55', '2021-03-01 17:14:30'),
(1267, 'Ports', 0, 1, 1, 0, '2020-06-05 16:36:06', NULL),
(1268, 'Power', 0, 1, 1, 0, '2020-06-05 16:36:16', NULL),
(1269, 'Railways', 0, 1, 1, 0, '2020-06-05 16:36:28', NULL),
(1270, 'Real Estate', 0, 1, 1, 0, '2020-06-05 16:36:39', NULL),
(1271, 'Renewable Energy', 0, 1, 1, 0, '2020-06-05 16:36:51', NULL),
(1272, 'Retail', 0, 1, 1, 0, '2020-06-05 16:37:02', NULL),
(1273, 'Roads', 0, 1, 1, 0, '2020-06-05 16:37:11', NULL),
(1274, 'Science and Technology', 0, 1, 1, 0, '2020-06-05 16:37:23', NULL),
(1275, 'Services', 0, 1, 1, 0, '2020-06-05 16:37:34', NULL),
(1276, 'Steel', 0, 1, 1, 0, '2020-06-05 16:37:45', NULL),
(1277, 'Telecommunications', 0, 1, 1, 0, '2020-06-05 16:37:56', NULL),
(1278, 'Textiles', 0, 1, 1, 0, '2020-06-05 16:38:35', NULL),
(1279, 'Tourism and Hospitality', 0, 1, 1, 0, '2020-06-05 16:38:50', NULL),
(1280, 'Software Development', 0, 1, 13, 0, '2020-06-05 16:50:26', NULL),
(1281, 'IT - Networking', 0, 1, 13, 0, '2020-06-05 16:50:46', '2021-04-26 11:36:10'),
(1282, 'Data Science & Analytics', 0, 1, 13, 0, '2020-06-05 16:50:58', NULL),
(1283, 'Engineering & Architecture', 0, 1, 13, 0, '2020-06-05 16:51:15', NULL),
(1284, 'Design & Creative', 0, 1, 13, 0, '2020-06-05 16:51:38', NULL),
(1285, 'Writing', 0, 1, 13, 0, '2020-06-05 16:51:51', NULL),
(1286, 'Translation', 0, 1, 13, 0, '2020-06-05 16:52:10', NULL),
(1287, 'Legal', 0, 1, 13, 0, '2020-06-05 16:52:23', NULL),
(1288, 'Admin Support', 0, 1, 13, 0, '2020-06-05 16:52:37', NULL),
(1289, 'Customer Service', 0, 1, 13, 0, '2020-06-05 16:52:52', NULL),
(1291, 'Accounting & Consulting', 0, 1, 13, 0, '2020-06-05 16:53:41', '2021-03-01 17:15:11'),
(1292, 'Accounting', 0, 1, 12, 1291, '2020-06-05 17:30:22', NULL),
(1293, 'SEM - Search Engine Marketing', 0, 1, 12, 1290, '2020-06-05 17:34:07', NULL),
(1294, 'SEO - Search Engine Optimization', 0, 1, 12, 1290, '2020-06-05 17:34:27', NULL),
(1295, 'SMM - Social Media Marketing', 0, 1, 12, 1290, '2020-06-05 17:34:46', NULL),
(1296, 'Telemarketing & Telesales', 0, 1, 12, 1290, '2020-06-05 17:35:05', NULL),
(1297, 'Customer Service', 0, 1, 12, 1289, '2020-06-05 17:35:40', NULL),
(1298, 'Technical Support', 0, 1, 12, 1289, '2020-06-05 17:35:59', NULL),
(1299, 'Web Research', 0, 1, 12, 1288, '2020-06-05 17:36:28', NULL),
(1300, 'Transcription', 0, 1, 12, 1288, '2020-06-05 17:36:45', NULL),
(1301, 'Project Management', 0, 1, 12, 1288, '2020-06-05 17:37:02', NULL),
(1302, 'Desktop Software Development', 0, 1, 12, 1280, '2020-06-06 11:42:09', NULL),
(1303, 'Ecommerce Development', 0, 1, 12, 1280, '2020-06-06 11:42:31', NULL),
(1304, 'Game Development', 0, 1, 12, 1280, '2020-06-06 11:42:56', '2021-02-23 15:28:06'),
(1305, 'Mobile Development', 0, 1, 12, 1280, '2020-06-06 11:43:16', NULL),
(1306, 'Product Management', 0, 1, 12, 1280, '2020-06-06 11:44:05', NULL),
(1307, 'QA & Testing', 0, 1, 12, 1280, '2020-06-06 11:45:26', NULL),
(1308, 'Scripts & Utilities', 0, 1, 12, 1280, '2020-06-06 11:45:55', NULL),
(1309, 'Web Development', 0, 1, 12, 1280, '2020-06-06 11:46:44', NULL),
(1310, 'Web & Mobile Design', 0, 1, 12, 1280, '2020-06-06 11:47:05', NULL),
(1311, 'Database Administration', 0, 1, 12, 1281, '2020-06-06 11:47:43', NULL),
(1312, 'ERP / CRM Software', 0, 1, 12, 1281, '2020-06-06 11:48:08', NULL),
(1313, 'Information Security', 0, 1, 12, 1281, '2020-06-06 11:48:43', NULL),
(1314, 'Network & System Administration', 0, 1, 12, 1281, '2020-06-06 11:49:19', NULL),
(1315, 'A/B Testing', 0, 1, 12, 1282, '2020-06-06 11:49:58', NULL),
(1316, 'Data Visualization', 0, 1, 12, 1282, '2020-06-06 11:50:19', NULL),
(1317, 'Data Extraction / ETL', 0, 1, 12, 1282, '2020-06-06 11:50:40', NULL),
(1318, 'Data Mining & Management', 0, 1, 12, 1282, '2020-06-06 11:55:13', NULL),
(1319, 'Machine Learning', 0, 1, 12, 1282, '2020-06-06 11:55:50', NULL),
(1320, 'Quantitative Analysis', 0, 1, 12, 1282, '2020-06-06 11:56:09', NULL),
(1321, '3D Modeling & CAD', 0, 1, 12, 1283, '2020-06-06 11:57:58', NULL),
(1322, 'Architecture', 0, 1, 12, 1283, '2020-06-06 11:58:20', NULL),
(1323, 'Chemical Engineering', 0, 1, 12, 1283, '2020-06-06 11:58:39', NULL),
(1324, 'Civil & Structural Engineering', 0, 1, 12, 1283, '2020-06-06 11:58:58', NULL),
(1325, 'Contract Manufacturing', 0, 1, 12, 1283, '2020-06-06 11:59:15', NULL),
(1326, 'Electrical Engineering', 0, 1, 12, 1283, '2020-06-06 11:59:43', NULL),
(1327, 'Interior Design', 0, 1, 12, 1283, '2020-06-06 12:00:12', NULL),
(1328, 'Mechanical Engineering', 0, 1, 12, 1283, '2020-06-06 12:00:31', NULL),
(1329, 'Product Design', 0, 1, 12, 1283, '2020-06-06 12:00:49', NULL),
(1331, 'Art & Illustration', 0, 1, 12, 1284, '2020-06-06 12:03:55', NULL),
(1332, 'Audio Production', 0, 1, 12, 1284, '2020-06-06 12:04:14', NULL),
(1333, 'Brand Identity & Strategy', 0, 1, 12, 1284, '2020-06-06 12:07:43', NULL),
(1334, 'Graphics & Design', 0, 1, 12, 1284, '2020-06-06 12:07:59', NULL),
(1335, 'Logo Design & Branding', 0, 1, 12, 1284, '2020-06-06 12:08:18', NULL),
(1336, 'Motion Graphics', 0, 1, 12, 1284, '2020-06-06 12:09:41', NULL),
(1337, 'Photography', 0, 1, 12, 1284, '2020-06-06 12:10:00', NULL),
(1338, 'Presentations', 0, 1, 12, 1284, '2020-06-06 12:10:15', NULL),
(1339, 'Video Production', 0, 1, 12, 1284, '2020-06-06 12:10:31', NULL),
(1340, 'Voice Talent', 0, 1, 12, 1284, '2020-06-06 12:10:50', NULL),
(1341, 'Contract Law', 0, 1, 12, 1287, '2020-06-06 12:11:47', NULL),
(1342, 'Corporate Law', 0, 1, 12, 1287, '2020-06-06 12:12:07', NULL),
(1343, 'Criminal Law', 0, 1, 12, 1287, '2020-06-06 12:13:29', NULL),
(1344, 'Family Law', 0, 1, 12, 1287, '2020-06-06 12:13:51', NULL),
(1345, 'Intellectual Property Law', 0, 1, 12, 1287, '2020-06-06 12:14:11', NULL),
(1346, 'Paralegal Services', 0, 1, 12, 1287, '2020-06-06 12:14:39', NULL),
(1347, 'General Translation', 0, 1, 12, 1286, '2020-06-06 12:15:04', NULL),
(1348, 'Legal Translation', 0, 1, 12, 1286, '2020-06-06 12:15:27', NULL),
(1349, 'Medical Translation', 0, 1, 12, 1286, '2020-06-06 12:15:45', NULL),
(1350, 'Technical Translation', 0, 1, 12, 1286, '2020-06-06 12:16:15', NULL),
(1351, 'Web Content', 0, 1, 12, 1285, '2020-06-06 12:16:46', NULL),
(1352, 'Technical Writing', 0, 1, 12, 1285, '2020-06-06 12:17:03', NULL),
(1353, 'Resumes & Cover Letters', 0, 1, 12, 1285, '2020-06-06 12:17:21', NULL),
(1354, 'Grant Writing', 0, 1, 12, 1285, '2020-06-06 12:17:39', NULL),
(1355, 'Editing & Proofreading', 0, 1, 12, 1285, '2020-06-06 12:18:15', NULL),
(1356, 'Creative Writing', 0, 1, 12, 1285, '2020-06-06 12:18:35', NULL),
(1357, 'Copywriting', 0, 1, 12, 1285, '2020-06-06 12:18:53', NULL),
(1358, 'Article & Blog Writing', 0, 1, 12, 1285, '2020-06-06 12:19:13', NULL),
(1359, 'Academic Writing & Research', 0, 1, 12, 1285, '2020-06-06 12:19:32', NULL),
(1361, '0 to 1 Years', 1, 1, 9, 0, '2020-11-18 21:19:48', '2021-03-30 11:49:35'),
(1362, '1 to 2 Years', 2, 1, 9, 0, '2020-11-18 21:20:00', '2021-03-30 11:50:12'),
(1363, 'Oral and written communication skills', 0, 1, 4, 0, '2020-11-18 21:23:18', NULL),
(1364, 'Interpersonal Skills', 0, 1, 4, 0, '2020-11-18 21:23:41', NULL),
(1365, 'Facilitation Skills', 0, 1, 4, 0, '2020-11-18 21:23:52', NULL),
(1366, 'Interpersonal & Consultative Skills', 0, 1, 4, 0, '2020-11-18 21:24:12', NULL),
(1367, 'Analytical Thinking & Problem Solving', 0, 1, 4, 0, '2020-11-18 21:24:34', NULL),
(1368, 'Organizational Skills', 0, 1, 4, 0, '2020-11-18 21:25:00', NULL),
(1369, 'Processes Modeling', 0, 1, 4, 0, '2020-11-18 21:25:20', NULL),
(1370, 'API', 0, 1, 4, 0, '2020-11-18 21:38:43', NULL),
(1371, 'Database Development', 0, 1, 4, 0, '2020-11-18 21:38:58', NULL),
(1372, 'Web Application', 0, 1, 4, 0, '2020-11-18 21:39:08', NULL),
(1373, 'Database Design', 0, 1, 4, 0, '2020-11-18 21:39:19', NULL),
(1374, 'API Integration', 0, 1, 4, 0, '2020-11-18 21:39:41', NULL),
(1375, 'Custom PHP', 0, 1, 4, 0, '2020-11-18 21:39:51', NULL),
(1376, 'Laravel', 0, 1, 4, 0, '2020-11-18 21:40:01', NULL),
(1377, 'Vue.js', 0, 1, 4, 0, '2020-11-18 21:40:14', NULL),
(1378, 'React', 0, 1, 4, 0, '2020-11-18 21:40:29', NULL),
(1379, 'Git', 0, 1, 4, 0, '2020-11-18 21:40:39', NULL),
(1380, 'PHP', 0, 1, 4, 0, '2020-11-18 21:40:50', NULL),
(1381, 'JavaScript', 0, 1, 4, 0, '2020-11-18 21:40:59', NULL),
(1382, 'HTML5', 0, 1, 4, 0, '2020-11-18 21:41:07', NULL),
(1383, 'SQL', 0, 1, 4, 0, '2020-11-18 21:41:16', NULL),
(1384, 'MySQL', 0, 1, 4, 0, '2020-11-18 21:41:26', NULL),
(1385, 'Apache HTTP Server', 0, 1, 4, 0, '2020-11-18 21:41:34', NULL),
(1386, 'NGINX', 0, 1, 4, 0, '2020-11-18 21:41:44', NULL),
(1387, 'Manual Tester', 0, 1, 13, 0, '2021-02-23 15:16:27', '2021-04-26 11:35:44'),
(1388, 'erp', 0, 1, 12, 0, '2021-02-23 15:27:30', NULL),
(1389, '.net', 0, 1, 4, 0, '2021-02-23 15:28:36', NULL),
(1390, 'test', 0, 1, 8, 0, '2021-02-23 16:22:16', NULL),
(1391, 'ftp', 0, 1, 7, 0, '2021-03-01 17:56:01', NULL),
(1392, 'istqb', 0, 1, 5, 0, '2021-03-01 17:59:48', NULL),
(1393, 'Karnataka', 0, 1, 14, 0, '2021-03-18 11:35:43', '2021-03-18 11:36:25'),
(1395, 'Mangaluru', 0, 1, 15, 1393, '2021-03-18 12:46:21', NULL),
(1396, 'Bengaluru', 0, 1, 15, 1393, '2021-03-18 12:48:35', NULL),
(1397, 'Andhra Pradesh', 0, 1, 14, 0, '2021-03-24 10:50:36', NULL),
(1398, 'Arunachal Pradesh', 0, 1, 14, 0, '2021-03-24 10:51:02', NULL),
(1399, 'Assam', 0, 1, 14, 0, '2021-03-24 10:51:27', NULL),
(1400, 'Bihar', 0, 1, 14, 0, '2021-03-24 10:51:48', NULL),
(1401, 'Chhattisgarh', 0, 1, 14, 0, '2021-03-24 10:54:47', NULL),
(1402, 'Delhi', 0, 1, 14, 0, '2021-03-24 10:55:11', NULL),
(1403, 'Goa', 0, 1, 14, 0, '2021-03-24 10:55:40', NULL),
(1404, 'Gujarat', 0, 1, 14, 0, '2021-03-24 10:55:58', NULL),
(1405, 'Haryana', 0, 1, 14, 0, '2021-03-24 10:56:17', NULL),
(1406, 'Himachal Pradesh', 0, 1, 14, 0, '2021-03-24 10:56:41', NULL),
(1407, 'Jharkhand', 0, 1, 14, 0, '2021-03-24 10:57:02', NULL),
(1408, 'Kerala', 0, 1, 14, 0, '2021-03-24 10:57:24', NULL),
(1409, 'Madhya Pradesh', 0, 1, 14, 0, '2021-03-24 10:57:49', NULL),
(1410, 'Maharashtra', 0, 1, 14, 0, '2021-03-24 10:58:16', NULL),
(1411, 'Manipur', 0, 1, 14, 0, '2021-03-24 10:58:38', NULL),
(1412, 'Meghalaya', 0, 1, 14, 0, '2021-03-24 10:59:03', NULL),
(1413, 'Mizoram', 0, 1, 14, 0, '2021-03-24 10:59:22', NULL),
(1414, 'Nagaland', 0, 1, 14, 0, '2021-03-24 10:59:44', NULL),
(1415, 'Odisha', 0, 1, 14, 0, '2021-03-24 11:00:52', NULL),
(1416, 'Punjab', 0, 1, 14, 0, '2021-03-24 11:01:18', NULL),
(1417, 'Rajasthan', 0, 1, 14, 0, '2021-03-24 11:01:38', NULL),
(1418, 'Sikkim', 0, 1, 14, 0, '2021-03-24 11:02:00', NULL),
(1419, 'Tamil Nadu', 0, 1, 14, 0, '2021-03-24 11:02:18', NULL),
(1420, 'Telangana', 0, 1, 14, 0, '2021-03-24 11:02:36', NULL),
(1421, 'Tripura', 0, 1, 14, 0, '2021-03-24 11:02:54', NULL),
(1422, 'Uttar Pradesh', 0, 1, 14, 0, '2021-03-24 11:03:06', NULL),
(1423, 'Uttarakhand', 0, 1, 14, 0, '2021-03-24 11:03:35', NULL),
(1424, 'West Bengal', 0, 1, 14, 0, '2021-03-24 11:03:58', NULL),
(1425, 'Andaman and Nicobar Islands', 0, 1, 14, 0, '2021-03-24 11:04:46', NULL),
(1426, 'Chandigarh', 0, 1, 14, 0, '2021-03-24 11:05:02', NULL),
(1427, 'Jammu and Kashmir', 0, 1, 14, 0, '2021-03-24 11:05:41', NULL),
(1428, 'Ladakh', 0, 1, 14, 0, '2021-03-24 11:32:46', NULL),
(1429, 'Lakshadweep', 0, 1, 14, 0, '2021-03-24 11:34:33', NULL),
(1430, 'Puducherry', 0, 1, 14, 0, '2021-03-24 11:34:52', NULL),
(1431, 'Bengaluru Urban', 0, 1, 15, 1393, '2021-03-30 12:05:00', NULL),
(1432, 'Hubli-Dharwad', 0, 1, 15, 1393, '2021-03-30 12:05:26', NULL),
(1433, 'Mysuru', 0, 1, 15, 1393, '2021-03-30 12:05:50', NULL),
(1434, 'Kalaburagi', 0, 1, 15, 1393, '2021-03-30 12:06:10', NULL),
(1435, 'Belagavi ', 0, 1, 15, 1393, '2021-03-30 12:06:32', NULL),
(1436, 'Davanagere', 0, 1, 15, 1393, '2021-03-30 12:06:55', NULL),
(1437, 'Ballari', 0, 1, 15, 1393, '2021-03-30 12:07:28', NULL),
(1438, 'Vijayapura', 0, 1, 15, 1393, '2021-03-30 12:31:06', NULL),
(1439, 'Shivamogga', 0, 1, 15, 1393, '2021-03-30 12:32:00', NULL),
(1440, 'Tumakuru', 0, 1, 15, 1393, '2021-03-30 12:32:26', NULL),
(1441, 'Raichur', 0, 1, 15, 1393, '2021-03-30 12:33:55', NULL),
(1442, 'IT - Infra', 0, 1, 13, 0, '2021-04-26 11:36:26', NULL),
(1443, ' C Programming', 0, 1, 12, 1280, '2021-04-26 11:37:30', NULL),
(1444, 'Linux', 0, 1, 12, 1442, '2021-04-26 11:38:11', NULL),
(1445, 'SMTP', 0, 1, 12, 0, '2021-04-26 11:38:58', NULL),
(1446, 'Lucknow', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1447, 'Kanpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1448, 'Ghaziabad', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1449, 'Agra', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1450, 'Meerut', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1451, 'Varanasi', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1452, 'name', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1453, 'name', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1454, 'name', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1455, 'Moradabad', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1456, 'Saharanpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1457, 'Gorakhpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1458, 'Faizabad', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1459, 'Firozabad', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1460, 'Jhansi', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1461, 'Muzaffarnagar', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1462, 'Mathura-Vrindavan', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1463, 'Budaun', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1464, 'Rampur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1465, 'Shahjahanpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1466, 'Farrukhabad-cum-Fategarh', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1467, 'Ayodhya Cantt', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1468, 'Maunath Bhanjan', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1469, 'Hapur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1470, 'Noida', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1471, 'Etawah', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1472, 'Mirzapur-cum-Vindhyachal', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1473, 'Bulandshahr', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1474, 'Sambhal', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1475, 'Amroha', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1476, 'Hardoi', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1477, 'Fatehpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1478, 'Raebareli', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1479, 'Orai', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1480, 'Sitapur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1481, 'Bahraich', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1482, 'Modinagar', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1483, 'Unnao', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1484, 'Jaunpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1485, 'Lakhimpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1486, 'Hathras', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1487, 'Banda', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1488, 'Pilibhit', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1489, 'Mughalsarai\n(Pandit Deen Dayal Upadhyaya Nagar)', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1490, 'Barabanki', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1491, 'Khurja', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1492, 'Gonda', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1493, 'Mainpuri', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1494, 'Lalitpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1495, 'Etah', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1496, 'Deoria', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1497, 'Ujhani', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1498, 'Ghazipur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1499, 'Sultanpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1500, 'Azamgarh', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1501, 'Bijnor', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1502, 'Sahaswan', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1503, 'Basti', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1504, 'Chandausi', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1505, 'Akbarpur', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1506, 'Ballia', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1507, 'Tanda', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1508, 'Greater Noida', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1509, 'Shikohabad', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1510, 'Shamli', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1511, 'Awagarh', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1512, 'Kasganj', 0, 1, 15, 1422, '0000-00-00 00:00:00', NULL),
(1513, 'Visakhapatnam', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1514, 'Vijayawada', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1515, 'Guntur', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1516, 'Nellore', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1517, 'Kurnool', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1518, 'Kakinada', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1519, 'Rajamahendravaram', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1520, 'Kadapa', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1521, 'Tirupati', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1522, 'Anantapuram', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1523, 'Vizianagaram', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1524, 'Eluru', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1525, 'Nandyal', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1526, 'Ongole', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1527, 'Adoni', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1528, 'Madanapalle', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1529, 'Machilipatnam', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1530, 'Tenali', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1531, 'Proddatur', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1532, 'Chittoor', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1533, 'Bhimavaram', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1534, 'Hindupur', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1535, 'Srikakulam', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1536, 'Gudivada', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1537, 'Guntakal', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1538, 'Tadepalligudem', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1539, 'Dharmavaram', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1540, 'Narasaraopet', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1541, 'Tadipatri', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1542, 'Mangalagiri', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1543, 'Amaravati', 0, 1, 15, 1397, '0000-00-00 00:00:00', NULL),
(1544, 'Anjaw', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1545, 'Changlang', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1546, 'Dibang Valley', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1547, 'East Kameng', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1548, 'East Siang', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1549, 'Kurung Kumey', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1550, 'Lohit', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1551, 'Lower Dibang Valley', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1552, 'Lower Subansiri', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1553, 'Papum Pare', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1554, 'Tawang', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1555, 'Tirap', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1556, 'Upper Siang', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL);
INSERT INTO `job_category` (`category_id`, `name`, `sort_order`, `status`, `type_id`, `parent_id`, `date_added`, `date_modified`) VALUES
(1557, 'Upper Subansiri', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1558, 'West Kameng', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1559, 'West Siang', 0, 1, 15, 1398, '0000-00-00 00:00:00', NULL),
(1560, 'Udalguri', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1561, 'Karimganj', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1562, 'Cachar', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1563, 'Kamrup', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1564, 'Karbi Anglong', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1565, 'Kamrup Metro', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1566, 'Goalpara', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1567, 'Kokrajhar', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1568, 'Chirang', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1569, 'Golaghat', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1570, 'Dibrugarh', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1571, 'Tinsukia', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1572, 'Darrang', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1573, 'Dima Hasao', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1574, 'Dhemaji', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1575, 'Dhubri', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1576, 'Nalbari', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1577, 'Nagaon', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1578, 'Bongaigaon', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1579, 'Barpeta', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1580, 'Lakhimpur', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1581, 'Baksa', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1582, 'Morigaon', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1583, 'Jorhat', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1584, 'Bongaigaon', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1585, 'Baksa', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1586, 'sonitpur', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1587, 'Sivasagar', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1588, 'Hailakandi', 0, 1, 15, 1399, '0000-00-00 00:00:00', NULL),
(1589, 'Patna', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1590, 'Gaya', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1591, 'Bhagalpur', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1592, 'Muzaffarpur', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1593, 'Purnia', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1594, 'Darbhanga', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1595, 'Bihar Sharif', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1596, 'Arrah', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1597, 'Begusarai', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1598, 'Katihar', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1599, 'Munger', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1600, 'Chhapra', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1601, 'Danapur', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1602, 'Bettiah', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1603, 'Saharsa', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1604, 'Sasaram', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1605, 'Hajipur', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1606, 'Dehri', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1607, 'Siwan', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1608, 'Motihari', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1609, 'Nawada', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1610, 'Bagaha', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1611, 'Buxar', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1612, 'Kishanganj', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1613, 'Sitamarhi', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1614, 'Jamalpur', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1615, 'Jehanabad', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1616, 'Aurangabad', 0, 1, 15, 1400, '0000-00-00 00:00:00', NULL),
(1617, 'Bastar', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1618, 'Bijapur', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1619, 'Bilaspur', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1620, 'Dakshin Bastar Dantewada', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1621, 'Dhamtari', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1622, 'Durg', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1623, 'Janjgir-Champa', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1624, 'Jashpur', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1625, 'Kabirdham (Kabeerdham)', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1626, 'Korba', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1627, 'Koriya', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1628, 'Mahasamund', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1629, 'Narayanpur', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1630, 'Raigarh', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1631, 'Raipur', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1632, 'Rajnandgaon', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1633, 'Surguja', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1634, 'Uttar Bastar Kanker', 0, 1, 15, 1401, '0000-00-00 00:00:00', NULL),
(1635, 'Aali', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1636, 'Ali Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1637, 'Asola', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1638, 'Aya Nagar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1639, 'Babar Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1640, 'Bakhtawar Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1641, 'Bakkar Wala', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1642, 'Bankauli', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1643, 'Bankner', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1644, 'Bapraula', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1645, 'Baqiabad', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1646, 'Barwala', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1647, 'Bawana', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1648, 'Begum Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1649, 'Bhalswa Jahangir Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1650, 'Bhati', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1651, 'Bhor Garh', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1652, 'Burari', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1653, 'Chandan Hola', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1654, 'Chattar Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1655, 'Chhawala (Chhawla)', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1656, 'Chilla Saroda Bangar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1657, 'Chilla Saroda Khadar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1658, 'Dallo Pura', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1659, 'Darya Pur Kalan', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1660, 'Dayal Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1661, 'Delhi', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1662, 'Delhi Cantonment', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1663, 'Deoli', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1664, 'Dera Mandi', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1665, 'Dindar Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1666, 'Fateh Pur Beri', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1667, 'Gharoli', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1668, 'Gharonda Neemka Bangar (Patparganj)', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1669, 'Gheora', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1670, 'Ghitorni', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1671, 'Gokal Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1672, 'Hastsal', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1673, 'Ibrahim Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1674, 'Jaffar Pur Kalan', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1675, 'Jaffrabad', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1676, 'Jait Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1677, 'Jharoda Kalan', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1678, 'Jharoda Majra Burari', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1679, 'Jiwan Pur (Johri Pur)', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1680, 'Jona Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1681, 'Kair', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1682, 'Kamal Pur Majra Burari', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1683, 'Kanjhawala', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1684, 'Kapas Hera', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1685, 'Karala', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1686, 'Karawal Nagar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1687, 'Khajoori Khas', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1688, 'Khan Pur Dhani', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1689, 'Khera', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1690, 'Khera Kalan', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1691, 'Khera Khurd', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1692, 'Kirari Suleman Nagar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1693, 'Kondli', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1694, 'Kotla Mahigiran', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1695, 'Kusum Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1696, 'Lad Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1697, 'Libas Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1698, 'Maidan Garhi', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1699, 'Malik Pur Kohi (Rang Puri)', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1700, 'Mandoli', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1701, 'Mir Pur Turk', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1702, 'Mithe Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1703, 'Mitraon', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1704, 'Mohammad Pur Majri', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1705, 'Molar Band', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1706, 'Moradabad Pahari', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1707, 'Mubarak Pur Dabas', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1708, 'Mukand Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1709, 'Mukhmel Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1710, 'Mundka', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1711, 'Mustafabad', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1712, 'Nangli Sakrawati', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1713, 'Nangloi Jat', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1714, 'Neb Sarai', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1715, 'New Delhi', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1716, 'Nilothi', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1717, 'Nithari', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1718, 'Pehlad Pur Bangar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1719, 'Pooth Kalan', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1720, 'Pooth Khurd', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1721, 'Pul Pehlad', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1722, 'Qadi Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1723, 'Quammruddin Nagar', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1724, 'Qutab Garh', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1725, 'Raja Pur Khurd', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1726, 'Rajokri', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1727, 'Raj Pur Khurd', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1728, 'Rani Khera', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1729, 'Roshan Pura (Dichaon Khurd)', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1730, 'Sadat Pur Gujran', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1731, 'Sahibabad Daulat Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1732, 'Saidabad', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1733, 'Saidul Azaib', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1734, 'Sambhalka', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1735, 'Shafi Pur Ranhola', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1736, 'Shakar Pur Baramad', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1737, 'Siras Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1738, 'Sultan Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1739, 'Sultan Pur Majra', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1740, 'Taj Pul', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1741, 'Tigri', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1742, 'Tikri Kalan', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1743, 'Tikri Khurd', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1744, 'Tilang Pur Kotla', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1745, 'Tukhmir Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1746, 'Ujwa', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1747, 'Ziauddin Pur', 0, 1, 15, 1402, '0000-00-00 00:00:00', NULL),
(1748, 'Bicholim', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1749, 'Canacona', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1750, 'Cuncolim', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1751, 'Curchorem', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1752, 'Mapusa', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1753, 'Margao', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1754, 'Mormugao', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1755, 'Panaji', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1756, 'Pernem', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1757, 'Ponda', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1758, 'Quepem', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1759, 'Sanguem', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1760, 'Sanquelim', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1761, 'Valpoi', 0, 1, 15, 1403, '0000-00-00 00:00:00', NULL),
(1762, 'Ahmedabad', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1763, 'Surat', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1764, 'Vadodara', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1765, 'Rajkot', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1766, 'Bhavnagar', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1767, 'Jamnagar', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1768, 'Junagadh', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1769, 'Gandhinagar', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1770, 'Gandhidham', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1771, 'Anand', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1772, 'Navsari', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1773, 'Morbi', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1774, 'Nadiad', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1775, 'Surendranagar', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1776, 'Bharuch', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1777, 'Mehsana', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1778, 'Bhuj', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1779, 'Porbandar', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1780, 'Palanpur', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1781, 'Valsad', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1782, 'Vapi', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1783, 'Gondal', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1784, 'Veraval', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1785, 'Godhara', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1786, 'Patan', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1787, 'Kalol, Gandhinagar', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1788, 'Dahod', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1789, 'Botad', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1790, 'Amreli', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1791, 'Deesa', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1792, 'Jetpur', 0, 1, 15, 1404, '0000-00-00 00:00:00', NULL),
(1793, 'Faridabad', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1794, 'Gurugram', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1795, 'Panipat', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1796, 'Ambala', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1797, 'Yamunanagar', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1798, 'Rohtak', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1799, 'Hisar', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1800, 'Karnal', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1801, 'Sonipat', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1802, 'Panchkula', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1803, 'Bhiwani', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1804, 'Sirsa', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1805, 'Bahadurgarh', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1806, 'Jind', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1807, 'Thanesar', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1808, 'Kaithal', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1809, 'Rewari', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1810, 'Mahendergarh', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1811, 'Pundri', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1812, 'Kosli', 0, 1, 15, 1405, '0000-00-00 00:00:00', NULL),
(1813, 'Shimla', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1814, 'Dharamsala', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1815, 'Solan', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1816, 'Mandi', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1817, 'Palampur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1818, 'Baddi', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1819, 'Nahan', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1820, 'Paonta Sahib', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1821, 'Sundarnagar', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1822, 'Chamba', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1823, 'Una', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1824, 'Kullu', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1825, 'Hamirpur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1826, 'Bilaspur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1827, 'Yol Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1828, 'Nalagarh', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1829, 'Nurpur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1830, 'Kangra', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1831, 'Santokhgarh', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1832, 'Mehatpur Basdehra', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1833, 'Shamshi', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1834, 'Parwanoo', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1835, 'Manali', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1836, 'Tira Sujanpur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1837, 'Ghumarwin', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1838, 'Dalhousie', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1839, 'Rohru', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1840, 'Nagrota Bagwan', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1841, 'Rampur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1842, 'Kumarsain', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1843, 'Jawalamukhi', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1844, 'Jogindernagar', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1845, 'Dera Gopipur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1846, 'Sarkaghat', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1847, 'Jhakhri', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1848, 'Indora', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1849, 'Bhuntar', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1850, 'Nadaun', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1851, 'Theog', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1852, 'Kasauli Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1853, 'Gagret', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1854, 'Chuari Khas', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1855, 'Daulatpur', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1856, 'Sabathu Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1857, 'Dalhousie Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1858, 'Rajgarh', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1859, 'Arki', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1860, 'Dagshai Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1861, 'Seoni', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1862, 'Talai', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1863, 'Jutogh Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1864, 'Chaupal', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1865, 'Rewalsar', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1866, 'Bakloh Cantonment', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1867, 'Jubbal', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1868, 'Bhota', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1869, 'Banjar', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1870, 'Naina Devi', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1871, 'Kotkhai', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1872, 'Narkanda', 0, 1, 15, 1406, '0000-00-00 00:00:00', NULL),
(1873, 'Ranchi', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1874, 'Dhanbad', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1875, 'Jamshedpur', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1876, 'Bokaro Steel City', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1877, 'Medininagar', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1878, 'Deoghar', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1879, 'Giridih', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1880, 'Phusro', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1881, 'Ramgarh', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1882, 'Hazaribagh', 0, 1, 15, 1407, '0000-00-00 00:00:00', NULL),
(1883, 'Thiruvananthapuram', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1884, 'Kozhikode', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1885, 'Kochi', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1886, 'Kollam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1887, 'Thrissur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1888, 'Kannur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1889, 'Alappuzha', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1890, 'Kottayam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1891, 'Palakkad', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1892, 'Manjeri', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1893, 'Thalassery', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1894, 'Thrippunithura', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1895, 'Ponnani', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1896, 'Vatakara', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1897, 'Kanhangad', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1898, 'Payyanur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1899, 'Koyilandy', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1900, 'Kodungallur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1901, 'Parappanangadi', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1902, 'Kalamassery', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1903, 'Neyyattinkara', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1904, 'Guruvayur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1905, 'Tanur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1906, 'Kayamkulam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1907, 'Malappuram', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1908, 'Thrikkakkara', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1909, 'Wadakkancherry', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1910, 'Irinjalakuda', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1911, 'Nedumangad', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1912, 'Kondotty', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1913, 'Panoor', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1914, 'Tirurangadi', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1915, 'Tirur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1916, 'Changanassery', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1917, 'Feroke', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1918, 'Kunnamkulam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1919, 'Kasaragod', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1920, 'Ottappalam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1921, 'Tiruvalla', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1922, 'Thodupuzha', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1923, 'Ettumanoor', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1924, 'Perinthalmanna', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1925, 'Chalakudy', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1926, 'Payyoli', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1927, 'Koduvally', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1928, 'Kottakkal', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1929, 'Mananthavady', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1930, 'Karunagappalli', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1931, 'Mattanur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1932, 'Punalur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1933, 'Nilambur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1934, 'Cherthala', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1935, 'Pandalam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1936, 'Sultan Bathery', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1937, 'Maradu', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1938, 'Valanchery', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1939, 'Taliparamba', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1940, 'Shornur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1941, 'Kattappana', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1942, 'Mukkam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1943, 'Iritty', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1944, 'Varkala', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1945, 'Cherpulassery', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1946, 'Nileshwaram', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1947, 'Chavakkad', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1948, 'Kothamangalam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1949, 'Pathanamthitta', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1950, 'Attingal', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1951, 'Paravur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1952, 'Ramanattukara', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1953, 'Erattupetta', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1954, 'Sreekandapuram', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1955, 'Angamaly', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1956, 'Chittur-Thathamangalam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1957, 'Kuthuparamba', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1958, 'Mannarkkad', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1959, 'Kalpetta', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1960, 'North Paravur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1961, 'Haripad', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1962, 'Muvattupuzha', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1963, 'Kottarakara', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1964, 'Adoor', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1965, 'Piravom', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1966, 'Pattambi', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1967, 'Anthoor', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1968, 'Perumbavoor', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1969, 'Mavelikkara', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1970, 'Eloor', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1971, 'Chengannur', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1972, 'Vaikom', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1973, 'Aluva', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1974, 'Pala', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1975, 'Koothattukulam', 0, 1, 15, 1408, '0000-00-00 00:00:00', NULL),
(1976, 'Indore', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1977, 'Bhopal', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1978, 'Jabalpur', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1979, 'Gwalior', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1980, 'Ujjain', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1981, 'Sagar', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1982, 'Dewas', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1983, 'Satna', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1984, 'Ratlam', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1985, 'Rewa', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1986, 'Murwara (Katni)', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1987, 'Singrauli', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1988, 'Burhanpur', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1989, 'Khandwa', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1990, 'Bhind', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1991, 'Chhindwara', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1992, 'Guna', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1993, 'Shivpuri', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1994, 'Vidisha', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1995, 'Chhatarpur', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1996, 'Damoh', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1997, 'Mandsaur', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1998, 'Khargone', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(1999, 'Neemuch', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2000, 'Pithampur', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2001, 'Gadarwara', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2002, 'Hoshangabad', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2003, 'Itarsi', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2004, 'Sehore', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2005, 'Morena[2]', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2006, 'Betul', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2007, 'Seoni', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2008, 'Datia', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2009, 'Nagda', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2010, 'Mundi', 0, 1, 15, 1409, '0000-00-00 00:00:00', NULL),
(2011, 'Mumbai City,\nMumbai Suburban', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2012, 'PMC, Pune', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2013, 'Nagpur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2014, 'Thane', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2015, 'PCMC, Pune', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2016, 'Nashik', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2017, 'Kalyan-Dombivli', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2018, 'Vasai-Virar City MC', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2019, 'Aurangabad', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2020, 'Navi Mumbai', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2021, 'Solapur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2022, 'Mira-Bhayandar', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2023, 'Latur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2024, 'Amravati', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2025, 'Nanded Waghala', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2026, 'Kolhapur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2027, 'Akola', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2028, 'Panvel', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2029, 'Ulhasnagar', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2030, 'Sangli-Miraj-Kupwad', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2031, 'Malegaon', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2032, 'Jalgaon', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2033, 'Dule', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2034, 'Bhivandi-Nizampur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2035, 'Ahmednagar', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2036, 'Chandrapur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2037, 'Parbhani', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2038, 'Ichalkaranji', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2039, 'Jalna', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2040, 'Ambarnath', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2041, 'Bhusawal', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2042, 'Ratnagiri', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2043, 'Beed', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2044, 'Gondia', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2045, 'Satara', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2046, 'Barshi', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2047, 'Yavatmal', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2048, 'Achalpur', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2049, 'Osmanabad', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2050, 'Nandurbar', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2051, 'Wardha', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2052, 'Udgir', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2053, 'Hinganghat', 0, 1, 15, 1410, '0000-00-00 00:00:00', NULL),
(2054, 'Bishnupur', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2055, 'Thoubal', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2056, 'Porompat', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2057, 'Lamphelpat', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2058, 'Senapati', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2059, 'Ukhrul', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2060, 'Chandel', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2061, 'Churachandpur', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2062, 'Tamenglong', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2063, 'Jiribam', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2064, 'Kangpokpi', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2065, 'Kakching', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2066, 'Tengnoupal', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2067, 'Kamjong', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2068, 'Noney(Longmai)', 0, 1, 15, 1411, '0000-00-00 00:00:00', NULL),
(2069, 'Baghmara', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2070, 'Cherrapunjee (Cherrapunji)', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2071, 'Jowai', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2072, 'Lawsohtun', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2073, 'Madanriting (Madanrting)', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2074, 'Mairang', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2075, 'Mawlai', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2076, 'Mawpat', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2077, 'Nongkseh', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2078, 'Nongmynsong', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2079, 'Nongpoh', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2080, 'Nongstoin', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2081, 'Nongthymmai', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2082, 'Pynthormukhrah (Pynthorumkhrah)', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2083, 'Resubelpara', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2084, 'Shillong', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2085, 'Shillong Cantonment', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2086, 'Tura', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2087, 'Umlyngka', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2088, 'Umpling', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2089, 'Umroi', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2090, 'Williamnag', 0, 1, 15, 1412, '0000-00-00 00:00:00', NULL),
(2091, 'Aizawl', 0, 1, 15, 1413, '0000-00-00 00:00:00', NULL),
(2092, 'Bairabi', 0, 1, 15, 1413, '0000-00-00 00:00:00', NULL),
(2093, 'Biate', 0, 1, 15, 1413, '0000-00-00 00:00:00', NULL),
(2094, 'Champhai', 0, 1, 15, 1413, '0000-00-00 00:00:00', NULL),
(2095, 'Darlawn', 0, 1, 15, 1413, '0000-00-00 00:00:00', NULL),
(2096, 'name', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2097, 'name', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2098, 'name', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2113, 'Dimapur', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2114, 'Kiphire', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2115, 'Kohima', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2116, 'Longleng', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2117, 'Mokokchung', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2118, 'Mon', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2119, 'Peren', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2120, 'Phek', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2121, 'Tuensang', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2122, 'Wokha', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2123, 'Zunheboto', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2124, 'Noklak', 0, 1, 15, 1414, '0000-00-00 00:00:00', NULL),
(2125, 'Anugul (Angul)', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2126, 'Balangir', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2127, 'Baleshwar (Balasore)', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2128, 'Bargarh', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2129, 'Baudh (Boudh)', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2130, 'Bhadrak', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2131, 'Cuttack', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2132, 'Debagarh', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2133, 'Dhenkanal', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2134, 'Gajapati', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2135, 'Ganjam', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2136, 'Jagatsinghapur', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2137, 'Jajapur', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2138, 'Jharsuguda', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2139, 'Kalahandi', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2140, 'Kandhamal', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2141, 'Kendrapara', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2142, 'Kendujhar', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2143, 'Khordha', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2144, 'Koraput', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2145, 'Malkangiri', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2146, 'Mayurbhanj', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2147, 'Nabarangapur (Nabarangpur)', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2148, 'Nayagarh', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2149, 'Nuapada', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2150, 'Puri', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2151, 'Rayagada', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2152, 'Sambalpur', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2153, 'Subarnapur', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2154, 'Sundargarh (Sundergarh)', 0, 1, 15, 1415, '0000-00-00 00:00:00', NULL),
(2155, 'Amritsar', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2156, 'Ludhiana', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2157, 'Jalandhar', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2158, 'Patiala', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2159, 'Bathinda', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2160, 'Hoshiarpur', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2161, 'Mohali', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2162, 'Batala', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2163, 'Pathankot', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2164, 'Moga', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2165, 'Abohar', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2166, 'Malerkotla', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2167, 'Khanna', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2168, 'Phagwara', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2169, 'Muktsar', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2170, 'Barnala', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2171, 'Rajpura', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2172, 'Firozpur', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2173, 'Kapurthala', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2174, 'Faridkot', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2175, 'Sunam', 0, 1, 15, 1416, '0000-00-00 00:00:00', NULL),
(2176, 'Jaipur', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2177, 'Jodhpur', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2178, 'Kota[1]', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2179, 'Bhiwadi[2]', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2180, 'Bikaner', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2181, 'Udaipur', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2182, 'Ajmer', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2183, 'Bhilwara', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2184, 'Alwar', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2185, 'Sikar', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2186, 'Bharatpur', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2187, 'Pali', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2188, 'Sri Ganganagar', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2189, 'Kishangarh', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2190, 'Baran', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2191, 'Dhaulpur', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2192, 'Tonk', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2193, 'Beawar', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2194, 'Hanumangarh', 0, 1, 15, 1417, '0000-00-00 00:00:00', NULL),
(2195, 'Gangtok', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2196, 'Gyalshing', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2197, 'Jorethang', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2198, 'Mangan', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2199, 'Namchi', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2200, 'Nayabazar', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2201, 'Rangpo', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2202, 'Rhenak (Rhenock)', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2203, 'Singtam', 0, 1, 15, 1418, '0000-00-00 00:00:00', NULL),
(2204, 'Chennai', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2205, 'Coimbatore', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2206, 'Madurai', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2207, 'Tiruchirappalli', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2208, 'Tiruppur', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2209, 'Salem', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2210, 'Erode', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2211, 'Tirunelveli', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2212, 'Vellore', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2213, 'Thoothukkudi', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2214, 'Dindigul', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2215, 'Thanjavur', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2216, 'Ranipet', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2217, 'Sivakasi', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2218, 'Karur', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2219, 'Udhagamandalam', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2220, 'Hosur', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2221, 'Nagercoil', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2222, 'Kanchipuram', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2223, 'Kumarapalayam', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2224, 'Karaikkudi', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2225, 'Neyveli', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2226, 'Cuddalore', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2227, 'Kumbakonam', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2228, 'Tiruvannamalai', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2229, 'Pollachi', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2230, 'Rajapalayam', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2231, 'Gudiyatham', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2232, 'Pudukkottai', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2233, 'Vaniyambadi', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2234, 'Ambur', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2235, 'Nagapattinam', 0, 1, 15, 1419, '0000-00-00 00:00:00', NULL),
(2236, 'Hyderabad', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2237, 'Warangal[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2238, 'Nizamabad', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2239, 'Khammam[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2240, 'Karimnagar', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2241, 'Ramagundam', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2242, 'Mahabubnagar[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2243, 'Nalgonda[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2244, 'Adilabad[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2245, 'Siddipet[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2246, 'Miryalaguda', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2247, 'Suryapet[a]', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2248, 'Jagtial', 0, 1, 15, 1420, '0000-00-00 00:00:00', NULL),
(2249, 'Agartala', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2250, 'Dharmanagar', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2251, 'Udaipur', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2252, 'Kailasahar', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2253, 'Bishalgarh', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2254, 'Teliamura', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2255, 'Khowai', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2256, 'Belonia', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2257, 'Melaghar', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2258, 'Mohanpur', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2259, 'Ambassa', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2260, 'Ranirbazar', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2261, 'Santirbazar', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2262, 'Kumarghat', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2263, 'Sonamura', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2264, 'Panisagar', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2265, 'Amarpur', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2266, 'Jirania', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2267, 'Kamalpur', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2268, 'Sabroom', 0, 1, 15, 1421, '0000-00-00 00:00:00', NULL),
(2336, 'Almora', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2337, 'Bageshwar', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2338, 'Chamoli', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2339, 'Champawat', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2340, 'Dehradun', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2341, 'Garhwal (Pauri Garhwal)', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2342, 'Hardwar (Haridwar)', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2343, 'Nainital', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2344, 'Pithoragarh', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2345, 'Rudraprayag', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2346, 'Tehri Garhwal', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2347, 'Udham Singh Nagar', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2348, 'Uttarkashi', 0, 1, 15, 1423, '0000-00-00 00:00:00', NULL),
(2349, 'Kolkata', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2350, 'Asansol', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2351, 'Siliguri', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2352, 'Durgapur', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2353, 'Bardhaman', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2354, 'English Bazar', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2355, 'Baharampur', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2356, 'Habra', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2357, 'Kharagpur', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2358, 'Shantipur', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2359, 'Dankuni', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2360, 'Dhulian', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2361, 'Ranaghat', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2362, 'Haldia', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2363, 'Raiganj', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2364, 'Krishnanagar', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2365, 'Nabadwip', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2366, 'Medinipur', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2367, 'Jalpaiguri', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2368, 'Balurghat', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2369, 'Basirhat', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2370, 'Bankura', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2371, 'Chakdaha', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2372, 'Darjeeling', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2373, 'Alipurduar', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2374, 'Purulia', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2375, 'Jangipur', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2376, 'Bangaon', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2377, 'Cooch Behar', 0, 1, 15, 1424, '0000-00-00 00:00:00', NULL),
(2378, 'Achhabal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2379, 'Aishmuquam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2380, 'Akhnoor', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2381, 'Anantnag', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2382, 'Arnia', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2383, 'Arwani', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2384, 'Ashmuji Khalsa', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2385, 'Awantipora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2386, 'Badami Bagh', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2387, 'Badgam (Budgam)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2388, 'Bandipore (Bandipora)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2389, 'Banihal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2390, 'Baramula (Baramulla)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2391, 'Bari Brahamana (Bari Brahmana)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2392, 'Bashohli (Basholi)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2393, 'Batote', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2394, 'Beerwah', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2395, 'Bhaderwah', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2396, 'Bhalwal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2397, 'Bhore', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2398, 'Bijbehara', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2399, 'Billawar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2400, 'Birpur', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2401, 'Bishna', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2402, 'Chadura', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2403, 'Chak Kalu', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2404, 'Chak Ratnu', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2405, 'Charar-i-Sharief', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2406, 'Chenani', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2407, 'Chhatha', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2408, 'Dara Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2409, 'Devsar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2410, 'Dhande Kalan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2411, 'Doda', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2412, 'Drug Mulla', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2413, 'Duru Verinag', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL);
INSERT INTO `job_category` (`category_id`, `name`, `sort_order`, `status`, `type_id`, `parent_id`, `date_added`, `date_modified`) VALUES
(2414, 'Frisal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2415, 'Ganderbal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2416, 'Ghomanhasan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2417, 'Gorah Salathian', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2418, 'Gulmarg', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2419, 'Hajan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2420, 'Handwara', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2421, 'Heri', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2422, 'Hiranagar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2423, 'Ichgam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2424, 'Jammu', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2425, 'Jammu Cantonment', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2426, 'Jourian', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2427, 'Kathua', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2428, 'Katra', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2429, 'Khansahib', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2430, 'Khonmoh', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2431, 'Khore (Khour)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2432, 'Khrew', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2433, 'Kishtwar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2434, 'Koker Nag', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2435, 'Kral Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2436, 'Kral Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2437, 'Kud', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2438, 'Kulgam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2439, 'Kunzer', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2440, 'Kupwara', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2441, 'Lakhanpur', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2442, 'Lasjan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2443, 'Magam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2444, 'Maralia', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2445, 'Marhi', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2446, 'Mattan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2447, 'Mehmood Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2448, 'Nagam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2449, 'Nagrota', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2450, 'Naka Majiari', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2451, 'Nihalpur Simbal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2452, 'Nowangabra', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2453, 'Now Gam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2454, 'Nowshehra', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2455, 'Pahalgam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2456, 'Pampora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2457, 'Parole', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2458, 'Pattan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2459, 'Pulwama', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2460, 'Punch (Poonch)', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2461, 'Purana Daroorh', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2462, 'Qazi Gund', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2463, 'Quimoh', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2464, 'Raipur Domana', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2465, 'Rajauri', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2466, 'Rakh Gadi Garh', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2467, 'Ramban', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2468, 'Ramgarh', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2469, 'Ram Nagar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2470, 'Rathian', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2471, 'Reasi', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2472, 'Rehambal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2473, 'R.S. Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2474, 'Safa Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2475, 'Samba', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2476, 'Seer Hamdan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2477, 'Shangus', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2478, 'Shupiyan', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2479, 'Sool Koot', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2480, 'Sopore', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2481, 'Srinagar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2482, 'Sumbal', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2483, 'Sunderbani', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2484, 'Surankote', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2485, 'Talwara', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2486, 'Tangdhar', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2487, 'Thanamandi', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2488, 'Tral', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2489, 'Trehgam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2490, 'Udhampur', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2491, 'Uri', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2492, 'Vijay Pur', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2493, 'Wail', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2494, 'Watra Gam', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2495, 'Yari Pora', 0, 1, 15, 1427, '0000-00-00 00:00:00', NULL),
(2496, 'Ariankuppam (Ariyankuppam)', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2497, 'Karaikal', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2498, 'Kurumbapet', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2499, 'Mahe', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2500, 'Manavely', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2501, 'Ozhukarai', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2502, 'Puducherry (Pondicherry)', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2503, 'Thirumalairayanpattinam', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2504, 'Villianur', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2505, 'Yanam', 0, 1, 15, 1430, '0000-00-00 00:00:00', NULL),
(2506, 'Digital Marketing', 0, 1, 13, 0, '2021-05-13 10:40:31', NULL),
(2507, 'Article Writing', 0, 1, 12, 2506, '2021-05-13 10:41:06', NULL),
(2508, 'Blog', 0, 1, 12, 2506, '2021-05-13 10:41:24', NULL),
(2510, 'Ghostwriting', 0, 1, 12, 2506, '2021-05-13 10:42:35', NULL),
(2511, 'Content Writing', 0, 1, 12, 2506, '2021-05-13 10:42:58', NULL),
(2512, 'Article Rewriting', 0, 1, 12, 2506, '2021-05-13 10:43:13', NULL),
(2513, 'Social Media Marketing ', 0, 1, 12, 2506, '2021-06-16 19:33:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_filter`
--

DROP TABLE IF EXISTS `job_filter`;
CREATE TABLE `job_filter` (
  `job_filter_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `filter_keyword` varchar(120) NOT NULL,
  `filter_id` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_filter`
--

INSERT INTO `job_filter` (`job_filter_id`, `job_id`, `filter_keyword`, `filter_id`, `type`) VALUES
(316, 366, 'filter_language', 0, 3),
(315, 365, 'filter_language', 1, 3),
(314, 365, 'filter_skill', 1058, 3),
(313, 365, 'filter_skill', 779, 3),
(312, 364, 'filter_skill', 1018, 3),
(311, 364, 'filter_skill', 909, 3),
(310, 364, 'filter_skill', 1058, 3),
(309, 364, 'filter_skill', 800, 3),
(308, 364, 'filter_language', 1, 3),
(307, 363, 'filter_language', 0, 3),
(306, 362, 'filter_language', 0, 3),
(305, 361, 'filter_language', 4, 3),
(304, 361, 'filter_language', 5, 3),
(303, 361, 'filter_language', 1, 3),
(302, 361, 'filter_skill', 706, 3),
(301, 361, 'filter_skill', 932, 3),
(300, 360, 'filter_language', 1, 3),
(299, 360, 'filter_skill', 699, 3),
(298, 359, 'filter_language', 1, 3),
(297, 359, 'filter_skill', 955, 3),
(296, 358, 'filter_language', 1, 3),
(295, 358, 'filter_skill', 1151, 3),
(294, 357, 'filter_language', 1, 3),
(293, 357, 'filter_skill', 932, 3),
(292, 356, 'filter_language', 1, 3),
(291, 356, 'filter_skill', 932, 3),
(290, 355, 'filter_language', 1, 3),
(289, 355, 'filter_skill', 698, 3),
(288, 354, 'filter_language', 1, 3),
(287, 354, 'filter_skill', 780, 3),
(286, 353, 'filter_language', 1, 3),
(285, 353, 'filter_skill', 699, 3),
(284, 353, 'filter_skill', 698, 3),
(283, 353, 'filter_skill', 697, 3),
(282, 352, 'filter_language', 1, 3),
(281, 352, 'filter_skill', 780, 3),
(280, 351, 'filter_language', 1, 3),
(279, 350, 'filter_language', 1, 3),
(278, 350, 'filter_skill', 800, 3),
(277, 350, 'filter_skill', 807, 3),
(276, 349, 'filter_language', 2, 3),
(275, 349, 'filter_language', 1, 3),
(274, 349, 'filter_skill', 696, 3),
(273, 348, 'filter_language', 1, 3),
(272, 348, 'filter_skill', 1087, 3),
(271, 347, 'filter_language', 4, 3),
(270, 347, 'filter_language', 1, 3),
(269, 347, 'filter_skill', 698, 3),
(268, 347, 'filter_skill', 697, 3),
(267, 346, 'filter_language', 1, 3),
(266, 346, 'filter_skill', 1220, 3),
(265, 345, 'filter_skill', 1018, 3),
(264, 345, 'filter_skill', 1374, 3),
(263, 345, 'filter_skill', 800, 3),
(262, 345, 'filter_language', 4, 3),
(261, 345, 'filter_language', 1, 3),
(260, 344, 'filter_language', 1, 3),
(259, 344, 'filter_skill', 1075, 3),
(258, 343, 'filter_language', 1, 3),
(257, 343, 'filter_skill', 807, 3),
(256, 342, 'filter_language', 1, 3),
(255, 342, 'filter_skill', 763, 3),
(254, 341, 'filter_language', 1, 3),
(253, 341, 'filter_skill', 1039, 3),
(252, 341, 'filter_skill', 807, 3),
(251, 340, 'filter_language', 1, 3),
(250, 340, 'filter_skill', 919, 3),
(249, 340, 'filter_skill', 1075, 3),
(248, 340, 'filter_skill', 1151, 3),
(247, 339, 'filter_language', 1, 3),
(246, 339, 'filter_skill', 780, 3),
(245, 339, 'filter_skill', 773, 3),
(244, 339, 'filter_skill', 763, 3),
(243, 338, 'filter_language', 1, 3),
(242, 338, 'filter_skill', 819, 3),
(241, 338, 'filter_skill', 932, 3),
(240, 337, 'filter_language', 1, 3),
(239, 337, 'filter_skill', 779, 3),
(238, 337, 'filter_skill', 1374, 3),
(237, 337, 'filter_skill', 1242, 3),
(236, 337, 'filter_skill', 935, 3),
(235, 336, 'filter_language', 1, 3),
(234, 336, 'filter_skill', 870, 3),
(233, 336, 'filter_skill', 965, 3),
(232, 336, 'filter_skill', 726, 3),
(231, 335, 'filter_language', 1, 3),
(230, 335, 'filter_skill', 1372, 3),
(229, 335, 'filter_skill', 770, 3),
(228, 335, 'filter_skill', 699, 3),
(227, 335, 'filter_skill', 1382, 3),
(226, 335, 'filter_skill', 909, 3),
(225, 335, 'filter_skill', 800, 3),
(224, 335, 'filter_skill', 1039, 3),
(223, 335, 'filter_skill', 807, 3),
(222, 334, 'filter_language', 1, 3),
(221, 334, 'filter_skill', 1370, 3),
(220, 334, 'filter_skill', 1374, 3),
(219, 334, 'filter_skill', 1375, 3),
(218, 334, 'filter_skill', 800, 3),
(217, 333, 'filter_language', 1, 3),
(216, 333, 'filter_skill', 1089, 3),
(215, 333, 'filter_skill', 1220, 3),
(214, 333, 'filter_skill', 1151, 3),
(213, 332, 'filter_language', 1, 3),
(212, 332, 'filter_skill', 932, 3),
(211, 331, 'filter_language', 1, 3),
(210, 331, 'filter_skill', 1039, 3),
(209, 331, 'filter_skill', 807, 3),
(208, 330, 'filter_language', 1, 3),
(207, 330, 'filter_skill', 932, 3),
(206, 329, 'filter_language', 1, 3),
(205, 46, 'filter_jobtype', 1204, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_qualification`
--

DROP TABLE IF EXISTS `job_qualification`;
CREATE TABLE `job_qualification` (
  `job_qualification_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `qualification` int(11) NOT NULL,
  `specialization` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_qualification`
--

INSERT INTO `job_qualification` (`job_qualification_id`, `job_id`, `qualification`, `specialization`) VALUES
(24, 46, 695, 'qdsdas');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` (
  `newsletter_id` int(11) NOT NULL,
  `user_email` varchar(2000) NOT NULL,
  `status` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `link` varchar(2000) DEFAULT NULL,
  `is_published` tinyint(4) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `sender_id`, `receiver_id`, `message`, `link`, `is_published`, `date_added`, `date_modified`) VALUES
(142, 154, 157, 'Siddhesh Mayekar sent quote for this project Social Media Marketing', '', 1, '2021-06-16 15:56:09', '2021-06-16'),
(143, 156, 158, ' posted a Test a projectjob', '', 1, '2021-06-16 16:54:13', '2021-06-16'),
(144, 156, 154, ' posted a Test a projectjob', '', 0, '2021-06-16 16:54:13', NULL),
(145, 156, 152, ' posted a Test a projectjob', '', 1, '2021-06-16 16:54:13', '2021-06-16'),
(146, 167, 166, 'naveen kumar sent quote for this project graphics designer', '', 1, '2021-06-22 10:01:49', '2021-06-22'),
(147, 166, 167, 'Your job proposal for graphics designer was accepted by mentric technology', '', 1, '2021-07-01 15:18:30', '2021-07-01'),
(148, 157, 173, 'Aeidenz posted a YouTube Marketing for Food Channeljob', '', 0, '2021-06-22 17:41:56', NULL),
(149, 157, 172, 'Aeidenz posted a YouTube Marketing for Food Channeljob', '', 0, '2021-06-22 17:41:56', NULL),
(150, 157, 167, 'Aeidenz posted a YouTube Marketing for Food Channeljob', '', 0, '2021-06-22 17:41:56', NULL),
(151, 157, 165, 'Aeidenz posted a YouTube Marketing for Food Channeljob', '', 0, '2021-06-22 17:41:56', NULL),
(152, 157, 164, 'Aeidenz posted a YouTube Marketing for Food Channeljob', '', 0, '2021-06-22 17:41:56', NULL),
(153, 157, 154, 'Aeidenz posted a YouTube Marketing for Food Channeljob', '', 0, '2021-06-22 17:41:56', NULL),
(154, 167, 166, 'naveen kumar sent quote for this project graphics designers', '', 1, '2021-06-30 16:31:24', '2021-06-30'),
(155, 186, 183, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(156, 186, 182, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(157, 186, 181, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(158, 186, 180, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(159, 186, 178, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(160, 186, 174, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(161, 186, 173, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(162, 186, 172, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(163, 186, 167, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(164, 186, 165, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(165, 186, 164, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(166, 186, 154, 'Global Best HR & Management Consulting Private Limited posted a Digital Marketingjob', '', 0, '2021-07-09 23:12:53', NULL),
(167, 183, 176, 'Jose Varghese sent quote for this project Android Developer', '', 0, '2021-07-10 00:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `keyword` varchar(120) NOT NULL,
  `code` varchar(500) NOT NULL,
  `value` varchar(10000) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `keyword`, `code`, `value`, `date_added`, `date_modified`) VALUES
(2, 'payment', 'service_fee', '20', '2020-06-10 23:00:03', '2020-06-11 11:40:46'),
(3, 'payment', 'service_fee_type', 'percentage', '2020-06-10 23:00:03', '2021-05-21 10:07:48'),
(4, 'payment', 'gateway_name', 'Instamojo', '2020-06-10 23:00:03', '2021-05-21 10:07:48'),
(5, 'payment', 'gateway_key', '4b190b5e0c103a89ba251da54c938282', '2020-06-10 23:00:03', '2021-05-21 10:07:48'),
(6, 'payment', 'gateway_secret', '34e28425d7e67daea3a6baf5e0ad8f93', '2020-06-10 23:00:03', '2021-05-21 10:07:48'),
(7, 'payment', 'gateway_url', 'https://www.instamojo.com/api/1.1/', '2020-06-10 23:11:39', '2021-05-21 10:07:48'),
(8, 'website', 'first_name', 'Admin', '2020-06-12 17:00:53', '2021-04-29 11:13:29'),
(9, 'website', 'last_name', 'Account', '2020-06-12 17:00:53', '2021-04-29 11:13:29'),
(10, 'website', 'company_name', 'Offrolls', '2020-06-12 17:00:53', '2021-04-29 11:13:29'),
(11, 'website', 'email', 'info@offrolls.com', '2020-06-12 17:00:53', '2021-04-29 11:13:29'),
(12, 'website', 'mobile', '9000000000', '2020-06-12 17:00:53', '2021-04-29 11:13:29'),
(13, 'website', 'description', '&lt;div xss=&quot;removed&quot; xss=removed&gt;&lt;span xss=&quot;removed&quot;&gt;Our endeavor is to provide holistic training and technology solutions – fundamental and advanced technical skills, soft skills, job-oriented and upskilling training programs – in various sectors. We work with organizations in assessing and improving various management processes using state-of-the-art technology, resulting in efficient utilization of resources&lt;/span&gt;&lt;/div&gt;', '2020-06-12 17:00:53', '2021-04-29 11:13:29'),
(14, 'website', 'country', 'India', '2020-06-12 17:34:56', '2021-04-29 11:13:29'),
(15, 'website', 'state', 'Karnataka', '2020-06-12 17:34:56', '2021-04-29 11:13:29'),
(16, 'website', 'city', 'Bangalore', '2020-06-12 17:34:56', '2021-04-29 11:13:29'),
(17, 'website', 'street_name', 'Hebbal', '2020-06-12 17:34:56', '2021-04-29 11:13:29'),
(18, 'website', 'pincode', '560068', '2020-06-12 17:34:56', '2021-04-29 11:13:29'),
(19, 'website', 'facebook_page', 'https://facebook.com', '2020-06-12 17:57:34', '2021-04-29 11:13:29'),
(20, 'website', 'linkedin_page', 'https://linkedin.com', '2020-06-12 17:57:34', '2021-04-29 11:13:29'),
(21, 'payment', 'company_service_fee', '10', '2021-03-10 10:46:05', '2021-05-21 10:07:48'),
(22, 'payment', 'freelancer_service_fee', '5', '2021-03-10 10:46:05', '2021-05-21 10:07:48'),
(23, 'website', 'twitter_page', 'https://twitter.com/offrollsin', '2021-04-29 11:13:29', NULL),
(24, 'website', 'instagram_page', 'https://www.instagram.com/offrollsin/', '2021-04-29 11:13:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_profile`
--

DROP TABLE IF EXISTS `social_profile`;
CREATE TABLE `social_profile` (
  `social_profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sm_name` varchar(120) NOT NULL,
  `sm_link` varchar(2084) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_profile`
--

INSERT INTO `social_profile` (`social_profile_id`, `user_id`, `sm_name`, `sm_link`) VALUES
(104, 153, 'facebook', ''),
(103, 136, 'linkedin', ''),
(102, 136, 'instagram', ''),
(101, 136, 'facebook', 'https://www.facebook.com/srikanth.venkatesh.18062'),
(100, 151, 'instagram', 'mentric'),
(99, 151, 'linkedin', 'mentric'),
(98, 151, 'facebook', 'mentric'),
(97, 150, 'instagram', 'eeee'),
(96, 150, 'linkedin', 'eeee'),
(95, 150, 'facebook', 'eeee'),
(94, 131, 'instagram', 'ccxvcvx'),
(93, 131, 'linkedin', 'cxvxcv'),
(92, 131, 'facebook', 'cvxvc'),
(41, 73, 'instagram', ''),
(42, 74, 'facebook', ''),
(43, 74, 'linkedin', ''),
(44, 74, 'instagram', ''),
(45, 75, 'facebook', ''),
(46, 75, 'twitter', ''),
(47, 75, 'linkedin', ''),
(48, 75, 'instagram', ''),
(49, 77, 'facebook', ''),
(50, 77, 'linkedin', ''),
(51, 77, 'instagram', ''),
(52, 87, 'facebook', ''),
(53, 87, 'twitter', ''),
(54, 87, 'linkedin', ''),
(55, 87, 'instagram', ''),
(56, 89, 'facebook', ''),
(57, 89, 'twitter', ''),
(58, 89, 'linkedin', ''),
(59, 89, 'instagram', ''),
(60, 90, 'facebook', ''),
(61, 90, 'twitter', ''),
(62, 90, 'linkedin', ''),
(63, 90, 'instagram', ''),
(64, 94, 'facebook', ''),
(65, 94, 'twitter', ''),
(66, 94, 'linkedin', ''),
(67, 94, 'instagram', ''),
(68, 98, 'facebook', ''),
(69, 98, 'twitter', ''),
(70, 98, 'linkedin', ''),
(71, 98, 'instagram', ''),
(72, 99, 'facebook', 'https://www.facebook.com/MentricConsultants/'),
(73, 99, 'linkedin', 'https://www.linkedin.com/company/mentricgroup/'),
(74, 99, 'instagram', ''),
(75, 100, 'facebook', ''),
(76, 100, 'twitter', ''),
(77, 100, 'linkedin', ''),
(78, 100, 'instagram', ''),
(79, 101, 'facebook', ''),
(80, 101, 'twitter', ''),
(81, 101, 'linkedin', ''),
(82, 101, 'instagram', ''),
(83, 104, 'facebook', ''),
(84, 104, 'linkedin', ''),
(85, 104, 'instagram', ''),
(86, 113, 'facebook', ''),
(87, 113, 'linkedin', ''),
(88, 113, 'instagram', ''),
(89, 121, 'facebook', ''),
(90, 121, 'linkedin', '123'),
(91, 121, 'instagram', 'abc'),
(105, 153, 'linkedin', ''),
(106, 153, 'instagram', ''),
(107, 157, 'facebook', ''),
(108, 157, 'linkedin', ''),
(109, 157, 'instagram', ''),
(110, 166, 'facebook', 'mentric'),
(111, 166, 'linkedin', 'mentric'),
(112, 166, 'instagram', 'mentric'),
(113, 175, 'facebook', ''),
(114, 175, 'linkedin', ''),
(115, 175, 'instagram', ''),
(116, 176, 'facebook', ''),
(117, 176, 'linkedin', ''),
(118, 176, 'instagram', ''),
(119, 186, 'facebook', ''),
(120, 186, 'linkedin', ''),
(121, 186, 'instagram', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(120) DEFAULT NULL,
  `last_name` varchar(120) DEFAULT NULL,
  `slug` varchar(128) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `emailOTP` varchar(6) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) DEFAULT NULL,
  `activation_datetime` datetime DEFAULT NULL,
  `sso` tinyint(1) NOT NULL DEFAULT '0',
  `temp_details` varchar(10000) DEFAULT NULL,
  `device_details` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `slug`, `image`, `email`, `password`, `salt`, `mobile`, `user_type`, `isVerified`, `emailOTP`, `status`, `token`, `activation_datetime`, `sso`, `temp_details`, `device_details`, `date_added`, `date_modified`) VALUES
(130, 'admin', 'offrolls', '', NULL, 'admin@offrolls.in', '7a276158bebfe1809ede6b22b6464c5b1ae97b61', 'ECnpG8fiB', '8951646796', 4, 0, '', 1, '', NULL, 0, '', 'dduFxwY6Lpf_Odhdnt04Fy:APA91bHV2588MTc8d0LHB2iwQvBfZ7vphHAOuRdbane8ie6o857oS3J8P6VbK2Vv7ZGcV2PLRnfnaKVCp_M5S3uXF0Qbl5f0e_-3ThDmfNuYZEyJtkx_JTrv3hwDNnEojjd8iW-Yvc94', '2021-03-30 17:33:40', '2021-07-10 12:06:14'),
(153, 'Purple', 'Papaya', '', NULL, 'purplepapayaog@gmail.com', '0cdb042d699b70d7bc5aba576b37feb00ea9bd84', '6OykajxVZ', '7738861616', 2, 0, '', 1, 'ZLYEWaPyAXpRunJSxlBvjThkd9V6D5Hb', '2021-06-13 18:37:57', 0, '', '', '2021-06-13 18:37:57', '2021-06-13 18:45:25'),
(154, 'Siddhesh', 'Mayekar', '', 'profile20210613190742154.jpg', 'siddhmayekar@gmail.com', '', '', '7738861616', 3, 0, '', 1, '', NULL, 11, NULL, '', '2021-06-13 19:07:42', '2021-06-13 19:07:43'),
(155, NULL, NULL, '', NULL, 'anjalibhatia7@outlook.com', '30e3622c4f665a94f3d036162ccd7389e3388f24', 'pU1jVNtvI', '9810386102', 3, 0, NULL, 0, 'qpxMgE0OVyYnb7zCR5LH48aArs2SQjdP', '2021-06-15 11:00:20', 0, '', '', '2021-06-15 11:00:20', '2021-06-15 11:00:20'),
(157, 'Rajith ', 'Jacob', '', NULL, 'rajithjain@gmail.com', '4125bea925bbb9cc70526beb3b1237cba89114ee', '7qruOtai3', '9447976218', 2, 0, '', 1, '', '2021-06-16 10:27:17', 0, '', 'dduFxwY6Lpf_Odhdnt04Fy:APA91bHV2588MTc8d0LHB2iwQvBfZ7vphHAOuRdbane8ie6o857oS3J8P6VbK2Vv7ZGcV2PLRnfnaKVCp_M5S3uXF0Qbl5f0e_-3ThDmfNuYZEyJtkx_JTrv3hwDNnEojjd8iW-Yvc94', '2021-06-16 10:27:17', '2021-07-10 11:33:36'),
(163, NULL, NULL, '', NULL, 'srikanthhv@mentrictech.in', '58433ca46aa1d2206d0a100f225181a6140ca969', 'jFXDWKpZ2', '8951646796', 2, 0, '', 1, '', '2021-06-18 12:27:36', 0, '', '', '2021-06-18 12:27:36', '2021-06-18 12:28:52'),
(164, NULL, NULL, '', NULL, 'priya.savale108@gmail.com', '625692160769ba33f97e2d006d29595db917a85b', 'jLNZ7cEmp', '8591038812', 3, 0, '', 1, 'YjwfEMoUsAacp5RkbO8FGmCh2xzunrdQ', '2021-06-18 13:12:37', 0, '', '', '2021-06-18 13:12:37', '2021-06-18 13:17:13'),
(165, 'SRIKANTH', 'VENKATESH', 'srikanth-venkatesh-165', 'profile20210618145244165.jpg', 'hvsrikanth98@gmail.com', '', '', '8951646796', 3, 0, '', 1, '', NULL, 11, NULL, 'ff_2cn2QogajP53QwmEOqI:APA91bE9FTjBqX7R7pfHqx-pJaZSp5laFMs81dTE2OcKBiW_fwlPfIBQMPfgbYWd2XsChu1wcMJb0znQQxt-8tIiQQ7V5ZL9Qz2vrThIf5p-_LLU2Yd2qqzjp_mS-6Ck3kPa3DuUXZ7l', '2021-06-18 14:52:44', '2021-07-07 14:53:27'),
(166, 'naveen', 'kumar', '', NULL, 'naveenkumar.mt05@gmail.com', '3633bd70a9f7b9438b22b3ac1a3e128568575854', 'MkEUO2viK', '9008527505', 2, 0, '', 1, '', '2021-06-18 15:23:27', 0, '', 'ff_2cn2QogajP53QwmEOqI:APA91bE9FTjBqX7R7pfHqx-pJaZSp5laFMs81dTE2OcKBiW_fwlPfIBQMPfgbYWd2XsChu1wcMJb0znQQxt-8tIiQQ7V5ZL9Qz2vrThIf5p-_LLU2Yd2qqzjp_mS-6Ck3kPa3DuUXZ7l', '2021-06-18 15:23:27', '2021-07-07 14:53:07'),
(167, 'naveen', 'kumar', 'naveen-kumar-167', NULL, 'mentric02@gmail.com', '1a08c27868a8a983f9793322c714952e3b428c06', '1XtP5xW2z', '9008527505', 3, 0, '', 1, '', '2021-06-18 15:44:03', 0, '', 'ffKfs_qzSGag6JPs6mFHIv:APA91bFQOuUzEneqauEyCNjgOce29HKhrFgXMWHr2lWuGe9IssSZ23oNWcQO7fY5tkJxtxm0SMmKKAwUrm4-hK44vn01F9891K6zzJY9JD7QL-aXjgr5Ot1fb3hwbjQb6VPzx2bm18aR', '2021-06-18 15:44:03', '2021-07-01 15:29:00'),
(171, 'Rohan', 'Mayekar', '', 'cmppic20210620073500171.png', 'shootingskystudio@gmail.com', '052bdae722a2c11e0a0ebdea0d485254383c975e', 'hNkGTjwyx', '9167083270', 2, 0, '', 1, 'GeuqP7KZJBA0UWNzgaorScw6Q3IdhpLf', '2021-06-20 07:32:40', 0, '', '', '2021-06-20 07:32:40', '2021-06-20 07:35:39'),
(172, 'Srikanth', 'H V', 'srikanth-h-v-172', 'flpic20210621104546172.png', 'mrwikijhon@gmail.com', '0162b247fc3658e536d83adb5b91a8fd680bba84', 'gDxpPREjQ', '8951646796', 3, 0, '', 1, '', '2021-06-21 09:38:14', 0, '', 'ffKfs_qzSGag6JPs6mFHIv:APA91bFQOuUzEneqauEyCNjgOce29HKhrFgXMWHr2lWuGe9IssSZ23oNWcQO7fY5tkJxtxm0SMmKKAwUrm4-hK44vn01F9891K6zzJY9JD7QL-aXjgr5Ot1fb3hwbjQb6VPzx2bm18aR', '2021-06-21 09:38:14', '2021-07-01 11:49:33'),
(173, 'Dummy', 'K', '', NULL, 'contactsachinkoparde@gmail.com', '6cdb3664718eb51e462026e8a41bca13f998e1e7', 'RsMeZxDpc', '8970081804', 3, 0, '', 1, 'USnk4oGJgW0j3FDY5trNZAfuIqxb2Bi7', '2021-06-21 21:42:35', 0, '', '', '2021-06-21 21:42:35', '2021-06-21 21:43:17'),
(174, 'Rajith', 'Jain', 'rajith-jain-174', NULL, 'rajith@mentrictech.in', '30ac82ba0a9f476e28ae13a6b8da89318af813c2', 'AgLQXTWZy', '9447976218', 3, 0, '', 1, 'dRY0ElKPtIJC6XcLOu84ToV3zrMhSHmD', '2021-06-22 17:43:37', 0, '', 'dduFxwY6Lpf_Odhdnt04Fy:APA91bHV2588MTc8d0LHB2iwQvBfZ7vphHAOuRdbane8ie6o857oS3J8P6VbK2Vv7ZGcV2PLRnfnaKVCp_M5S3uXF0Qbl5f0e_-3ThDmfNuYZEyJtkx_JTrv3hwDNnEojjd8iW-Yvc94', '2021-06-22 17:43:37', '2021-07-10 12:05:40'),
(175, 'Anjali ', 'Bhatia ', '', NULL, 'anjali1610bhatia@gmail.com', 'ca210b3386d36beb7fb2acdf8cc3fa7fae2e3dff', 'hA83U0awg', '9810386102', 2, 0, '', 1, 'r6VUF5G3yfm9SNRC2jAKZBkxvIOHTda1', '2021-06-29 16:09:59', 0, '', '', '2021-06-29 16:09:59', '2021-07-01 17:02:08'),
(176, 'Rajith', 'Jacob', '', 'cmppic20210702120939176.png', 'groupmentric@gmail.com', '9f1da3bcfc7e6c0c8352efd6c54029af5870f7d9', 'r1cUgeMGF', '9447976218', 2, 0, '', 1, '', '2021-07-02 11:05:32', 0, '', '', '2021-07-02 11:05:32', '2021-07-02 12:09:39'),
(177, NULL, NULL, '', NULL, 'alan.wimbledon@gmail.com', '3f885c9c3509b11ec2934cc146f132be68c78b9b', 'jZ6231aL7', '9986663507', 3, 0, NULL, 0, '5K3INGz6l0ER7YVdeWqCJSpuHfMOQwyb', '2021-07-04 14:49:10', 0, '', '', '2021-07-04 14:49:10', '2021-07-04 14:49:10'),
(178, 'Alan', 'Saji', '', 'profile20210704145136178.jpg', 'tenaciousinvestmets@gmail.com', '', '', '9846220534', 3, 0, '', 1, 'weUBXy1cg5mCFAjN3PfxW0iHt64kqMaZ', NULL, 11, NULL, '', '2021-07-04 14:51:36', '2021-07-04 14:51:36'),
(179, NULL, NULL, '', NULL, 'santokalayil@gmail.com', '03301a23c89a66abdd377b24fe1fd74e7b11b367', '75c8u9YyI', '8891960880', 3, 0, NULL, 0, 'x2cCl34VOE1dXRwUPDG0gLHNTMfZzvQu', '2021-07-04 14:53:30', 0, '', '', '2021-07-04 14:53:30', '2021-07-04 14:53:30'),
(180, NULL, NULL, '', NULL, 'shoba.saji@gmail.com', '040e9f5d021bfdd780febf80d68b580da570f454', 'Y4qwkbJEv', '9845843507', 3, 0, '', 1, '', '2021-07-04 19:47:18', 0, '', '', '2021-07-04 19:47:18', '2021-07-04 19:48:06'),
(181, 'Shweta', 'Gurav', '', 'profile20210705144943181.jpg', 'shweta.gurav25@gmail.com', '', '', '7738861616', 3, 0, '', 1, '', NULL, 11, NULL, '', '2021-07-05 14:49:43', '2021-07-05 14:49:44'),
(182, NULL, NULL, '', NULL, 'sharanc25@gmail.com', '47ffdb54c3299cd7dc166cc6800ff5762ec88d5d', 'afEDOmoL3', '9789333850', 3, 0, '', 1, 'F0N4dZ1AeutVpPnsRT6zJlMLUirE98jx', '2021-07-05 15:13:05', 0, '', '', '2021-07-05 15:13:05', '2021-07-05 15:13:26'),
(183, 'Jose', 'Varghese', 'jose-varghese-183', NULL, 'jv2003113@gmail.com', '357c03edf0248a4dc315ee27f571b425bf7b2b4f', 'tuGSlB8Hi', '6364975366', 3, 0, '', 1, '', '2021-07-06 01:41:24', 0, '', '', '2021-07-06 01:41:24', '2021-07-06 01:43:15'),
(184, NULL, NULL, '', NULL, 'sonalsugandhi@gmail.com', '1c0c20d66f83318cc58b5aac7b69e60502f5b50b', '1GPUr0uac', '9742302561', 3, 0, NULL, 0, 'fY4QmPMbw6XauF0SWD1sO7KqCgNIZRvc', '2021-07-07 15:47:24', 0, '', '', '2021-07-07 15:47:24', '2021-07-07 15:47:24'),
(185, NULL, NULL, '', NULL, 'singhi.khushbu24@gmail.com', '173dad7f8abc443e595defb3606cec3772c1b904', 'LmZWe03EK', '9885892411', 3, 0, NULL, 0, 'ZWoNxCI1X8jqz0m25sUGr69OFYQJHtlD', '2021-07-07 16:43:54', 0, '', '', '2021-07-07 16:43:54', '2021-07-07 16:43:54'),
(186, 'Oommen', 'Abraham', '', NULL, 'abraham@globalbesthr.com', '835fd228f6f85ab97c0269caf02fad0c7c9e7295', 'mv9WdMToa', '9840002731', 2, 0, '', 1, '', '2021-07-09 22:57:47', 0, '', '', '2021-07-09 22:57:47', '2021-07-09 23:00:33'),
(187, 'Jose', 'Varghese', '', 'profile20210710014126187.jpg', 'varghese.per@gmail.com', '', '', '6364975366', 2, 0, '', 1, 'bcPgYHjyvRDKBQaJwdr8Z2l05fuGmU6e', NULL, 11, NULL, '', '2021-07-10 01:41:26', '2021-07-10 01:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity` (
  `user_activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keyword` varchar(500) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `link` varchar(2000) DEFAULT NULL,
  `is_notify` tinyint(1) DEFAULT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`cmt_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `candidate_certification`
--
ALTER TABLE `candidate_certification`
  ADD PRIMARY KEY (`certification_id`);

--
-- Indexes for table `candidate_education`
--
ALTER TABLE `candidate_education`
  ADD PRIMARY KEY (`candidate_education_id`);

--
-- Indexes for table `candidate_experience`
--
ALTER TABLE `candidate_experience`
  ADD PRIMARY KEY (`candidate_experience_id`);

--
-- Indexes for table `candidate_filter`
--
ALTER TABLE `candidate_filter`
  ADD PRIMARY KEY (`candidate_filter_id`);

--
-- Indexes for table `candidate_jobs`
--
ALTER TABLE `candidate_jobs`
  ADD PRIMARY KEY (`candidate_job_id`);

--
-- Indexes for table `candidate_project`
--
ALTER TABLE `candidate_project`
  ADD PRIMARY KEY (`candidate_project_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `company_candidate_jobtype`
--
ALTER TABLE `company_candidate_jobtype`
  ADD PRIMARY KEY (`jobtype_duration_id`);

--
-- Indexes for table `company_freelancer_jobs`
--
ALTER TABLE `company_freelancer_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `company_history`
--
ALTER TABLE `company_history`
  ADD PRIMARY KEY (`company_history_id`);

--
-- Indexes for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`freelancer_id`);

--
-- Indexes for table `freelancer_certification`
--
ALTER TABLE `freelancer_certification`
  ADD PRIMARY KEY (`freelancer_certification_id`);

--
-- Indexes for table `freelancer_education`
--
ALTER TABLE `freelancer_education`
  ADD PRIMARY KEY (`freelancer_education_id`);

--
-- Indexes for table `freelancer_experience`
--
ALTER TABLE `freelancer_experience`
  ADD PRIMARY KEY (`freelancer_experience_id`);

--
-- Indexes for table `freelancer_feedback`
--
ALTER TABLE `freelancer_feedback`
  ADD PRIMARY KEY (`freelancer_feedback_id`);

--
-- Indexes for table `freelancer_filter`
--
ALTER TABLE `freelancer_filter`
  ADD PRIMARY KEY (`freelancer_filter_id`);

--
-- Indexes for table `freelancer_jobs`
--
ALTER TABLE `freelancer_jobs`
  ADD PRIMARY KEY (`freelancer_job_id`);

--
-- Indexes for table `freelancer_jobs_message`
--
ALTER TABLE `freelancer_jobs_message`
  ADD PRIMARY KEY (`freelancer_job_message_id`);

--
-- Indexes for table `freelancer_milestones`
--
ALTER TABLE `freelancer_milestones`
  ADD PRIMARY KEY (`freelancer_job_milestone_id`);

--
-- Indexes for table `freelancer_milestones_payment`
--
ALTER TABLE `freelancer_milestones_payment`
  ADD PRIMARY KEY (`milestone_payment_id`);

--
-- Indexes for table `freelancer_payment`
--
ALTER TABLE `freelancer_payment`
  ADD PRIMARY KEY (`freelancer_payment_id`);

--
-- Indexes for table `freelancer_project`
--
ALTER TABLE `freelancer_project`
  ADD PRIMARY KEY (`freelancer_project_id`);

--
-- Indexes for table `freelancer_skills`
--
ALTER TABLE `freelancer_skills`
  ADD PRIMARY KEY (`freelancer_skill_id`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`information_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `job_filter`
--
ALTER TABLE `job_filter`
  ADD PRIMARY KEY (`job_filter_id`);

--
-- Indexes for table `job_qualification`
--
ALTER TABLE `job_qualification`
  ADD PRIMARY KEY (`job_qualification_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletter_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `social_profile`
--
ALTER TABLE `social_profile`
  ADD PRIMARY KEY (`social_profile_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`user_activity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_certification`
--
ALTER TABLE `candidate_certification`
  MODIFY `certification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_education`
--
ALTER TABLE `candidate_education`
  MODIFY `candidate_education_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_experience`
--
ALTER TABLE `candidate_experience`
  MODIFY `candidate_experience_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_filter`
--
ALTER TABLE `candidate_filter`
  MODIFY `candidate_filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `candidate_jobs`
--
ALTER TABLE `candidate_jobs`
  MODIFY `candidate_job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_project`
--
ALTER TABLE `candidate_project`
  MODIFY `candidate_project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `company_candidate_jobtype`
--
ALTER TABLE `company_candidate_jobtype`
  MODIFY `jobtype_duration_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_freelancer_jobs`
--
ALTER TABLE `company_freelancer_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT for table `company_history`
--
ALTER TABLE `company_history`
  MODIFY `company_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `freelancer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `freelancer_certification`
--
ALTER TABLE `freelancer_certification`
  MODIFY `freelancer_certification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `freelancer_education`
--
ALTER TABLE `freelancer_education`
  MODIFY `freelancer_education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `freelancer_experience`
--
ALTER TABLE `freelancer_experience`
  MODIFY `freelancer_experience_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `freelancer_feedback`
--
ALTER TABLE `freelancer_feedback`
  MODIFY `freelancer_feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freelancer_filter`
--
ALTER TABLE `freelancer_filter`
  MODIFY `freelancer_filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `freelancer_jobs`
--
ALTER TABLE `freelancer_jobs`
  MODIFY `freelancer_job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `freelancer_jobs_message`
--
ALTER TABLE `freelancer_jobs_message`
  MODIFY `freelancer_job_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `freelancer_milestones`
--
ALTER TABLE `freelancer_milestones`
  MODIFY `freelancer_job_milestone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `freelancer_milestones_payment`
--
ALTER TABLE `freelancer_milestones_payment`
  MODIFY `milestone_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `freelancer_payment`
--
ALTER TABLE `freelancer_payment`
  MODIFY `freelancer_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `freelancer_project`
--
ALTER TABLE `freelancer_project`
  MODIFY `freelancer_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `freelancer_skills`
--
ALTER TABLE `freelancer_skills`
  MODIFY `freelancer_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2514;

--
-- AUTO_INCREMENT for table `job_filter`
--
ALTER TABLE `job_filter`
  MODIFY `job_filter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `job_qualification`
--
ALTER TABLE `job_qualification`
  MODIFY `job_qualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `social_profile`
--
ALTER TABLE `social_profile`
  MODIFY `social_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `user_activity_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
