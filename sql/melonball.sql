-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 12:54 PM
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
-- Database: `melonball`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `quote_lang` text NOT NULL,
  `quote_eng` text NOT NULL,
  `snack` text NOT NULL,
  `part_one_cont` text NOT NULL,
  `part_two_cont` text NOT NULL,
  `dream_job` varchar(255) NOT NULL,
  `hometown` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `first_name`, `last_name`, `quote_lang`, `quote_eng`, `snack`, `part_one_cont`, `part_two_cont`, `dream_job`, `hometown`) VALUES
(105317705, 'Kiahok', 'Ung', 'ដំរី​ជើង​បួន គង់​មាន​ភ្លាត់ អ្នកប្រាជ្ញ​ចេះ​ស្ទាត់ គង់​មាន​ភ្លេច', 'A four-legged elephant can still fall, a wise man who\'s knowledgeable can still forget.', 'Chips', 'Contributed with the website mock up design, header and footer css, jobs.html and css\r\nportion of it. Code for the website consistency and mobile view.', '', 'UX Designer', 'Perth'),
(105671294, 'Jonah', 'Clyde', '日本語: 猿も木から落ちる', 'Even a monkey falls down from trees', 'Ice-cream', 'Contributed towards making the jira as well as organising the sprints. For the webpage, I went into apply.html and apply_styles.css, which is a form for people applying for a job at MelonBall :)', '', 'Software Engineer', 'Melbourne'),
(105739480, 'Duc', 'Vo', 'Nhìn người Việt bay mà không cần cánh kìa!', 'Look at the Vietnamese flying without wings!', 'Bubble Tea', 'Contributed on making about.html and about.css', '', 'Data Scientist', 'Brisbane'),
(105874572, 'James', 'Ralph', '\"Finché c\'è vita c\'è speranza\"', '\"While there\'s life, there\'s hope\"', 'HSP', 'The delegation of duties was also handled by Jonah and me. For our webpage my responsibilities were for the company details(Who is the company, job details etc), the index.html and relevant CSS.', '', 'Audio Director/Programmer', 'Brisbane');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL,
  `job_reference_number` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL COMMENT 'MALE / FEMALE',
  `address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` int(4) NOT NULL,
  `email` text NOT NULL,
  `phone_number` int(12) NOT NULL COMMENT 'Min 8, Max 12',
  `skill_list` text NOT NULL COMMENT 'checkbox inputs',
  `other_skills` text NOT NULL,
  `status` varchar(7) NOT NULL COMMENT 'new / current / final'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
CREATE TABLE users (
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
)
--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_id`);

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
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_listings`
--
ALTER TABLE `job_listings`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
