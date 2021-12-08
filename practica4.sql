-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2021 a las 00:49:12
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apaterno` varchar(20) NOT NULL,
  `amaterno` varchar(20) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `tipo_us` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apaterno`, `amaterno`, `telefono`, `sexo`, `correo`, `password`, `observaciones`, `tipo_us`) VALUES
(1, 'Jairo', 'Chavarria', 'Santiago', '7341598583', 'Masculino', 'elisur1998@gmail.com', 'jairo123', 'Lesión en el hombro izquierdo', 'admin'),
(2, 'Elias', 'Gamez', 'Delgadillo', '7771454343', 'Masculino', 'elias@gmail.com', 'elias123', 'ninguna', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE `general` (
  `id_gral` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_modalidad` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `notas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `id_modalidad` int(11) NOT NULL,
  `tipo_modalidad` varchar(30) NOT NULL,
  `costo` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`id_modalidad`, `tipo_modalidad`, `costo`, `status`) VALUES
(1, 'Visita', '25', 'Activado'),
(2, 'Semanal', '150', 'Activado'),
(3, 'Mensual', '250', 'Activado'),
(4, 'Anual', '1500', 'Activado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_pago`
--

CREATE TABLE `status_pago` (
  `id_status` int(11) NOT NULL,
  `indicador` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `status_pago`
--

INSERT INTO `status_pago` (`id_status`, `indicador`, `status`) VALUES
(1, 1, 'Pagado'),
(2, 0, 'Deudor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id_gral`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_modalidad` (`id_modalidad`),
  ADD KEY `id_status` (`id_status`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`id_modalidad`);

--
-- Indices de la tabla `status_pago`
--
ALTER TABLE `status_pago`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `general`
--
ALTER TABLE `general`
  MODIFY `id_gral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `id_modalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `status_pago`
--
ALTER TABLE `status_pago`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `general`
--
ALTER TABLE `general`
  ADD CONSTRAINT `general_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `general_ibfk_2` FOREIGN KEY (`id_modalidad`) REFERENCES `modalidad` (`id_modalidad`),
  ADD CONSTRAINT `general_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status_pago` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
