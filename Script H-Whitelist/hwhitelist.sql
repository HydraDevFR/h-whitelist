-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 20 juin 2022 à 20:21
-- Version du serveur :  10.1.48-MariaDB-0+deb9u2
-- Version de PHP : 7.3.29-1+0~20210701.86+debian9~1.gbp7ad6eb

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `s1757_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `hwhitelist`
--

CREATE TABLE `hwhitelist` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `validation` int(11) NOT NULL DEFAULT '0',
  `prenom` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `heuresteam` varchar(255) NOT NULL,
  `freekill` varchar(255) NOT NULL,
  `carkill` varchar(255) NOT NULL,
  `nopainrp` longtext NOT NULL,
  `nofearp` longtext NOT NULL,
  `situation` longtext NOT NULL,
  `background` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `hwhitelist`
--
ALTER TABLE `hwhitelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `hwhitelist`
--
ALTER TABLE `hwhitelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
