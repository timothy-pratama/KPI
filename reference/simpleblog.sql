-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2016 at 07:17 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simpleblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posting`
--

CREATE TABLE IF NOT EXISTS `posting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `konten` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `posting`
--

INSERT INTO `posting` (`id`, `judul`, `tanggal`, `konten`, `author`, `gambar`) VALUES
(1, 'Windranger', '2016-02-21', 'The western forests guard their secrets well. One of these is Lyralei, master archer of the wood, and favored godchild of the wind. Known now as Windranger, Lyralei''s family was killed in a storm on the night of her birth--their house blown down by the gale, contents scattered to the winds. Only the newborn survived among the debris field of death and destruction. In the quiet after the storm, the wind itself took notice of the lucky infant crying in the grass. The wind pitied the child and so lifted her into the sky and deposited her on a doorstep in a neighboring village. In the years that followed, the wind returned occasionally to the child''s life, watching from a distance while she honed her skills. Now, after many years of training, Windranger fires her arrows true to their targets. She moves with blinding speed, as if hastened by a wind ever at her back. With a flurry of arrows, she slaughters her enemies, having become, nearly, a force of nature herself.	', 'Dota 2', 'uploads/windranger.png'),
(2, 'Phantom Assassin', '2016-02-21', 'Through a process of divination, children are selected for upbringing by the Sisters of the Veil, an order that considers assassination a sacred part of the natural order. The Veiled Sisters identify targets through meditation and oracular utterances. They accept no contracts, and never seem to pursue targets for political or mercenary reasons. Their killings bear no relation to any recognizable agenda, and can seem to be completely random: A figure of great power is no more likely to be eliminated than a peasant or a well digger. Whatever pattern the killings may contain, it is known only to them. They treat their victims as sacrifices, and death at their hand is considered an honor. Raised with no identity except that of their order, any Phantom Assassin can take the place of any other; their number is not known. Perhaps there are many, perhaps there are few. Nothing is known of what lies under the Phantom Veil. Except that this one, from time to time, when none are near enough to hear, is known to stir her veils with the forbidden whisper of her own name: Mortred.	', 'Dota 2', 'uploads/phantom_assassin.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
