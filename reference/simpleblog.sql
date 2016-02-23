-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2016 at 07:51 AM
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
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posting_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `posting_id` (`posting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `posting`
--

INSERT INTO `posting` (`id`, `judul`, `tanggal`, `konten`, `author`, `gambar`) VALUES
(1, 'Windranger', '2016-02-21', 'The western forests guard their secrets well. One of these is Lyralei, master archer of the wood, and favored godchild of the wind. Known now as Windranger, Lyralei''s family was killed in a storm on the night of her birth--their house blown down by the gale, contents scattered to the winds. Only the newborn survived among the debris field of death and destruction. In the quiet after the storm, the wind itself took notice of the lucky infant crying in the grass. The wind pitied the child and so lifted her into the sky and deposited her on a doorstep in a neighboring village. In the years that followed, the wind returned occasionally to the child''s life, watching from a distance while she honed her skills. Now, after many years of training, Windranger fires her arrows true to their targets. She moves with blinding speed, as if hastened by a wind ever at her back. With a flurry of arrows, she slaughters her enemies, having become, nearly, a force of nature herself.	', 'Dota 2', 'uploads/windranger.png'),
(2, 'Phantom Assassin', '2016-02-21', 'Through a process of divination, children are selected for upbringing by the Sisters of the Veil, an order that considers assassination a sacred part of the natural order. The Veiled Sisters identify targets through meditation and oracular utterances. They accept no contracts, and never seem to pursue targets for political or mercenary reasons. Their killings bear no relation to any recognizable agenda, and can seem to be completely random: A figure of great power is no more likely to be eliminated than a peasant or a well digger. Whatever pattern the killings may contain, it is known only to them. They treat their victims as sacrifices, and death at their hand is considered an honor. Raised with no identity except that of their order, any Phantom Assassin can take the place of any other; their number is not known. Perhaps there are many, perhaps there are few. Nothing is known of what lies under the Phantom Veil. Except that this one, from time to time, when none are near enough to hear, is known to stir her veils with the forbidden whisper of her own name: Mortred.	', 'Dota 2', 'uploads/phantom_assassin.png'),
(3, 'Mirana', '2016-02-21', 'Born to a royal family, a blood princess next in line for the Solar Throne, Mirana willingly surrendered any claim to mundane land or titles when she dedicated herself completely to the service of Selemene, Goddess of the Moon. Known ever since as Princess of the Moon, Mirana prowls the sacred Nightsilver Woods searching for any who would dare poach the sacred luminous lotus from the silvery pools of the Goddess''s preserve. Riding on her enormous feline familiar, she is poised, proud and fearless, attuned to the phases of the moon and the wheeling of the greater constellations. Her bow, tipped with sharp shards of lunar ore, draws on the moon''s power to charge its arrows of light.	', 'Dota 2', 'uploads/mirana.png'),
(4, 'Chen', '2016-02-21', 'Born in the godless Hazhadal Barrens, Chen came of age among the outlaw tribes who eked out an existence in the shimmering heat of the desert. Using an ancient form of animal enthrallment, Chen''s people husbanded the hardy desert locuthi, a stunted species of burrowing dragon that melted desert sands into tubes of glass where twice-a-year rains collected. Always on the edge of starvation and thirst, fighting amongst their neighbors and each other, Chen''s clan made the mistake, one fateful day, of ambushing the wrong caravan. \r\n\r\nIn the vicious battle that followed, Chen''s clan was outmatched. The armored Knights of the Fold made short work of the enthralled locuthi, who attacked and died in waves. With their dragons dead, the tribesmen followed. Chen struggled, and slashed, and clawed, and perished--or would have. Defeated, on his knees, he faced his execution with humility, offering his neck to the blade. Moved by Chen''s obvious courage, the executioner halted his sword. Instead of the blade, Chen was given a choice: death or conversion. Chen took to the faith with a ferocity. He joined the Fold and earned his armor one bloody conversion at a time. Now, with the fanaticism of a convert, and with his powers of animal enthrallment at their peak, he seeks out unbelievers and introduces them to their final reward.	', 'Dota 2', 'uploads/chen.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authToken` varchar(255) NOT NULL,
  `rememberToken` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `authToken`, `rememberToken`, `salt`) VALUES
(4, 'timmy', '$2y$10$8Z0acASR0VTWPMAtJNKNJOrlEFduYLrZUC35fVn8EP6kNqyjmwBmO', '', 'e2098251190fb5284201aad2c6d6e98f', ''),
(5, 'rama', '$2y$10$FiAGejlT6Y5kF0AfjGKM3eMXdkxiS8A/tV8eAQg5gmjcPDEDhKEoW', '', '', ''),
(11, 'user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', '', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`posting_id`) REFERENCES `posting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
