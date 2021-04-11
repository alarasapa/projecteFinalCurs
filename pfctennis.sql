-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2021 a las 12:11:52
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pfctennis`
--
CREATE DATABASE IF NOT EXISTS `pfctennis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pfctennis`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumneescola`
--

CREATE TABLE `alumneescola` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `estat` enum('A','I') NOT NULL,
  `curs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casalvista`
--

CREATE TABLE `casalvista` (
  `id` int(11) NOT NULL,
  `cartellPreu` varchar(80) NOT NULL,
  `cartellHorari` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escolavista`
--

CREATE TABLE `escolavista` (
  `id` int(11) NOT NULL,
  `cartellPreu` varchar(80) NOT NULL,
  `cartellHorari` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicivista`
--

CREATE TABLE `inicivista` (
  `id` int(11) NOT NULL,
  `titol` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `imatge` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscritcasal`
--

CREATE TABLE `inscritcasal` (
  `id` int(11) NOT NULL,
  `idPareTutor` int(11) NOT NULL,
  `nomInscrit` varchar(45) NOT NULL,
  `cognomsInscrit` varchar(70) NOT NULL,
  `dataNaixement` date NOT NULL,
  `midesCamiseta` enum('XS','S','M','X','XL') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservavista`
--

CREATE TABLE `reservavista` (
  `id` int(11) NOT NULL,
  `cartellPreu` varchar(80) NOT NULL,
  `cartellHorari` varchar(80) NOT NULL,
  `link` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `cartellPreu` varchar(80) NOT NULL,
  `cartellMenu` varchar(80) NOT NULL,
  `cartellEvent` varchar(80) DEFAULT NULL,
  `eventDescripcio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soci`
--

CREATE TABLE `soci` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `dataInscripcio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tendaproducte`
--

CREATE TABLE `tendaproducte` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descripcio` text DEFAULT NULL,
  `link` varchar(90) NOT NULL,
  `imatge` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneig`
--

CREATE TABLE `torneig` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `localitzacio` varchar(45) NOT NULL,
  `link` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccio`
--

CREATE TABLE `transaccio` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `estat` enum('A','D','P') NOT NULL,
  `nomTransaccio` varchar(70) NOT NULL,
  `descripcio` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `cognoms` varchar(70) NOT NULL,
  `contrasenya` varchar(45) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `rol` enum('U','S','A','') NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefon` char(12) NOT NULL,
  `dataNaixement` date NOT NULL,
  `dataCreacio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumneescola`
--
ALTER TABLE `alumneescola`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_alumne` (`idUsuari`);

--
-- Indices de la tabla `casalvista`
--
ALTER TABLE `casalvista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escolavista`
--
ALTER TABLE `escolavista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inicivista`
--
ALTER TABLE `inicivista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscritcasal`
--
ALTER TABLE `inscritcasal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_casal` (`idPareTutor`);

--
-- Indices de la tabla `reservavista`
--
ALTER TABLE `reservavista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soci`
--
ALTER TABLE `soci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_soci` (`idUsuari`);

--
-- Indices de la tabla `tendaproducte`
--
ALTER TABLE `tendaproducte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `torneig`
--
ALTER TABLE `torneig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transaccio`
--
ALTER TABLE `transaccio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_transaccio` (`idUsuari`);

--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_nickname` (`nickname`),
  ADD UNIQUE KEY `UK_email_usuari` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumneescola`
--
ALTER TABLE `alumneescola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `casalvista`
--
ALTER TABLE `casalvista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `escolavista`
--
ALTER TABLE `escolavista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inicivista`
--
ALTER TABLE `inicivista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscritcasal`
--
ALTER TABLE `inscritcasal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservavista`
--
ALTER TABLE `reservavista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `soci`
--
ALTER TABLE `soci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tendaproducte`
--
ALTER TABLE `tendaproducte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `torneig`
--
ALTER TABLE `torneig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transaccio`
--
ALTER TABLE `transaccio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumneescola`
--
ALTER TABLE `alumneescola`
  ADD CONSTRAINT `FK_usuari_alumne` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscritcasal`
--
ALTER TABLE `inscritcasal`
  ADD CONSTRAINT `FK_usuari_casal` FOREIGN KEY (`idPareTutor`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `soci`
--
ALTER TABLE `soci`
  ADD CONSTRAINT `FK_usuari_soci` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `transaccio`
--
ALTER TABLE `transaccio`
  ADD CONSTRAINT `FK_usuari_transaccio` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
