-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2024 at 10:43 AM
-- Server version: 10.11.6-MariaDB-0+deb12u1-log
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rencontres`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloquer`
--

CREATE TABLE `bloquer` (
  `id` int(11) NOT NULL,
  `id_au` int(11) NOT NULL,
  `id_sig` int(11) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conv`
--

CREATE TABLE `conv` (
  `id` int(11) NOT NULL,
  `id_au` int(11) NOT NULL,
  `id_des` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `conv`
--

INSERT INTO `conv` (`id`, `id_au`, `id_des`) VALUES
(1, 1, 10),
(2, 5, 10),
(3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE `demandes` (
  `id` int(11) NOT NULL,
  `utilisateur` text NOT NULL,
  `date` text NOT NULL,
  `type` text NOT NULL,
  `motif` text NOT NULL,
  `description` text NOT NULL,
  `utilisateur_signaler` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `demandes`
--

INSERT INTO `demandes` (`id`, `utilisateur`, `date`, `type`, `motif`, `description`, `utilisateur_signaler`) VALUES
(1, '1', '2024-06-06 11:33:54', 'message', 'Acte sexuel', '7', '5'),
(2, '1', '2024-06-06 11:34:04', 'message', 'Antisémite', '7', '5'),
(3, '1', '2024-06-06 11:34:05', 'message', 'Violence textuelle', '7', '5'),
(4, '1', '2024-06-06 11:35:44', 'message', 'Acte sexuel', '7', '5'),
(5, '1', '2024-06-06 11:36:32', 'message', 'Acte sexuel', '7', '5'),
(6, '5', '2024-06-06 11:41:50', 'message', 'Acte sexuel', 'sdfsduf', '1'),
(7, '1', '2024-06-06 14:25:42', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(8, '1', '2024-06-06 14:26:19', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(9, '1', '2024-06-06 14:29:27', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(10, '1', '2024-06-06 14:37:52', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(11, '1', '2024-06-06 14:39:16', 'message', 'Acte sexuel', 'dfdf', '5'),
(12, '1', '2024-06-06 14:40:35', 'message', 'Acte sexuel', 'dfdf', '5'),
(13, '1', '2024-06-06 14:41:21', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(14, '1', '2024-06-06 14:41:26', 'message', 'Racisme', 'dfgdfg', '5'),
(15, '1', '2024-06-06 14:44:06', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(16, '1', '2024-06-06 14:45:23', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(17, '1', '2024-06-06 14:46:39', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(18, '1', '2024-06-06 14:47:56', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(19, '1', '2024-06-06 14:54:30', 'message', 'Acte sexuel', 'sdfsduf', '5'),
(20, '1', '2024-06-06 14:54:36', 'message', 'Racisme', 'dfgdfg', '5'),
(21, '1', '2024-06-06 14:55:03', 'message', 'Racisme', 'dfgdfg', '5'),
(22, '1', '2024-06-06 14:55:06', 'message', 'Arnaqueur', 'dfdf', '5');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `nom_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `pseudo`, `nom_image`) VALUES
(1, 'Mathis', 'logo.png'),
(12, 'Mathis', 'image_6661b2358fd2e1.88613521.png'),
(13, 'Mathis', 'image_6661b23bc05e77.73077933.png'),
(14, 'Mathis', 'image_6661b2408fb6e0.91688707.png'),
(15, 'Mathis', 'image_6661b245ab1360.99031911.png'),
(20, 'Makumba', 'image_6662cfc91a4592.25505997.png'),
(21, 'Makumba', 'image_6662d58dbff053.14888247.png'),
(22, 'Killian', 'image_6662e3bf58a589.80757741.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_des` int(11) NOT NULL,
  `id_au` int(11) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_des`, `id_au`, `date`) VALUES
(1, 'mathis', 5, 1, '2024-06-06 15:10:19'),
(2, 'mathis', 5, 1, '2024-06-06 15:10:22'),
(5, 'bono', 5, 1, '2024-06-06 15:26:13'),
(6, 'sdsdsd', 5, 1, '2024-06-06 15:26:16'),
(7, 'sdsd', 5, 1, '2024-06-06 15:26:28'),
(8, 'sdsd', 5, 1, '2024-06-06 15:26:29'),
(10, 'gdfgdfgd', 5, 1, '2024-06-06 15:32:20'),
(17, 'cvxcvx', 5, 1, '2024-06-06 15:37:40'),
(20, 'oui', 1, 5, '2024-06-06 15:39:03'),
(21, 'arepd', 1, 5, '2024-06-06 15:39:18'),
(22, 'gsdqh', 1, 5, '2024-06-06 15:39:21'),
(23, 'fnd,kjkf', 1, 5, '2024-06-06 15:39:25'),
(24, 'arepd', 5, 1, '2024-06-06 15:39:31'),
(25, 'vxcwvcxv', 5, 1, '2024-06-06 15:40:15'),
(26, 'fnd,kjkf', 5, 1, '2024-06-06 15:40:45'),
(27, 'cvbcvb', 5, 1, '2024-06-06 15:40:49'),
(28, 'fnd,kjkf', 5, 1, '2024-06-06 15:41:21'),
(29, 'dfdsfs', 5, 1, '2024-06-06 15:41:24'),
(49, 'oui', 5, 1, '2024-06-06 16:08:09'),
(50, 'arepd', 5, 1, '2024-06-06 16:08:13'),
(55, 'fnd,kjkf', 5, 1, '2024-06-06 16:16:10'),
(56, 'qsdsd', 5, 1, '2024-06-06 16:16:17'),
(57, 'fnd,kjkf', 5, 1, '2024-06-06 16:17:10'),
(58, 'w&lt;x&lt;wx', 5, 1, '2024-06-06 16:17:12'),
(59, 'fnd,kjkf', 5, 1, '2024-06-06 16:17:18'),
(60, '&lt;x&lt;x&lt;x', 5, 1, '2024-06-06 16:17:20'),
(61, 'fnd,kjkf', 5, 1, '2024-06-06 16:30:30'),
(62, 'xcvxc', 5, 1, '2024-06-06 16:30:34'),
(63, 'fnd,kjkf', 5, 1, '2024-06-06 16:32:08'),
(64, 'bonjout', 5, 1, '2024-06-06 16:32:13'),
(65, 'fnd,kjkf', 5, 1, '2024-06-06 16:33:42'),
(66, 'fgdfgfg', 5, 1, '2024-06-06 16:33:47'),
(67, 'oui', 5, 1, '2024-06-06 16:39:57'),
(68, 'dormir', 5, 1, '2024-06-06 16:40:01'),
(69, 'arepd', 5, 1, '2024-06-06 16:41:13'),
(70, 'arepd', 5, 1, '2024-06-06 16:41:30'),
(71, 'wfsdfsdf', 5, 1, '2024-06-06 16:41:34'),
(72, 'arepd', 5, 1, '2024-06-06 16:42:41'),
(73, 'qdqsdqsd', 5, 1, '2024-06-06 16:42:44'),
(74, 'fnd,kjkf', 5, 1, '2024-06-06 16:43:15'),
(75, 'fnd,kjkf', 5, 1, '2024-06-06 16:43:32'),
(76, 'vxvxv', 5, 1, '2024-06-06 16:43:35'),
(77, 'arepd', 5, 1, '2024-06-06 16:43:44'),
(78, 'sdfsdfs', 5, 1, '2024-06-06 16:43:49'),
(79, 'arepd', 5, 1, '2024-06-06 16:44:38'),
(80, 'dgfgdg', 5, 1, '2024-06-06 16:44:41'),
(81, 'oui', 5, 1, '2024-06-06 16:45:18'),
(82, 'sdgsdfgf', 5, 1, '2024-06-06 16:45:21'),
(83, 'oui', 5, 1, '2024-06-06 16:45:33'),
(84, 'fsdfsdfs', 5, 1, '2024-06-06 16:45:36'),
(85, 'fnd,kjkf', 5, 1, '2024-06-06 16:47:02'),
(86, 'fnd,kjkf', 5, 1, '2024-06-06 16:47:27'),
(87, 'fgdfgdfg', 5, 1, '2024-06-06 16:47:30'),
(88, 'erfsefdfsdf', 10, 5, '2024-06-07 08:51:53'),
(89, 'fsdfdsfdsf', 10, 5, '2024-06-07 08:51:56'),
(91, 'mathis', 1, 5, '2024-06-07 08:53:56'),
(92, 'mathis', 1, 5, '2024-06-07 08:54:18'),
(93, 'alo', 10, 1, '2024-06-07 11:11:46'),
(94, 'gdfgdfg', 1, 5, '2024-06-07 12:07:04'),
(95, 'mathis', 1, 5, '2024-06-07 12:08:50'),
(96, 'mathis', 1, 5, '2024-06-07 12:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `mdp` text NOT NULL,
  `age` int(11) NOT NULL,
  `sexe` text NOT NULL,
  `espece` text NOT NULL,
  `race` text NOT NULL,
  `abo` int(11) DEFAULT NULL,
  `fin_abo` text NOT NULL,
  `profil` text NOT NULL,
  `mail` text NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mdp`, `age`, `sexe`, `espece`, `race`, `abo`, `fin_abo`, `profil`, `mail`, `bio`) VALUES
(1, 'Mathis', 'fc5ed9f5c6ffd568bfe3f1b2b2fb5b110a607363', 20, 'Male', 'rat', 'ratton', 1, '32140800', 'Mathis_profil.png', '', ''),
(4, 'Axel', '1902e3d6fc4e78a0bcc50ba12b882769afbf4a8c', 19, 'Male', 'chien', '', 0, '', '', '', ''),
(5, 'Killian', '48181acd22b3edaebc8a447868a7df7ce629920a', 20, 'Male', 'singe', '', 1, '8035200', 'Killian_profil.png', '', ''),
(8, 'Loric', 'd8778db2157374dc4e055a63dc2a04a126c3fd4e', 19, 'Male', 'corbeau', '', 0, 'vide', 'vide', '', ''),
(9, 'Alban', 'ae27872adf6123e023f89a650a6b3c7b96e85fca', 23, 'Male', 'Chien', 'Chien', 0, 'vide', 'vide', '', ''),
(10, 'Makumba', '8b03b1b6c63401b2fd07574e3d1c3a500379d27c', 120, 'Femelle', 'méduse', '', 1, '8035200', 'Makumba_profil.png', '', 'fsdfdsfd'),
(12, 'aze', 'de271790913ea81742b7d31a70d85f50a3d3e5ae', 23, 'Male', 'aze', 'aze', 0, 'vide', 'crabe.jpg', 'aze', 'vide');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloquer`
--
ALTER TABLE `bloquer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conv`
--
ALTER TABLE `conv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloquer`
--
ALTER TABLE `bloquer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conv`
--
ALTER TABLE `conv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
