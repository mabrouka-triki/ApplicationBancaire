-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 07 avr. 2025 à 13:49
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `banque`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `id_admin` int(11) NOT NULL,
  `nom_admin` varchar(50) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `mdp_admin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`id_admin`, `nom_admin`, `email_admin`, `mdp_admin`) VALUES
(1, 'mabrouka', 'admin@email.com', '$2y$10$P7.bobKsS.YIz0KGyaO0U.tRqVFaSgu.G6J0k5n8Um.OMrTYCv.4.');

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(50) NOT NULL,
  `prenom_client` varchar(50) NOT NULL,
  `email_client` varchar(50) NOT NULL,
  `telephone_client` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`id_client`, `nom_client`, `prenom_client`, `email_client`, `telephone_client`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@email.com', '0123456789'),
(2, 'Martin', 'Sophie', 'sophie.martin@email.com', '0987654321'),
(3, 'Bernard', 'Paul', 'paul.bernard@email.com', '0147852369');

-- --------------------------------------------------------

--
-- Structure de la table `Compte`
--

CREATE TABLE `Compte` (
  `id_compte` int(11) NOT NULL,
  `RIB` varchar(50) NOT NULL,
  `type_compte` varchar(50) NOT NULL,
  `solde_intial` decimal(10,0) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Compte`
--

INSERT INTO `Compte` (`id_compte`, `RIB`, `type_compte`, `solde_intial`, `id_client`) VALUES
(1, 'FR7612345678901234567890123', 'Courant', 1500, 1),
(2, 'FR7623456789012345678901234', 'Épargne', 2000, 2),
(3, 'FR7634567890123456789012345', 'Courant', 1200, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
  `id_contrat` int(11) NOT NULL,
  `type_contrat` varchar(50) NOT NULL,
  `montant_souscription_contrat` decimal(10,0) NOT NULL,
  `duree_contrat` date NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Contrat`
--

INSERT INTO `Contrat` (`id_contrat`, `type_contrat`, `montant_souscription_contrat`, `duree_contrat`, `id_client`) VALUES
(1, 'Abonnement', 100, '2025-12-31', 1),
(2, 'Service', 150, '2025-06-30', 2),
(3, 'Assurance', 200, '2025-05-15', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `Compte_Client_FK` (`id_client`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`id_contrat`),
  ADD KEY `Contrat_Client_FK` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Compte`
--
ALTER TABLE `Compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Contrat`
--
ALTER TABLE `Contrat`
  MODIFY `id_contrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Compte`
--
ALTER TABLE `Compte`
  ADD CONSTRAINT `Compte_Client_FK` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`);

--
-- Contraintes pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD CONSTRAINT `Contrat_Client_FK` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
