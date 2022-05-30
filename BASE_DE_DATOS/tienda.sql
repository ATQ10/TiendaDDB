-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2020 a las 08:54:47
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificar`
--

CREATE TABLE `calificar` (
  `idu` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idp` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idp`, `idu`, `cantidad`) VALUES
(1, 2, 1),
(7, 2, 1),
(8, 2, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcat` int(11) NOT NULL,
  `categoria` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcat`, `categoria`) VALUES
(1, 'Tecnología'),
(2, 'Juguetes'),
(3, 'Ropa'),
(4, 'Deportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentar`
--

CREATE TABLE `comentar` (
  `idu` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentar`
--

INSERT INTO `comentar` (`idu`, `idp`, `comentario`, `fecha_hora`) VALUES
(1, 1, 'Me gusta', '2020-12-18 22:09:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idc` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `monto` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idc`, `idu`, `monto`, `cantidad`, `fecha_hora`) VALUES
(1, 2, 13060, 2, '2020-12-18 11:27:55'),
(2, 2, 6000, 1, '2020-12-18 11:32:19'),
(3, 2, 28000, 2, '2020-12-18 11:39:03'),
(4, 2, 28400, 3, '2020-12-18 14:28:56'),
(5, 2, 28400, 3, '2020-12-18 14:29:32'),
(6, 2, 13100, 2, '2020-12-18 14:30:01'),
(7, 2, 13100, 2, '2020-12-18 14:32:33'),
(8, 2, 13100, 2, '2020-12-18 14:33:19'),
(9, 2, 2100, 2, '2020-12-18 14:33:49'),
(10, 2, 2100, 2, '2020-12-18 14:34:46'),
(11, 2, 2100, 2, '2020-12-18 14:37:00'),
(12, 2, 2100, 2, '2020-12-18 14:37:20'),
(13, 2, 2100, 2, '2020-12-18 14:37:53'),
(14, 2, 2100, 2, '2020-12-18 14:39:18'),
(15, 2, 2100, 2, '2020-12-18 14:41:09'),
(16, 2, 2100, 2, '2020-12-18 14:41:46'),
(17, 2, 14050, 3, '2020-12-18 14:44:05'),
(18, 2, 14050, 3, '2020-12-18 14:47:36'),
(19, 1, 22530, 3, '2020-12-18 22:11:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contener`
--

CREATE TABLE `contener` (
  `idc` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contener`
--

INSERT INTO `contener` (`idc`, `idp`, `cantidad`) VALUES
(3, 1, 4),
(3, 3, 2),
(4, 3, 3),
(4, 5, 1),
(4, 7, 2),
(5, 3, 3),
(5, 5, 1),
(5, 7, 2),
(6, 7, 2),
(6, 4, 1),
(7, 7, 2),
(7, 4, 1),
(8, 7, 2),
(8, 4, 1),
(9, 4, 1),
(9, 4, 2),
(10, 4, 1),
(10, 4, 2),
(11, 4, 1),
(11, 4, 2),
(12, 4, 1),
(12, 4, 2),
(13, 4, 1),
(13, 4, 2),
(14, 4, 1),
(14, 4, 2),
(15, 4, 1),
(15, 4, 2),
(16, 4, 1),
(16, 4, 2),
(17, 8, 2),
(17, 6, 5),
(17, 7, 2),
(18, 8, 2),
(18, 6, 5),
(18, 7, 2),
(19, 1, 2),
(19, 5, 1),
(19, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `idu` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `calle` varchar(250) DEFAULT NULL,
  `n_ext` int(11) NOT NULL,
  `n_int` int(11) NOT NULL,
  `colonia` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`idu`, `cp`, `calle`, `n_ext`, `n_int`, `colonia`, `ciudad`, `estado`) VALUES
(1, 20276, 'Paseo de los cisnes 147', 147, 0, 'jardines del parque', 'Aguascalientes', 'Aguascalientes'),
(2, 47200, 'Guanajuato ', 46, 0, 'Fracc. los Angeles', 'Teocaltiche', 'Jalisco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idm` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`idm`, `idu`, `mensaje`, `fecha_hora`, `estado`) VALUES
(1, 2, 'Hola', '2020-12-15 15:53:47', 1),
(2, 2, 'Que tal', '2020-12-18 19:58:00', 0),
(3, 2, 'No me ha llegado mi paquete', '2020-12-18 20:33:27', 0),
(4, 2, '', '2020-12-19 04:19:41', 1),
(5, 2, '', '2020-12-19 04:21:29', 1),
(6, 2, 'Lo solucionaremos', '2020-12-19 04:30:38', 1),
(7, 2, 'Arnoldo', '2020-12-19 04:30:58', 1),
(8, 2, 'Adios', '2020-12-19 04:31:13', 1),
(9, 1, 'Me encantaron los productos', '2020-12-19 05:15:58', 0),
(10, 1, 'Estamos a sus ordenes', '2020-12-19 05:16:18', 1),
(11, 1, 'Gracias', '2020-12-19 06:49:29', 0),
(12, 1, 'Por nada', '2020-12-19 06:49:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idp` int(11) NOT NULL,
  `idcat` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` double NOT NULL,
  `existencia` int(11) NOT NULL,
  `promedio` double NOT NULL,
  `imagen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idp`, `idcat`, `nombre`, `descripcion`, `precio`, `existencia`, `promedio`, `imagen`) VALUES
(1, 1, 'Huawei P30 Lite', 'Telefono celular con camara de 16px y 256GB', 6000, 8, 0, 'huawei p30 lite.png'),
(2, 2, 'Barbie Programadora', 'Barbie con estilo programador', 530, 9, 0, 'barbie.jpg'),
(3, 3, 'Blazer para hombre', 'Blazer para hombre en color negro ', 2000, 10, 0, 'blazer.jpg'),
(4, 3, 'Chamarra de Mezclilla', 'Chamarra de mezclilla para hombre', 700, 10, 0, 'chamarra.jpg'),
(5, 4, 'Pelota de fútbol Nike', 'Pelota de futbol con colores fosforescentes autografiada por Messi', 10000, 19, 0, 'pelota.jpg'),
(6, 4, 'Raqueta de Tennis', 'Raqueta de Tennis color negro con nylon', 150, 30, 0, 'raqueta.jpg'),
(7, 1, 'TV SAMSUNG 46\'', 'Televisión marca SAMSUNG de 46pulgadas con wifi ', 6200, 27, 0, 'tv.jpg'),
(8, 3, 'Botines para dama', 'Botines para dama en color negro ', 450, 5, 0, 'botines.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idu` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `ape_pat` varchar(250) DEFAULT NULL,
  `ape_mat` varchar(250) DEFAULT NULL,
  `fecha` date NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `gustos` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idu`, `nombre`, `ape_pat`, `ape_mat`, `fecha`, `email`, `telefono`, `tipo`, `password`, `gustos`) VALUES
(1, 'loredana', 'ocampo', 'calderon', '2000-10-15', 'loredana_ocampo@hotmail.com', '4492256726', 'normal', '81dc9bdb52d04dc20036dbd8313ed055', 'Ropa y zapatos'),
(2, 'Arnoldo', 'Tejeda', 'Quezada', '1999-12-05', 'arnoldotejeda10@gmail.com', '3461046302', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'computadoras y tecnologia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificar`
--
ALTER TABLE `calificar`
  ADD KEY `fk_idu` (`idu`),
  ADD KEY `fk_idp` (`idp`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `kf_idp` (`idp`),
  ADD KEY `fk_idu` (`idu`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcat`);

--
-- Indices de la tabla `comentar`
--
ALTER TABLE `comentar`
  ADD KEY `fk_idu` (`idu`),
  ADD KEY `fk_idp` (`idp`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idc`),
  ADD KEY `fk_idu` (`idu`);

--
-- Indices de la tabla `contener`
--
ALTER TABLE `contener`
  ADD KEY `fk_idc` (`idc`),
  ADD KEY `fk_idp` (`idp`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD KEY `fk_idu` (`idu`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idm`),
  ADD KEY `fk_idu` (`idu`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `fk_idcat` (`idcat`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificar`
--
ALTER TABLE `calificar`
  ADD CONSTRAINT `calificar_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calificar_ibfk_2` FOREIGN KEY (`idp`) REFERENCES `producto` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`idp`) REFERENCES `producto` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentar`
--
ALTER TABLE `comentar`
  ADD CONSTRAINT `comentar_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentar_ibfk_2` FOREIGN KEY (`idp`) REFERENCES `producto` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contener`
--
ALTER TABLE `contener`
  ADD CONSTRAINT `contener_ibfk_1` FOREIGN KEY (`idc`) REFERENCES `compra` (`idc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contener_ibfk_2` FOREIGN KEY (`idp`) REFERENCES `producto` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`idu`) REFERENCES `usuario` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcat`) REFERENCES `categoria` (`idcat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
