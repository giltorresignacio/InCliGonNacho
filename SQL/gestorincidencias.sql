-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2023 a las 16:13:29
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestorincidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--
DROP DATABASE IF EXISTS escuela;
CREATE DATABASE escuela;
use escuela;
--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL UNIQUE,
  `contrasena` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL UNIQUE,
  `admin` boolean DEFAULT NULL,
  PRIMARY KEY (`id`, `usuario`,`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
CREATE TABLE `aulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iDtipo` int(11) DEFAULT NULL,
  `iDaula` int(11) DEFAULT NULL,
  `iDgrupo` int(11) DEFAULT NULL,
  `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `descripcion` text DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`, `fecha`),
  FOREIGN KEY (`profesor_id`) REFERENCES `profesores`(`id`),
  FOREIGN KEY (`iDtipo`) REFERENCES `tipos`(`id`),
  FOREIGN KEY (`iDaula`) REFERENCES `aulas`(`id`),
  FOREIGN KEY (`iDgrupo`) REFERENCES `grupos`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

INSERT INTO `profesores` (`nombre`, `apellidos`, `departamento`, `usuario`, `contrasena`, `mail`, `admin`) VALUES
('Pepe', 'García Pérez', 'Daw', 'pepe.garcia', '123456', 'pepe.garcia@educa.madrid.org', 0),
('Raul', 'Blazquez', 'Daw', 'raul.blazquez', '123456', 'raul.blazquez@educa.madrid.org', 0),
('Maite', 'Hálamo', 'Daw', 'maite.halamo', '123456', 'maite.halamo@educa.madrid.org', 0),
('Laura', 'Algo', 'Daw', 'laura.algo', '123456', 'laura.algo@educa.madrid.org', 0),
('Luna', 'Roblejos', 'Daw', 'luna.roblejos', '123456', 'luna.roblejos@educa.madrid.org', 0),
('Dani', 'Suarez', 'Daw', 'CTIC', 'CTICPIO2023', 'admin.garcia@educa.madrid.org', 1);

INSERT INTO `tipos` (`nombre`) VALUES
('Hardware'),
('Software'),
('Conectividad'),
('Recursos EducaMadrid'),
('PDI'),
('Impresión');

INSERT INTO `grupos` (`nombre`) VALUES
('1º Comercio internacional-dual'),
('1º ASIR-DUAL'),
('1º APD'),
('1º AEI'),
('1º FPB AF'),
('1º CI'),
('2ºCI-DISTANCIA'),
('1º FPB'),
('2º FPB'),
('1º COM'),
('1º COM V'),
('2º COM'),
('2º COM V'),
('1º AFD A'),
('2º AFD A'),
('1º IS A'),
('1º IS V'),
('1º IS B'),
('2º IS V'),
('2º IS A'),
('1º GUIA'),
('2º GUIA'),
('2º EI A'),
('2º EI B'),
('1º JARD'),
('2º JARD'),
('ACEPELU'),
('ACE MBE'),
('1º B EI'),
('1º DAW'),
('1º DAM'),
('2º DAW'),
('2º DAM'),
('1º SMR'),
('2º SMR'),
('1º AF'),
('2º AF'),
('1º ASDI'),
('1º AGM'),
('2º AGM'),
('2º MC A'),
('2º MC B'),
('1º MC A'),
('1º MC B'),
('2º APD'),
('2º IS B');

INSERT INTO `aulas` (`nombre`) VALUES
('DESPACHO JEFATURA'),
('DESPACHO DIRECCIÓN'),
('DEPACHO SECRETARÍA'),
('SALA DE PROFESORES'),
('BIBLIOTECA'),
('SECRETARÍA'),
('CONSERJERÍA'),
('SALÓN DE ACTOS'),
('GIMNASIO'),
('SALA EMPRENDIMIENTO'),
('AULA B.1'),
('AULA B.2'),
('AULA B.3'),
('AULA B.4'),
('AULA B.5'),
('AULA B.7'),
('AULA B.9'),
('AULA B.11'),
('AULA B.13'),
('AULA 1.1'),
('AULA 1.2'),
('AULA 1.3'),
('AULA 1.4'),
('AULA 1.5'),
('AULA 1.6'),
('AULA 1.7'),
('AULA 1.8'),
('AULA 1.9'),
('AULA 1.10'),
('AULA 1.11'),
('AULA 1.12'),
('AULA 1.13'),
('AULA 1.14'),
('AULA 1.15'),
('AULA 1.16'),
('AULA 1.17'),
('AULA 1.18'),
('AULA 1.19'),
('AULA 1.20'),
('AULA 1.21'),
('AULA 1.22'),
('AULA 1.23'),
('AULA 2.1'),
('AULA 2.2'),
('AULA 2.3'),
('AULA 2.4'),
('AULA 2.5'),
('AULA 2.6'),
('AULA 2.7'),
('AULA 2.8'),
('AULA 2.9'),
('AULA 2.11'),
('AULA 2.13');

INSERT INTO `incidencias` (`iDtipo`, `iDaula`, `iDgrupo`, `descripcion`, `estado`, `profesor_id`) VALUES
(1, 3, 2, 'El proyector no funciona', 'creada', 1);

INSERT INTO `incidencias` (`iDtipo`, `iDaula`, `iDgrupo`, `descripcion`, `estado`, `profesor_id`) VALUES
(2, 2, 2, 'El proyector no funciona', 'creada', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;