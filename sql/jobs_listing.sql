-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2025 at 09:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs_listing`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_listings`
--

CREATE TABLE `job_listings` (
  `job_id` int(11) NOT NULL,
  `reference_code` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `time_commitment` varchar(50) DEFAULT NULL,
  `salary_range` varchar(50) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `about_the_role` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `reporting_line` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_listings`
--

INSERT INTO `job_listings` (`job_id`, `reference_code`, `title`, `location`, `time_commitment`, `salary_range`, `short_description`, `about_the_role`, `requirements`, `responsibilities`, `reporting_line`) VALUES
(1, 'M1Z2J', 'Environmental Designer', 'Remote or On-site (Hybrid Options Available)', 'Casual', '$70,000 - $90,000 AUD / year (DOE)', 'MelonBall is seeking a talented and imaginative Environmental Designer to help shape the lush, immersive worlds at the heart of our tropical-inspired games. You’ll craft serene and visually striking environments that invite exploration and relaxation, blending stylized artistry with technical design.', 'MelonBall is seeking a talented and imaginative Environmental Designer to help shape the lush, immersive worlds at the heart of our tropical-inspired games. You\'ll craft serene and visually striking environments that invite exploration and relaxation, blending stylized artistry with technical design.', '[\"Experience working on relaxing, exploration-driven, or open-world games\",\r\n\"Background in environmental storytelling or visual narrative design\", \"Familiarity with shader development and foliage systems in Unreal\", \"Understanding of performance optimization techniques for mobile/console\"]', '[\"Design and build immersive outdoor and indoor environments using Unreal Engine\", \"Create level layouts that balance beauty, gameplay flow, and storytelling\", \"Translate 2D concepts into compelling 3D scenes with strong composition and atmosphere\", \"Collaborate with lighting, animation, and VFX teams to achieve cohesive world design\", \"Optimize environments for performance and visual fidelity across platforms\", \"Contribute to environmental storytelling and the overall player journey\", \"Participate in playtests and iterate on feedback to refine world design\"]', 'Reports to the Art Director and collaborates closely with the Level Design and Narrative Teams.'),
(2, 'M3D4VT', 'Unreal Engine & C++ Programmer', 'Remote or On-site (Hybrid Options Available)', 'Casual', '$85,000 – $110,000 USD / year (DOE)', 'MelonBall is looking for a skilled Unreal Engine & C++ Programmer to help bring our peaceful, tropical game worlds to life. You’ll build responsive, elegant systems and gameplay mechanics that feel smooth, intuitive, and deeply immersive.', 'MelonBall is looking for a skilled Unreal Engine & C++ Programmer to help bring our peaceful, tropical game worlds to life. You’ll build responsive, elegant systems and gameplay mechanics that feel smooth, intuitive, and deeply immersive.', '[\"Experience with open-world or sandbox game systems\",\r\n\"Understanding of multiplayer/online features in Unreal\",\r\n\"Familiarity with AI behavior trees and navigation systems\",\r\n\"Passion for chill, exploration-driven games or narrative design\"]', '[\"Develop and maintain gameplay systems in Unreal Engine using C++\",\r\n\"Implement mechanics related to exploration, interaction, and world simulation\",\r\n\"Optimize game code for performance across PC, console, and mobile platforms\",\r\n\"Work closely with designers to prototype and refine new features\",\r\n\"Debug and resolve issues across the codebase\",\r\n\"Assist in integrating art and animation assets into the engine\",\r\n\"Contribute to internal documentation and development tools\"]', 'Reports to the Lead Programmer and collaborates with Design and Art teams.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_listings`
--
ALTER TABLE `job_listings`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `reference_code` (`reference_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_listings`
--
ALTER TABLE `job_listings`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
