-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2016 at 01:56 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `posting_id`, `nama`, `komentar`, `tanggal`) VALUES
(1, 1, 'timmy', 'test', '2016-02-24');

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
(1, 'Lina', '2016-02-24', 'The sibling rivalries between Lina the Slayer, and her younger sister Rylai, the Crystal Maiden, were the stuff of legend in the temperate region where they spent their quarrelsome childhoods together. Lina always had the advantage, however, for while Crystal was guileless and naive, Lina''s fiery ardor was tempered by cleverness and conniving. The exasperated parents of these incompatible offspring went through half a dozen homesteads, losing one to fire, the next to ice, before they realized life would be simpler if the children were separated. As the oldest, Lina was sent far south to live with a patient aunt in the blazing Desert of Misrule, a climate that proved more than comfortable for the fiery Slayer. Her arrival made quite an impression on the somnolent locals, and more than one would-be suitor scorched his fingers or went away with singed eyebrows, his advances spurned. Lina is proud and confident, and nothing can dampen her flame.	', 'timmy', 'uploads/1456325150lina.png'),
(2, 'Phantom Assassin', '2016-02-21', 'Through a process of divination, children are selected for upbringing by the Sisters of the Veil, an order that considers assassination a sacred part of the natural order. The Veiled Sisters identify targets through meditation and oracular utterances. They accept no contracts, and never seem to pursue targets for political or mercenary reasons. Their killings bear no relation to any recognizable agenda, and can seem to be completely random: A figure of great power is no more likely to be eliminated than a peasant or a well digger. Whatever pattern the killings may contain, it is known only to them. They treat their victims as sacrifices, and death at their hand is considered an honor. Raised with no identity except that of their order, any Phantom Assassin can take the place of any other; their number is not known. Perhaps there are many, perhaps there are few. Nothing is known of what lies under the Phantom Veil. Except that this one, from time to time, when none are near enough to hear, is known to stir her veils with the forbidden whisper of her own name: Mortred.	', 'timmy', 'uploads/phantom_assassin.png'),
(3, 'Mirana', '2016-02-21', 'Born to a royal family, a blood princess next in line for the Solar Throne, Mirana willingly surrendered any claim to mundane land or titles when she dedicated herself completely to the service of Selemene, Goddess of the Moon. Known ever since as Princess of the Moon, Mirana prowls the sacred Nightsilver Woods searching for any who would dare poach the sacred luminous lotus from the silvery pools of the Goddess''s preserve. Riding on her enormous feline familiar, she is poised, proud and fearless, attuned to the phases of the moon and the wheeling of the greater constellations. Her bow, tipped with sharp shards of lunar ore, draws on the moon''s power to charge its arrows of light.	', 'rama', 'uploads/mirana.png'),
(4, 'Chen', '2016-02-21', 'Born in the godless Hazhadal Barrens, Chen came of age among the outlaw tribes who eked out an existence in the shimmering heat of the desert. Using an ancient form of animal enthrallment, Chen''s people husbanded the hardy desert locuthi, a stunted species of burrowing dragon that melted desert sands into tubes of glass where twice-a-year rains collected. Always on the edge of starvation and thirst, fighting amongst their neighbors and each other, Chen''s clan made the mistake, one fateful day, of ambushing the wrong caravan. \r\n\r\nIn the vicious battle that followed, Chen''s clan was outmatched. The armored Knights of the Fold made short work of the enthralled locuthi, who attacked and died in waves. With their dragons dead, the tribesmen followed. Chen struggled, and slashed, and clawed, and perished--or would have. Defeated, on his knees, he faced his execution with humility, offering his neck to the blade. Moved by Chen''s obvious courage, the executioner halted his sword. Instead of the blade, Chen was given a choice: death or conversion. Chen took to the faith with a ferocity. He joined the Fold and earned his armor one bloody conversion at a time. Now, with the fanaticism of a convert, and with his powers of animal enthrallment at their peak, he seeks out unbelievers and introduces them to their final reward.	', 'rama', 'uploads/chen.png');

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
  `baseSalt` varchar(255) NOT NULL,
  `loginSalt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `authToken`, `rememberToken`, `baseSalt`, `loginSalt`) VALUES
(4, 'timmy', '4918073c46b7e774ac824716f04331f63aacc236eed2f428935314ef19804ae6', '', '26000cf1731d6b96a859596a6f93ec01c4194a300afbea761833987260f0dbc3', 'ea09be8e4a5a3f5e04a786066768068d78993994d394962e4f99642c326c06d5', ''),
(5, 'rama', '5e011ee07cfb52c4bbde0216d4a8f96a31a5626d52488af4970031e587a1ab71', '', '', 'c577f2aadf008fc733b71ee25f62a4bc723ef415ae425970008d416ee2ec9b46', '');

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
