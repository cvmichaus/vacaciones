-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2019 a las 23:22:37
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `urbanis6__vacaciones`
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
(1, 1, 'Admin', 'WRI', 'Vaaciones', 'Sistema', '1', '1', '1', '2017-02-01', 2, 7, 4, 8),
(5, 5, 'JAIRO FERNANDO', 'PAEZ', 'MENDIETA', 'DIRECTOR DE OPERACIONES', 'OPERACIONES', '', '', '2013-03-07', 6, 6, 2, 14),
(25, 25, 'GERENTE1', 'SUC', 'QRO', 'GERENTE', 'TI', '5', '', '2018-10-01', 1, 0, 30, 6),
(32, 32, 'EMPLEADO1', 'APPATERNO1', 'APMATERNO1', 'AUX', 'TI', '25', '5', '2013-04-01', 6, 7, 9, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_periodoanterior`
--

CREATE TABLE `tbl_periodoanterior` (
  `CodPeridoAnt` int(12) NOT NULL,
  `CodUsuario` int(12) NOT NULL,
  `PeriodoAnt` varchar(250) NOT NULL,
  `DiasVacAnt` int(12) NOT NULL,
  `SeUso` int(2) DEFAULT '0',
  `FechaTermino` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_periodoanterior`
--

INSERT INTO `tbl_periodoanterior` (`CodPeridoAnt`, `CodUsuario`, `PeriodoAnt`, `DiasVacAnt`, `SeUso`, `FechaTermino`) VALUES
(2, 32, 'DEL 1 DE ABRIL DEL 2018 AL 04 DE ABRILDEL 2019 ', 0, 1, '2020-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rasolicitud`
--

CREATE TABLE `tbl_rasolicitud` (
  `CodRAS` int(12) NOT NULL,
  `CodSol` int(12) NOT NULL,
  `Tipo` int(1) NOT NULL,
  `Motivo` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `CodUsuario` int(12) DEFAULT NULL,
  `FechaAR` date DEFAULT NULL,
  `HoraAR` time DEFAULT NULL,
  `EstatusSolicitud` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_rasolicitud`
--

INSERT INTO `tbl_rasolicitud` (`CodRAS`, `CodSol`, `Tipo`, `Motivo`, `CodUsuario`, `FechaAR`, `HoraAR`, `EstatusSolicitud`) VALUES
(8, 5, 1, 'Rechazada', 32, '2019-11-10', '15:39:46', 0),
(9, 6, 2, 'Aprobado', 32, '2019-11-10', '15:41:06', 1);

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
  `DiasRestantes` int(12) NOT NULL,
  `DiasPeriodoAnt` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_solicitud`
--

INSERT INTO `tbl_solicitud` (`CodSol`, `CodUsuario`, `FechaInicio`, `FechaFin`, `Estatus`, `FechaAltaS`, `HoraAltaS`, `Periodo`, `DiasSolicitados`, `TotaldiasVac`, `DiasRestantes`, `DiasPeriodoAnt`) VALUES
(5, 32, '2019-11-11', '2019-11-15', 0, '2019-11-10', '15:17:48', '', 5, 14, 3, 16),
(6, 32, '2019-11-25', '2019-11-28', 1, '2019-11-10', '15:20:09', '', 4, 14, 2, 16),
(7, 25, '2019-11-11', '2019-11-10', 2, '2019-11-10', '15:27:54', '', 0, 6, 6, 0);

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
(25, 'gerente1', 'aqmlnaKb', 'michusvalentin@gmail.com', 1, 3, '2019-10-31', '00:46:13'),
(32, 'Alejandro.lopez@wri.org', 'qdjl3OTU6s0=', 'Alejandro.lopez@wri.org', 1, 2, '2019-11-10', '14:40:37');

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
  `DiasVac` int(12) NOT NULL,
  `Fecha_iniciov` date NOT NULL,
  `Fecha_finv` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_vacaciones_usuarioxanio`
--

INSERT INTO `tbl_vacaciones_usuarioxanio` (`CodVac`, `CodEmpleado`, `Anio`, `DiasVac`, `Fecha_iniciov`, `Fecha_finv`) VALUES
(1, 5, 2019, 14, '0000-00-00', '0000-00-00'),
(21, 25, 2019, 6, '0000-00-00', '0000-00-00'),
(28, 32, 2019, -10, '2019-11-10', '2020-05-10');

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
-- Indices de la tabla `tbl_periodoanterior`
--
ALTER TABLE `tbl_periodoanterior`
  ADD PRIMARY KEY (`CodPeridoAnt`);

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
  MODIFY `CodE` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tbl_periodoanterior`
--
ALTER TABLE `tbl_periodoanterior`
  MODIFY `CodPeridoAnt` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_rasolicitud`
--
ALTER TABLE `tbl_rasolicitud`
  MODIFY `CodRAS` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  MODIFY `CodSol` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `CodUsuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tbl_vacaciones`
--
ALTER TABLE `tbl_vacaciones`
  MODIFY `codVacaciones` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_vacaciones_usuarioxanio`
--
ALTER TABLE `tbl_vacaciones_usuarioxanio`
  MODIFY `CodVac` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
