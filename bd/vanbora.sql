/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 5.7.23 : Database - vanbora
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`vanbora` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `vanbora`;

/*Table structure for table `aluno` */

DROP TABLE IF EXISTS `aluno`;

CREATE TABLE `aluno` (
  `Aluno_lng_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Grupo_lng_Codigo` int(11) DEFAULT NULL,
  `Usuario_lng_Codigo` int(11) DEFAULT NULL,
  `Aluno_chr_Confirmacao` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`Aluno_lng_Codigo`),
  KEY `Grupo_lng_Codigo` (`Grupo_lng_Codigo`),
  KEY `Usuario_lng_Codigo` (`Usuario_lng_Codigo`),
  CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`Grupo_lng_Codigo`) REFERENCES `grupo` (`Grupo_lng_Codigo`),
  CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`Usuario_lng_Codigo`) REFERENCES `usuario` (`Usuario_lng_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `aluno` */

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `Grupo_lng_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Grupo_vch_Nome` varchar(255) DEFAULT NULL,
  `Grupo_vch_Horario` varchar(255) DEFAULT NULL,
  `Usuario_lng_Codigo` int(11) DEFAULT NULL,
  `Periodo_lng_Codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`Grupo_lng_Codigo`),
  KEY `Periodo_lng_Codigo` (`Periodo_lng_Codigo`),
  KEY `Usuario_lng_Codigo` (`Usuario_lng_Codigo`),
  CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`Periodo_lng_Codigo`) REFERENCES `periodo` (`Periodo_lng_Codigo`),
  CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`Usuario_lng_Codigo`) REFERENCES `usuario` (`Usuario_lng_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `grupo` */

/*Table structure for table `periodo` */

DROP TABLE IF EXISTS `periodo`;

CREATE TABLE `periodo` (
  `Periodo_lng_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Periodo_vch_Nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Periodo_lng_Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `periodo` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `Usuario_lng_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_vch_Nome` varchar(255) DEFAULT NULL,
  `Usuario_dat_DataNascimento` date DEFAULT NULL,
  `Usuario_vch_Endereco` varchar(255) DEFAULT NULL,
  `Usuario_vch_Numero` varchar(255) DEFAULT NULL,
  `Usuario_vch_Complemento` varchar(255) DEFAULT NULL,
  `Usuario_vch_Celular` varchar(255) DEFAULT NULL,
  `Usuario_chr_Tipo` char(1) DEFAULT NULL,
  PRIMARY KEY (`Usuario_lng_Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
