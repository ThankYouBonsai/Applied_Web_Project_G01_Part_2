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
  `lang` varchar(100) NOT NULL,
  `lang_html` varchar(20) NOT NULL,
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

INSERT INTO `about` (`id`, `first_name`, `last_name`, `lang`, `lang_html`, `quote_lang`, `quote_eng`, `snack`, `part_one_cont`, `part_two_cont`, `dream_job`, `hometown`) VALUES
(105317705, 'Kiahok', 'Ung', 'Khhmer:', 'km', 'ដំរី​ជើង​បួន គង់​មាន​ភ្លាត់ អ្នកប្រាជ្ញ​ចេះ​ស្ទាត់ គង់​មាន​ភ្លេច', 'A four-legged elephant can still fall, a wise man who\'s knowledgeable can still forget.', 'Chips', 'Contributed with the website mock up design, header and footer css, jobs.html and css\r\nportion of it. Code for the website consistency and mobile view.', 'I contributed with making the database in mySQL for jobs listing making it modular as well as convert the old html format into a while loop PHP format for scalability.', 'UX Designer', 'Perth'),
(105671294, 'Jonah', 'Clyde', 'Japanese:', 'ja', '日本語: 猿も木から落ちる', 'Even a monkey falls down from trees', 'Ice-cream', 'Contributed towards making the jira as well as organising the sprints. For the webpage, I went into apply.html and apply_styles.css, which is a form for people applying for a job at MelonBall :)', 'Setting up the expression of interest (eoi) table, changing apply.php form validation to be on serverside, with further validation for regex and possible sql injections, with query\'s to add the eoi table to the database if it doesn\'t exist, as well as adding a new row to the table when the form is submitted', 'Software Engineer', 'Melbourne'),
(105739480, 'Duc', 'Vo', 'Tiếng Việt:', 'vi', 'Nhìn người Việt bay mà không cần cánh kìa!', 'Look at the Vietnamese flying without wings!', 'Bubble Tea', 'Contributed on making about.html and about.css', 'Creating the manage.php with the login page to manage the data from the eoi sections. Also, I apply hash to make the page more secure.', 'Data Scientist', 'Brisbane'),
(105874572, 'James', 'Ralph', 'Italian:', 'it', '\"Finché c\'è vita c\'è speranza\"', '\"While there\'s life, there\'s hope\"', 'HSP', 'The delegation of duties was also handled by Jonah and me. For our webpage my responsibilities were for the company details(Who is the company, job details etc), the index.html and relevant CSS.', 'Handled the setting up of the repo, header and footer.incs, and was responsible for setting up the about.php in a way that was modular and loaded from mySQL.', 'Audio Director/Programmer', 'Brisbane');


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
(2, 'M3D4VT', 'Unreal Engine & C++ Programmer', 'Remote or On-site (Hybrid Options Available)', 'Casual', '$85,000 – $110,000 AUD / year (DOE)', 'MelonBall is looking for a skilled Unreal Engine & C++ Programmer to help bring our peaceful, tropical game worlds to life. You’ll build responsive, elegant systems and gameplay mechanics that feel smooth, intuitive, and deeply immersive.', 'MelonBall is looking for a skilled Unreal Engine & C++ Programmer to help bring our peaceful, tropical game worlds to life. You’ll build responsive, elegant systems and gameplay mechanics that feel smooth, intuitive, and deeply immersive.', '[\"Experience with open-world or sandbox game systems\",\r\n\"Understanding of multiplayer/online features in Unreal\",\r\n\"Familiarity with AI behavior trees and navigation systems\",\r\n\"Passion for chill, exploration-driven games or narrative design\"]', '[\"Develop and maintain gameplay systems in Unreal Engine using C++\",\r\n\"Implement mechanics related to exploration, interaction, and world simulation\",\r\n\"Optimize game code for performance across PC, console, and mobile platforms\",\r\n\"Work closely with designers to prototype and refine new features\",\r\n\"Debug and resolve issues across the codebase\",\r\n\"Assist in integrating art and animation assets into the engine\",\r\n\"Contribute to internal documentation and development tools\"]', 'Reports to the Lead Programmer and collaborates with Design and Art teams.'),
(3, 'M3D454', 'Gameplay Programmer – Cozy Mechanics & Systems', 'Remote or On-site (Hybrid Options Available)', 'Casual', '$85,000 – $110,000 AUD / year (DOE)', 'MelonBall is searching for a skilled and passionate Gameplay Programmer to bring our innovative game mechanics to life. You’ll be instrumental in developing the core systems that define player interaction, focusing on intuitive, delightful, and robust gameplay experiences for our tropical-themed titles.', 'MelonBall is searching for a skilled and passionate Gameplay Programmer to bring our innovative game mechanics to life. You’ll be instrumental in developing the core systems that define player interaction, focusing on intuitive, delightful, and robust gameplay experiences for our tropical-themed titles.', '[\r\n    \"Experience working on simulation, crafting, or open-world games\",\r\n    \"Familiarity with network programming for multiplayer features\",\r\n    \"Understanding of console and mobile development constraints\",\r\n    \"Contributions to personal or open-source game projects\"\r\n  ]', '[\"Implement, debug, and optimize core gameplay systems and features in Unreal Engine (C++)\",\"Develop intuitive player controls, character abilities, and interaction mechanics\",\"Design and implement AI behaviors for NPCs and wildlife that enhance world immersion\",\"Collaborate with designers to prototype and iterate on new gameplay ideas\",\"Ensure code quality, maintainability, and performance across all platforms\",\"Integrate art assets, animations, and sound effects into gameplay systems\", \"Participate in code reviews and contribute to overall technical best practices\"]', 'Reports to the Lead Programmer and collaborates with Design and Art teams.'),
(6, 'M234', 'UI/UX Designer – Intuitive Player Journeys', 'Remote or On-site (Hybrid Options Available)', 'Casual', '$85,000 – $110,000 AUD / year (DOE)', 'MelonBall is looking for a thoughtful and creative UI/UX Designer to craft seamless and delightful player experiences. You will design elegant interfaces and user flows that complement our game\'s cozy aesthetic, ensuring players can navigate our tropical worlds with ease and joy.', 'MelonBall is looking for a thoughtful and creative UI/UX Designer to craft seamless and delightful player experiences. You will design elegant interfaces and user flows that complement our game\'s cozy aesthetic, ensuring players can navigate our tropical worlds with ease and joy.', '[\r\n    \"Experience designing UI for crafting, management, or simulation games\",\r\n    \"Familiarity with Unreal Engine\'s UMG (Unreal Motion Graphics)\",\r\n    \"Basic understanding of scripting or front-end development\",\r\n    \"Experience with motion graphics or UI animation\"\r\n  ]', '[\r\n    \"Design and prototype intuitive user interfaces (UI) for menus, HUDs, inventory, and other in-game systems\",\r\n    \"Conduct user research, create wireframes, storyboards, and user flows to define user experience (UX)\",\r\n    \"Translate complex gameplay mechanics into clear and understandable visual elements\",\r\n    \"Collaborate with artists to ensure UI visuals align with the game\'s art style\",\r\n    \"Work with programmers to implement and animate UI elements in Unreal Engine\",\r\n    \"Iterate on designs based on playtest feedback and usability testing\",\r\n    \"Contribute to a consistent visual language and design system for all UI elements\"\r\n  ]', 'Reports to the Creative Director and collaborates with the Art, Programming, and Game Design Teams.'),
(8, 'M27AH', 'Technical Artist – Pipelines & Visual Magic', 'Remote or On-site (Hybrid Options Available)', 'Casual', '$80,000 – $100,000 AUD / year (DOE)', 'MelonBall is seeking an innovative Technical Artist to bridge the gap between art and engineering, empowering our creative teams to build stunning tropical worlds. You\'ll optimize asset pipelines, develop custom tools, and ensure our stylized visuals achieve maximum impact and performance within Unreal Engine.', 'MelonBall is seeking an innovative Technical Artist to bridge the gap between art and engineering, empowering our creative teams to build stunning tropical worlds. You\'ll optimize asset pipelines, develop custom tools, and ensure our stylized visuals achieve maximum impact and performance within Unreal Engine.', '[\r\n    \"Experience with procedural content generation tools (e.g., Houdini)\",\r\n    \"Background in environmental art or character art\",\r\n    \"Familiarity with source control systems (e.g., Git, Perforce)\",\r\n    \"Experience in shader development using HLSL/GLSL\"\r\n  ]', '[\r\n    \"Develop and maintain efficient art pipelines and content creation workflows\",\r\n    \"Create and optimize shaders, materials, and VFX within Unreal Engine\",\r\n    \"Provide technical support and training to artists, troubleshoot asset-related issues\",\r\n    \"Implement and refine character rigging, skinning, and animation tools/workflows\",\r\n    \"Develop custom tools and scripts (e.g., Python, C#) to enhance artist productivity\",\r\n    \"Perform performance profiling and optimization for art assets and environments\",\r\n    \"Research and implement new technologies and techniques to improve visual quality\",\r\n    \"Collaborate on establishing technical art standards and best practices\"\r\n  ]', 'Reports to the Art Director and collaborates extensively with all Art, Animation, and Programming Teams.');

CREATE TABLE users (
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
)

ALTER TABLE users MODIFY password VARCHAR(255) NOT NULL;
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
