-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2023 a las 18:26:00
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carne`
--

CREATE TABLE `carne` (
  `tabla` varchar(20) NOT NULL DEFAULT 'carne',
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `numero_unidades` int(11) DEFAULT NULL,
  `origen` varchar(255) DEFAULT NULL,
  `variedad` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carne`
--

INSERT INTO `carne` (`tabla`, `id`, `nombre`, `descripcion`, `numero_unidades`, `origen`, `variedad`, `stock`, `precio`) VALUES
('carne', 1, 'Solomillo de cerdo', 'Solomillo de cerdo de alta calidad', 1, 'España', 'Cerdo ibérico', 10, 27),
('carne', 2, 'Chuleta de ternera', 'Chuleta de ternera fresca y tierna', 2, 'España', 'Ternera gallega', 10, 14),
('carne', 3, 'Carne de cordero', 'Carne de cordero de leche de alta calidad', 1, 'España', 'Cordero lechal', 10, 18),
('carne', 4, 'Chorizo criollo', 'Chorizo criollo artesanal', 1, 'Argentina', 'Cerdo criollo', 10, 9),
('carne', 5, 'Longaniza', 'Longaniza artesanal de pueblo', 1, 'España', 'Cerdo ibérico', 10, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fruta`
--

CREATE TABLE `fruta` (
  `tabla` varchar(11) NOT NULL DEFAULT 'fruta',
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `numero_unidades` int(11) DEFAULT NULL,
  `origen` varchar(255) DEFAULT NULL,
  `variedad` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fruta`
--

INSERT INTO `fruta` (`tabla`, `id`, `nombre`, `descripcion`, `numero_unidades`, `origen`, `variedad`, `stock`, `precio`) VALUES
('fruta', 11, 'Banana', 'Banana madura y suave', 1, 'Ecuador', 'Banana madura', 10, 3),
('fruta', 12, 'Naranja', 'Naranja dulce y jugosa', 2, 'España', 'Naranja dulce', 10, 2),
('fruta', 13, 'Papaya', 'Papaya madura y dulce', 1, 'México', 'Papaya madura', 10, 5),
('fruta', 14, 'Mango', 'Mango maduro y jugoso', 1, 'Brasil', 'Mango maduro', 10, 4),
('fruta', 15, 'Piña', 'Piña madura y dulce', 1, 'Filipinas', 'Piña madura', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pescado`
--

CREATE TABLE `pescado` (
  `tabla` varchar(20) NOT NULL DEFAULT 'pescado',
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `numero_unidades` int(11) DEFAULT NULL,
  `origen` varchar(255) DEFAULT NULL,
  `variedad` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pescado`
--

INSERT INTO `pescado` (`tabla`, `id`, `nombre`, `descripcion`, `numero_unidades`, `origen`, `variedad`, `stock`, `precio`) VALUES
('pescado', 21, 'Bacalao', 'Bacalao fresco y salado', 1, 'España', 'Bacalao salado', 10, 15),
('pescado', 22, 'Lenguado', 'Lenguado fresco y suave', 2, 'España', 'Lenguado', 15, 8),
('pescado', 23, 'Salmón', 'Salmón fresco y con poca grasa', 1, 'Noruega', 'Salmón', 12, 25),
('pescado', 24, 'Atún rojo', 'Atún rojo fresco y de alta calidad', 1, 'España', 'Atún rojo', 16, 19),
('pescado', 25, 'Merluza', 'Merluza fresca y suave', 1, 'España', 'Merluza', 10, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carne`
--
ALTER TABLE `carne`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fruta`
--
ALTER TABLE `fruta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pescado`
--
ALTER TABLE `pescado`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carne`
--
ALTER TABLE `carne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fruta`
--
ALTER TABLE `fruta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pescado`
--
ALTER TABLE `pescado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
