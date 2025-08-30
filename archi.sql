-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 22 août 2025 à 16:37
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archi`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `projet_id` bigint UNSIGNED NOT NULL,
  `type` enum('etude','expertise','realisation','autorisation') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` enum('planifie','en_cours','termine','retard') COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_prevu` decimal(15,2) NOT NULL,
  `montant_realise` decimal(15,2) NOT NULL,
  `responsable_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activites_projet_id_foreign` (`projet_id`),
  KEY `activites_responsable_id_foreign` (`responsable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `projet_id`, `type`, `date_debut`, `date_fin`, `statut`, `montant_prevu`, `montant_realise`, `responsable_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'etude', '2024-01-15', '2024-03-01', 'termine', 8000.00, 8000.00, 1, 'Étude de faisabilité et esquisse', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(2, 1, 'autorisation', '2024-03-01', '2024-05-15', 'en_cours', 12000.00, 7500.00, 1, 'Dépôt permis de construire', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 2, 'etude', '2024-02-01', '2024-03-15', 'termine', 6000.00, 6000.00, 2, 'Étude de rénovation', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(4, 2, 'realisation', '2024-03-15', '2024-08-15', 'en_cours', 22000.00, 9600.00, 2, 'Travaux de rénovation', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(5, 4, 'etude', '2025-08-07', '2025-11-07', 'planifie', 30000000.00, 0.00, 2, 'Etude du projet de construction d\'un emmeubles à segou', '2025-08-07 13:57:28', '2025-08-07 13:57:28'),
(6, 5, 'etude', '2025-08-15', '2025-10-12', 'en_cours', 3000000.00, 0.00, 2, 'Etude du projet', '2025-08-11 12:18:12', '2025-08-11 12:18:12'),
(7, 5, 'realisation', '2025-10-12', '2026-02-15', 'en_cours', 40000000.00, 0.00, 1, 'Ralisation du projet', '2025-08-11 12:20:03', '2025-08-11 12:20:03'),
(8, 5, 'autorisation', '2025-08-17', '2025-08-24', 'en_cours', 0.00, 0.00, 2, 'Demande d\'autorisation de construction', '2025-08-11 12:43:01', '2025-08-11 12:43:01'),
(9, 1, 'expertise', '2025-08-22', '2025-10-26', 'planifie', 1000000.00, 0.00, 1, 'expertise', '2025-08-19 13:26:09', '2025-08-19 13:26:09'),
(10, 1, 'expertise', '2025-08-22', '2025-10-26', 'planifie', 1000000.00, 0.00, 1, 'expertise', '2025-08-19 13:26:16', '2025-08-19 13:26:16'),
(12, 1, 'realisation', '2025-08-21', '2025-10-26', 'en_cours', 3000000.00, 0.00, 1, 'realisation', '2025-08-19 13:39:19', '2025-08-19 13:39:19'),
(13, 1, 'realisation', '2025-08-22', '2025-10-26', 'en_cours', 4000000.00, 0.00, 1, 'Réalisation du projet du Maison Individuelle', '2025-08-20 11:24:03', '2025-08-20 11:24:03'),
(14, 3, 'etude', '2025-08-25', '2025-10-30', 'en_cours', 2000000.00, 0.00, 1, 'Etude du projet de réalisation du Bureaux Innovtech', '2025-08-20 11:31:55', '2025-08-20 11:31:55'),
(16, 3, 'realisation', '2025-08-30', '2025-11-30', 'termine', 2500000.00, 0.00, 1, 'réalisation des bureaux Innovtech 1', '2025-08-20 11:55:15', '2025-08-20 12:45:47'),
(17, 5, 'etude', '2025-08-30', '2026-01-30', 'en_cours', 3500000.00, 0.00, 2, 'Etude de la construction d\'un barrage à Kati', '2025-08-20 11:56:51', '2025-08-20 11:56:51'),
(18, 7, 'expertise', '2025-08-30', '2025-11-30', 'en_cours', 900000.00, 0.00, 1, 'Expertise sur la construction d\'un villa-Kati', '2025-08-20 11:58:34', '2025-08-20 11:58:34'),
(19, 7, 'autorisation', '2025-08-30', '2025-12-28', 'en_cours', 2300000.00, 0.00, 2, 'Demande d\'autorisation de construction du projet de villa à Kati', '2025-08-20 12:06:44', '2025-08-20 12:06:44');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-guindo@gmail.com|127.0.0.1:timer', 'i:1755862670;', 1755862670),
('laravel-cache-guindo@gmail.com|127.0.0.1', 'i:1;', 1755862670);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_client` enum('particulier','entreprise','collectivite') COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `type_client`, `societe`, `created_at`, `updated_at`) VALUES
(1, 'Durand', 'Jean', '123 rue de la Paix, 75001 Paris', '01.23.45.67.89', 'jean.durand@email.com', 'particulier', NULL, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(2, 'Bernard', 'Claire', '456 avenue Victor Hugo, 69001 Lyon', '04.78.90.12.34', 'claire.bernard@email.com', 'particulier', NULL, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 'Innovtech', '', '789 boulevard Haussmann, 75008 Paris', '01.56.78.90.12', 'contact@innovtech.com', 'entreprise', 'Innovtech Solutions', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(4, 'Barry', 'Mody', 'SOGONIKO, BAMAKO', '77773034', 'modybarry@gmail.com', 'particulier', 'BKO Construction', '2025-08-07 13:28:35', '2025-08-07 13:28:35'),
(7, 'AMRTP', NULL, 'HAMDALLAYE', '20232427', 'amrtp@mali.ml', 'collectivite', 'AMRTP', '2025-08-19 12:52:30', '2025-08-19 12:52:54');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `subject`, `created_at`, `updated_at`) VALUES
(1, NULL, '2025-08-20 17:29:40', '2025-08-20 17:29:54'),
(2, NULL, '2025-08-20 17:50:58', '2025-08-20 17:50:58'),
(3, NULL, '2025-08-21 11:57:14', '2025-08-21 11:57:14'),
(4, NULL, '2025-08-21 12:25:40', '2025-08-21 12:25:40');

-- --------------------------------------------------------

--
-- Structure de la table `conversation_user`
--

DROP TABLE IF EXISTS `conversation_user`;
CREATE TABLE IF NOT EXISTS `conversation_user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_user_conversation_id_foreign` (`conversation_id`),
  KEY `conversation_user_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conversation_user`
--

INSERT INTO `conversation_user` (`id`, `conversation_id`, `user_id`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2025-08-20 17:29:40', '2025-08-20 17:29:40', '2025-08-20 17:29:40'),
(2, 1, 1, NULL, '2025-08-20 17:29:40', '2025-08-20 17:29:40'),
(3, 2, 5, '2025-08-20 17:50:58', '2025-08-20 17:50:58', '2025-08-20 17:50:58'),
(4, 2, 2, NULL, '2025-08-20 17:50:58', '2025-08-20 17:50:58'),
(5, 3, 5, '2025-08-21 11:57:14', '2025-08-21 11:57:14', '2025-08-21 11:57:14'),
(6, 3, 3, NULL, '2025-08-21 11:57:14', '2025-08-21 11:57:14'),
(7, 4, 5, '2025-08-21 12:25:40', '2025-08-21 12:25:40', '2025-08-21 12:25:40'),
(8, 4, 4, NULL, '2025-08-21 12:25:40', '2025-08-21 12:25:40');

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `projet_id` bigint UNSIGNED NOT NULL,
  `activite_id` bigint UNSIGNED DEFAULT NULL,
  `montant` decimal(15,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `categorie` enum('materiel','deplacement','formation','logiciel','autre') COLLATE utf8mb4_unicode_ci NOT NULL,
  `saisi_par` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `depenses_projet_id_foreign` (`projet_id`),
  KEY `depenses_activite_id_foreign` (`activite_id`),
  KEY `depenses_saisi_par_foreign` (`saisi_par`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`id`, `projet_id`, `activite_id`, `montant`, `description`, `date`, `categorie`, `saisi_par`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 450.00, 'Logiciel de modélisation 3D', '2024-01-20', 'logiciel', 1, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(2, 1, NULL, 180.00, 'Déplacement site client', '2024-02-05', 'deplacement', 1, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 2, 3, 320.00, 'Matériel de mesure', '2024-02-10', 'materiel', 2, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(4, 2, NULL, 95.00, 'Formation réglementation', '2024-02-20', 'formation', 2, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(5, 4, 5, 100000.00, 'Achat des sacs de ciment', '2025-08-07', 'materiel', 1, '2025-08-07 14:58:38', '2025-08-07 14:58:38'),
(6, 5, 7, 100000.00, '2 tonnes de ciment', '2025-08-11', 'materiel', 1, '2025-08-11 12:25:42', '2025-08-11 12:25:42'),
(7, 5, 7, 160000.00, '2 voyages de sables à raison de 80 000 par voyages', '2025-08-11', 'materiel', 1, '2025-08-11 12:27:47', '2025-08-11 12:27:47'),
(8, 5, 8, 50000.00, 'Depot de demande d\'autorisation', '2025-08-11', 'autre', 1, '2025-08-11 12:44:13', '2025-08-11 12:44:13'),
(9, 2, 4, 50000.00, 'Achat de sac de ciment', '2025-08-20', 'materiel', 5, '2025-08-20 14:47:51', '2025-08-20 14:47:51');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` enum('plan','devis','contrat','photo','rapport','autre','cabinet') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chemin_acces` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint UNSIGNED DEFAULT NULL,
  `activite_id` bigint UNSIGNED DEFAULT NULL,
  `uploade_par` bigint UNSIGNED NOT NULL,
  `date_upload` timestamp NOT NULL,
  `taille` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_projet_id_foreign` (`projet_id`),
  KEY `documents_activite_id_foreign` (`activite_id`),
  KEY `documents_uploade_par_foreign` (`uploade_par`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `type`, `nom`, `chemin_acces`, `projet_id`, `activite_id`, `uploade_par`, `date_upload`, `taille`, `created_at`, `updated_at`) VALUES
(9, 'cabinet', 'Certificat', 'documents/mu7v6LG8cwkSMIRMsakaUfkauGKPcxYKXXo1duxb.pdf', NULL, NULL, 5, '2025-08-22 07:47:58', '158.81 KB', '2025-08-22 07:47:58', '2025-08-22 07:47:58'),
(16, 'plan', 'PLAN 3D', 'documents/hEp2QgsS81X9JVIi3GQiorLeZLgQaGZBYQFPYMfy.pln', 4, 5, 5, '2025-08-22 10:45:18', '35.02 MB', '2025-08-22 10:45:18', '2025-08-22 10:45:18'),
(18, 'rapport', 'infos', 'documents/zSQ93y8yOKjwBlPhLWNP9PznrGMbzx3BRbIVfuCe.pdf', 4, 5, 5, '2025-08-22 11:23:26', '158.81 KB', '2025-08-22 11:16:03', '2025-08-22 11:16:03');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

DROP TABLE IF EXISTS `historiques`;
CREATE TABLE IF NOT EXISTS `historiques` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historiques_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `historiques`
--

INSERT INTO `historiques` (`id`, `user_id`, `action`, `model_type`, `model_id`, `old_values`, `new_values`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, 'updated', 'App\\Models\\User', 5, '{\"id\": 5, \"nom\": \"cisse\", \"role\": \"admin\", \"actif\": true, \"login\": \"mansour\", \"prenom\": \"Sekou Mansour\", \"password\": \"$2y$12$RA0s4ODVn7hRcUsqxKFPF.G9JIQa0tyRk5rX8GkzjSch9k1cVAzjy\", \"created_at\": \"2025-08-07T20:27:13.000000Z\", \"updated_at\": \"2025-08-22T14:47:21.000000Z\"}', '{\"prenom\": \"Mansour\", \"updated_at\": \"2025-08-22 15:08:54\"}', 'Mise à jour de User (ID: cisse)', '2025-08-22 15:08:54', '2025-08-22 15:08:54'),
(2, 5, 'created', 'App\\Models\\User', 6, NULL, '{\"id\": 6, \"nom\": \"Barry\", \"role\": \"admin\", \"actif\": true, \"login\": \"mody\", \"prenom\": \"Mody\", \"created_at\": \"2025-08-22T15:18:22.000000Z\", \"updated_at\": \"2025-08-22T15:18:22.000000Z\"}', 'Création de User (ID: Barry)', '2025-08-22 15:18:22', '2025-08-22 15:18:22'),
(3, 5, 'updated', 'App\\Models\\User', 6, '{\"id\": 6, \"nom\": \"Barry\", \"role\": \"admin\", \"actif\": true, \"login\": \"mody\", \"prenom\": \"Mody\", \"password\": \"$2y$12$Unw7bSnKlreJJW6a0wwsf.fl.CrNwsIDDKefx1VMQSV8EjP38erCK\", \"created_at\": \"2025-08-22T15:18:22.000000Z\", \"updated_at\": \"2025-08-22T15:18:22.000000Z\"}', '{\"prenom\": \"Mody S\", \"updated_at\": \"2025-08-22 16:00:14\"}', 'Mise à jour de User (ID: Barry)', '2025-08-22 16:00:15', '2025-08-22 16:00:15'),
(4, 5, 'deleted', 'App\\Models\\User', 4, '{\"id\": 4, \"nom\": \"Admin\", \"role\": \"admin\", \"actif\": true, \"login\": \"admin\", \"prenom\": \"System\", \"created_at\": \"2025-08-06T15:27:14.000000Z\", \"updated_at\": \"2025-08-06T15:27:14.000000Z\"}', NULL, 'Suppression de User (ID: Admin)', '2025-08-22 16:00:40', '2025-08-22 16:00:40'),
(5, 5, 'created', 'App\\Models\\Paiement', 3, NULL, '{\"id\": 3, \"date\": \"2025-08-22\", \"montant\": \"2300000\", \"client_id\": \"3\", \"projet_id\": \"5\", \"created_at\": \"2025-08-22T16:10:34.000000Z\", \"updated_at\": \"2025-08-22T16:10:34.000000Z\", \"moyen_paiement\": \"virement\", \"reference_paiement\": \"453445\"}', 'Création de Paiement (ID: 3)', '2025-08-22 16:10:34', '2025-08-22 16:10:34'),
(6, 5, 'created', 'App\\Models\\Projet', 8, NULL, '{\"id\": 8, \"etat\": \"en_cours\", \"titre\": \"Construction Amphi 2000\", \"date_fin\": \"2025-12-25\", \"client_id\": \"1\", \"created_at\": \"2025-08-22T16:30:49.000000Z\", \"date_debut\": \"2024-01-10\", \"updated_at\": \"2025-08-22T16:30:49.000000Z\", \"description\": \"test\", \"budget_prevu\": \"3000000\", \"budget_realise\": 0, \"responsable_id\": \"1\"}', 'Création de Projet (ID: Construction Amphi 2000)', '2025-08-22 16:30:49', '2025-08-22 16:30:49');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_conversation_id_foreign` (`conversation_id`),
  KEY `messages_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'bonjour', '2025-08-20 17:29:54', '2025-08-20 17:29:54');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_06_103322_create_clients_table', 1),
(5, '2025_08_06_103323_create_projets_table', 1),
(6, '2025_08_06_103324_create_activites_table', 1),
(7, '2025_08_06_103325_create_depenses_table', 1),
(8, '2025_08_06_103327_create_paiements_table', 1),
(9, '2025_08_06_103328_create_documents_table', 1),
(10, '2025_08_06_104450_create_personal_access_tokens_table', 1),
(11, '2025_08_06_152454_create_notifications_table', 1),
(12, '2025_08_20_150057_create_conversation_user_table', 2),
(13, '2025_08_20_150057_create_conversations_table', 2),
(14, '2025_08_20_150057_create_messages_table', 2),
(15, '2025_08_22_134824_create_historiques_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `utilisateur_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `date_envoi` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_utilisateur_id_foreign` (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `utilisateur_id`, `message`, `type`, `lu`, `date_envoi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nouveau document uploadé pour le projet Maison Durand', 'info', 0, '2024-02-15 14:30:00', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(2, 1, 'Échéance permis de construire dans 7 jours', 'warning', 0, '2024-02-14 09:00:00', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 2, 'Paiement reçu pour le projet Rénovation Bernard', 'success', 1, '2024-03-20 16:45:00', '2025-08-06 15:27:14', '2025-08-06 15:27:14');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED NOT NULL,
  `projet_id` bigint UNSIGNED NOT NULL,
  `activite_id` bigint UNSIGNED DEFAULT NULL,
  `montant` decimal(15,2) NOT NULL,
  `date` date NOT NULL,
  `moyen_paiement` enum('virement','cheque','especes','carte','autre') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_paiement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiements_client_id_foreign` (`client_id`),
  KEY `paiements_projet_id_foreign` (`projet_id`),
  KEY `paiements_activite_id_foreign` (`activite_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `client_id`, `projet_id`, `activite_id`, `montant`, `date`, `moyen_paiement`, `reference_paiement`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 8000.00, '2024-03-05', 'virement', 'VIR-2024-001', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(2, 2, 2, 3, 6000.00, '2024-03-20', 'cheque', 'CHQ-2024-002', '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 3, 5, NULL, 2300000.00, '2025-08-22', 'virement', '453445', '2025-08-22 16:10:34', '2025-08-22 16:10:34');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(13, 'App\\Models\\User', 5, 'auth_token', '41981f1b712e82db33914ccaffcc5fc768eb2fb039d76f9de8d6ec4359492275', '[\"*\"]', '2025-08-15 19:05:42', NULL, '2025-08-15 16:29:14', '2025-08-15 19:05:42'),
(12, 'App\\Models\\User', 5, 'auth_token', '5fbdb5edc69ad2f49146e75db4b30bb1af483279aee43214968b1b362f14f3b8', '[\"*\"]', '2025-08-13 20:40:51', NULL, '2025-08-12 14:29:59', '2025-08-13 20:40:51');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` enum('en_attente','en_cours','termine','suspendu','planifie') COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `responsable_id` bigint UNSIGNED NOT NULL,
  `budget_prevu` decimal(15,2) NOT NULL,
  `budget_realise` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projets_client_id_foreign` (`client_id`),
  KEY `projets_responsable_id_foreign` (`responsable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `titre`, `description`, `etat`, `client_id`, `date_debut`, `date_fin`, `responsable_id`, `budget_prevu`, `budget_realise`, `created_at`, `updated_at`) VALUES
(1, 'Maison individuelle - Famille Durand', 'Construction d\'une maison contemporaine de 150m²', 'en_cours', 1, '2024-01-15', '2024-12-30', 1, 45000.00, 23500.00, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(2, 'Rénovation appartement - Mme Bernard', 'Rénovation complète d\'un appartement de 80m²', 'en_cours', 2, '2024-02-01', '2024-08-15', 2, 28000.00, 15600.00, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 'Bureaux Innovtech', 'Aménagement d\'espaces de bureaux modernes', 'planifie', 3, '2024-04-01', '2025-02-28', 1, 85000.00, 0.00, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(4, 'CONSTRUCTION D\'UN IMMEUBLES A SEGOU', 'Projet de construction d\'un immeubles de 30 étages au Marché de Segou', 'planifie', 3, '2025-08-07', '2026-01-31', 2, 1000000000.00, 0.00, '2025-08-07 13:22:01', '2025-08-07 13:22:01'),
(5, 'Construction d\'un barrage à kati', 'projet de construction d\'un barrage hydro-electrique à Kati-sananfara', 'planifie', 3, '2025-08-15', '2026-01-11', 2, 20000000000.00, 0.00, '2025-08-11 12:16:16', '2025-08-11 12:16:16'),
(7, 'Construction d\'un villa-KATI', 'projet de construction d\'un villa à kati sananfara', 'planifie', 4, '2025-08-30', '2026-03-29', 5, 25000000.00, 0.00, '2025-08-19 13:09:51', '2025-08-19 13:09:51'),
(8, 'Construction Amphi 2000', 'test', 'en_cours', 1, '2024-01-10', '2025-12-25', 1, 3000000.00, 0.00, '2025-08-22 16:30:49', '2025-08-22 16:30:49');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cpsdDJGeEjw8h58upPt2Pom0tN8cm762JPbdRo3j', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV1BENldPSXE1VHVreGk2TDFPeDdBNzU1bm41aVF3dTVkTm1qZkRYOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9qZXRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NTU4NDg0NDc7fX0=', 1755880588),
('zHkSiCOQhIojP0QH1VehL02oSwXlGmszrECXISgY', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOThGSVk4WVVLUm1nU0FwMzA1UFJYb3Z2UDdtTEJxajd5QzVQT25RUSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FjdGl2aXRlcy81Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hY3Rpdml0ZXMvNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1755864472);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('architecte','assistant','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `role`, `login`, `password`, `actif`, `created_at`, `updated_at`) VALUES
(1, 'Dubois', 'Marie', 'architecte', 'mdubois', '$2y$12$.afZzCcxSSKZH.NmYYAR.emg/IuTS.Gyzb.3XmMDlrKFjDKYERS3y', 1, '2025-08-06 15:27:14', '2025-08-20 17:29:54'),
(2, 'Martin', 'Pierre', 'architecte', 'pmartin', '$2y$12$U.sDx9RU2Iv1eJzvEJmDwOghXA5BHIdceyX18vSsUVn4A.I.eGP.K', 1, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(3, 'Lemaire', 'Sophie', 'assistant', 'slemaire', '$2y$12$RLw2.PK5FmA639hFquRl9.4zSW9KDM1BOzA2QAXF77A.3adRFW80i', 1, '2025-08-06 15:27:14', '2025-08-06 15:27:14'),
(5, 'cisse', 'Mansour', 'admin', 'mansour', '$2y$12$RA0s4ODVn7hRcUsqxKFPF.G9JIQa0tyRk5rX8GkzjSch9k1cVAzjy', 1, '2025-08-07 20:27:13', '2025-08-22 15:08:54'),
(6, 'Barry', 'Mody S', 'admin', 'mody', '$2y$12$Unw7bSnKlreJJW6a0wwsf.fl.CrNwsIDDKefx1VMQSV8EjP38erCK', 1, '2025-08-22 15:18:22', '2025-08-22 16:00:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
