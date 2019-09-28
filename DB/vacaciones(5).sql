-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2019 a las 13:58:32
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cat_vacaciones`
--

CREATE TABLE `tbl_cat_vacaciones` (
  `CodVacaciones` int(12) NOT NULL,
  `Anios` int(12) NOT NULL,
  `Dias` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_cat_vacaciones`
--

INSERT INTO `tbl_cat_vacaciones` (`CodVacaciones`, `Anios`, `Dias`) VALUES
(1, 1, 6),
(2, 2, 8),
(3, 3, 10),
(4, 4, 12),
(5, 5, 14),
(6, 10, 16),
(7, 15, 18),
(8, 20, 20),
(9, 25, 22),
(10, 6, 14),
(11, 7, 14),
(12, 8, 14),
(13, 9, 14),
(14, 11, 16),
(15, 12, 16),
(16, 13, 16),
(17, 14, 16),
(18, 16, 18),
(19, 17, 18),
(20, 18, 18),
(21, 19, 18),
(22, 21, 20),
(23, 22, 20),
(24, 23, 20),
(25, 24, 20),
(26, 26, 22),
(27, 27, 22),
(28, 28, 22),
(29, 29, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleados`
--

CREATE TABLE `tbl_empleados` (
  `CodE` int(12) NOT NULL,
  `CodUsu` int(12) NOT NULL,
  `Nombres` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ApellidoPaterno` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `ApellidoMaterno` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Posicion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Area` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `Reporta` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Jefe2` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `aniosA` int(12) NOT NULL,
  `mesesA` int(12) NOT NULL,
  `diasA` int(12) NOT NULL,
  `DiasVac` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_empleados`
--

INSERT INTO `tbl_empleados` (`CodE`, `CodUsu`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `Posicion`, `Area`, `Reporta`, `Jefe2`, `fecha_ingreso`, `aniosA`, `mesesA`, `diasA`, `DiasVac`) VALUES
(1, 1, 'Carlos', 'Michaus', 'Barcenas', 'TI', '1', '1', '1', '2017-02-01', 2, 7, 4, 8),
(5, 5, 'Jairo Fernando', 'Paez', 'Mendieta', 'Director de Operaciones', 'Operaciones', '', '', '2013-03-07', 6, 6, 2, 14),
(6, 6, 'Aline Mayela', 'Nolasco', 'Escalona', 'Administradora de Proyectos', 'Operaciones', '5', '', '2018-04-01', 1, 5, 9, 6),
(7, 7, 'Adriana', 'VÃ©jar', 'GalvÃ¡n', 'Directora de AdministraciÃ³n y Finanzas', 'AdministraciÃ³n y Finanzas', '5', 'Adriana Lobo', '2019-01-15', 0, 7, 27, 0),
(8, 8, 'Vladimir', 'Sosa', 'Rivas', 'Gerente de Electromovilidad para LatinoamÃ©rica', 'Movilidad Urbana', '5', 'Global', '2019-07-01', 0, 2, 10, 0),
(9, 9, 'Yolanda', 'Romero', 'Ãvila', 'Asistente de DirecciÃ³n Operativa', 'Operaciones', '5', '', '2015-03-01', 4, 6, 10, 12),
(10, 10, 'CÃ©sar Abraham', 'AvilÃ©s', 'CortÃ©s', 'Coordinador de InnovaciÃ³n', 'Operaciones', '5', '', '2018-09-07', 1, 0, 4, 6),
(11, 11, 'Arianna', 'Ghibellini', 'Steixner', 'Gerente de Recursos Humanos', 'Operaciones', '5', 'Adriana Lobo', '2019-01-21', 0, 7, 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rasolicitud`
--

CREATE TABLE `tbl_rasolicitud` (
  `CodRAS` int(12) NOT NULL,
  `CodSol` int(12) NOT NULL,
  `Tipo` int(1) NOT NULL,
  `Motivo` varchar(800) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud`
--

CREATE TABLE `tbl_solicitud` (
  `CodSol` int(12) NOT NULL,
  `CodUsuario` int(12) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `Estatus` int(12) NOT NULL,
  `FechaAltaS` date NOT NULL,
  `HoraAltaS` time NOT NULL,
  `Periodo` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `DiasSolicitados` int(12) NOT NULL,
  `TotaldiasVac` int(12) NOT NULL,
  `DiasRestantes` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_solicitud`
--

INSERT INTO `tbl_solicitud` (`CodSol`, `CodUsuario`, `FechaInicio`, `FechaFin`, `Estatus`, `FechaAltaS`, `HoraAltaS`, `Periodo`, `DiasSolicitados`, `TotaldiasVac`, `DiasRestantes`) VALUES
(1, 9, '2019-09-11', '2019-09-13', 2, '2019-09-11', '01:44:31', '11 al 13 de septiembre del 2019', 2, 0, -2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `CodUsuario` int(12) NOT NULL,
  `Usuario` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Clave` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Correo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Estatus` int(1) NOT NULL,
  `Perfil` int(12) NOT NULL,
  `Fecha_Alta` date NOT NULL,
  `Hora_Alta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`CodUsuario`, `Usuario`, `Clave`, `Correo`, `Estatus`, `Perfil`, `Fecha_Alta`, `Hora_Alta`) VALUES
(1, 'Admin', 'mtvf0ts=', 'c.michaus@gamil.com', 1, 1, '2019-09-05', '00:07:00'),
(5, 'fernando.paez@wri.org', 'qdjl3OTU6s0=', 'michusvalentin@gmail.com', 1, 3, '2019-09-09', '22:35:34'),
(6, 'aline.nolasco@wri.org', 'qdjl3OTU6s0=', 'michusvalentin@gmail.com', 1, 2, '2019-09-10', '01:07:41'),
(7, 'adriana.vejar@wri.org', 'qdjl3OTU6s0=', 'adriana.vejar@wri.org', 1, 3, '2019-09-11', '00:04:10'),
(8, 'vladimir.sosa@wri.org', 'qdjl3OTU6s0=', 'vladimir.sosa@wri.org', 1, 2, '2019-09-11', '00:08:07'),
(9, 'yolanda.romero@wri.org', 'qdjl3OTU6s0=', 'yolanda.romero@wri.org', 1, 2, '2019-09-11', '00:11:21'),
(10, 'cesar.aviles@wri.org', 'qdjl3OTU6s0=', 'cesar.aviles@wri.org', 1, 2, '2019-09-11', '00:13:50'),
(11, 'arianna.ghibellini@wri.org', 'qdjl3OTU6s0=', 'arianna.ghibellini@wri.org', 1, 3, '2019-09-11', '00:31:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_vacaciones`
--

CREATE TABLE `tbl_vacaciones` (
  `codVacaciones` int(12) NOT NULL,
  `CodSol` int(12) NOT NULL,
  `CodUsuario` int(12) NOT NULL,
  `DiasVacaciones` int(12) NOT NULL,
  `EstatusVac` int(1) NOT NULL,
  `FechaAlta` date NOT NULL,
  `HoraAlta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_vacaciones_usuarioxanio`
--

CREATE TABLE `tbl_vacaciones_usuarioxanio` (
  `CodVac` int(12) NOT NULL,
  `CodEmpleado` int(12) NOT NULL,
  `Anio` int(12) NOT NULL,
  `DiasVac` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_vacaciones_usuarioxanio`
--

INSERT INTO `tbl_vacaciones_usuarioxanio` (`CodVac`, `CodEmpleado`, `Anio`, `DiasVac`) VALUES
(1, 5, 2019, 14),
(2, 6, 2019, 6),
(3, 7, 2019, 0),
(4, 8, 2019, 0),
(5, 9, 2019, 12),
(6, 10, 2019, 6),
(7, 11, 2019, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cat_vacaciones`
--
ALTER TABLE `tbl_cat_vacaciones`
  ADD PRIMARY KEY (`CodVacaciones`);

--
-- Indices de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  ADD PRIMARY KEY (`CodE`);

--
-- Indices de la tabla `tbl_rasolicitud`
--
ALTER TABLE `tbl_rasolicitud`
  ADD PRIMARY KEY (`CodRAS`);

--
-- Indices de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD PRIMARY KEY (`CodSol`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`CodUsuario`);

--
-- Indices de la tabla `tbl_vacaciones`
--
ALTER TABLE `tbl_vacaciones`
  ADD PRIMARY KEY (`codVacaciones`);

--
-- Indices de la tabla `tbl_vacaciones_usuarioxanio`
--
ALTER TABLE `tbl_vacaciones_usuarioxanio`
  ADD PRIMARY KEY (`CodVac`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cat_vacaciones`
--
ALTER TABLE `tbl_cat_vacaciones`
  MODIFY `CodVacaciones` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tbl_empleados`
--
ALTER TABLE `tbl_empleados`
  MODIFY `CodE` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_rasolicitud`
--
ALTER TABLE `tbl_rasolicitud`
  MODIFY `CodRAS` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  MODIFY `CodSol` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `CodUsuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_vacaciones`
--
ALTER TABLE `tbl_vacaciones`
  MODIFY `codVacaciones` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_vacaciones_usuarioxanio`
--
ALTER TABLE `tbl_vacaciones_usuarioxanio`
  MODIFY `CodVac` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
