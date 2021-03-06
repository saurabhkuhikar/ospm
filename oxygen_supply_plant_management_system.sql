-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2021 at 09:36 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2basic`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('booking-request/create', '3', '2021-08-23 03:49:19'),
('booking-request/update', '3', '2021-08-23 03:49:19'),
('booking-request/view', '3', '2021-08-23 03:49:19'),
('cylinder-booking/create', '20', '2021-08-23 06:45:03'),
('cylinder-booking/view', '15', '2021-08-23 03:26:03'),
('cylinder-booking/view', '16', '2021-08-23 03:26:50'),
('cylinder-booking/view', '20', '2021-08-23 06:45:03'),
('cylinder-list/create', '1', '2021-08-23 08:54:34'),
('cylinder-list/create', '2', '2021-08-23 08:37:56'),
('cylinder-list/create', '3', '2021-08-23 03:49:19'),
('cylinder-list/update', '1', '2021-08-23 08:54:34'),
('cylinder-list/update', '2', '2021-08-23 08:37:56'),
('cylinder-list/update', '25', '2021-08-23 01:34:46'),
('cylinder-list/update', '3', '2021-08-23 03:49:20'),
('cylinder-list/view', '1', '2021-08-23 08:54:34'),
('cylinder-list/view', '2', '2021-08-23 08:37:56'),
('cylinder-list/view', '25', '2021-08-23 01:33:53'),
('cylinder-list/view', '3', '2021-08-23 03:49:20'),
('cylinder-type/update', '25', '2021-08-23 01:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('booking-request/create', 4, NULL, NULL, NULL, '2021-08-23 03:20:50', '2021-08-23 03:20:50'),
('booking-request/delete', 4, NULL, NULL, NULL, '2021-08-23 03:22:46', '2021-08-23 03:22:46'),
('booking-request/update', 4, NULL, NULL, NULL, '2021-08-23 03:22:32', '2021-08-23 03:22:32'),
('booking-request/view', 4, NULL, NULL, NULL, '2021-08-23 03:23:36', '2021-08-23 03:23:36'),
('cylinder-booking/create', 3, '', NULL, '', '2021-08-23 03:15:33', '2021-08-23 03:15:33'),
('cylinder-booking/delete', 3, '', NULL, '', '2021-08-23 03:15:38', '2021-08-23 03:15:38'),
('cylinder-booking/update', 3, '', NULL, '', '2021-08-23 03:15:42', '2021-08-23 03:15:42'),
('cylinder-booking/view', 3, '', NULL, '', '2021-08-23 03:16:00', '2021-08-23 03:16:00'),
('cylinder-list/create', 1, '', NULL, '', '2021-08-23 03:13:01', '2021-08-23 03:13:01'),
('cylinder-list/delete', 1, '', NULL, '', '2021-08-23 03:13:07', '2021-08-23 03:13:07'),
('cylinder-list/update', 1, '', NULL, '', '2021-08-23 03:13:12', '2021-08-23 03:13:12'),
('cylinder-list/view', 1, '', NULL, '', '2021-08-23 03:13:16', '2021-08-23 03:13:16'),
('cylinder-type/create', 2, '', NULL, '', '2021-08-23 03:15:47', '2021-08-23 03:15:47'),
('cylinder-type/delete', 2, '', NULL, '', '2021-08-23 03:15:50', '2021-08-23 03:15:50'),
('cylinder-type/update', 2, '', NULL, '', '2021-08-23 03:15:53', '2021-08-23 03:15:53'),
('cylinder-type/view', 2, '', NULL, '', '2021-08-23 03:15:56', '2021-08-23 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=618 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `state_id`) VALUES
(2, 'South Andaman', 32),
(3, 'Nicobar', 32),
(4, 'Adilabad', 1),
(5, 'Anantapur', 1),
(6, 'Chittoor', 1),
(7, 'East Godavari', 1),
(8, 'Guntur', 1),
(9, 'Hyderabad', 1),
(10, 'Kadapa', 1),
(11, 'Karimnagar', 1),
(12, 'Khammam', 1),
(13, 'Krishna', 1),
(14, 'Kurnool', 1),
(15, 'Mahbubnagar', 1),
(16, 'Medak', 1),
(17, 'Nalgonda', 1),
(18, 'Nellore', 1),
(19, 'Nizamabad', 1),
(20, 'Prakasam', 1),
(21, 'Rangareddi', 1),
(22, 'Srikakulam', 1),
(23, 'Vishakhapatnam', 1),
(24, 'Vizianagaram', 1),
(25, 'Warangal', 1),
(26, 'West Godavari', 1),
(27, 'Anjaw', 3),
(28, 'Changlang', 3),
(29, 'East Kameng', 3),
(30, 'Lohit', 3),
(31, 'Lower Subansiri', 3),
(32, 'Papum Pare', 3),
(33, 'Tirap', 3),
(34, 'Dibang Valley', 3),
(35, 'Upper Subansiri', 3),
(36, 'West Kameng', 3),
(37, 'Barpeta', 2),
(38, 'Bongaigaon', 2),
(39, 'Cachar', 2),
(40, 'Darrang', 2),
(41, 'Dhemaji', 2),
(42, 'Dhubri', 2),
(43, 'Dibrugarh', 2),
(44, 'Goalpara', 2),
(45, 'Golaghat', 2),
(46, 'Hailakandi', 2),
(47, 'Jorhat', 2),
(48, 'Karbi Anglong', 2),
(49, 'Karimganj', 2),
(50, 'Kokrajhar', 2),
(51, 'Lakhimpur', 2),
(52, 'Marigaon', 2),
(53, 'Nagaon', 2),
(54, 'Nalbari', 2),
(55, 'North Cachar Hills', 2),
(56, 'Sibsagar', 2),
(57, 'Sonitpur', 2),
(58, 'Tinsukia', 2),
(59, 'Araria', 4),
(60, 'Aurangabad', 4),
(61, 'Banka', 4),
(62, 'Begusarai', 4),
(63, 'Bhagalpur', 4),
(64, 'Bhojpur', 4),
(65, 'Buxar', 4),
(66, 'Darbhanga', 4),
(67, 'Purba Champaran', 4),
(68, 'Gaya', 4),
(69, 'Gopalganj', 4),
(70, 'Jamui', 4),
(71, 'Jehanabad', 4),
(72, 'Khagaria', 4),
(73, 'Kishanganj', 4),
(74, 'Kaimur', 4),
(75, 'Katihar', 4),
(76, 'Lakhisarai', 4),
(77, 'Madhubani', 4),
(78, 'Munger', 4),
(79, 'Madhepura', 4),
(80, 'Muzaffarpur', 4),
(81, 'Nalanda', 4),
(82, 'Nawada', 4),
(83, 'Patna', 4),
(84, 'Purnia', 4),
(85, 'Rohtas', 4),
(86, 'Saharsa', 4),
(87, 'Samastipur', 4),
(88, 'Sheohar', 4),
(89, 'Sheikhpura', 4),
(90, 'Saran', 4),
(91, 'Sitamarhi', 4),
(92, 'Supaul', 4),
(93, 'Siwan', 4),
(94, 'Vaishali', 4),
(95, 'Pashchim Champaran', 4),
(96, 'Bastar', 35),
(97, 'Bilaspur', 35),
(98, 'Dantewada', 35),
(99, 'Dhamtari', 35),
(100, 'Durg', 35),
(101, 'Jashpur', 35),
(102, 'Janjgir-Champa', 35),
(103, 'Korba', 35),
(104, 'Koriya', 35),
(105, 'Kanker', 35),
(106, 'Kawardha', 35),
(107, 'Mahasamund', 35),
(108, 'Raigarh', 35),
(109, 'Rajnandgaon', 35),
(111, 'Surguja', 35),
(112, 'Diu', 29),
(113, 'Daman', 29),
(114, 'Central Delhi', 23),
(115, 'East Delhi', 23),
(116, 'New Delhi', 23),
(117, 'North Delhi', 23),
(118, 'North East Delhi', 23),
(119, 'North West Delhi', 23),
(120, 'South Delhi', 23),
(121, 'South West Delhi', 23),
(122, 'West Delhi', 23),
(123, 'North Goa', 26),
(124, 'South Goa', 26),
(125, 'Ahmedabad', 5),
(126, 'Amreli District', 5),
(127, 'Anand', 5),
(128, 'Banaskantha', 5),
(129, 'Bharuch', 5),
(130, 'Bhavnagar', 5),
(131, 'Dahod', 5),
(132, 'The Dangs', 5),
(133, 'Gandhinagar', 5),
(134, 'Jamnagar', 5),
(135, 'Junagadh', 5),
(136, 'Kutch', 5),
(137, 'Kheda', 5),
(138, 'Mehsana', 5),
(139, 'Narmada', 5),
(140, 'Navsari', 5),
(141, 'Patan', 5),
(142, 'Panchmahal', 5),
(143, 'Porbandar', 5),
(144, 'Rajkot', 5),
(145, 'Sabarkantha', 5),
(146, 'Surendranagar', 5),
(147, 'Surat', 5),
(148, 'Vadodara', 5),
(149, 'Valsad', 5),
(150, 'Ambala', 6),
(151, 'Bhiwani', 6),
(152, 'Faridabad', 6),
(153, 'Fatehabad', 6),
(154, 'Gurgaon', 6),
(155, 'Hissar', 6),
(156, 'Jhajjar', 6),
(157, 'Jind', 6),
(158, 'Karnal', 6),
(159, 'Kaithal', 6),
(160, 'Kurukshetra', 6),
(161, 'Mahendragarh', 6),
(162, 'Mewat', 6),
(163, 'Panchkula', 6),
(164, 'Panipat', 6),
(165, 'Rewari', 6),
(166, 'Rohtak', 6),
(167, 'Sirsa', 6),
(168, 'Sonepat', 6),
(169, 'Yamuna Nagar', 6),
(170, 'Palwal', 6),
(171, 'Bilaspur', 7),
(172, 'Chamba', 7),
(173, 'Hamirpur', 7),
(174, 'Kangra', 7),
(175, 'Kinnaur', 7),
(176, 'Kulu', 7),
(177, 'Lahaul and Spiti', 7),
(178, 'Mandi', 7),
(179, 'Shimla', 7),
(180, 'Sirmaur', 7),
(181, 'Solan', 7),
(182, 'Una', 7),
(183, 'Anantnag', 8),
(184, 'Badgam', 8),
(185, 'Bandipore', 8),
(186, 'Baramula', 8),
(187, 'Doda', 8),
(188, 'Jammu', 8),
(189, 'Kargil', 8),
(190, 'Kathua', 8),
(191, 'Kupwara', 8),
(192, 'Leh', 8),
(193, 'Poonch', 8),
(194, 'Pulwama', 8),
(195, 'Rajauri', 8),
(196, 'Srinagar', 8),
(197, 'Samba', 8),
(198, 'Udhampur', 8),
(199, 'Bokaro', 34),
(200, 'Chatra', 34),
(201, 'Deoghar', 34),
(202, 'Dhanbad', 34),
(203, 'Dumka', 34),
(204, 'Purba Singhbhum', 34),
(205, 'Garhwa', 34),
(206, 'Giridih', 34),
(207, 'Godda', 34),
(208, 'Gumla', 34),
(209, 'Hazaribagh', 34),
(210, 'Koderma', 34),
(211, 'Lohardaga', 34),
(212, 'Pakur', 34),
(213, 'Palamu', 34),
(214, 'Ranchi', 34),
(215, 'Sahibganj', 34),
(216, 'Seraikela and Kharsawan', 34),
(217, 'Pashchim Singhbhum', 34),
(218, 'Ramgarh', 34),
(219, 'Bidar', 9),
(220, 'Belgaum', 9),
(221, 'Bijapur', 9),
(222, 'Bagalkot', 9),
(223, 'Bellary', 9),
(224, 'Bangalore Rural District', 9),
(225, 'Bangalore Urban District', 9),
(226, 'Chamarajnagar', 9),
(227, 'Chikmagalur', 9),
(228, 'Chitradurga', 9),
(229, 'Davanagere', 9),
(230, 'Dharwad', 9),
(231, 'Dakshina Kannada', 9),
(232, 'Gadag', 9),
(233, 'Gulbarga', 9),
(234, 'Hassan', 9),
(235, 'Haveri District', 9),
(236, 'Kodagu', 9),
(237, 'Kolar', 9),
(238, 'Koppal', 9),
(239, 'Mandya', 9),
(240, 'Mysore', 9),
(241, 'Raichur', 9),
(242, 'Shimoga', 9),
(243, 'Tumkur', 9),
(244, 'Udupi', 9),
(245, 'Uttara Kannada', 9),
(246, 'Ramanagara', 9),
(247, 'Chikballapur', 9),
(248, 'Yadagiri', 9),
(249, 'Alappuzha', 10),
(250, 'Ernakulam', 10),
(251, 'Idukki', 10),
(252, 'Kollam', 10),
(253, 'Kannur', 10),
(254, 'Kasaragod', 10),
(255, 'Kottayam', 10),
(256, 'Kozhikode', 10),
(257, 'Malappuram', 10),
(258, 'Palakkad', 10),
(259, 'Pathanamthitta', 10),
(260, 'Thrissur', 10),
(261, 'Thiruvananthapuram', 10),
(262, 'Wayanad', 10),
(263, 'Alirajpur', 11),
(264, 'Anuppur', 11),
(265, 'Ashok Nagar', 11),
(266, 'Balaghat', 11),
(267, 'Barwani', 11),
(268, 'Betul', 11),
(269, 'Bhind', 11),
(270, 'Bhopal', 11),
(271, 'Burhanpur', 11),
(272, 'Chhatarpur', 11),
(273, 'Chhindwara', 11),
(274, 'Damoh', 11),
(275, 'Datia', 11),
(276, 'Dewas', 11),
(277, 'Dhar', 11),
(278, 'Dindori', 11),
(279, 'Guna', 11),
(280, 'Gwalior', 11),
(281, 'Harda', 11),
(282, 'Hoshangabad', 11),
(283, 'Indore', 11),
(284, 'Jabalpur', 11),
(285, 'Jhabua', 11),
(286, 'Katni', 11),
(287, 'Khandwa', 11),
(288, 'Khargone', 11),
(289, 'Mandla', 11),
(290, 'Mandsaur', 11),
(291, 'Morena', 11),
(292, 'Narsinghpur', 11),
(293, 'Neemuch', 11),
(294, 'Panna', 11),
(295, 'Rewa', 11),
(296, 'Rajgarh', 11),
(297, 'Ratlam', 11),
(298, 'Raisen', 11),
(299, 'Sagar', 11),
(300, 'Satna', 11),
(301, 'Sehore', 11),
(302, 'Seoni', 11),
(303, 'Shahdol', 11),
(304, 'Shajapur', 11),
(305, 'Sheopur', 11),
(306, 'Shivpuri', 11),
(307, 'Sidhi', 11),
(308, 'Singrauli', 11),
(309, 'Tikamgarh', 11),
(310, 'Ujjain', 11),
(311, 'Umaria', 11),
(312, 'Vidisha', 11),
(313, 'Ahmednagar', 12),
(314, 'Akola', 12),
(315, 'Amrawati', 12),
(316, 'Aurangabad', 12),
(317, 'Bhandara', 12),
(318, 'Beed', 12),
(319, 'Buldhana', 12),
(320, 'Chandrapur', 12),
(321, 'Dhule', 12),
(322, 'Gadchiroli', 12),
(323, 'Gondiya', 12),
(324, 'Hingoli', 12),
(325, 'Jalgaon', 12),
(326, 'Jalna', 12),
(327, 'Kolhapur', 12),
(328, 'Latur', 12),
(329, 'Mumbai City', 12),
(330, 'Mumbai suburban', 12),
(331, 'Nandurbar', 12),
(332, 'Nanded', 12),
(333, 'Nagpur', 12),
(334, 'Nashik', 12),
(335, 'Osmanabad', 12),
(336, 'Parbhani', 12),
(337, 'Pune', 12),
(338, 'Raigad', 12),
(339, 'Ratnagiri', 12),
(340, 'Sindhudurg', 12),
(341, 'Sangli', 12),
(342, 'Solapur', 12),
(343, 'Satara', 12),
(344, 'Thane', 12),
(345, 'Wardha', 12),
(346, 'Washim', 12),
(347, 'Yavatmal', 12),
(348, 'Bishnupur', 13),
(349, 'Churachandpur', 13),
(350, 'Chandel', 13),
(351, 'Imphal East', 13),
(352, 'Senapati', 13),
(353, 'Tamenglong', 13),
(354, 'Thoubal', 13),
(355, 'Ukhrul', 13),
(356, 'Imphal West', 13),
(357, 'East Garo Hills', 14),
(358, 'East Khasi Hills', 14),
(359, 'Jaintia Hills', 14),
(360, 'Ri-Bhoi', 14),
(361, 'South Garo Hills', 14),
(362, 'West Garo Hills', 14),
(363, 'West Khasi Hills', 14),
(364, 'Aizawl', 15),
(365, 'Champhai', 15),
(366, 'Kolasib', 15),
(367, 'Lawngtlai', 15),
(368, 'Lunglei', 15),
(369, 'Mamit', 15),
(370, 'Saiha', 15),
(371, 'Serchhip', 15),
(372, 'Dimapur', 16),
(373, 'Kohima', 16),
(374, 'Mokokchung', 16),
(375, 'Mon', 16),
(376, 'Phek', 16),
(377, 'Tuensang', 16),
(378, 'Wokha', 16),
(379, 'Zunheboto', 16),
(380, 'Angul', 17),
(381, 'Boudh', 17),
(382, 'Bhadrak', 17),
(383, 'Bolangir', 17),
(384, 'Bargarh', 17),
(385, 'Baleswar', 17),
(386, 'Cuttack', 17),
(387, 'Debagarh', 17),
(388, 'Dhenkanal', 17),
(389, 'Ganjam', 17),
(390, 'Gajapati', 17),
(391, 'Jharsuguda', 17),
(392, 'Jajapur', 17),
(393, 'Jagatsinghpur', 17),
(394, 'Khordha', 17),
(395, 'Kendujhar', 17),
(396, 'Kalahandi', 17),
(397, 'Kandhamal', 17),
(398, 'Koraput', 17),
(399, 'Kendrapara', 17),
(400, 'Malkangiri', 17),
(401, 'Mayurbhanj', 17),
(402, 'Nabarangpur', 17),
(403, 'Nuapada', 17),
(404, 'Nayagarh', 17),
(405, 'Puri', 17),
(406, 'Rayagada', 17),
(407, 'Sambalpur', 17),
(408, 'Subarnapur', 17),
(409, 'Sundargarh', 17),
(410, 'Karaikal', 27),
(411, 'Mahe', 27),
(412, 'Puducherry', 27),
(413, 'Yanam', 27),
(414, 'Amritsar', 18),
(415, 'Bathinda', 18),
(416, 'Firozpur', 18),
(417, 'Faridkot', 18),
(418, 'Fatehgarh Sahib', 18),
(419, 'Gurdaspur', 18),
(420, 'Hoshiarpur', 18),
(421, 'Jalandhar', 18),
(422, 'Kapurthala', 18),
(423, 'Ludhiana', 18),
(424, 'Mansa', 18),
(425, 'Moga', 18),
(426, 'Mukatsar', 18),
(427, 'Nawan Shehar', 18),
(428, 'Patiala', 18),
(429, 'Rupnagar', 18),
(430, 'Sangrur', 18),
(431, 'Ajmer', 19),
(432, 'Alwar', 19),
(433, 'Bikaner', 19),
(434, 'Barmer', 19),
(435, 'Banswara', 19),
(436, 'Bharatpur', 19),
(437, 'Baran', 19),
(438, 'Bundi', 19),
(439, 'Bhilwara', 19),
(440, 'Churu', 19),
(441, 'Chittorgarh', 19),
(442, 'Dausa', 19),
(443, 'Dholpur', 19),
(444, 'Dungapur', 19),
(445, 'Ganganagar', 19),
(446, 'Hanumangarh', 19),
(447, 'Juhnjhunun', 19),
(448, 'Jalore', 19),
(449, 'Jodhpur', 19),
(450, 'Jaipur', 19),
(451, 'Jaisalmer', 19),
(452, 'Jhalawar', 19),
(453, 'Karauli', 19),
(454, 'Kota', 19),
(455, 'Nagaur', 19),
(456, 'Pali', 19),
(457, 'Pratapgarh', 19),
(458, 'Rajsamand', 19),
(459, 'Sikar', 19),
(460, 'Sawai Madhopur', 19),
(461, 'Sirohi', 19),
(462, 'Tonk', 19),
(463, 'Udaipur', 19),
(464, 'East Sikkim', 20),
(465, 'North Sikkim', 20),
(466, 'South Sikkim', 20),
(467, 'West Sikkim', 20),
(468, 'Ariyalur', 21),
(469, 'Chennai', 21),
(470, 'Coimbatore', 21),
(471, 'Cuddalore', 21),
(472, 'Dharmapuri', 21),
(473, 'Dindigul', 21),
(474, 'Erode', 21),
(475, 'Kanchipuram', 21),
(476, 'Kanyakumari', 21),
(477, 'Karur', 21),
(478, 'Madurai', 21),
(479, 'Nagapattinam', 21),
(480, 'The Nilgiris', 21),
(481, 'Namakkal', 21),
(482, 'Perambalur', 21),
(483, 'Pudukkottai', 21),
(484, 'Ramanathapuram', 21),
(485, 'Salem', 21),
(486, 'Sivagangai', 21),
(487, 'Tiruppur', 21),
(488, 'Tiruchirappalli', 21),
(489, 'Theni', 21),
(490, 'Tirunelveli', 21),
(491, 'Thanjavur', 21),
(492, 'Thoothukudi', 21),
(493, 'Thiruvallur', 21),
(494, 'Thiruvarur', 21),
(495, 'Tiruvannamalai', 21),
(496, 'Vellore', 21),
(497, 'Villupuram', 21),
(498, 'Dhalai', 22),
(499, 'North Tripura', 22),
(500, 'South Tripura', 22),
(501, 'West Tripura', 22),
(502, 'Almora', 33),
(503, 'Bageshwar', 33),
(504, 'Chamoli', 33),
(505, 'Champawat', 33),
(506, 'Dehradun', 33),
(507, 'Haridwar', 33),
(508, 'Nainital', 33),
(509, 'Pauri Garhwal', 33),
(510, 'Pithoragharh', 33),
(511, 'Rudraprayag', 33),
(512, 'Tehri Garhwal', 33),
(513, 'Udham Singh Nagar', 33),
(514, 'Uttarkashi', 33),
(515, 'Agra', 23),
(516, 'Allahabad', 23),
(517, 'Aligarh', 23),
(518, 'Ambedkar Nagar', 23),
(519, 'Auraiya', 23),
(520, 'Azamgarh', 23),
(521, 'Barabanki', 23),
(522, 'Badaun', 23),
(523, 'Bagpat', 23),
(524, 'Bahraich', 23),
(525, 'Bijnor', 23),
(526, 'Ballia', 23),
(527, 'Banda', 23),
(528, 'Balrampur', 23),
(529, 'Bareilly', 23),
(530, 'Basti', 23),
(531, 'Bulandshahr', 23),
(532, 'Chandauli', 23),
(533, 'Chitrakoot', 23),
(534, 'Deoria', 23),
(535, 'Etah', 23),
(536, 'Kanshiram Nagar', 23),
(537, 'Etawah', 23),
(538, 'Firozabad', 23),
(539, 'Farrukhabad', 23),
(540, 'Fatehpur', 23),
(541, 'Faizabad', 23),
(542, 'Gautam Buddha Nagar', 23),
(543, 'Gonda', 23),
(544, 'Ghazipur', 23),
(545, 'Gorkakhpur', 23),
(546, 'Ghaziabad', 23),
(547, 'Hamirpur', 23),
(548, 'Hardoi', 23),
(549, 'Mahamaya Nagar', 23),
(550, 'Jhansi', 23),
(551, 'Jalaun', 23),
(552, 'Jyotiba Phule Nagar', 23),
(553, 'Jaunpur District', 23),
(554, 'Kanpur Dehat', 23),
(555, 'Kannauj', 23),
(556, 'Kanpur Nagar', 23),
(557, 'Kaushambi', 23),
(558, 'Kushinagar', 23),
(559, 'Lalitpur', 23),
(560, 'Lakhimpur Kheri', 23),
(561, 'Lucknow', 23),
(562, 'Mau', 23),
(563, 'Meerut', 23),
(564, 'Maharajganj', 23),
(565, 'Mahoba', 23),
(566, 'Mirzapur', 23),
(567, 'Moradabad', 23),
(568, 'Mainpuri', 23),
(569, 'Mathura', 23),
(570, 'Muzaffarnagar', 23),
(571, 'Pilibhit', 23),
(572, 'Pratapgarh', 23),
(573, 'Rampur', 23),
(574, 'Rae Bareli', 23),
(575, 'Saharanpur', 23),
(576, 'Sitapur', 23),
(577, 'Shahjahanpur', 23),
(578, 'Sant Kabir Nagar', 23),
(579, 'Siddharthnagar', 23),
(580, 'Sonbhadra', 23),
(581, 'Sant Ravidas Nagar', 23),
(582, 'Sultanpur', 23),
(583, 'Shravasti', 23),
(584, 'Unnao', 23),
(585, 'Varanasi', 23),
(586, 'Birbhum', 24),
(587, 'Bankura', 24),
(588, 'Bardhaman', 24),
(589, 'Darjeeling', 24),
(590, 'Dakshin Dinajpur', 24),
(591, 'Hooghly', 24),
(592, 'Howrah', 24),
(593, 'Jalpaiguri', 24),
(594, 'Cooch Behar', 24),
(595, 'Kolkata', 24),
(596, 'Malda', 24),
(597, 'Midnapore', 24),
(598, 'Murshidabad', 24),
(599, 'Nadia', 24),
(600, 'North 24 Parganas', 24),
(601, 'South 24 Parganas', 24),
(602, 'Purulia', 24),
(603, 'Uttar Dinajpur', 24),
(604, 'Raipur', 35),
(606, 'Bhilai-Durg', 35),
(607, 'Bilaspur', 35),
(608, 'Rajnandgaon', 35),
(613, 'Jalandhar', 31),
(614, 'Jalandhar', 31),
(615, 'Patiala', 31),
(616, 'Mohali', 31),
(617, 'North and Middle Andaman', 32);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `countryCode`, `name`) VALUES
(1, 'AD', 'Andorra'),
(2, 'AE', 'United Arab Emirates'),
(3, 'AF', 'Afghanistan'),
(4, 'AG', 'Antigua and Barbuda'),
(5, 'AI', 'Anguilla'),
(6, 'AL', 'Albania'),
(7, 'AM', 'Armenia'),
(8, 'AO', 'Angola'),
(9, 'AQ', 'Antarctica'),
(10, 'AR', 'Argentina'),
(11, 'AS', 'American Samoa'),
(12, 'AT', 'Austria'),
(13, 'AU', 'Australia'),
(14, 'AW', 'Aruba'),
(15, 'AX', '??land'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BA', 'Bosnia and Herzegovina'),
(18, 'BB', 'Barbados'),
(19, 'BD', 'Bangladesh'),
(20, 'BE', 'Belgium'),
(21, 'BF', 'Burkina Faso'),
(22, 'BG', 'Bulgaria'),
(23, 'BH', 'Bahrain'),
(24, 'BI', 'Burundi'),
(25, 'BJ', 'Benin'),
(26, 'BL', 'Saint Barth??lemy'),
(27, 'BM', 'Bermuda'),
(28, 'BN', 'Brunei'),
(29, 'BO', 'Bolivia'),
(30, 'BQ', 'Bonaire'),
(31, 'BR', 'Brazil'),
(32, 'BS', 'Bahamas'),
(33, 'BT', 'Bhutan'),
(34, 'BV', 'Bouvet Island'),
(35, 'BW', 'Botswana'),
(36, 'BY', 'Belarus'),
(37, 'BZ', 'Belize'),
(38, 'CA', 'Canada'),
(39, 'CC', 'Cocos [Keeling] Islands'),
(40, 'CD', 'Democratic Republic of the Congo'),
(41, 'CF', 'Central African Republic'),
(42, 'CG', 'Republic of the Congo'),
(43, 'CH', 'Switzerland'),
(44, 'CI', 'Ivory Coast'),
(45, 'CK', 'Cook Islands'),
(46, 'CL', 'Chile'),
(47, 'CM', 'Cameroon'),
(48, 'CN', 'China'),
(49, 'CO', 'Colombia'),
(50, 'CR', 'Costa Rica'),
(51, 'CU', 'Cuba'),
(52, 'CV', 'Cape Verde'),
(53, 'CW', 'Curacao'),
(54, 'CX', 'Christmas Island'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DE', 'Germany'),
(58, 'DJ', 'Djibouti'),
(59, 'DK', 'Denmark'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'DZ', 'Algeria'),
(63, 'EC', 'Ecuador'),
(64, 'EE', 'Estonia'),
(65, 'EG', 'Egypt'),
(66, 'EH', 'Western Sahara'),
(67, 'ER', 'Eritrea'),
(68, 'ES', 'Spain'),
(69, 'ET', 'Ethiopia'),
(70, 'FI', 'Finland'),
(71, 'FJ', 'Fiji'),
(72, 'FK', 'Falkland Islands'),
(73, 'FM', 'Micronesia'),
(74, 'FO', 'Faroe Islands'),
(75, 'FR', 'France'),
(76, 'GA', 'Gabon'),
(77, 'GB', 'United Kingdom'),
(78, 'GD', 'Grenada'),
(79, 'GE', 'Georgia'),
(80, 'GF', 'French Guiana'),
(81, 'GG', 'Guernsey'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GL', 'Greenland'),
(85, 'GM', 'Gambia'),
(86, 'GN', 'Guinea'),
(87, 'GP', 'Guadeloupe'),
(88, 'GQ', 'Equatorial Guinea'),
(89, 'GR', 'Greece'),
(90, 'GS', 'South Georgia and the South Sandwich Islands'),
(91, 'GT', 'Guatemala'),
(92, 'GU', 'Guam'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HK', 'Hong Kong'),
(96, 'HM', 'Heard Island and McDonald Islands'),
(97, 'HN', 'Honduras'),
(98, 'HR', 'Croatia'),
(99, 'HT', 'Haiti'),
(100, 'HU', 'Hungary'),
(101, 'ID', 'Indonesia'),
(102, 'IE', 'Ireland'),
(103, 'IL', 'Israel'),
(104, 'IM', 'Isle of Man'),
(105, 'IN', 'India'),
(106, 'IO', 'British Indian Ocean Territory'),
(107, 'IQ', 'Iraq'),
(108, 'IR', 'Iran'),
(109, 'IS', 'Iceland'),
(110, 'IT', 'Italy'),
(111, 'JE', 'Jersey'),
(112, 'JM', 'Jamaica'),
(113, 'JO', 'Jordan'),
(114, 'JP', 'Japan'),
(115, 'KE', 'Kenya'),
(116, 'KG', 'Kyrgyzstan'),
(117, 'KH', 'Cambodia'),
(118, 'KI', 'Kiribati'),
(119, 'KM', 'Comoros'),
(120, 'KN', 'Saint Kitts and Nevis'),
(121, 'KP', 'North Korea'),
(122, 'KR', 'South Korea'),
(123, 'KW', 'Kuwait'),
(124, 'KY', 'Cayman Islands'),
(125, 'KZ', 'Kazakhstan'),
(126, 'LA', 'Laos'),
(127, 'LB', 'Lebanon'),
(128, 'LC', 'Saint Lucia'),
(129, 'LI', 'Liechtenstein'),
(130, 'LK', 'Sri Lanka'),
(131, 'LR', 'Liberia'),
(132, 'LS', 'Lesotho'),
(133, 'LT', 'Lithuania'),
(134, 'LU', 'Luxembourg'),
(135, 'LV', 'Latvia'),
(136, 'LY', 'Libya'),
(137, 'MA', 'Morocco'),
(138, 'MC', 'Monaco'),
(139, 'MD', 'Moldova'),
(140, 'ME', 'Montenegro'),
(141, 'MF', 'Saint Martin'),
(142, 'MG', 'Madagascar'),
(143, 'MH', 'Marshall Islands'),
(144, 'MK', 'Macedonia'),
(145, 'ML', 'Mali'),
(146, 'MM', 'Myanmar [Burma]'),
(147, 'MN', 'Mongolia'),
(148, 'MO', 'Macao'),
(149, 'MP', 'Northern Mariana Islands'),
(150, 'MQ', 'Martinique'),
(151, 'MR', 'Mauritania'),
(152, 'MS', 'Montserrat'),
(153, 'MT', 'Malta'),
(154, 'MU', 'Mauritius'),
(155, 'MV', 'Maldives'),
(156, 'MW', 'Malawi'),
(157, 'MX', 'Mexico'),
(158, 'MY', 'Malaysia'),
(159, 'MZ', 'Mozambique'),
(160, 'NA', 'Namibia'),
(161, 'NC', 'New Caledonia'),
(162, 'NE', 'Niger'),
(163, 'NF', 'Norfolk Island'),
(164, 'NG', 'Nigeria'),
(165, 'NI', 'Nicaragua'),
(166, 'NL', 'Netherlands'),
(167, 'NO', 'Norway'),
(168, 'NP', 'Nepal'),
(169, 'NR', 'Nauru'),
(170, 'NU', 'Niue'),
(171, 'NZ', 'New Zealand'),
(172, 'OM', 'Oman'),
(173, 'PA', 'Panama'),
(174, 'PE', 'Peru'),
(175, 'PF', 'French Polynesia'),
(176, 'PG', 'Papua New Guinea'),
(177, 'PH', 'Philippines'),
(178, 'PK', 'Pakistan'),
(179, 'PL', 'Poland'),
(180, 'PM', 'Saint Pierre and Miquelon'),
(181, 'PN', 'Pitcairn Islands'),
(182, 'PR', 'Puerto Rico'),
(183, 'PS', 'Palestine'),
(184, 'PT', 'Portugal'),
(185, 'PW', 'Palau'),
(186, 'PY', 'Paraguay'),
(187, 'QA', 'Qatar'),
(188, 'RE', 'R??union'),
(189, 'RO', 'Romania'),
(190, 'RS', 'Serbia'),
(191, 'RU', 'Russia'),
(192, 'RW', 'Rwanda'),
(193, 'SA', 'Saudi Arabia'),
(194, 'SB', 'Solomon Islands'),
(195, 'SC', 'Seychelles'),
(196, 'SD', 'Sudan'),
(197, 'SE', 'Sweden'),
(198, 'SG', 'Singapore'),
(199, 'SH', 'Saint Helena'),
(200, 'SI', 'Slovenia'),
(201, 'SJ', 'Svalbard and Jan Mayen'),
(202, 'SK', 'Slovakia'),
(203, 'SL', 'Sierra Leone'),
(204, 'SM', 'San Marino'),
(205, 'SN', 'Senegal'),
(206, 'SO', 'Somalia'),
(207, 'SR', 'Suriname'),
(208, 'SS', 'South Sudan'),
(209, 'ST', 'S??o Tom?? and Pr??ncipe'),
(210, 'SV', 'El Salvador'),
(211, 'SX', 'Sint Maarten'),
(212, 'SY', 'Syria'),
(213, 'SZ', 'Swaziland'),
(214, 'TC', 'Turks and Caicos Islands'),
(215, 'TD', 'Chad'),
(216, 'TF', 'French Southern Territories'),
(217, 'TG', 'Togo'),
(218, 'TH', 'Thailand'),
(219, 'TJ', 'Tajikistan'),
(220, 'TK', 'Tokelau'),
(221, 'TL', 'East Timor'),
(222, 'TM', 'Turkmenistan'),
(223, 'TN', 'Tunisia'),
(224, 'TO', 'Tonga'),
(225, 'TR', 'Turkey'),
(226, 'TT', 'Trinidad and Tobago'),
(227, 'TV', 'Tuvalu'),
(228, 'TW', 'Taiwan'),
(229, 'TZ', 'Tanzania'),
(230, 'UA', 'Ukraine'),
(231, 'UG', 'Uganda'),
(232, 'UM', 'U.S. Minor Outlying Islands'),
(233, 'US', 'United States'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VA', 'Vatican City'),
(237, 'VC', 'Saint Vincent and the Grenadines'),
(238, 'VE', 'Venezuela'),
(239, 'VG', 'British Virgin Islands'),
(240, 'VI', 'U.S. Virgin Islands'),
(241, 'VN', 'Vietnam'),
(242, 'VU', 'Vanuatu'),
(243, 'WF', 'Wallis and Futuna'),
(244, 'WS', 'Samoa'),
(245, 'XK', 'Kosovo'),
(246, 'YE', 'Yemen'),
(247, 'YT', 'Mayotte'),
(248, 'ZA', 'South Africa'),
(249, 'ZM', 'Zambia'),
(250, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customer_files`
--

DROP TABLE IF EXISTS `customer_files`;
CREATE TABLE IF NOT EXISTS `customer_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cylinder_bookings`
--

DROP TABLE IF EXISTS `cylinder_bookings`;
CREATE TABLE IF NOT EXISTS `cylinder_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `covid_test_result` varchar(20) DEFAULT NULL,
  `covid_test_date` date DEFAULT NULL,
  `cylinder_type_id` int(11) DEFAULT NULL,
  `cylinder_quantity` varchar(20) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_status` varchar(255) DEFAULT 'Incomplete',
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_option` varchar(255) DEFAULT NULL,
  `payment_token` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cylinder_bookings`
--

INSERT INTO `cylinder_bookings` (`id`, `customer_id`, `supplier_id`, `covid_test_result`, `covid_test_date`, `cylinder_type_id`, `cylinder_quantity`, `total_amount`, `order_date`, `order_status`, `payment_id`, `payment_option`, `payment_token`, `payment_status`, `created`, `updated`) VALUES
(35, 15, 2, 'Negative', '2021-08-10', 1, '3', 22050, '2021-08-27', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-08 16:56:50', '2021-08-08 16:56:50'),
(3, 19, 1, 'Negative', '2021-08-06', 2, '4', 42000, '2021-08-05', 'Process', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-05 15:28:47', '2021-08-05 15:28:47'),
(4, 15, 2, 'Negative', '2021-08-17', 1, '2', 14700, '2021-08-13', 'Pending', NULL, 'Online', NULL, NULL, '2021-08-06 18:17:36', '2021-08-06 18:17:36'),
(5, 15, 2, 'Negative', '2021-08-06', 2, '2', 21000, '2021-08-12', 'Process', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 18:21:49', '2021-08-06 18:21:49'),
(6, 15, 1, 'Negative', '2021-08-17', 2, '3', 31500, '2021-08-18', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 19:16:06', '2021-08-06 19:16:06'),
(7, 15, 1, 'Positive', '2021-08-11', 3, '4', 58800, '2021-08-03', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 19:18:21', '2021-08-06 19:18:21'),
(8, 15, 1, 'Positive', '2021-08-11', 3, '4', 58800, '2021-07-30', 'Process', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 19:20:36', '2021-08-06 19:20:36'),
(9, 15, 1, 'Negative', '2021-08-11', 2, '3', 31500, '2021-08-04', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 19:21:57', '2021-08-06 19:21:57'),
(10, 15, 1, 'Positive', '2021-08-23', 1, '3', 25200, '2021-08-02', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 19:24:22', '2021-08-06 19:24:22'),
(11, 15, 1, 'Positive', '2021-08-17', 1, '3', 25200, '2021-08-27', 'Pending', NULL, 'Online', NULL, NULL, '2021-08-06 19:37:11', '2021-08-06 19:37:11'),
(12, 15, 1, 'Negative', '2021-08-05', 2, '3', 31500, '2021-08-26', 'Process', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-06 20:40:53', '2021-08-06 20:40:53'),
(13, 15, 6, 'Negative', '2021-08-17', 3, '2', 31500, '2021-08-12', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 16:43:39', '2021-08-07 16:43:39'),
(14, 15, 6, 'Negative', '2021-08-11', 2, '2', 21000, '2021-08-04', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 16:51:21', '2021-08-07 16:51:21'),
(15, 15, 4, 'Positive', '2021-07-28', 2, '3', 37800, '2021-08-19', 'Process', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 16:53:35', '2021-08-07 16:53:35'),
(16, 15, 4, 'Negative', '2021-08-18', 1, '2', 14700, '2021-09-01', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 16:56:38', '2021-08-07 16:56:38'),
(17, 15, 6, 'Negative', '2021-08-25', 1, '4', 29400, '2021-08-31', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:04:57', '2021-08-07 17:04:57'),
(18, 15, 6, 'Negative', '2021-08-24', 1, '3', 22050, '2021-08-25', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:09:15', '2021-08-07 17:09:15'),
(19, 15, 1, 'Positive', '2021-08-24', 2, '2', 31500, '2021-08-25', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:12:54', '2021-08-07 17:12:54'),
(20, 20, 3, NULL, NULL, 2, '3', NULL, '2021-08-18', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 17:15:35', '2021-08-07 17:15:35'),
(21, 20, 3, 'Positive', '2021-08-16', 2, '3', NULL, '2021-08-12', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 17:15:54', '2021-08-07 17:15:54'),
(22, 20, 2, 'Positive', '2021-08-17', 1, '4', 29400, '2021-08-12', 'Process', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:18:02', '2021-08-07 17:18:02'),
(23, 15, 2, 'Positive', '2021-08-12', 1, '5', 36750, '2021-08-18', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:22:17', '2021-08-07 17:22:17'),
(24, 21, 2, 'Negative', '2021-08-09', 1, '4', 29400, '2021-08-19', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:23:27', '2021-08-07 17:23:27'),
(25, 15, 1, 'Positive', '2021-08-25', 1, '2', 16800, '2021-08-16', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 17:27:33', '2021-08-07 17:27:33'),
(26, 15, 2, 'Positive', '2021-08-04', 1, '3', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 17:49:09', '2021-08-07 17:49:09'),
(27, 15, 2, NULL, NULL, 1, '2', NULL, '2021-08-03', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 17:51:03', '2021-08-07 17:51:03'),
(28, 15, 2, NULL, NULL, 2, '2', NULL, '2021-07-31', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 17:55:13', '2021-08-07 17:55:13'),
(29, 15, 2, NULL, NULL, 1, '2', NULL, '2021-08-10', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 17:56:09', '2021-08-07 17:56:09'),
(30, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-12', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 18:00:20', '2021-08-07 18:00:20'),
(31, 15, 1, 'Negative', '2021-08-17', 1, '2', NULL, '2021-08-10', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-07 18:03:43', '2021-08-07 18:03:43'),
(32, 15, 1, 'Positive', '2021-08-24', 1, '2', 16800, '2021-08-12', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 18:05:59', '2021-08-07 18:05:59'),
(33, 15, 1, 'Positive', '2021-08-09', 3, '1', 14700, '2021-08-10', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 18:07:16', '2021-08-07 18:07:16'),
(34, 20, 6, 'Negative', '2021-08-18', 2, '4', 42000, '2021-08-19', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-07 18:09:21', '2021-08-07 18:09:21'),
(36, 15, 1, 'Positive', '2021-08-10', 1, '4', 29400, '2021-08-17', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-08 17:00:15', '2021-08-08 17:00:15'),
(37, 15, 1, 'Positive', '2021-08-16', 2, '3', 37800, '2021-08-26', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-08 17:01:28', '2021-08-08 17:01:28'),
(38, 15, 2, 'Negative', '2021-08-17', 2, '3', 47250, '2021-08-19', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-08 21:18:35', '2021-08-08 21:18:35'),
(39, 15, 2, 'Positive', '2021-08-24', 2, '2', 31500, '2021-08-17', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 00:38:37', '2021-08-09 00:38:37'),
(40, 15, 2, 'Positive', '2021-08-09', 1, '4', 29400, '2021-08-04', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-09 00:42:09', '2021-08-09 00:42:09'),
(41, 15, 2, NULL, NULL, 2, '3', NULL, '2021-07-30', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 00:47:00', '2021-08-09 00:47:00'),
(42, 15, 1, NULL, NULL, 3, '3', NULL, '2021-07-27', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 00:48:30', '2021-08-09 00:48:30'),
(43, 15, 1, 'Positive', '2021-08-01', 1, '3', 22050, '2021-08-26', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-09 00:49:07', '2021-08-09 00:49:07'),
(44, 15, 1, 'Negative', '2021-08-02', 2, '3', 37800, '2021-07-29', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-09 00:54:11', '2021-08-09 00:54:11'),
(45, 15, 1, 'Negative', '2021-08-17', 1, '4', 29400, '2021-08-13', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-09 01:11:16', '2021-08-09 01:11:16'),
(46, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-07', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:36:25', '2021-08-09 17:36:25'),
(47, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-07', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:36:46', '2021-08-09 17:36:46'),
(48, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-25', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:39:38', '2021-08-09 17:39:38'),
(49, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-25', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:39:42', '2021-08-09 17:39:42'),
(50, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-10', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:40:12', '2021-08-09 17:40:12'),
(51, 15, 2, NULL, NULL, 2, '4', NULL, '2021-08-10', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:40:18', '2021-08-09 17:40:18'),
(52, 15, 2, NULL, NULL, 2, '3', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:43:44', '2021-08-09 17:43:44'),
(53, 15, 2, NULL, NULL, 2, '3', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:43:54', '2021-08-09 17:43:54'),
(54, 15, 2, NULL, NULL, 2, '3', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:49:56', '2021-08-09 17:49:56'),
(55, 15, 2, NULL, NULL, 1, '3', NULL, '2021-08-13', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:50:15', '2021-08-09 17:50:15'),
(56, 15, 2, NULL, NULL, 1, '3', NULL, '2021-08-13', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:50:19', '2021-08-09 17:50:19'),
(57, 15, 2, NULL, NULL, 1, '1', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:53:31', '2021-08-09 17:53:31'),
(58, 15, 2, NULL, NULL, 1, '1', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:53:35', '2021-08-09 17:53:35'),
(59, 15, 2, NULL, NULL, 2, '3', NULL, '2021-08-19', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:56:12', '2021-08-09 17:56:12'),
(60, 15, 2, NULL, NULL, 2, '3', NULL, '2021-08-19', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:56:13', '2021-08-09 17:56:13'),
(61, 15, 2, NULL, NULL, 1, '4', NULL, '2021-07-30', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:58:13', '2021-08-09 17:58:13'),
(62, 15, 2, NULL, NULL, 1, '4', NULL, '2021-07-30', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:58:15', '2021-08-09 17:58:15'),
(63, 15, 2, NULL, NULL, 1, '2', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:58:58', '2021-08-09 17:58:58'),
(64, 15, 2, NULL, NULL, 1, '2', NULL, '2021-08-05', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 17:59:00', '2021-08-09 17:59:00'),
(65, 15, 2, NULL, NULL, 1, '4', NULL, '2021-08-13', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 18:02:44', '2021-08-09 18:02:44'),
(66, 15, 2, NULL, NULL, 2, '3', NULL, '2021-07-30', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 18:03:34', '2021-08-09 18:03:34'),
(67, 15, 2, NULL, NULL, 2, '3', NULL, '2021-07-30', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 18:05:22', '2021-08-09 18:05:22'),
(68, 15, 2, NULL, NULL, 2, '3', NULL, '2021-07-29', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 18:11:04', '2021-08-09 18:11:04'),
(69, 15, 2, NULL, NULL, 2, '3', NULL, '2021-07-29', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 18:14:36', '2021-08-09 18:14:36'),
(70, 15, 2, NULL, NULL, 2, '2', NULL, '2021-07-29', 'Incomplete', NULL, NULL, NULL, NULL, '2021-08-09 18:17:00', '2021-08-09 18:17:00'),
(71, 15, 1, 'Negative', '2021-08-18', 2, '4', 50400, '2021-08-12', 'Pending', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-09 18:45:33', '2021-08-09 18:45:33'),
(72, 21, 4, 'Negative', '2021-08-18', 2, '4', 50400, '2021-08-27', 'Delivered', NULL, 'Cash on Delivery', NULL, NULL, '2021-08-09 20:01:25', '2021-08-09 20:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `cylinder_lists`
--

DROP TABLE IF EXISTS `cylinder_lists`;
CREATE TABLE IF NOT EXISTS `cylinder_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cylinder_type_id` int(11) DEFAULT NULL,
  `cylinder_quantity` varchar(255) DEFAULT NULL,
  `selling_price` float NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cylinder_lists`
--

INSERT INTO `cylinder_lists` (`id`, `user_id`, `cylinder_type_id`, `cylinder_quantity`, `selling_price`, `created`, `updated`) VALUES
(1, 1, 1, '16', 7000, '2021-07-24 12:39:19', '2021-08-08 16:04:16'),
(2, 1, 2, '40', 12000, '2021-07-24 12:40:50', '2021-08-08 16:05:56'),
(3, 1, 3, '20', 15000, '2021-07-24 12:44:43', '2021-08-08 16:05:16'),
(4, 2, 1, '31', 7000, '2021-07-26 13:43:39', '2021-08-09 19:56:54'),
(5, 2, 2, '21', 15000, '2021-07-26 13:44:03', '2021-08-08 16:11:08'),
(6, 2, 3, '40', 15000, '2021-07-26 13:44:17', '2021-07-26 13:44:17'),
(7, 4, 1, '39', 7000, '2021-07-26 14:10:24', '2021-07-27 13:05:33'),
(8, 4, 2, '16', 12000, '2021-07-26 14:10:52', '2021-08-09 20:02:35'),
(9, 4, 3, '50', 15000, '2021-07-26 14:11:12', '2021-07-26 14:11:22'),
(10, 6, 1, '23', 7000, '2021-08-06 19:54:04', '2021-08-06 19:54:04'),
(11, 6, 2, '11', 10000, '2021-08-06 20:11:45', '2021-08-06 20:12:08'),
(12, 6, 3, '21', 15000, '2021-08-06 20:13:50', '2021-08-06 20:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `cylinder_types`
--

DROP TABLE IF EXISTS `cylinder_types`;
CREATE TABLE IF NOT EXISTS `cylinder_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `litre_quantity` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cylinder_types`
--

INSERT INTO `cylinder_types` (`id`, `litre_quantity`, `label`, `created`, `updated`) VALUES
(1, 5, 'litre', '2012-02-10 18:30:00', '2021-02-20 18:30:00'),
(2, 10, 'litre', '2021-07-24 12:32:41', '2021-07-24 12:32:41'),
(3, 15, 'litre', '2021-07-24 12:32:51', '2021-07-24 12:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `gst_table`
--

DROP TABLE IF EXISTS `gst_table`;
CREATE TABLE IF NOT EXISTS `gst_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gst` float NOT NULL,
  `sgst` float NOT NULL,
  `cgst` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gst_table`
--

INSERT INTO `gst_table` (`id`, `gst`, `sgst`, `cgst`) VALUES
(1, 5, 2.5, 2.5);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `country_id`) VALUES
(1, 'ANDHRA PRADESH', 105),
(2, 'ASSAM', 105),
(3, 'ARUNACHAL PRADESH', 105),
(4, 'BIHAR', 105),
(5, 'GUJRAT', 105),
(6, 'HARYANA', 105),
(7, 'HIMACHAL PRADESH', 105),
(8, 'JAMMU & KASHMIR', 105),
(9, 'KARNATAKA', 105),
(10, 'KERALA', 105),
(11, 'MADHYA PRADESH', 105),
(12, 'MAHARASHTRA', 105),
(13, 'MANIPUR', 105),
(14, 'MEGHALAYA', 105),
(15, 'MIZORAM', 105),
(16, 'NAGALAND', 105),
(17, 'ORISSA', 105),
(18, 'PUNJAB', 105),
(19, 'RAJASTHAN', 105),
(20, 'SIKKIM', 105),
(21, 'TAMIL NADU', 105),
(22, 'TRIPURA', 105),
(23, 'UTTAR PRADESH', 105),
(24, 'WEST BENGAL', 105),
(26, 'GOA', 105),
(27, 'PONDICHERY', 105),
(28, 'LAKSHDWEEP', 105),
(29, 'DAMAN & DIU', 105),
(30, 'DADRA & NAGAR', 105),
(31, 'CHANDIGARH', 105),
(32, 'ANDAMAN & NICOBAR', 105),
(33, 'UTTARANCHAL', 105),
(34, 'JHARKHAND', 105),
(35, 'CHATTISGARH', 105);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_files`
--

DROP TABLE IF EXISTS `supplier_files`;
CREATE TABLE IF NOT EXISTS `supplier_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_files`
--

INSERT INTO `supplier_files` (`id`, `supplier_id`, `file_name`) VALUES
(1, 1, 'cylinderStatusLists1.pdf'),
(2, 2, 'cylinderStatusLists2.pdf'),
(3, 4, 'cylinderStatusLists4.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `phone_number` bigint(10) UNSIGNED ZEROFILL NOT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `identity_proof` varchar(255) DEFAULT NULL,
  `identity_proof_type` varchar(255) DEFAULT NULL,
  `aadhar_card_number` varchar(12) DEFAULT NULL,
  `account_type` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created` timestamp NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `auth_key`, `phone_number`, `age`, `gender`, `address`, `state`, `city`, `company_name`, `profile_picture`, `identity_proof`, `identity_proof_type`, `aadhar_card_number`, `account_type`, `status`, `created`, `updated`) VALUES
(1, 'SAURABH', 'KUHIKAR', 'saurabhkuhikar6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'OSdccQVQDmWFLWWd90Q4zryhl1vP1xOV', 0958991475, 25, 'female', 'xyz', 'GUJRAT', 'Ahmedabad', 'sk oxygen supply pvt', '1626414936.jpg', 'Ration Card with address', NULL, '147852369852', 'Supplier', 'Enabled', '2021-07-11 21:53:01', '2021-07-11 21:53:01'),
(2, 'Nandini', 'k', 'nandinikose@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'mIaJ1lL-6nOKPnq93J9CMqSxWvDTzS2R', 9157991475, 23, 'female', 'snansna', 'MAHARASHTRA', 'Nagpur', 'nandini oxygen supply pvt', 'avatar.png', 'Passport', NULL, '145215625874', 'Supplier', 'Enabled', '2021-07-11 21:55:07', '2021-07-11 21:55:07'),
(3, 'Palash', 'kuhikar', 'palash@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Kl07Z5Sgs_h5PHJczyP6qu_d9_Sqmlmh', 1234567890, NULL, 'male', 'old mumbai', 'MAHARASHTRA', 'Nagpur', 'Palash oxygen supply management', '1626415014.jpg', NULL, NULL, '154796322541', 'Supplier', 'Enabled', '2021-07-11 22:01:32', '2021-07-11 22:01:32'),
(4, 'Harsh', 'kk', 'harsh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'ECSYWzdmQtJmhhDgAuWswEHRxLfZ1pfn', 1246250147, 23, 'male', 'home', 'MAHARASHTRA', 'Nagpur', 'Harsh oxygen supply', 'avatar.png', 'Adhaar card(UID)', NULL, '012654875692', 'Supplier', 'Enabled', '2021-07-11 22:02:56', '2021-07-11 22:02:56'),
(5, 'Sahil ', 'sahil', 'sahil@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0ZIHfGaVQfGLj_YKiAVNJXjzme2bD40R', 1596321048, NULL, 'male', 'sjdhfvbdhv', 'ARUNACHAL PRADESH', 'Lower Subansiri', 'oxygen cylinder supplier', 'avatar.png', 'Driving License', NULL, '021547985201', 'Supplier', 'Enabled', '2021-07-11 22:04:32', '2021-07-11 22:04:32'),
(6, 'Nikita', 'nikita', 'Nikita@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e-fNhCPu5kH35voe8oGVHogc1CTPEg3j', 1596320158, 25, 'female', 'abc', 'JHARKHAND', 'Deoghar', 'oxygen supplier', 'avatar.png', 'Pan Card', NULL, '145879021456', 'Supplier', 'Enabled', '2021-07-11 22:06:05', '2021-07-11 22:06:05'),
(7, 'Animesh', 'Gupta', 'animesh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'gds85yq3HNujuYFdX9LqnUvm-NQdTuQR', 1450369874, 52, 'male', 'abcddh', 'PUNJAB', 'Amritsar', 'oxygen cylinder supplier pvt', 'avatar.png', 'Ration Card with address', NULL, '012547996355', 'Supplier', 'Enabled', '2021-07-11 22:07:48', '2021-07-11 22:07:48'),
(8, 'Seeta', 'Seeta', 'seeta@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'eaU6Mhxg-DlJah08AY1zx0byxar-nSbh', 1032547895, NULL, 'female', 'mamssjeue', 'WEST BENGAL', 'Kolkata', 'oxygen supplier', 'avatar.png', 'Passport', NULL, '012459856281', 'Supplier', 'Enabled', '2021-07-11 22:09:11', '2021-07-11 22:09:11'),
(9, 'Geeta', 'geeta', 'geeta@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'vzWwzsdaWDC6PF6QF-XGpd3vAvC3Ei7_', 0124587152, NULL, 'female', 'ncbhgd', 'MAHARASHTRA', 'Nagpur', 'Geeta oxygen cylinders', 'avatar.png', 'Ration Card with address', NULL, '015489361457', 'Supplier', 'Enabled', '2021-07-11 22:11:45', '2021-07-11 22:11:45'),
(10, 'Seema', 'Seema', 'seema@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'UDizgycPT7W0B1o83w83Zy9I9xljqbUS', 5155444232, NULL, 'female', 'efear', 'MEGHALAYA', 'Anantapur', 'Oxygen supplier pvt', 'avatar.png', 'Passport', NULL, '444554656489', 'Supplier', 'Enabled', '2021-07-11 22:13:27', '2021-07-11 22:13:27'),
(11, 'Kavita', 'kk', 'kavita@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'z4dxwhfGxC1FzV5lBJMPlt1nJRzmMnlD', 7788952014, NULL, 'female', 'saekdfefbe', 'CHANDIGARH', 'Patiala', 'cylinder management of oxygen', 'avatar.png', 'Passport', NULL, '012657895210', 'Supplier', 'Enabled', '2021-07-11 22:15:06', '2021-07-11 22:15:06'),
(12, 'ragini', 'ragini', 'ragini@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'jdOGeDCjdqF4s_XnEZHCB_9BTiSX13Hw', 1024589631, NULL, 'female', 'zbcbchdkjds', 'PUNJAB', 'Amritsar', 'oxygen cylinder supplier', 'avatar.png', NULL, NULL, '012457896401', 'Supplier', 'Enabled', '2021-07-13 02:44:49', '2021-07-13 02:44:49'),
(13, 'harshda', 'harshda', 'harshda@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'vQMsTWEaWLhi1Wz2ylSKsgeNMqmTGEIe', 0125478963, NULL, 'female', 'asfestf', 'PUNJAB', 'Amritsar', 'oxygen supplier management', 'avatar.png', NULL, NULL, '012547985320', 'Supplier', 'Enabled', '2021-07-13 03:11:58', '2021-07-13 03:11:58'),
(14, 'Rushika', 'rushika', 'rushika@gmaiil.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ii8fcCZI7tYmdvMwA6yqAE_bh8sQzz_t', 1203654789, 21, 'female', 'dhfudfgv', 'KERALA', 'Idukki', 'oxygen supply ', 'avatar.png', 'Driving License', NULL, '012459876320', 'Supplier', 'Enabled', '2021-07-14 03:22:39', '2021-07-14 03:22:39'),
(15, 'SAURABH', 'KUHIKAR', 'saurabhkuhikar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'FTXSV2uqvifQM3aKV9xGFjL91rcLbNCG', 1479652385, 24, 'male', 'hgfdcgvgtf', 'CHANDIGARH', 'Patiala', NULL, 'avatar.png', 'Adhaar card(UID)', NULL, '123456790218', 'Customer', 'Enabled', '2021-07-14 04:57:14', '2021-07-14 04:57:14'),
(16, 'sham', 'sundar', 'sham@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'aPRS5kjrvAfFZ6ER9sxZwr048HBFManF', 0236578954, 45, 'male', 'dhgfg', 'TAMIL NADU', 'Chennai', NULL, 'avatar.png', 'Driving License', NULL, '124563842012', 'Customer', 'Enabled', '2021-07-15 22:21:01', '2021-07-15 22:21:01'),
(17, 'IND akhil', 'akhil', 'indakhil@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'H4ms9RWcrj9cdmaGriMiCHHvvAoNj7jd', 7894756123, 85, 'male', 'xscsdvsdsdbd', 'UTTAR PRADESH', 'New Delhi', NULL, 'avatar.png', 'Adhaar card(UID)', NULL, '123456790214', 'Customer', 'Enabled', '2021-07-19 04:56:59', '2021-07-19 04:56:59'),
(18, 'sudhir', 'xyz', 'sudhir@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '3Gu_0wzgM5F-koOIAHuwWTelsXbDkaSr', 1524789520, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-07-20 03:24:44', '2021-07-20 03:24:44'),
(19, 'jay', 'dfhbgfh', 'jay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'bxCd6sLzdVuNth7WIB_iSguF_LR4Zgh4', 1024598745, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-07-20 03:30:27', '2021-07-20 03:30:27'),
(20, 'monish', 'kuhikar', 'monishkuhikar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'g004eG8zqv8zS3V5dNS3zXh0Xcpa4UaG', 4561978312, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-07-20 03:34:53', '2021-07-20 03:34:53'),
(21, 'amol', 'kuhikar', 'amolkuhikar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'W8o8gIH4CtFsMGAztadyr6eBvOlFnrDT', 1597863214, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-07-20 03:39:02', '2021-07-20 03:39:02'),
(22, 'sashank', 'kuhikar', 'shshankkuhikar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'q7g-o-GZTn1W9edLNeT1whgovssI0due', 4578963125, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-07-20 03:46:33', '2021-07-20 03:46:33'),
(23, 'IND', 'Amol', 'indamol@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'aPomuKGKdAfJPdH_s1ddSSEmOZCTeOBq', 4785693214, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-07-20 03:52:16', '2021-07-20 03:52:16'),
(24, 'riya', 'riya', 'riya@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'n_8VhDSTpXijDuAMeU2emNcvC2OH8wsr', 1254023658, NULL, 'female', 'cbcbsv', 'WEST BENGAL', 'Kolkata', 'Oxygen supplier', 'avatar.png', NULL, NULL, '102457896520', 'Supplier', 'Enabled', '2021-07-26 05:17:20', '2021-07-26 05:17:20'),
(25, 'admin', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'fMg8u8hzjn1PaqzoIWs1-dMp4PYysCXs', 1234560036, 25, 'male', 'xyz', 'ARUNACHAL PRADESH', 'East Kameng', 'xyz', 'avatar.png', 'Ration Card with address', NULL, '012365478520', 'Admin', 'Enabled', '2021-08-18 23:55:13', '2021-08-18 23:55:13'),
(26, 'dfgd', 'dfgdf', 'demo12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'L8EuebxkSsuos4pnRz27UKzMDnHjxuZR', 1023548954, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, NULL, NULL, 'Customer', 'Enabled', '2021-08-19 02:47:30', '2021-08-19 02:47:30');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
