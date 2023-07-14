/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mcserverminecraft`
--
CREATE DATABASE IF NOT EXISTS mcserverminecraft;
USE mcserverminecraft;


-- --------------------------------------------------------

--
-- Structure de la table `_server`
--

CREATE TABLE `_server` (
  `id` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_create_account` datetime NOT NULL,
  `picture_account` blob DEFAULT NULL,
  `key_verify` varchar(255) NOT NULL,
  `verify_key_date` datetime NOT NULL,
  `account_confirmed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `_server`
--
ALTER TABLE `_server`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`pseudo`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `date_create_account` (`date_create_account`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `_server`
--
ALTER TABLE `_server`
  ADD CONSTRAINT `_server_ibfk_1` FOREIGN KEY (`pseudo`) REFERENCES `_user` (`pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
