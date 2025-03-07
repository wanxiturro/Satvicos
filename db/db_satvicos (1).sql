-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-02-2025 a las 20:27:14
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_satvicos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_credit_note`
--

DROP TABLE IF EXISTS `tbl_credit_note`;
CREATE TABLE IF NOT EXISTS `tbl_credit_note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `series` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `status` int NOT NULL,
  `referenced_doc_id` int NOT NULL,
  `referenced_doc_type_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `reference` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `payment_days` int NOT NULL,
  `date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `reason` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_value` float NOT NULL,
  `total_sub` float NOT NULL,
  `total_tax` float NOT NULL,
  `total_net` float NOT NULL,
  `seller_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_credit_note_detail`
--

DROP TABLE IF EXISTS `tbl_credit_note_detail`;
CREATE TABLE IF NOT EXISTS `tbl_credit_note_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `credit_note_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_code` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_description` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_quantity` int NOT NULL,
  `item_unit_price` float NOT NULL,
  `item_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_credit_note_detail`
--

INSERT INTO `tbl_credit_note_detail` (`id`, `credit_note_id`, `item_id`, `item_code`, `item_description`, `item_quantity`, `item_unit_price`, `item_name`) VALUES
(498, 188, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `business_name` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `trade_name` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cellphone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `department_id` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `province_id` varchar(4) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `district_id` varchar(6) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact1_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact1_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact2_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact2_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `commission` float NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `ruc` (`ruc`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_customer`
--

INSERT INTO `tbl_customer` (`client_id`, `ruc`, `business_name`, `trade_name`, `email`, `phone`, `cellphone`, `address`, `department_id`, `province_id`, `district_id`, `contact1_name`, `contact1_phone`, `contact2_name`, `contact2_phone`, `commission`, `registration_date`) VALUES
(39, 'J89041258', 'Juan Cumana', 'Juan Cumana', '123123@gmail.com', '12312312', '123123123', 'Petare, La agricultura.', '01', '0103', 'purbea', '', '', '', '', 10, '2025-01-27 00:00:00'),
(54, 'j12345678', 'PRUEBA TÉCNICA', 'PRUEBA TÉCNICA', 'YANITACALBORNO@GMAIL.COM', '04243678901', '04122567894', 'PETARE', '15', '1519', 'Chacao', 'YANITZA', '04123880493', 'ARANZA', '04123667894', 30, '2025-01-21 00:00:00'),
(56, '123', '123', '123', '123@GMAIL.com', '123', '123', '123', '04', '0403', '123', '', '', '', '', 123, '2025-02-12 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_employee`
--

DROP TABLE IF EXISTS `tbl_employee`;
CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `last_name_1` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `last_name_2` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_doc_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_doc_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `civil_status` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `job` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `study_level` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `study_career` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `admission_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_doc_number` (`id_doc_number`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `last_name_1`, `last_name_2`, `id_doc_type`, `id_doc_number`, `civil_status`, `email`, `phone`, `address`, `job`, `study_level`, `study_career`, `birth_date`, `admission_date`) VALUES
(9, 'Administrador', 'admin', '1234', 'DNI', '88888888', 'Soltero', 'admin@duolabgroup.com', '991234567', 'Lima', 'Secretario', 'Actualmente cursando', 'Administrador', '2000-01-01', '2000-01-01'),
(25, 'Juan Andrés', 'Cumana', 'Albornoz', 'Cédula', '31082307', 'Casado', 'lbpf2021jaca@gmail.com', '4129041258', 'la dolorita', 'Administración', 'Actualmente cursando', 'Informatica', '2004-09-13', '2024-11-25'),
(26, 'Brayan David', 'Orejuela', 'Villamizar', 'Cédula', '888888888', 'Soltero', 'oligarcastudios@gmail.com', '77777777777', 'Bucaramanga', 'Administración', 'Técnico', 'asd', '2024-11-25', '2024-11-25'),
(32, 'Chris Xavier', 'Mengo', 'Duran', 'DNI', '7777777', 'Soltero', 'chris@gmail.com', '77777777777', 'No se', 'Mantenimiento', 'Titulado', 'Bachiller', '2024-12-01', '2024-12-01'),
(33, 'Prueba', 'de', 'Ingreso', 'Cédula', '666666666', 'Soltero', 'pruebadeingreso@gmail.com', '77777777777', 'Pruebadeingreso', 'Ventas', 'Actualmente cursando', 'Informatica', '2024-12-02', '2024-12-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `series` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `status` int NOT NULL,
  `quotation_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `reference` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `payment_days` int NOT NULL,
  `date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_value` float NOT NULL,
  `total_sub` float NOT NULL,
  `total_tax` float NOT NULL,
  `total_net` float NOT NULL,
  `seller_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2433 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_invoice_detail`
--

DROP TABLE IF EXISTS `tbl_invoice_detail`;
CREATE TABLE IF NOT EXISTS `tbl_invoice_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_code` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_description` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_quantity` int NOT NULL,
  `item_unit_price` float NOT NULL,
  `item_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5097 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_invoice_detail`
--

INSERT INTO `tbl_invoice_detail` (`id`, `invoice_id`, `item_id`, `item_code`, `item_description`, `item_quantity`, `item_unit_price`, `item_name`) VALUES
(5089, 2425, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5090, 2426, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5091, 2427, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5092, 2428, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5093, 2429, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5094, 2430, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5095, 2431, 38, '0001', 'Aceite marca ganol de 500l', 10, 70, 'Aceite'),
(5096, 2432, 85, 'PRO-1', 'Leche para perro pequeño', 500, 3.9, 'Leche de perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `number` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `issue_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `provider_id` int NOT NULL,
  `payment_days` int NOT NULL,
  `account_number` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `quotation` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `requester` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `approver` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `observation` varchar(3000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `total_purchase` float NOT NULL,
  `total_tax` float NOT NULL,
  `total_net` float NOT NULL,
  `exchange_rate_sale` float NOT NULL,
  `exchange_rate_purchase` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order_detail`
--

DROP TABLE IF EXISTS `tbl_order_detail`;
CREATE TABLE IF NOT EXISTS `tbl_order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `item_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_description` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_gloss` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_unit_value` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_unit_price` float NOT NULL,
  `item_quantity` int NOT NULL,
  `item_discount_rate` float NOT NULL,
  `item_discounted_total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pdf_entry`
--

DROP TABLE IF EXISTS `tbl_pdf_entry`;
CREATE TABLE IF NOT EXISTS `tbl_pdf_entry` (
  `id_pdf` int NOT NULL AUTO_INCREMENT,
  `id_report` int NOT NULL,
  `name_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `path_arch` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `f_operacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `report_products` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `report_cant` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pdf`)
) ENGINE=MyISAM AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pdf_entry`
--

INSERT INTO `tbl_pdf_entry` (`id_pdf`, `id_report`, `name_user`, `path_arch`, `f_operacion`, `report_products`, `report_cant`) VALUES
(285, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250127113543_documento.pdf', '2025-01-27 11:35:43', 'Harina pan', '30'),
(284, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250123113505_documento.pdf', '2025-01-23 11:35:05', 'PAN', '1'),
(282, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122105433_documento.pdf', '2025-01-22 10:54:33', 'PAN', '1'),
(279, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122105113_documento.pdf', '2025-01-22 10:51:13', 'PAN', '1'),
(277, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122105008_documento.pdf', '2025-01-22 10:50:08', 'PAN', '1'),
(276, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104915_documento.pdf', '2025-01-22 10:49:15', 'PAN', '1'),
(274, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104607_documento.pdf', '2025-01-22 10:46:07', '123', '1'),
(272, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104417_documento.pdf', '2025-01-22 10:44:17', '123', '10'),
(273, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104426_documento.pdf', '2025-01-22 10:44:26', '123', '10'),
(271, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104404_documento.pdf', '2025-01-22 10:44:04', '123', '10'),
(269, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104357_documento.pdf', '2025-01-22 10:43:57', '123', '10'),
(270, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104403_documento.pdf', '2025-01-22 10:44:03', '123', '10'),
(268, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122104038_documento.pdf', '2025-01-22 10:40:38', 'PAN', '1'),
(266, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103843_documento.pdf', '2025-01-22 10:38:43', 'PAN', '7'),
(267, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103950_documento.pdf', '2025-01-22 10:39:50', 'PAN', '3'),
(265, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103814_documento.pdf', '2025-01-22 10:38:14', 'PAN', '1'),
(263, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103643_documento.pdf', '2025-01-22 10:36:43', 'PAN', '3'),
(264, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103733_documento.pdf', '2025-01-22 10:37:33', 'PAN', '3'),
(262, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103612_documento.pdf', '2025-01-22 10:36:12', 'PAN', '3'),
(261, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103425_documento.pdf', '2025-01-22 10:34:25', 'PAN', '3'),
(259, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122101349_documento.pdf', '2025-01-22 10:13:49', 'PAN', '30'),
(260, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122103229_documento.pdf', '2025-01-22 10:32:29', 'PAN', '3'),
(258, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122100946_documento.pdf', '2025-01-22 10:09:46', 'PAN', '3'),
(257, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122100735_documento.pdf', '2025-01-22 10:07:35', 'PAN', '3'),
(256, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122100301_documento.pdf', '2025-01-22 10:03:01', 'PAN', '30'),
(255, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122100050_documento.pdf', '2025-01-22 10:00:50', 'PAN', '3'),
(254, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122095620_documento.pdf', '2025-01-22 09:56:20', 'PAN', '3'),
(252, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122095340_documento.pdf', '2025-01-22 09:53:40', 'PAN', '3'),
(253, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122095619_documento.pdf', '2025-01-22 09:56:19', 'PAN', '3'),
(251, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122095229_documento.pdf', '2025-01-22 09:52:29', 'PAN', '3'),
(249, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122093352_documento.pdf', '2025-01-22 09:33:52', 'PAN', '3'),
(250, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122094422_documento.pdf', '2025-01-22 09:44:22', 'PAN', '3'),
(248, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122093319_documento.pdf', '2025-01-22 09:33:19', 'PAN', '3'),
(246, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122093110_documento.pdf', '2025-01-22 09:31:10', 'PAN', '3'),
(247, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122093158_documento.pdf', '2025-01-22 09:31:58', 'PAN', '3'),
(244, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122092624_documento.pdf', '2025-01-22 09:26:24', 'PAN', '7'),
(245, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122092905_documento.pdf', '2025-01-22 09:29:05', 'PAN', '3'),
(243, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122092533_documento.pdf', '2025-01-22 09:25:33', '123', '3'),
(242, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122092441_documento.pdf', '2025-01-22 09:24:41', 'PAN', '3'),
(241, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122092343_documento.pdf', '2025-01-22 09:23:43', 'PAN', '3'),
(240, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122092218_documento.pdf', '2025-01-22 09:22:18', 'PAN', '3'),
(239, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122091917_documento.pdf', '2025-01-22 09:19:17', 'PAN', '3'),
(238, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122091803_documento.pdf', '2025-01-22 09:18:03', 'PAN', '123'),
(237, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122091522_documento.pdf', '2025-01-22 09:15:22', '123', '123'),
(236, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122091447_documento.pdf', '2025-01-22 09:14:47', 'PAN', '3'),
(235, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122090659_documento.pdf', '2025-01-22 09:06:59', 'PAN', '1'),
(234, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122090354_documento.pdf', '2025-01-22 09:03:54', 'PAN', '7'),
(233, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122090046_documento.pdf', '2025-01-22 09:00:46', 'PAN', '3'),
(232, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122085833_documento.pdf', '2025-01-22 08:58:33', 'PAN', '3'),
(230, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122084807_documento.pdf', '2025-01-22 08:48:07', 'PAN', '1'),
(231, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122084952_documento.pdf', '2025-01-22 08:49:52', 'PAN', '1'),
(229, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250122084713_documento.pdf', '2025-01-22 08:47:13', 'PAN', '3'),
(228, 2101203358, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121203358_documento.pdf', '2025-01-21 20:33:58', 'PAN', '3'),
(226, 2101203344, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121203344_documento.pdf', '2025-01-21 20:33:44', 'PAN', '3'),
(227, 2101203351, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121203351_documento.pdf', '2025-01-21 20:33:51', 'PAN', '3'),
(225, 2101203341, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121203341_documento.pdf', '2025-01-21 20:33:41', 'PAN', '3'),
(224, 2101202708, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121202708_documento.pdf', '2025-01-21 20:27:08', 'PAN', '3'),
(222, 2101201121, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121201121_documento.pdf', '2025-01-21 20:11:21', 'PAN', '1'),
(223, 2101201555, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121201555_documento.pdf', '2025-01-21 20:15:55', 'PAN', '1'),
(221, 2101200915, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121200915_documento.pdf', '2025-01-21 20:09:15', 'PAN', '1'),
(220, 2101200722, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121200722_documento.pdf', '2025-01-21 20:07:22', 'PAN', '1'),
(219, 2101200622, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121200622_documento.pdf', '2025-01-21 20:06:22', 'PAN', '30'),
(217, 2101200450, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121200450_documento.pdf', '2025-01-21 20:04:50', 'PAN', '30'),
(218, 2101200545, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121200545_documento.pdf', '2025-01-21 20:05:45', 'PAN', '30'),
(216, 2101200108, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250121200108_documento.pdf', '2025-01-21 20:01:08', 'PAN', '17'),
(215, 2001104504, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Entrada/ENTRADA Prueba de_20250120104504_documento.pdf', '2025-01-20 10:45:04', '123', '30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pdf_exit`
--

DROP TABLE IF EXISTS `tbl_pdf_exit`;
CREATE TABLE IF NOT EXISTS `tbl_pdf_exit` (
  `id_pdf` int NOT NULL AUTO_INCREMENT,
  `id_report` int NOT NULL,
  `name_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `path_arch` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `f_operacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `report_products` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `report_cant` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pdf`)
) ENGINE=MyISAM AUTO_INCREMENT=521 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pdf_exit`
--

INSERT INTO `tbl_pdf_exit` (`id_pdf`, `id_report`, `name_user`, `path_arch`, `f_operacion`, `report_products`, `report_cant`) VALUES
(520, 1202154116, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212154116_documento.pdf', '2025-02-12 15:41:16', 'PAN', '1'),
(519, 1202144643, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212144643_documento.pdf', '2025-02-12 14:46:43', 'PAN', '50'),
(518, 1202115259, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212115259_documento.pdf', '2025-02-12 11:52:59', 'PAN', '1'),
(517, 1202115110, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212115110_documento.pdf', '2025-02-12 11:51:10', 'PAN', '1'),
(516, 1202114716, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212114716_documento.pdf', '2025-02-12 11:47:16', 'PAN', '1'),
(515, 1202113659, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212113659_documento.pdf', '2025-02-12 11:36:59', 'PAN', '1'),
(514, 1202113207, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212113207_documento.pdf', '2025-02-12 11:32:07', 'PAN', '1'),
(509, 2147483647, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250127114207_documento.pdf', '2025-01-27 11:42:07', 'Harina pan', '30'),
(513, 1202104445, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212104445_documento.pdf', '2025-02-12 10:44:46', 'PAN', '1'),
(512, 1202103708, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212103708_documento.pdf', '2025-02-12 10:37:08', 'PAN', '3'),
(511, 1202100810, 'Prueba de', 'C:/wamp64/www/satvicos-master/reportes/Salida/SALIDA Prueba de_20250212100810_documento.pdf', '2025-02-12 10:08:10', 'PAN', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `warehouse` int NOT NULL,
  `brand` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `description` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `stock_quantity` int NOT NULL,
  `unit_price` float NOT NULL,
  `unit_saleprice` float NOT NULL,
  `unit_value` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `code`, `warehouse`, `brand`, `name`, `description`, `stock_quantity`, `unit_price`, `unit_saleprice`, `unit_value`, `active_status`, `registration_date`) VALUES
(89, '098', 0, 'INTEGRA', 'PAN', 'PAN INTEGR4AL', 3, 20, 10, 'gr', 1, '2025-01-21 19:59:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_provider`
--

DROP TABLE IF EXISTS `tbl_provider`;
CREATE TABLE IF NOT EXISTS `tbl_provider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `business_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `country` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `city` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `district` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact1_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact1_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact2_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contact2_phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank1_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank1_currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank1_account_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank1_account_holder` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank2_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank2_currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank2_account_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `bank2_account_holder` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_provider`
--

INSERT INTO `tbl_provider` (`id`, `code`, `business_name`, `address`, `country`, `city`, `district`, `contact1_name`, `contact1_phone`, `contact2_name`, `contact2_phone`, `bank1_name`, `bank1_currency`, `bank1_account_number`, `bank1_account_holder`, `bank2_name`, `bank2_currency`, `bank2_account_number`, `bank2_account_holder`, `registration_date`) VALUES
(96, '2313192837912837', 'Empresa de polar', 'Caracas al lado del palacio donde está maduro', 'Venezuela', 'Caracas', 'Miranda', '123', '123', '123', '123', 'Banco de Venezuela', '', '', '', '', '', '', '', '2025-01-27 15:38:07'),
(97, 'J123456789', 'Softwans Corporations', 'Chacao, Calle Patin', 'Venezuela', 'Caracas', 'Miranda', 'Juan Cumana', '04242670533', '', '', 'Bancamiga', 'MD', '192712817236189632163', 'Juan Cumana', '', '', '', '', '2025-01-27 16:17:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_purchase`
--

DROP TABLE IF EXISTS `tbl_purchase`;
CREATE TABLE IF NOT EXISTS `tbl_purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `issue_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `provider_id` int NOT NULL,
  `payment_days` int NOT NULL,
  `account_number` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `quotation` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `requester` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `approver` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `observation` varchar(3000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `total_purchase` float NOT NULL,
  `total_tax` float NOT NULL,
  `total_net` float NOT NULL,
  `exchange_rate_sale` float NOT NULL,
  `exchange_rate_purchase` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`id`, `type`, `number`, `status`, `currency`, `issue_date`, `delivery_date`, `provider_id`, `payment_days`, `account_number`, `quotation`, `requester`, `approver`, `observation`, `total_purchase`, `total_tax`, `total_net`, `exchange_rate_sale`, `exchange_rate_purchase`) VALUES
(272, 1, '123', 'Pendiente', 'MN', '2024-12-12', '2024-12-12', 87, 0, '', '', '123', '123', '123123', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_purchase_detail`
--

DROP TABLE IF EXISTS `tbl_purchase_detail`;
CREATE TABLE IF NOT EXISTS `tbl_purchase_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int NOT NULL,
  `item_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_description` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_gloss` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_unit_value` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_unit_price` float NOT NULL,
  `item_quantity` int NOT NULL,
  `item_discount_rate` float NOT NULL,
  `item_discounted_total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_purchase_detail`
--

INSERT INTO `tbl_purchase_detail` (`id`, `purchase_id`, `item_code`, `item_description`, `item_gloss`, `item_unit_value`, `item_unit_price`, `item_quantity`, `item_discount_rate`, `item_discounted_total`) VALUES
(296, 272, '123', '123', '123', '-', 123, 123, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_quotation`
--

DROP TABLE IF EXISTS `tbl_quotation`;
CREATE TABLE IF NOT EXISTS `tbl_quotation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `status` int NOT NULL,
  `customer_id` int NOT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `reference` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `payment_days` int NOT NULL,
  `date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_value` float NOT NULL,
  `total_sub` float NOT NULL,
  `total_tax` float NOT NULL,
  `total_net` float NOT NULL,
  `seller_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_quotation_detail`
--

DROP TABLE IF EXISTS `tbl_quotation_detail`;
CREATE TABLE IF NOT EXISTS `tbl_quotation_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quotation_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_name` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_description` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_unit_price` float NOT NULL,
  `item_quantity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_receipt`
--

DROP TABLE IF EXISTS `tbl_receipt`;
CREATE TABLE IF NOT EXISTS `tbl_receipt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `series` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `number` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `status` int NOT NULL,
  `quotation_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `ruc` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `address` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `reference` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `payment_days` int NOT NULL,
  `date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_value` float NOT NULL,
  `total_sub` float NOT NULL,
  `total_tax` float NOT NULL,
  `total_net` float NOT NULL,
  `seller_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=542 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_receipt_detail`
--

DROP TABLE IF EXISTS `tbl_receipt_detail`;
CREATE TABLE IF NOT EXISTS `tbl_receipt_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `receipt_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_code` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_description` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `item_quantity` int NOT NULL,
  `item_unit_price` float NOT NULL,
  `item_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1244 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_shopping`
--

DROP TABLE IF EXISTS `tbl_shopping`;
CREATE TABLE IF NOT EXISTS `tbl_shopping` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `total_compra` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `client_id` (`client_id`),
  KEY `product_id` (`product_id`),
  KEY `quantity` (`quantity`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_shopping`
--

INSERT INTO `tbl_shopping` (`id_compra`, `client_id`, `product_id`, `quantity`, `fecha_compra`, `total_compra`) VALUES
(1, 39, 89, 1, '2025-02-12', 20.00),
(2, 39, 89, 1, '2025-02-12', 20.00),
(3, 54, 89, 3, '2025-02-12', 60.00),
(5, 39, 89, 50, '2025-02-12', 1000.00),
(6, 39, 89, 1, '2025-02-12', 20.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `employee_id` int NOT NULL,
  `photo_url` varchar(1000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permissions` int DEFAULT '4',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `employee_id`, `photo_url`, `registration_date`, `permissions`) VALUES
(28, 'david', '$2y$10$2Ws2zWWsXydmAiaZTz76tOw3pLX3hfP5RNQhowovgT0iDJZvI8n1i', 26, '', '2024-11-25 20:41:20', 1),
(34, 'Chris', '$2y$10$b0BXN2I0VT6xCIa4UyfNTubTgXgtkn2daNQiRF2r1BDv0I1l2LuMi', 32, '', '2024-12-01 21:52:51', 3),
(35, 'admin', '$2y$10$67.A4zGOq6KgLbGzYdesKOCkaQ6vVpbWOm5J2SJjBidiyzkZOqKp2', 25, '', '2024-12-02 14:20:09', 1),
(38, 'Prieto', '$2y$10$oq2zW0fb./L1aP1M5pX4p.7sv9gu/pX3zpOqMsK.nZ7m13kgxjf3e', 9, '', '2024-12-09 14:32:39', 4),
(39, 'prueba', '$2y$10$q.oobV/a3NM4j9j7lJsuoe.EGKXsmUGr6VSgSiFkFbIl8ClTqIB8G', 33, '', '2024-12-11 19:13:54', 2),
(41, '123', '$2y$10$IADV/5.DuTIzdU4Pu3ClJ.sp2rloLRptw22L2DyY35APDyqAt.ZE2', 27, '', '2024-12-12 16:27:41', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_warehouse_movement`
--

DROP TABLE IF EXISTS `tbl_warehouse_movement`;
CREATE TABLE IF NOT EXISTS `tbl_warehouse_movement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `observation` varchar(100) NOT NULL,
  `provider_id` int DEFAULT NULL,
  `doc_reference` varchar(50) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `user_id` int NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=855 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_warehouse_movement`
--

INSERT INTO `tbl_warehouse_movement` (`id`, `type`, `product_id`, `quantity`, `observation`, `provider_id`, `doc_reference`, `expiration_date`, `user_id`, `registration_date`) VALUES
(799, 1, 87, 100, '', 91, '1', '2025-01-16', 39, '2025-01-16 16:04:00'),
(805, 1, 88, 13, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:30:44'),
(806, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:31:26'),
(807, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:32:29'),
(808, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:34:25'),
(809, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:36:12'),
(810, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:36:12'),
(811, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:36:43'),
(812, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:36:43'),
(813, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:37:33'),
(814, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:37:33'),
(815, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:38:14'),
(816, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:38:14'),
(817, 1, 89, 7, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:38:43'),
(818, 1, 89, 7, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:38:43'),
(819, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:39:50'),
(820, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:39:50'),
(821, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:40:38'),
(822, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:40:38'),
(823, 1, 88, 10, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:43:57'),
(824, 1, 88, 10, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:44:03'),
(825, 1, 88, 10, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:44:03'),
(826, 1, 88, 10, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:44:04'),
(827, 1, 88, 10, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:44:17'),
(828, 1, 88, 10, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:44:26'),
(829, 1, 88, 1, '1234567', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:46:07'),
(830, 1, 87, 1, 'Pene duro para mujeres insaciables', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:48:25'),
(831, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:49:15'),
(832, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:50:08'),
(833, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:50:08'),
(834, 1, 87, 1, 'Pene duro para mujeres insaciables', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:50:37'),
(835, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:51:13'),
(836, 1, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:51:40'),
(837, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:52:34'),
(838, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:54:33'),
(839, 1, 87, 1, 'Pene duro para mujeres insaciables', NULL, NULL, '2025-01-22', 39, '2025-01-22 10:55:58'),
(840, 1, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-01-23', 39, '2025-01-23 11:35:05'),
(841, 1, 91, 30, 'Harina a base Maiz amarillo', NULL, NULL, '2025-02-14', 39, '2025-01-27 11:35:43'),
(842, 3, 91, 30, 'Harina a base Maiz amarillo', NULL, NULL, '2025-01-27', 39, '2025-01-27 11:42:07'),
(843, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 09:58:13'),
(844, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 10:07:19'),
(845, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 10:08:10'),
(846, 3, 89, 3, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 10:37:08'),
(847, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 10:44:45'),
(848, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 11:32:07'),
(849, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 11:36:58'),
(850, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 11:47:16'),
(851, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 11:51:10'),
(852, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 11:52:59'),
(853, 3, 89, 50, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 14:46:43'),
(854, 3, 89, 1, 'PAN INTEGR4AL', NULL, NULL, '2025-02-12', 39, '2025-02-12 15:41:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_venezuela_departments`
--

DROP TABLE IF EXISTS `ubigeo_venezuela_departments`;
CREATE TABLE IF NOT EXISTS `ubigeo_venezuela_departments` (
  `id` varchar(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `ubigeo_venezuela_departments`
--

INSERT INTO `ubigeo_venezuela_departments` (`id`, `name`) VALUES
('01', 'Amazonas'),
('02', 'Anzoátegui'),
('03', 'Apure'),
('04', 'Aragua'),
('05', 'Barinas'),
('06', 'Bolívar'),
('07', 'Carabobo'),
('08', 'Cojedes'),
('09', 'Delta Amacuro'),
('10', 'Distrito Capital'),
('11', 'Falcón'),
('12', 'Guárico'),
('13', 'Lara'),
('14', 'Mérida'),
('15', 'Miranda'),
('16', 'Monagas'),
('17', 'Nueva Esparta'),
('18', 'Portuguesa'),
('19', 'Sucre'),
('20', 'Táchira'),
('21', 'Trujillo'),
('22', 'Vargas'),
('23', 'Yaracuy'),
('24', 'Zulia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_venezuela_districts`
--

DROP TABLE IF EXISTS `ubigeo_venezuela_districts`;
CREATE TABLE IF NOT EXISTS `ubigeo_venezuela_districts` (
  `id` varchar(6) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `province_id` varchar(4) DEFAULT NULL,
  `department_id` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_venezuela_municipalities`
--

DROP TABLE IF EXISTS `ubigeo_venezuela_municipalities`;
CREATE TABLE IF NOT EXISTS `ubigeo_venezuela_municipalities` (
  `id` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department_id` varchar(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubigeo_venezuela_municipalities`
--

INSERT INTO `ubigeo_venezuela_municipalities` (`id`, `name`, `department_id`) VALUES
('0101', 'Alto Orinoco', '01'),
('0102', 'Atabapo', '01'),
('0103', 'Atures', '01'),
('0104', 'Autana', '01'),
('0105', 'Manapiare', '01'),
('0106', 'Maroa', '01'),
('0107', 'Río Negro', '01'),
('0201', 'Anaco', '02'),
('0202', 'Aragua', '02'),
('0203', 'Diego Bautista Urbaneja', '02'),
('0204', 'Fernando de Peñalver', '02'),
('0205', 'Francisco del Carmen Carvajal', '02'),
('0206', 'General Sir Arthur McGregor', '02'),
('0207', 'Guanta', '02'),
('0208', 'Independencia', '02'),
('0209', 'José Gregorio Monagas', '02'),
('0210', 'Juan Antonio Sotillo', '02'),
('0211', 'Juan Manuel Cajigal', '02'),
('0212', 'Libertad', '02'),
('0213', 'Manuel Ezequiel Bruzual', '02'),
('0214', 'Miranda', '02'),
('0215', 'Pedro María Freites', '02'),
('0216', 'Píritu', '02'),
('0217', 'San José de Guanipa', '02'),
('0218', 'San Juan de Capistrano', '02'),
('0219', 'Santa Ana', '02'),
('0220', 'Simón Bolívar', '02'),
('0221', 'Simón Rodríguez', '02'),
('0301', 'Achaguas', '03'),
('0302', 'Biruaca', '03'),
('0303', 'Muñoz', '03'),
('0304', 'Páez', '03'),
('0305', 'Pedro Camejo', '03'),
('0306', 'Rómulo Gallegos', '03'),
('0307', 'San Fernando', '03'),
('0401', 'Bolívar', '04'),
('0402', 'Camatagua', '04'),
('0403', 'Francisco Linares Alcántara', '04'),
('0404', 'Girardot', '04'),
('0405', 'José Ángel Lamas', '04'),
('0406', 'José Félix Ribas', '04'),
('0407', 'José Rafael Revenga', '04'),
('0408', 'Libertador', '04'),
('0409', 'Mario Briceño Iragorry', '04'),
('0410', 'Ocumare de la Costa de Oro', '04'),
('0411', 'San Casimiro', '04'),
('0412', 'San Sebastián', '04'),
('0413', 'Santiago Mariño', '04'),
('0414', 'Santos Michelena', '04'),
('0415', 'Sucre', '04'),
('0416', 'Tovar', '04'),
('0417', 'Urdaneta', '04'),
('0418', 'Zamora', '04'),
('0501', 'Alberto Arvelo Torrealba', '05'),
('0502', 'Andrés Eloy Blanco', '05'),
('0503', 'Antonio José de Sucre', '05'),
('0504', 'Arismendi', '05'),
('0505', 'Barinas', '05'),
('0506', 'Bolívar', '05'),
('0507', 'Cruz Paredes', '05'),
('0508', 'Ezequiel Zamora', '05'),
('0509', 'Obispos', '05'),
('0510', 'Pedraza', '05'),
('0511', 'Rojas', '05'),
('0512', 'Sosa', '05'),
('0601', 'Caroní', '06'),
('0602', 'Cedeño', '06'),
('0603', 'El Callao', '06'),
('0604', 'Gran Sabana', '06'),
('0605', 'Heres', '06'),
('0606', 'Piar', '06'),
('0607', 'Raúl Leoni', '06'),
('0608', 'Roscio', '06'),
('0609', 'Sifontes', '06'),
('0610', 'Sucre', '06'),
('0611', 'Padre Pedro Chien', '06'),
('0701', 'Bejuma', '07'),
('0702', 'Carlos Arvelo', '07'),
('0703', 'Diego Ibarra', '07'),
('0704', 'Guacara', '07'),
('0705', 'Juan José Mora', '07'),
('0706', 'Libertador', '07'),
('0707', 'Los Guayos', '07'),
('0708', 'Miranda', '07'),
('0709', 'Montalbán', '07'),
('0710', 'Naguanagua', '07'),
('0711', 'Puerto Cabello', '07'),
('0712', 'San Diego', '07'),
('0713', 'San Joaquín', '07'),
('0714', 'Valencia', '07'),
('0801', 'Anzoátegui', '08'),
('0802', 'Falcón', '08'),
('0803', 'Girardot', '08'),
('0804', 'Lima Blanco', '08'),
('0805', 'Pao de San Juan Bautista', '08'),
('0806', 'Ricaurte', '08'),
('0807', 'Rómulo Gallegos', '08'),
('0808', 'San Carlos', '08'),
('0809', 'Tinaco', '08'),
('0901', 'Antonio Díaz', '09'),
('0902', 'Casacoima', '09'),
('0903', 'Pedernales', '09'),
('0904', 'Tucupita', '09'),
('1001', 'Libertador', '10'),
('1101', 'Acosta', '11'),
('1102', 'Bolívar', '11'),
('1103', 'Buchivacoa', '11'),
('1104', 'Cacique Manaure', '11'),
('1105', 'Carirubana', '11'),
('1106', 'Colina', '11'),
('1107', 'Dabajuro', '11'),
('1108', 'Democracia', '11'),
('1109', 'Falcón', '11'),
('1110', 'Federación', '11'),
('1111', 'Jacura', '11'),
('1112', 'Los Taques', '11'),
('1113', 'Mauroa', '11'),
('1114', 'Miranda', '11'),
('1115', 'Monseñor Iturriza', '11'),
('1116', 'Palmasola', '11'),
('1117', 'Petit', '11'),
('1118', 'Píritu', '11'),
('1119', 'San Francisco', '11'),
('1120', 'Silva', '11'),
('1121', 'Sucre', '11'),
('1122', 'Tocópero', '11'),
('1123', 'Unión', '11'),
('1124', 'Urumaco', '11'),
('1125', 'Zamora', '11'),
('1201', 'Camaguán', '12'),
('1202', 'Chaguaramas', '12'),
('1203', 'El Socorro', '12'),
('1204', 'Francisco de Miranda', '12'),
('1205', 'José Félix Ribas', '12'),
('1206', 'José Tadeo Monagas', '12'),
('1207', 'Juan Germán Roscio', '12'),
('1208', 'Julián Mellado', '12'),
('1209', 'Las Mercedes', '12'),
('1210', 'Leonardo Infante', '12'),
('1211', 'Ortíz', '12'),
('1212', 'San Gerónimo de Guayabal', '12'),
('1213', 'San José de Guaribe', '12'),
('1214', 'Santa María de Ipire', '12'),
('1215', 'Zaraza', '12'),
('1301', 'Andrés Eloy Blanco', '13'),
('1302', 'Crespo', '13'),
('1303', 'Iribarren', '13'),
('1304', 'Jiménez', '13'),
('1305', 'Morán', '13'),
('1306', 'Palavecino', '13'),
('1307', 'Simón Planas', '13'),
('1308', 'Torres', '13'),
('1309', 'Urdaneta', '13'),
('1401', 'Alberto Adriani', '14'),
('1402', 'Andrés Bello', '14'),
('1403', 'Antonio Pinto Salinas', '14'),
('1404', 'Aricagua', '14'),
('1405', 'Arzobispo Chacón', '14'),
('1406', 'Campo Elías', '14'),
('1407', 'Caracciolo Parra Olmedo', '14'),
('1408', 'Cardenal Quintero', '14'),
('1409', 'Guaraque', '14'),
('1410', 'Julio César Salas', '14'),
('1411', 'Justo Briceño', '14'),
('1412', 'Libertador', '14'),
('1413', 'Miranda', '14'),
('1414', 'Obispo Ramos de Lora', '14'),
('1415', 'Padre Noguera', '14'),
('1416', 'Pueblo Llano', '14'),
('1417', 'Rangel', '14'),
('1418', 'Rivas Dávila', '14'),
('1419', 'Santos Marquina', '14'),
('1420', 'Sucre', '14'),
('1421', 'Tovar', '14'),
('1422', 'Tulio Febres Cordero', '14'),
('1423', 'Zea', '14'),
('1501', 'Acevedo', '15'),
('1502', 'Andrés Bello', '15'),
('1503', 'Baruta', '15'),
('1504', 'Brión', '15'),
('1505', 'Buroz', '15'),
('1506', 'Carrizal', '15'),
('1507', 'Chacao', '15'),
('1508', 'Cristóbal Rojas', '15'),
('1509', 'El Hatillo', '15'),
('1510', 'Guaicaipuro', '15'),
('1511', 'Independencia', '15'),
('1512', 'Lander', '15'),
('1513', 'Los Salias', '15'),
('1514', 'Páez', '15'),
('1515', 'Paz Castillo', '15'),
('1516', 'Pedro Gual', '15'),
('1517', 'Plaza', '15'),
('1518', 'Simón Bolívar', '15'),
('1519', 'Sucre', '15'),
('1520', 'Urdaneta', '15'),
('1521', 'Zamora', '15'),
('1601', 'Acosta', '16'),
('1602', 'Aguasay', '16'),
('1603', 'Bolívar', '16'),
('1604', 'Caripe', '16'),
('1605', 'Cedeño', '16'),
('1606', 'Ezequiel Zamora', '16'),
('1607', 'Libertador', '16'),
('1608', 'Maturín', '16'),
('1609', 'Piar', '16'),
('1610', 'Punceres', '16'),
('1611', 'Santa Bárbara', '16'),
('1612', 'Sotillo', '16'),
('1613', 'Uracoa', '16'),
('1701', 'Antolín del Campo', '17'),
('1702', 'Arismendi', '17'),
('1703', 'Díaz', '17'),
('1704', 'García', '17'),
('1705', 'Gómez', '17'),
('1706', 'Maneiro', '17'),
('1707', 'Marcano', '17'),
('1708', 'Mariño', '17'),
('1709', 'Península de Macanao', '17'),
('1710', 'Tubores', '17'),
('1711', 'Villalba', '17'),
('1801', 'Agua Blanca', '18'),
('1802', 'Araure', '18'),
('1803', 'Esteller', '18'),
('1804', 'Guanare', '18'),
('1805', 'Guanarito', '18'),
('1806', 'Monseñor José Vicente de Unda', '18'),
('1807', 'Ospino', '18'),
('1808', 'Páez', '18'),
('1809', 'Papelón', '18'),
('1810', 'San Genaro de Boconoito', '18'),
('1811', 'San Rafael de Onoto', '18'),
('1812', 'Santa Rosalía', '18'),
('1813', 'Sucre', '18'),
('1814', 'Turén', '18'),
('1901', 'Andrés Eloy Blanco', '19'),
('1902', 'Andrés Mata', '19'),
('1903', 'Arismendi', '19'),
('1904', 'Benítez', '19'),
('1905', 'Bermúdez', '19'),
('1906', 'Bolívar', '19'),
('1907', 'Cajigal', '19'),
('1908', 'Cruz Salmerón Acosta', '19'),
('1909', 'Libertador', '19'),
('1910', 'Mariño', '19'),
('1911', 'Mejía', '19'),
('1912', 'Montes', '19'),
('1913', 'Ribero', '19'),
('1914', 'Sucre', '19'),
('1915', 'Valdez', '19'),
('2001', 'Andrés Bello', '20'),
('2002', 'Antonio Rómulo Costa', '20'),
('2003', 'Ayacucho', '20'),
('2004', 'Bolívar', '20'),
('2005', 'Cárdenas', '20'),
('2006', 'Córdoba', '20'),
('2007', 'Fernández Feo', '20'),
('2008', 'Francisco de Miranda', '20'),
('2009', 'García de Hevia', '20'),
('2010', 'Guásimos', '20'),
('2011', 'Independencia', '20'),
('2012', 'Jáuregui', '20'),
('2013', 'José María Vargas', '20'),
('2014', 'Junín', '20'),
('2015', 'Libertad', '20'),
('2016', 'Libertador', '20'),
('2017', 'Lobatera', '20'),
('2018', 'Michelena', '20'),
('2019', 'Panamericano', '20'),
('2020', 'Pedro María Ureña', '20'),
('2021', 'Rafael Urdaneta', '20'),
('2022', 'Samuel Darío Maldonado', '20'),
('2023', 'San Cristóbal', '20'),
('2024', 'San Judas Tadeo', '20'),
('2101', 'Andrés Bello', '21'),
('2102', 'Boconó', '21'),
('2103', 'Bolívar', '21'),
('2104', 'Candelaria', '21'),
('2105', 'Carache', '21'),
('2106', 'Escuque', '21'),
('2107', 'José Felipe Márquez Cañizales', '21'),
('2108', 'Juan Vicente Campos Elías', '21'),
('2109', 'La Ceiba', '21'),
('2110', 'Miranda', '21'),
('2111', 'Monte Carmelo', '21'),
('2112', 'Motatán', '21'),
('2113', 'Pampán', '21'),
('2114', 'Pampanito', '21'),
('2115', 'Rafael Rangel', '21'),
('2116', 'San Rafael de Carvajal', '21'),
('2117', 'Sucre', '21'),
('2118', 'Trujillo', '21'),
('2119', 'Urdaneta', '21'),
('2120', 'Valera', '21'),
('2201', 'Vargas', '22'),
('2301', 'Arístides Bastidas', '23'),
('2302', 'Bolívar', '23'),
('2303', 'Bruzual', '23'),
('2304', 'Cocorote', '23'),
('2305', 'Independencia', '23'),
('2306', 'José Antonio Páez', '23'),
('2307', 'La Trinidad', '23'),
('2308', 'Manuel Monge', '23'),
('2309', 'Nirgua', '23'),
('2310', 'Peña', '23'),
('2311', 'San Felipe', '23'),
('2312', 'Sucre', '23'),
('2313', 'Urachiche', '23'),
('2314', 'Veroes', '23'),
('2401', 'Almirante Padilla', '24'),
('2402', 'Baralt', '24'),
('2403', 'Cabimas', '24'),
('2404', 'Catatumbo', '24'),
('2405', 'Colón', '24'),
('2406', 'Francisco Javier Pulgar', '24'),
('2407', 'Jesús Enrique Lossada', '24'),
('2408', 'Jesús María Semprún', '24'),
('2409', 'La Cañada de Urdaneta', '24'),
('2410', 'Lagunillas', '24'),
('2411', 'Machiques de Perijá', '24'),
('2412', 'Mara', '24'),
('2413', 'Maracaibo', '24'),
('2414', 'Miranda', '24'),
('2415', 'Páez', '24'),
('2416', 'Rosario de Perijá', '24'),
('2417', 'San Francisco', '24'),
('2418', 'Santa Rita', '24'),
('2419', 'Simón Bolívar', '24'),
('2420', 'Sucre', '24'),
('2421', 'Valmore Rodríguez', '24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_venezuela_parishes`
--

DROP TABLE IF EXISTS `ubigeo_venezuela_parishes`;
CREATE TABLE IF NOT EXISTS `ubigeo_venezuela_parishes` (
  `id` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `province_id` varchar(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department_id` varchar(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubigeo_venezuela_parishes`
--

INSERT INTO `ubigeo_venezuela_parishes` (`id`, `name`, `province_id`, `department_id`) VALUES
('010101', 'La Esmeralda', '0101', '01'),
('010102', 'Sierra Parima', '0101', '01'),
('010103', 'Ucata', '0101', '01'),
('020101', 'Anaco', '0201', '02'),
('020102', 'San Mateo', '0202', '02'),
('020103', 'El Tigre', '0203', '02'),
('030101', 'Guasdualito', '0301', '03'),
('030102', 'Elorza', '0302', '03'),
('030103', 'San Fernando', '0303', '03'),
('040101', 'Maracay', '0401', '04'),
('040102', 'Turmero', '0402', '04'),
('040103', 'La Victoria', '0403', '04'),
('050101', 'Barinas', '0501', '05'),
('050102', 'Sabaneta', '0502', '05'),
('050103', 'Socopó', '0503', '05'),
('060101', 'Ciudad Bolívar', '0601', '06'),
('060102', 'Ciudad Guayana', '0602', '06'),
('070101', 'Valencia', '0701', '07'),
('070102', 'Puerto Cabello', '0702', '07'),
('080101', 'San Carlos', '0801', '08'),
('080102', 'Tinaquillo', '0802', '08'),
('090101', 'Tucupita', '0901', '09'),
('100101', 'Libertador', '1001', '10'),
('110101', 'Coro', '1101', '11'),
('110102', 'Punto Fijo', '1102', '11'),
('120101', 'San Juan de los Morros', '1201', '12'),
('120102', 'Valle de la Pascua', '1202', '12'),
('130101', 'Barquisimeto', '1301', '13'),
('130102', 'El Tocuyo', '1302', '13'),
('140101', 'Mérida', '1401', '14'),
('150101', 'Los Teques', '1501', '15'),
('150102', 'Guatire', '1502', '15'),
('160101', 'Maturín', '1601', '16'),
('170101', 'La Asunción', '1701', '17'),
('170102', 'Porlamar', '1702', '17'),
('180101', 'Acarigua', '1801', '18'),
('190101', 'Cumaná', '1901', '19'),
('200101', 'San Cristóbal', '2001', '20'),
('210101', 'Trujillo', '2101', '21'),
('220101', 'La Guaira', '2201', '22'),
('230101', 'San Felipe', '2301', '23'),
('240101', 'Maracaibo', '2401', '24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo_venezuela_provinces`
--

DROP TABLE IF EXISTS `ubigeo_venezuela_provinces`;
CREATE TABLE IF NOT EXISTS `ubigeo_venezuela_provinces` (
  `id` varchar(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department_id` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
