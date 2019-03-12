-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-03-2019 a las 16:27:07
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_asesor`
--

CREATE TABLE `cita_asesor` (
  `cedula` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita_asesor`
--

INSERT INTO `cita_asesor` (`cedula`, `nombre`, `apellido`, `clave`, `usuario`, `tipo`) VALUES
('1086123456', 'David Alejandro', 'Paz Toro', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'david', 'coordinador'),
('1086123457', 'Hugo Armando', 'Tarapues Bolaños', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'hugo', 'admin'),
('1086123458', 'Juan Ovidio', 'Jojoa Guerrero', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ovidio', 'asesor'),
('12345', 'Administrador', 'Sistema', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_cita`
--

CREATE TABLE `cita_cita` (
  `identificacion_estudiante` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `franja` int(11) NOT NULL DEFAULT '0',
  `observacion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `inicio_cita` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fin_cita` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita_cita`
--

INSERT INTO `cita_cita` (`identificacion_estudiante`, `franja`, `observacion`, `inicio_cita`, `fin_cita`) VALUES
('1004123456', 55, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_estudiante`
--

CREATE TABLE `cita_estudiante` (
  `identificacion` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita_estudiante`
--

INSERT INTO `cita_estudiante` (`identificacion`, `nombre`, `apellido`) VALUES
('1004123456', 'YOHANA EMILIA', 'MAIGUAL MARTINEZ'),
('1004123457', 'JOHN DAVID', 'MAIGUAL JOJOA'),
('1004123458', 'YESSICA PAOLA', 'ERAZO JOJOA'),
('1004123459', 'YADIRA MARIELA', 'VALENCIA OBANDO'),
('1004123460', 'DENYS SEBASTIAN', 'ZAMBRANO RIASCOS'),
('1085123461', 'PAOLA ANDREA', 'GALVEZ MIDEROS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_franja`
--

CREATE TABLE `cita_franja` (
  `id` int(11) NOT NULL,
  `hora_inicio` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora_fin` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita_franja`
--

INSERT INTO `cita_franja` (`id`, `hora_inicio`, `hora_fin`, `fecha`, `grupo`) VALUES
(9, '08:00', '08:15', '2016-02-01', 1),
(10, '08:15', '08:30', '2016-02-01', 1),
(11, '08:30', '08:45', '2016-02-01', 1),
(12, '08:45', '09:00', '2016-02-01', 1),
(13, '09:00', '09:15', '2016-02-01', 1),
(14, '09:15', '09:30', '2016-02-01', 1),
(15, '09:30', '09:45', '2016-02-01', 1),
(16, '09:45', '10:00', '2016-02-01', 1),
(17, '10:00', '10:15', '2016-02-01', 1),
(18, '10:15', '10:30', '2016-02-01', 1),
(19, '10:30', '10:45', '2016-02-01', 1),
(20, '10:45', '11:00', '2016-02-01', 1),
(21, '11:00', '11:15', '2016-02-01', 1),
(22, '11:15', '11:30', '2016-02-01', 1),
(23, '11:30', '11:45', '2016-02-01', 1),
(24, '11:45', '12:00', '2016-02-01', 1),
(25, '14:30', '14:45', '2016-02-03', 2),
(26, '14:45', '15:00', '2016-02-03', 2),
(27, '15:00', '15:15', '2016-02-03', 2),
(28, '15:15', '15:30', '2016-02-03', 2),
(29, '15:30', '15:45', '2016-02-03', 2),
(30, '15:45', '16:00', '2016-02-03', 2),
(31, '16:00', '16:15', '2016-02-03', 2),
(32, '16:15', '16:30', '2016-02-03', 2),
(33, '16:30', '16:45', '2016-02-03', 2),
(34, '16:45', '17:00', '2016-02-03', 2),
(35, '17:00', '17:15', '2016-02-03', 2),
(36, '17:15', '17:30', '2016-02-03', 2),
(37, '17:30', '17:45', '2016-02-03', 2),
(38, '17:45', '18:00', '2016-02-03', 2),
(39, '18:00', '18:15', '2016-02-03', 2),
(40, '18:15', '18:30', '2016-02-03', 2),
(41, '18:30', '18:45', '2016-02-03', 3),
(42, '18:45', '19:00', '2016-02-03', 3),
(43, '19:00', '19:15', '2016-02-03', 3),
(44, '19:15', '19:30', '2016-02-03', 3),
(45, '19:30', '19:45', '2016-02-03', 3),
(46, '19:45', '20:00', '2016-02-03', 3),
(47, '20:00', '20:15', '2016-02-03', 3),
(48, '20:15', '20:30', '2016-02-03', 3),
(49, '14:30', '14:45', '2016-02-05', 2),
(50, '14:45', '15:00', '2016-02-05', 2),
(51, '15:00', '15:15', '2016-02-05', 2),
(52, '15:15', '15:30', '2016-02-05', 2),
(53, '15:30', '15:45', '2016-02-05', 2),
(54, '15:45', '16:00', '2016-02-05', 2),
(55, '16:00', '16:15', '2016-02-05', 2),
(56, '16:15', '16:30', '2016-02-05', 2),
(57, '16:30', '16:45', '2016-02-05', 2),
(58, '16:45', '17:00', '2016-02-05', 2),
(59, '17:00', '17:15', '2016-02-05', 2),
(60, '17:15', '17:30', '2016-02-05', 2),
(61, '17:30', '17:45', '2016-02-05', 2),
(62, '17:45', '18:00', '2016-02-05', 2),
(63, '18:00', '18:15', '2016-02-05', 2),
(64, '18:15', '18:30', '2016-02-05', 2),
(65, '08:00', '08:15', '2016-02-06', 4),
(66, '08:15', '08:30', '2016-02-06', 4),
(67, '08:30', '08:45', '2016-02-06', 4),
(68, '08:45', '09:00', '2016-02-06', 4),
(69, '09:00', '09:15', '2016-02-06', 4),
(70, '09:15', '09:30', '2016-02-06', 4),
(71, '09:30', '09:45', '2016-02-06', 4),
(72, '09:45', '10:00', '2016-02-06', 4),
(73, '10:00', '10:15', '2016-02-06', 4),
(74, '10:15', '10:30', '2016-02-06', 4),
(75, '10:30', '10:45', '2016-02-06', 4),
(76, '10:45', '11:00', '2016-02-06', 4),
(77, '11:00', '11:15', '2016-02-06', 4),
(78, '11:15', '11:30', '2016-02-06', 4),
(79, '11:30', '11:45', '2016-02-06', 4),
(80, '11:45', '12:00', '2016-02-06', 4),
(81, '14:00', '14:15', '2016-02-06', 5),
(82, '14:15', '14:30', '2016-02-06', 5),
(83, '14:30', '14:45', '2016-02-06', 5),
(84, '14:45', '15:00', '2016-02-06', 5),
(85, '15:00', '15:15', '2016-02-06', 5),
(86, '15:15', '15:30', '2016-02-06', 5),
(87, '15:30', '15:45', '2016-02-06', 5),
(88, '15:45', '16:00', '2016-02-06', 5),
(89, '16:00', '16:15', '2016-02-06', 5),
(90, '16:15', '16:30', '2016-02-06', 5),
(91, '16:30', '16:45', '2016-02-06', 5),
(92, '16:45', '17:00', '2016-02-06', 5),
(93, '17:00', '17:15', '2016-02-06', 5),
(94, '17:15', '17:30', '2016-02-06', 5),
(95, '17:30', '17:45', '2016-02-06', 5),
(96, '17:45', '18:00', '2016-02-06', 5),
(97, '08:00', '08:15', '2016-02-07', 6),
(98, '08:15', '08:30', '2016-02-07', 6),
(99, '08:30', '08:45', '2016-02-07', 6),
(100, '08:45', '09:00', '2016-02-07', 6),
(101, '09:00', '09:15', '2016-02-07', 6),
(102, '09:15', '09:30', '2016-02-07', 6),
(103, '09:30', '09:45', '2016-02-07', 6),
(104, '09:45', '10:00', '2016-02-07', 6),
(105, '10:00', '10:15', '2016-02-07', 6),
(106, '10:15', '10:30', '2016-02-07', 6),
(107, '10:30', '10:45', '2016-02-07', 6),
(108, '10:45', '11:00', '2016-02-07', 6),
(109, '11:00', '11:15', '2016-02-07', 6),
(110, '11:15', '11:30', '2016-02-07', 6),
(111, '11:30', '11:45', '2016-02-07', 6),
(112, '11:45', '12:00', '2016-02-07', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_franja_asesor`
--

CREATE TABLE `cita_franja_asesor` (
  `id` int(11) NOT NULL,
  `id_franja` int(11) NOT NULL,
  `id_asesor` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita_franja_asesor`
--

INSERT INTO `cita_franja_asesor` (`id`, `id_franja`, `id_asesor`, `estado`) VALUES
(8, 9, '1086123456', 'Disponible'),
(9, 10, '1086123456', 'Ocupado'),
(10, 11, '1086123456', 'Disponible'),
(11, 12, '1086123456', 'Disponible'),
(12, 13, '1086123456', 'Disponible'),
(13, 14, '1086123456', 'Disponible'),
(14, 15, '1086123456', 'Disponible'),
(15, 16, '1086123456', 'Disponible'),
(16, 17, '1086123456', 'Disponible'),
(17, 18, '1086123456', 'Disponible'),
(18, 19, '1086123456', 'Disponible'),
(19, 20, '1086123456', 'Ocupado'),
(20, 21, '1086123456', 'Disponible'),
(21, 22, '1086123456', 'Disponible'),
(22, 23, '1086123456', 'Disponible'),
(23, 24, '1086123456', 'Disponible'),
(24, 9, '1086123457', 'Disponible'),
(25, 10, '1086123457', 'Disponible'),
(26, 11, '1086123457', 'Disponible'),
(27, 12, '1086123457', 'Disponible'),
(28, 13, '1086123457', 'Disponible'),
(29, 14, '1086123457', 'Disponible'),
(30, 15, '1086123457', 'Disponible'),
(31, 16, '1086123457', 'Disponible'),
(32, 17, '1086123457', 'Disponible'),
(33, 18, '1086123457', 'Disponible'),
(34, 19, '1086123457', 'Disponible'),
(35, 20, '1086123457', 'Disponible'),
(36, 21, '1086123457', 'Disponible'),
(37, 22, '1086123457', 'Disponible'),
(38, 23, '1086123457', 'Disponible'),
(39, 24, '1086123457', 'Disponible'),
(40, 25, '1086123456', 'Disponible'),
(41, 26, '1086123456', 'Disponible'),
(42, 27, '1086123456', 'Disponible'),
(43, 28, '1086123456', 'Disponible'),
(44, 29, '1086123456', 'Disponible'),
(45, 30, '1086123456', 'Disponible'),
(46, 31, '1086123456', 'Disponible'),
(47, 32, '1086123456', 'Disponible'),
(48, 33, '1086123456', 'Disponible'),
(49, 34, '1086123456', 'Disponible'),
(50, 35, '1086123456', 'Disponible'),
(51, 36, '1086123456', 'Disponible'),
(52, 37, '1086123456', 'Disponible'),
(53, 38, '1086123456', 'Disponible'),
(54, 39, '1086123456', 'Disponible'),
(55, 40, '1086123456', 'Ocupado'),
(56, 25, '1086123457', 'Disponible'),
(57, 26, '1086123457', 'Disponible'),
(58, 27, '1086123457', 'Disponible'),
(59, 28, '1086123457', 'Disponible'),
(60, 29, '1086123457', 'Disponible'),
(61, 30, '1086123457', 'Disponible'),
(62, 31, '1086123457', 'Disponible'),
(63, 32, '1086123457', 'Disponible'),
(64, 33, '1086123457', 'Disponible'),
(65, 34, '1086123457', 'Disponible'),
(66, 35, '1086123457', 'Disponible'),
(67, 36, '1086123457', 'Disponible'),
(68, 37, '1086123457', 'Disponible'),
(69, 38, '1086123457', 'Disponible'),
(70, 39, '1086123457', 'Disponible'),
(71, 40, '1086123457', 'Disponible'),
(72, 25, '1086123458', 'Disponible'),
(73, 26, '1086123458', 'Disponible'),
(74, 27, '1086123458', 'Disponible'),
(75, 28, '1086123458', 'Disponible'),
(76, 29, '1086123458', 'Disponible'),
(77, 30, '1086123458', 'Disponible'),
(78, 31, '1086123458', 'Disponible'),
(79, 32, '1086123458', 'Disponible'),
(80, 33, '1086123458', 'Disponible'),
(81, 34, '1086123458', 'Disponible'),
(82, 35, '1086123458', 'Disponible'),
(83, 36, '1086123458', 'Disponible'),
(84, 37, '1086123458', 'Disponible'),
(85, 38, '1086123458', 'Disponible'),
(86, 39, '1086123458', 'Disponible'),
(87, 40, '1086123458', 'Disponible'),
(88, 41, '1086123456', 'Disponible'),
(89, 42, '1086123456', 'Disponible'),
(90, 43, '1086123456', 'Disponible'),
(91, 44, '1086123456', 'Disponible'),
(92, 45, '1086123456', 'Disponible'),
(93, 46, '1086123456', 'Disponible'),
(94, 47, '1086123456', 'Disponible'),
(95, 48, '1086123456', 'Disponible'),
(96, 41, '1086123457', 'Disponible'),
(97, 42, '1086123457', 'Disponible'),
(98, 43, '1086123457', 'Disponible'),
(99, 44, '1086123457', 'Disponible'),
(100, 45, '1086123457', 'Disponible'),
(101, 46, '1086123457', 'Disponible'),
(102, 47, '1086123457', 'Disponible'),
(103, 48, '1086123457', 'Disponible'),
(104, 49, '1086123457', 'Disponible'),
(105, 50, '1086123457', 'Disponible'),
(106, 51, '1086123457', 'Disponible'),
(107, 52, '1086123457', 'Disponible'),
(108, 53, '1086123457', 'Disponible'),
(109, 54, '1086123457', 'Disponible'),
(110, 55, '1086123457', 'Disponible'),
(111, 56, '1086123457', 'Disponible'),
(112, 57, '1086123457', 'Disponible'),
(113, 58, '1086123457', 'Disponible'),
(114, 59, '1086123457', 'Disponible'),
(115, 60, '1086123457', 'Disponible'),
(116, 61, '1086123457', 'Disponible'),
(117, 62, '1086123457', 'Disponible'),
(118, 63, '1086123457', 'Disponible'),
(119, 64, '1086123457', 'Disponible'),
(120, 49, '1086123456', 'Disponible'),
(121, 50, '1086123456', 'Disponible'),
(122, 51, '1086123456', 'Disponible'),
(123, 52, '1086123456', 'Disponible'),
(124, 53, '1086123456', 'Disponible'),
(125, 54, '1086123456', 'Disponible'),
(126, 55, '1086123456', 'Disponible'),
(127, 56, '1086123456', 'Disponible'),
(128, 57, '1086123456', 'Disponible'),
(129, 58, '1086123456', 'Disponible'),
(130, 59, '1086123456', 'Disponible'),
(131, 60, '1086123456', 'Disponible'),
(132, 61, '1086123456', 'Disponible'),
(133, 62, '1086123456', 'Disponible'),
(134, 63, '1086123456', 'Disponible'),
(135, 64, '1086123456', 'Disponible'),
(136, 65, '1086123457', 'Disponible'),
(137, 66, '1086123457', 'Disponible'),
(138, 67, '1086123457', 'Disponible'),
(139, 68, '1086123457', 'Disponible'),
(140, 69, '1086123457', 'Disponible'),
(141, 70, '1086123457', 'Disponible'),
(142, 71, '1086123457', 'Disponible'),
(143, 72, '1086123457', 'Disponible'),
(144, 73, '1086123457', 'Disponible'),
(145, 74, '1086123457', 'Disponible'),
(146, 75, '1086123457', 'Disponible'),
(147, 76, '1086123457', 'Disponible'),
(148, 77, '1086123457', 'Disponible'),
(149, 78, '1086123457', 'Disponible'),
(150, 79, '1086123457', 'Disponible'),
(151, 80, '1086123457', 'Disponible'),
(152, 81, '1086123458', 'Disponible'),
(153, 82, '1086123458', 'Disponible'),
(154, 83, '1086123458', 'Disponible'),
(155, 84, '1086123458', 'Disponible'),
(156, 85, '1086123458', 'Disponible'),
(157, 86, '1086123458', 'Disponible'),
(158, 87, '1086123458', 'Disponible'),
(159, 88, '1086123458', 'Disponible'),
(160, 89, '1086123458', 'Disponible'),
(161, 90, '1086123458', 'Disponible'),
(162, 91, '1086123458', 'Disponible'),
(163, 92, '1086123458', 'Disponible'),
(164, 93, '1086123458', 'Disponible'),
(165, 94, '1086123458', 'Disponible'),
(166, 95, '1086123458', 'Disponible'),
(167, 96, '1086123458', 'Disponible'),
(200, 97, '1086123458', 'Disponible'),
(201, 98, '1086123458', 'Disponible'),
(202, 99, '1086123458', 'Disponible'),
(203, 100, '1086123458', 'Disponible'),
(204, 101, '1086123458', 'Disponible'),
(205, 102, '1086123458', 'Disponible'),
(206, 103, '1086123458', 'Disponible'),
(207, 104, '1086123458', 'Disponible'),
(208, 105, '1086123458', 'Disponible'),
(209, 106, '1086123458', 'Disponible'),
(210, 107, '1086123458', 'Disponible'),
(211, 108, '1086123458', 'Disponible'),
(212, 109, '1086123458', 'Disponible'),
(213, 110, '1086123458', 'Disponible'),
(214, 111, '1086123458', 'Disponible'),
(215, 112, '1086123458', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_grupo`
--

CREATE TABLE `cita_grupo` (
  `id_grupo` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita_grupo`
--

INSERT INTO `cita_grupo` (`id_grupo`, `nombre`) VALUES
(1, 'Semana Mañana'),
(2, 'Semana Tarde'),
(3, 'Semana Noche'),
(4, 'Sábados Mañana'),
(5, 'Sábados Tarde'),
(6, 'Domingos Mañana');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita_asesor`
--
ALTER TABLE `cita_asesor`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `cita_cita`
--
ALTER TABLE `cita_cita`
  ADD PRIMARY KEY (`identificacion_estudiante`),
  ADD KEY `franja` (`franja`),
  ADD KEY `identificacion_estudiante` (`identificacion_estudiante`);

--
-- Indices de la tabla `cita_estudiante`
--
ALTER TABLE `cita_estudiante`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indices de la tabla `cita_franja`
--
ALTER TABLE `cita_franja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `cita_franja_asesor`
--
ALTER TABLE `cita_franja_asesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_asesor` (`id_asesor`),
  ADD KEY `id_franja` (`id_franja`);

--
-- Indices de la tabla `cita_grupo`
--
ALTER TABLE `cita_grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita_franja`
--
ALTER TABLE `cita_franja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT de la tabla `cita_franja_asesor`
--
ALTER TABLE `cita_franja_asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita_cita`
--
ALTER TABLE `cita_cita`
  ADD CONSTRAINT `cita_cita_ibfk_1` FOREIGN KEY (`identificacion_estudiante`) REFERENCES `cita_estudiante` (`identificacion`);

--
-- Filtros para la tabla `cita_franja`
--
ALTER TABLE `cita_franja`
  ADD CONSTRAINT `cita_franja_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `cita_grupo` (`id_grupo`);

--
-- Filtros para la tabla `cita_franja_asesor`
--
ALTER TABLE `cita_franja_asesor`
  ADD CONSTRAINT `cita_franja_asesor_ibfk_1` FOREIGN KEY (`id_asesor`) REFERENCES `cita_asesor` (`cedula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_franja_asesor_ibfk_2` FOREIGN KEY (`id_franja`) REFERENCES `cita_franja` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
