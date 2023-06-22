-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb
-- Généré le : jeu. 22 juin 2023 à 16:45
-- Version du serveur : 10.4.30-MariaDB-1:10.4.30+maria~ubu2004
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mcserverminecraft`
--
CREATE DATABASE IF NOT EXISTS `mcserverminecraft` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `mcserverminecraft`;

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_create_account` datetime NOT NULL,
  `key_verify` varchar(255) NOT NULL,
  `verify_key_date` datetime NOT NULL,
  `account_confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `_user`
--

INSERT INTO `_user` (`pseudo`, `password`, `email`, `date_create_account`, `key_verify`, `verify_key_date`, `account_confirmed`) VALUES
('test', '$2y$12$kvXEbtMJd3ZdjS999diJb.1NZYQDs6WT18kqz2Eb3j9LBlhrDvIjW', 'razmo34.game@gmail.com', '2023-06-21 12:22:27', '950efcdcd8932de9c026d07dd8ea39fcbf02470106b424e5aa8d07c3c8e54bee', '2023-06-21 14:22:27', 1),
('thibaut', '$2y$10$NzeEeutTOfnsyt60BBu2r.uS/9LeK9KFx.BfzwVUIEjPzBuOUWrHi', 'thibaut.maurras34@gmail.com', '2023-06-20 17:10:05', '84e1ab7b7104a306c91d9845551430426237bd89b2f276eefe8055aa0da5c414', '2023-06-21 23:23:12', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`pseudo`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `date_create_account` (`date_create_account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
