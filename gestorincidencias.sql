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
  `usuario` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`, `usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `aula` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `descripcion` text DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`, `fecha`),
  FOREIGN KEY (`profesor_id`) REFERENCES `profesores`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

INSERT INTO `profesores` (`nombre`, `apellidos`, `departamento`, `usuario`, `contrasena`, `mail`) VALUES
('Pepe', 'García Pérez', 'Daw', 'pepe.garcia', '123456', 'pepe.garcia@ejemplo.com'),
('Raul', 'Blazquez', 'Daw', 'raul.blazquez', '123456', 'raul.blazquez@ejemplo.com'),
('Maite', 'Hálamo', 'Daw', 'maite.halamo', '123456', 'maite.halamo@ejemplo.com'),
('Laura', 'Algo', 'Daw', 'laura.algo', '123456', 'laura.algo@ejemplo.com'),
('Luna', 'Roblejos', 'Daw', 'luna.roblejos', '123456', 'luna.roblejos@ejemplo.com'),
('Dani', 'Suarez', 'Daw', 'CTIC', 'CTICPIO2023.', 'pepe.garcia@ejemplo.com');

INSERT INTO `incidencias` (`tipo`, `aula`, `curso`, `descripcion`, `estado`, `profesor_id`) VALUES
('Hardware', 'Aula 101', '2º daw', 'El proyector no funciona', 'creada', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
