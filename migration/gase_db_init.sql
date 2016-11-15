-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2016 at 10:00 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gasedl`
--

-- --------------------------------------------------------

--
-- Table structure for table `_inde_ACHATS`
--

CREATE TABLE IF NOT EXISTS `_inde_ACHATS` (
  `ID_ACHAT` smallint(6) NOT NULL AUTO_INCREMENT,
  `DATE_ACHAT` datetime NOT NULL,
  `ID_ADHERENT` smallint(6) NOT NULL,
  `TOTAL_TTC` float NOT NULL,
  `NB_REFERENCES` int(11) NOT NULL,
  PRIMARY KEY (`ID_ACHAT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_inde_CATEGORIES`
--

CREATE TABLE IF NOT EXISTS `_inde_CATEGORIES` (
  `ID_CATEGORIE` smallint(6) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `ID_CAT_SUP` smallint(6) DEFAULT NULL,
  `SOUS_CATEGORIES` tinyint(4) NOT NULL DEFAULT '0',
  `VISIBLE` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_CATEGORIE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `_inde_COMPTES`
--

CREATE TABLE IF NOT EXISTS `_inde_COMPTES` (
  `ID_ADHERENT` smallint(6) NOT NULL,
  `SOLDE` float NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OPERATION` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `MONTANT` float NOT NULL,
  KEY `ID_ADHERENT` (`ID_ADHERENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `_inde_DOCUMENTS`
--

CREATE TABLE IF NOT EXISTS `_inde_DOCUMENTS` (
  `ID_DOCUMENT` smallint(6) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ID_TYPE` smallint(6) NOT NULL,
  `ID_FOURNISSEUR` smallint(6) DEFAULT NULL,
  `DESCRIPTION` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DATE` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `NET_A_PAYER` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  UNIQUE KEY `ID` (`ID_DOCUMENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_inde_FOURNISSEURS`
--

CREATE TABLE IF NOT EXISTS `_inde_FOURNISSEURS` (
  `ID_FOURNISSEUR` smallint(6) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) NOT NULL,
  `MAIL` varchar(255) DEFAULT NULL,
  `ADRESSE` varchar(255) DEFAULT NULL,
  `CONTACT` varchar(255) DEFAULT NULL,
  `TELEPHONE_FIXE` varchar(255) DEFAULT NULL,
  `TELEPHONE_PORTABLE` varchar(255) DEFAULT NULL,
  `FAX` varchar(255) DEFAULT NULL,
  `DATE_REFERENCEMENT` date NOT NULL,
  `COMMENTAIRE` varchar(1024) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `NOM` (`NOM`),
  KEY `ID_FOURNISSEUR` (`ID_FOURNISSEUR`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `_inde_REFERENCES`
--

CREATE TABLE IF NOT EXISTS `_inde_REFERENCES` (
  `ID_REFERENCE` smallint(6) NOT NULL AUTO_INCREMENT,
  `DESIGNATION` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `ID_FOURNISSEUR` smallint(6) NOT NULL,
  `VRAC` tinyint(4) NOT NULL,
  `ID_CATEGORIE` smallint(6) NOT NULL,
  `PRIX_TTC` float NOT NULL,
  `TVA` float NOT NULL,
  `VISIBLE` tinyint(4) NOT NULL,
  `CODE_FOURNISSEUR` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `COMMENTAIRE` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `DATE_REFERENCEMENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ALERT_STOCK` float DEFAULT NULL,
  PRIMARY KEY (`ID_REFERENCE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `_inde_STOCKS`
--

CREATE TABLE IF NOT EXISTS `_inde_STOCKS` (
  `ID_REFERENCE` smallint(6) NOT NULL,
  `STOCK` float NOT NULL,
  `OPERATION` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QUANTITE` float NOT NULL,
  `ID_ACHAT` smallint(6) DEFAULT NULL,
  KEY `ID_REFERENCE` (`ID_REFERENCE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `_inde_TYPE_DOC`
--

CREATE TABLE IF NOT EXISTS `_inde_TYPE_DOC` (
  `ID_TYPE` smallint(6) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(64) NOT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_inde_VIE_OUTIL`
--

CREATE TABLE IF NOT EXISTS `_inde_VIE_OUTIL` (
  `DATE` datetime NOT NULL,
  `MESSAGE` varchar(1024) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`DATE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_inde_ADHERENTS`
--

CREATE TABLE IF NOT EXISTS `_inde_ADHERENTS` (
  `ID_ADHERENT` smallint(6) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `PRENOM` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `MAIL` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `ADRESSE` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `TELEPHONE_FIXE` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `TELEPHONE_PORTABLE` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `COMMENTAIRE` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1',
  `TICKET_CAISSE` tinyint(1) NOT NULL DEFAULT '1',
  `DATE_INSCRIPTION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RECEIVE_ALERT_STOCK` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ID_ADHERENT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
