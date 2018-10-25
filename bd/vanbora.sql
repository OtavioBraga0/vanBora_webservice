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

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `Grupo_lng_Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Grupo_vch_Nome` varchar(255) DEFAULT NULL,
  `Grupo_vch_Horario` varchar(255) DEFAULT NULL,
  `Usuario_lng_Codigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`Grupo_lng_Codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `grupo` */

insert  into `grupo`(`Grupo_lng_Codigo`,`Grupo_vch_Nome`,`Grupo_vch_Horario`,`Usuario_lng_Codigo`) values 
(1,'Grupo 1','16:00',1),
(2,'Grupo 2 ','15:00',2),
(3,'Grupo 3','18:00',1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
