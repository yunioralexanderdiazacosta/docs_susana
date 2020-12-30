-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-09-2020 a las 16:48:01
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
(6, '4103510058649260', '09/25', '859', 2, ''),
(7, '4103510058649610', '09/25', '444', 2, ''),
(8, '4894861600872730', '09/25', '523', 3, ''),
(9, '4894861600872980', '09/25', '487', 2, ''),
(10, '4894861600872900', '09/25', '096', 5, NULL),
(11, '4894861600872902', '09/25', '224', 3, NULL),
(12, '4894861600872807', '09/25', '963', 3, NULL),
(13, '4894861600872809', '09/25', '000', 2, NULL),
(14, '4894861600872801', '09/25', '136', 4, NULL),
(15, '4894861600872803', '09/25', '904', 4, NULL),
(16, '4894861600872703', '09/25', '759', 2, NULL),
(17, '4894861600872609', '09/25', '484', 3, NULL),
(18, '4894861600872603', '09/25', '235', 2, NULL),
(19, '4894861600872605', '09/25', '218', 5, NULL),
(20, '4894861600872608', '09/25', '743', 4, NULL),
(21, '4894861600872600', '09/25', '890', 5, NULL),
(22, '4894861600872602', '09/25', '586', 5, NULL),
(23, '4894861600872500', '09/25', '310', 5, NULL),
(24, '4894861600872504', '09/25', '962', 4, NULL),
(25, '4894861600872506', '09/25', '439', 4, NULL),
(26, '4894861600872509', '09/25', '626', 4, NULL),
(27, '4894861600872501', '09/25', '300', 1, NULL),
(28, '4894861600872503', '09/25', '866', 1, NULL),
(29, '4894861600872507', '09/25', '449', 1, NULL),
(30, '4894861600872401', '09/25', '765', 8, ''),
(31, '4103510052651709', '09/25', '446', 2, '9166060'),
(32, '4103510058652901', '09/25', '347', 2, '97014'),
(33, '4103510058653401', '09/25', '240', 2, '606740'),
(34, '4103510058653302', '09/25', '014', 4, '606000'),
(35, '4103510053311409', '09/25', '965', 4, '606004'),
(36, '4103510058653400', '09/25', '592', 4, '606766'),
(37, '4103510058653406', '09/25', '226', 4, '06008'),
(43, '8903456782345671', '04/2020', '222', 1, '0500');

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
(19, 2, '127.0.0.1', '2020-09-23 02:25:05'),
(20, 1, '127.0.0.1', '2020-09-23 13:52:53'),
(21, 1, '127.0.0.1', '2020-09-23 14:02:00');

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
(1, 7, 2, 'tarjeta no valida', 1, '2020-09-23 22:09:14');

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
  `sesion` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Activa 0: Inactiva',
  `ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nick`, `codigo`, `password`, `role_id`, `status`, `sesion`, `ip`) VALUES
(1, 'admin', NULL, '5c78b22a9265faebb8882f102250941c', 1, 1, 0, ''),
(2, 'sa', '0001', '5c78b22a9265faebb8882f102250941c', 2, 1, 0, ''),
(3, 'vi', '0002', '5c78b22a9265faebb8882f102250941c', 2, 1, 0, ''),
(4, 'br', '0003', '5c78b22a9265faebb8882f102250941c', 2, 1, 0, ''),
(5, 'al', '0004', '5c78b22a9265faebb8882f102250941c', 2, 1, 0, ''),
(6, 'da', '0005', '5c78b22a9265faebb8882f102250941c', 2, 1, 0, ''),
(7, 'jo', '0006', '5c78b22a9265faebb8882f102250941c', 2, 1, 0, ''),
(8, 'he', NULL, '55c4b3a08f7447b62efe9ce1cf3dbeb1', 1, 1, 0, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
