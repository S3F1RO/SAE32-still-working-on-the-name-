-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+deb13u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 déc. 2025 à 20:46
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
-- Base de données : `data_storage`
--
CREATE DATABASE IF NOT EXISTS `data_storage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `data_storage`;

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
  `currentDate` timestamp NOT NULL,
  `revokedDate` timestamp NULL DEFAULT NULL,
  `masteringLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblCompetences`
--

INSERT INTO `tblCompetences` (`id`, `idUTeacher`, `idUStudent`, `idSkill`, `currentDate`, `revokedDate`, `masteringLevel`) VALUES
(1, 7, 1, 3, '2025-12-01 12:50:00', NULL, 4),
(2, 3, 3, 1, '2025-12-01 12:50:00', '2025-12-01 12:50:00', 0),
(3, 1, 2, 2, '2025-12-01 12:50:00', NULL, 2),
(4, 7, 4, 2, '2025-12-01 12:50:00', '2027-07-01 03:00:00', 1),
(5, 7, 5, 2, '2025-12-01 12:50:00', '2027-07-01 03:00:00', 1),
(6, 7, 6, 2, '2025-12-01 12:50:00', '2025-12-01 12:50:00', 1);

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
  `color` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblSkills`
--

INSERT INTO `tblSkills` (`id`, `idUCreator`, `mainName`, `subName`, `domain`, `level`, `imgUrl`, `color`) VALUES
(1, 7, 'PHP', 'requêtes SQL', 'Web', 0, NULL, 'e4bd52'),
(2, 7, 'PHP', '', 'Programmation', 1, NULL, 'e4bd52'),
(3, 1, 'Full-stack', '', 'SAE32', 8, NULL, '00ccff');

-- --------------------------------------------------------

--
-- Structure de la table `tblUsers`
--

DROP TABLE IF EXISTS `tblUsers`;
CREATE TABLE `tblUsers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblUsers`
--

INSERT INTO `tblUsers` (`id`, `firstName`, `lastName`, `nickname`) VALUES
(1, 'Lucas', 'Douez Ribal', 'lulupro973'),
(2, 'Benjamin', 'Macabou', 'Splenchy'),
(3, 'Sulyvan', 'Papaya', 'sheyboiii972'),
(4, 'Kinberly', 'Lauristin', 'Kini'),
(5, 'Myindia', 'Joseph', 'MJ'),
(6, 'Stanley', 'Talent', 'Le S'),
(7, 'Vivien', 'Robinet', 'vone');

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tblCompetences`
--
ALTER TABLE `tblCompetences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `tblSkills`
--
ALTER TABLE `tblSkills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tblUsers`
--
ALTER TABLE `tblUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tblCompetences`
--
ALTER TABLE `tblCompetences`
  ADD CONSTRAINT `FK_idSkill` FOREIGN KEY (`idSkill`) REFERENCES `tblSkills` (`id`),
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
