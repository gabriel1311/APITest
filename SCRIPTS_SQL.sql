-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2013 at 12:53 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apiTest`
--

-- --------------------------------------------------------

--
-- Table structure for table `carro`
--

CREATE TABLE IF NOT EXISTS `carro` (
  `id_carro` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `ano` varchar(10) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `max_parcelas` int(11) NOT NULL,
  `data_cadastro` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_carro`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `carro`
--

INSERT INTO `carro` (`id_carro`, `modelo`, `id_marca`, `ano`, `foto`, `valor`, `max_parcelas`, `data_cadastro`, `id_usuario`) VALUES
(27, 'IX35 2.0 16v Automtica', 16, '2013', 'ix35-300b.jpg', 120000, 12, '2013-09-25', 2),
(22, 'Ecosport 2.0', 3, '2010', '120803_eco_01.jpg', 45000, 6, '2013-09-25', 3),
(26, 'Focus', 3, '2005', 'focus400.jpg', 85500, 3, '2013-09-25', 2),
(25, 'Fusca', 2, '1950', 'volkswagen-fusca-1363209555530_956x500.jpg', 2000, 12, '2013-09-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `data` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `usuario`, `data`) VALUES
(11, 'admin', '25/09/2013 - 21:49:43'),
(10, 'admin', '25/09/2013 - 21:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nome_marca` varchar(100) NOT NULL,
  `data_cadastro` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`id_marca`, `nome_marca`, `data_cadastro`, `id_usuario`) VALUES
(1, 'Chevrolet', '2013-09-24', 2),
(2, 'Volkswagem', '2013-09-24', 3),
(3, 'Ford', '2013-09-24', 2),
(16, 'Hyundai', '2013-09-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nome`, `email`, `login`, `senha`, `perfil`) VALUES
(2, 'Administrador', 'admin@admin.com.br', 'admin', 'admin', 'admin'),
(3, 'Funcionario Teste', 'func@email.com', 'func', 'func', 'funcionario');
