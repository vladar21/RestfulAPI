CREATE DATABASE library;

USE library;

CREATE TABLE IF NOT EXISTS `author` (
  `idauthor` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,    
  PRIMARY KEY (`idauthor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

INSERT INTO `author` (`idauthor`, `name`) VALUES
(1, "Fashion Harry"),
(2, "Electro Billy"),
(3, "Motors Jonny"),
(4, "Movies Ellen"),
(5, "Books Linda"),
(6, "Sports Garry");

CREATE TABLE IF NOT EXISTS `publishers` (
  `idpublisher` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,  
  PRIMARY KEY (`idpublisher`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

INSERT INTO `publishers` (`idpublisher`, `name`) VALUES
(1, "Larg"),
(2, "Middle"),
(3, "Small");

CREATE TABLE IF NOT EXISTS `books` (
  `idbook` int(11) NOT NULL AUTO_INCREMENT,
  `idpublisher` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,  
  PRIMARY KEY (`idbook`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

INSERT INTO `books` (`idbook`, `idpublisher`, `title`) VALUES
(1, 3, "Common Larg"),
(2, 3, "Middle East"),
(3, 2, "Small Town"),
(6, 1, "Bench Staff"),
(7, 1, "Len Tech"),
(8, 1, "Sam Publish"),
(9, 2, "Spalding Books"),
(10, 2, "Sony Picture history"),
(11, 2, "Huawei and world"),
(12, 3, "Abercrombie Lake"),
(13, 3, "Aberdin Home"),
(26, 3, "Another day"),
(28, 1, "Wallet stories"),
(31, 1, "Amanda Waller"),
(42, 1, "Nike in GymHalls"),
(48, 2, "Bristol Harbor"),
(60, 3, "Rolex Watch History");

CREATE TABLE IF NOT EXISTS `authors` (
  `idauthors` int(11) NOT NULL AUTO_INCREMENT,
  `idauthor` int(11) NOT NULL,
  `idbook` int(11) NOT NULL,
  PRIMARY KEY (`idauthors`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

INSERT INTO `authors` (`idauthors`, `idauthor`, `idbook`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 2, 2),
(5, 4, 2),
(6, 5, 2),
(7, 6, 2),
(8, 3, 3),
(9, 4, 6),
(10, 5, 7),
(11, 6, 8),
(12, 1, 9),
(13, 2, 10),
(14, 3, 11),
(15, 4, 12),
(16, 5, 13),
(17, 6, 26),
(18, 1, 28),
(19, 2, 31),
(20, 3, 42),
(21, 4, 48),
(22, 5, 60);