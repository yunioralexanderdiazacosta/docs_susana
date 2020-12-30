-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-09-2020 a las 19:04:23
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
-- Base de datos: `datatable`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `office` text NOT NULL,
  `age` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `office`, `age`, `startdate`, `position`) VALUES
(1, 'Yunior', 'San Francisco', 25, '2020-09-14', 'developer'),
(2, 'Juan Perez', 'Miami', 25, '2020-09-14', 'developer'),
(3, 'Juan Perez', 'Florida', 40, '2020-09-13', 'developer'),
(4, 'Alexander Diaz', 'New York', 23, '2020-09-15', 'developer'),
(5, 'Pedro Jimenez', 'Developer', 24, '2020-09-15', 'developer'),
(6, 'Pablo Perez', 'Florida', 24, '2020-09-15', 'developer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL,
  `project` text NOT NULL,
  `language` text NOT NULL,
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employee_details`
--

INSERT INTO `employee_details` (`id`, `project`, `language`, `id_employee`) VALUES
(1, 'Datatables', 'javascript', 1),
(2, 'Simple Calculator', 'PHP', 1),
(3, 'Profile Website', 'PHP', 2),
(4, 'Landing Page', 'HMTL5', 3),
(5, 'Responsive Design', 'HTML5', 4),
(6, 'Fix Template Angular Material', 'Javascript', 5),
(7, 'PWA React', 'Javascript', 1),
(8, 'Feature Vue.js', 'Javascript', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
