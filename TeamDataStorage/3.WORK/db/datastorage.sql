-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+deb13u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 17 déc. 2025 à 17:11
-- Version du serveur : 11.8.3-MariaDB-0+deb13u1 from Debian
-- Version de PHP : 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `datastorage`
--
CREATE DATABASE IF NOT EXISTS `datastorage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `datastorage`;

-- --------------------------------------------------------

--
-- Structure de la table `tblCompetences`
--

DROP TABLE IF EXISTS `tblCompetences`;
CREATE TABLE `tblCompetences` (
  `id` int(11) NOT NULL,
  `idUTeacher` int(11) NOT NULL,
  `idUStudent` int(11) NOT NULL,
  `idSkill` int(11) NOT NULL,
  `beginDate` timestamp NOT NULL,
  `revokedDate` timestamp NULL DEFAULT NULL,
  `masteringLevel` int(11) NOT NULL,
  `competenceInfosHashCryptPrivUT` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblCompetences`
--

INSERT INTO `tblCompetences` (`id`, `idUTeacher`, `idUStudent`, `idSkill`, `beginDate`, `revokedDate`, `masteringLevel`, `competenceInfosHashCryptPrivUT`) VALUES
(13, 28, 22, 21, '2025-12-01 13:18:28', NULL, 4, ''),
(14, 24, 24, 19, '2025-12-01 13:18:28', '2025-12-01 12:50:00', 0, ''),
(15, 22, 23, 20, '2025-12-01 13:18:28', NULL, 2, 'S3j/phbICbuP5KmMH1WHdsYQTMJi8tlQn6HLFPlJh+52nMdVepbfywmCJSau8Y/e/XiUfsDWEe0ZNTQRofI/xJCKda1T4iMpJ7RygATsTNKZYLO6vVzgHNt+FwRECVblTX0Bg5DiyomyJvPhszW7gC+wHsu2TVgCo6PWJghDelYSlEXqEEiLp5TDmo1n6+bz3m8YlOOx1cZYB+FSvRO6ff45PSjOvSzZCxgn/O1ed9rG6tb2bwyidDREkNRnFdHB2QimGvjxaOj7PsObNeFCMBPgK4LlMr9SpQ67G1Jx+JXwmEADDPZjCO+Xp8ZHnNickkuToON8rTv2hUR+Slf2uQ=='),
(16, 28, 26, 20, '2025-12-01 13:18:28', '2027-07-01 03:00:00', 1, ''),
(17, 28, 27, 20, '2025-12-01 13:18:28', '2027-07-01 03:00:00', 1, ''),
(18, 28, 25, 20, '2025-12-01 13:18:28', '2025-12-01 12:50:00', 1, ''),
(22, 28, 23, 21, '2025-12-05 17:49:39', NULL, 4, ''),
(23, 28, 23, 21, '2025-12-05 17:49:49', NULL, 4, '');

-- --------------------------------------------------------

--
-- Structure de la table `tblSkills`
--

DROP TABLE IF EXISTS `tblSkills`;
CREATE TABLE `tblSkills` (
  `id` int(11) NOT NULL,
  `idUCreator` int(11) NOT NULL,
  `mainName` varchar(20) NOT NULL,
  `subName` varchar(20) NOT NULL,
  `domain` varchar(15) NOT NULL,
  `level` int(11) NOT NULL,
  `imgUrl` varchar(100) DEFAULT NULL,
  `color` varchar(6) NOT NULL,
  `skillInfosHashCryptPrivUC` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblSkills`
--

INSERT INTO `tblSkills` (`id`, `idUCreator`, `mainName`, `subName`, `domain`, `level`, `imgUrl`, `color`, `skillInfosHashCryptPrivUC`) VALUES
(19, 28, 'PHP', 'requêtes SQL', 'Web', 0, NULL, 'e4bd52', ''),
(20, 28, 'PHP', '', 'Programmation', 1, NULL, 'e4bd52', ''),
(21, 22, 'Full-stack', '', 'SAE32', 8, NULL, '00ccff', 'fYbj6xzJ2+Kff3B4ZkZR/gPfxFWwRw2pVu8umLwdWgmW4/HNxrlSQXurhLyn7FW0x9Ock0sjuPrK3ZiG+8Uh1btqyjR/e7/IOPxhHlU2oAJ8Vw4wXX5OFVuzUrZbvgKvPnP7Dfvod2qdRCJqRl1Ld4mv6eIK1ZBTuoSbg6msyYFBg0H2n8H7HXVIOy5wFbqoqbO+GVfM0LKmkurnEAHiiW0BYINzazmRF0BMYqL0+gGhIpal5V/kBm/UvYqrQFrj0X+2kKqVKUn0ZBRvtpExexOv9ixW81zhgtID1NJ4iskd3GgqF2r62c0CZpve2+e08RvVoVHIxJUR3iNRFJuzCQ==');

-- --------------------------------------------------------

--
-- Structure de la table `tblUsers`
--

DROP TABLE IF EXISTS `tblUsers`;
CREATE TABLE `tblUsers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `pubU` varchar(2048) NOT NULL,
  `userInfosHashCryptPrivU` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblUsers`
--

INSERT INTO `tblUsers` (`id`, `firstName`, `lastName`, `nickname`, `pubU`, `userInfosHashCryptPrivU`) VALUES
(1, 'MACABOU', 'Benjamin', 'AigleJohn973', '', ''),
(22, 'Lucas', 'Douez Ribal', 'lulupro973', '-----BEGIN (PUBLIC) KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmB8Kn+/YegeCEXGncHvK\nyVdzF749skR0kRkO50j6i8ExWVzzvradR9Cy4GEBwFT5EBc7efC1BtnjtIh+X1qK\nmgSBJm2BSJWP4xAttOHCaJoJVFYIXMe5VQTh6eytMCyv8lUyOiWhwiwgQbgeDO+c\nrHBldPGFWaFBOlsXLNHWeiXLwfnO1APfcVcY/xmRME7IJbOm4g8SV1/jDl3GE/BI\neyrkR+AuOK8KOCKpNyDk9j88o6KjBmhYuxONc65wg+9rkugL3PRwn6ZJ6q7qgc98\nl1XmOop3kz1TbczMnM/N5atBhJDH0t9EWafvTcfpL2SxsRZn1C1xNP3GyE6QvqIu\nqQIDAQAB\n-----END PUBLIC KEY-----', ''),
(23, 'Benjamin', 'Macabou', 'Splenchy', '', ''),
(24, 'Sulyvan', 'Papaya', 'sheyboiii972', '', ''),
(25, 'Kinberly', 'Lauristin', 'Kini', '', ''),
(26, 'Myindia', 'Joseph', 'MJ', '', ''),
(27, 'Stanley', 'Talent', 'Le S', '', ''),
(28, 'Vivien', 'Robinet', 'vone', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tblCompetences`
--
ALTER TABLE `tblCompetences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_idUTeacher` (`idUTeacher`),
  ADD KEY `FK_idUStudent` (`idUStudent`),
  ADD KEY `FK_idSkill` (`idSkill`);

--
-- Index pour la table `tblSkills`
--
ALTER TABLE `tblSkills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_idUCreator` (`idUCreator`);

--
-- Index pour la table `tblUsers`
--
ALTER TABLE `tblUsers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_Nickname` (`nickname`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tblCompetences`
--
ALTER TABLE `tblCompetences`
  ADD CONSTRAINT `FK_idSkill` FOREIGN KEY (`idSkill`) REFERENCES `tblSkills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_idUStudent` FOREIGN KEY (`idUStudent`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_idUTeacher` FOREIGN KEY (`idUTeacher`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tblSkills`
--
ALTER TABLE `tblSkills`
  ADD CONSTRAINT `FK_idUCreator` FOREIGN KEY (`idUCreator`) REFERENCES `tblUsers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
