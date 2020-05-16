-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 14, 2020 at 03:42 PM
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
CREATE DATABASE IF NOT EXISTS `nostradamus` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `nostradamus`;
-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IdA` int(11) NOT NULL,
  PRIMARY KEY (`IdA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `ideja`
--

DROP TABLE IF EXISTS `ideja`;
CREATE TABLE IF NOT EXISTS `ideja` (
  `IdK` int(11) NOT NULL,
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IdI` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DatumEvaluacije` datetime NOT NULL,
  `Sadrzaj` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `Popularnost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdI`),
  KEY `R_6` (`IdK`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `IdK` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DatumReg` datetime NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Skor` decimal(10,2) NOT NULL,
  `Popularnost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdK`),
  UNIQUE KEY `XAK1Korisnik` (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
CREATE TABLE IF NOT EXISTS `moderator` (
  `IdM` int(11) NOT NULL,
  PRIMARY KEY (`IdM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `predvidjanje`
--

DROP TABLE IF EXISTS `predvidjanje`;
CREATE TABLE IF NOT EXISTS `predvidjanje` (
  `IdK` int(11) NOT NULL,
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `IdP` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DatumNastanka` datetime NOT NULL,
  `DatumEvaluacije` datetime NOT NULL,
  `Sadrzaj` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `Nominalna_Tezina` decimal(10,2) NOT NULL,
  `Tezina` decimal(10,2) NOT NULL,
  `Popularnost` int(11) NOT NULL DEFAULT '0',
  `Status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BrOcena` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdP`),
  KEY `R_5` (`IdK`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
