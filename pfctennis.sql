-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2021 a las 11:05:05
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
-- Estructura de tabla para la tabla `activitat`
--

CREATE TABLE `activitat` (
  `id` int(11) NOT NULL,
  `idTipusActivitat` int(11) DEFAULT NULL,
  `titol` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `formulari` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `activitat`
--

INSERT INTO `activitat` (`id`, `idTipusActivitat`, `titol`, `descripcio`, `formulari`) VALUES
(1, 2, 'Escola pàdel adults', 'Lorem ipsum Lorem ipsumLorem ipsumv Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 1),
(7, 2, 'Escola Infantil', 'MATRICULA: 20€ AL COMENÇAR EL CURS / GERMANS -10%\r\n\r\nLorem ipsum Lorem ipsumLorem ipsumv Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 1),
(9, 3, 'Torneo molon', 'fasdsadas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumne_escola`
--

CREATE TABLE `alumne_escola` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `estat` enum('A','I') NOT NULL,
  `curs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendari`
--

CREATE TABLE `calendari` (
  `id` int(11) NOT NULL,
  `idActivitat` int(11) NOT NULL,
  `idDataActivitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartes_inici_vista`
--

CREATE TABLE `cartes_inici_vista` (
  `id` int(11) NOT NULL,
  `titol` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `imatge` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cartes_inici_vista`
--

INSERT INTO `cartes_inici_vista` (`id`, `titol`, `descripcio`, `imatge`) VALUES
(1, 'Primera Carta', 'Esta es la primera carta de mi pàgina web aaaaaaaaaaaaahhhhhhhhhhhhhhhhhhhhhhh', 'bolaTennisBonita.jpg'),
(5, 'dsada', 'dsabtrbrtbrtbythytjhty', 'Tennis.jpg'),
(6, 'dsda', 'sadsadasdasdas', 'Tennis.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casal_vista`
--

CREATE TABLE `casal_vista` (
  `id` int(11) NOT NULL,
  `cartellPreu` varchar(80) NOT NULL,
  `cartellHorari` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_activitat`
--

CREATE TABLE `data_activitat` (
  `id` int(11) NOT NULL,
  `idHoraActivitat` int(11) NOT NULL,
  `dataInici` date NOT NULL,
  `dataFi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escola_vista`
--

CREATE TABLE `escola_vista` (
  `id` int(11) NOT NULL,
  `cartellPreu` varchar(80) NOT NULL,
  `cartellHorari` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extres`
--

CREATE TABLE `extres` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `preuSoci` float NOT NULL,
  `preuNoSoci` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `extres`
--

INSERT INTO `extres` (`id`, `nom`, `preuSoci`, `preuNoSoci`) VALUES
(1, 'menjador', 45, 45),
(3, 'Pilotes de tennis', 0, 5.5),
(5, 'dasdas', 21, 122);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extres_activitats`
--

CREATE TABLE `extres_activitats` (
  `id` int(11) NOT NULL,
  `idExtra` int(11) NOT NULL,
  `idActivitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `extres_activitats`
--

INSERT INTO `extres_activitats` (`id`, `idExtra`, `idActivitat`) VALUES
(9, 1, 9),
(10, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extres_valors`
--

CREATE TABLE `extres_valors` (
  `id` int(11) NOT NULL,
  `idGrupOpcio` int(11) NOT NULL,
  `idOpcioValor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `extres_valors`
--

INSERT INTO `extres_valors` (`id`, `idGrupOpcio`, `idOpcioValor`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generals_valors`
--

CREATE TABLE `generals_valors` (
  `id` int(11) NOT NULL,
  `idGrupOpcio` int(11) NOT NULL,
  `idOpcioValor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `generals_valors`
--

INSERT INTO `generals_valors` (`id`, `idGrupOpcio`, `idOpcioValor`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 3),
(4, 4, 4),
(5, 4, 5),
(6, 5, 6),
(7, 5, 7),
(8, 6, 8),
(9, 6, 9),
(10, 6, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora_activitat`
--

CREATE TABLE `hora_activitat` (
  `id` int(11) NOT NULL,
  `horaInici` time NOT NULL,
  `horaFi` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inici_vista`
--

CREATE TABLE `inici_vista` (
  `id` int(11) NOT NULL,
  `titol` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `imatge` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inici_vista`
--

INSERT INTO `inici_vista` (`id`, `titol`, `descripcio`, `imatge`) VALUES
(3, 'Inscripcions obertes', 'TORNEO MIXTO AHAHAHAAHAHAHA CLUB DE TENNIS BB AHAHAHAHA TORNEO MIXTO HOMBRES MUJERES DE TODO SABES?', '2016_infoEscola_CTPB-722x1024.jpg'),
(4, 'Torneito para almas solitarias', 'TORNEO DE PADEL INDIVIDUAL SOLO SOLAMEN AHAHAHAHAH ESTAS SOLITO JUGANDO, LITERALMENTE NO HAY NADIE SOLO TU AHAHAHAHAH INDIVUDUAL A TODOS LOS NIVELES.', 'padelIndividual.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscrit_casal`
--

CREATE TABLE `inscrit_casal` (
  `id` int(11) NOT NULL,
  `idPareTutor` int(11) NOT NULL,
  `nomInscrit` varchar(45) NOT NULL,
  `cognomsInscrit` varchar(70) NOT NULL,
  `estat` enum('A','I') NOT NULL,
  `dataNaixement` date NOT NULL,
  `midesCamiseta` enum('XS','S','M','X','XL') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscrit_torneigos`
--

CREATE TABLE `inscrit_torneigos` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `idTorneig` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localitzacio`
--

CREATE TABLE `localitzacio` (
  `id` int(11) NOT NULL,
  `adreca` varchar(45) NOT NULL,
  `poblacio` varchar(45) NOT NULL,
  `codiPostal` char(6) NOT NULL,
  `provincia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `localitzacio`
--

INSERT INTO `localitzacio` (`id`, `adreca`, `poblacio`, `codiPostal`, `provincia`) VALUES
(1, 'Calle Inventada', 'Pineda', '08370', 'Barcelona'),
(2, 'c CAlle', 'dwqwq', '12121', 'asasasa'),
(3, 'c CAlle', 'dwqwq', '12121', 'asasasa'),
(4, 'calle inventada', 'blanes', '1927', 'apslapslapsla'),
(5, 'calle inventada', 'blanes', '1927', 'apslapslapsla'),
(6, 'dosapnmdsiaok', 'nmoinmio', '1837', 'isonxionod'),
(7, 'dosapnmdsiaok', 'nmoinmio', '1837', 'isonxionod'),
(8, 'njn', 'inini', '99898', 'nuinini'),
(9, 'Calle Creada', 'Santa Susana', '19281', 'Barcelona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_admin`
--

CREATE TABLE `log_admin` (
  `id` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `descripcio` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `log_admin`
--

INSERT INTO `log_admin` (`id`, `idAdmin`, `descripcio`, `data`) VALUES
(6, 24, 'Ha cambiat les dades de Guillem Fors BB', '2021-04-23 18:44:11'),
(7, 24, 'Ha cambiat les dades de Guillem Fors GAARTBB', '2021-04-23 18:44:40'),
(8, 24, 'Ha afegit l\'usuari: Pedro Jorgenio', '2021-04-24 11:37:20'),
(9, 24, 'Ha eliminat un usuari', '2021-04-27 14:33:06'),
(10, 24, 'Ha eliminat un usuari', '2021-04-27 14:34:29'),
(11, 24, 'Ha eliminat un usuari', '2021-04-27 14:34:40'),
(12, 24, 'Ha cambiat les dades de Andiamo Martinez', '2021-04-28 18:45:51'),
(13, 24, 'Ha cambiat les dades de Andiamo Martinez', '2021-04-28 18:46:20'),
(14, 24, 'Ha cambiat les dades de Andiamo Martinez', '2021-04-28 18:46:44'),
(15, 24, 'Ha cambiat les dades de Andiamo Martinez Perez', '2021-04-28 18:47:23'),
(16, 24, 'Ha eliminat un usuari', '2021-04-29 14:18:43'),
(17, 24, 'Ha cambiat les dades de Jorge Martinez', '2021-04-29 14:20:36'),
(18, 24, 'Ha cambiat les dades de Prueba Telefono', '2021-05-01 15:44:01'),
(19, 24, 'Ha cambiat les dades de Prueba Telefono', '2021-05-01 15:46:54'),
(20, 24, 'Ha eliminat un usuari', '2021-05-12 18:36:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_usuari`
--

CREATE TABLE `log_usuari` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `descripcio` text NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `log_usuari`
--

INSERT INTO `log_usuari` (`id`, `idUsuari`, `descripcio`, `data`) VALUES
(12, 24, 'Ha cambiat les seves dades', '2021-04-24 11:31:04'),
(13, 24, 'Ha cambiat les seves dades', '2021-04-28 18:49:25'),
(14, 24, 'Ha cambiat les seves dades', '2021-04-28 18:49:50'),
(15, 24, 'Ha cambiat les seves dades', '2021-04-29 14:53:51'),
(16, 34, 'Ha cambiat les seves dades', '2021-05-01 08:29:03'),
(17, 34, 'Ha cambiat les seves dades', '2021-05-01 08:31:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions_extres`
--

CREATE TABLE `opcions_extres` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `sociOnly` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcions_extres`
--

INSERT INTO `opcions_extres` (`id`, `nom`, `descripcio`, `sociOnly`) VALUES
(1, 'Grupo de opciones extra', 'asjaiodjasiodjsaoidjsaiodjioa', 1),
(3, 'Altre grup extra', 'knsaodsdasdsa', 0),
(4, 'Otra', 'codsncdscs', 1),
(5, 'LALALA', 'codsncdscs', 0),
(6, 'dsadasd', 'dsadsa', 1),
(7, 'adsa', 'dasdas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions_extres_activitats`
--

CREATE TABLE `opcions_extres_activitats` (
  `id` int(11) NOT NULL,
  `idActivitat` int(11) NOT NULL,
  `idGrupOpcio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcions_extres_activitats`
--

INSERT INTO `opcions_extres_activitats` (`id`, `idActivitat`, `idGrupOpcio`) VALUES
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions_extres_valors`
--

CREATE TABLE `opcions_extres_valors` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcions_extres_valors`
--

INSERT INTO `opcions_extres_valors` (`id`, `nom`) VALUES
(1, 'Opcion extra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions_generals`
--

CREATE TABLE `opcions_generals` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `tipus` enum('simple','complex') NOT NULL,
  `sociOnly` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcions_generals`
--

INSERT INTO `opcions_generals` (`id`, `nom`, `descripcio`, `tipus`, `sociOnly`) VALUES
(1, 'Esasasasasa', 'una pruebita para ver si funca esta cosaina', 'simple', 1),
(3, 'Precios', 'ldsmañdmasñldsa', 'complex', 0),
(4, 'Iniciació', '(1h/classe) MÀXIM 6 ALUMNES!', 'complex', 0),
(5, 'Perfeccionament', '(1.5h/classe) MÀXIM 4 ALUMNES', 'complex', 0),
(6, 'Competició', '(2h/classe) MÀXIM 4 ALUMNES', 'complex', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions_generals_activitats`
--

CREATE TABLE `opcions_generals_activitats` (
  `id` int(11) NOT NULL,
  `idActivitat` int(11) NOT NULL,
  `idGrupOpcio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcions_generals_activitats`
--

INSERT INTO `opcions_generals_activitats` (`id`, `idActivitat`, `idGrupOpcio`) VALUES
(3, 1, 3),
(4, 7, 4),
(5, 7, 5),
(6, 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions_generals_valors`
--

CREATE TABLE `opcions_generals_valors` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `preu` float DEFAULT NULL,
  `preuSoci` float NOT NULL,
  `tipus` enum('mensual','persona','inmediat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `opcions_generals_valors`
--

INSERT INTO `opcions_generals_valors` (`id`, `nom`, `preu`, `preuSoci`, `tipus`) VALUES
(1, '1h/SETMANA', 35, 21, 'mensual'),
(2, 'Jorge', 1, 1, 'inmediat'),
(3, 'No se', 45.5, 20.1, 'persona'),
(4, '1h/SETMANA', 35, 21.1, 'mensual'),
(5, '2h/SETMANA', 55, 33, 'mensual'),
(6, '1 DIA A LA SETMANA', 48, 28.8, 'inmediat'),
(7, '2 DIES A LA SETMANA', 76, 45.6, 'inmediat'),
(8, '1 DIA A LA SETMANA', NULL, 40, 'inmediat'),
(9, '2 DIES A LA SETMANA', NULL, 80, 'inmediat'),
(10, '3 DIes A LA SETMANA', NULL, 120, 'inmediat');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plats_restaurant`
--

CREATE TABLE `plats_restaurant` (
  `id` int(11) NOT NULL,
  `titol` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `imatge` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_vista`
--

CREATE TABLE `reserva_vista` (
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
  `tipusSoci` int(11) NOT NULL,
  `dataInscripcio` datetime NOT NULL,
  `estat` enum('A','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenda_producte`
--

CREATE TABLE `tenda_producte` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descripcio` text DEFAULT NULL,
  `link` varchar(90) NOT NULL,
  `imatge` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipussoci`
--

CREATE TABLE `tipussoci` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `descripcio` text NOT NULL,
  `preu` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipussoci`
--

INSERT INTO `tipussoci` (`id`, `nom`, `descripcio`, `preu`) VALUES
(1, 'familiar', 'Per a la familia', 65),
(2, 'individual (full)', 'Pots jugar tennis i pàdel', 45),
(3, 'individual (parcial)', 'Escollir Tennis o Pàdel', 35),
(4, 'infantil', 'Fins a 16 anys', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipus_activitat`
--

CREATE TABLE `tipus_activitat` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipus_activitat`
--

INSERT INTO `tipus_activitat` (`id`, `nom`) VALUES
(1, 'Casal'),
(2, 'Escola'),
(3, 'Torneig');

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
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nif` char(9) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `cognoms` varchar(70) NOT NULL,
  `contrasenya` text NOT NULL,
  `rol` enum('U','S','A','') NOT NULL,
  `email` varchar(60) NOT NULL,
  `localitzacio` int(11) NOT NULL,
  `targetaSanitaria` char(14) NOT NULL,
  `telefon` char(12) NOT NULL,
  `telefon2` char(12) DEFAULT NULL,
  `dataNaixement` date NOT NULL,
  `dataCreacio` datetime NOT NULL,
  `estat` enum('A','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id`, `nif`, `nom`, `cognoms`, `contrasenya`, `rol`, `email`, `localitzacio`, `targetaSanitaria`, `telefon`, `telefon2`, `dataNaixement`, `dataCreacio`, `estat`) VALUES
(24, '39283744D', 'Agusto', 'Lara Sicilia', 'fab2d327175e3244b10ae67be1d237cd', 'A', 'agustinlse8@gmail.com', 1, 'LASI0012300420', '623456789', NULL, '2001-09-11', '2021-04-19 15:25:40', 'A'),
(28, '12345678S', 'Pedro', 'Jorgenio', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'gabysi@hotmail.es', 1, 'PEJO1827364536', '123456789', NULL, '2021-04-06', '2021-04-24 11:37:20', 'A'),
(30, '19283746W', 'Jorge', 'Martinez', 'fab2d327175e3244b10ae67be1d237cd', 'S', 'otrousuario@tennis.com', 1, 'MAJO1928314651', '123456789', NULL, '2021-04-06', '2021-04-24 11:42:12', 'A'),
(31, '12837162F', 'Prueba', 'Telefono', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'roberto_siciliacuevas@hotmail.com', 1, 'MAPA0192837461', '123456789', '918273651', '2021-04-29', '2021-05-01 08:10:29', 'A'),
(32, '19283741D', 'Segundo', 'Telefono', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'usuario@tennis.com', 1, 'MAPA0492837465', '123456789', '123456789', '2021-04-29', '2021-05-01 08:12:03', 'A'),
(34, '12345178F', 'McLovin', 'Rodriguez', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'dsadsa@gmail.com', 1, 'LASI0152837465', '123456789', '183725461', '2021-05-05', '2021-05-01 08:18:18', 'A'),
(35, '12345678F', 'dsadsa', 'dsadsa', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'agustinlse8@gmail.es', 3, 'LASI0012200420', '123456789', NULL, '2021-05-19', '2021-05-01 09:58:55', 'A'),
(36, '12345671F', 'lalala', 'knklnlk', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'daxirotercamo@gmail.com', 5, 'LASI0012300410', '123456789', NULL, '2021-05-27', '2021-05-01 10:22:57', 'A'),
(37, '19283744H', 'axsa', 'sqada', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'roberto_siciliacuevas@hotmail.ss', 7, 'AASI0192837465', '123456789', '183725461', '2021-04-27', '2021-05-01 10:57:59', 'A'),
(39, '91837172H', 'asas', 'iojiopjop', 'fab2d327175e3244b10ae67be1d237cd', 'U', 'nahananan@tennis.com', 9, 'LASI0112837465', '123456789', '987654321', '2021-05-21', '2021-05-01 15:33:54', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari_activitat`
--

CREATE TABLE `usuari_activitat` (
  `id` int(11) NOT NULL,
  `idUsuari` int(11) NOT NULL,
  `idActivitat` int(11) NOT NULL,
  `dadesPeticio` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`dadesPeticio`)),
  `pagat` tinyint(1) NOT NULL,
  `dataPeticio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuari_activitat`
--

INSERT INTO `usuari_activitat` (`id`, `idUsuari`, `idActivitat`, `dadesPeticio`, `pagat`, `dataPeticio`) VALUES
(8, 24, 7, '{\"_token\":\"yblijrpRIXmL2gLiOWAi2uvtUjd5YqTfyDL9kYvg\",\"Iniciaci\\u00f3\":\"1h\\/SETMANA: 35\\u20ac\",\"Perfeccionament\":\"1 DIA A LA SETMANA: 48\\u20ac\",\"Competici\\u00f3\":\"2 DIES A LA SETMANA: \\u20ac\",\"extres\":[\"Pilotes de tennis: 5.5\",\"menjador: 45\"]}', 0, '2021-05-15 08:53:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activitat`
--
ALTER TABLE `activitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_activitat_tipus_activitat` (`idTipusActivitat`);

--
-- Indices de la tabla `alumne_escola`
--
ALTER TABLE `alumne_escola`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_alumne` (`idUsuari`);

--
-- Indices de la tabla `calendari`
--
ALTER TABLE `calendari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_calendari_activitat` (`idActivitat`),
  ADD KEY `FK_calendari_data_activitat` (`idDataActivitat`);

--
-- Indices de la tabla `cartes_inici_vista`
--
ALTER TABLE `cartes_inici_vista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `casal_vista`
--
ALTER TABLE `casal_vista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `data_activitat`
--
ALTER TABLE `data_activitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_data_activitat_hora_activitat` (`idHoraActivitat`);

--
-- Indices de la tabla `escola_vista`
--
ALTER TABLE `escola_vista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `extres`
--
ALTER TABLE `extres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `extres_activitats`
--
ALTER TABLE `extres_activitats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_activitat_extresactivitats` (`idActivitat`),
  ADD KEY `FK_extra_extresactivitats` (`idExtra`);

--
-- Indices de la tabla `extres_valors`
--
ALTER TABLE `extres_valors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_extres_opcions_extres` (`idGrupOpcio`),
  ADD KEY `FK_extres_opcions_extres_valors` (`idOpcioValor`);

--
-- Indices de la tabla `generals_valors`
--
ALTER TABLE `generals_valors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_generals_opcions_generals` (`idGrupOpcio`),
  ADD KEY `FK_generals_opcions_generals_valors` (`idOpcioValor`);

--
-- Indices de la tabla `hora_activitat`
--
ALTER TABLE `hora_activitat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inici_vista`
--
ALTER TABLE `inici_vista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscrit_casal`
--
ALTER TABLE `inscrit_casal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_casal` (`idPareTutor`);

--
-- Indices de la tabla `inscrit_torneigos`
--
ALTER TABLE `inscrit_torneigos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_torneigInscripcio_usuari` (`idUsuari`),
  ADD KEY `FK_torneigInscripcio_torneig` (`idTorneig`);

--
-- Indices de la tabla `localitzacio`
--
ALTER TABLE `localitzacio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log_admin`
--
ALTER TABLE `log_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_log_admin` (`idAdmin`);

--
-- Indices de la tabla `log_usuari`
--
ALTER TABLE `log_usuari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_log_usuari` (`idUsuari`);

--
-- Indices de la tabla `opcions_extres`
--
ALTER TABLE `opcions_extres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opcions_extres_activitats`
--
ALTER TABLE `opcions_extres_activitats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_opcions_extres_activitats_activitat` (`idActivitat`),
  ADD KEY `FK_opcions_extres_activitats_opcio_extra` (`idGrupOpcio`);

--
-- Indices de la tabla `opcions_extres_valors`
--
ALTER TABLE `opcions_extres_valors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opcions_generals`
--
ALTER TABLE `opcions_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opcions_generals_activitats`
--
ALTER TABLE `opcions_generals_activitats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_opcions_generals_activitats_activitat` (`idActivitat`),
  ADD KEY `FK_opcions_generals_activitats_opcio_general` (`idGrupOpcio`);

--
-- Indices de la tabla `opcions_generals_valors`
--
ALTER TABLE `opcions_generals_valors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plats_restaurant`
--
ALTER TABLE `plats_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva_vista`
--
ALTER TABLE `reserva_vista`
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
  ADD KEY `FK_usuari_soci` (`idUsuari`),
  ADD KEY `FK_tipus_soci` (`tipusSoci`);

--
-- Indices de la tabla `tenda_producte`
--
ALTER TABLE `tenda_producte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipussoci`
--
ALTER TABLE `tipussoci`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipus_activitat`
--
ALTER TABLE `tipus_activitat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `torneig`
--
ALTER TABLE `torneig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD UNIQUE KEY `targetaSanitaria` (`targetaSanitaria`),
  ADD KEY `FK_usuari_localitzacio` (`localitzacio`);

--
-- Indices de la tabla `usuari_activitat`
--
ALTER TABLE `usuari_activitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuari_activitats` (`idUsuari`),
  ADD KEY `FK_activitat_activitat` (`idActivitat`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activitat`
--
ALTER TABLE `activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `alumne_escola`
--
ALTER TABLE `alumne_escola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calendari`
--
ALTER TABLE `calendari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cartes_inici_vista`
--
ALTER TABLE `cartes_inici_vista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `casal_vista`
--
ALTER TABLE `casal_vista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_activitat`
--
ALTER TABLE `data_activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `escola_vista`
--
ALTER TABLE `escola_vista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `extres`
--
ALTER TABLE `extres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `extres_activitats`
--
ALTER TABLE `extres_activitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `extres_valors`
--
ALTER TABLE `extres_valors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `generals_valors`
--
ALTER TABLE `generals_valors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `hora_activitat`
--
ALTER TABLE `hora_activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inici_vista`
--
ALTER TABLE `inici_vista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inscrit_casal`
--
ALTER TABLE `inscrit_casal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscrit_torneigos`
--
ALTER TABLE `inscrit_torneigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localitzacio`
--
ALTER TABLE `localitzacio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `log_usuari`
--
ALTER TABLE `log_usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `opcions_extres`
--
ALTER TABLE `opcions_extres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `opcions_extres_activitats`
--
ALTER TABLE `opcions_extres_activitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `opcions_extres_valors`
--
ALTER TABLE `opcions_extres_valors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `opcions_generals`
--
ALTER TABLE `opcions_generals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `opcions_generals_activitats`
--
ALTER TABLE `opcions_generals_activitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `opcions_generals_valors`
--
ALTER TABLE `opcions_generals_valors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `plats_restaurant`
--
ALTER TABLE `plats_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva_vista`
--
ALTER TABLE `reserva_vista`
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
-- AUTO_INCREMENT de la tabla `tenda_producte`
--
ALTER TABLE `tenda_producte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipussoci`
--
ALTER TABLE `tipussoci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipus_activitat`
--
ALTER TABLE `tipus_activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `torneig`
--
ALTER TABLE `torneig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `usuari_activitat`
--
ALTER TABLE `usuari_activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activitat`
--
ALTER TABLE `activitat`
  ADD CONSTRAINT `FK_activitat_tipus_activitat` FOREIGN KEY (`idTipusActivitat`) REFERENCES `tipus_activitat` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `alumne_escola`
--
ALTER TABLE `alumne_escola`
  ADD CONSTRAINT `FK_usuari_alumne` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `calendari`
--
ALTER TABLE `calendari`
  ADD CONSTRAINT `FK_calendari_activitat` FOREIGN KEY (`idActivitat`) REFERENCES `activitat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_calendari_data_activitat` FOREIGN KEY (`idDataActivitat`) REFERENCES `data_activitat` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `data_activitat`
--
ALTER TABLE `data_activitat`
  ADD CONSTRAINT `FK_data_activitat_hora_activitat` FOREIGN KEY (`idHoraActivitat`) REFERENCES `hora_activitat` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `extres_activitats`
--
ALTER TABLE `extres_activitats`
  ADD CONSTRAINT `FK_activitat_extresactivitats` FOREIGN KEY (`idActivitat`) REFERENCES `activitat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_extra_extresactivitats` FOREIGN KEY (`idExtra`) REFERENCES `extres` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `extres_valors`
--
ALTER TABLE `extres_valors`
  ADD CONSTRAINT `FK_extres_opcions_extres` FOREIGN KEY (`idGrupOpcio`) REFERENCES `opcions_extres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_extres_opcions_extres_valors` FOREIGN KEY (`idOpcioValor`) REFERENCES `opcions_extres_valors` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `generals_valors`
--
ALTER TABLE `generals_valors`
  ADD CONSTRAINT `FK_generals_opcions_generals` FOREIGN KEY (`idGrupOpcio`) REFERENCES `opcions_generals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_generals_opcions_generals_valors` FOREIGN KEY (`idOpcioValor`) REFERENCES `opcions_generals_valors` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscrit_casal`
--
ALTER TABLE `inscrit_casal`
  ADD CONSTRAINT `FK_usuari_casal` FOREIGN KEY (`idPareTutor`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscrit_torneigos`
--
ALTER TABLE `inscrit_torneigos`
  ADD CONSTRAINT `FK_torneigInscripcio_torneig` FOREIGN KEY (`idTorneig`) REFERENCES `torneig` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_torneigInscripcio_usuari` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `log_admin`
--
ALTER TABLE `log_admin`
  ADD CONSTRAINT `FK_log_admin` FOREIGN KEY (`idAdmin`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `log_usuari`
--
ALTER TABLE `log_usuari`
  ADD CONSTRAINT `FK_log_usuari` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `opcions_extres_activitats`
--
ALTER TABLE `opcions_extres_activitats`
  ADD CONSTRAINT `FK_opcions_extres_activitats_activitat` FOREIGN KEY (`idActivitat`) REFERENCES `activitat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_opcions_extres_activitats_opcio_extra` FOREIGN KEY (`idGrupOpcio`) REFERENCES `opcions_extres` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `opcions_generals_activitats`
--
ALTER TABLE `opcions_generals_activitats`
  ADD CONSTRAINT `FK_opcions_generals_activitats_activitat` FOREIGN KEY (`idActivitat`) REFERENCES `activitat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_opcions_generals_activitats_opcio_general` FOREIGN KEY (`idGrupOpcio`) REFERENCES `opcions_generals` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `soci`
--
ALTER TABLE `soci`
  ADD CONSTRAINT `FK_tipus_soci` FOREIGN KEY (`tipusSoci`) REFERENCES `tipussoci` (`id`),
  ADD CONSTRAINT `FK_usuari_soci` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD CONSTRAINT `FK_usuari_localitzacio` FOREIGN KEY (`localitzacio`) REFERENCES `localitzacio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuari_activitat`
--
ALTER TABLE `usuari_activitat`
  ADD CONSTRAINT `FK_activitat_activitat` FOREIGN KEY (`idActivitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `FK_usuari_activitats` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
