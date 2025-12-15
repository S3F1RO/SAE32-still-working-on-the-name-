-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+deb13u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 10 déc. 2025 à 13:06
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

-- --------------------------------------------------------

--
-- Structure de la table `tblCompetences`
--

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
(15, 22, 23, 20, '2025-12-01 13:18:28', NULL, 2, ''),
(16, 28, 26, 20, '2025-12-01 13:18:28', '2027-07-01 03:00:00', 1, ''),
(17, 28, 27, 20, '2025-12-01 13:18:28', '2027-07-01 03:00:00', 1, ''),
(18, 28, 25, 20, '2025-12-01 13:18:28', '2025-12-01 12:50:00', 1, ''),
(22, 28, 23, 21, '2025-12-05 17:49:39', NULL, 4, ''),
(23, 28, 23, 21, '2025-12-05 17:49:49', NULL, 4, '');

-- --------------------------------------------------------

--
-- Structure de la table `tblSkills`
--

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
(21, 22, 'Full-stack', '', 'SAE32', 8, NULL, '00ccff', '');

-- --------------------------------------------------------

--
-- Structure de la table `tblUsers`
--

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
(22, 'Lucas', 'Douez Ribal', 'lulupro973', '', ''),
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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tblCompetences`
--
ALTER TABLE `tblCompetences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `tblSkills`
--
ALTER TABLE `tblSkills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `tblUsers`
--
ALTER TABLE `tblUsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
