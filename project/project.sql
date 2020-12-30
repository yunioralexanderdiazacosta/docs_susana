-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-09-2020 a las 05:46:00
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `tarjeta` varchar(20) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nota` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cards`
--

INSERT INTO `cards` (`id`, `tarjeta`, `fecha`, `cvv`, `id_user`, `nota`) VALUES
(2, '5555666677778888', '03/2021', '444', 2, 'aqui probando nota'),
(3, '2222222222222222', '02/2020', '112', 2, NULL),
(4, '8888888888888888', '04/2020', '222', 2, NULL),
(5, '8029389283929382', '02/2020', '111', NULL, NULL),
(6, '3545435453454534', '05/2020', '243', NULL, NULL),
(7, '3298987243274932', '04/2021', '333', NULL, NULL),
(8, '2637216376217368', '05/2020', '222', NULL, NULL),
(9, '9872304837489730', '06/2025', '222', NULL, NULL),
(10, '3297823797483243', '06/2022', '342', NULL, NULL),
(11, '3243246873264987', '06/2021', '223', 1, NULL),
(12, '8934972347324873', '05/2020', '222', NULL, 'jejeejejeje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `id_user`, `ip`, `fecha`) VALUES
(16, 2, '127.0.0.1', '2020-09-22 23:53:49'),
(17, 2, '127.0.0.1', '2020-09-23 00:01:14'),
(18, 2, '127.0.0.1', '2020-09-23 00:13:11'),
(19, 2, '127.0.0.1', '2020-09-23 02:25:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `id_card` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '1: Visto 0: No visto',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reports`
--

INSERT INTO `reports` (`id`, `id_card`, `id_user`, `descripcion`, `status`, `fecha`) VALUES
(1, 2, 2, 'tarjeta no valida', 1, '2020-09-23 04:40:53'),
(2, 3, 2, 'no me funciona', 1, '2020-09-23 04:50:53'),
(3, 4, 2, 'aasasasasas', 1, '2020-09-23 05:43:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(255) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(1) NOT NULL DEFAULT '2',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1: Activo 0: Bloqueado',
  `sesion` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Activa 0: Inactiva'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nick`, `codigo`, `password`, `role_id`, `status`, `sesion`) VALUES
(1, 'admin', NULL, '5c78b22a9265faebb8882f102250941c', 1, 1, 1),
(2, 'yunior', '0001', '5c78b22a9265faebb8882f102250941c', 2, 1, 0),
(3, 'pedro', '0002', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reports`
--
ALTER TABLE `reports`
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
-- AUTO_INCREMENT de la tabla `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
