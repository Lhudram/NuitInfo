-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 déc. 2017 à 19:37
-- Version du serveur :  5.7.17-log
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nuitinfo`
--

-- --------------------------------------------------------

--
-- Structure de la table `accident`
--

DROP TABLE IF EXISTS `accident`;
CREATE TABLE IF NOT EXISTS `accident` (
  `lattitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `heure` time NOT NULL,
  `nombre` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lattitude`,`longitude`,`type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `idevenement` int(11) NOT NULL,
  `nom_event` varchar(30) NOT NULL,
  `desc_event` varchar(500) DEFAULT NULL,
  `date_event` datetime NOT NULL,
  `idlieu` int(2) NOT NULL,
  PRIMARY KEY (`idevenement`) USING BTREE,
  KEY `idlieu` (`idlieu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `idlieu` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `departement` int(2) NOT NULL,
  PRIMARY KEY (`idlieu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `idutilisateur` int(11) NOT NULL,
  `idevenement` int(11) NOT NULL,
  PRIMARY KEY (`idutilisateur`,`idevenement`),
  KEY `idevenement` (`idevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `estsam` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`idlieu`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`idevenement`) REFERENCES `evenement` (`idevenement`),
  ADD CONSTRAINT `participe_ibfk_3` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
  ADD CONSTRAINT `participe_ibfk_4` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
