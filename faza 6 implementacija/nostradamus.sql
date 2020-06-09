-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 09, 2020 at 08:16 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nostradamus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IdA` int(11) NOT NULL,
  PRIMARY KEY (`IdA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IdA`) VALUES
(1000),
(1005);

-- --------------------------------------------------------

--
-- Table structure for table `daje_ocenu`
--

DROP TABLE IF EXISTS `daje_ocenu`;
CREATE TABLE IF NOT EXISTS `daje_ocenu` (
  `IdK` int(11) NOT NULL,
  `IdP` int(11) NOT NULL,
  `Ocena` decimal(10,2) DEFAULT NULL,
  `VestackiId` int(11) NOT NULL,
  PRIMARY KEY (`IdK`,`IdP`),
  KEY `R_20` (`IdP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daje_ocenu`
--

INSERT INTO `daje_ocenu` (`IdK`, `IdP`, `Ocena`, `VestackiId`) VALUES
(1005, 1, NULL, 0),
(1006, 3, NULL, 1),
(1006, 2, NULL, 2),
(1006, 5, '6.00', 3),
(1000, 3, '7.00', 4),
(1000, 2, '10.00', 5),
(1000, 4, '10.00', 6),
(1000, 6, '4.00', 7),
(1005, 29, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ideja`
--

DROP TABLE IF EXISTS `ideja`;
CREATE TABLE IF NOT EXISTS `ideja` (
  `IdK` int(11) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `IdI` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DatumEvaluacije` datetime NOT NULL,
  `Sadrzaj` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Popularnost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdI`),
  KEY `R_6` (`IdK`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ideja`
--

INSERT INTO `ideja` (`IdK`, `Username`, `IdI`, `Naslov`, `DatumEvaluacije`, `Sadrzaj`, `Popularnost`) VALUES
(1006, 'novi7', 1, 'Jon Jones- Nganu', '2020-06-30 00:00:00', 'Bice li borbe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `IdK` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DatumReg` datetime NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Skor` decimal(10,2) NOT NULL,
  `Popularnost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdK`),
  UNIQUE KEY `XAK1Korisnik` (`Username`)
) ENGINE=MyISAM AUTO_INCREMENT=10009 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`IdK`, `Username`, `Password`, `DatumReg`, `Email`, `Skor`, `Popularnost`) VALUES
(1, 'Dusan98', 'MaliCar5Ds', '2020-05-14 10:05:34', 'vojinovic-dusan@hotmail.rs', '0.00', 0),
(2, 'dragan', 'MaliCar5Ds', '2020-05-15 05:00:32', 'vojinovic-dusan2@hotmail.rs', '0.00', 0),
(1000, 'prvobitni_admin', 'MaliCar5Ds', '2020-05-16 00:00:00', 'vojinovic-dusan_mungos@hotmail', '10.00', 12),
(5, 'novi', 'MaliCar5Ds', '2020-05-15 05:24:14', 'vojinovic-dusan5@hotmail.rs', '0.00', 0),
(6, 'novi2', 'MaliCar5Ds', '2020-05-15 05:24:47', 'vojinovic-dusan15@hotmail.rs', '0.00', 0),
(1001, 'Dusan3', 'MaliCar5Ds', '2020-05-16 10:08:28', 'vojinovic-dusangl@hotmail.rs', '0.00', 0),
(1002, 'Dusan4', 'MaliCar5Ds', '2020-05-16 10:09:06', 'vojinovic-dusanccxxz@hotmail.r', '0.00', 0),
(1003, 'novi3', 'MaliCar5Ds', '2020-05-16 15:02:02', 'vojinovic-dusansssssss@hotmail', '14.63', 0),
(1004, 'novi4', 'MaliCar5Ds', '2020-05-19 06:18:13', 'rvojinovic-dusan@hotmail.rs', '0.00', 0),
(1005, 'novi5', 'MaliCar5Ds', '2020-05-19 06:19:29', 'vrojinovic-dusan@hotmail.rs', '-3.00', 10),
(1006, 'novi7', 'MaliCar5Ds', '2020-05-29 04:16:52', 'vorraxjinovic-dusan@hotmail.rs', '0.00', 1),
(10008, 'korisniknovi', 'Novi123', '2020-06-08 11:55:15', 'korisniknovi@gmail.com', '0.00', 0),
(1007, 'moderator', 'MaliCar5Ds', '2020-05-29 00:00:00', 'vojinosasasasd@hoxsasa.rs', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
CREATE TABLE IF NOT EXISTS `moderator` (
  `IdM` int(11) NOT NULL,
  PRIMARY KEY (`IdM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`IdM`) VALUES
(1007);

-- --------------------------------------------------------

--
-- Table structure for table `obican_ili_veran`
--

DROP TABLE IF EXISTS `obican_ili_veran`;
CREATE TABLE IF NOT EXISTS `obican_ili_veran` (
  `IdK` int(11) NOT NULL,
  `Veran` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdK`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `obican_ili_veran`
--

INSERT INTO `obican_ili_veran` (`IdK`, `Veran`) VALUES
(5, 0),
(6, 1),
(1001, 0),
(1002, 0),
(1003, 1),
(1004, 1),
(1006, 1);

-- --------------------------------------------------------

--
-- Table structure for table `odgovor_na`
--

DROP TABLE IF EXISTS `odgovor_na`;
CREATE TABLE IF NOT EXISTS `odgovor_na` (
  `IdP` int(11) NOT NULL,
  `IdI` int(11) NOT NULL,
  PRIMARY KEY (`IdP`),
  KEY `R_8` (`IdI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovor_na`
--

INSERT INTO `odgovor_na` (`IdP`, `IdI`) VALUES
(31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `predvidjanje`
--

DROP TABLE IF EXISTS `predvidjanje`;
CREATE TABLE IF NOT EXISTS `predvidjanje` (
  `IdK` int(11) NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `IdP` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DatumNastanka` datetime NOT NULL,
  `DatumEvaluacije` datetime NOT NULL,
  `Sadrzaj` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nominalna_Tezina` decimal(10,2) NOT NULL,
  `Tezina` decimal(10,2) NOT NULL,
  `Popularnost` int(11) NOT NULL DEFAULT '0',
  `Status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `BrOcena` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdP`),
  KEY `R_5` (`IdK`)
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `predvidjanje`
--

INSERT INTO `predvidjanje` (`IdK`, `Username`, `IdP`, `Naslov`, `DatumNastanka`, `DatumEvaluacije`, `Sadrzaj`, `Nominalna_Tezina`, `Tezina`, `Popularnost`, `Status`, `BrOcena`) VALUES
(1000, 'prvobitni_admin', 8, 'Dokumentacija', '2020-05-17 10:54:40', '2020-05-21 00:00:00', 'Bice gotova', '0.00', '0.00', 4, 'ISPUNJENO', 0),
(1000, 'prvobitni_admin', 34, 'I', '2020-06-01 16:23:17', '2020-06-30 00:00:00', 'Ddsadadd', '0.00', '0.00', 0, 'CEKA', 0),
(1004, 'novi4', 22, 'Obicna', '2020-05-19 07:23:31', '2020-05-31 00:00:00', 'sadasdasdsa', '0.00', '0.00', 1, 'NEISPUNJENO', 0),
(1005, 'novi5', 29, 'Vozacki', '2020-06-01 15:39:15', '2020-06-26 00:00:00', 'Polozicu ispit iz voznje', '4.00', '19.74', 1, 'CEKA', 1),
(1005, 'novi5', 31, '#Jon Jones- Nganu', '2020-06-01 15:59:09', '2020-06-30 00:00:00', 'Nece.', '0.00', '0.00', 0, 'CEKA', 0),
(1005, 'novi5', 32, 'IdejaP', '2020-06-01 16:13:11', '2020-06-30 00:00:00', 'lllll', '0.00', '0.00', 0, 'CEKA', 0),
(10008, 'korisniknovi', 1000, 'Bezveze', '2020-06-02 19:41:44', '2020-06-07 19:41:44', 'OKOKOKOK', '0.00', '5.00', 0, 'CEKA', 0),
(10008, 'korisniknovi', 781, 'Treci svetski rat', '2020-06-03 20:06:44', '2020-06-07 20:06:44', 'Predvidjam da ce svetski treci rat poceti za par dana', '10.00', '10.00', 0, 'CEKA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voli`
--

DROP TABLE IF EXISTS `voli`;
CREATE TABLE IF NOT EXISTS `voli` (
  `IdK` int(11) NOT NULL,
  `IdP` int(11) NOT NULL,
  `VestackiId` int(11) NOT NULL,
  PRIMARY KEY (`IdK`,`IdP`),
  KEY `R_17` (`IdP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voli`
--

INSERT INTO `voli` (`IdK`, `IdP`, `VestackiId`) VALUES
(1005, 23, 0),
(1005, 6, 1),
(1005, 7, 2),
(1005, 1, 3),
(1005, 2, 4),
(1005, 3, 5),
(1005, 4, 6),
(1005, 5, 7),
(1005, 8, 8),
(1000, 1, 9),
(1000, 2, 10),
(1005, 26, 11),
(1005, 29, 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
