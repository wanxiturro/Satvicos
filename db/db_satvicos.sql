-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-12-2024 a las 20:37:30
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
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`) VALUES
(1, 'create_user'),
(2, 'edit_user'),
(3, 'delete_user');

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

--
-- Volcado de datos para la tabla `tbl_credit_note`
--

INSERT INTO `tbl_credit_note` (`id`, `series`, `number`, `status`, `referenced_doc_id`, `referenced_doc_type_id`, `customer_id`, `ruc`, `name`, `address`, `reference`, `payment_days`, `date`, `delivery_date`, `currency`, `reason`, `discount_rate`, `discount_value`, `total_sub`, `total_tax`, `total_net`, `seller_id`, `user_id`, `registration_date`, `last_update`) VALUES
(188, 'FNC1', '0000001', 1, 2425, 1, 0, '00007', 'Pedro', '12312', '123123', 0, '1970-01-01', '2024-12-02', 'MN', 'DEVOLUCION_TOTAL', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:04:09', '2024-12-02 20:04:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_customer`
--

INSERT INTO `tbl_customer` (`client_id`, `ruc`, `business_name`, `trade_name`, `email`, `phone`, `cellphone`, `address`, `department_id`, `province_id`, `district_id`, `contact1_name`, `contact1_phone`, `contact2_name`, `contact2_phone`, `commission`, `registration_date`) VALUES
(50, '12345678910', 'Tttttt', 'Ttttttt', 'Lout4639@gmail.com', '04261936499', '04126492929378', '17940284', '10', '1001', '100101', 'Juan', '0416428917439', '', '', 500, '2024-12-01 00:00:00');

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
(25, 'Juan Andrés', 'Cumana', 'Albornoz', 'DNI', '31.082.307', 'Casado', 'lbpf2021jaca@gmail.com', '4129041258', 'la dolorita', 'Gerente General', 'Actualmente cursando', 'Informatica', '2004-09-13', '2024-11-25'),
(26, 'Brayan David', 'Orejuela', 'Villamizar', 'DNI', '888888888', 'Soltero', 'oligarcastudios@gmail.com', '77777777777', 'Bucaramanga', 'Mantenimiento', 'Técnico', 'asd', '2024-11-25', '2024-11-25'),
(27, 'Gabriela', 'Salazar', 'Tineo', 'DNI', 'puta', 'Casado', 'nose@gmail.com', 'asdasd123', 'En la perra madre', 'Gerente de Marketing', 'Titulado', 'asdas', '2024-11-05', '2024-11-28'),
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
) ENGINE=InnoDB AUTO_INCREMENT=2430 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `series`, `number`, `status`, `quotation_id`, `customer_id`, `ruc`, `name`, `address`, `reference`, `payment_days`, `date`, `delivery_date`, `currency`, `discount_rate`, `discount_value`, `total_sub`, `total_tax`, `total_net`, `seller_id`, `user_id`, `registration_date`, `last_update`) VALUES
(2425, 'F001', '0000001', 3, 2, 0, '00007', 'Pedro', '12312', '123123', 0, '1970-01-01', '2024-12-02', 'MN', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:02:25', '2024-12-02 20:02:25'),
(2426, 'F001', '0000002', 1, 3, 0, '123123', '123123', '123123', '1231', 0, '1970-01-01', '2024-12-02', 'ME', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:08:16', '2024-12-02 20:08:16'),
(2427, 'F001', '0000003', 1, 3, 0, '123123', '123123', '123123', '1231', 0, '1970-01-01', '2024-12-02', 'ME', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:20:23', '2024-12-02 20:20:23'),
(2428, 'F001', '0000004', 4, 2, 0, '00007', 'Pedro', '12312', '123123', 0, '1970-01-01', '2024-12-02', 'MN', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:31:10', '2024-12-02 20:31:10'),
(2429, 'F001', '0000005', 3, 3, 0, '123123', '123123', '123123', '1231', 0, '1970-01-01', '2024-12-02', 'ME', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:31:53', '2024-12-02 20:31:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=5094 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_invoice_detail`
--

INSERT INTO `tbl_invoice_detail` (`id`, `invoice_id`, `item_id`, `item_code`, `item_description`, `item_quantity`, `item_unit_price`, `item_name`) VALUES
(5089, 2425, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5090, 2426, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5091, 2427, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5092, 2428, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite'),
(5093, 2429, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `brand` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `description` varchar(300) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `stock_quantity` int NOT NULL,
  `unit_price` float NOT NULL,
  `unit_value` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `code`, `brand`, `name`, `description`, `stock_quantity`, `unit_price`, `unit_value`, `active_status`, `registration_date`) VALUES
(38, '0001', 'Glanol', 'Aceite', 'Aceite marca ganol de 500l', 61, 70, 'lt', 1, '2024-12-02 15:56:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_provider`
--

INSERT INTO `tbl_provider` (`id`, `code`, `business_name`, `address`, `country`, `city`, `district`, `contact1_name`, `contact1_phone`, `contact2_name`, `contact2_phone`, `bank1_name`, `bank1_currency`, `bank1_account_number`, `bank1_account_holder`, `bank2_name`, `bank2_currency`, `bank2_account_number`, `bank2_account_holder`, `registration_date`) VALUES
(85, '00007', 'Proovedor Juan', 'wawa', 'Venezuela', 'Caracas', 'Petare', '', '', '', '', '', '', '', '', '', '', '', '', '2024-12-02 19:58:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`id`, `type`, `number`, `status`, `currency`, `issue_date`, `delivery_date`, `provider_id`, `payment_days`, `account_number`, `quotation`, `requester`, `approver`, `observation`, `total_purchase`, `total_tax`, `total_net`, `exchange_rate_sale`, `exchange_rate_purchase`) VALUES
(271, 1, '1231313', 'Pendiente', 'ME', '2024-12-02', '2024-12-02', 85, 0, '1231231', '', '123123', '123123', '123', 162483, 29246.9, 191730, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_purchase_detail`
--

INSERT INTO `tbl_purchase_detail` (`id`, `purchase_id`, `item_code`, `item_description`, `item_gloss`, `item_unit_value`, `item_unit_price`, `item_quantity`, `item_discount_rate`, `item_discounted_total`) VALUES
(295, 271, '123123', '123123', '1231', 'lt', 1321, 123, 0, 162483);

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

--
-- Volcado de datos para la tabla `tbl_quotation`
--

INSERT INTO `tbl_quotation` (`id`, `number`, `status`, `customer_id`, `ruc`, `name`, `address`, `reference`, `payment_days`, `date`, `delivery_date`, `currency`, `discount_rate`, `discount_value`, `total_sub`, `total_tax`, `total_net`, `seller_id`, `user_id`, `registration_date`, `last_update`) VALUES
(2, 'COTZ-1', 1, 0, '00007', 'Pedro', '12312', '123123', 0, '2024-12-02', '2024-12-02', 'MN', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:01:05', '2024-12-02 16:01:05'),
(3, 'COTZ-3', 1, 0, '123123', '123123', '123123', '1231', 0, '2024-12-02', '2024-12-02', 'ME', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:07:34', '2024-12-02 16:07:34');

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

--
-- Volcado de datos para la tabla `tbl_quotation_detail`
--

INSERT INTO `tbl_quotation_detail` (`id`, `quotation_id`, `item_id`, `item_name`, `item_description`, `item_unit_price`, `item_quantity`) VALUES
(2, 2, 38, 'Aceite', 'Aceite marca ganol de 500l', 70, 12),
(3, 3, 38, 'Aceite', 'Aceite marca ganol de 500l', 70, 12);

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

--
-- Volcado de datos para la tabla `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`id`, `series`, `number`, `status`, `quotation_id`, `customer_id`, `ruc`, `name`, `address`, `reference`, `payment_days`, `date`, `delivery_date`, `currency`, `discount_rate`, `discount_value`, `total_sub`, `total_tax`, `total_net`, `seller_id`, `user_id`, `registration_date`, `last_update`) VALUES
(541, 'B001', '0000001', 1, 2, 0, '00007', 'Pedro', '12312', '123123', 0, '1970-01-01', '2024-12-02', 'MN', 0, 0, 840, 151.2, 991.2, 28, 28, '2024-12-02 20:04:54', '2024-12-02 20:04:54');

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

--
-- Volcado de datos para la tabla `tbl_receipt_detail`
--

INSERT INTO `tbl_receipt_detail` (`id`, `receipt_id`, `item_id`, `item_code`, `item_description`, `item_quantity`, `item_unit_price`, `item_name`) VALUES
(1243, 541, 38, '0001', 'Aceite marca ganol de 500l', 12, 70, 'Aceite');

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
  `permissions` int DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `employee_id`, `photo_url`, `registration_date`, `permissions`) VALUES
(28, 'david', '$2y$10$2Ws2zWWsXydmAiaZTz76tOw3pLX3hfP5RNQhowovgT0iDJZvI8n1i', 26, '', '2024-11-25 20:41:20', 1),
(34, 'Chris', '$2y$10$b0BXN2I0VT6xCIa4UyfNTubTgXgtkn2daNQiRF2r1BDv0I1l2LuMi', 32, '', '2024-12-01 21:52:51', 2),
(35, 'admin', '$2y$10$67.A4zGOq6KgLbGzYdesKOCkaQ6vVpbWOm5J2SJjBidiyzkZOqKp2', 25, '', '2024-12-02 14:20:09', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_warehouse_movement`
--

INSERT INTO `tbl_warehouse_movement` (`id`, `type`, `product_id`, `quantity`, `observation`, `provider_id`, `doc_reference`, `expiration_date`, `user_id`, `registration_date`) VALUES
(26, 1, 38, 10, '', NULL, '', '2024-12-02', 28, '2024-12-02 15:57:19'),
(27, 1, 38, 1, '', NULL, '1', '2024-12-02', 28, '2024-12-02 15:57:37'),
(28, 1, 38, 10, 'buen empaque', 85, '1', '2024-12-02', 28, '2024-12-02 15:58:31'),
(29, 1, 38, 100, '12312', 85, '123123', '2024-12-02', 28, '2024-12-02 16:07:05');

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
