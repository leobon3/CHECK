-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 04:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_event`
--

CREATE TABLE `calendar_event` (
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_page`
--

CREATE TABLE `calendar_page` (
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_sched`
--

CREATE TABLE `class_sched` (
  `id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `available_status` enum('Available','Occupied') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_upload`
--

CREATE TABLE `file_upload` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(100) NOT NULL,
  `time_stamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_upload`
--

INSERT INTO `file_upload` (`id`, `filename`, `folder_path`, `time_stamp`) VALUES
(1, 'Use Case Diagram.pdf', 'uploads/', '2024-01-11 14:41:05'),
(2, 'Activity-6.docx', 'uploads/', '2024-01-11 14:44:33'),
(4, 'ITEC110-LEC4.pdf', 'uploads/', '2024-01-11 14:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `table_sched`
--

CREATE TABLE `table_sched` (
  `id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `activity` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `available_status` enum('Available','Occupied') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT '''Attendee'', ''Implementor'', ''Admin''',
  `department` varchar(255) NOT NULL DEFAULT 'DIT',
  `image` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `nickname`, `name`, `user_email`, `position`, `password`, `user_type`, `department`, `image`, `status`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(28, 'Kayron', 'Kayron Mark Burzon', 'burzonkayron@cvsu.edu.ph', 'Dean', '$2y$10$H6mlHWM7X3WtbmUdWmRaROq/4PwzTCRLnglPMgfJUmWBMiYXWbdrq', 'Admin', 'DIT', 'Kayron Mark Burzon.png', 0, NULL, NULL),
(29, '', 'Roslyn P. Pena', 'roslyn.pena@cvsu.edu.ph', 'Chairperson', '$2y$10$m53AQY07jWYSDTeLqRWFHuQ/3IOwLOjFxytjL8cU0.A78ozPMYEW6', 'Attendee', 'DCEA', 'Mark.jpg', 0, NULL, NULL),
(30, 'Maria', 'Michael T. Costa', 'michael.costa@cvsu.edu.ph', 'Chairperson', '$2y$10$vdU0LwIcakIENFeqEg1xr.EyveK/w.Z5t1PUyHRmkGnCDfnP0KDQi', 'Implementor', 'DCEE', '', 0, NULL, NULL),
(31, '', 'Fatima B. Zuniga', 'fatima.zuniga@cvsu.edu.ph', 'Chairperson', '$2y$10$Jz3QXZLZrcN6rtfu52lCFeCMAFAmIjZAUfA9Wf2FiP7pzZ1mbt60u', 'Attendee', 'DIET', 'Louise.png', 0, NULL, NULL),
(32, '', 'Charlotte B. Carandang', 'charlotte.carandang@cvsu.edu.ph', 'Chairperson', '$2y$10$uEV81oVoR9WtjBS3fEpOPeVA1m005szT4RG2GGAYCSLOjPnVSeVZK', 'Attendee', 'DIT', '', 0, NULL, NULL),
(33, '', 'Al Owen Roy A. Ferrera', 'roy.ferrera@cvsu.edu.ph', 'Chairperson', '$2y$10$TIFVjjCegvLgZw8Z1EedruINLWWSDFeodtCGtGpr8zWiepW10bdxW', 'Attendee', 'DAFE', '', 0, NULL, NULL),
(34, '', 'Marlon R. Perena', 'marlon.perena@cvsu.edu.ph', 'Officials', '$2y$10$HRlXp1rH4AfoIChC/wtdVeCNTBKOKduDdXkXjkj4joiMD/QV8DX8u', 'Attendee', 'DAFE', '', 0, NULL, NULL),
(35, '', 'Maviric G. Dizon', 'maviric.dizon@cvsu.edu.ph', 'Officials', '$2y$10$HlXVyt.QaatbKfFK2Y4J6ONRhugnINqRKh8w7Qu7yRtGUQt4ajLvC', 'Attendee', 'DAFE', '', 0, NULL, NULL),
(36, '', 'Florence M. Banasihan', 'florence.banasihan@cvsu.edu.ph', 'Officials', '$2y$10$/yxPgXfPjlkbY7lYkFqQK.o3pmvkJXg3xKVtwlYyHfDDXknXBOKaq', 'Attendee', 'DIET', '', 0, NULL, NULL),
(37, '', 'Jake R. Ersando', 'jake.ersando@cvsu.edu.ph', 'Officials', '$2y$10$vhTOc8v7Kc7l/1bKVdleIO9obDJ89hKDD0P4GuUaKEFAMFEkelmaO', 'Attendee', 'DIET', '', 0, NULL, NULL),
(56, '', 'Vanessa G. Coronado', 'vanessa.coronado@cvsu.edu.ph', 'Officials', '$2y$10$8Us6ZyYSMVElr5DrhSY5BubWDAMTRYl6Lk9xr3yRKk6DGuadejEkq', 'Attendee', 'DIT', '', 0, NULL, NULL),
(114, '', 'Ediwn R. Arboleda', 'edwin.arboleda@cvsu.edu.ph', 'Officials', '$2y$10$HOUU8zvqOPlEjuWyqpUkPeO6kO5RFRAC6TPJ/E1jybkrzoNNy3PQG', 'Implementor', 'DCEA', '', 0, NULL, NULL),
(115, '', 'Mark Burzon', 'kayronmark.burzon@cvsu.edu.ph', 'Officials', '$2y$10$yDI6ueNhKmy8OsexGzvHM.2DgdwX9qwIevx7ACZ8F8u7DLwARDYCG', 'Attendee', 'DCEA', '', 0, NULL, NULL),
(116, '', 'Jose Carlo R. Dizon', 'jose.dizon@cvsu.edu.ph', 'Officials', '$2y$10$E0iAtjwJj7tEdHpz33Zi5.zPEDx/PfJJCSLO1RSDTAmoFPzF9psLu', 'Implementor', 'DIT', '', 0, NULL, NULL),
(117, '', 'Ernick R. Romen', 'ernick.romen@cvsu.edu.ph', 'Officials', '$2y$10$a4FITsaJ4F5tbfTYozoYZ.hGOIpGHKVtsnnpW8JqRmSJj53lundHu', 'Implementor', 'DCEA', '', 0, NULL, NULL),
(118, '', 'Efren R. Rocillo', 'efren.rocillo@cvsu.edu.ph', 'Officials', '$2y$10$MAR4JR94qxA7pWJAWp60QuYE8NlTisjq0VXYfl0C788.VOT6T2oMS', 'Implementor', 'DCEE', '', 0, NULL, NULL),
(119, '', 'Poinsettia A. Vida', 'poisettia.vida@cvsu.edu.ph', 'Officials', '$2y$10$1T0Zz46ygJW6v3CCKyz/FOGoJsaBeEpX8BzHPgJtX2ODZVNEnlmOG', 'Implementor', 'DAFE', '', 0, NULL, NULL),
(120, '', 'Anabelle J. Almarez', 'anabelle.almarez@cvsu.edu.ph', 'Officials', '$2y$10$9fA9wVILSf4GRLz/wjxlHuBOi03S2zUh8s27r5mX94y1yRti5sh3q', 'Implementor', 'DIET', '', 0, NULL, NULL),
(121, '', 'Marlon F. Cruzate', 'marlon.cruzate@cvsu.edu.ph', 'Officials', '$2y$10$Z2KTSAek5zqtXDgprf3jeumNrKeSnkIgMZjFDRLIRzH3JA1nE53Eu', 'Implementor', 'DIT', '', 0, NULL, NULL),
(122, '', 'Aiza E. Bihiz', 'aiza.bihiz@cvsu.edu.ph', 'Officials', '$2y$10$JueeJ.y7m9vK9pxUVlT0S.APVD9o90b2Csi9yECelw6V4dVc.N1Re', 'Implementor', 'DCEA', '', 0, NULL, NULL),
(123, '', 'Ria Clarisse M. Sy', 'ria.clarisse@cvsu.edu.ph', 'Officials', '$2y$10$LKbhpGahGoqeZsHp6DWx/.uBf4DdTzQjRmmd47vUOFezY8W0kEjqW', 'Implementor', 'DCEE', '', 0, NULL, NULL),
(124, '', 'Kenn Paolo C. Valero', 'kenn.valero@cvsu.edu.ph', 'Officials', '$2y$10$k24FQKa4e7o37QtmKEaBre7FJj3lAYBliRfqA1d2/7KqVm5xd5WUW', 'Implementor', 'DAFE', '', 0, NULL, NULL),
(125, '', 'John Paulo M. Perido', 'john.perido@cvsu.edu.ph', 'Officials', '$2y$10$tSLcfNyLTyno8eZwz9dWZuShKnzTJWJxG3Tl2jSNutVQ6RglxsNyi', 'Implementor', 'DIET', '', 0, NULL, NULL),
(126, '', 'Cenon D. Lemabad III', 'cenon.lumabad@cvsu.edu.ph', 'Officials', '$2y$10$nX8ksiVvsKDNIRV/m6t7iOs9P7BPigZvYOLVJOHVCaBTQGGW7n6FK', 'Implementor', 'DIET', '', 0, NULL, NULL),
(127, '', 'Gladys G. Perey', 'gladys.perey@cvsu.edu.ph', 'Officials', '$2y$10$qhgEHnvE5TfkNrlsl/fo4O2LhCP7gavHnTJdevUyJf1Bo5zSWdEa.', 'Implementor', 'DIT', '', 0, NULL, NULL),
(128, '', 'Andy A. Dizon', 'andy.dizon@cvsu.edu.ph', 'Officials', '$2y$10$pXAmuZ0dHA1iWyo2jgTjrOoriMG0ku1M0pNT8zMV80TFxg/rFA7kW', 'Implementor', 'DCEA', '', 0, NULL, NULL),
(129, '', 'Simeon Daez', 'simeon.daez@cvsu.edu.ph', 'Officials', '$2y$10$F1cZIfAgQb.LyyeOfBcOyuQMWkomIKK/yPlkJwvWP7TD6o9oZlEHS', 'Implementor', 'DCEE', '', 0, NULL, NULL),
(130, '', 'Ezra Marie F. Ramos', 'ezra.ramos@cvsu.edu.ph', 'Officials', '$2y$10$3P7/0NoBC7zwT9Sqv7Wr2epjXwk/oCCUyj4s50J2E854CVE26pFx6', 'Implementor', 'DIET', '', 0, NULL, NULL),
(131, '', 'Bernard A. Rojas', 'bernard.rojas@cvsu.edu.ph', 'Officials', '$2y$10$8wgQ2xhpIvEKyTzIogzkR./DZWgCZ4goxSFKg7WFezyiqBLDiZ1ee', 'Implementor', 'DIT', '', 0, NULL, NULL),
(132, '', 'Bea Diago', 'beabianca.diago@cvsu.edu.ph', 'Officials', '$2y$10$CztufG3VSyP1prNb8dP5Qe1MI.LJWjGEEUx.S0h.0LwY4SaR40CtG', 'Implementor', 'DIT', '', 0, NULL, NULL),
(134, 'Bon', 'Leobon', 'leobon33@gmail.com', 'Official', '123123', '\'Attendee\', \'Implementor\', \'Admin\'', 'DIT', '', 0, NULL, NULL),
(135, '', 'Leo Bon Tan', 'leobon33@gmail.com', 'Official', '$2y$10$NJXMtV/uhqkwpKWZWLu00uAuDDl4093YBHL/YpDiFwyw77QyOV.le', 'Implementor', 'DIT', '', 0, NULL, NULL),
(136, '', '123', '123@g', '', '$2y$10$JcMn.afvMxIjhetBkeTpA.kw2MRENOUCllAdo0.GsoUJK7tGDSHU.', '', '', '', 0, NULL, NULL),
(137, '', '123', '123@g', '', '$2y$10$U9GMicC0ryhJKsC7wgsRVOnWB8KiNZIE/aD/yNM3hVm25NhWzfLU.', '', '', '', 0, NULL, NULL),
(138, '', '123', '123@gmail.com', '', '$2y$10$b8Z4WgSaznlovaPZuGWvHOUSBhxJfGirgfZzmiSKI.pSuw5OsJfWa', 'Admin', 'DIT', '', 0, NULL, NULL),
(139, '', '123', '123@gmail.com', 'Off', '$2y$10$6hHV9vBwQYxu3SM89Ygteu0zBuQxJUNRXNw7DpU01/erRSMPnEzJK', 'Admin', 'DIT', '', 0, NULL, NULL),
(140, 'Leo bon', 'leobon', 'leobon.tan@cvsu.edu.ph', 'Official', '$2y$10$clz4rJgyPz.q.v5OTy9gWeLbw4.2.weckKm3PvSjPU.UNNhCfWIuy', 'Admin', 'DIT', '', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_event`
--
ALTER TABLE `calendar_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `calendar_page`
--
ALTER TABLE `calendar_page`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `class_sched`
--
ALTER TABLE `class_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_sched`
--
ALTER TABLE `table_sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_event`
--
ALTER TABLE `calendar_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `calendar_page`
--
ALTER TABLE `calendar_page`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628;

--
-- AUTO_INCREMENT for table `class_sched`
--
ALTER TABLE `class_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `table_sched`
--
ALTER TABLE `table_sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=722;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
