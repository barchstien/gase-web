-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Serveur: limousin.pascal.sql.free.fr
-- Généré le : Mar 26 Novembre 2013 à 10:22
-- Version du serveur: 5.0.83
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `limousin_pascal`
--

-- --------------------------------------------------------

--
-- Structure de la table `_inde_ACHATS`
--

CREATE TABLE IF NOT EXISTS `_inde_ACHATS` (
  `ID_ACHAT` smallint(6) NOT NULL auto_increment,
  `DATE_ACHAT` datetime NOT NULL,
  `ID_ADHERENT` smallint(6) NOT NULL,
  `TOTAL_TTC` float NOT NULL,
  `NB_REFERENCES` int(11) NOT NULL,
  PRIMARY KEY  (`ID_ACHAT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=893 ;


-- --------------------------------------------------------

--
-- Structure de la table `_inde_ADHERENTS`
--

CREATE TABLE IF NOT EXISTS `_inde_ADHERENTS` (
  `ID_ADHERENT` smallint(6) NOT NULL auto_increment,
  `NOM` varchar(64) collate latin1_general_ci NOT NULL,
  `PRENOM` varchar(64) collate latin1_general_ci default NULL,
  `MAIL` varchar(64) collate latin1_general_ci default NULL,
  `ADRESSE` varchar(128) collate latin1_general_ci default NULL,
  `TELEPHONE_FIXE` varchar(32) collate latin1_general_ci default NULL,
  `TELEPHONE_PORTABLE` varchar(32) collate latin1_general_ci default NULL,
  `COMMENTAIRE` varchar(256) collate latin1_general_ci default NULL,
  `VISIBLE` tinyint(1) NOT NULL default '1',
  `TICKET_CAISSE` tinyint(1) NOT NULL default '1',
  `DATE_INSCRIPTION` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ID_ADHERENT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=95 ;


-- --------------------------------------------------------

--
-- Structure de la table `_inde_CATEGORIES`
--

CREATE TABLE IF NOT EXISTS `_inde_CATEGORIES` (
  `ID_CATEGORIE` smallint(6) NOT NULL auto_increment,
  `NOM` varchar(32) collate latin1_general_ci NOT NULL,
  `ID_CAT_SUP` smallint(6) default NULL,
  `SOUS_CATEGORIES` tinyint(4) NOT NULL default '0',
  `VISIBLE` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`ID_CATEGORIE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

--
-- Contenu de la table `_inde_CATEGORIES`
--

INSERT INTO `_inde_CATEGORIES` (`ID_CATEGORIE`, `NOM`, `ID_CAT_SUP`, `SOUS_CATEGORIES`, `VISIBLE`) VALUES
(15, 'CHOCOLAT', 14, 0, 1),
(2, 'Boisson', NULL, 1, 1),
(3, 'JUS', 2, 0, 1),
(4, 'CAFE', 2, 0, 1),
(5, 'THE', 2, 0, 1),
(6, 'TISANE', 2, 0, 1),
(7, 'Non_Alim', NULL, 1, 1),
(8, 'SOIN', 7, 0, 1),
(10, 'CÃ©rÃ©ale', NULL, 1, 1),
(9, 'ENTRETIEN', 7, 0, 1),
(11, 'Condiment', NULL, 1, 1),
(12, 'LÃ©gumi.', NULL, 1, 1),
(13, 'SalÃ©', NULL, 1, 1),
(14, 'SucrÃ©', NULL, 1, 1),
(16, 'F.SECS', 14, 0, 1),
(17, 'CONDIMENT', 11, 0, 1),
(18, 'SEL', 11, 0, 1),
(19, 'AROM.', 11, 0, 1),
(20, 'APERO', 13, 0, 1),
(21, 'SUCRE', 14, 0, 1),
(22, 'FARINE', 10, 0, 1),
(23, 'HUILE', 11, 0, 1),
(24, 'CONS.', 13, 0, 1),
(25, 'PATES', 10, 0, 1),
(26, 'CEREALES', 10, 0, 1),
(27, 'LEGUM.', 12, 0, 1),
(28, 'CONFITURE', 14, 0, 1),
(29, 'MIEL', 14, 0, 1),
(30, 'A.TART.', 14, 0, 1),
(31, 'P.DEJ.', 14, 0, 1),
(33, 'GATO', 14, 0, 1),
(34, 'BOISSON', 2, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `_inde_COMPTES`
--

CREATE TABLE IF NOT EXISTS `_inde_COMPTES` (
  `ID_ADHERENT` smallint(6) NOT NULL,
  `SOLDE` float NOT NULL,
  `DATE` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `OPERATION` varchar(32) collate latin1_general_ci NOT NULL,
  `MONTANT` float NOT NULL,
  KEY `ID_ADHERENT` (`ID_ADHERENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `_inde_DOCUMENTS`
--

CREATE TABLE IF NOT EXISTS `_inde_DOCUMENTS` (
  `ID_DOCUMENT` smallint(6) NOT NULL auto_increment,
  `NOM` varchar(128) character set utf8 collate utf8_bin default NULL,
  `ID_TYPE` smallint(6) NOT NULL,
  `ID_FOURNISSEUR` smallint(6) default NULL,
  `DESCRIPTION` varchar(255) character set utf8 collate utf8_bin default NULL,
  `DATE` varchar(64) collate latin1_general_ci default NULL,
  `NET_A_PAYER` varchar(64) character set utf8 collate utf8_bin default NULL,
  UNIQUE KEY `ID` (`ID_DOCUMENT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=49 ;

--
-- Contenu de la table `_inde_DOCUMENTS`
--

INSERT INTO `_inde_DOCUMENTS` (`ID_DOCUMENT`, `NOM`, `ID_TYPE`, `ID_FOURNISSEUR`, `DESCRIPTION`, `DATE`, `NET_A_PAYER`) VALUES
(9, 'Bulletin_Adhesion-Independante-2012-2013.pdf', 3, NULL, NULL, '09/11/2012', NULL),
(2, 'tract_L_INDEPENDANTE.doc', 3, NULL, NULL, '09/10/2012', NULL),
(3, 'LeGrosChatduMarche.pdf', 3, NULL, NULL, '13 octobre 2012', NULL),
(4, 'Commande_Marie-Pierre_Lenoir.pdf', 2, 23, NULL, '03 octobre 2012', '316.5'),
(5, 'commande_Terra_Libra_141012.xls', 2, 1, NULL, '14 octobre 2012', '941.32'),
(6, 'commandeAndines_Independante02.xls', 2, 20, NULL, '14 octobre 2012', '461.41'),
(7, 'facture-201202-24.pdf', 1, 8, NULL, '29/02/2012', '206,25'),
(8, 'TerraLibraFact-14:10:12002.pdf', 1, 1, NULL, '14/10/2012', '738,02'),
(10, 'Andines-facture-08_11_2012.pdf', 1, 20, NULL, '08/11/2012', '321.26'),
(11, 'Tarif_terralibra_Novembre2012.xls', 3, NULL, NULL, '16 novembre 2012', NULL),
(12, 'commande_Terra_Libra_18112012.xls', 2, 1, NULL, '18 novembre 2011', '1544,10'),
(13, 'ProvincesBio-facture-22_11_2012.pdf', 1, 13, NULL, '22/11/2012', '816.66'),
(14, 'Provinces-Bio-Commande.xls', 2, 13, NULL, '21/11/2012', '1153.80'),
(15, 'facture_ICI_decembre2012.pdf', 1, 8, NULL, '14 dÃ©cembre 2012', '342.88'),
(16, 'facture_ProvBio_decembre2012.pdf', 1, 13, NULL, '30/11/12', '816.66'),
(17, 'facture_TerraLibra_decembre2012.pdf', 1, 1, NULL, '23/11/2012', '1570.47'),
(18, 'Andines-BL-20121220.pdf', 1, 20, NULL, '20 dÃ©cembre 2012', '322,66 HT'),
(19, 'Andines_17-12-2012.pdf', 1, 20, NULL, '17 dÃ©cembre 2012', '340,41'),
(24, 'Tarif_terralibra_3V1_Novembre12_recus_le_12022013.xls', 3, NULL, NULL, '12 fÃ©vrier 2013', NULL),
(21, 'PROVINCES_BIO_BL_29-01-2013.pdf', 1, 13, NULL, '29/01/2013', '485,23'),
(22, 'comptaIndependante2013_janv.pdf', 3, NULL, NULL, '', NULL),
(23, 'StatutsIndependante.pdf', 3, NULL, NULL, '05 fÃ©vrier 2013', NULL),
(25, 'Terralibra_Bon_de_commande_3:2013.xls', 2, 1, NULL, '3 mars 2013', '1851,17'),
(26, 'ANDINES_Tarif_2013_des_produits_alimentaires_et_soins_du_corps.xls', 3, NULL, NULL, '', NULL),
(27, 'comptaIndependante_mars2013.pdf', 3, NULL, NULL, '01/04/2013', NULL),
(28, 'Facture_Ferme_au_Colombier_avril_2013.pdf', 1, 27, NULL, '04 avril 2013', '97,00'),
(29, 'Tarif_terralibra_3V1.Avril13.xls', 3, NULL, NULL, '12 avril 2013', NULL),
(30, 'Tarif_artisanat_3V1.Avril13.xls', 3, NULL, NULL, '', NULL),
(31, 'Modifications_et_nouveautÃ©s_Avril13.pdf', 3, NULL, NULL, '', NULL),
(32, 'commande_Terra_Libra_12_avril_2013.xls', 2, 1, NULL, '12 avril 2013', '1482,35'),
(33, 'Tarif_terralibra_3V1.Avril13.xls', 3, NULL, NULL, '15 avril 2013', NULL),
(34, 'Liste_complÃ©mentaire.Avril13.V1.xls', 3, NULL, NULL, '15 avril 2013', NULL),
(35, 'Tarif_artisanat_3V1.Avril13.xls', 3, NULL, NULL, '15 avril 2013', NULL),
(36, 'beuk.jpg', 3, NULL, NULL, '', NULL),
(37, 'Adherents_Independante2013.pdf', 3, NULL, NULL, '', NULL),
(38, 'LeMondeLibertaire.pdf', 3, NULL, NULL, '17 mai 2013', NULL),
(39, 'ProvincesBio_tarifs_2013.pdf', 3, NULL, NULL, '17 mai 2013', NULL),
(40, 'comptaIndependante_mai2013.pdf', 3, NULL, NULL, '', NULL),
(41, 'PROVINCES_BIO_BL_28-05-2013.pdf', 1, 13, NULL, '28 mai 2013', '420.03'),
(42, 'comptaIndependante_juin2013.pdf', 3, NULL, NULL, '03/07', NULL),
(43, 'comptaIndependante2013_juil.pdf', 3, NULL, NULL, '30 juillet 2013', NULL),
(44, 'Tarif_terralibra_3V2.Avril.13.xls', 3, NULL, NULL, '30 aout 2013', NULL),
(45, 'Facture_Esperanza_cafe_20130919.pdf', 1, 31, NULL, '19 septembre 2013', '67.10'),
(46, 'comptaIndependante2013_sept13.pdf', 3, NULL, NULL, '26 sept 2013', NULL),
(47, 'ANDINES_Tarif_SEPTEMBRE_2013_des_produits_alimentaires_et_soins_du_corps.xls', 3, NULL, NULL, '04 octobre 2013', NULL),
(48, 'comptaIndependante2013.pdf', 3, NULL, NULL, '23 novembre 2013', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `_inde_FOURNISSEURS`
--

CREATE TABLE IF NOT EXISTS `_inde_FOURNISSEURS` (
  `ID_FOURNISSEUR` smallint(6) NOT NULL auto_increment,
  `NOM` varchar(255) NOT NULL,
  `MAIL` varchar(255) default NULL,
  `ADRESSE` varchar(255) default NULL,
  `CONTACT` varchar(255) default NULL,
  `TELEPHONE_FIXE` varchar(255) default NULL,
  `TELEPHONE_PORTABLE` varchar(255) default NULL,
  `FAX` varchar(255) default NULL,
  `DATE_REFERENCEMENT` date NOT NULL,
  `COMMENTAIRE` varchar(1024) default NULL,
  `VISIBLE` tinyint(1) NOT NULL default '1',
  UNIQUE KEY `NOM` (`NOM`),
  KEY `ID_FOURNISSEUR` (`ID_FOURNISSEUR`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `_inde_FOURNISSEURS`
--

INSERT INTO `_inde_FOURNISSEURS` (`ID_FOURNISSEUR`, `NOM`, `MAIL`, `ADRESSE`, `CONTACT`, `TELEPHONE_FIXE`, `TELEPHONE_PORTABLE`, `FAX`, `DATE_REFERENCEMENT`, `COMMENTAIRE`, `VISIBLE`) VALUES
(1, 'TERRA LIBRA', 'contact@terralibra.fr', '6 rue Antoine de St ExupÃ©ry ZA Bellevue 35235 ThorignÃ© Fouillard', 'Thomas Burel', '02 99 37 14 00', '', '', '0000-00-00', 'Commander dimanche pour livraison mardi, mercredi voire jeudi. Donner Ã  Marie-Laure (administration@lamaisonverte.org) les numÃ©ros de tÃ©lÃ©phones des personnes qui font la livraison. Ne pas oublier de prendre la liste des produits manquants dans le placard.', 1),
(2, 'ELIA', 'elia1950@yahoo.com', '', '', '', '', '', '0000-00-00', '', 1),
(3, 'LA POMME DU COTEAU', 'frederic.vanpoulle@laposte.net', '35580 Guichen', 'FrÃ©dÃ©ric Vanpoulle', '', '06 58 03 08 44', '', '0000-00-00', '', 1),
(4, 'LE CHAMP DE BLE EARL', '', 'Bois de BÃ©chÃ©tery 72600 Louvigny', 'Thierry et Marie Chable', '02 43 34 00 11', '', '', '0000-00-00', 'Via Caroline', 1),
(5, 'GAEC LA SALORGE', '', 'Marais aux FÃ¨ves 85340 Ile d''Olonne', 'Mathieu', '', '', '', '0000-00-00', '', 1),
(6, 'GAMET RÃ©mi', '', '', '', '', '', '', '0000-00-00', '', 1),
(7, 'FERME DES MARES', '', '61110 CONDE SUR HUISNE', 'Anne-Laure et Philippe DUHOUX', '02 33 83 67 63', '', '', '0000-00-00', '', 1),
(8, 'ICI : l''Ã©picerie locavore', 'contact@lepicerie-locavore.fr', '17-25 rue Charles Graindorge 93170 Bagnolet', '', '09 53 30 15 89', '06 14 04 49 56', '', '0000-00-00', 'pÃ¢tes, farine, lentilles, pois cassÃ©s', 1),
(9, 'L\\_INDEPENDANTE', '', '', '', '', '', '', '0000-00-00', '', 1),
(10, 'LE JARDIN D''EGLANTINE', '', 'Lieu-dit Revel 82190 LACOUR', 'Astrid LECOSSOIS', '05.63.95.50.78', '', '', '0000-00-00', 'www.lejardindeglantine.com', 1),
(11, 'L''Ã®lot ThÃ©', 'contact@ilot-the.com', 'L''Ã®le 29410 Plouneour-Menez', 'SEBASTIEN MALGORN', '02 98 78 08 44', '', '02 98 78 08 44', '0000-00-00', 'BIEN DEMANDER LE TARIF PRO POUR L''INDEPENDANTE ', 1),
(12, 'Fermme de Valbonne', '', ' VALBONNE ,30570 ST AndrÃ© de Majencoules', 'MICHEL LEVESQUE', '04.67.82.46.43', '', '', '0000-00-00', 'mieux vaut utiliser le telephone car les connections internet sont incertaines .chataignes et compagnie cultivÃ©es de faÃ§on bio dynamique sans le label . ', 1),
(13, 'provinces bio', 'provincesbio@awnadoo.fr', 'MIN de Nantes. case NÂ°6 ouest , 58 blvd Gustave Roch, 44261 Nantes cedex', '', '240489393', '', '', '0000-00-00', '', 1),
(14, 'Levesque Michel', '', 'Valbonne 30 570 St AndrÃ© de Majencoules', 'www.fermedevalbonne.com', '467824643', '', '', '0000-00-00', '', 1),
(15, 'Rampal latour', '', '', '', '', '', '', '0000-00-00', '', 1),
(16, 'CRISTOPHE LECUYER', '', 'ferme de la rue  . 61110 Bretoncelles', 'Christophe lecuyer', '237372687', '', '', '0000-00-00', 'il quitte le collectif percheron . Ã  voir donc en directe ', 1),
(17, 'MICHEL DUCROCQ', '', '', '', '', '', '', '0000-00-00', '', 1),
(18, 'LA REINETTE  VERTE', '', '', '', '', '', '', '0000-00-00', 'via le collectif percheron', 1),
(19, 'APIHAPPY', 'contactapihappy@gmail.com', '2 place de la fontaine 91190 Saint Aubin', 'Julien', '01 69 41 50 14', '', '', '0000-00-00', 'site internet : apihappy.fr', 1),
(20, 'ANDINES', '', '5, RUE DE LA POTERIE 93200 ST DENIS', 'www.andines.com', '148204860', '', '148205093', '0000-00-00', 'SARL SCOP - payable Ã  la rÃ©ception des marchandises', 1),
(21, 'LES TONTONS FRANCOIS', '', '', '', '', '', '', '0000-00-00', '', 0),
(22, 'Les Tontons FranÃ§ois -paysan charcutier-', 'francoislepaysan@free.fr', 'Fon Pouyride 81140 VAOUR -Tarn-', '', '05.63.56.28.77', '06.78.57.76.71', '', '0000-00-00', 'Eleveur de la race de porc noir gascon qui a la particularitÃ© d''Ãªtre aussi son propre charcutier grÃ¢ce Ã  un abattoir et une mise en conditionnement propre. Mise en commun avec d''autres producteurs de viande de son village.', 1),
(23, 'Marie-Pierre Lenoir', 'mp.lenoir@gmail.com', '26150 Saint-AndÃ©ol en Quint', NULL, '04 75 21 21 55', NULL, NULL, '0000-00-00', NULL, 1),
(24, 'REMISES A FLOTS', '', '', '', '', '', '', '2013-02-20', 'PÃ©niche', 1),
(25, 'LES JARDINS DE PRIAPE', 'lesjardinsdepriape@free.fr', '16 Hameau Les Cruaux 02220 CHERY CHARTREUVE', 'Nicolas BEAUFILS', '03 23 75 02 28', '', '', '2013-03-28', '', 1),
(26, 'SPIRULINE DES ILES D OR', 'patrick.artufel@wanadoo.fr', '1143 Chemin de la garde 83400 HYERES', 'Patrick ARTUFEL / Celine SORIA', '06 12 86 44 58', '06 20 76 32 77', '', '2013-03-28', '', 1),
(27, 'LA FERME AU COLOMBIER', 'rlhopiteau@terre-net.fr;francoislhopiteau@wanadoo.fr', '2 Rue d\\_Ormoy 28210 NÃ©ron', 'Romain (fils) et FranÃ§ois (pÃ¨re) LHOPITEAU', '', '', '', '2013-04-04', '', 1),
(28, 'AINSI FRANÃ§OIS', '', 'Fon Pouyride 81140', 'franÃ§ois', '0563562877', '', '', '2013-04-11', 'cochon gascon Ã©lev en plein air', 1),
(29, 'ECODIS', 'commercial@ecodis.info', 'za du kerboulard rue de GallilÃ© 56250 St NOLFF', '', '0297484059', '', '', '2013-06-21', 'produits entretien', 1),
(30, 'NATURE ET PAYSANS', '', '34 Grande Rue 10290 Villadin', 'Patrick', '0325249332', '0660800302 (Guillaume)', '', '2013-06-29', '', 1),
(31, 'ESPERANZA CAFÃ©', 'florent@esperanzacafe.com', '', 'Florent GOUT', '', '', '', '2013-09-19', '', 1),
(32, 'LA CLÃ©MENTERIE', 'laclementerie@mail.org', 'Hameau La clÃ©menterie, La Souche, Aubenas, ArdÃ¨che.', 'Julie ou Damien', '04/75/37/26/33', '', '', '2013-10-01', 'blog: la-clementerie.rÃ©volublog.com', 1),
(33, 'CORTO', '', '', 'Robert Pires', '', '', '', '2013-10-17', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `_inde_REFERENCES`
--

CREATE TABLE IF NOT EXISTS `_inde_REFERENCES` (
  `ID_REFERENCE` smallint(6) NOT NULL auto_increment,
  `DESIGNATION` varchar(64) collate latin1_general_ci NOT NULL,
  `ID_FOURNISSEUR` smallint(6) NOT NULL,
  `VRAC` tinyint(4) NOT NULL,
  `ID_CATEGORIE` smallint(6) NOT NULL,
  `PRIX_TTC` float NOT NULL,
  `TVA` float NOT NULL,
  `VISIBLE` tinyint(4) NOT NULL,
  `CODE_FOURNISSEUR` varchar(32) collate latin1_general_ci default NULL,
  `COMMENTAIRE` varchar(256) collate latin1_general_ci default NULL,
  `DATE_REFERENCEMENT` datetime NOT NULL,
  PRIMARY KEY  (`ID_REFERENCE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=333 ;

--
-- Contenu de la table `_inde_REFERENCES`
--

INSERT INTO `_inde_REFERENCES` (`ID_REFERENCE`, `DESIGNATION`, `ID_FOURNISSEUR`, `VRAC`, `ID_CATEGORIE`, `PRIX_TTC`, `TVA`, `VISIBLE`, `CODE_FOURNISSEUR`, `COMMENTAIRE`, `DATE_REFERENCEMENT`) VALUES
(14, 'ROOIBOS ROUGE', 11, 1, 34, 17.49, 5.5, 1, '', '', '2013-02-19 15:24:19'),
(13, 'MATÃ© VERT ET AGRUMES EN FEUILLES 100G', 1, 0, 34, 2.7, 0, 1, 'AO-0005', 'Sol a Sol - Argentine', '2013-02-19 15:18:41'),
(12, 'AROMATES (THYM, SARRIETTE, ORIGAN, ROMARIN)', 23, 0, 19, 2.1, 5.5, 1, '', '', '2013-02-19 15:16:07'),
(11, 'OLIVES ARTISANALES AU NATUREL', 2, 0, 20, 4.5, 0, 1, '', '', '2013-02-19 15:00:00'),
(15, 'LAPSANG SOUCHONG', 11, 1, 5, 32.28, 5.5, 1, '', '', '2013-02-19 15:25:31'),
(16, 'PU ERH TUOCHA EN FEUILLES 100G BIO', 1, 0, 5, 4.08, 0, 1, 'AT-0114', '', '2013-02-19 15:26:47'),
(17, 'VERT GUNPOWDER Ã®LOT THÃ©', 11, 1, 5, 21.52, 5.5, 1, '', '', '2013-02-19 15:36:03'),
(18, 'VERT SENCHA', 11, 1, 5, 29.14, 5.5, 1, '', '', '2013-02-19 15:38:16'),
(19, 'FONIO PRÃ©-CUIT 500G', 20, 0, 26, 3.1, 0, 1, '', '', '2013-02-19 15:41:01'),
(20, 'CHOCOLAT NOIR DE NOIR 85% 100G', 1, 0, 15, 1.97, 5.5, 1, 'AS-22000 ', 'Saldac - PÃ©rou', '2013-02-19 15:42:27'),
(21, 'CHOCOLAT NOIR ET CAFÃ©', 1, 0, 15, 1.9, 5.5, 1, '', '', '2013-02-19 15:43:25'),
(22, 'CHOCOLAT NOIR, Ã©CLATS DE FÃ¨VES GRILLÃ©ES EL INTI 100G', 1, 0, 15, 1.97, 5.5, 1, 'AS-22007 ', 'Saldac - PÃ©rou', '2013-02-19 15:44:33'),
(23, 'LIQUIDE VAISSELLE CAMOMIL LAIT 5L', 13, 1, 9, 2.32, 0, 1, '3631029', '', '2013-02-19 15:46:44'),
(24, 'PASTILLE LAVE-VAISELLE 500G', 13, 0, 9, 4.04, 19.6, 1, '3631032', 'modifiÃ© le 23/11/2012', '2013-02-19 15:48:26'),
(25, 'SAVON EN PAILLETTES - RAMPAL LATOUR', 15, 1, 9, 5.6, 19.6, 1, '', 'en sac de 2 kg', '2013-02-19 15:49:49'),
(26, 'SAVON NOIR TRADITIONNEL ECODOO 1LITRE', 13, 0, 9, 5.26, 19.6, 1, '3545008', 'Nouvelle rÃ©fÃ©rence saisie le 23/11/2012', '2013-02-19 15:50:57'),
(27, 'AMANDES COMPLÃ¨TES VRAC 10KG', 1, 1, 16, 9.64, 5.5, 1, '', '', '2013-02-19 15:51:51'),
(28, 'DATTES DEGLET NOUR BRANCHÃ©ES 5 KG', 1, 1, 16, 4.35, 5.5, 1, 'AP-0016', 'Raiponce - Tunisie', '2013-02-19 15:52:50'),
(29, 'BLÃ© T80', 8, 1, 22, 1.95, 5.5, 0, '', '', '2013-02-19 15:54:03'),
(30, 'MAÃ¯ZENA 250G', 13, 0, 22, 1.89, 5.5, 1, '3541004', '', '2013-02-19 15:54:59'),
(31, 'SARRASIN', 8, 1, 22, 5.49, 5.5, 0, '', '', '2013-02-19 15:55:51'),
(32, 'SARRASIN T80 1 KG', 1, 0, 22, 2.39, 5.5, 1, 'AL-JC402', 'JP Cloteau - Bretagne', '2013-02-19 15:56:49'),
(33, 'D OLIVES GRECQUE 5L', 2, 1, 23, 7.2, 0, 1, '', '', '2013-02-19 15:58:54'),
(34, 'FLAGEOLETS 5 KG', 1, 1, 27, 5.45, 5.5, 1, 'AL-SG032', 'Sac Ã  Grains - VendÃ©e', '2013-02-19 16:00:41'),
(35, 'HARICOTS BLANCS NAVY SECS 5KG VRAC', 1, 1, 27, 4.98, 5.5, 1, 'AL-SG022 ', 'Sac Ã  Grains - VendÃ©e', '2013-02-19 16:14:13'),
(36, 'HARICOTS ROUGES 5 KG VRAC', 1, 1, 27, 4.98, 5.5, 1, 'AL-SG027 ', 'Sac Ã  Grains - VendÃ©e', '2013-02-19 16:17:07'),
(37, 'LENTILLES VERTES VRAC 5KG TERRALIBRA', 1, 1, 27, 3.27, 5.5, 1, 'AL-SG002', 'Nouvelle rÃ©fÃ©rence entrÃ©e le 13 fÃ©vrier 2013', '2013-02-19 16:18:14'),
(38, 'CORN FLAKES NATURE SANS SUCRE 500G', 1, 0, 31, 2.79, 5.5, 1, 'AL-GO031 ', 'Grillon d\\_Or - Bretagne', '2013-02-19 16:19:32'),
(39, 'MUESLI FAMILIAL AUX FRUITS 1KG', 1, 0, 31, 4, 5.5, 1, 'AL-GO012 ', 'Grillon d\\_Or - Bretagne', '2013-02-19 16:21:07'),
(40, 'POUDRE CACAO AMER EQUATEUR 300G', 20, 0, 31, 5.75, 5.5, 1, 'RFD02', 'Prix en hausse le 09/11/2012 (de 5.74 Ã  5.75)', '2013-02-19 16:24:13'),
(41, 'COQUILLETTES NATURE VRAC 5KG', 1, 1, 25, 2.2, 5.5, 1, '', '', '2013-02-19 16:26:27'),
(42, 'PENNE RIGATE DEMI-COMPLÃ¨TES VRAC', 1, 1, 25, 3.35, 5.5, 1, 'AL-PF018', 'PÃ¢tes Fabre - Berry\r\nmodifiÃ© Ã  la hausse le 28/05/13', '2013-02-19 16:29:58'),
(43, 'RISI TOASTÃ©S DE DÃ©GUSTATION', 8, 1, 25, 5.28, 5.5, 0, '', '', '2013-02-19 16:31:18'),
(44, 'SPAGHETTI NID NATURE 3KG', 1, 1, 25, 3.98, 5.5, 1, '', '', '2013-02-19 16:32:12'),
(45, 'TAGLIATELLES SEMI-COMPLÃ¨TES VRAC', 1, 1, 25, 4.26, 5.5, 1, 'AL-PF012', 'modifiÃ© Ã  la hausse le 28/05/13', '2013-02-19 16:33:15'),
(46, 'TORSADES 5KG', 1, 1, 25, 3.31, 5.5, 1, 'AL-PF016 ', 'PÃ¢tes Fabre - Berry\r\nmodifiÃ© Ã  la baisse', '2013-02-19 16:37:54'),
(47, 'ACÃ©ROLA EN POUDRE 70 G', 1, 0, 8, 7.39, 5.5, 1, 'AR-10017', 'RDV Prod - BrÃ©sil', '2013-02-19 16:48:29'),
(48, 'ARGILE BLANCHE VENTILÃ©E CIEL D AZUR 300G', 13, 0, 8, 3.61, 19.6, 1, '1601110', 'Nouvelle rÃ©fÃ©rence saisie le 23/11/2012', '2013-02-19 16:49:26'),
(49, 'COTON-TIGES (200)', 13, 0, 8, 1.08, 19.6, 1, '3611011', '', '2013-02-19 16:50:50'),
(50, 'DENTICLAY ANIS', 13, 0, 8, 3.33, 19.6, 1, '', '', '2013-02-19 16:52:29'),
(51, 'DENTIFRICE CITRON RAFFERMISSANT 75ML', 13, 0, 8, 3.34, 19.6, 1, '1601320', 'Denticlay', '2013-02-19 16:54:22'),
(52, 'DENTIFRICE SAUGE TONIQUE DENTICLAY 75ML', 13, 0, 8, 3.34, 19.6, 1, '1601370', 'Denticlay', '2013-02-19 16:55:09'),
(53, 'EXFOLIANT DOUX VISAGE AUX ACTIFS MARINS 125 ML BIO', 1, 0, 8, 5.42, 0, 1, 'CB-0061', '', '2013-02-19 16:55:58'),
(54, 'GEL DOUCHE PASSION MARINE 500ML BIO', 1, 0, 8, 8.2, 0, 1, 'CB-0023', '', '2013-02-19 16:56:50'),
(55, 'SAVON Ã  L HUILE D OLIVE DE PALESTINE', 20, 0, 8, 1.91, 19.6, 1, '', 'Savon Ã  l\\_huile d\\_olive de Palestine "les Amis de Naplouse"', '2013-02-19 16:58:54'),
(56, 'SAVON D ALEP "MUMTAZ" VÃ©RITABLE 200G', 1, 0, 8, 3.93, 19.6, 1, 'CD-0001', 'Salaheddin - Syrie', '2013-02-19 16:59:59'),
(57, 'SAVON EXFOLIANT AUX ALGUES ET Ã  L ARGILE VERTE 100G', 1, 0, 8, 2.33, 19.6, 1, 'CB-0001', 'Bretagne OcÃ©an - Bretagne', '2013-02-19 17:00:55'),
(58, 'SOIN - SERVIETTES HYGIÃ©NIQUE "SUPER" (12)', 13, 0, 8, 2.7, 19.6, 1, '354156', 'Nouvelle rÃ©fÃ©rence saisie le 23/11/2021', '2013-02-19 17:01:48'),
(59, 'SERVIETTES HYGIÃ©NIQUES NORMAL (14)', 13, 0, 8, 2.74, 19.6, 1, '354154', '', '2013-02-19 17:02:30'),
(60, 'SHAMPOING DOUCHE 3 LITRE', 1, 1, 8, 9.69, 19.6, 1, 'CB-0027', 'SAISI LE 25/11/2012', '2013-02-19 17:04:08'),
(61, 'TAMPONS HYGIÃ©NIQUES NATRACARE (20)', 13, 0, 8, 3.57, 19.6, 1, '354160', 'ModifiÃ© le 23/11/2012', '2013-02-19 17:05:06'),
(62, 'SUCRE DE CANNE COMPLET PANELA 425G BIO', 1, 0, 21, 1.78, 0, 1, 'AS-50035', '', '2013-02-19 17:05:59'),
(63, 'SUCRE DE CANNE RAPADURA 500G', 1, 0, 21, 2.98, 5.5, 1, '', 'Rapunzel', '2013-02-19 17:06:51'),
(64, 'CRÃ¨ME DE MARRON 410G', 14, 0, 30, 4.5, 5.5, 1, '', '', '2013-02-20 10:58:40'),
(65, 'CRÃ¨ME DE MARRONS AVEC MORCEAUX 420G', 14, 0, 30, 4.5, 5.5, 1, '', '', '2013-02-20 10:59:47'),
(66, 'CRUNCHY CHOCOLADE 350G', 13, 0, 30, 3.85, 5.5, 1, '1400009', 'Nouvelle rÃ©fÃ©rence saisie le 23/11/2012', '2013-02-20 11:00:56'),
(67, 'KAROUBA SANS LAIT 340G', 13, 0, 30, 4.1, 5.5, 1, '1401040', '', '2013-02-20 11:02:25'),
(68, 'PURÃ©E AMANDE COMPLÃ¨TE 350G', 13, 0, 30, 5.33, 5.5, 1, '1401300', 'Prix modifie le 30 mai 2013 (de 3.88 a 5.33)', '2013-02-20 11:03:39'),
(69, 'PURÃ©E AMANDE COMPLÃ¨TE 700G', 13, 0, 30, 8.91, 5.5, 1, '1401310', '', '2013-02-20 11:06:45'),
(70, 'PURÃ©E NOISETTE ITALIE 350G', 13, 0, 30, 5.17, 5.5, 1, '1401100', '', '2013-02-20 11:11:40'),
(71, 'PURÃ©E SÃ©SAME 1/2 COMPLET TAHIN 350G', 13, 0, 30, 3.14, 5.5, 1, '', '', '2013-02-20 11:12:46'),
(72, 'PURÃ©E SÃ©SAME 1/2 COMPLET 700G', 13, 0, 30, 5.36, 5.5, 1, '1401610', '', '2013-02-20 11:13:56'),
(73, 'PURÃ©E SÃ©SAME BLANC TAHIN 700G', 13, 0, 30, 5.64, 5.5, 1, '1401710', 'Nouvelle rÃ©fÃ©rence rentrÃ©e le 23/11/2012', '2013-02-20 11:17:32'),
(74, 'JUS D ORANGE DEMETER 5L', 1, 1, 3, 2.98, 5.5, 1, '', '', '2013-02-20 11:23:02'),
(75, 'JUS DE LÃ©GUMES 75CL', 1, 0, 3, 2.69, 5.5, 1, '', '', '2013-02-20 11:23:54'),
(76, 'MEUH COLA', 1, 0, 34, 1.89, 5.5, 1, '', '', '2013-02-20 11:24:43'),
(77, 'SIROP DE CASSIS 50CL', 1, 0, 34, 3.48, 5.5, 1, '', '', '2013-02-20 11:26:10'),
(78, 'SIROP DE MYRTILLES 50CL', 1, 0, 34, 3.3, 5.5, 1, '', '', '2013-02-20 11:28:41'),
(79, 'COUCOUS COMPLET 500G', 1, 0, 26, 2.22, 5.5, 1, 'AL-GO071', 'Grillon d\\_Or - Bretagne', '2013-02-20 11:30:05'),
(80, 'PETIT Ã©PEAUTRE 500G CELNAT', 13, 0, 26, 1.78, 5.5, 1, '1811094', '', '2013-02-20 11:32:13'),
(81, 'QUINOA D EQUATEUR (1 KG)', 20, 0, 26, 5.43, 5.5, 1, 'RFB02', '', '2013-02-20 11:32:59'),
(82, 'CANELLE POUDRE 35G', 20, 0, 17, 1.85, 5.5, 1, '', '', '2013-02-20 11:41:27'),
(83, 'CONCENTRÃ© DE TOMATE 22% 200G', 1, 0, 17, 1.47, 5.5, 1, 'AP-0512', 'Raiponce - Italie', '2013-02-20 11:42:38'),
(84, 'COURT BOUILLON AU SEL DE GUÃ©RANDE, AUX ALGUES MARINES 70G', 1, 0, 17, 2.75, 0, 1, 'AL-BO013', '', '2013-02-20 11:43:40'),
(85, 'COURT-BOUILLON AU SEL DE GUÃ©RANDE, SAVEUR OCÃ©AN 70G', 1, 0, 17, 2.75, 5.5, 1, '', '', '2013-02-20 11:45:45'),
(86, 'COURT-BOUILLON AU SEL DE GUÃ©RANDE, SAVEUR PROVENÃ§ALES 70G', 1, 0, 17, 2.75, 5.5, 1, '', '', '2013-02-20 11:46:20'),
(87, 'MOUTARDE AUX ALGUES 200G', 1, 0, 17, 2.39, 5.5, 1, 'AL-BO001', 'Bretagne OcÃ©an - Bretagne', '2013-02-20 11:47:17'),
(88, 'POIVRE EN GRAINS 35G', 20, 0, 17, 1.35, 5.5, 1, '', '', '2013-02-20 11:48:05'),
(89, 'POIVRE MOULU 35G', 20, 0, 17, 1.6, 5.5, 1, '', '', '2013-02-20 11:49:40'),
(90, 'PURÃ©E DE TOMATES PASSATA 400G', 1, 0, 17, 1.52, 5.5, 1, 'AP-0513', 'Italie', '2013-02-20 11:51:22'),
(91, 'SÃ©SAME BIGARRÃ© 500G', 20, 0, 17, 7.52, 5.5, 1, '', '', '2013-02-20 11:52:05'),
(92, 'VANILLE 4 GOUSSES MADAGASCAR 8G', 20, 0, 17, 1.85, 5.5, 1, '', '', '2013-02-20 11:52:57'),
(93, 'VINAIGRE BALSAMIQUE 50CL', 1, 0, 17, 4.11, 5.5, 1, 'AP-0121 ', 'Raiponce - Italie', '2013-02-20 11:54:17'),
(94, 'CITRONS CONFITS 720 ML BIO', 1, 0, 17, 3.87, 0, 1, 'AL-PB301', '', '2013-02-20 11:55:12'),
(95, 'CHATAIGNES 420G', 14, 0, 28, 4.5, 5.5, 1, '', '', '2013-02-20 15:29:24'),
(96, 'COMPOTE DE POMME-CASSIS- 400G', 1, 0, 28, 3.32, 5.5, 1, 'AL-PC101', 'PremiÃ¨re commande 16 octobre 2012', '2013-02-20 15:30:18'),
(97, 'FIGUES 390G', 14, 0, 28, 4.5, 5.5, 1, '', '', '2013-02-20 15:31:03'),
(98, 'GELÃ©E DE COINGS 420G', 14, 0, 28, 4.5, 5.5, 1, '', '', '2013-02-20 15:31:43'),
(99, 'PRUNES NATURE & PROGRÃ¨S 350G', 1, 0, 28, 3.32, 5.5, 1, 'AL-PC013', 'P, Champigny - Bretagne', '2013-02-20 15:32:47'),
(100, 'PRUNES&MENTHE', 1, 0, 28, 3.32, 0, 1, 'Natures et progrÃ¨s', '', '2013-02-20 15:33:38'),
(101, 'SUREAU 420G', 14, 0, 28, 4.5, 5.5, 1, '', '', '2013-02-20 15:34:29'),
(102, 'BOUDIN 250G (RAF)', 24, 0, 24, 2.61, 0, 1, '', '', '2013-02-20 15:38:31'),
(103, 'CONFIT DE CANARD 840G (RAF)', 24, 0, 24, 10.51, 0, 1, '', '', '2013-02-20 15:39:23'),
(104, 'POTAGE AU POTIMARRON Ã©PICÃ©', 1, 0, 24, 3.3, 5.5, 1, '', '', '2013-02-20 15:40:26'),
(105, 'POTAGE LÃ©GUMES VERTS 1LITRE', 1, 0, 24, 3.08, 5.5, 1, 'AL- PB002', 'PremiÃ¨re commande 16 octobre 2012', '2013-02-20 15:41:14'),
(106, 'SOUPE DE POISSONS 480 G', 1, 0, 24, 2.57, 5.5, 1, 'AL-BO002', 'Bretagne OcÃ©an - Bretagne', '2013-02-20 15:42:18'),
(107, 'BISCUITS Ã  LA NOIX DE COCO P/16 110G BIO', 1, 0, 33, 1.65, 0, 1, 'AL-RO012', '', '2013-02-20 15:43:42'),
(108, 'BISCUITS FIGUES & SON P/16 110G', 1, 0, 33, 1.49, 5.5, 1, 'AL-RO011', 'Bio Roc\\_hÃ©lou', '2013-02-20 15:44:30'),
(109, 'GALETTES BRETONNES P/16 120G', 1, 0, 33, 1.49, 5.5, 1, 'AL-RO002 ', 'Bio Roc\\_hÃ©lou - Bretagne', '2013-02-20 15:45:33'),
(110, 'PALETS BRETONS P/12 200G', 1, 0, 33, 3.07, 5.5, 1, 'AL-RO001 ', 'Bio Roc\\_hÃ©lou - Bretagne', '2013-02-20 15:46:37'),
(111, 'POIS CHICHES 500G', 1, 0, 27, 1.8, 5.5, 1, 'AL-GO062', 'Grillon d\\_Or - Bretagne', '2013-02-20 15:48:25'),
(112, 'ACACIA 1 KG', 6, 0, 29, 12, 0, 1, '', '', '2013-02-20 15:51:03'),
(113, 'ACACIA 500G', 6, 0, 29, 6.5, 0, 1, '', '', '2013-02-20 15:53:27'),
(114, 'DE PRINTEMPS 500G (APIHAPPY)', 19, 0, 29, 5.3, 0, 1, '', '', '2013-02-20 15:54:19'),
(115, 'FLEURS D Ã©TÃ© 500 GR', 6, 0, 29, 6.5, 0, 1, '', '', '2013-02-20 15:56:00'),
(116, 'LAVANDE 1KG (RAF)', 24, 0, 29, 12.48, 0, 1, '', '', '2013-02-20 15:56:52'),
(117, 'PRINTEMPS 1KG', 6, 0, 29, 8, 0, 1, '', '', '2013-02-20 15:57:38'),
(118, 'TOUTES FLEURS 1KG', 6, 0, 29, 8, 0, 1, '', '', '2013-02-20 15:58:20'),
(119, 'TOUTES FLEURS 500G', 6, 0, 29, 4.5, 0, 1, '', '', '2013-02-20 15:58:55'),
(120, 'FLEUR DE SEL125G', 5, 0, 18, 1.7, 5.5, 1, '', '', '2013-02-20 16:01:50'),
(121, 'GROS SEL 1KG', 5, 0, 18, 0.85, 0, 1, '', '', '2013-02-20 16:02:59'),
(122, 'SEL Ã  CUISINER AROMATISÃ© 125G', 5, 0, 18, 2.1, 5.5, 1, '', '', '2013-02-20 16:03:36'),
(123, 'LIQUIDE VAISSELLE CITRON ALOÃ© 5L', 13, 1, 9, 2.32, 19.6, 1, '', '', '2013-02-21 23:18:02'),
(124, 'RAISINS SECS SULTANINES 12,5 KG', 1, 1, 16, 4.28, 5.5, 1, '', '', '2013-02-27 23:46:16'),
(125, 'FIGUES4-6 6KG', 1, 1, 16, 7.35, 0, 1, '', '', '2013-02-27 23:48:11'),
(126, 'JUS D ORANGE 5L ESPAGNE (ANDINES)', 20, 1, 3, 2.74, 5.5, 1, '', '', '2013-02-28 22:40:54'),
(127, 'CAFÃ© YACHIL 250G', 1, 0, 4, 3.05, 5.5, 1, 'AC-10001', '', '2013-03-13 14:45:07'),
(128, 'JUS DE POMMES 1L BIO', 1, 0, 3, 2.39, 5.5, 1, 'AL-VI001', '', '2013-03-13 14:46:12'),
(129, 'JUS D ORANGES DEMETER 1L BIO', 1, 0, 3, 3.15, 5.5, 1, 'AP-0523', '', '2013-03-13 14:47:23'),
(130, 'CONFITURE MYRTILLES 230G', 1, 0, 28, 3.48, 5.5, 1, 'AL - PC002', '', '2013-03-13 14:48:23'),
(131, 'CONFITURE DE CASSIS 350G', 1, 0, 28, 3.48, 5.5, 1, 'AL - PC006', '', '2013-03-13 14:49:14'),
(132, 'CONFITURE ABRICOTS 350G', 1, 0, 28, 3.48, 5.5, 1, 'AL - PC008', '', '2013-03-13 14:50:20'),
(133, 'KROUNCHY CHOCOLAT VRAC 5KG', 1, 1, 31, 6.77, 5.5, 1, 'AL - GO027', '', '2013-03-13 14:53:23'),
(134, 'KROUNCHY CHATEIGNES 500G', 1, 0, 31, 4.06, 5.5, 1, 'AL - GO23', '', '2013-03-13 14:54:32'),
(135, 'SABLÃ©S 7 CÃ©RÃ©ALES 12P', 1, 0, 33, 1.88, 5.5, 1, 'AL - RO004', '', '2013-03-13 14:56:18'),
(136, 'CHOCOLAT NOIR ET AMANDES', 1, 0, 15, 1.97, 5.5, 1, 'AS - 22002', '', '2013-03-13 14:58:27'),
(137, 'CHOCOLAT NOIR Ã©CORCES ORANGE', 1, 0, 15, 2.2, 5.5, 1, 'AS - 22053', '', '2013-03-13 14:59:19'),
(138, 'CHOCOLAT LAIT ET AMANDES', 1, 0, 15, 2.34, 5.5, 1, 'AS - 22004', '', '2013-03-13 15:00:08'),
(139, 'PALETS DE CHOCOLAT DE COUVERTURE NOIR 70% - VRAC 2KG', 1, 1, 15, 12.73, 5.5, 1, 'AS - 22022', '', '2013-03-13 15:02:09'),
(140, 'MÃ©LANGE Ã©TUDIANT', 1, 0, 20, 3.72, 5.5, 1, 'AP-0055', '', '2013-03-13 15:04:15'),
(141, 'MANGUES SÃ©CHÃ©ES', 1, 1, 16, 20.55, 5.5, 1, 'AK-0052', '', '2013-03-13 15:06:27'),
(142, 'RILLETTES DE THON AUX ALGUES', 1, 0, 20, 2.5, 5.5, 1, 'AL-BO005', '', '2013-03-13 15:08:15'),
(143, 'RILLETTES DE SARDINES AUX ALGUES', 1, 0, 20, 2.5, 5.5, 1, 'AL-BO007', '', '2013-03-13 15:09:16'),
(144, 'RILLETTES DE MAQUEREAUX AUX ALGUES', 1, 0, 20, 2.5, 5.5, 1, 'AL-BO008', '', '2013-03-13 15:10:06'),
(145, 'FARINE DE BLÃ© T80 VRAC 25 KG', 1, 1, 22, 1.52, 5.5, 1, 'AL-JC411', '', '2013-03-13 15:11:32'),
(146, 'FARINE DE BLÃ© NOIR VRAC 5KG', 1, 1, 22, 2.48, 5.5, 1, 'AL-JC405', '', '2013-03-13 15:13:33'),
(147, 'HUILE DE TOURNESOL VRAC 3 LITRES', 1, 1, 23, 3.45, 5.5, 1, 'AL-JC002', '', '2013-03-13 15:15:27'),
(148, 'HUILE DE COLZA VRAC 3 LITRES', 1, 1, 23, 4.49, 5.5, 1, 'AL-JC102', '', '2013-03-13 15:17:46'),
(149, 'VINAIGRE DE CIDRE 50 CL', 1, 0, 17, 2.24, 5.5, 1, 'AL-VI011', '', '2013-03-13 15:19:08'),
(150, 'CÃ¢PRES AU SAUMURE 206GR', 1, 0, 17, 2.6, 5.5, 1, 'AP-0065', '', '2013-03-13 15:20:37'),
(151, 'POIVRONS ROUGES GRILLÃ©S', 1, 0, 24, 2.9, 5.5, 1, 'AP-0072', '', '2013-03-13 15:21:49'),
(152, 'LAIT DE COCO PRESSÃ© 400ML', 1, 0, 24, 2.5, 5.5, 1, 'AP-0125', '', '2013-03-13 15:23:03'),
(153, 'KETCHUP 500 MML', 1, 0, 17, 2.8, 5.5, 1, 'AP-0511', '', '2013-03-13 15:24:14'),
(154, 'MINI-PAILLETTES D ALGUES - SALADE OCÃ©ANE', 1, 0, 17, 2.85, 5.5, 1, 'AL-BO015', '', '2013-03-13 15:25:37'),
(155, 'GALETTES DE RIZ COMPLET', 1, 0, 33, 0.82, 5.5, 1, 'AL-GO082', '', '2013-03-13 15:28:15'),
(156, 'BOULGHOUR VRAC 5 KG', 1, 1, 26, 3.48, 5.5, 1, 'AP-0634', '', '2013-03-13 15:29:46'),
(157, 'SHAMPOING DOUCHE PARFUM BAMBOU 1 LITRE', 1, 0, 8, 11.8, 19.6, 1, 'CB-0026', '', '2013-03-13 15:30:46'),
(158, 'LAIT CORPOREL AUX ALGUES ET BOIS DE ROSE 500 ML', 1, 0, 8, 9.47, 19.6, 1, 'CB-0041', '', '2013-03-13 15:32:25'),
(159, 'TOMATES PELÃ©ES 2,55 KG', 1, 0, 24, 6.71, 5.5, 1, 'AP-0516', '', '2013-03-13 15:33:23'),
(160, 'GALETTES 5 CÃ©RÃ©ALES', 1, 0, 33, 0.82, 5.5, 1, 'AL-GO081', '', '2013-03-13 15:46:18'),
(161, 'TISANE COMPOSÃ©E', 23, 0, 6, 4.5, 5.5, 1, '', '', '2013-03-14 16:28:41'),
(162, 'TISANE SIMPLE', 23, 0, 6, 2.4, 5.5, 1, '', '', '2013-03-14 16:30:20'),
(163, 'AROMATES (THYM, SARIETTE, ORIGAN, ROMARIN)', 23, 0, 19, 2.1, 5.5, 0, '', '', '2013-03-14 16:33:14'),
(164, 'CAMOMILLE ROMAINE', 23, 0, 6, 3, 5.5, 1, '', '', '2013-03-14 16:35:24'),
(165, 'HERBES DE PROVENCE', 23, 0, 19, 3, 5.5, 0, '', '', '2013-03-14 16:36:51'),
(166, 'HERBES DE PROVENCE', 23, 0, 17, 3, 5.5, 1, '', '', '2013-03-14 16:36:51'),
(167, 'POIS CHICHES', 1, 0, 27, 1.8, 5.5, 0, 'AL-GO062', '', '2013-03-21 19:44:16'),
(168, 'RIZ BASMATI', 1, 0, 26, 2.95, 5.5, 1, 'AI-15001', '', '2013-03-21 19:51:00'),
(169, 'CAFE YACHIL 1 KILO', 1, 0, 4, 11.77, 5.5, 1, 'AC-10004', '', '2013-03-21 19:54:41'),
(170, 'CORNICHONS AU VINAIGRE DE CIDRE', 25, 0, 17, 3.5, 0, 1, '', '', '2013-03-28 20:01:21'),
(171, 'CORNICHONS AIGRE DOUX', 25, 0, 17, 3.5, 0, 1, '', '', '2013-03-28 20:02:05'),
(172, 'SPIRULINE EN PAILLETTES 100G', 26, 0, 17, 9, 0, 1, '', '', '2013-03-28 20:09:07'),
(173, 'THE  DES FEES', 11, 1, 5, 42.15, 5.5, 1, '', '', '2013-03-28 21:40:33'),
(174, 'FARINE DE BLÃ© T110 VRAC 5 KG', 27, 1, 22, 1.3, 0, 1, '', '', '2013-04-04 14:11:27'),
(175, 'FARINE DE BLÃ© T150 VRAC 5 KG', 27, 1, 22, 1.3, 0, 1, '', '', '2013-04-04 14:12:04'),
(176, 'FARINE DE SEIGLE VRAC 5 KG', 27, 1, 22, 1.3, 0, 1, '', '', '2013-04-04 14:12:34'),
(177, 'FARINE D ORGE VRAC 5 KG', 27, 1, 22, 1.3, 0, 1, '', '', '2013-04-04 14:13:07'),
(178, 'FARINE D EPEAUTRE T110 VRAC 5 KG', 27, 1, 22, 2.6, 0, 1, '', '', '2013-04-04 14:14:15'),
(179, 'FLOCONS D AVOINE VRAC 4 KG', 27, 1, 31, 2, 0, 1, '', '', '2013-04-04 14:16:07'),
(180, 'GRAINES D ORGE (1 KG)', 27, 0, 26, 1, 0, 1, '', '', '2013-04-04 14:18:23'),
(181, 'GRAINES DE SEIGLE (1 KG)', 27, 0, 26, 1, 0, 1, '', '', '2013-04-04 14:18:43'),
(182, 'GRAINES D AVOINE (1 KG)', 27, 0, 26, 1, 0, 1, '', '', '2013-04-04 14:19:02'),
(183, 'LENTILLON (500 G)', 27, 0, 27, 2, 0, 1, '', '', '2013-04-04 14:20:06'),
(184, 'GRAINES DE LIN BRUN (500 G)', 27, 0, 26, 2, 0, 1, '', '', '2013-04-04 14:22:25'),
(185, 'CAFE TUCURU (500GR)', 20, 0, 4, 5.87, 5.5, 1, 'RTA01', '', '2013-04-04 18:59:04'),
(186, 'CHOCO - CHOCOLAT NOIR (70% CACAO)', 20, 0, 15, 1.75, 5.5, 1, 'RFC01', '', '2013-04-04 19:03:15'),
(187, 'CHOCOLAT NOIR/FRAMBOISE', 20, 0, 15, 1.9, 5.5, 1, 'RFC01F', '', '2013-04-04 19:15:48'),
(188, 'LAIT/CITRON', 20, 0, 15, 2.12, 5.5, 1, 'FRC06C', '', '2013-04-04 19:18:05'),
(189, 'MANGUES SÃ©CHÃ©ES EN LAMELLES 100 GR', 20, 0, 16, 2, 5.5, 1, 'RES41', '', '2013-04-04 19:32:29'),
(190, 'RIZ BLANC 1KG', 20, 0, 26, 1.5, 5.5, 1, 'RFK21', '', '2013-04-04 19:35:46'),
(191, 'RIZ COMPLET 1 KG', 20, 0, 26, 2.16, 5.5, 1, 'RFK30', '', '2013-04-04 19:36:57'),
(192, 'JUS POMME/PASSION', 20, 0, 3, 2.62, 5.5, 1, 'CRV105B', '', '2013-04-04 19:38:49'),
(193, 'POMME CASSIS', 20, 0, 3, 2.62, 0, 1, 'CRV104B', '', '2013-04-04 19:40:22'),
(194, 'SAVON ARTISANAL JASMIN 75CL', 20, 0, 8, 1.92, 19.6, 1, 'IFP0147', '', '2013-04-04 19:42:11'),
(195, 'HUILE D OLIVE BIO PALESTINE 75CL', 20, 0, 23, 9.3, 5.5, 1, 'RUA03', '', '2013-04-04 19:43:23'),
(196, 'ZAATAR EN POCHE DE 250 GR', 20, 0, 17, 4.11, 5.5, 1, 'RUZ02', '', '2013-04-04 19:45:40'),
(197, 'THE NOIR EARL GREY', 11, 1, 5, 33.55, 0, 1, '', '', '2013-04-05 14:05:48'),
(198, 'GATEAUX MAISON INDÃ©PENDANTE', 9, 1, 33, 14, 0, 1, '', '', '2013-04-05 21:59:09'),
(199, 'THE PU ERH ORANGE', 11, 1, 5, 39.7, 0, 1, '', 'TVA Ã  10,33', '2013-04-11 19:37:23'),
(200, 'FROMAGE DE TÃªTE GASCON 200G', 28, 0, 24, 3.85, 5.5, 1, '', '', '2013-04-11 19:45:17'),
(201, 'BONDIN NOIR GASCON 200G', 28, 0, 24, 3.85, 5.5, 1, '', '', '2013-04-11 19:48:39'),
(202, 'RILLETTES GASCONNES 200G', 28, 0, 24, 3.85, 0, 1, '', '', '2013-04-11 19:49:40'),
(203, 'PÃ¢TÃ© DE JAMBON GASCON 200G', 28, 0, 24, 3.85, 5.5, 1, '', '', '2013-04-11 19:50:36'),
(204, 'PÃ¢TÃ© DE GRÃ©SIGNE', 28, 0, 24, 3.85, 5.5, 1, '', '', '2013-04-11 19:51:22'),
(205, 'JUS DE POMME 1L- VERGER DE LA PLANQUETTE', 25, 0, 3, 3, 0, 1, '', '', '2013-04-11 22:15:42'),
(206, 'JUS DE POMME-POIRE1L - VERGER DE LA PLANQUETTE', 25, 0, 3, 3, 0, 1, '', '', '2013-04-11 22:16:10'),
(207, 'RILLETTES DE SAUMON 100G', 1, 0, 20, 2.5, 5.5, 1, 'AL-BO006', '', '2013-04-16 15:33:21'),
(208, 'KA RÃ© CHOCOLINETTE (SANS GLUTEN, SANS HUILE DE PALME) 375G', 1, 0, 31, 4.17, 5.5, 1, 'AL-GO041', '', '2013-04-16 15:37:22'),
(209, 'CHOCOLAT NOIR 70 % CACACO EL INTI BIO 100G', 1, 0, 15, 1.83, 5.5, 1, 'AS-22001', '', '2013-04-16 15:40:57'),
(210, 'CHOCOLAT NOIR Ã  LA MENTHE EL INTI 100 G', 1, 0, 15, 2.1, 5.5, 1, 'AS-22019', '', '2013-04-16 15:43:42'),
(211, 'CHOCOLAT AU LAIT EL INTI 100G', 1, 0, 15, 2.24, 19.6, 1, 'AS-22003', '', '2013-04-16 15:45:42'),
(212, 'ABRICOTS SECS ENTIERS CAL.3-4 VRAC 6KG BIO', 1, 1, 16, 6.6, 5.5, 1, 'AP-0006', '', '2013-04-16 15:50:09'),
(213, 'NOISETTES DECORTIQUEES VRAC 10KG BIO', 1, 1, 16, 10.28, 5.5, 1, 'AP-0026', '', '2013-04-16 15:51:53'),
(214, 'PAPIER TOILETTE LEGOFF 6 ROULEAUX', 13, 0, 8, 2.11, 19.6, 1, '3651010', '', '2013-04-17 15:06:57'),
(215, 'CONFIT D AMANDE SUCANAT 360 G', 13, 0, 30, 4.53, 5.5, 1, '1401330', '', '2013-04-17 15:15:01'),
(216, 'DENTIFRICE MENTHE DENTICLAY 75ML', 13, 0, 8, 3.34, 19.6, 1, '1601350', '', '2013-04-17 15:16:53'),
(217, 'BOUGIE OREILLE LAVANDE GROS NÂ° 8  1 PAIRE', 13, 0, 8, 4.05, 19.6, 1, '4011030', '', '2013-04-17 15:18:31'),
(218, 'BOUGIE OREILLE THYM NÂ° 8 2 PAIRES', 13, 0, 8, 7.06, 19.6, 1, '4011040', '', '2013-04-17 15:19:44'),
(219, 'GROS SEL GRIS 5KG', 5, 1, 18, 0.4, 5.5, 1, '', '', '2013-04-19 16:03:33'),
(220, 'CHOCOLADE 350 G- JEAN HERVÃ©', 13, 0, 30, 3.72, 5.5, 1, '1401010', '', '2013-04-25 19:55:32'),
(221, 'SAVON GREC Ã  L  HUILE D OLIVE', 2, 1, 8, 20, 0, 1, '', '', '2013-05-16 13:28:39'),
(222, 'CAFE EL PALOMAR GRAINS 1KG', 1, 0, 4, 11.2, 5.5, 1, 'AS-10003', '', '2013-05-28 15:11:14'),
(223, 'JUS CAROTTE DEMETER 75CL', 1, 0, 3, 2.56, 5.5, 1, 'AP-0520', '', '2013-05-28 15:17:12'),
(224, 'SUCRE VANILLE RAPADURA SACHET 8G', 1, 0, 21, 0.45, 5.5, 1, 'AP-0115', '', '2013-05-28 15:21:11'),
(225, 'LIMONADE LA LUTINE 75CL', 1, 0, 34, 2.22, 5.5, 1, 'AL-AP001', '', '2013-05-28 15:22:07'),
(226, 'CONFITURE CYNORRHODON/EGLANTIER', 1, 0, 28, 3.69, 5.5, 1, 'AL-PC014', '', '2013-05-28 15:23:29'),
(227, 'GALETTES FINES BRETONNES PUR BEURRE 12P/100G', 1, 0, 33, 1.8, 5.5, 1, 'AL-RO006', '', '2013-05-28 15:25:14'),
(228, 'CHOCOLAT NOIR GINGEMBRE CONFIT EL INTI 100G', 1, 0, 15, 2.1, 5.5, 1, 'AS-22020', '', '2013-05-28 15:26:30'),
(229, 'NOIX DE CAJOU AU NATUREL VRAC', 1, 1, 16, 12.4, 5.5, 1, 'AK-0062', '', '2013-05-28 15:30:14'),
(230, 'LENTILLES CORAIL 500G', 1, 0, 27, 2.53, 5.5, 1, 'AL-GO060', '', '2013-05-28 15:31:16'),
(231, 'POIS CASSES VRAC', 1, 1, 27, 3.26, 5.5, 1, 'AL-SG042', '', '2013-05-28 15:32:29'),
(232, 'COUSCOUS DEMI COMPLET VRAC', 1, 1, 26, 3.04, 5.5, 1, 'AP-0631', '', '2013-05-28 15:33:31'),
(233, 'SHAMPOOING REVITALISANT AGRUMES 500ML', 1, 0, 8, 8.35, 19.6, 1, 'CB-0031', '', '2013-05-28 15:35:05'),
(242, 'THE VERT JASMIN', 11, 1, 5, 34.1, 5.5, 1, '', '', '2013-06-13 19:40:30'),
(235, 'PUREE SESAME BLANC TAHIN 350G', 13, 0, 30, 3.38, 5.5, 1, '1401701', '', '2013-05-30 10:46:58'),
(236, 'CHOCOLADE SANS HUILE PALME 350G', 13, 0, 30, 4.1, 5.5, 1, '1401019', '', '2013-05-30 10:50:24'),
(237, 'CHOCOLADE SANS LAIT 350G', 13, 0, 30, 4.11, 5.5, 1, '1401016', '', '2013-05-30 10:50:57'),
(238, 'KOKOLO SANS LAIT 340G', 13, 0, 30, 3.88, 5.5, 1, '1401050', '', '2013-05-30 10:51:46'),
(239, 'PATE AMANDE BLANCHE 1KG', 13, 0, 16, 9.61, 5.5, 1, '1400015', '', '2013-05-30 10:59:13'),
(240, 'PATE AMANDE BLANCHE 250G', 13, 0, 16, 3.36, 5.5, 1, '1400014', '', '2013-05-30 10:59:59'),
(241, 'SIROP AGAVE 450G', 13, 0, 21, 2.84, 5.5, 1, '1402040', '', '2013-05-30 11:03:43'),
(243, 'THE NOIR DARJEELING', 11, 1, 5, 34.1, 5.5, 1, '', '', '2013-06-13 19:41:45'),
(244, 'THE NOIR DE CEYLAN', 11, 1, 5, 30.05, 5.5, 1, '', '', '2013-06-13 19:43:01'),
(245, 'MIEL DE FORÃªT - LES JARDINS DE PRIAPE', 25, 0, 29, 10, 5.5, 1, '', '', '2013-06-13 20:02:04'),
(246, 'MIEL DE SARRASIN - LES JARDINS DE PRIAPE', 25, 0, 29, 10.5, 5.5, 1, '', '', '2013-06-13 20:03:29'),
(247, 'MIEL DE LUZERNE - LES JARDINS DE PRIAPE', 25, 0, 29, 8.5, 5.5, 1, '', '', '2013-06-13 20:04:24'),
(248, 'MIEL D ACACIA - LES JARDINS DE PRIAPE', 25, 0, 29, 11, 5.5, 1, '', '', '2013-06-13 20:05:24'),
(249, 'MIEL DE PRINTEMPS - LES JARDINS DE PRIAPE', 25, 0, 29, 8, 5.5, 1, '', '', '2013-06-13 20:06:24'),
(250, 'MIEL TOUTES FLEURS - LES JARDINS DE PRIAPE', 25, 0, 29, 8.5, 5.5, 1, '', '', '2013-06-13 20:07:22'),
(251, 'MIEL DE TILLEUL - LES JARDINS DE PRIAPE', 25, 0, 29, 10, 5.5, 1, '', '', '2013-06-13 20:08:05'),
(252, 'FARINE DE BLÃ© BOULANGÃ¨RE T80', 27, 1, 22, 1.3, 0, 1, '', '', '2013-06-20 19:59:53'),
(253, 'PERCARBONATE SOUDE 1KG', 29, 0, 9, 4.31, 19.6, 1, 'DO 014', 'DÃ©tachant et blanchissant', '2013-06-21 16:33:55'),
(254, 'CRISTAUX DE SOUDE 500G', 29, 0, 9, 2.56, 19.6, 1, 'DO O10', 'NETTOYANT MULTI', '2013-06-21 16:38:24'),
(255, 'TERRE DE SOMMIERE TUBE 400G', 29, 0, 9, 3.13, 0, 1, 'DO 007', 'DETACHANT MAT. GRASSE', '2013-06-21 16:41:31'),
(256, 'VINAIGRE ALCOOL BIO 1L', 29, 0, 9, 1.66, 5.5, 1, 'DO 018', 'DESODORISANT DESINFECTANT', '2013-06-21 16:43:23'),
(257, 'EPONGES GRATTE LOT 2', 29, 0, 9, 1.6, 19.6, 1, 'DO 033', '', '2013-06-21 16:45:24'),
(258, 'GRATOIR CUIVRE', 29, 0, 9, 0.94, 19.6, 1, 'DO 035', '', '2013-06-21 16:46:34'),
(259, 'PAPIER CUISSON ROULEAU 39 X15M', 29, 0, 9, 3.59, 19.6, 1, 'AH 202', '', '2013-06-21 16:48:40'),
(260, 'FILTRE KF INOX', 29, 0, 9, 7.51, 19.6, 1, 'ME 1019', '', '2013-06-21 16:50:00'),
(261, 'ALLUMETTES BOITE 100 LOT 4', 29, 0, 9, 1.7, 19.6, 1, 'DO 053', '', '2013-06-21 16:51:24'),
(262, 'BICARBONATE DE SOUDE', 29, 1, 9, 2.7, 19.6, 1, 'DO001', '', '2013-06-26 14:35:10'),
(263, 'LENTILLES VERTES', 30, 1, 27, 3.5, 5.5, 1, '', '', '2013-06-29 17:51:07'),
(264, 'LENTILLONS DE CHAMPAGNE', 30, 1, 27, 4.2, 5.5, 1, '', '', '2013-06-29 17:52:05'),
(265, 'COQUILLETTES AUBE', 30, 1, 25, 3.7, 5.5, 1, '', '', '2013-06-29 17:53:03'),
(266, 'TORTILLONS', 30, 1, 25, 3.7, 5.5, 1, '', '', '2013-06-29 17:53:53'),
(267, 'FARINE DE BLÃ© BISE', 30, 1, 22, 1.7, 5.5, 1, '', '', '2013-06-29 17:55:20'),
(268, 'FARINE DE SEIGLE', 30, 1, 22, 1.9, 5.5, 1, '', '', '2013-06-29 17:56:08'),
(269, 'FARINE DE BLÃ© COMPLÃ¨TE', 30, 1, 22, 1.7, 5.5, 1, '', '', '2013-06-29 17:57:06'),
(270, 'PETIT EPEAUTRE EN GRAINS', 30, 1, 26, 3.5, 5.5, 1, '', '', '2013-06-29 17:58:05'),
(271, 'FARINE DE PETIT EPEAUTRE', 30, 1, 22, 3.5, 5.5, 1, '', '', '2013-06-29 17:58:59'),
(272, 'EPEAUTRE EN GRAINS', 30, 1, 26, 3, 5.5, 1, '', '', '2013-06-29 17:59:45'),
(273, 'HUILE DE TOURNESOL 1 LITRE', 30, 0, 23, 4.5, 5.5, 1, '', '', '2013-06-29 18:01:33'),
(274, 'PAINS D Ã©PICES', 30, 0, 33, 9.2, 5.5, 1, '', '', '2013-06-29 18:02:38'),
(275, 'JUS D\\_ANANAS 1L', 1, 0, 3, 3.59, 0, 1, 'AS - 40004', '', '2013-09-04 11:16:55'),
(276, 'BEUK COLA 1,5 L', 1, 0, 34, 1.73, 0, 1, 'AB - 001', '', '2013-09-04 11:22:11'),
(277, 'BEUK COLA 1,5 L', 1, 0, 34, 1.73, 0, 0, 'AB - 001', '', '2013-09-04 11:22:34'),
(278, 'BONBONS AU GINGEMBRE', 1, 0, 33, 1.94, 0, 1, 'AT - 0182', '', '2013-09-04 11:24:17'),
(279, 'PÃ¢TES DE FRUITS GOYAVE 25OG', 1, 0, 33, 4.75, 0, 1, 'AD - 0100', '', '2013-09-04 11:25:48'),
(280, 'CONFITURE DE SORCIÃ¨RES', 1, 0, 28, 3.69, 0, 1, 'AL - PC009', '', '2013-09-04 11:27:13'),
(281, 'MUÃ«SLI CHOCOLAT NOISETTES 500G', 1, 0, 31, 3.77, 0, 1, 'AL - GO011', '', '2013-09-04 11:28:27'),
(282, 'HUILE DE COLZA 1L', 1, 0, 23, 4.75, 0, 1, 'AL - JC101', '', '2013-09-04 11:29:23'),
(283, 'GALETTES AU RIZ COMPLET 130G', 1, 0, 33, 0.82, 0, 0, 'AL - GO082', '', '2013-09-04 11:30:28'),
(284, 'RIZ BASMATI  PUNJAB 5 KG', 1, 1, 26, 4.37, 0, 1, 'AI - 15004', '', '2013-09-04 11:31:56'),
(285, 'QUINOA VRAC 5KG', 1, 0, 26, 5.14, 0, 0, 'AS - 50005', '', '2013-09-04 11:35:00'),
(286, 'QUINOA VRAC 5KG', 1, 1, 26, 5.14, 0, 1, 'AS - 50005', '', '2013-09-04 11:35:14'),
(287, 'GRAINES DE TOURNESOL DÃ©CORTIQUÃ©ES 10KG', 1, 1, 16, 7.21, 0, 1, 'AL - JC525', '', '2013-09-04 11:36:49'),
(288, 'GRAINES DE COURGES GRILLÃ©ES 75G', 1, 0, 16, 1.34, 0, 1, 'AL - GO091', '', '2013-09-04 11:37:53'),
(289, 'CRÃ¨ME ANTI-Ã¢GE 50ML', 1, 0, 8, 9.25, 0, 1, 'CB - 0063', '', '2013-09-04 11:39:39'),
(290, 'CRÃ¨ME ANTI-Ã¢GE 50ML', 1, 0, 8, 9.25, 0, 1, 'CB - 0063', '', '2013-09-04 11:39:53'),
(291, 'PESTO DE BETTERAVE AU CIDRE', 8, 0, 17, 3.2, 5.5, 1, '', '', '2013-09-16 16:08:24'),
(292, 'CAFÃ© ETHIOPIEN DE LA COOP SCHILICHO', 31, 1, 4, 16.77, 5.5, 1, '', '', '2013-09-19 23:07:48'),
(293, 'A.TART -PURÃ©E D AMANDES BLANCHE 350G', 13, 0, 30, 5.66, 5.5, 1, '1401400', '', '2013-09-25 11:43:07'),
(304, 'SIROP DE CERISES / DE SUREAU', 32, 0, 34, 4, 5.5, 1, '', '', '2013-10-01 20:39:35'),
(295, 'ENTRT - LIQUIDE VAISSELLE CITRON ALOÃ© 5L RECHARGE', 13, 1, 9, 2.32, 19.6, 0, '3631011', '', '2013-09-25 11:58:26'),
(301, 'PÃªCHES SANGUINES', 32, 0, 28, 4, 5.5, 1, '', '', '2013-10-01 20:33:55'),
(302, 'GELÃ©E DE GROSEILLES MENTHE', 32, 0, 28, 4, 5.5, 1, '', '', '2013-10-01 20:34:54'),
(303, 'MYRTILLES (CLÃ©MENTERIE)', 32, 0, 28, 3, 0, 1, '', '', '2013-10-01 20:36:10'),
(298, 'TAMPONS NORMAL AVEC APPLICATEUR', 13, 0, 8, 4.27, 19.6, 1, '354155', '', '2013-09-25 12:02:54'),
(299, 'LEGUMS - POIS-CHICHES 500G', 13, 0, 27, 1.86, 5.5, 1, '1811077', '', '2013-09-25 12:04:42'),
(300, 'A.TAR - PURÃ©E AMANDE BLANCHE 700G', 13, 0, 30, 11.09, 5.5, 1, '1401410', '', '2013-09-25 12:06:02'),
(305, 'SIROP DE THYM', 32, 0, 34, 3.5, 5.5, 1, '', '', '2013-10-01 20:40:28'),
(306, 'SIROP DE SERPOLET', 32, 0, 34, 4, 5.5, 1, '', '', '2013-10-01 20:41:53'),
(307, 'SIROP DE MENTHE', 32, 0, 34, 3.5, 5.5, 1, '', '', '2013-10-01 20:42:26'),
(308, 'CRÃ¨ME DE CHÃ¢TAIGNES (CLÃ©MENTERIE)', 32, 0, 30, 5, 5.5, 1, '', '', '2013-10-01 20:45:46'),
(309, 'GINGEMBRE EN POUDRE 35G', 20, 0, 17, 1.37, 5.5, 1, 'RFG01', '', '2013-10-10 18:57:24'),
(310, 'CURCUMA EN POUDRE 35G', 20, 0, 17, 1.37, 5.5, 1, 'RFG02', '', '2013-10-10 18:58:31'),
(311, 'PIMENT ROUGE EN POUDRE 35G', 20, 0, 17, 1.81, 5.5, 1, 'RFG03', '', '2013-10-10 19:00:45'),
(312, 'ZAATAR SAC 1KG', 20, 1, 17, 15.05, 5.5, 1, 'RUZ01', '', '2013-10-10 19:03:12'),
(313, 'MATÃ© GINGEMBRE ET CITRON', 1, 0, 34, 3.02, 5.5, 1, 'AO-0008', '', '2013-10-17 20:05:46'),
(314, 'CACAO EN POUDRE- CRIOLLO 1KG', 1, 0, 31, 9.9, 5.5, 1, 'AS-22062', '', '2013-10-17 20:07:32'),
(315, 'NECTAR DE MANGUE 1L', 1, 0, 34, 3.53, 5.5, 1, 'AS-40001', '', '2013-10-17 20:09:03'),
(316, 'SUCRE DE CANNE BLOND', 1, 1, 21, 2.76, 5.5, 1, 'AC-10301', '', '2013-10-17 20:11:04'),
(317, 'BONBON Ã  LA MENTHE POIVRÃ©E 500G', 1, 0, 33, 1.94, 19.6, 1, 'AP-0181', '', '2013-10-17 20:13:18'),
(318, 'CHOCOLAT NOIR SPÃ©CIAL DESSERT 63% 200G', 1, 0, 15, 3, 5.5, 1, 'AS-22017', '', '2013-10-17 20:14:35'),
(319, 'CHOCOLAT NOIR 70% Ã  LA FLEUR DE SEL', 1, 0, 15, 1.97, 5.5, 1, 'AS-22041', '', '2013-10-17 20:15:55'),
(320, 'FEUILLE DE STEVIA EN POUDRE', 1, 0, 21, 5.96, 19.6, 1, 'AO-0031', '', '2013-10-17 20:18:35'),
(321, 'ACÃ©ROLA 120 CAPSULES', 1, 0, 8, 9.5, 5.5, 1, 'AR-117', '', '2013-10-17 20:20:08'),
(322, 'GRAINES DE SARRASIN DÃ©CORTIQUÃ©ES', 1, 1, 26, 3.47, 5.5, 1, 'AR-10017', '', '2013-10-17 20:41:49'),
(323, 'COULIS TOMATES BASILIC 690G CORTO', 33, 0, 17, 2.5, 5.5, 1, '', '', '2013-10-17 23:48:11'),
(324, 'COULIS TOMATES NATURE 350G CORTO (PETIT POT)', 33, 0, 17, 1.5, 5.5, 1, '', '', '2013-10-17 23:49:34'),
(325, 'GELÃ©E DE COING MAISON', 9, 0, 28, 2, 0, 1, '', 'Faite le samedi 19 octobre 2013', '2013-10-21 21:14:28'),
(326, 'MIEL DE GARRIGUES ( 1 KG )', 24, 0, 29, 9.6, 0, 1, '', '', '2013-10-25 21:30:11'),
(327, 'MIEL DE CHATAIGNER ( 0,5 KG )', 24, 0, 29, 5.57, 0, 1, '', '', '2013-10-25 21:31:26'),
(328, 'PAIN D EPICES NATURE ( 400 G )', 24, 0, 33, 5.3, 0, 1, '', '', '2013-10-25 21:33:41'),
(329, 'PAIN D EPICES ORANGE ( 400 G )', 24, 0, 33, 5.98, 0, 1, '', '', '2013-10-25 21:34:37'),
(330, 'PAIN D EPICES GINGEMBRE ( 400 G )', 24, 0, 33, 5.98, 0, 1, '', '', '2013-10-25 21:35:23'),
(331, 'TAPENADE VERTE ( 90 G)', 24, 0, 24, 2.7, 0, 1, '', '', '2013-10-25 21:36:57'),
(332, 'TAPENADE NOIRE ( 90 G)', 24, 0, 24, 2.7, 0, 1, '', '', '2013-10-25 21:37:19');

-- --------------------------------------------------------

--
-- Structure de la table `_inde_STOCKS`
--

CREATE TABLE IF NOT EXISTS `_inde_STOCKS` (
  `ID_REFERENCE` smallint(6) NOT NULL,
  `STOCK` float NOT NULL,
  `OPERATION` varchar(64) collate latin1_general_ci NOT NULL,
  `DATE` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `QUANTITE` float NOT NULL,
  `ID_ACHAT` smallint(6) default NULL,
  KEY `ID_REFERENCE` (`ID_REFERENCE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `_inde_TYPE_DOC`
--

CREATE TABLE IF NOT EXISTS `_inde_TYPE_DOC` (
  `ID_TYPE` smallint(6) NOT NULL auto_increment,
  `NOM` varchar(64) NOT NULL,
  PRIMARY KEY  (`ID_TYPE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `_inde_TYPE_DOC`
--

INSERT INTO `_inde_TYPE_DOC` (`ID_TYPE`, `NOM`) VALUES
(1, 'FACTURE'),
(2, 'BON DE COMMANDE'),
(3, 'DOC INTERNE');

-- --------------------------------------------------------

--
-- Structure de la table `_inde_VIE_OUTIL`
--

CREATE TABLE IF NOT EXISTS `_inde_VIE_OUTIL` (
  `DATE` datetime NOT NULL,
  `MESSAGE` varchar(1024) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`DATE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `_inde_VIE_OUTIL`
--

INSERT INTO `_inde_VIE_OUTIL` (`DATE`, `MESSAGE`) VALUES
('2012-10-16 11:20:01', 'Archivage des bons de commande Terra Libra et Andines du 14 octobre 2012. Pascal'),
('2012-10-16 11:07:38', 'Mise en place du journal de bord. Pascal'),
('2012-10-16 22:38:28', 'La pÃ©niche Remise Ã  flots livrera les vivres le mercredi 24 Ã  18h. Venez munis de votre chÃ©quier ! \r\nDes tomes de brebis seront Ã  partager... 30 kg (6 x 5 kg) ! \r\nOn en parle jeudi... \r\n'),
('2012-10-20 14:46:50', 'Comme dit Ã  la rÃ©union jeudi dernier, faire attention, il y a des sachets de sÃ©same andines de 250 g, alors qu\\_ils sont de 500 dans l\\_outil.... il faut vÃ©rifier la facture s\\_il y a eu une erreur de fourniture ou de saisie... olivier'),
('2012-10-20 14:49:30', 'et le 16 octobre donc, nouvelles rÃ©fÃ©rences d\\_huile (tournesol et colza) livrÃ©es par Terra libra, vrac en cubi de litres. mÃªme producteur que les bouteilles d\\_1 litres qu\\_on avait avant... olivier'),
('2012-10-20 21:38:04', 'savez vous qui a une clef des placard ? \r\npour mercredi nous en avons besoin . d avance merci de me dire au 0620070239 .lionel\r\n'),
('2012-10-21 13:59:48', 'CA Y EST ! LIONEL A LES CLEFS DE L\\_ARMOIRE donnÃ©es par Tesha'),
('2012-10-21 16:16:33', 'A propos du sÃ©same, la facture indique des paquets de 500g alors que nous avons reÃ§u apparemment des sachets de 250g. Donc je n\\_ai pas le prix des sachets de 250G... '),
('2012-10-22 12:50:05', 'Ã§a doit donc Ãªtre une erreur d\\_Andines qui nous a livrÃ© des paquets de 250g et facturÃ© des paquets de 500g.... Il faudrait vÃ©rifier ce qui a Ã©tÃ© commandÃ© et ce qui a Ã©tÃ© pointÃ© au moment de la rÃ©ception de cette commande. Olivier'),
('2012-10-25 16:37:15', 'Les rÃ©fÃ©rences des produits Remises Ã  Flots sont crÃ©Ã©es (pour les distinguer, dans la dÃ©signation est indiquÃ© :(Raf)). L\\_approvisionnement est enregistrÃ©. Un grand merci Ã  Lionel et Ã  tous les participants Ã  cette commande.'),
('2012-10-27 10:37:59', 'Saisir dans notre outil les achats de confiture prune - menthe dans rÃ©fÃ©rence CONFITURE - Prunes Nature & ProgrÃ¨s 350g (erreur fournisseur mais prix identique)'),
('2012-10-27 10:48:38', 'JE N\\_AI PAS PU RENTRER LE SESAME 250 G QUE J\\_AI PRIS JEUDI DERNIER. TESHA'),
('2012-10-27 10:48:49', 'JE N\\_AI PAS PU RENTRER LE SESAME 250 G QUE J\\_AI PRIS JEUDI DERNIER. TESHA'),
('2012-10-27 13:57:22', 'C\\_est normal Tesha, comme dit dans les messages prÃ©cÃ©dents, nous avons reÃ§u des paquets Ã©tiquetÃ©s 250g alors que la facturation concerne des paquets de 500 g....\r\nDerniÃ¨re minute : aprÃ¨s vÃ©rification par PÃ©nÃ©lope, ce n\\_est pas une erreur de livraison mais une erreur d\\_Ã©tiquetage ; les paquets font bien 500g (495 exactement, PÃ©nÃ©lope suggÃ¨re qu\\_on le signale....), tu peux donc rentrer (et les autres qui en ont pris aussi) la rÃ©fÃ©rence sÃ©same Andines 500g... olivier'),
('2012-11-08 18:15:12', 'Les relevÃ©s de l\\_inventaire sont enregistrÃ©s dans l\\_outil. Pascal'),
('2012-11-08 22:23:30', 'Je n\\_ai pas trouvÃ© la rÃ©fÃ©rence du quinoa bio Ã©quateur de chez andines, 1 Kg...'),
('2012-11-09 22:10:33', 'Suite Ã  la derniÃ¨re commande chez Andines, 4 nouvelles rÃ©fÃ©rences ont Ã©tÃ© crÃ©Ã©es : CHOCO - Chocolat noir 100 g 70 % cacao | CEREALE - Quinoa d\\_Equateur (1 kg) | BOIS - JUS d\\_orange Espagne (cubis 5 litres) | BOIS - JUS de pomme (cubis 5 litres). Les approvisionnements sont enregistrÃ©s. DÃ¨s lundi 12 novembre la facture sera disponible dans les archives.'),
('2012-12-20 21:59:30', 'Romarin 30 g et Origan 30 g ne sont marquÃ©s nulle part ...!!!\r\nComment fais-je ?\r\nMerci de me rÃ©pondre. Tesha'),
('2012-12-23 20:06:44', 'Pour les aromates et tisanes de Marie-Pierre Lenoir, les rÃ©fÃ©rences sont regroupÃ©es.\r\nRomarin et Origan, la rÃ©fÃ©rence dans notre outil est : AROM- aromates et fleurs marie pierre lenoir (2,10 euros).\r\nVoir dÃ©tail dans le document archivÃ© sous le nom : Commande_Marie-Pierre_Lenoir.pdf (menu vert, rubrique "Documents", sous-rubrique "Chercher".\r\nPascal'),
('2013-01-26 12:49:03', 'Bonjour, je n\\_arrive pas Ã  trouver dans la liste le Bouquet salÃ© guÃ©randais Saveur de l\\_OcÃ©an (70g). Merci de l\\_intÃ©grer ! (ou alors c\\_est moi qui y vois mal, c\\_est possible) Merci, Catherine L'),
('2013-02-03 13:41:00', 'la feuille de comptabilitÃ© de janvier 2013 est disponible dans les doc interne.\r\nbise\r\nRV'),
('2013-02-12 10:34:31', 'J ai archive les derniers tarifs Terra Libra reÃ§us le 12 fevrier 2013. Pascal'),
('2013-02-17 21:23:36', 'Je me pose la question du prix du fameux bidon 5litre du produit vaisselle\r\n"ENTRT - Liquide vaisselle citron aloÃ© 5L [2.19]"\r\nn\\_y a t\\_il pas une erreur? c\\_est 2,19 par litre non?'),
('2013-02-19 14:56:26', 'Pour rÃ©ponde Ã  la question du prix du fameux bidon 5litre du produit vaisselle, oui le prix indiquÃ© entre crochets est le prix au kilo ou au litre car il s\\_agit d\\_une rÃ©fÃ©rence en vrac. Il n\\_y a pas d\\_erreur.'),
('2013-02-22 17:59:24', 'Salut,\r\nPour les achats, il semble qu\\_il manque quelques produits: je n\\_ai pas trouvÃ© le cafÃ© (rien dans la catÃ©gorie), le papier toilette, et les figues sÃ¨ches. '),
('2013-02-26 22:22:46', 'Seuls les rÃ©fÃ©rences prÃ©sentes actuellement dans les placards sont dans la nouvelle version de l\\_outil.\r\nPour enregistrer les achats effectuÃ©s avant le dernier inventaire (c\\_est-Ã -dire samedi 16 fÃ©vrier) il faut utiliser l\\_ancienne version de l\\_outil pour calculer le montant du panier. RelÃ¨ve le montant du panier (il n\\_y a plus de touche Payer) et l\\_envoyer Ã  Pascal L. qui le dÃ©duira du solde du MoneyCoop sur le nouvel outil.\r\nCeci permet de comptabiliser dans les MoneyCoop les achats et d\\_avoir des stocks Ã  jour dans l\\_outil.'),
('2013-03-16 09:27:02', 'Je ne reÃ§ois plus de "ticket de caisse", c\\_est normal? Arianna '),
('2013-03-16 09:28:15', 'je n\\_ai pas trouvÃ© la rÃ©fÃ©rence pour le MATE VERT. Arianna'),
('2013-03-22 11:54:08', 'LE JUS D\\_ORANGE 1L DE TERRA LIBRA SE TROUVE DANS L\\_ONGLET BOISSON (ET NON PAS JUS). J\\_ai essayÃ© de le changer mais sans succÃ¨s ...'),
('2013-03-27 15:02:51', 'Les tickets de caisse devraient revenir (correction d un bug). Pascal'),
('2013-03-27 15:48:43', 'Tous les JUS sont maintenant dans la catÃ©gorie BOISSON/JUS. Pascal '),
('2013-04-01 16:28:25', 'La comptabilitÃ© Ã  jour au 31 mars 2013 est disponible dans les documents archivÃ©s, rubrique doc interne.\r\nbise\r\nRV'),
('2013-04-04 23:04:40', 'Les rÃ©fÃ©rences des produits de La Ferme au Colombier sont crÃ©Ã©es dans l\\_outil et les approvisionnements faits.'),
('2013-04-08 16:47:54', 'j\\_ai approvisionnÃ© le stock de gÃ¢teau maison le 8 avril 2013. Nabila'),
('2013-04-17 15:26:04', 'le 17 avril 2013\r\nLes approvisionnements TERRA LIBRA et PROVINCES BIO sont enregistrÃ©s.\r\nA signaler que confit d\\_amande SUCUNAT, c\\_est "Amande au sucre de canne intÃ©gral"\r\nrupture de dentifrice au citron, de tampons normaux ou super'),
('2013-04-17 15:35:40', '17 avril 2013 :\r\nRupture de stock Ã©galement sur Terra Libra :\r\nles Penne, soupe de poissons et noix de cajou'),
('2013-04-17 15:35:52', '17 avril 2013 :\r\nRupture de stock Ã©galement sur Terra Libra :\r\nles Penne, soupe de poissons et noix de cajou'),
('2013-04-22 17:59:48', 'Je ne trouve pas la rÃ©fÃ©rence du savon Ã  l\\_huile d\\_olive grecque. Nabila'),
('2013-04-23 16:20:24', 'La rÃ©fÃ©rence du savon Ã  l\\_huile d\\_olive grecque est Ã  crÃ©er. Si quelqu\\_un connaÃ®t le prix, merci d\\_enregistrer cette rÃ©fÃ©rence. Pascal'),
('2013-05-06 14:43:06', 'pour les savons grecs c\\_est 10 euros le sachet de 500gr oÃ¹ il y a 4 ou 5 savons, en gÃ©nÃ©ral de taille inÃ©gale, je sais pas trop quel prix indiquer pour un savon par exemple. s\\_il y en a 4, 2,50 euros et s\\_il y en a 5, 2 euros ?\r\n'),
('2013-05-16 13:25:42', 'salut ! je vais rÃ©fÃ©rencer le savon grec et mettre le prix au poids, il suffira de le peser.\r\npÃ©nÃ©lope'),
('2013-05-16 13:29:37', 'pour les savons c\\_est fait mais je ne sais pas quel est le "code fournisseur", alors j\\_ai rien mis forcÃ©ment.\r\npÃ©nÃ©lope'),
('2013-05-17 15:37:55', 'Les changements de tarifs 2013 pour les produits Jean Herve via Provinces Bio sont archives dans la rubrique DOCUMENTS INTERNES'),
('2013-05-25 12:15:09', 'Bonjour J\\_ai pris la fin d\\_un sac de farine demi-complÃ¨te (115g avec le sac)"les champs de blÃ©" mais je ne trouve nullement la rÃ©fÃ©rence. Florence'),
('2013-05-29 23:33:38', 'La comptabilitÃ© du mois de mai 2013 est archivÃ© dans les documents\r\nbise\r\nRV'),
('2013-06-21 16:53:39', 'Merci Ã  celle ou celui qui a enregistrÃ© dans l\\_outil les approvisionnements de la derniÃ¨re commande Ã  La Ferme au colombier. Pascal'),
('2013-06-21 17:51:32', 'Commande Ecodis rÃ©ceptionnÃ©e et intÃ©grÃ©e Ã  l\\_outil '),
('2013-06-29 18:14:52', 'Les produits de Nature et Paysans sont enregistrÃ©s dans l\\_outil et rangÃ©s dans les placards ! Venez jeudi pour rÃ©galer vos papilles ! Surtout le pain d\\_Ã©pices !!!'),
('2013-07-03 11:07:13', 'la comptabilitÃ© Ã  la date du 2 juillet 2013 est disponible.\r\nbise\r\nRV'),
('2013-07-12 12:48:28', 'L\\_inventaire du 04 juillet est enregistrÃ© dans l\\_outil.'),
('2013-07-30 19:30:17', 'La comptabilitÃ© arrÃªtÃ©e au 30 juillet 2013 est disponible en pdf.\r\nbise\r\nRV'),
('2013-08-30 00:49:28', 'J\\_ai fait l\\_approvisionnement du sel dans l\\_outil. \r\nUne remarque la fleur de sel Ã©tait au prix de 3 euros pour 250 g alors que la facture indique qu\\_elle coÃ»te 1,70 euro les 125 g... \r\nDonc j\\_ai modifiÃ©... Bonne nuit !!!'),
('2013-09-06 00:58:58', 'J\\_ai modifiÃ© les graines de tournesol qui n\\_Ã©taient pas en vrac. Elles le sont maintenant..\r\nElles sont placÃ©es dans les Fruits secs. Perso, je les aurais mises dans les cÃ©rÃ©ales. A vous de voir ! '),
('2013-09-19 23:09:42', 'J\\_ai ajoutÃ© dans l\\_outil le cafÃ© d\\_Ethiopie d\\_Esperanza CafÃ© en vrac (seau blanc). Pascal'),
('2013-09-25 12:41:10', 'Saisie commande Province Bio le 25/09/2013, \r\n2 ProblÃ¨mes : \r\n - CrÃ©ation ref recharge liquide vaisselle en triplette apparemment. Ã  vÃ©rifier. ReÃ§u rÃ©ellement 4 fois 5l.\r\n - CrÃ©ation inutile de ref pÃ¢te d\\_amande en CatÃ©gorie "GATO", dÃ©jÃ  existante en "fruits secs". (on l\\_a vu qu\\_aprÃ¨s).\r\nPas rÃ©ussi Ã  supprimer la rÃ©fÃ©rence inutile.\r\n MichÃ¨le et Olivier'),
('2013-09-25 23:07:57', 'J\\_ai supprimÃ© la ref pÃ¢te d_amande en CatÃ©gorie "GATO", dÃ©jÃ  existante en "fruits secs".\r\nPour le liquide vaisselle, j\\_ai aussi supprimÃ© les triplettes car il existe LIQUIDE VAISSELLE CITRON ALOE 5L mais Ã  2,19. J\\_ai donc modifiÃ© le prix Ã  2.32. Remarque, l\\_approvisionnement pour les ref en vrac est Ã  faire au litre ou au kilo.\r\nMerci MichÃ¨le et Olivier.\r\nPascal'),
('2013-09-26 18:34:20', 'La compta de sept est archivÃ©e.\r\nbise\r\nRV'),
('2013-10-01 22:35:44', 'Les rÃ©fÃ©rences du fournisseur La ClÃ©menterie sont prÃ©sents dans l\\_outil.'),
('2013-10-04 13:07:51', 'Les approvisionnements de la commande a La Ferme au Colombier arrivÃ©e le 03 octobre 2013 sont enregistres dans l outil.'),
('2013-10-13 22:58:13', 'salut ! j\\_ai une des clÃ©s du placard au cas oÃ¹ Ã§a intÃ©resse quelqu\\_un.\r\n(on pourrait peut-Ãªtre faire un journal de bord des clÃ©s du placard ?)\r\npÃ©nÃ©lope\r\n'),
('2013-10-17 23:50:29', 'Je viens de rentrer les prix des coulis de tomates de chez Corto. Vous pouvez donc les acheter. \r\n\r\n'),
('2013-10-25 21:40:13', 'Les rÃ©fÃ©rences Remise Ã  Flots (miels, pains d\\_Ã©pices et tapenades) sont dans l\\_outil.'),
('2013-10-31 22:32:33', 'Pour les miels de remise Ã  flots, il n\\_y a que 2 rÃ©fÃ©rences dans l\\_outil : garrigues 1kg et chÃ¢taigner 500g, alors qu\\_il y a deux sortes de miels en 1kg.... cela demande vÃ©rification sur facture (j\\_en parle Ã  Pascal ce Week-end), Pour ceux qui en ont pris, attendre avant de rentrer dans l\\_outil.... O.'),
('2013-11-01 09:51:17', 'Question : Le prix du shampooing Douche est mentionnÃ© 9.69. C\\_est le prix des 3L ou d\\_un litre?\r\nC\\_est important de le savoir car c\\_est du vrac. Merci de le prÃ©ciser. Nabila'),
('2013-11-01 20:37:24', 'D\\_une faÃ§on gÃ©nÃ©rale, pour les rÃ©fÃ©rences en vrac le prix doit toujours Ãªtre au kilo ou au litre.'),
('2013-11-02 14:35:58', 'AprÃ¨s vÃ©rif avec Pascal sur la facture Remise Ã  flots, il n\\_y a bien qu\\_une rÃ©fÃ©rence facturÃ©e pour tous les pots de 1 kg, clairs ou foncÃ©s : miel de garrigue. Qu\\_elle que soit la raison de la diffÃ©rence de couleur (qui reste Ã  Ã©lucider -erreur, miel Ã  diffÃ©rents stade....), on peut donc rentrer nos achats de miel sous la rÃ©fÃ©rence garrigues. (Ã‰tant donnÃ© le mode d\\_expÃ©dition on ne va de toutes faÃ§ons pas procÃ©der Ã  un Ã©change...) \r\nO.'),
('2013-11-23 13:35:00', 'Bonjour,\r\nLe fichier contenant toute le comptabilitÃ© pour l\\_annÃ©e 2013, depuis le 1er janvier jusque aujourd\\_hui 23 novembre est disponible dans cet outil. Il permettra Ã  ceux qui le dÃ©sirent de prÃ©parer au mieux le bilan comptable que nous allons faire, comme dÃ©cidÃ© Ã  la derniÃ¨re rÃ©union.\r\nbise\r\nRV');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
