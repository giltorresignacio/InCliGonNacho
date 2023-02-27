-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2023 a las 18:25:25
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `num_pedido` int(11) NOT NULL,
  `articulos` text NOT NULL,
  `coste_total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario`, `num_pedido`, `articulos`, `coste_total`) VALUES
(50, 'gonzalo.oliver', 526695, 'a:1:{i:0;a:16:{i:0;s:2:\"23\";s:2:\"id\";s:2:\"23\";i:1;s:7:\"Salmón\";s:6:\"nombre\";s:7:\"Salmón\";i:2;s:31:\"Salmón fresco y con poca grasa\";s:11:\"descripcion\";s:31:\"Salmón fresco y con poca grasa\";i:3;s:1:\"1\";s:15:\"numero_unidades\";s:1:\"1\";i:4;s:7:\"Noruega\";s:6:\"origen\";s:7:\"Noruega\";i:5;s:7:\"Salmón\";s:8:\"variedad\";s:7:\"Salmón\";i:6;s:2:\"12\";s:5:\"stock\";s:2:\"12\";i:7;s:2:\"25\";s:6:\"precio\";s:2:\"25\";}}', 300),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `email`) VALUES
(1, 'gonzalo.oliver', '$2y$10$7OcoS2/xbu1QxLasPOXC6.szSI7xlnstnNQuPEgR0MLEfW/.oAsY.', 'g.oliver.alfonso@gmail.com'),
(2, 'picopato', '$2y$10$mL.A9d9fA7yAmJh.qQ7kKOaXX.ij7P.bf/HEwQ9jH6UIarrRKSn2.', 'email@email.com'),
(3, 'lobo', '$2y$10$Bd5gIM/iFdv6zEBRM2lUj.U03LrrLm5WNACVD6mNY6P9QXA.bShBe', 'seniorlobo@gmail.com'),


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
