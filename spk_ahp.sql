-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2017 at 10:05 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spk_ahp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `level` varchar(16) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`, `level`) VALUES
('admin', 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE IF NOT EXISTS `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`kode_alternatif`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `keterangan`, `total`, `rank`) VALUES
('A03', 'Lokasi 3', '', 0.15591275773641544, 0),
('A02', 'Lokasi 2', '', 0.3089406609229882, 0),
('A01', 'Lokasi 1', '', 0.5351465813405955, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE IF NOT EXISTS `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`kode_kriteria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `keterangan`) VALUES
('C02', 'Jarak ke sarana pendidikan', ''),
('C01', 'Jarak ke pondok mahasiswa', ''),
('C03', 'Jarak dengan BTS', ''),
('C04', 'Pesaing', ''),
('C05', 'Luas bangunan', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_alternatif`
--

CREATE TABLE IF NOT EXISTS `tb_rel_alternatif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode1` varchar(16) DEFAULT NULL,
  `kode2` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=598 ;

--
-- Dumping data for table `tb_rel_alternatif`
--

INSERT INTO `tb_rel_alternatif` (`ID`, `kode1`, `kode2`, `kode_kriteria`, `nilai`) VALUES
(382, 'A03', 'A02', 'C05', 0.5),
(381, 'A03', 'A01', 'C05', 0.3333333333333333),
(378, 'A02', 'A03', 'C05', 2),
(303, 'A02', 'A03', 'C02', 3),
(302, 'A02', 'A02', 'C02', 1),
(301, 'A02', 'A01', 'C02', 0.5),
(323, 'A01', 'A03', 'C03', 1),
(322, 'A01', 'A02', 'C03', 2),
(347, 'A01', 'A02', 'C04', 2),
(346, 'A01', 'A01', 'C04', 1),
(377, 'A02', 'A02', 'C05', 1),
(376, 'A02', 'A01', 'C05', 0.25),
(298, 'A01', 'A03', 'C02', 4),
(297, 'A01', 'A02', 'C02', 2),
(296, 'A01', 'A01', 'C02', 1),
(321, 'A01', 'A01', 'C03', 1),
(358, 'A03', 'A03', 'C04', 1),
(373, 'A01', 'A03', 'C05', 3),
(372, 'A01', 'A02', 'C05', 4),
(357, 'A03', 'A02', 'C04', 0.16666666666666666),
(283, 'A03', 'A03', 'C01', 1),
(282, 'A03', 'A02', 'C01', 0.5),
(281, 'A03', 'A01', 'C01', 0.3333333333333333),
(371, 'A01', 'A01', 'C05', 1),
(356, 'A03', 'A01', 'C04', 0.3333333333333333),
(353, 'A02', 'A03', 'C04', 6),
(352, 'A02', 'A02', 'C04', 1),
(351, 'A02', 'A01', 'C04', 0.5),
(348, 'A01', 'A03', 'C04', 3),
(333, 'A03', 'A03', 'C03', 1),
(332, 'A03', 'A02', 'C03', 0.5),
(331, 'A03', 'A01', 'C03', 1),
(328, 'A02', 'A03', 'C03', 2),
(327, 'A02', 'A02', 'C03', 1),
(326, 'A02', 'A01', 'C03', 0.5),
(308, 'A03', 'A03', 'C02', 1),
(307, 'A03', 'A02', 'C02', 0.3333333333333333),
(306, 'A03', 'A01', 'C02', 0.25),
(278, 'A02', 'A03', 'C01', 2),
(277, 'A02', 'A02', 'C01', 1),
(276, 'A02', 'A01', 'C01', 0.3333333333333333),
(273, 'A01', 'A03', 'C01', 3),
(272, 'A01', 'A02', 'C01', 3),
(271, 'A01', 'A01', 'C01', 1),
(383, 'A03', 'A03', 'C05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_kriteria`
--

CREATE TABLE IF NOT EXISTS `tb_rel_kriteria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID1` varchar(16) DEFAULT NULL,
  `ID2` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `tb_rel_kriteria`
--

INSERT INTO `tb_rel_kriteria` (`ID`, `ID1`, `ID2`, `nilai`) VALUES
(91, 'C05', 'C01', 0.333333333),
(87, 'C04', 'C04', 1),
(88, 'C01', 'C04', 1),
(89, 'C02', 'C04', 1),
(90, 'C03', 'C04', 1),
(75, 'C01', 'C01', 1),
(77, 'C02', 'C02', 1),
(78, 'C01', 'C02', 1),
(79, 'C03', 'C01', 0.333333333),
(80, 'C03', 'C02', 0.5),
(81, 'C03', 'C03', 1),
(82, 'C01', 'C03', 3),
(83, 'C02', 'C03', 2),
(84, 'C04', 'C01', 1),
(85, 'C04', 'C02', 1),
(86, 'C04', 'C03', 1),
(76, 'C02', 'C01', 1),
(99, 'C04', 'C05', 3),
(98, 'C03', 'C05', 2),
(97, 'C02', 'C05', 1),
(96, 'C01', 'C05', 3),
(95, 'C05', 'C05', 1),
(94, 'C05', 'C04', 0.333333333),
(93, 'C05', 'C03', 0.5),
(92, 'C05', 'C02', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
