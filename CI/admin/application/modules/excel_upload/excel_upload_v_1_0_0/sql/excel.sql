/*
SQLyog Community v13.1.0 (64 bit)
MySQL - 5.7.26-log : Database - pirelli_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pirelli_DB` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `pirelli_DB`;

/*Table structure for table `tbl_excel` */

DROP TABLE IF EXISTS `tbl_excel`;

CREATE TABLE `tbl_excel` (
  `excel_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '엑셀 키',
  `tire_no` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '타이어 번호 ',
  `corp_code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '딜러사 코드',
  `barcode_scan_date` datetime DEFAULT NULL COMMENT '바코드 스캔일자',
  `tire_size` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '타이어 규격(사이즈)',
  `ipcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP 코드',
  `dot` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'DOT(타이어 제조 주차)',
  `keycode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '키코드',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  PRIMARY KEY (`excel_idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='타이어 관리 ';

/*Data for the table `tbl_excel` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
