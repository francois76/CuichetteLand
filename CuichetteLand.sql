-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 14 Septembre 2017 à 10:44
-- Version du serveur :  5.7.19-0ubuntu0.17.04.1
-- Version de PHP :  7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `CuichetteLand`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admins`
--

CREATE TABLE `Admins` (
  `Identifiants` text NOT NULL,
  `Mot_de_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Produits`
--

CREATE TABLE `Produits` (
  `Identifiant` int(11) NOT NULL,
  `Nom` text NOT NULL,
  `Images` text NOT NULL,
  `Prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Informations sur les produits';

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `Age` int(11) NOT NULL,
  `Mail` text NOT NULL,
  `Numero_telephone` text NOT NULL,
  `Identifiant` text NOT NULL,
  `Mot_de_passe` text NOT NULL,
  `Numero_CB` int(11) NOT NULL,
  `Cryptogramme_CB` int(11) NOT NULL,
  `Date_CB` date NOT NULL,
  `Nom_CB` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Utilisateurs de CuichetteLand';

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Produits`
--
ALTER TABLE `Produits`
  ADD PRIMARY KEY (`Identifiant`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
