-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2022 a las 23:30:21
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sirc`
--
CREATE DATABASE IF NOT EXISTS `sirc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sirc`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cod_cargo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cod_cargo`, `nombre`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Secretario', 'A', '2022-02-09 16:08:27', 1, '2022-02-09 16:11:05', 1, '2022-02-09 16:11:06', 1),
(2, 'Cajero', 'A', '2022-02-09 16:08:37', 1, NULL, NULL, NULL, NULL),
(3, 'Gerente', 'A', '2022-02-09 16:08:46', 1, NULL, NULL, NULL, NULL),
(4, 'Limpieza', 'A', '2022-02-09 16:08:53', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_correo`
--

CREATE TABLE `configuracion_correo` (
  `cod_configuracionCorreo` int(11) NOT NULL,
  `correo` varchar(350) NOT NULL,
  `estado` enum('A','I','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion_correo`
--

INSERT INTO `configuracion_correo` (`cod_configuracionCorreo`, `correo`, `estado`) VALUES
(1, 'ereyes@macrogramec.com', 'A'),
(2, 'ecuasuena@ecuasuena.com', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `cod_empresa` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`cod_empresa`, `nombre`, `direccion`, `telefono`, `correo`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Macrogram', 'Guayacanes', '0993073898', 'macrogram@gmail.com', 'A', '2022-02-09 14:27:11', 1, '2022-02-09 15:18:39', 1, '2022-02-09 15:19:11', 1),
(2, 'LabDisgn', 'Guayacanes', '0993073898', 'lab@gmail.com', 'A', '2022-02-09 15:19:22', 1, '2022-02-09 15:20:44', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicion`
--

CREATE TABLE `medicion` (
  `cod_medicion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medicion`
--

INSERT INTO `medicion` (`cod_medicion`, `nombre`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Critico', 'A', '2022-02-09 15:45:43', 1, '2022-02-09 15:53:34', 1, '2022-02-09 15:53:38', 1),
(2, 'Malo', 'A', '2022-02-09 15:45:52', 1, NULL, NULL, NULL, NULL),
(3, 'Regular', 'A', '2022-02-09 15:45:58', 1, NULL, NULL, NULL, NULL),
(4, 'Bueno', 'A', '2022-02-09 15:46:07', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `cod_modulo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`cod_modulo`, `nombre`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'M&oacute;dulo 1', 'A', '2022-02-10 15:05:03', 2, NULL, NULL, NULL, NULL),
(2, 'M&oacute;dulo 2', 'A', '2022-02-10 15:05:07', 2, NULL, NULL, NULL, NULL),
(3, 'M&oacute;dulo 3', 'A', '2022-02-10 15:05:10', 2, NULL, NULL, '2022-02-10 15:05:15', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `cod_oficina` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `cod_sucursal` int(11) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`cod_oficina`, `nombre`, `descripcion`, `correo`, `cod_sucursal`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Prueba  1', 'Nose donde queda 3e', 'asd@gmai.com 1', 1, 'A', '2022-02-09 09:13:58', 1, '2022-02-09 17:10:23', 1, '2022-02-09 15:18:42', 1),
(2, 'Macrogram', 'Macrograme jeje', 'macrogramec@gmail.com', 2, 'A', '2022-02-09 10:26:51', 1, NULL, NULL, NULL, NULL),
(3, 'LabDisgin', 'Nose we', 'lad@gmail.com', 3, 'A', '2022-02-09 10:28:04', 1, NULL, NULL, NULL, NULL),
(4, 'Marianita de Jesus', '', 'marianita@gmail.com', 0, 'A', '2022-02-09 14:22:07', 1, NULL, NULL, NULL, NULL),
(5, 'Juanito', 'Nose', 'juanit@nose', 3, 'A', '2022-02-10 16:03:02', 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `cod_pregunta` int(11) NOT NULL,
  `pregunta` varchar(500) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `cod_tematica` int(11) NOT NULL,
  `cod_modulo` int(11) NOT NULL,
  `cod_medicion` int(11) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`cod_pregunta`, `pregunta`, `descripcion`, `cod_tematica`, `cod_modulo`, `cod_medicion`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Pregunta 1', 'wwww', 2, 1, 1, 'A', '2022-02-10 16:34:05', 2, '2022-02-10 17:21:22', 2, NULL, NULL),
(2, 'Pregunta 2', 'Descripcri&oacute;n 2', 10, 3, 4, 'A', '2022-02-10 16:34:05', 2, NULL, NULL, NULL, NULL),
(3, 'Pregunta 3', 'Descripci&oacute;n 3', 3, 3, 3, 'A', '2022-02-10 16:38:11', 2, '2022-02-10 17:11:25', 2, NULL, NULL),
(4, 'Pregunta 4', 'Descripci&oacute;n 4', 9, 2, 2, 'A', '2022-02-10 16:38:11', 2, NULL, NULL, NULL, NULL),
(5, 'Pregunta 5', 'Descripci&oacute;n 5', 2, 2, 1, 'A', '2022-02-10 17:19:24', 2, NULL, NULL, NULL, NULL),
(6, 'Pregunta 6', ' Descripci&oacute;n 6', 8, 2, 1, 'A', '2022-02-10 17:19:24', 2, NULL, NULL, NULL, NULL),
(7, 'Pregunta 7', 'Descripcri&oacute;n 7', 9, 1, 2, 'A', '2022-02-10 17:19:24', 2, '2022-02-10 17:21:32', 2, NULL, NULL),
(8, 'Pregunta 8', 'Descripci&oacute;n 8', 2, 2, 1, 'A', '2022-02-10 17:19:24', 2, NULL, NULL, NULL, NULL),
(9, 'Pregunta 9', 'Descripcri&oacute;n 9', 8, 2, 1, 'A', '2022-02-10 17:19:24', 2, NULL, NULL, NULL, NULL),
(10, 'Pregunta 10', 'Descripcri&oacute;n 10', 9, 1, 2, 'A', '2022-02-10 17:19:24', 2, '2022-02-10 17:21:37', 2, NULL, NULL),
(11, 'Pregunta 11', 'Descripcri&oacute;n 11', 2, 3, 3, 'A', '2022-02-10 17:20:01', 2, NULL, NULL, NULL, NULL),
(12, 'Pregunta 12', 'Descripcri&oacute;n 12', 3, 2, 2, 'A', '2022-02-10 17:20:16', 2, '2022-02-10 17:24:38', 2, NULL, NULL),
(13, 'Pregunta 13', 'Descripcion 13', 1, 3, 4, 'A', '2022-02-10 17:20:30', 2, '2022-02-10 17:24:43', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `cod_rol` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `tabla` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`cod_rol`, `nombre`, `estado`, `tabla`) VALUES
(1, 'Administrador', 'A', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `cod_sucursal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`cod_sucursal`, `nombre`, `direccion`, `telefono`, `correo`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Urdesa', 'Guayacanes ', '993073898', 'urdesa@gmail.com', 'A', '2022-02-08 15:10:44', 1, '2022-02-10 09:45:35', 2, NULL, NULL),
(2, 'sambo', 'Guayaquil', '993073898', 'sambo@gmail.com', 'A', '2022-02-08 16:12:32', 1, '2022-02-09 16:40:38', 1, NULL, NULL),
(3, 'Prueba', 'Prueba direcci&oacute;n', '0993073898', 'prueba@prueba.com', 'A', '2022-02-08 17:34:04', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematica`
--

CREATE TABLE `tematica` (
  `cod_tematica` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime DEFAULT NULL,
  `usuario_actualizado` int(11) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tematica`
--

INSERT INTO `tematica` (`cod_tematica`, `nombre`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 'Salud', 'A', '2022-02-10 14:55:08', 2, NULL, NULL, NULL, NULL),
(2, 'Trabajo', 'A', '2022-02-10 14:55:30', 2, NULL, NULL, NULL, NULL),
(3, 'Familia', 'A', '2022-02-10 14:55:39', 2, NULL, NULL, NULL, NULL),
(4, 'Relaci&oacute;n Laboral', 'A', '2022-02-10 14:55:48', 2, NULL, NULL, NULL, NULL),
(5, 'Ambiente ', 'A', '2022-02-10 14:55:54', 2, '2022-02-10 14:56:58', 2, NULL, NULL),
(6, 'Recreaci&oacute;n', 'A', '2022-02-10 14:56:02', 2, NULL, NULL, NULL, NULL),
(7, 'Sueldo', 'A', '2022-02-10 14:56:14', 2, NULL, NULL, NULL, NULL),
(8, 'Higiene Personal', 'A', '2022-02-10 14:56:29', 2, NULL, NULL, NULL, NULL),
(9, 'Tiempo de trabajo(TT)', 'A', '2022-02-10 14:56:41', 2, NULL, NULL, NULL, NULL),
(10, 'Autonom&iacute;a', 'A', '2022-02-10 14:56:48', 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `cod_rol` int(11) NOT NULL,
  `cod_empresa` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nombres` varchar(1000) NOT NULL,
  `correo` varchar(1000) NOT NULL,
  `correoConfirmado` int(11) NOT NULL COMMENT '1=confirmado,0=no confirmado',
  `estado` enum('A','I','D') NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_creado` int(11) NOT NULL,
  `fecha_actualizado` datetime NOT NULL,
  `usuario_actualizado` varchar(50) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `usuario_eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `cod_rol`, `cod_empresa`, `usuario`, `password`, `nombres`, `correo`, `correoConfirmado`, `estado`, `fecha_creado`, `usuario_creado`, `fecha_actualizado`, `usuario_actualizado`, `fecha_eliminado`, `usuario_eliminado`) VALUES
(1, 1, 0, 'administrador', 'YXlhNnVsd2tDM3hTL09UK0R5MXA0QT09', 'Elias Alberto Reyes Conforme', 'elias@gmail.com', 1, 'A', '2022-02-09 11:33:37', 1, '0000-00-00 00:00:00', '1', '2022-02-09 12:24:54', 1),
(2, 1, 0, 'luiyie', 'YXlhNnVsd2tDM3hTL09UK0R5MXA0QT09', 'Elias Alberto', 'ereyes@macrogramec.com', 1, 'A', '2022-02-09 12:41:56', 1, '2022-02-10 11:30:07', 'RECUPERAR_PASSWORD', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cod_cargo`);

--
-- Indices de la tabla `configuracion_correo`
--
ALTER TABLE `configuracion_correo`
  ADD PRIMARY KEY (`cod_configuracionCorreo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cod_empresa`);

--
-- Indices de la tabla `medicion`
--
ALTER TABLE `medicion`
  ADD PRIMARY KEY (`cod_medicion`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`cod_modulo`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`cod_oficina`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`cod_pregunta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`cod_rol`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`cod_sucursal`);

--
-- Indices de la tabla `tematica`
--
ALTER TABLE `tematica`
  ADD PRIMARY KEY (`cod_tematica`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cod_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `configuracion_correo`
--
ALTER TABLE `configuracion_correo`
  MODIFY `cod_configuracionCorreo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cod_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicion`
--
ALTER TABLE `medicion`
  MODIFY `cod_medicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `cod_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `cod_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `cod_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `cod_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `cod_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tematica`
--
ALTER TABLE `tematica`
  MODIFY `cod_tematica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
