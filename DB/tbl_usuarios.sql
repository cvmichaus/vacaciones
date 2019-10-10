-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2019 a las 08:04:09
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
-- Base de datos: `propulci_vacaciones`
--

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
(16, 'c.michaus', 'aq+jmaCa', 'michusvalentin@hotmail.com', 1, 2, '2019-10-09', '23:41:57'),
(17, 'wroiba', 'sOnh0s/GqaI=', 'michusvalentin@gmail.com', 1, 2, '2019-10-10', '00:04:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`CodUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `CodUsuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
