-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 23 Septembre 2017 à 19:40
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ladecadanse3`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `place_id` smallint(5) UNSIGNED DEFAULT NULL,
  `idSalle` mediumint(9) DEFAULT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL COMMENT 'auteur',
  `status` enum('actif','inactif','annule','complet') NOT NULL DEFAULT 'actif',
  `category` varchar(20) NOT NULL DEFAULT 'divers',
  `titre` varchar(100) NOT NULL DEFAULT '',
  `dateEvenement` date NOT NULL,
  `nomLieu` varchar(255) DEFAULT NULL,
  `adresse` text,
  `quartier` varchar(255) DEFAULT NULL,
  `townId` smallint(6) DEFAULT NULL,
  `townName` varchar(255) DEFAULT NULL,
  `townRegion` varchar(2) DEFAULT NULL,
  `urlLieu` varchar(255) DEFAULT NULL,
  `horaire_debut` datetime DEFAULT NULL,
  `horaire_fin` datetime DEFAULT NULL,
  `horaire_complement` varchar(100) DEFAULT NULL,
  `description` text,
  `prix` varchar(255) DEFAULT NULL,
  `prelocations` varchar(80) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event_organizer`
--

CREATE TABLE `event_organizer` (
  `event_id` mediumint(9) NOT NULL,
  `organizer_id` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `organizer`
--

CREATE TABLE `organizer` (
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL COMMENT 'auteur',
  `status` enum('actif','inactif','ancien') NOT NULL DEFAULT 'actif',
  `nom` varchar(255) NOT NULL DEFAULT '',
  `adresse` varchar(255) NOT NULL DEFAULT '',
  `URL` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `presentation` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE `place` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `status` enum('actif','inactif','ancien') NOT NULL DEFAULT 'actif',
  `determinant` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL DEFAULT '',
  `adresse` varchar(80) NOT NULL DEFAULT '',
  `address_details` varchar(255) DEFAULT NULL,
  `quartier` varchar(255) NOT NULL DEFAULT 'Plainpalais',
  `townId` smallint(6) NOT NULL,
  `townName` varchar(255) NOT NULL,
  `townRegion` varchar(2) DEFAULT NULL,
  `horaire_general` text NOT NULL,
  `categories` set('bistrot','salle','restaurant','cinema','theatre','galerie','boutique','musee','autre') NOT NULL,
  `URL` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `place_organizer`
--

CREATE TABLE `place_organizer` (
  `organizer_id` mediumint(9) NOT NULL,
  `place_id` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `town`
--

CREATE TABLE `town` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `commune` varchar(255) NOT NULL,
  `npa` int(4) NOT NULL,
  `region` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(23) NOT NULL,
  `role` varchar(50) NOT NULL,
  `cookie` varchar(32) NOT NULL DEFAULT '',
  `groupe` tinyint(4) UNSIGNED NOT NULL DEFAULT '12',
  `status` enum('actif','inactif','demande') NOT NULL DEFAULT 'actif',
  `nom` varchar(40) NOT NULL DEFAULT '',
  `prenom` varchar(40) NOT NULL DEFAULT '',
  `affiliation` varchar(255) NOT NULL DEFAULT '',
  `region` varchar(2) NOT NULL DEFAULT 'ge',
  `email` varchar(80) NOT NULL DEFAULT '',
  `signature` enum('pseudo','prenom','nomcomplet','aucune') NOT NULL DEFAULT 'pseudo',
  `avec_affiliation` enum('oui','non') NOT NULL DEFAULT 'non',
  `gds` varchar(255) NOT NULL DEFAULT '',
  `actif` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_organizer`
--

CREATE TABLE `user_organizer` (
  `organizer_id` mediumint(9) NOT NULL,
  `user_id` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_place`
--

CREATE TABLE `user_place` (
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `place_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semaine` (`category`,`dateEvenement`),
  ADD KEY `dateajout` (`created`),
  ADD KEY `ev_idlieu_dateev` (`place_id`,`dateEvenement`);

--
-- Index pour la table `event_organizer`
--
ALTER TABLE `event_organizer`
  ADD PRIMARY KEY (`event_id`,`organizer_id`);

--
-- Index pour la table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom` (`nom`),
  ADD KEY `lieu_dateajout` (`created`);

--
-- Index pour la table `place_organizer`
--
ALTER TABLE `place_organizer`
  ADD PRIMARY KEY (`organizer_id`,`place_id`);

--
-- Index pour la table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pseudo` (`username`);

--
-- Index pour la table `user_organizer`
--
ALTER TABLE `user_organizer`
  ADD PRIMARY KEY (`organizer_id`,`user_id`);

--
-- Index pour la table `user_place`
--
ALTER TABLE `user_place`
  ADD PRIMARY KEY (`user_id`,`place_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `place`
--
ALTER TABLE `place`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `town`
--
ALTER TABLE `town`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
