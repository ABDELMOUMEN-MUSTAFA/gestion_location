-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gestion_locations
CREATE DATABASE IF NOT EXISTS `gestion_locations` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `gestion_locations`;

-- Dumping structure for table gestion_locations.adresses
CREATE TABLE IF NOT EXISTS `adresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(50) NOT NULL,
  `rue` varchar(150) NOT NULL,
  `province` varchar(100) NOT NULL,
  `code_postal` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gestion_locations.adresses: ~2 rows (approximately)
/*!40000 ALTER TABLE `adresses` DISABLE KEYS */;
INSERT IGNORE INTO `adresses` (`id`, `ville`, `rue`, `province`, `code_postal`) VALUES
	(1, 'Casablanca', '9C98+X6R, Rte de Nouasseur,', 'Casablanca', '27819'),
	(2, 'Fès', 'Aéroport Fes Saïss Oulad Tayeb', 'Fès', '30000'),
	(3, 'Tanger', ' P3GP+8RW, Aéroport Tanger-Ibn Batouta', 'Tanger', '29084'),
	(4, 'Marrakech', '14, rue Belaaguid', 'Marrakech', '10000');
/*!40000 ALTER TABLE `adresses` ENABLE KEYS */;

-- Dumping structure for table gestion_locations.agences
CREATE TABLE IF NOT EXISTS `agences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `telephone` varchar(16) NOT NULL,
  `adresse_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `adresse_id` (`adresse_id`),
  CONSTRAINT `agences_ibfk_1` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gestion_locations.agences: ~2 rows (approximately)
/*!40000 ALTER TABLE `agences` DISABLE KEYS */;
INSERT IGNORE INTO `agences` (`id`, `nom`, `telephone`, `adresse_id`) VALUES
	(1, 'Fés', '06 38 91 82 49', 2),
	(2, 'Casablanca', '06 48 91 02 12', 1);
/*!40000 ALTER TABLE `agences` ENABLE KEYS */;

-- Dumping structure for table gestion_locations.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gestion_locations.categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT IGNORE INTO `categories` (`id`, `categorie`) VALUES
	(1, 'Citadines & Compactes'),
	(2, 'SUV & 4WD'),
	(3, 'Premuim'),
	(4, 'Hybride'),
	(5, 'Familiale & Minibus'),
	(6, 'Utilitaires');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table gestion_locations.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `cin` varchar(25) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telephone` varchar(16) NOT NULL,
  `mot_de_passe` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `adresse_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cin` (`cin`),
  KEY `adresse_id` (`adresse_id`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gestion_locations.clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT IGNORE INTO `clients` (`id`, `nom`, `prenom`, `cin`, `email`, `telephone`, `mot_de_passe`, `adresse_id`) VALUES
	(1, 'Boudil', 'Anass', 'EE92312', 'hamid@gmail.com', '06271821', 'dimabarca123', 1),
	(2, 'Taliani', 'Reda', 'GY41206', 'sarouti@gmail.com', '+212 649721816', '$2y$10$4FcaCpf4YSUg4xRgC.zbc.6GuWNVHXzke2kvj.KWHw/wIeYk0yqea', 4);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Dumping structure for table gestion_locations.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_depart` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `prix` float NOT NULL,
  `matricule` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `agence_depart` int(11) NOT NULL,
  `agence_retour` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `matricule` (`matricule`),
  KEY `client_id` (`client_id`),
  KEY `FK_locations_agences` (`agence_depart`),
  KEY `FK_locations_agences_2` (`agence_retour`),
  CONSTRAINT `FK_locations_agences` FOREIGN KEY (`agence_depart`) REFERENCES `agences` (`id`),
  CONSTRAINT `FK_locations_agences_2` FOREIGN KEY (`agence_retour`) REFERENCES `agences` (`id`),
  CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `voitures` (`matricule`),
  CONSTRAINT `locations_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gestion_locations.locations: ~2 rows (approximately)
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT IGNORE INTO `locations` (`id`, `date_depart`, `date_retour`, `prix`, `matricule`, `client_id`, `agence_depart`, `agence_retour`, `created_at`) VALUES
	(23, '2023-03-13 08:30:00', '2023-03-23 08:30:00', 3000, 2, 2, 1, 2, '2023-03-12 18:49:49');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;

-- Dumping structure for table gestion_locations.voitures
CREATE TABLE IF NOT EXISTS `voitures` (
  `matricule` int(11) NOT NULL,
  `marque` varchar(100) NOT NULL,
  `prix_jour` float NOT NULL,
  `climatisation` tinyint(4) DEFAULT '1',
  `photo` varchar(100) DEFAULT 'default.png',
  `nombre_portes` int(11) DEFAULT '4',
  `nombre_passagers` int(11) DEFAULT '5',
  `nombre_valises` int(11) NOT NULL,
  `boite_vitesses` varchar(50) NOT NULL,
  `annee_permis_min` int(11) DEFAULT '1',
  `franchise_accedent` float DEFAULT '0',
  `franchise_vol` float DEFAULT '0',
  `caution` float DEFAULT '0',
  `titre` varchar(50) NOT NULL DEFAULT '',
  `sous_titre` varchar(100) NOT NULL DEFAULT '',
  `type_carburant` varchar(50) NOT NULL,
  `gps_integre` tinyint(4) NOT NULL DEFAULT '1',
  `logo` varchar(100) DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  PRIMARY KEY (`matricule`),
  KEY `categorie_id` (`categorie_id`),
  KEY `FK_voitures_agences` (`agence_id`),
  CONSTRAINT `FK_voitures_agences` FOREIGN KEY (`agence_id`) REFERENCES `agences` (`id`),
  CONSTRAINT `voitures_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gestion_locations.voitures: ~4 rows (approximately)
/*!40000 ALTER TABLE `voitures` DISABLE KEYS */;
INSERT IGNORE INTO `voitures` (`matricule`, `marque`, `prix_jour`, `climatisation`, `photo`, `nombre_portes`, `nombre_passagers`, `nombre_valises`, `boite_vitesses`, `annee_permis_min`, `franchise_accedent`, `franchise_vol`, `caution`, `titre`, `sous_titre`, `type_carburant`, `gps_integre`, `logo`, `categorie_id`, `agence_id`) VALUES
	(1, 'Citroën', 300, 0, 'Citroën-C3.png', 4, 5, 2, 'Automatique', 2, 1400, 7800, 12000, 'Citadines & compactes MDAR', 'Kia Picanto BVA - Offre en KM illimité ou similaire', 'Diesel', 0, 'citroen-logo.png', 1, 2),
	(2, 'Citroën', 300, 1, 'Citroën-C3.png', 4, 5, 2, 'Manuelle', 1, 1400, 7800, 12000, 'Citadines & compactes MDAR', 'Kia Picanto BVA - Offre en KM illimité ou similaire', 'Diesel', 1, 'citroen-logo.png', 1, 1),
	(3, 'Citroën', 300, 1, 'Citroën-C3.png', 4, 5, 2, 'Manuelle', 1, 1400, 7800, 12000, 'Citadines & compactes MDAR', 'Kia Picanto BVA - Offre en KM illimité ou similaire', 'Diesel', 1, 'citroen-logo.png', 1, 1),
	(4, 'Citroën', 300, 1, 'Citroën-C3.png', 4, 5, 2, 'Manuelle', 1, 1400, 7800, 12000, 'Citadines & compactes MDAR', 'Kia Picanto BVA - Offre en KM illimité ou similaire', 'Essence', 1, 'citroen-logo.png', 2, 2);
/*!40000 ALTER TABLE `voitures` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
